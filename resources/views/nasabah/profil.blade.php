<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>Profil Nasabah - Bank Sampah Griya Ayu</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #17332e;
        }

        .main {
            margin-left: 230px;
            min-height: 100vh;
            padding: 32px;
        }

        .content {
            max-width: 1050px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 28px;
        }

        .page-header p {
            margin: 6px 0 0;
            color: #71847f;
            font-size: 14px;
        }

        .profile-card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 18px;
            padding-bottom: 22px;
            border-bottom: 1px solid #edf1ef;
        }

        .profile-avatar {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #4eb37f;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 25px;
            font-weight: bold;
        }

        .profile-name {
            font-size: 20px;
            font-weight: bold;
        }

        .profile-role {
            margin-top: 5px;
            color: #71847f;
            font-size: 13px;
        }

        .section-title {
            margin: 22px 0 15px;
            font-size: 16px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-box {
            background: #f7f9f8;
            border-radius: 10px;
            padding: 15px;
        }

        .info-label {
            display: block;
            color: #7c8d89;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 14px;
            font-weight: bold;
        }

        .balance-card {
            background: #f0f8f5;
            border: 1px solid #dcece7;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .balance-label {
            color: #6b7f7b;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .balance-value {
            color: #16715e;
            font-size: 25px;
            font-weight: bold;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;

            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .stat-label {
            color: #71847f;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #17332e;
        }

        @media (max-width: 800px) {

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .info-grid,
            .stats-grid {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-nasabah')


    <main class="main">

        <div class="content">

            {{-- HEADER --}}

            <div class="page-header">

                <h1>
                    Profil Nasabah
                </h1>

                <p>
                    Informasi akun dan ringkasan aktivitas Anda.
                </p>

            </div>


            {{-- PROFILE --}}

            <div class="profile-card">

                <div class="profile-header">

                    <div class="profile-avatar">

                        {{ strtoupper(
                            substr(
                                $nasabah->nama_lengkap ?? 'N',
                                0,
                                1
                            )
                        ) }}

                    </div>


                    <div>

                        <div class="profile-name">

                            {{ $nasabah->nama_lengkap ?? '-' }}

                        </div>

                        <div class="profile-role">

                            Nasabah Bank Sampah Griya Ayu

                        </div>

                    </div>

                </div>


                <h2 class="section-title">
                    Informasi Akun
                </h2>


                <div class="info-grid">

                    <div class="info-box">

                        <span class="info-label">
                            Nama Lengkap
                        </span>

                        <span class="info-value">

                            {{ $nasabah->nama_lengkap ?? '-' }}

                        </span>

                    </div>


                    <div class="info-box">

                        <span class="info-label">
                            Status
                        </span>

                        <span class="info-value">
                            Nasabah Aktif
                        </span>

                    </div>

                </div>


                {{-- SALDO --}}

                <div class="balance-card">

                    <div class="balance-label">
                        Saldo Saat Ini
                    </div>

                    <div class="balance-value">

                        Rp {{ number_format(
                            $nasabah->saldo ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>

            </div>


            {{-- STATISTIK --}}

            <div class="stats-grid">

                <div class="stat-card">

                    <div class="stat-label">
                        Total Setoran
                    </div>

                    <div class="stat-value">
                        {{ $totalSetoran }}
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-label">
                        Total Berat Sampah
                    </div>

                    <div class="stat-value">
                        {{ number_format($totalBerat, 2, ',', '.') }} kg
                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-label">
                        Total Pendapatan
                    </div>

                    <div class="stat-value">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </div>

                </div>

            </div>

        </div>

    </main>

</body>

</html>