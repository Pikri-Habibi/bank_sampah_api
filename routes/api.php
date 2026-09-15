<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisSampahController;

Route::get('/jenis-sampah', [JenisSampahController::class, 'index']);