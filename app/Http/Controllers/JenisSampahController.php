<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use Illuminate\Http\Request;

class JenisSampahController extends Controller
{
    public function index()
    {
        $data = JenisSampah::with('harga')->get();

        return response()->json($data);
    }
}