<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Bank Sampah Griya Ayu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #172b27;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100vh;
            background: #123d36;
            color: white;
            padding: 22px 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 32px;
        }

        .brand-icon {
            font-size: 34px;
            line-height: 1;
        }

        .brand-name {
            font-size: 15px;
            font-weight: bold;
            line-height: 1.2;
        }

        .menu-title {
            color: #91afa8;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;

            text-decoration: none;
            color: #c6d6d2;

            padding: 11px 13px;
            border-radius: 9px;

            font-size: 14px;

            transition: 0.2s;
        }

        .menu a:hover {
            background: #245f4f;
            color: white;
        }

        .menu a.active {
            background: #2d765d;
            color: white;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        /* USER SIDEBAR */

        .sidebar-bottom {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 20px;

            border-top: 1px solid rgba(255,255,255,0.12);
            padding-top: 18px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;

            border-radius: 50%;
            background: #4eb37f;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 13px;
            font-weight: bold;
        }

        .user-name {
            font-size: 12px;
            font-weight: bold;
        }

        .user-role {
            font-size: 10px;
            color: #9bb5ae;
            margin-top: 2px;
        }

        .logout {
            color: #ff6464;
            text-decoration: none;
            font-size: 13px;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main {
            margin-left: 230px;
            padding: 32px;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 27px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #7a8784;
            font-size: 14px;
        }

        /* =========================
           ALERT
        ========================= */

        .attention {
            border: 1px solid #f2a51a;
            background: #fffaf0;

            border-radius: 9px;

            padding: 14px 17px;

            margin-bottom: 17px;

            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .attention-icon {
            font-size: 20px;
            color: #e58a00;
        }

        .attention-title {
            color: #a65300;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .attention-item {
            color: #3d6d5c;
            font-size: 12px;
            margin-bottom: 4px;
        }

        /* =========================
           STATISTICS CARDS
        ========================= */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 17px;
        }

        .stat-card {
            background: white;
            border-radius: 13px;

            padding: 19px;

            min-height: 125px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.06);

            position: relative;
        }

        .stat-title {
            color: #68736f;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 25px;
            font-weight: bold;
            color: #17212e;
            margin-bottom: 9px;
        }

        .stat-description {
            font-size: 11px;
            color: #12a36a;
        }

        .stat-description.orange {
            color: #f08a19;
        }

        .stat-icon {
            position: absolute;

            top: 18px;
            right: 18px;

            width: 32px;
            height: 32px;

            border-radius: 9px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 17px;
        }

        .icon-blue {
            background: #eef5ff;
            color: #357cf0;
        }

        .icon-green {
            background: #edf9f2;
            color: #16aa68;
        }

        .icon-orange {
            background: #fff4e8;
            color: #f18b20;
        }

        /* =========================
           CHARTS
        ========================= */

        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 17px;
        }

        .chart-card {
            background: white;
            border-radius: 13px;

            padding: 19px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
        }

        .chart-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 22px;
        }

        /* BAR CHART */

        .bar-chart {
            height: 115px;

            display: flex;
            align-items: flex-end;
            justify-content: space-around;

            border-bottom: 1px solid #e9eeec;
        }

        .bar-container {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            gap: 7px;
        }

        .bar {
            width: 25px;
            background: #4eb17f;
            border-radius: 4px 4px 0 0;
        }

        .bar.dark {
            background: #276f58;
        }

        .month {
            font-size: 10px;
            color: #7e8986;
            margin-bottom: -19px;
        }

        /* LINE CHART */

        .line-chart {
            height: 115px;
            position: relative;
            border-bottom: 1px solid #e9eeec;
        }

        .line-grid {
            position: absolute;
            left: 0;
            right: 0;
            height: 1px;
            background: #edf1ef;
        }

        .grid-1 {
            top: 20%;
        }

        .grid-2 {
            top: 50%;
        }

        .grid-3 {
            top: 80%;
        }

        .line {
            position: absolute;
            left: 7%;
            right: 7%;
            top: 20px;
            height: 75px;
        }

        .line svg {
            width: 100%;
            height: 100%;
            overflow: visible;
        }

        .line-path {
            fill: none;
            stroke: #4eb17f;
            stroke-width: 2;
        }

        .line-point {
            fill: #4eb17f;
        }

        .line-labels {
            display: flex;
            justify-content: space-between;

            margin-top: 8px;
            padding: 0 8px;
        }

        .line-labels span {
            font-size: 10px;
            color: #7e8986;
        }

        /* =========================
           TRANSACTIONS
        ========================= */

        .transaction-card {
            background: white;
            border-radius: 13px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.06);

            overflow: hidden;
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 19px;

            border-bottom: 1px solid #edf1ef;
        }

        .transaction-title {
            font-size: 14px;
            font-weight: bold;
        }

        .see-all {
            color: #0eaa69;
            text-decoration: none;
            font-size: 11px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8faf9;
        }

        th {
            text-align: left;

            padding: 12px 19px;

            font-size: 10px;
            font-weight: normal;

            color: #697671;
        }

        td {
            padding: 14px 19px;

            font-size: 11px;

            border-top: 1px solid #edf1ef;
        }

        .customer {
            font-weight: bold;
            color: #202a36;
        }

        .date {
            color: #7b8783;
        }

        .transaction-value {
            color: #0ba968;
            font-weight: bold;
        }

        .badge {
            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 9px;
        }

        .badge-pending {
            background: #fff3e4;
            color: #ef8a18;
        }

        .badge-approved {
            background: #e7f8ef;
            color: #20a269;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {

            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 23px;
            }

            table {
                min-width: 650px;
            }

            .transaction-card {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ♻
            </div>

            <div class="brand-name">
                Bank Sampah<br>
                Griya Ayu
            </div>

        </div>


        <div class="menu-title">
            Menu Koordinator
        </div>


        <nav class="menu">

            <a href="#" class="active">

                <span class="menu-icon">
                    ▦
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            <a href="#">

                <span class="menu-icon">
                    ▤
                </span>

                <span>
                    Kelola Sampah
                </span>

            </a>


            <a href="#">

                <span class="menu-icon">
                    ◎
                </span>

                <span>
                    Manajemen Pengguna
                </span>

            </a>


            <a href="#">

                <span class="menu-icon">
                    ↗
                </span>

                <span>
                    Laporan
                </span>

            </a>

        </nav>


        <!-- USER -->

        <div class="sidebar-bottom">

            <div class="user-info">

                <div class="user-avatar">
                    S
                </div>

                <div>

                    <div class="user-name">
                        Ibu Dina
                    </div>

                    <div class="user-role">
                        Admin
                    </div>

                </div>

            </div>


            <a href="#" class="logout">
                ⇥ Keluar
            </a>

        </div>

    </aside>



    <!-- =========================
         MAIN CONTENT
    ========================== -->

    <main class="main">

        <!-- HEADER -->

        <div class="page-header">

            <h1>
                Dashboard Admin
            </h1>

            <p>
                Ringkasan aktivitas Bank Sampah Griya Ayu
            </p>

        </div>



        <!-- =========================
             PERLU PERHATIAN
        ========================== -->

        <div class="attention">

            <div class="attention-icon">
                ◷
            </div>

            <div>

                <div class="attention-title">
                    Perlu Perhatian
                </div>

                <div class="attention-item">
                    3 transaksi menunggu validasi →
                </div>

                <div class="attention-item">
                    3 penarikan menunggu diproses →
                </div>

            </div>

        </div>



        <!-- =========================
             STATISTICS
        ========================== -->

        <div class="stats-grid">

            <!-- CARD 1 -->

            <div class="stat-card">

                <div class="stat-title">
                    Total Nasabah Aktif
                </div>

                <div class="stat-value">
                    6
                </div>

                <div class="stat-description">
                    nasabah terdaftar
                </div>

                <div class="stat-icon icon-blue">
                    ♧
                </div>

            </div>


            <!-- CARD 2 -->

            <div class="stat-card">

                <div class="stat-title">
                    Total Nilai Setoran
                </div>

                <div class="stat-value">
                    Rp 143.500
                </div>

                <div class="stat-description">
                    total nilai transaksi
                </div>

                <div class="stat-icon icon-green">
                    ↗
                </div>

            </div>


            <!-- CARD 3 -->

            <div class="stat-card">

                <div class="stat-title">
                    Total Saldo Nasabah
                </div>

                <div class="stat-value">
                    Rp 1.848.000
                </div>

                <div class="stat-description">
                    saldo tersimpan
                </div>

                <div class="stat-icon icon-orange">
                    ▣
                </div>

            </div>


            <!-- CARD 4 -->

            <div class="stat-card">

                <div class="stat-title">
                    Menunggu Validasi
                </div>

                <div class="stat-value">
                    3
                </div>

                <div class="stat-description orange">
                    perlu validasi
                </div>

                <div class="stat-icon icon-orange">
                    ◷
                </div>

            </div>


            <!-- CARD 5 -->

            <div class="stat-card">

                <div class="stat-title">
                    Penarikan Pending
                </div>

                <div class="stat-value">
                    3
                </div>

                <div class="stat-description">
                    perlu diproses
                </div>

                <div class="stat-icon icon-green">
                    ↓
                </div>

            </div>


            <!-- CARD 6 -->

            <div class="stat-card">

                <div class="stat-title">
                    Transaksi Disetujui
                </div>

                <div class="stat-value">
                    2
                </div>

                <div class="stat-description">
                    sudah divalidasi
                </div>

                <div class="stat-icon icon-green">
                    ✓
                </div>

            </div>

        </div>



        <!-- =========================
             CHARTS
        ========================== -->

        <div class="charts-grid">

            <!-- BAR CHART -->

            <div class="chart-card">

                <div class="chart-title">
                    Nilai Setoran per Bulan
                </div>

                <div class="bar-chart">

                    <div class="bar-container">
                        <div class="bar" style="height: 44px;"></div>
                        <span class="month">Apr</span>
                    </div>

                    <div class="bar-container">
                        <div class="bar" style="height: 58px;"></div>
                        <span class="month">Mei</span>
                    </div>

                    <div class="bar-container">
                        <div class="bar" style="height: 35px;"></div>
                        <span class="month">Jun</span>
                    </div>

                    <div class="bar-container">
                        <div class="bar dark" style="height: 80px;"></div>
                        <span class="month">Jul</span>
                    </div>

                    <div class="bar-container">
                        <div class="bar" style="height: 70px;"></div>
                        <span class="month">Agu</span>
                    </div>

                    <div class="bar-container">
                        <div class="bar" style="height: 49px;"></div>
                        <span class="month">Sep</span>
                    </div>

                </div>

            </div>



            <!-- LINE CHART -->

            <div class="chart-card">

                <div class="chart-title">
                    Jumlah Transaksi per Bulan
                </div>

                <div class="line-chart">

                    <div class="line-grid grid-1"></div>
                    <div class="line-grid grid-2"></div>
                    <div class="line-grid grid-3"></div>

                    <div class="line">

                        <svg viewBox="0 0 500 100">

                            <polyline
                                class="line-path"
                                points="
                                    30,75
                                    130,60
                                    230,45
                                    330,30
                                    430,42
                                "
                            />

                            <circle
                                class="line-point"
                                cx="30"
                                cy="75"
                                r="4"
                            />

                            <circle
                                class="line-point"
                                cx="130"
                                cy="60"
                                r="4"
                            />

                            <circle
                                class="line-point"
                                cx="230"
                                cy="45"
                                r="4"
                            />

                            <circle
                                class="line-point"
                                cx="330"
                                cy="30"
                                r="4"
                            />

                            <circle
                                class="line-point"
                                cx="430"
                                cy="42"
                                r="4"
                            />

                        </svg>

                    </div>

                </div>


                <div class="line-labels">

                    <span>Mei</span>
                    <span>Jun</span>
                    <span>Jul</span>
                    <span>Agu</span>
                    <span>Sep</span>

                </div>

            </div>

        </div>



        <!-- =========================
             TRANSAKSI TERBARU
        ========================== -->

        <div class="transaction-card">

            <div class="transaction-header">

                <div class="transaction-title">
                    Transaksi Terbaru
                </div>

                <a href="#" class="see-all">
                    Lihat semua
                </a>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>
                            No. Transaksi
                        </th>

                        <th>
                            Nasabah
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Nilai
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>
                            TRX-20240901-001
                        </td>

                        <td class="customer">
                            Sri Rahayu
                        </td>

                        <td class="date">
                            2024-09-01
                        </td>

                        <td class="transaction-value">
                            Rp 19.750
                        </td>

                        <td>
                            <span class="badge badge-pending">
                                Pending
                            </span>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            TRX-20240905-002
                        </td>

                        <td class="customer">
                            Sri Rahayu
                        </td>

                        <td class="date">
                            2024-09-05
                        </td>

                        <td class="transaction-value">
                            Rp 22.000
                        </td>

                        <td>
                            <span class="badge badge-pending">
                                Pending
                            </span>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            TRX-20240820-003
                        </td>

                        <td class="customer">
                            Sri Rahayu
                        </td>

                        <td class="date">
                            2024-08-20
                        </td>

                        <td class="transaction-value">
                            Rp 14.000
                        </td>

                        <td>
                            <span class="badge badge-approved">
                                Disetujui
                            </span>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            TRX-20240825-004
                        </td>

                        <td class="customer">
                            Budi Santoso
                        </td>

                        <td class="date">
                            2024-08-25
                        </td>

                        <td class="transaction-value">
                            Rp 20.750
                        </td>

                        <td>
                            <span class="badge badge-approved">
                                Disetujui
                            </span>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </main>

</body>
</html>