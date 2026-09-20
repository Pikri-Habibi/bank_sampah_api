<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
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

            $user = Auth::user();

            if ($user->role === 'admin' || $user->admin) {
                return redirect()->route('dashboard.admin');
            }

            if ($user->role === 'petugas' || $user->petugas) {
                return redirect()->route('petugas.dashboard');
            }

            if ($user->role === 'nasabah' || $user->nasabah) {
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

        return redirect()->route('login');
    }
}
