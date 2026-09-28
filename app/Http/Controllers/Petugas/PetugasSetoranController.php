<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\DetailSetoran;
use App\Models\HargaSampah;
use App\Models\JenisSampah;
use App\Models\Nasabah;
use App\Models\Notifikasi;
use App\Models\Penarikan;
use App\Models\Setoran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetugasSetoranController extends Controller
{
    protected function getActiveHarga(int|string $idJenisSampah): ?HargaSampah
    {
        return HargaSampah::where('id_jenis_sampah', $idJenisSampah)
            ->where(function ($query) {
                $query->where('status', true)
                    ->orWhere('status', 1)
                    ->orWhere('status', 'aktif')
                    ->orWhere('status', 'active');
            })
            ->latest('tanggal_berlaku')
            ->first();
    }

    public function create()
    {
        $user = Auth::user();

        if (! $user || $user->role !== 'petugas') {
            abort(403, 'Akses ditolak.');
        }

        $nasabahList = Nasabah::with('user')->get();
        $jenisSampah = JenisSampah::with(['harga' => function ($query) {
            $query->where(function ($subQuery) {
                $subQuery->where('status', true)
                    ->orWhere('status', 1)
                    ->orWhere('status', 'aktif')
                    ->orWhere('status', 'active');
            })->latest('tanggal_berlaku');
        }])
            ->where(function ($query) {
                $query->where('status', true)
                    ->orWhere('status', 1)
                    ->orWhere('status', 'aktif')
                    ->orWhere('status', 'active');
            })
            ->get();

        return view('petugas.setoran.create', compact('nasabahList', 'jenisSampah'));
    }

    public function preview(Request $request)
    {
        $request->validate([
            'id_pengguna_nasabah' => 'required|exists:nasabah,id_pengguna_nasabah',
            'id_jenis_sampah' => 'required|exists:jenis_sampah,id_jenis_sampah',
            'berat_kg' => 'required|numeric|min:0.1',
        ]);

        $harga = $this->getActiveHarga($request->id_jenis_sampah);

        if (! $harga) {
            return back()->withErrors(['id_jenis_sampah' => 'Harga sampah belum tersedia untuk jenis ini.']);
        }

        $nasabah = Nasabah::findOrFail($request->id_pengguna_nasabah);
        $total = (float) $request->berat_kg * (float) $harga->harga_per_kg;

        return view('petugas.setoran.preview', [
            'nasabah' => $nasabah,
            'harga' => $harga,
            'total' => $total,
        ]);
    }

    public function history()
    {
        $user = Auth::user();

        if (! $user || $user->role !== 'petugas') {
            abort(403, 'Akses ditolak.');
        }

        $setoran = Setoran::with(['nasabah.user', 'petugas.user', 'detailSetoran.jenisSampah'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($item) {
                $details = $item->detailSetoran ?? collect();

                return [
                    'jenis_transaksi' => 'Setoran',
                    'nasabah' => $item->nasabah?->nama_lengkap ?? $item->nasabah?->user?->name ?? '-',
                    'petugas' => $item->petugas?->nama_lengkap ?? $item->petugas?->user?->name ?? '-',
                    'jenis_sampah' => $details->pluck('jenisSampah.nama_sampah')->filter()->implode(', ') ?: '-',
                    'berat' => $details->sum('total_berat'),
                    'nominal' => $details->sum(fn ($detail) => (float) $detail->total_berat * (float) $detail->harga_per_kg),
                    'waktu' => Carbon::parse($item->created_at ?? $item->tgl_setoran ?? now()),
                    'status' => ucfirst($item->status ?? 'approved'),
                ];
            });

        $penarikan = Penarikan::with(['nasabah.user'])
            ->where(function ($query) {
                $query->whereNull('status')
                    ->orWhere('status', '!=', 'rejected');
            })
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($item) {
                return [
                    'jenis_transaksi' => 'Penarikan',
                    'nasabah' => $item->nasabah?->nama_lengkap ?? $item->nasabah?->user?->name ?? '-',
                    'petugas' => '-',
                    'jenis_sampah' => '-',
                    'berat' => '-',
                    'nominal' => (float) $item->nominal,
                    'waktu' => Carbon::parse($item->created_at ?? $item->tgl_pengajuan ?? now()),
                    'status' => ucfirst($item->status ?? 'pending'),
                ];
            });

        $transactions = $setoran->concat($penarikan)
            ->sortByDesc(fn ($item) => $item['waktu'])
            ->values();

        return view('petugas.transaksi.history', compact('transactions'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (! $user || $user->role !== 'petugas') {
            abort(403, 'Akses ditolak.');
        }

        $legacySingleItem = $request->filled('id_jenis_sampah') && $request->filled('berat_kg');
        $items = $request->input('items', []);

        if (empty($items) && $legacySingleItem) {
            $items = [[
                'id_jenis_sampah' => $request->id_jenis_sampah,
                'berat_kg' => $request->berat_kg,
            ]];
        }

        $request->merge(['items' => $items]);

        $request->validate([
            'id_pengguna_nasabah' => 'required|exists:nasabah,id_pengguna_nasabah',
            'items' => 'required|array|min:1',
            'items.*.id_jenis_sampah' => 'required|exists:jenis_sampah,id_jenis_sampah',
            'items.*.berat_kg' => 'required|numeric|min:0.1',
        ]);

        $petugas = $user->petugas;

        if (! $petugas) {
            abort(403, 'Akun ini belum terdaftar sebagai petugas.');
        }

        DB::transaction(function () use ($request, $petugas) {
            $setoran = Setoran::create([
                'id_pengguna_nasabah' => $request->id_pengguna_nasabah,
                'id_pengguna_petugas' => $petugas->id_pengguna_petugas,
                'tgl_setoran' => now()->toDateString(),
                'status' => 'approved',
            ]);

            $totalSaldo = 0;

            foreach ($request->items as $detail) {
                $jenisSampah = JenisSampah::where('id_jenis_sampah', $detail['id_jenis_sampah'])
                    ->where(function ($query) {
                        $query->where('status', true)
                            ->orWhere('status', 1)
                            ->orWhere('status', 'aktif')
                            ->orWhere('status', 'active');
                    })
                    ->first();

                if (! $jenisSampah) {
                    throw new \Exception('Jenis sampah tidak aktif atau tidak ditemukan.');
                }

                $harga = $this->getActiveHarga($detail['id_jenis_sampah']);

                if (! $harga) {
                    throw new \Exception('Harga sampah belum tersedia untuk salah satu jenis sampah.');
                }

                $berat = (float) $detail['berat_kg'];
                $subtotal = $berat * (float) $harga->harga_per_kg;

                DetailSetoran::create([
                    'id_setoran' => $setoran->id_setoran,
                    'id_jenis_sampah' => $detail['id_jenis_sampah'],
                    'total_berat' => $berat,
                    'harga_per_kg' => $harga->harga_per_kg,
                ]);

                $totalSaldo += $subtotal;
            }

            $nasabah = Nasabah::findOrFail($request->id_pengguna_nasabah);
            $nasabah->saldo = (float) ($nasabah->saldo ?? 0) + $totalSaldo;
            $nasabah->save();

            Notifikasi::create([
                'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
                'judul' => 'Setoran Berhasil',
                'pesan' => 'Setoran sampah berhasil dicatat. Saldo bertambah sebesar Rp '.number_format($totalSaldo, 0, ',', '.'),
                'tipe' => 'setoran',
                'dibaca' => false,
            ]);
        });

        return redirect()
            ->route('petugas.dashboard')
            ->with('success', 'Setoran berhasil diproses dan saldo nasabah bertambah.');
    }
}
