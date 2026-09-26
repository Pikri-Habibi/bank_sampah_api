<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\HargaSampah;
use Illuminate\Support\Facades\DB;

class HargaSampahController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $hargaSampah = HargaSampah::with('jenisSampah')
            ->where('status', 1)
            ->orderBy('id_jenis_sampah')
            ->get();

        return view(
            'nasabah.harga-sampah',
            compact('hargaSampah')
        );
    }
}