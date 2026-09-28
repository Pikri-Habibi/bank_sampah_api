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
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 0;
            color: #1f2937;
        }



        /* ===== MAIN CONTENT ===== */
        .main {
            margin-left: 230px;
            padding: 32px 36px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .topbar h2 {
            margin: 0;
            font-size: 24px;
            color: #0d463f;
        }

        .btn {
            display: inline-block;
            background: #0f766e;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn:hover {
            background: #0b5e58;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-secondary {
            background: #2563eb;
        }

        .btn-secondary:hover {
            background: #1d4ed8;
        }

        /* ===== ALERTS ===== */
        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 4px solid #22c55e;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 4px solid #ef4444;
        }

        /* ===== CARDS ===== */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-left: 4px solid #2c8069;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        .card .label {
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .card .value {
            font-size: 26px;
            font-weight: bold;
            margin-top: 8px;
            color: #0d463f;
        }

        /* ===== BOX ===== */
        .box {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        .box h3 {
            margin: 0 0 16px 0;
            font-size: 17px;
            color: #0d463f;
        }

        /* ===== FORM ===== */
        .search-form {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .form-group {
            flex: 1;
            min-width: 220px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 13px;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            outline: none;
        }

        .form-group input:focus {
            border-color: #2c8069;
            box-shadow: 0 0 0 3px rgba(44, 128, 105, 0.15);
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th {
            padding: 12px 14px;
            border-bottom: 2px solid #e5e7eb;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            color: #6b7280;
            letter-spacing: 0.5px;
            background: #f9fafb;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }

        tr:hover td {
            background: #f9fafb;
        }

        .empty-state {
            color: #9ca3af;
            font-style: italic;
            padding: 16px 0;
            text-align: center;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                padding: 16px 14px;
            }

            .main {
                margin-left: 200px;
                padding: 24px 20px;
            }

            .cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 64px;
                padding: 16px 10px;
                align-items: center;
            }

            .brand-text,
            .menu-title,
            .menu a span:not(.menu-icon),
            .petugas-info > div,
            .sidebar-bottom .logout {
                display: none;
            }

            .brand {
                justify-content: center;
                margin-bottom: 24px;
            }

            .menu a {
                justify-content: center;
                padding: 12px;
            }

            .main {
                margin-left: 64px;
                padding: 20px 16px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

    @include('layouts.sidebar-petugas')

    <div class="main">
        <div class="topbar">
            <h2>Dashboard Petugas</h2>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

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
                <p class="empty-state">Belum ada data setoran.</p>
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
                <p class="empty-state">Belum ada transaksi.</p>
            @endif
        </div>
    </div>

</body>
</html>
