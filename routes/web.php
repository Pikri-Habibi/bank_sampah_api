<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Redirect dari URL utama (/) ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest Route (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Authenticated Route (Hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Dashboard -> resources/views/layouts/dashboard-admin.blade.php
    Route::get('/admin/dashboard', function () {
        return view('dashboard-admin');
    })->name('dashboard.admin');

    // Kelola Sampah -> resources/views/layouts/kelola-sampah.blade.php
    Route::get('/kelola-sampah', function () {
        return view('layouts.kelola-sampah');
    })->name('kelola.sampah');

    // Dashboard Petugas
    Route::get('/petugas/dashboard', function () {
        return "Selamat Datang Petugas!";
    })->name('petugas.dashboard');

    // Dashboard Nasabah
    Route::get('/nasabah/dashboard', function () {
        return "Selamat Datang Nasabah!";
    })->name('nasabah.dashboard');
});
