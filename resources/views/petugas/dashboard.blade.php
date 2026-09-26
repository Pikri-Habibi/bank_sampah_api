<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
    <title>Dashboard Petugas</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7fb; margin: 0; padding: 24px; }
        .container { max-width: 1100px; margin: 0 auto; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; }
        .card { background: white; border-radius: 12px; padding: 18px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .label { color: #6b7280; font-size: 12px; text-transform: uppercase; }
        .value { font-size: 28px; font-weight: bold; margin-top: 8px; }
        .box { background: white; border-radius: 12px; padding: 20px; margin-top: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        .btn { display: inline-block; background: #0f766e; color: white; text-decoration: none; padding: 10px 16px; border-radius: 8px; }
        .btn-secondary { background: #2563eb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <h2>Dashboard Petugas</h2>
            <div>
                <a class="btn btn-secondary" href="{{ route('petugas.setoran.create') }}">+ Input Setoran</a>
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

        @if($errors->any())
            <div style="background:#fee2e2;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="box">

            <h3>Validasi Penarikan Nasabah</h3>

            <p style="color:#6b7280; margin-bottom:16px;">
                Masukkan kode verifikasi yang diberikan oleh nasabah
                untuk memproses penarikan saldo.
            </p>

            <form
                action="{{ route('petugas.penarikan.search') }}"
                method="POST"
                style="display:flex; gap:12px; flex-wrap:wrap; align-items:end;"
            >

                @csrf

                <div style="flex:1; min-width:220px;">

                    <label
                        for="kode"
                        style="display:block; margin-bottom:8px; font-weight:bold;"
                    >
                        Kode Verifikasi
                    </label>

                    <input
                        type="text"
                        id="kode"
                        name="kode"
                        placeholder="Contoh: 583214"
                        maxlength="6"
                        inputmode="numeric"
                        style="width:100%; padding:10px; border:1px solid #d1d5db; border-radius:8px;"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="btn"
                    style="border:none; cursor:pointer;"
                >
                    Verifikasi
                </button>

            </form>

        </div>

        <div class="cards">
            <div class="card">
                <div class="label">Total Nasabah Aktif</div>
                <div class="value">{{ $totalNasabah ?? 0 }}</div>
            </div>
            <div class="card">
                <div class="label">Total Saldo Nasabah</div>
                <div class="value">Rp {{ number_format($totalSaldo ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="card">
                <div class="label">Penarikan Pending</div>
                <div class="value">{{ $pendingPenarikan ?? 0 }}</div>
            </div>
            <div class="card">
                <div class="label">Transaksi Disetujui</div>
                <div class="value">{{ $transaksiDisetujui ?? 0 }}</div>
            </div>
        </div>

        <div class="box">
            <h3>Nilai Setoran Per Bulan</h3>
            @if(isset($setoranPerBulan) && $setoranPerBulan->count())
                <table>
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($setoranPerBulan as $item)
                            <tr>
                                <td>{{ $item->bulan }}</td>
                                <td>Rp {{ number_format($item->total_nilai ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Belum ada data setoran.</p>
            @endif
        </div>

        <div class="box">
            <h3>Jumlah Transaksi Per Bulan</h3>
            @if(isset($jumlahTransaksiPerBulan) && $jumlahTransaksiPerBulan->count())
                <table>
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Jumlah Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jumlahTransaksiPerBulan as $item)
                            <tr>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->total_transaksi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Belum ada transaksi.</p>
            @endif
        </div>
    </div>
</body>
</html>
