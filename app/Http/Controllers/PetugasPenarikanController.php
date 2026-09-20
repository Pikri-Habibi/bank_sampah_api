<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Nasabah;
use Illuminate\Http\Request;

class PetugasPenarikanController extends Controller
{
    public function search(Request $request)
    {
        if ($request->isMethod('GET')) {
            return redirect()->route('petugas.dashboard');
        }

        $request->validate([
            'kode' => 'required|string',
        ]);

        $penarikan = Penarikan::with('nasabah.user')
            ->where('kode_penarikan', $request->kode)
            ->first();

        if (!$penarikan) {
            return back()->withErrors(['kode' => 'Kode penarikan tidak ditemukan.']);
        }

        return view('petugas.penarikan.detail', compact('penarikan'));
    }

    public function approve($id)
    {
        $penarikan = Penarikan::findOrFail($id);

        if ($penarikan->status !== 'pending') {
            return back()->withErrors(['status' => 'Penarikan ini sudah diproses.']);
        }

        $nasabah = $penarikan->nasabah;

        if (!$nasabah) {
            return back()->withErrors(['status' => 'Nasabah tidak ditemukan.']);
        }

        if ((float) ($nasabah->saldo ?? 0) < (float) $penarikan->nominal) {
            $penarikan->status = 'rejected';
            $penarikan->save();

            return back()->withErrors(['nominal' => 'Saldo nasabah tidak cukup untuk diproses.']);
        }

        $nasabah->saldo = (float) $nasabah->saldo - (float) $penarikan->nominal;
        $nasabah->save();

        $penarikan->status = 'approved';
        $penarikan->save();

        return redirect()->back()->with('success', 'Penarikan berhasil disetujui.');
    }
}
