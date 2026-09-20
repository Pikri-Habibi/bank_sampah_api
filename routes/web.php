<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasSetoranController;

Route::get('/dashboard-admin', function () {
    return view('dashboard-admin');
})->name('dashboard.admin');

Route::get('/kelola-sampah', function () {
    return view('kelola-sampah');
})->name('kelola.sampah');


// ==============================
// PETUGAS - SETORAN SAMPAH
// ==============================

Route::middleware('auth')->group(function () {

    Route::get('/petugas/setoran', [PetugasSetoranController::class, 'create'])
        ->name('petugas.setoran.create');

    Route::post('/petugas/setoran', [PetugasSetoranController::class, 'store'])
        ->name('petugas.setoran.store');

});