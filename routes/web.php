<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard-admin', function () {
    return view('dashboard-admin');
});

Route::get('/kelola-sampah', function () {
    return view('kelola-sampah');
});