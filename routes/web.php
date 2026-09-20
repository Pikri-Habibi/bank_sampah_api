<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard-admin');
    })->name('dashboard.admin');

    // Kelola Sampah
    Route::get('/kelola-sampah', function () {
        return view('admin.kelola-sampah');
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

// Manajemen Pengguna (CRUD) dengan URL /admin/kelola-pengguna
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/kelola-pengguna', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/kelola-pengguna', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/kelola-pengguna/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/kelola-pengguna/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');


});
