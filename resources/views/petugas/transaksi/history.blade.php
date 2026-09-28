<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
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

        /* =========================
           MAIN CONTENT
        ========================= */

        .main {
            margin-left: 230px;
            min-height: 100vh;
            padding: 35px 32px 60px;
        }

        .content {
            max-width: 1250px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .page-header-left h1 {
            margin: 0 0 5px;
            font-size: 28px;
            color: #153b38;
        }

        .page-header-left p {
            margin: 0;
            color: #6b7f7b;
            font-size: 14px;
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: #fff;
            padding: 9px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }

        .count-badge::before {
            content: "▤";
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            font-size: 12px;
        }

        /* =========================
           CARD
        ========================= */

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(15, 60, 53, 0.06);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
            padding-bottom: 16px;
            border-bottom: 1px solid #edf1f0;
        }

        .card-title {
            margin: 0;
            font-size: 19px;
            color: #172b2b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title::before {
            content: "";
            display: inline-block;
            width: 5px;
            height: 22px;
            background: linear-gradient(180deg, #2c8069 0%, #319d7c 100%);
            border-radius: 3px;
        }

        .card-description {
            margin: 5px 0 0;
            font-size: 13px;
            color: #7b8b88;
        }

        /* =========================
           SUMMARY CARDS
        ========================= */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .summary-card {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 4px 15px rgba(15, 60, 53, 0.06);
            display: flex;
            align-items: center;
            gap: 14px;
            border-left: 4px solid transparent;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 60, 53, 0.1);
        }

        .summary-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .summary-card.total {
            border-left-color: #2c8069;
        }

        .summary-card.total .summary-icon {
            background: #e6f4ef;
            color: #2c8069;
        }

        .summary-card.approved {
            border-left-color: #0ea5e9;
        }

        .summary-card.approved .summary-icon {
            background: #e0f2fe;
            color: #0369a1;
        }

        .summary-card.pending {
            border-left-color: #f59e0b;
        }

        .summary-card.pending .summary-icon {
            background: #fef3c7;
            color: #b45309;
        }

        .summary-card.rejected {
            border-left-color: #ef4444;
        }

        .summary-card.rejected .summary-icon {
            background: #fee2e2;
            color: #b91c1c;
        }

        .summary-info {
            flex: 1;
            min-width: 0;
        }

        .summary-label {
            font-size: 12px;
            color: #7b8b88;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            font-weight: 600;
        }

        .summary-value {
            font-size: 22px;
            font-weight: bold;
            color: #153b38;
            font-variant-numeric: tabular-nums;
        }

        /* =========================
           TABLE
        ========================= */

        .table-wrapper {
            overflow-x: auto;
        }

        .setoran-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .setoran-table th {
            background: #f5f8f7;
            color: #4f625e;
            font-size: 11px;
            text-align: left;
            padding: 13px 14px;
            font-weight: bold;
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .setoran-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #edf1f0;
            vertical-align: middle;
            font-size: 13px;
            color: #2b3d3b;
        }

        .setoran-table tbody tr {
            transition: background 0.15s ease;
        }

        .setoran-table tbody tr:hover {
            background: #f9fbfa;
        }

        .setoran-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .setoran-table .waktu {
            color: #6b7f7b;
            font-size: 12.5px;
            white-space: nowrap;
        }

        .setoran-table .jenis-transaksi {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            color: #172b2b;
        }

        .setoran-table .jenis-transaksi::before {
            content: "";
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #2c8069;
        }

        .setoran-table .berat {
            color: #4f625e;
            white-space: nowrap;
        }

        .setoran-table .nominal {
            white-space: nowrap;
            font-weight: bold;
            color: #16715e;
            font-variant-numeric: tabular-nums;
        }

        /* =========================
           STATUS BADGE
        ========================= */

        .status {
            display: inline-block;
            padding: 5px 11px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
            border: 1px solid transparent;
        }

        .status-disetujui,
        .status-approved,
        .status-success {
            background: #dcfce7;
            color: #166534;
            border-color: #bbf7d0;
        }

        .status-menunggu,
        .status-pending {
            background: #fef3c7;
            color: #92400e;
            border-color: #fde68a;
        }


        .status-rejected,
        .status-ditolak {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }
        .status-ditolak,
        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }

        /* =========================
           EMPTY STATE
        ========================= */

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #899693;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 14px;
            background: #f5f8f7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .empty-state-title {
            font-size: 15px;
            font-weight: 600;
            color: #4f625e;
            margin-bottom: 4px;
        }

        .empty-state-text {
            font-size: 13px;
            color: #899693;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {
            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
                padding: 25px 18px;
            }

            .card {
                padding: 18px;
            }

            .summary-value {
                font-size: 19px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .sidebar-bottom {
                margin-top: 20px;
            }

            .page-header {
                align-items: flex-start;
            }

            .page-header-left h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar-petugas')

    <main class="main">
        <div class="content">

            <!-- HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>Riwayat Transaksi</h1>
                    <p>Daftar seluruh transaksi setoran dan penarikan nasabah</p>
                </div>
                <span class="count-badge">{{ $transactions->count() }} transaksi</span>
            </div>

            <!-- CARD TABLE -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="card-title">Daftar Transaksi</h2>
                        <p class="card-description">Semua riwayat transaksi yang telah tercatat dalam sistem</p>
                    </div>
                </div>

                @if($transactions->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <div class="empty-state-title">Belum ada transaksi</div>
                        <div class="empty-state-text">Riwayat transaksi akan muncul di sini setelah ada aktivitas.</div>
                    </div>
                @else
                    <div class="table-wrapper">
                        <table class="setoran-table">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Jenis</th>
                                    <th>Nasabah</th>
                                    <th>Jenis Sampah</th>
                                    <th>Berat</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    @php($statusClass = strtolower(str_replace(' ', '-', $transaction['status'])))
                                    <tr>
                                        <td class="waktu">{{ $transaction['waktu']->format('d/m/Y H:i') }}</td>
                                        <td><span class="jenis-transaksi">{{ $transaction['jenis_transaksi'] }}</span></td>
                                        <td>{{ $transaction['nasabah'] }}</td>
                                        <td>{{ $transaction['jenis_sampah'] }}</td>
                                        <td class="berat">{{ is_numeric($transaction['berat']) ? number_format((float) $transaction['berat'], 2, ',', '.') . ' kg' : '-' }}</td>
                                        <td class="nominal">Rp {{ number_format((float) $transaction['nominal'], 0, ',', '.') }}</td>
                                        <td><span class="status status-{{ $statusClass }}">{{ $transaction['status'] }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </main>
</body>
</html>
