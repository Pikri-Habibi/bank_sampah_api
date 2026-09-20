<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenarikanController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $nasabah = $user->nasabah;

        return view('nasabah.penarikan.create', compact('nasabah'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nominal' => ['required', 'numeric', 'min:1000'],
        ]);

        $nasabah = $user->nasabah;
        $nominal = (float) $request->nominal;

        if ($nominal > ((float) ($nasabah->saldo ?? 0))) {
            return back()->withErrors([
                'nominal' => 'Saldo Anda tidak mencukupi untuk melakukan penarikan.',
            ]);
        }

        $kode = 'WD-' . date('Ymd') . '-' . str_pad((string) $nasabah->id_pengguna_nasabah, 5, '0', STR_PAD_LEFT) . '-' . rand(100, 999);

        DB::transaction(function () use ($nasabah, $nominal, $kode) {
            Penarikan::create([
                'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
                'nominal' => $nominal,
                'kode_penarikan' => $kode,
                'tgl_pengajuan' => now()->toDateString(),
                'status' => 'pending',
            ]);
        });

        return redirect()->route('nasabah.dashboard')->with('success', 'Pengajuan penarikan berhasil dibuat. Kode: ' . $kode);
    }
}
