<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_created_user_is_saved_to_users_and_role_table_and_can_login(): void
    {
        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.users.store'), [
            'name' => 'Petugas Baru',
            'email' => 'petugasbaru@example.com',
            'password' => 'password123',
            'role' => 'petugas',
        ]);

        $response->assertRedirect();

        $user = User::where('email', 'petugasbaru@example.com')->first();

        $this->assertNotNull($user);
        $this->assertDatabaseHas('users', [
            'email' => 'petugasbaru@example.com',
            'role' => 'petugas',
            'status' => 'active',
        ]);
        $this->assertDatabaseHas('petugas', [
            'user_id' => $user->id,
            'nama_lengkap' => 'Petugas Baru',
        ]);
        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertTrue(Auth::attempt([
            'email' => 'petugasbaru@example.com',
            'password' => 'password123',
        ]));
    }

    public function test_seeded_super_admin_cannot_be_deleted(): void
    {
        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@banksampah.com',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->actingAs($admin);

        $response = $this->delete(route('admin.users.destroy', $admin->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'email' => 'admin@banksampah.com',
        ]);
    }
}
