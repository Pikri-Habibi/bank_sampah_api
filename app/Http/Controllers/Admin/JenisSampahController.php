<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaSampah;
use App\Models\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisSampahController extends Controller
{
    public function index()
    {
        $data = JenisSampah::with('harga')->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_sampah' => 'required|string|max:255',
                'harga_per_kg' => 'required|numeric|max:999999',
                'status' => 'required|boolean',
            ],
            [
                'nama_sampah.required' => 'Nama sampah wajib diisi.',
                'harga_per_kg.required' => 'Harga per kg wajib diisi.',
                'harga_per_kg.numeric' => 'Harga per kg harus berupa angka.',
                'harga_per_kg.max' => 'Harga per kg tidak boleh lebih dari Rp 999.999.',
                'status.required' => 'Status wajib dipilih.',
                'status.boolean' => 'Status harus berupa Aktif atau Nonaktif.',
            ]
        );

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
        $request->validate(
            [
                'nama_sampah' => 'required|string|max:255|regex:/^[A-Za-z0-9_() ]+$/',
                'harga_per_kg' => 'required|numeric|min:1|max:999999',
                'status' => 'required|boolean',
            ],
            [
                'nama_sampah.required' => 'Nama sampah wajib diisi.',
                'nama_sampah.regex' => 'Nama sampah hanya boleh berisi huruf, angka, spasi, underscore (_) dan tanda kurung ().',
                'harga_per_kg.required' => 'Harga per kg wajib diisi.',
                'harga_per_kg.numeric' => 'Harga per kg harus berupa angka.',
                'harga_per_kg.min' => 'Harga per kg harus lebih dari Rp 0.',
                'harga_per_kg.max' => 'Harga per kg tidak boleh lebih dari Rp 999.999.',
                'status.required' => 'Status wajib dipilih.',
                'status.boolean' => 'Status harus berupa Aktif atau Nonaktif.',
            ]
        );

        // Cek apakah nama jenis sampah sudah ada
        $sudahAda = JenisSampah::whereRaw(
            'LOWER(nama_sampah) = ?',
            [strtolower($request->nama_sampah)]
        )->exists();

        if ($sudahAda) {
            return response()->json([
                'message' => 'Jenis sampah sudah tersedia.'
            ], 422);
        }

        return DB::transaction(function () use ($request) {

            // Simpan jenis sampah baru
            $jenisSampah = JenisSampah::create([
                'nama_sampah' => $request->nama_sampah,
                'status' => $request->status,
            ]);

            // Simpan harga untuk jenis sampah tersebut
            $hargaSampah = HargaSampah::create([
                'id_jenis_sampah' => $jenisSampah->id_jenis_sampah,
                'harga_per_kg' => $request->harga_per_kg,
                'tanggal_berlaku' => now(),
                'status' => $request->status,
            ]);

            return response()->json([
                'message' => 'Jenis sampah berhasil ditambahkan',
                'data' => [
                    'jenis_sampah' => $jenisSampah,
                    'harga_sampah' => $hargaSampah,
                ]
            ], 201);
        });
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_sampah' => 'required|string|max:255|regex:/^[A-Za-z0-9_() ]+$/',
                'harga_per_kg' => 'required|numeric|min:1|max:999999',
                'status' => 'required|boolean',
            ],
            [
                'nama_sampah.required' => 'Nama sampah wajib diisi.',
                'nama_sampah.regex' => 'Nama sampah hanya boleh berisi huruf, angka, spasi, underscore (_) dan tanda kurung ().',
                'harga_per_kg.required' => 'Harga per kg wajib diisi.',
                'harga_per_kg.numeric' => 'Harga per kg harus berupa angka.',
                'harga_per_kg.min' => 'Harga per kg harus lebih dari Rp 0.',
                'harga_per_kg.max' => 'Harga per kg tidak boleh lebih dari Rp 999.999.',
                'status.required' => 'Status wajib dipilih.',
                'status.boolean' => 'Status harus berupa Aktif atau Nonaktif.',
            ]
        );

        $jenisSampah = JenisSampah::findOrFail($id);

        // Cek duplikat, tetapi abaikan data yang sedang diedit
        $sudahAda = JenisSampah::whereRaw(
            'LOWER(nama_sampah) = ?',
            [strtolower($request->nama_sampah)]
        )
        ->where('id_jenis_sampah', '!=', $id)
        ->exists();

        if ($sudahAda) {
            return response()->json([
                'message' => 'Jenis sampah sudah tersedia.'
            ], 422);
        }

        return DB::transaction(function () use ($request, $jenisSampah) {

            // Update jenis sampah
            $jenisSampah->update([
                'nama_sampah' => $request->nama_sampah,
                'status' => $request->status,
            ]);

            // Ambil harga yang dimiliki jenis sampah ini
            $hargaSampah = $jenisSampah->harga()->latest('id_harga')->first();

            if ($hargaSampah) {
                $hargaSampah->update([
                    'harga_per_kg' => $request->harga_per_kg,
                    'status' => $request->status,
                    'tanggal_berlaku' => now(),
                ]);
            }

            return response()->json([
                'message' => 'Jenis sampah berhasil diperbarui',
                'data' => [
                    'jenis_sampah' => $jenisSampah,
                    'harga_sampah' => $hargaSampah,
                ]
            ]);
        });
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