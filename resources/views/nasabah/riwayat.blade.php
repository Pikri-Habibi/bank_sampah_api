<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css"
    >

    <title>Riwayat Aktivitas - Bank Sampah Griya Ayu</title>

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
            max-width: 1100px;
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
           SUMMARY
        ===================================================== */

        .summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .summary-label {
            color: #71847f;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .summary-value {
            font-size: 24px;
            font-weight: bold;
            color: #17332e;
        }

        .summary-description {
            margin-top: 7px;
            color: #7d8d89;
            font-size: 12px;
        }

        .summary-icon {
            float: right;
            width: 40px;
            height: 40px;
            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
            font-weight: bold;
        }

        .icon-setoran {
            background: #e6f5ed;
            color: #2d765d;
        }

        .icon-penarikan {
            background: #fff1df;
            color: #e89529;
        }

        /* =====================================================
           PANEL
        ===================================================== */

        .panel {
            background: white;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
        }

        .panel-title {
            font-size: 17px;
            font-weight: bold;
            color: #17332e;
        }

        .panel-description {
            margin-top: 5px;
            font-size: 12px;
            color: #7b8b88;
        }

        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            font-weight: normal;
            color: #7c8d89;

            padding: 11px 9px;

            border-bottom: 1px solid #edf1ef;
        }

        td {
            padding: 13px 9px;

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

        .berat {
            color: #526762;
        }

        .jenis {
            font-weight: 500;
        }

        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: inline-flex;
            align-items: center;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: bold;
        }

        .status-pending {
            background: #fff2dc;
            color: #d88916;
        }

        .status-approved {
            background: #e3f5eb;
            color: #298357;
        }

        .status-rejected {
            background: #fde7e7;
            color: #d95353;
        }

        /* =====================================================
           DETAIL BUTTON
        ===================================================== */

        .btn-detail {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 7px 11px;

            border-radius: 7px;

            background: #eef7f4;
            color: #2d765d;

            border: 1px solid #d9ebe5;

            text-decoration: none;

            font-size: 11px;
            font-weight: bold;

            transition: 0.2s;
        }

        .btn-detail:hover {
            background: #e2f1ec;
        }

        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            text-align: center;
            color: #879691;

            padding: 35px 10px;

            font-size: 13px;
        }

        .empty-icon {
            font-size: 30px;
            margin-bottom: 8px;
            opacity: 0.5;
        }

        /* =====================================================
           BACK BUTTON
        ===================================================== */

        .back-wrapper {
            margin-top: 5px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;

            padding: 10px 15px;

            border-radius: 8px;

            background: white;
            color: #374b48;

            border: 1px solid #d9e1df;

            text-decoration: none;

            font-size: 12px;
            font-weight: bold;
        }

        .btn-back:hover {
            background: #f7f9f8;
        }

        .nominal {
            font-weight: bold;
            color: #2d765d;
        }

        .nominal-pengurangan {
            font-weight: bold;
            color: #b60808;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 800px) {

            .main {
                margin-left: 190px;
                padding: 25px 20px;
            }

            .summary {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 600px) {

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .page-header h1 {
                font-size: 24px;
            }

            .panel {
                padding: 17px;
            }

        }

    </style>

</head>

<body>


{{-- =====================================================
     SIDEBAR
===================================================== --}}

@include('layouts.sidebar-nasabah')


{{-- =====================================================
     MAIN
===================================================== --}}

<main class="main">

    <div class="content">


        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="page-header">

            <h1>
                Riwayat Aktivitas
            </h1>

            <p>
                Lihat seluruh riwayat setoran dan penarikan saldo Anda.
            </p>

        </div>


        {{-- =================================================
             SUMMARY
        ================================================== --}}

        <div class="summary">


            {{-- TOTAL SETORAN --}}

            <div class="summary-card">

                <div class="summary-icon icon-setoran">
                    <i class="fa-solid fa-recycle"></i>
                </div>

                <div class="summary-label">
                    Total Transaksi Setoran
                </div>

                <div class="summary-value">
                    {{ $transaksi->count() }}
                </div>

                <div class="summary-description">
                    Jumlah transaksi setoran yang tercatat
                </div>

            </div>


            {{-- TOTAL PENARIKAN --}}

            <div class="summary-card">

                <div class="summary-icon icon-penarikan">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div class="summary-label">
                    Total Pengajuan Penarikan
                </div>

                <div class="summary-value">
                    {{ $penarikan->count() }}
                </div>

                <div class="summary-description">
                    Jumlah pengajuan penarikan yang pernah dibuat
                </div>

            </div>

        </div>


        {{-- =================================================
             RIWAYAT SETORAN
        ================================================== --}}

        <div class="panel">

            <div class="panel-header">

                <div>

                    <div class="panel-title">
                        Riwayat Setoran
                    </div>

                    <div class="panel-description">
                        Daftar transaksi sampah yang telah Anda setorkan.
                    </div>

                </div>

            </div>


            @if($transaksi->count() > 0)

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Jenis Sampah
                                </th>

                                <th>
                                    Berat
                                </th>

                                <th>
                                    Nominal
                                </th>

                                <th>
                                    Detail
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($transaksi as $setoran)

                                @php

                                    $totalBerat = $setoran->detailSetoran->sum('total_berat');

                                    $totalNominal = $setoran->detailSetoran->sum(function ($detail) {

                                        return $detail->total_berat * $detail->harga_per_kg;

                                    });

                                @endphp


                                <tr>

                                    {{-- TANGGAL --}}

                                    <td>

                                        {{ \Carbon\Carbon::parse(
                                            $setoran->tgl_setoran
                                        )->format('d/m/Y') }}

                                    </td>


                                    {{-- JENIS SAMPAH --}}

                                    <td class="jenis">

                                        @if($setoran->detailSetoran->count() > 0)

                                            @foreach($setoran->detailSetoran as $detail)

                                                {{ $detail->jenisSampah->nama_sampah ?? '-' }}

                                                @if(!$loop->last)
                                                    ,
                                                @endif

                                            @endforeach

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- BERAT --}}

                                    <td class="berat">

                                        {{ number_format(
                                            $totalBerat,
                                            2,
                                            ',',
                                            '.'
                                        ) }}

                                        kg

                                    </td>


                                    {{-- NOMINAL --}}

                                    <td class="nominal">

                                        Rp {{ number_format(
                                            $totalNominal,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </td>


                                    {{-- DETAIL --}}

                                    <td>

                                        <a
                                            href="{{ route(
                                                'nasabah.riwayat.detail',
                                                $setoran->id_setoran
                                            ) }}"
                                            class="btn-detail"
                                        >
                                            Lihat Detail
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty">

                    <div class="empty-icon">
                        ↑
                    </div>

                    Belum ada transaksi setoran.

                </div>

            @endif

        </div>


        {{-- =================================================
             RIWAYAT PENARIKAN
        ================================================== --}}

        <div class="panel">

            <div class="panel-header">

                <div>

                    <div class="panel-title">
                        Riwayat Penarikan
                    </div>

                    <div class="panel-description">
                        Daftar pengajuan penarikan saldo Anda.
                    </div>

                </div>

            </div>


            @if($penarikan->count() > 0)

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Nominal
                                </th>

                                <th>
                                    Kode Verifikasi
                                </th>

                                <th>
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($penarikan as $item)

                                <tr>

                                    {{-- TANGGAL --}}

                                    <td>

                                        {{ \Carbon\Carbon::parse(
                                            $item->tgl_pengajuan
                                        )->format('d/m/Y') }}

                                    </td>


                                    {{-- NOMINAL --}}

                                    <td class="nominal-pengurangan">
                                        - Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                    </td>


                                    {{-- KODE --}}

                                    <td>

                                        <strong style="
                                            color:#2d765d;
                                            letter-spacing:2px;
                                        ">

                                            {{ $item->kode_verifikasi }}

                                        </strong>

                                    </td>


                                    {{-- STATUS --}}

                                    <td>

                                        @if($item->status === 'pending')

                                            <span class="status status-pending">
                                                Menunggu
                                            </span>

                                        @elseif($item->status === 'approved')

                                            <span class="status status-approved">
                                                Disetujui
                                            </span>

                                        @elseif($item->status === 'rejected')

                                            <span class="status status-rejected">
                                                Ditolak
                                            </span>

                                        @else

                                            <span class="status">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty">

                    <div class="empty-icon">
                        ↓
                    </div>

                    Belum ada pengajuan penarikan.

                </div>

            @endif

        </div>

    </div>

</main>

</body>
</html>