<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            }

            if ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }

            if ($user->role === 'nasabah') {
                return redirect()->route('nasabah.dashboard');
            }
        }

        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->forget('url.intended');

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            }

            if ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }

            if ($user->role === 'nasabah') {
                return redirect()->route('nasabah.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Akun tidak memiliki hak akses role.']);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        $request->session()->forget('url.intended');

        Cookie::queue(Cookie::forget(config('session.cookie')));

        return redirect()->route('login');
    }
}
