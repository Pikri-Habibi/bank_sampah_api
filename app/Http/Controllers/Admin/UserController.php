<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Nasabah;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function createRoleProfile(User $user, string $role, string $name, string $phone): void
    {
        if ($role === 'admin') {
            Admin::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap' => $name,
                    'no_telepon' => $phone,
                ]
            );

            return;
        }

        if ($role === 'petugas') {
            Petugas::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap' => $name,
                    'no_telepon' => $phone,
                ]
            );

            return;
        }

        if ($role === 'nasabah') {
            Nasabah::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap' => $name,
                    'no_telepon' => $phone,
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:admin,petugas,nasabah'],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'status' => 'active',
            ]);

            $this->createRoleProfile(
                $user,
                $validated['role'],
                $validated['name'],
                $validated['no_telepon']
            );
        });

        return redirect()
            ->back()
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // 3. Update data / role / status pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'role' => ['required', 'in:admin,petugas,nasabah'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        DB::transaction(function () use ($validated, $user) {
            $currentRole = $user->role;

            $user->update([
                'name' => $validated['name'],
                'role' => $validated['role'],
                'status' => $validated['status'],
            ]);

            if ($currentRole !== $validated['role']) {
                $this->removeRoleProfiles($user);
            }

            $this->createRoleProfile(
                $user,
                $validated['role'],
                $validated['name'],
                $validated['no_telepon']
            );
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
