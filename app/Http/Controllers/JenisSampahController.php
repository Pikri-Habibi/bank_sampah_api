<?php

namespace App\Http\Controllers;

use App\Models\HargaSampah;
use Illuminate\Support\Facades\DB;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class JenisSampahController extends Controller
{
    public function index()
    {
        $data = JenisSampah::with('harga')->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sampah' => 'required|string|max:255',
        ]);

        $sudahAda = JenisSampah::where(
            'nama_sampah',
            $request->nama_sampah
        )->exists();

        if ($sudahAda) {
            return response()->json([
                'message' => 'Jenis sampah sudah terdaftar.'
            ], 422);
        }

        $data = JenisSampah::create([
            'nama_sampah' => $request->nama_sampah,
        ]);

        return response()->json([
            'message' => 'Jenis sampah berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function storeWithHarga(Request $request)
    {
        $request->validate([
            'nama_sampah' => 'required|string|max:255',
            'harga_per_kg' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($request) {

            // Buat jenis sampah baru
            $jenisSampah = JenisSampah::create([
                'nama_sampah' => $request->nama_sampah,
            ]);

            // Buat harga untuk jenis sampah tersebut
            $hargaSampah = HargaSampah::create([
                'id_jenis_sampah' => $jenisSampah->id_jenis_sampah,
                'harga_per_kg' => $request->harga_per_kg,
                'tanggal_berlaku' => now(),
            ]);

            return response()->json([
                'message' => 'Jenis sampah dan harga berhasil ditambahkan',
                'data' => [
                    'jenis_sampah' => $jenisSampah,
                    'harga_sampah' => $hargaSampah,
                ]
            ], 201);
        });
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sampah' => 'required|string|max:255',
        ]);

        $jenisSampah = JenisSampah::findOrFail($id);

        $jenisSampah->update([
            'nama_sampah' => $request->nama_sampah,
        ]);

        return response()->json([
            'message' => 'Jenis sampah berhasil diperbarui',
            'data' => $jenisSampah
        ]);
    }
    public function destroy($id)
    {
        $jenisSampah = JenisSampah::findOrFail($id);

        if ($jenisSampah->harga()->exists()) {
            return response()->json([
                'message' => 'Jenis sampah tidak bisa dihapus karena masih memiliki data harga'
            ], 422);
        }

        $jenisSampah->delete();

        return response()->json([
            'message' => 'Jenis sampah berhasil dihapus'
        ]);
    }
}