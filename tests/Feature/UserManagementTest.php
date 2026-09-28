<?php

namespace Tests\Feature;

use App\Models\HargaSampah;
use App\Models\JenisSampah;
use App\Models\Nasabah;
use App\Models\Penarikan;
use App\Models\Petugas;
use App\Models\Setoran;
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
            'no_telepon' => '081234567801',
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
            'no_telepon' => '081234567801',
        ]);
        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertTrue(Auth::attempt([
            'email' => 'petugasbaru@example.com',
            'password' => 'password123',
        ]));
    }

    public function test_admin_can_update_phone_number_on_user_profile(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Telepon',
            'email' => 'admin.telepon@example.com',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $user = User::factory()->create([
            'name' => 'Nasabah Lama',
            'email' => 'nasabah.lama@example.com',
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $nasabah = Nasabah::create([
            'user_id' => $user->id,
            'nama_lengkap' => 'Nasabah Lama',
            'no_telepon' => '080000000000',
            'saldo' => 0,
        ]);

        $this->actingAs($admin);

        $response = $this->put(route('admin.users.update', $user->id), [
            'name' => 'Nasabah Diperbarui',
            'no_telepon' => '081234567802',
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('nasabah', [
            'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
            'nama_lengkap' => 'Nasabah Diperbarui',
            'no_telepon' => '081234567802',
        ]);
    }

    public function test_admin_user_list_displays_profile_phone_number(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Daftar Telepon',
            'email' => 'admin.daftar.telepon@example.com',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $user = User::factory()->create([
            'name' => 'Nasabah Tampil',
            'email' => 'nasabah.tampil@example.com',
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        Nasabah::create([
            'user_id' => $user->id,
            'nama_lengkap' => 'Nasabah Tampil',
            'no_telepon' => '081234567803',
            'saldo' => 0,
        ]);

        $this->actingAs($admin);

        $response = $this->get(route('admin.users.index'));

        $response->assertSeeText('No. Telepon');
        $response->assertSeeText('081234567803');
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

    public function test_non_admin_login_does_not_follow_stale_admin_intended_url(): void
    {
        $petugas = User::factory()->create([
            'name' => 'Petugas A',
            'email' => 'petugas.a@example.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'active',
        ]);

        session(['url.intended' => route('dashboard.admin')]);

        $response = $this->from('/login')->post(route('login.process'), [
            'email' => 'petugas.a@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('petugas.dashboard'));
    }

    public function test_logout_clears_stale_intended_url_for_next_login(): void
    {
        $petugas = User::factory()->create([
            'name' => 'Petugas B',
            'email' => 'petugas.b@example.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'active',
        ]);

        $this->actingAs($petugas);
        session(['url.intended' => route('dashboard.admin')]);

        $this->post(route('logout'));

        $this->assertNull(session('url.intended'));
    }

    public function test_authenticated_user_visiting_login_redirects_to_own_role_dashboard(): void
    {
        $petugas = User::factory()->create([
            'name' => 'Petugas C',
            'email' => 'petugas.c@example.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'active',
        ]);

        $this->actingAs($petugas);

        $response = $this->get(route('login'));

        $response->assertRedirect(route('petugas.dashboard'));
    }

    public function test_public_registration_creates_only_a_nasabah_account_and_profile(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Nasabah Baru',
            'no_telepon' => '081234567890',
            'email' => 'nasabah.baru@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'admin',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'name' => 'Nasabah Baru',
            'email' => 'nasabah.baru@example.com',
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $user = User::where('email', 'nasabah.baru@example.com')->firstOrFail();

        $this->assertDatabaseHas('nasabah', [
            'user_id' => $user->id,
            'nama_lengkap' => 'Nasabah Baru',
            'no_telepon' => '081234567890',
            'saldo' => 0,
        ]);
        $this->assertDatabaseMissing('admin', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('petugas', ['user_id' => $user->id]);
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    public function test_public_registration_requires_confirmed_password(): void
    {
        $response = $this->from(route('register'))->post(route('register.store'), [
            'name' => 'Nasabah Invalid',
            'no_telepon' => '081234567890',
            'email' => 'nasabah.invalid@example.com',
            'password' => 'password123',
            'password_confirmation' => 'different-password',
        ]);

        $response->assertRedirectBackWithErrors(['password']);
        $this->assertDatabaseMissing('users', [
            'email' => 'nasabah.invalid@example.com',
        ]);
    }

    public function test_session_expires_when_browser_is_closed(): void
    {
        $this->assertTrue(config('session.expire_on_close'));
    }

    public function test_logout_clears_session_cookie(): void
    {
        $user = User::factory()->create([
            'name' => 'Petugas D',
            'email' => 'petugas.d@example.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'active',
        ]);

        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $response->assertCookieExpired(config('session.cookie'));
    }

    public function test_petugas_can_calculate_setoran_and_credit_nasabah_balance(): void
    {
        $petugasUser = User::factory()->create([
            'name' => 'Petugas Sampah',
            'email' => 'petugas.sampah@example.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'active',
        ]);

        $petugas = Petugas::create([
            'user_id' => $petugasUser->id,
            'nama_lengkap' => 'Petugas Sampah',
            'no_telepon' => '081111111111',
        ]);

        $nasabahUser = User::factory()->create([
            'name' => 'Nasabah Test',
            'email' => 'nasabah.test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $nasabah = Nasabah::create([
            'user_id' => $nasabahUser->id,
            'nama_lengkap' => 'Nasabah Test',
            'no_telepon' => '082222222222',
            'saldo' => 0,
        ]);

        $jenis = JenisSampah::create([
            'nama_sampah' => 'Kertas',
            'status' => 'aktif',
        ]);

        HargaSampah::create([
            'id_jenis_sampah' => $jenis->id_jenis_sampah,
            'id_pengguna_admin' => 1,
            'harga_per_kg' => 5000,
            'tanggal_berlaku' => now()->toDateString(),
            'status' => 'aktif',
        ]);

        $this->actingAs($petugasUser);

        $response = $this->post(route('petugas.setoran.store'), [
            'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
            'id_pengguna_petugas' => $petugas->id_pengguna_petugas,
            'id_jenis_sampah' => $jenis->id_jenis_sampah,
            'berat_kg' => 2.5,
        ]);

        $response->assertRedirect(route('petugas.dashboard'));

        $setoran = Setoran::where('id_pengguna_nasabah', $nasabah->id_pengguna_nasabah)->first();
        $this->assertNotNull($setoran);
        $this->assertDatabaseHas('detail_setoran', [
            'id_setoran' => $setoran->id_setoran,
            'id_jenis_sampah' => $jenis->id_jenis_sampah,
            'total_berat' => '2.50',
            'harga_per_kg' => '5000.00',
        ]);

        $nasabah->refresh();
        $this->assertEquals(12500, (float) $nasabah->saldo);
    }

    public function test_petugas_can_search_and_verify_withdrawal_code_and_reduce_nasabah_balance(): void
    {
        $petugasUser = User::factory()->create([
            'name' => 'Petugas Cek Penarikan',
            'email' => 'petugas.penarikan@example.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'active',
        ]);

        Petugas::create([
            'user_id' => $petugasUser->id,
            'nama_lengkap' => 'Petugas Cek Penarikan',
            'no_telepon' => '081234567890',
        ]);

        $nasabahUser = User::factory()->create([
            'name' => 'Nasabah Penarikan',
            'email' => 'nasabah.penarikan@example.com',
            'password' => Hash::make('password123'),
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $nasabah = Nasabah::create([
            'user_id' => $nasabahUser->id,
            'nama_lengkap' => 'Nasabah Penarikan',
            'no_telepon' => '083333333334',
            'saldo' => 250000,
        ]);

        $penarikan = Penarikan::create([
            'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
            'nominal' => 100000,
            'kode_penarikan' => '123456',
            'kode_verifikasi' => '123456',
            'tgl_pengajuan' => now()->toDateString(),
            'status' => 'pending',
        ]);

        $this->actingAs($petugasUser);

        $searchResponse = $this->post(route('petugas.penarikan.search'), [
            'kode' => $penarikan->kode_verifikasi,
        ]);

        $searchResponse->assertStatus(200);
        $searchResponse->assertSeeText('Nasabah Penarikan');
        $searchResponse->assertSeeText('Rp 100.000');
        $searchResponse->assertSeeText('Verifikasi Penarikan');

        $penarikan->refresh();
        $this->assertSame('pending', $penarikan->status);
        $this->assertSame(250000.0, (float) $nasabah->fresh()->saldo);

        $verifyResponse = $this->post(route('petugas.penarikan.verify', $penarikan->id_penarikan), [
            'kode_verifikasi' => $penarikan->kode_verifikasi,
        ]);

        $verifyResponse->assertRedirect();

        $penarikan->refresh();
        $this->assertEquals('approved', $penarikan->status);

        $nasabah->refresh();
        $this->assertEquals(150000, (float) $nasabah->saldo);
    }

    public function test_petugas_can_view_transaction_history_with_nasabah_and_datetime(): void
    {
        $petugasUser = User::factory()->create([
            'name' => 'Petugas Riwayat',
            'email' => 'petugas.riwayat@example.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'status' => 'active',
        ]);

        $petugas = Petugas::create([
            'user_id' => $petugasUser->id,
            'nama_lengkap' => 'Petugas Riwayat',
            'no_telepon' => '081223344556',
        ]);

        $nasabahUser = User::factory()->create([
            'name' => 'Nasabah Riwayat',
            'email' => 'nasabah.riwayat@example.com',
            'password' => Hash::make('password123'),
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $nasabah = Nasabah::create([
            'user_id' => $nasabahUser->id,
            'nama_lengkap' => 'Nasabah Riwayat',
            'no_telepon' => '082233445566',
            'saldo' => 0,
        ]);

        $jenis = JenisSampah::create([
            'nama_sampah' => 'Botol Plastik',
            'status' => 'aktif',
        ]);

        HargaSampah::create([
            'id_jenis_sampah' => $jenis->id_jenis_sampah,
            'id_pengguna_admin' => 1,
            'harga_per_kg' => 6000,
            'tanggal_berlaku' => now()->toDateString(),
            'status' => 'aktif',
        ]);

        $setoran = Setoran::create([
            'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
            'id_pengguna_petugas' => $petugas->id_pengguna_petugas,
            'tgl_setoran' => now()->toDateString(),
            'status' => 'approved',
        ]);

        $setoran->detailSetoran()->create([
            'id_jenis_sampah' => $jenis->id_jenis_sampah,
            'total_berat' => 2,
            'harga_per_kg' => 6000,
        ]);

        Penarikan::create([
            'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
            'nominal' => 50000,
            'kode_penarikan' => 'WD-20260929-00001-456',
            'tgl_pengajuan' => now()->toDateString(),
            'status' => 'rejected',
        ]);

        $this->actingAs($petugasUser);

        $response = $this->get(route('petugas.transaksi.history'));

        $response->assertOk();
        $response->assertSeeText('Riwayat Transaksi');
        $response->assertSeeText('Nasabah Riwayat');
        $response->assertSeeText('Petugas Riwayat');
        $response->assertSeeText('Setoran');
        $response->assertDontSeeText('Rejected');
        $response->assertSeeText($setoran->created_at ? $setoran->created_at->format('d/m/Y') : now()->format('d/m/Y'));
    }

    public function test_nasabah_can_create_withdrawal_code_when_balance_is_sufficient(): void
    {
        $nasabahUser = User::factory()->create([
            'name' => 'Nasabah Tarik',
            'email' => 'nasabah.tarik@example.com',
            'password' => Hash::make('password123'),
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $nasabah = Nasabah::create([
            'user_id' => $nasabahUser->id,
            'nama_lengkap' => 'Nasabah Tarik',
            'no_telepon' => '083333333333',
            'saldo' => 250000,
        ]);

        $this->actingAs($nasabahUser);

        $response = $this->post(route('nasabah.penarikan.store'), [
            'nominal' => 100000,
        ]);

        $response->assertRedirect(route('nasabah.dashboard'));

        $penarikan = Penarikan::where('id_pengguna_nasabah', $nasabah->id_pengguna_nasabah)->first();
        $this->assertNotNull($penarikan);
        $this->assertEquals('pending', $penarikan->status);
        $this->assertSame($penarikan->kode_penarikan, $penarikan->kode_verifikasi);
        $this->assertSame(6, strlen((string) $penarikan->kode_verifikasi));
        $this->assertEquals(100000, (float) $penarikan->nominal);
    }

    public function test_over_balance_withdrawal_is_not_recorded_and_does_not_change_balance(): void
    {
        $nasabahUser = User::factory()->create([
            'name' => 'Nasabah Saldo Kurang',
            'email' => 'nasabah.saldo.kurang@example.com',
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $nasabah = Nasabah::create([
            'user_id' => $nasabahUser->id,
            'nama_lengkap' => 'Nasabah Saldo Kurang',
            'no_telepon' => '081234567891',
            'saldo' => 15000,
        ]);

        $this->actingAs($nasabahUser);

        $response = $this->from(route('nasabah.penarikan.create'))
            ->post(route('nasabah.penarikan.store'), [
                'nominal' => 25000,
            ]);

        $response->assertRedirectBackWithErrors([
            'nominal' => 'Saldo Anda tidak mencukupi untuk melakukan penarikan.',
        ]);
        $this->assertDatabaseMissing('penarikan', [
            'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
            'nominal' => 25000,
        ]);

        $nasabah->refresh();
        $this->assertSame(15000.0, (float) $nasabah->saldo);
    }

    public function test_withdrawal_stays_pending_when_balance_becomes_insufficient_before_approval(): void
    {
        $petugasUser = User::factory()->create([
            'name' => 'Petugas Penarikan Kurang Saldo',
            'email' => 'petugas.penarikan.kurang@example.com',
            'role' => 'petugas',
            'status' => 'active',
        ]);

        $nasabahUser = User::factory()->create([
            'name' => 'Nasabah Penarikan Kurang Saldo',
            'email' => 'nasabah.penarikan.kurang@example.com',
            'role' => 'nasabah',
            'status' => 'active',
        ]);

        $nasabah = Nasabah::create([
            'user_id' => $nasabahUser->id,
            'nama_lengkap' => 'Nasabah Penarikan Kurang Saldo',
            'no_telepon' => '081234567892',
            'saldo' => 10000,
        ]);

        $penarikan = Penarikan::create([
            'id_pengguna_nasabah' => $nasabah->id_pengguna_nasabah,
            'nominal' => 20000,
            'kode_penarikan' => 'WD-20260929-00002-456',
            'kode_verifikasi' => '654321',
            'tgl_pengajuan' => now()->toDateString(),
            'status' => 'pending',
        ]);

        $this->actingAs($petugasUser);

        $response = $this->from(route('petugas.penarikan.index'))
            ->post(route('petugas.penarikan.verify', $penarikan->id_penarikan), [
                'kode_verifikasi' => $penarikan->kode_verifikasi,
            ]);

        $response->assertRedirectBackWithErrors([
            'nominal' => 'Saldo nasabah tidak mencukupi.',
        ]);
        $this->assertDatabaseHas('penarikan', [
            'id_penarikan' => $penarikan->id_penarikan,
            'status' => 'pending',
        ]);
    }
}
