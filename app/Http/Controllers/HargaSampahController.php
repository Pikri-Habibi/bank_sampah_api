<?php

namespace App\Http\Controllers;

use App\Models\HargaSampah;
use Illuminate\Http\Request;

class HargaSampahController extends Controller
{
    public function index()
    {
        $hargaSampah = HargaSampah::with('jenisSampah')->get();

        return response()->json($hargaSampah);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_sampah' => 'required|exists:jenis_sampah,id_jenis_sampah',
            'harga_per_kg' => 'required|numeric|min:0',
        ]);

        $harga = HargaSampah::create([
            'id_jenis_sampah' => $request->id_jenis_sampah,
            'harga_per_kg' => $request->harga_per_kg,
            'tanggal_berlaku' => now(),
        ]);

        return response()->json([
            'message' => 'Harga sampah berhasil ditambahkan',
            'data' => $harga
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $harga = HargaSampah::findOrFail($id);

        $request->validate([
            'nama_sampah' => 'required|string|max:255|unique:jenis_sampah,nama_sampah,' . $harga->id_jenis_sampah . ',id_jenis_sampah',
            'harga_per_kg' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $harga->jenisSampah->update([
            'nama_sampah' => $request->nama_sampah,
        ]);

        $harga->update([
            'harga_per_kg' => $request->harga_per_kg,
            'status' => $request->status,
            'tanggal_berlaku' => now(),
        ]);

        return response()->json([
            'message' => 'Data sampah berhasil diperbarui',
            'data' => $harga->load('jenisSampah')
        ]);
    }
    public function destroy($id)
    {
        $harga = HargaSampah::findOrFail($id);

        $jenisSampah = $harga->jenisSampah;

        $harga->delete();

        if ($jenisSampah) {
            $jenisSampah->delete();
        }

        return response()->json([
            'message' => 'Jenis sampah dan harga berhasil dihapus'
        ]);
    }
}