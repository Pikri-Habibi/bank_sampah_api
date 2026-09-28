<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

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

    public function showRegistrationForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('login');
        }

        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($validated): void {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'nasabah',
                'status' => 'active',
            ]);

            Nasabah::create([
                'user_id' => $user->id,
                'nama_lengkap' => $validated['name'],
                'no_telepon' => $validated['no_telepon'],
                'saldo' => 0,
            ]);
        });

        return redirect()
            ->route('login')
            ->with('success', 'Pendaftaran berhasil. Silakan masuk dengan akun nasabah Anda.');
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
