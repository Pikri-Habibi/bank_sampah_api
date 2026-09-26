<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>Detail Transaksi - Bank Sampah Griya Ayu</title>

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

        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            margin-left: 230px;
            min-height: 100vh;
            padding: 32px;
        }

        .content {
            max-width: 1050px;
            margin: 0 auto;
        }

        /* =====================================================
           HEADER
        ===================================================== */

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 28px;
            color: #17332e;
        }

        .page-header p {
            margin: 6px 0 0;
            color: #71847f;
            font-size: 14px;
        }

        /* =====================================================
           CARD
        ===================================================== */

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            margin: 0 0 18px;
            font-size: 17px;
            color: #17332e;
        }

        /* =====================================================
           INFO TRANSAKSI
        ===================================================== */

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .info-box {
            background: #f7f9f8;
            border-radius: 10px;
            padding: 15px;
        }

        .info-label {
            display: block;
            font-size: 11px;
            color: #7c8d89;
            margin-bottom: 6px;
        }

        .info-value {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #253735;
        }

        /* =====================================================
           TABLE
        ===================================================== */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            font-weight: normal;
            color: #7c8d89;
            padding: 11px 8px;
            border-bottom: 1px solid #edf1ef;
        }

        td {
            padding: 14px 8px;
            font-size: 13px;
            color: #344a45;
            border-bottom: 1px solid #edf1ef;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .nominal {
            font-weight: bold;
            color: #2d765d;
        }

        /* =====================================================
           TOTAL
        ===================================================== */

        .total-box {
            margin-top: 18px;
            background: #f0f8f5;
            border: 1px solid #dcece7;
            border-radius: 10px;
            padding: 17px 18px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 13px;
            color: #6b7f7b;
        }

        .total-value {
            font-size: 20px;
            font-weight: bold;
            color: #16715e;
        }

        /* =====================================================
           BACK BUTTON
        ===================================================== */

        .back-wrapper {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 10px 15px;

            border-radius: 8px;
            border: 1px solid #d9e1df;

            background: white;
            color: #374b48;

            text-decoration: none;

            font-size: 13px;
            font-weight: bold;
        }

        .btn:hover {
            background: #f9f7f7;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 800px) {

            .main {
                margin-left: 190px;
                padding: 25px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .total-box {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-nasabah')


    <main class="main">

        <div class="content">

            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div class="page-header">

                <h1>
                    Detail Transaksi
                </h1>

                <p>
                    Informasi lengkap transaksi setoran Anda
                </p>

            </div>


            {{-- =================================================
                 INFORMASI TRANSAKSI
            ================================================== --}}

            <div class="card">

                <h2 class="card-title">
                    Informasi Transaksi
                </h2>

                <div class="info-grid">

                    <div class="info-box">

                        <span class="info-label">
                            ID Transaksi
                        </span>

                        <span class="info-value">
                            #{{ $transaksi->id_setoran }}
                        </span>

                    </div>


                    <div class="info-box">

                        <span class="info-label">
                            Tanggal Setoran
                        </span>

                        <span class="info-value">
                            {{ \Carbon\Carbon::parse($transaksi->tgl_setoran)->format('d/m/Y') }}
                        </span>

                    </div>


                    <div class="info-box">

                        <span class="info-label">
                            Petugas
                        </span>

                        <span class="info-value">
                            {{ $transaksi->petugas->nama_lengkap ?? $transaksi->petugas->user->name ?? '-' }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 DETAIL SAMPAH
            ================================================== --}}

            <div class="card">

                <h2 class="card-title">
                    Detail Setoran
                </h2>


                <table>

                    <thead>

                        <tr>
                            <th>Jenis Sampah</th>
                            <th>Berat</th>
                            <th>Harga / Kg</th>
                            <th>Subtotal</th>
                        </tr>

                    </thead>


                    <tbody>

                        @php
                            $totalNominal = 0;
                            $totalBerat = 0;
                        @endphp


                        @foreach($transaksi->detailSetoran as $detail)

                            @php
                                $berat = (float) $detail->total_berat;
                                $harga = (float) $detail->harga_per_kg;
                                $subtotal = $berat * $harga;

                                $totalBerat += $berat;
                                $totalNominal += $subtotal;
                            @endphp


                            <tr>

                                <td>
                                    {{ $detail->jenisSampah->nama_sampah ?? '-' }}
                                </td>


                                <td>
                                    {{ number_format($berat, 2, ',', '.') }}
                                    kg
                                </td>


                                <td>
                                    Rp {{ number_format($harga, 0, ',', '.') }}
                                </td>


                                <td class="nominal">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>


                {{-- TOTAL --}}

                <div class="total-box">

                    <div>

                        <div class="total-label">
                            Total Berat
                        </div>

                        <strong>
                            {{ number_format($totalBerat, 2, ',', '.') }} kg
                        </strong>

                    </div>


                    <div style="text-align:right;">

                        <div class="total-label">
                            Total Pendapatan
                        </div>

                        <div class="total-value">
                            Rp {{ number_format($totalNominal, 0, ',', '.') }}
                        </div>

                    </div>

                </div>

                <div class="back-wrapper">

                    <a
                        href="{{ route('nasabah.riwayat') }}"
                        class="btn"
                    >
                        Kembali ke Riwayat
                    </a>

                </div>

            </div>

        </div>

    </main>

</body>

</html>