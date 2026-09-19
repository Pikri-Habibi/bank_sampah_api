<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Petugas;
use App\Models\Nasabah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Dummy Admin
        $userAdmin = User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Admin::create([
            'user_id' => $userAdmin->id,
            'nama_lengkap' => 'Administrator Bank Sampah',
            'no_telepon' => '081234567890',
        ]);

        // 2. Buat Akun Dummy Petugas
        $userPetugas = User::create([
            'name' => 'Petugas Lapangan',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Petugas::create([
            'user_id' => $userPetugas->id,
            'nama_lengkap' => 'Budi Petugas',
            'no_telepon' => '081298765432',
        ]);

        // 3. Buat Akun Dummy Nasabah
        $userNasabah = User::create([
            'name' => 'Nasabah Setia',
            'email' => 'nasabah@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Nasabah::create([
            'user_id' => $userNasabah->id,
            'nama_lengkap' => 'Siti Nasabah',
            'no_telepon' => '085678901234',
            'saldo' => 50000.00,
        ]);
    }
}
