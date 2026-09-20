<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Nasabah</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7fb; margin: 0; padding: 24px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
        .card { background:white; border-radius:12px; padding:20px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .saldo { font-size: 32px; font-weight: bold; }
        .row { display:flex; gap:16px; flex-wrap:wrap; }
        .btn { display:inline-block; background:#0f766e; color:white; text-decoration:none; padding:10px 16px; border-radius:8px; }
        table { width:100%; border-collapse: collapse; margin-top: 12px; }
        th, td { padding: 10px 12px; border-bottom:1px solid #e5e7eb; text-align:left; }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <h2>Dashboard Nasabah</h2>
            <div>
                <a class="btn" href="{{ route('nasabah.penarikan.create') }}">Ajukan Penarikan</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left:8px;">
                    @csrf
                    <button class="btn" type="submit">Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div style="background:#dcfce7;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div style="color:#6b7280;">Saldo Tabungan</div>
            <div class="saldo">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</div>
        </div>

        <div class="row" style="margin-top: 24px;">
            <div class="card" style="flex:1; min-width:280px;">
                <h3>Riwayat Setoran</h3>
                @if(isset($transaksiTerakhir) && $transaksiTerakhir->count())
                    <table>
                        <thead>
                            <tr><th>Tanggal</th><th>Nominal</th></tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiTerakhir as $item)
                                <tr>
                                    <td>{{ $item->tgl_setoran }}</td>
                                    <td>Rp {{ number_format($item->detailSetoran->sum(fn($d) => $d->total_berat * $d->harga_per_kg), 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum ada riwayat setoran.</p>
                @endif
            </div>

            <div class="card" style="flex:1; min-width:280px;">
                <h3>Riwayat Penarikan</h3>
                @if(isset($penarikanTerakhir) && $penarikanTerakhir->count())
                    <table>
                        <thead>
                            <tr><th>Tanggal</th><th>Nominal</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @foreach($penarikanTerakhir as $item)
                                <tr>
                                    <td>{{ $item->tgl_pengajuan }}</td>
                                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($item->status ?? 'pending') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum ada riwayat penarikan.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
