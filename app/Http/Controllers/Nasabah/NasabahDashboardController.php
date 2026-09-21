<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use App\Models\Penarikan;
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

        $transaksiTerakhir = Setoran::with('detailSetoran.jenisSampah')
            ->where('id_pengguna_nasabah', $nasabah->id_pengguna_nasabah)
            ->orderByDesc('tgl_setoran')
            ->take(5)
            ->get();

        $penarikanTerakhir = Penarikan::where('id_pengguna_nasabah', $nasabah->id_pengguna_nasabah)
            ->orderByDesc('tgl_pengajuan')
            ->take(5)
            ->get();

        return view('nasabah.dashboard', compact('nasabah', 'saldo', 'transaksiTerakhir', 'penarikanTerakhir'));
    }
}
