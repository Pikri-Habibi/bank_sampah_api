<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisSampahController; 
use App\Http\Controllers\HargaSampahController;

Route::get('/jenis-sampah', [JenisSampahController::class, 'index']);

Route::post('/jenis-sampah', [JenisSampahController::class, 'store']);

Route::put('/jenis-sampah/{id}', [JenisSampahController::class, 'update']);

Route::delete('/jenis-sampah/{id}', [JenisSampahController::class, 'destroy']);

Route::post('/harga-sampah', [HargaSampahController::class, 'store']);

Route::get('/harga-sampah', [HargaSampahController::class, 'index']);

Route::put('/harga-sampah/{id}', [HargaSampahController::class, 'update']);

Route::delete('/harga-sampah/{id}', [HargaSampahController::class, 'destroy']);