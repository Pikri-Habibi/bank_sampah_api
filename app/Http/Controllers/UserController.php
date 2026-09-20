<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nasabah;
use App\Models\Petugas;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private function createRoleProfile(User $user, string $role, ?string $name = null): void
    {
        $name = $name ?? $user->name;

        if ($role === 'admin') {
            Admin::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap' => $name,
                    'no_telepon' => '-',
                ]
            );

            return;
        }

        if ($role === 'petugas') {
            Petugas::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap' => $name,
                    'no_telepon' => '-',
                ]
            );

            return;
        }

        if ($role === 'nasabah') {
            Nasabah::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap' => $name,
                    'no_telepon' => '-',
                    'saldo' => 0,
                ]
            );
        }
    }

    private function removeRoleProfiles(User $user): void
    {
        $user->admin()->delete();
        $user->petugas()->delete();
        $user->nasabah()->delete();
    }

    // 1. Menampilkan daftar pengguna
    public function index()
    {
        $users = User::with(['admin', 'petugas', 'nasabah'])->get();
        return view('admin.kelola-pengguna', compact('users'));
    }

    // 2. Menyimpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,nasabah',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 'active',
            ]);

            $this->createRoleProfile($user, $request->role, $request->name);
        });

        return redirect()
            ->back()
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // 3. Update data / role / status pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        DB::transaction(function () use ($request, $user) {
            $currentRole = $user->role;

            $user->update([
                'name' => $request->name,
                'role' => $request->role,
                'status' => $request->status,
            ]);

            if ($currentRole !== $request->role) {
                $this->removeRoleProfiles($user);
            }

            $this->createRoleProfile($user, $request->role, $request->name);
        });

        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // 4. Hapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->isProtected()) {
            return redirect()->back()->withErrors([
                'email' => 'Akun Super Admin tidak dapat dihapus.',
            ]);
        }

        DB::transaction(function () use ($user) {
            $this->removeRoleProfiles($user);
            $user->delete();
        });

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }
}
