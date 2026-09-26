<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
    <title>Preview Setoran</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7fb; margin: 0; padding: 24px; }
        .container { max-width: 700px; margin: 0 auto; background:white; padding:24px; border-radius:12px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .row { display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #e5e7eb; }
        .btn { display:inline-block; margin-top:16px; padding:10px 16px; background:#0f766e; color:white; text-decoration:none; border-radius:8px; }
        .muted { color:#6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Preview Setoran</h2>

        <div class="row"><strong>Nasabah</strong><span>{{ $nasabah->nama_lengkap }}</span></div>
        <div class="row"><strong>Jenis Sampah</strong><span>{{ $harga->jenisSampah->nama_sampah ?? 'Jenis Sampah' }}</span></div>
        <div class="row"><strong>Harga / kg</strong><span>Rp {{ number_format($harga->harga_per_kg, 0, ',', '.') }}</span></div>
        <div class="row"><strong>Total</strong><span>Rp {{ number_format($total, 0, ',', '.') }}</span></div>

        <form method="POST" action="{{ route('petugas.setoran.store') }}">
            @csrf
            <input type="hidden" name="id_pengguna_nasabah" value="{{ $nasabah->id_pengguna_nasabah }}">
            <input type="hidden" name="id_jenis_sampah" value="{{ $harga->id_jenis_sampah }}">
            <input type="hidden" name="berat_kg" value="{{ request('berat_kg') }}">
            <button class="btn" type="submit">Validasi & Simpan</button>
        </form>

        <a class="btn" href="{{ route('petugas.setoran.create') }}" style="background:#2563eb; margin-left:8px;">Kembali</a>
    </div>
</body>
</html>
