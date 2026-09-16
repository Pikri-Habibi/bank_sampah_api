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
        $request->validate([
            'harga_per_kg' => 'required|numeric|min:0',
        ]);

        $harga = HargaSampah::findOrFail($id);

        $harga->update([
            'harga_per_kg' => $request->harga_per_kg,
            'tanggal_berlaku' => now(),
        ]);

        return response()->json([
            'message' => 'Harga sampah berhasil diperbarui',
            'data' => $harga
        ]);
    }
    public function destroy($id)
    {
        $harga = HargaSampah::findOrFail($id);

        $harga->delete();

        return response()->json([
            'message' => 'Harga sampah berhasil dihapus'
        ]);
    }
}