<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Penarikan</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7fb; margin: 0; padding: 24px; }
        .container { max-width: 520px; margin:0 auto; background:white; border-radius:12px; padding:24px; box-shadow:0 4px 12px rgba(0,0,0,0.06); }
        .field { margin-bottom:16px; }
        label { display:block; margin-bottom:8px; font-weight:bold; }
        input, button { width:100%; padding:10px 12px; border-radius:8px; border:1px solid #d1d5db; }
        button { background:#0f766e; color:white; border:none; cursor:pointer; }
        .error { color:#b91c1c; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pengajuan Penarikan</h2>

        <div style="margin-bottom: 14px;">
            Saldo saat ini: <strong>Rp {{ number_format($nasabah->saldo ?? 0, 0, ',', '.') }}</strong>
        </div>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('nasabah.penarikan.store') }}">
            @csrf
            <div class="field">
                <label>Nominal Penarikan</label>
                <input type="number" min="1000" step="1000" name="nominal" required>
            </div>
            <button type="submit">Ajukan Penarikan</button>
        </form>
        <div style="margin-top:12px;">
            <a href="{{ route('nasabah.dashboard') }}" style="color:#0f766e; text-decoration:none;">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
