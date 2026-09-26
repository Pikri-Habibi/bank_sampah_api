<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use App\Models\Penarikan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NasabahDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $nasabah = $user->nasabah;

        if (!$nasabah) {
            abort(403, 'Akun ini belum terdaftar sebagai nasabah.');
        }

        $saldo = (float) ($nasabah->saldo ?? 0);

        // Semua transaksi setoran nasabah
        $semuaTransaksi = Setoran::with('detailSetoran.jenisSampah')
            ->where(
                'id_pengguna_nasabah',
                $nasabah->id_pengguna_nasabah
            )
            ->get();

            // Transaksi khusus untuk statistik tahun berjalan
        $transaksiStatistik = Setoran::with('detailSetoran.jenisSampah')
            ->where(
                'id_pengguna_nasabah',
                $nasabah->id_pengguna_nasabah
            )
            ->whereYear('tgl_setoran', now()->year)
            ->get();

        // Total jumlah transaksi
        $totalSetoran = $semuaTransaksi->count();

        // Total berat seluruh sampah
        $totalBerat = $semuaTransaksi->sum(function ($setoran) {
            return $setoran->detailSetoran->sum('total_berat');
        });

        // Total pendapatan seluruh setoran
        $totalPendapatan = $semuaTransaksi->sum(function ($setoran) {
            return $setoran->detailSetoran->sum(function ($detail) {
                return $detail->total_berat * $detail->harga_per_kg;
            });
        });

        // Statistik berat sampah berdasarkan jenis
        $statistikSampah = [];

        foreach ($transaksiStatistik as $setoran){

            foreach ($setoran->detailSetoran as $detail) {

                $namaSampah = $detail->jenisSampah->nama_sampah ?? 'Tidak diketahui';

                if (!isset($statistikSampah[$namaSampah])) {
                    $statistikSampah[$namaSampah] = 0;
                }

                $statistikSampah[$namaSampah] += (float) $detail->total_berat;
            }
        }

        // 5 transaksi setoran terbaru
        $transaksiTerakhir = $semuaTransaksi
            ->sortByDesc('tgl_setoran')
            ->take(5);

        // 5 pengajuan penarikan terbaru
        $penarikanTerakhir = Penarikan::where(
            'id_pengguna_nasabah',
            $nasabah->id_pengguna_nasabah
        )
            ->orderByDesc('tgl_pengajuan')
            ->take(5)
            ->get();

        // Notifikasi terbaru
        $notifikasi = $nasabah->notifikasi()
            ->latest()
            ->take(10)
            ->get();

        // Jumlah notifikasi yang belum dibaca
        $jumlahNotifikasiBelumDibaca = $nasabah->notifikasi()
            ->where('dibaca', false)
            ->count();

        return view(
            'nasabah.dashboard',
            compact(
                'nasabah',
                'saldo',
                'totalSetoran',
                'totalBerat',
                'totalPendapatan',
                'transaksiTerakhir',
                'penarikanTerakhir',
                'statistikSampah',
                'notifikasi',
                'jumlahNotifikasiBelumDibaca'
            )
        );
    }

    public function bacaNotifikasi()
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $nasabah = $user->nasabah;

        if (!$nasabah) {
            abort(403, 'Akun ini belum terdaftar sebagai nasabah.');
        }

        Notifikasi::where(
            'id_pengguna_nasabah',
            $nasabah->id_pengguna_nasabah
        )
        ->where('dibaca', false)
        ->update([
            'dibaca' => true
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function riwayat()
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $nasabah = $user->nasabah;

        if (!$nasabah) {
            abort(403, 'Akun ini belum terdaftar sebagai nasabah.');
        }

        $transaksi = Setoran::with('detailSetoran.jenisSampah')
            ->where('id_pengguna_nasabah', $nasabah->id_pengguna_nasabah)
            ->orderByDesc('tgl_setoran')
            ->get();

        $penarikan = Penarikan::where(
            'id_pengguna_nasabah',
            $nasabah->id_pengguna_nasabah
        )
            ->orderByDesc('tgl_pengajuan')
            ->get();

        return view(
            'nasabah.riwayat',
            compact(
                'nasabah',
                'transaksi',
                'penarikan'
            )
        );
    }

    public function detail($id)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $nasabah = $user->nasabah;

        if (!$nasabah) {
            abort(403, 'Akun ini belum terdaftar sebagai nasabah.');
        }

        $transaksi = Setoran::with('detailSetoran.jenisSampah')
            ->where('id_setoran', $id)
            ->where(
                'id_pengguna_nasabah',
                $nasabah->id_pengguna_nasabah
            )
            ->firstOrFail();

        return view(
            'nasabah.detail-transaksi',
            compact('nasabah', 'transaksi')
        );
    }

    public function profil()
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $nasabah = $user->nasabah;

        if (!$nasabah) {
            abort(403, 'Akun ini belum terdaftar sebagai nasabah.');
        }

        $setoran = Setoran::with('detailSetoran.jenisSampah')
            ->where(
                'id_pengguna_nasabah',
                $nasabah->id_pengguna_nasabah
            )
            ->get();
        $totalSetoran = $setoran->count();

        $totalBerat = $setoran->sum(function ($transaksi) {
            return $transaksi->detailSetoran->sum('total_berat');
        });

        $totalPendapatan = $setoran->sum(function ($transaksi) {
            return $transaksi->detailSetoran->sum(function ($detail) {
                return $detail->total_berat * $detail->harga_per_kg;
            });
        });

        return view(
            'nasabah.profil',
            compact(
                'nasabah',
                'totalSetoran',
                'totalBerat',
                'totalPendapatan'
            )
        );
    }
}
