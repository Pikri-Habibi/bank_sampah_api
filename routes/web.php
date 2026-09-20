<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NasabahDashboardController;
use App\Http\Controllers\PetugasDashboardController;
use App\Http\Controllers\PetugasSetoranController;
use App\Http\Controllers\PenarikanController;
use App\Http\Controllers\PetugasPenarikanController;

// Redirect dari URL utama (/) ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login route dibuka manual agar redirect sesuai role user yang sudah login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Guest Route (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Authenticated Route (Hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        if (auth()->user()?->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('admin.dashboard-admin');
    })->name('dashboard.admin');

    // Kelola Sampah
    Route::get('/kelola-sampah', function () {
        if (auth()->user()?->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('admin.kelola-sampah');
    })->name('kelola.sampah');

    // Dashboard Petugas
    Route::get('/petugas/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');
    Route::get('/petugas/setoran', [PetugasSetoranController::class, 'create'])->name('petugas.setoran.create');
    Route::post('/petugas/setoran/preview', [PetugasSetoranController::class, 'preview'])->name('petugas.setoran.preview');
    Route::post('/petugas/setoran', [PetugasSetoranController::class, 'store'])->name('petugas.setoran.store');
    Route::match(['GET', 'POST'], '/petugas/penarikan/search', [PetugasPenarikanController::class, 'search'])->name('petugas.penarikan.search');
    Route::post('/petugas/penarikan/{id}/approve', [PetugasPenarikanController::class, 'approve'])->name('petugas.penarikan.approve');

    // Dashboard Nasabah
    Route::get('/nasabah/dashboard', [NasabahDashboardController::class, 'index'])->name('nasabah.dashboard');
    Route::get('/nasabah/penarikan', [PenarikanController::class, 'create'])->name('nasabah.penarikan.create');
    Route::post('/nasabah/penarikan', [PenarikanController::class, 'store'])->name('nasabah.penarikan.store');
});

// Manajemen Pengguna (CRUD) dengan URL /admin/kelola-pengguna
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/kelola-pengguna', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/kelola-pengguna', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/kelola-pengguna/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/kelola-pengguna/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
