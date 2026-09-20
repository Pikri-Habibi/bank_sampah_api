<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-admin', function () {
    return view('dashboard-admin');
})->name('dashboard.admin');

Route::get('/kelola-sampah', function () {
    return view('kelola-sampah');
})->name('kelola.sampah');

Route::view('/setor-sampah', 'setor-sampah');