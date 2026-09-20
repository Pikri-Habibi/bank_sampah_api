<?php

namespace App\Http\Controllers;

use App\Models\DetailSetoran;
use App\Models\HargaSampah;
use App\Models\JenisSampah;
use App\Models\Nasabah;
use App\Models\Setoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasSetoranController extends Controller
{
    protected function getActiveHarga($idJenisSampah)
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
        $user = auth()->user();

        if (!$user || $user->role !== 'petugas') {
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

        if (!$harga) {
            return back()->withErrors(['id_jenis_sampah' => 'Harga sampah belum tersedia untuk jenis ini.']);
        }

        $nasabah = Nasabah::findOrFail($request->id_pengguna_nasabah);
        $total = (float) $request->berat_kg * (float) $harga->harga_per_kg;

        return view('petugas.setoran.preview', compact('nasabah', 'harga', 'total'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'petugas') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'id_pengguna_nasabah' => 'required|exists:nasabah,id_pengguna_nasabah',
            'id_jenis_sampah' => 'required|exists:jenis_sampah,id_jenis_sampah',
            'berat_kg' => 'required|numeric|min:0.1',
        ]);

        $petugas = $user->petugas;

        if (!$petugas) {
            abort(403, 'Akun ini belum terdaftar sebagai petugas.');
        }

        $harga = $this->getActiveHarga($request->id_jenis_sampah);

        if (!$harga) {
            abort(404, 'Harga sampah belum tersedia untuk jenis ini.');
        }

        $berat = (float) $request->berat_kg;
        $total = $berat * (float) $harga->harga_per_kg;

        DB::transaction(function () use ($request, $petugas, $harga, $berat, $total) {
            $setoran = Setoran::create([
                'id_pengguna_nasabah' => $request->id_pengguna_nasabah,
                'id_pengguna_petugas' => $petugas->id_pengguna_petugas,
                'id_harga' => $harga->id_harga,
                'tgl_setoran' => now()->toDateString(),
                'status' => 'approved',
            ]);

            DetailSetoran::create([
                'id_setoran' => $setoran->id_setoran,
                'id_jenis_sampah' => $request->id_jenis_sampah,
                'total_berat' => $berat,
                'harga_per_kg' => $harga->harga_per_kg,
            ]);

            $nasabah = Nasabah::findOrFail($request->id_pengguna_nasabah);
            $nasabah->saldo = (float) ($nasabah->saldo ?? 0) + $total;
            $nasabah->save();
        });

        return redirect()->route('petugas.dashboard')->with('success', 'Setoran berhasil diproses dan saldo nasabah bertambah.');
    }
}
