<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan pengecekan foreign key sementara agar tidak error saat tabel dikosongkan
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. Kosongkan semua tabel utama (sesuaikan nama tabel jika berbeda)
        \App\Models\Nasabah::truncate();
        \App\Models\Petugas::truncate();
        \App\Models\Admin::truncate();
        User::truncate();
        // Jika ada tabel jenis sampah / harga sampah, kosongkan juga di sini:
        // DB::table('jenis_sampah')->truncate();

        // 3. Nyalakan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 4. Buat satu akun Admin Utama yang permanen
        $adminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@banksampah.com', // Ganti email sesuai keinginan
            'password' => Hash::make('11111111'), // Ganti password sesuai keinginan
            'role' => 'admin',
            'status' => 'active',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'nama_lengkap' => $adminUser->name,
            'no_telepon' => '-',
        ]);
    }
}
