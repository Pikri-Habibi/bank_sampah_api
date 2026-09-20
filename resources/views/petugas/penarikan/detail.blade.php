<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penarikan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7fb; margin: 0; padding: 24px; }
        .container { max-width: 700px; margin: 0 auto; background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .row { display: flex; justify-content: space-between; gap: 12px; padding: 12px 0; border-bottom: 1px solid #e5e7eb; }
        .label { color: #6b7280; }
        .btn { display: inline-block; background: #0f766e; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; border: none; cursor: pointer; }
        .btn-danger { background: #dc2626; }
        .btn-secondary { background: #2563eb; }
        .error { background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Penarikan</h2>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div style="background:#dcfce7;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <span class="label">Kode Penarikan</span>
            <strong>{{ $penarikan->kode_penarikan }}</strong>
        </div>
        <div class="row">
            <span class="label">Nama Nasabah</span>
            <strong>{{ $penarikan->nasabah->nama_lengkap ?? ($penarikan->nasabah->user->name ?? '-') }}</strong>
        </div>
        <div class="row">
            <span class="label">Nomor Telepon</span>
            <strong>{{ $penarikan->nasabah->no_telepon ?? '-' }}</strong>
        </div>
        <div class="row">
            <span class="label">Nominal Pengajuan</span>
            <strong>Rp {{ number_format((float) $penarikan->nominal, 0, ',', '.') }}</strong>
        </div>
        <div class="row">
            <span class="label">Saldo Saat Ini</span>
            <strong>Rp {{ number_format((float) ($penarikan->nasabah->saldo ?? 0), 0, ',', '.') }}</strong>
        </div>
        <div class="row">
            <span class="label">Saldo Setelah Validasi</span>
            <strong>Rp {{ number_format((float) ($penarikan->nasabah->saldo ?? 0) - (float) $penarikan->nominal, 0, ',', '.') }}</strong>
        </div>
        <div class="row">
            <span class="label">Status</span>
            <strong>{{ ucfirst($penarikan->status ?? 'pending') }}</strong>
        </div>

        @if(($penarikan->status ?? 'pending') === 'pending')
            <div style="margin-top: 20px; display:flex; gap:10px; flex-wrap:wrap;">
                <form action="{{ route('petugas.penarikan.approve', $penarikan->id_penarikan) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">Setujui Penarikan</button>
                </form>
                <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>
        @else
            <div style="margin-top: 20px;">
                <a href="{{ route('petugas.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        @endif
    </div>
</body>
</html>
