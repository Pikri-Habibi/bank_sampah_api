<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>Penarikan Saldo - Petugas</title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #17332e;
        }


        .main {
            margin-left: 230px;
            padding: 32px;
            min-height: 100vh;
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
        }


        .page-header p {
            margin-top: 6px;
            color: #71847f;
            font-size: 14px;
        }


        /* =====================================================
           PANEL
        ===================================================== */

        .panel {
            background: white;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }


        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }


        .panel-title {
            font-size: 18px;
            font-weight: bold;
        }


        .total {
            background: #fff2dc;
            color: #d88916;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }


        /* =====================================================
           PENDING
        ===================================================== */

        .withdrawal-card {
            border: 1px solid #edf1ef;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 15px;
        }


        .withdrawal-card:last-child {
            margin-bottom: 0;
        }


        .withdrawal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }


        .customer-name {
            font-size: 16px;
            font-weight: bold;
        }


        .status {
            display: inline-block;
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


        /* =====================================================
           INFO
        ===================================================== */

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 18px;
        }


        .info-item {
            background: #f8faf9;
            padding: 12px;
            border-radius: 8px;
        }


        .info-label {
            color: #7c8d89;
            font-size: 11px;
            margin-bottom: 5px;
        }


        .info-value {
            font-size: 14px;
            font-weight: bold;
            color: #17332e;
        }


        /* =====================================================
           VERIFICATION FORM
        ===================================================== */

        .verification-form {
            display: flex;
            gap: 10px;
            align-items: end;
            padding-top: 15px;
            border-top: 1px solid #edf1ef;
        }


        .form-group {
            flex: 1;
        }


        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 7px;
        }


        .form-group input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d7dfdc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }


        .form-group input:focus {
            border-color: #2d765d;
        }


        .btn {
            border: none;
            padding: 11px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }


        .btn-primary {
            background: #2d765d;
            color: white;
        }


        .btn-primary:hover {
            background: #245f4c;
        }


        /* =====================================================
           FILTER
        ===================================================== */

        .filter-box {
            background: #f8faf9;
            border: 1px solid #e5ece9;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
        }


        .filter-title {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 12px;
        }


        .filter-form {
            display: flex;
            gap: 12px;
            align-items: end;
        }


        .filter-group {
            flex: 1;
        }


        .filter-group label {
            display: block;
            font-size: 11px;
            color: #71847f;
            margin-bottom: 6px;
        }


        .filter-group input {
            width: 100%;
            padding: 10px 11px;
            border: 1px solid #d7dfdc;
            border-radius: 8px;
            background: white;
            outline: none;
        }


        .filter-group input:focus {
            border-color: #2d765d;
        }


        .btn-filter {
            background: #2d765d;
            color: white;
        }


        .btn-reset {
            background: white;
            color: #475854;
            border: 1px solid #d7dfdc;
        }


        /* =====================================================
           RIWAYAT SELESAI
        ===================================================== */

        .history-card {
            border: 1px solid #edf1ef;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 12px;
        }


        .history-card:last-child {
            margin-bottom: 0;
        }


        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }


        .history-name {
            font-size: 15px;
            font-weight: bold;
        }


        .history-info {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }


        .history-item {
            background: #f8faf9;
            padding: 11px;
            border-radius: 8px;
        }


        .history-label {
            font-size: 10px;
            color: #7c8d89;
            margin-bottom: 5px;
        }


        .history-value {
            font-size: 13px;
            font-weight: bold;
            color: #17332e;
        }


        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
        }


        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
        }


        .empty {
            text-align: center;
            padding: 45px 20px;
            color: #879691;
            font-size: 14px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .main {
                margin-left: 0;
                padding: 20px;
            }


            .info-grid {
                grid-template-columns: 1fr;
            }


            .history-info {
                grid-template-columns: 1fr 1fr;
            }


            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

        }


        @media (max-width: 600px) {

            .history-info {
                grid-template-columns: 1fr;
            }


            .verification-form {
                flex-direction: column;
                align-items: stretch;
            }

        }

    </style>

</head>


<body>


{{-- SIDEBAR PETUGAS --}}

@include('layouts.sidebar-petugas')


<main class="main">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="page-header">

        <h1>
            Penarikan Saldo
        </h1>

        <p>
            Kelola dan verifikasi pengajuan penarikan saldo dari nasabah.
        </p>

    </div>


    {{-- =====================================================
         SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
         ERROR
    ====================================================== --}}

    @if($errors->any())

        <div class="error">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif



    {{-- =====================================================
         PENDING
    ====================================================== --}}

    <div class="panel">


        <div class="panel-header">

            <div class="panel-title">
                Pengajuan Menunggu Verifikasi
            </div>


            <div class="total">

                {{ $penarikanPending->count() }}
                Pengajuan

            </div>

        </div>



        @if($penarikanPending->count() > 0)


            @foreach($penarikanPending as $penarikan)


                <div class="withdrawal-card">


                    <div class="withdrawal-header">


                        <div class="customer-name">

                            {{ $penarikan->nasabah->nama_lengkap
                                ?? $penarikan->nasabah->user->name
                                ?? 'Nasabah' }}

                        </div>


                        <div class="status status-pending">

                            MENUNGGU VERIFIKASI

                        </div>


                    </div>



                    <div class="info-grid">


                        <div class="info-item">

                            <div class="info-label">
                                Tanggal Pengajuan
                            </div>

                            <div class="info-value">

                                {{ \Carbon\Carbon::parse(
                                    $penarikan->tgl_pengajuan
                                )->format('d M Y') }}

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-label">
                                Nominal
                            </div>

                            <div class="info-value">

                                Rp {{ number_format(
                                    $penarikan->nominal,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>


                        <div class="info-item">

                            <div class="info-label">
                                Saldo Nasabah
                            </div>

                            <div class="info-value">

                                Rp {{ number_format(
                                    $penarikan->nasabah->saldo ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>


                    </div>



                    {{-- VERIFIKASI --}}

                    <form
                        action="{{ route(
                            'petugas.penarikan.verify',
                            $penarikan->id_penarikan
                        ) }}"
                        method="POST"
                        class="verification-form"
                    >

                        @csrf


                        <div class="form-group">

                            <label>
                                Kode Verifikasi
                            </label>


                            <input
                                type="text"
                                name="kode_verifikasi"
                                placeholder="Masukkan kode dari nasabah"
                                maxlength="10"
                                required
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            Verifikasi Penarikan

                        </button>


                    </form>


                </div>


            @endforeach


        @else


            <div class="empty">

                Belum ada pengajuan penarikan yang menunggu verifikasi.

            </div>


        @endif


    </div>



    {{-- =====================================================
         RIWAYAT VERIFIKASI
    ====================================================== --}}

    <div class="panel">


        <div class="panel-header">

            <div class="panel-title">
                Riwayat Penarikan Terverifikasi
            </div>


            <div class="total"
                 style="background:#e3f5eb; color:#298357;">

                {{ $penarikanSelesai->count() }}
                Penarikan

            </div>

        </div>



        {{-- FILTER TANGGAL --}}

        <div class="filter-box">


            <div class="filter-title">
                Filter Tanggal Verifikasi
            </div>


            <form
                method="GET"
                action="{{ route('petugas.penarikan.index') }}"
                class="filter-form"
            >


                <div class="filter-group">

                    <label>
                        Dari tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="{{ request('tanggal_mulai') }}"
                    >

                </div>


                <div class="filter-group">

                    <label>
                        Sampai tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal_akhir"
                        value="{{ request('tanggal_akhir') }}"
                    >

                </div>


                <button
                    type="submit"
                    class="btn btn-filter"
                >
                    Filter
                </button>


                <a
                    href="{{ route('petugas.penarikan.index') }}"
                    class="btn btn-reset"
                >
                    Reset
                </a>


            </form>


        </div>



        {{-- DATA RIWAYAT --}}

        @if($penarikanSelesai->count() > 0)


            @foreach($penarikanSelesai as $penarikan)


                <div class="history-card">


                    <div class="history-header">


                        <div class="history-name">

                            {{ $penarikan->nasabah->nama_lengkap
                                ?? $penarikan->nasabah->user->name
                                ?? 'Nasabah' }}

                        </div>


                        <div class="status status-approved">

                            TERVERIFIKASI

                        </div>


                    </div>



                    <div class="history-info">


                        <div class="history-item">

                            <div class="history-label">
                                Nominal
                            </div>

                            <div class="history-value">

                                Rp {{ number_format(
                                    $penarikan->nominal,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </div>

                        </div>


                        <div class="history-item">

                            <div class="history-label">
                                Tanggal Pengajuan
                            </div>

                            <div class="history-value">

                                {{ \Carbon\Carbon::parse(
                                    $penarikan->tgl_pengajuan
                                )->format('d M Y') }}

                            </div>

                        </div>


                        <div class="history-item">

                            <div class="history-label">
                                Tanggal Verifikasi
                            </div>

                            <div class="history-value">

                                {{ \Carbon\Carbon::parse(
                                    $penarikan->tanggal_verifikasi
                                )->format('d M Y H:i') }}

                            </div>

                        </div>


                        <div class="history-item">

                            <div class="history-label">
                                Petugas
                            </div>

                            <div class="history-value">

                                {{ $penarikan->petugas->name ?? 'Petugas' }}

                            </div>

                        </div>


                    </div>


                </div>


            @endforeach


        @else


            <div class="empty">

                Tidak ada riwayat penarikan yang sesuai dengan filter.

            </div>


        @endif


    </div>


</main>


</body>

</html>