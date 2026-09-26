<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Penarikan;
use App\Models\Notifikasi;
use App\Models\Nasabah;
use Illuminate\Http\Request;

class PetugasPenarikanController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | PENGAJUAN PENDING
        |--------------------------------------------------------------------------
        */

        $penarikanPending = Penarikan::with('nasabah.user')
            ->where('status', 'pending')
            ->orderBy('tgl_pengajuan', 'desc')
            ->orderBy('id_penarikan', 'desc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RIWAYAT PENARIKAN YANG SUDAH DIVERIFIKASI
        |--------------------------------------------------------------------------
        */

        $query = Penarikan::with([
            'nasabah.user',
            'petugas'
        ])
            ->where('status', 'approved');


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tanggal_mulai')) {

            $query->whereDate(
                'tanggal_verifikasi',
                '>=',
                $request->tanggal_mulai
            );

        }


        if ($request->filled('tanggal_akhir')) {

            $query->whereDate(
                'tanggal_verifikasi',
                '<=',
                $request->tanggal_akhir
            );

        }


        /*
        |--------------------------------------------------------------------------
        | URUTAN RIWAYAT
        |--------------------------------------------------------------------------
        */

        $penarikanSelesai = $query
            ->orderBy('tanggal_verifikasi', 'desc')
            ->orderBy('id_penarikan', 'desc')
            ->get();


        return view(
            'petugas.penarikan.index',
            compact(
                'penarikanPending',
                'penarikanSelesai'
            )
        );
    }
    
    public function search(Request $request)
    {
        if ($request->isMethod('GET')) {
            return redirect()->route('petugas.dashboard');
        }

        $request->validate([
            'kode' => 'required|string',
        ]);

        $penarikan = Penarikan::with('nasabah.user')
            ->where('kode_verifikasi', $request->kode)
            ->where('status', 'pending')
            ->first();

        if (!$penarikan) {
            return back()->withErrors([
                'kode' => 'Kode verifikasi tidak ditemukan atau penarikan sudah diproses.'
            ]);
        }

        return view('petugas.penarikan.detail', compact('penarikan'));
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'kode_verifikasi' => 'required|string',
        ]);

        $penarikan = Penarikan::with('nasabah')
            ->findOrFail($id);

        if ($penarikan->status !== 'pending') {
            return back()->withErrors([
                'status' => 'Penarikan ini sudah diproses.'
            ]);
        }

        if ($penarikan->kode_verifikasi !== $request->kode_verifikasi) {
            return back()->withErrors([
                'kode_verifikasi' => 'Kode verifikasi salah.'
            ]);
        }

        $nasabah = $penarikan->nasabah;

        if (!$nasabah) {
            return back()->withErrors([
                'status' => 'Nasabah tidak ditemukan.'
            ]);
        }

        if ((float) $nasabah->saldo < (float) $penarikan->nominal) {
            return back()->withErrors([
                'nominal' => 'Saldo nasabah tidak mencukupi.'
            ]);
        }

        $nasabah->saldo -= $penarikan->nominal;
        $nasabah->save();

        $penarikan->status = 'approved';
        $penarikan->id_petugas = auth()->user()->id;
        $penarikan->tanggal_verifikasi = now();
        $penarikan->save();

        Notifikasi::create([
            'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
            'judul' => 'Penarikan Disetujui',
            'pesan' => 'Pengajuan penarikan sebesar Rp ' .
                number_format((float) $penarikan->nominal, 0, ',', '.') .
                ' telah disetujui oleh petugas.',
            'tipe' => 'penarikan',
            'dibaca' => false,
        ]);

        return redirect()
            ->route('petugas.penarikan.index')
            ->with('success', 'Penarikan berhasil diverifikasi.');
    }
}
