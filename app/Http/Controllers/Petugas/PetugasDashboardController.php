<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Penarikan;
use App\Models\Setoran;
use Illuminate\Support\Facades\DB;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'petugas') {
            abort(403, 'Akses ditolak.');
        }

        $totalNasabah = Nasabah::count();
        $totalSaldo = (float) Nasabah::sum('saldo');

        $pendingPenarikan = Penarikan::where('status', 'pending')->count();
        $transaksiDisetujui = Setoran::where('status', 'approved')->count();

        $setoranPerBulan = DB::table('setoran as s')
            ->join('detail_setoran as ds', 'ds.id_setoran', '=', 's.id_setoran')
            ->selectRaw("DATE_FORMAT(s.tgl_setoran, '%Y-%m') as bulan, SUM(ds.total_berat * ds.harga_per_kg) as total_nilai")
            ->groupByRaw("DATE_FORMAT(s.tgl_setoran, '%Y-%m')")
            ->orderBy('bulan', 'asc')
            ->get();

        $jumlahTransaksiPerBulan = DB::table('setoran')
            ->selectRaw("DATE_FORMAT(tgl_setoran, '%Y-%m') as bulan, COUNT(*) as total_transaksi")
            ->groupByRaw("DATE_FORMAT(tgl_setoran, '%Y-%m')")
            ->orderBy('bulan', 'asc')
            ->get();

        return view('petugas.dashboard', compact(
            'totalNasabah',
            'totalSaldo',
            'pendingPenarikan',
            'transaksiDisetujui',
            'setoranPerBulan',
            'jumlahTransaksiPerBulan'
        ));
    }
}
