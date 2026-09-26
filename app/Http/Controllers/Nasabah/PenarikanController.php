<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
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

        $penarikanList = Penarikan::where(
            'id_pengguna_nasabah',
            $nasabah->id_pengguna_nasabah
        )
        ->orderBy('tgl_pengajuan', 'desc')
        ->orderBy('id_penarikan', 'desc')
        ->get();

        return view(
            'nasabah.penarikan.create',
            compact('nasabah', 'penarikanList')
        );
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

        if (!$nasabah) {
            abort(403, 'Akun ini belum terdaftar sebagai nasabah.');
        }

        $nominal = (float) $request->nominal;

        // Cek saldo
        if ($nominal > ((float) ($nasabah->saldo ?? 0))) {
            return back()->withErrors([
                'nominal' => 'Saldo Anda tidak mencukupi untuk melakukan penarikan.',
            ]);
        }

        // Generate kode verifikasi random 6 digit
        $kode = str_pad(
            (string) random_int(0, 999999),
            6,
            '0',
            STR_PAD_LEFT
        );

        DB::transaction(function () use ($nasabah, $nominal, $kode) {
            Penarikan::create([
                'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
                'nominal' => $nominal,

                // Kode yang sama digunakan sebagai kode penarikan
                // dan kode verifikasi petugas
                'kode_penarikan' => $kode,
                'kode_verifikasi' => $kode,

                'tgl_pengajuan' => now()->toDateString(),
                'status' => 'pending',
            ]);
        });

        return redirect()
            ->route('nasabah.dashboard')
            ->with(
                'success',
                'Pengajuan penarikan berhasil dibuat. Kode verifikasi: ' . $kode
            );
    }

    public function edit($id)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $nasabah = $user->nasabah;

        $penarikan = Penarikan::where(
            'id_penarikan',
            $id
        )
        ->where(
            'id_pengguna_nasabah',
            $nasabah->id_pengguna_nasabah
        )
        ->where('status', 'pending')
        ->firstOrFail();

        return view(
            'nasabah.penarikan.edit',
            compact('nasabah', 'penarikan')
        );
    }


    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'nominal' => ['required', 'numeric', 'min:1000'],
        ]);

        $nasabah = $user->nasabah;

        $penarikan = Penarikan::where(
            'id_penarikan',
            $id
        )
        ->where(
            'id_pengguna_nasabah',
            $nasabah->id_pengguna_nasabah
        )
        ->where('status', 'pending')
        ->firstOrFail();

        $nominal = (float) $request->nominal;

        // Cek saldo
        if ($nominal > ((float) ($nasabah->saldo ?? 0))) {
            return back()->withErrors([
                'nominal' => 'Saldo Anda tidak mencukupi untuk melakukan penarikan.',
            ])->withInput();
        }

        $penarikan->nominal = $nominal;
        $penarikan->save();

        return redirect()
            ->route('nasabah.penarikan.create')
            ->with('success', 'Nominal penarikan berhasil diubah.');
    }


    public function destroy($id)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'nasabah') {
            abort(403, 'Akses ditolak.');
        }

        $nasabah = $user->nasabah;

        $penarikan = Penarikan::where(
            'id_penarikan',
            $id
        )
        ->where(
            'id_pengguna_nasabah',
            $nasabah->id_pengguna_nasabah
        )
        ->where('status', 'pending')
        ->firstOrFail();

        $penarikan->delete();

        return redirect()
            ->route('nasabah.penarikan.create')
            ->with('success', 'Pengajuan penarikan berhasil dihapus.');
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

        $penarikan = Penarikan::where(
            'id_pengguna_nasabah',
            $nasabah->id_pengguna_nasabah
        )
            ->orderByDesc('tgl_pengajuan')
            ->get();

        return view(
            'nasabah.penarikan.penarikan-riwayat',
            compact('nasabah', 'penarikan')
        );
    }
}