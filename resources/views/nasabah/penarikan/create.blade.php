<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>Pengajuan Penarikan - Bank Sampah Griya Ayu</title>

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
            width: 100%;
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
           PANEL / CARD
        ===================================================== */

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            margin-bottom: 18px;
        }

        .card-title {
            margin: 0;
            font-size: 17px;
            font-weight: bold;
            color: #17332e;
        }

        .card-description {
            margin: 6px 0 0;
            font-size: 13px;
            color: #71847f;
        }

        /* =====================================================
           SALDO
        ===================================================== */

        .saldo-box {
            background: #eaf6f1;
            border: 1px solid #d6ebe3;
            border-radius: 10px;
            padding: 16px 18px;
            margin-bottom: 20px;
        }

        .saldo-label {
            font-size: 12px;
            color: #71847f;
            margin-bottom: 5px;
        }

        .saldo-value {
            font-size: 24px;
            font-weight: bold;
            color: #2d765d;
        }

        /* =====================================================
           FORM
        ===================================================== */

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
            color: #17332e;
        }

        input {
            width: 100%;
            height: 43px;
            border: 1px solid #d7e1df;
            border-radius: 8px;
            padding: 0 13px;
            font-size: 13px;
            background: white;
            color: #253735;
            outline: none;
        }

        input:focus {
            border-color: #2d765d;
            box-shadow: 0 0 0 3px rgba(45, 118, 93, 0.08);
        }

        .form-help {
            margin-top: 7px;
            font-size: 12px;
            color: #879691;
        }

        /* =====================================================
           BUTTON
        ===================================================== */

        button {
            font-family: inherit;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
        }

        .btn-primary {
            background: #2d765d;
            color: white;
        }

        .btn-primary:hover {
            background: #25644f;
        }

        .btn-edit {
            background: #eaf2ff;
            color: #2563eb;
            border: 1px solid #d6e5ff;
        }

        .btn-danger {
            background: #fff1f0;
            color: #d84b43;
            border: 1px solid #ffd2ce;
        }

        .btn-secondary {
            background: white;
            color: #374b48;
            border: 1px solid #d9e1df;
        }

        .btn-secondary:hover {
            background: #f7f9f8;
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .alert-error {
            background: #fff1f0;
            color: #b42318;
            border: 1px solid #ffd3cf;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success {
            background: #effaf5;
            color: #16715e;
            border: 1px solid #cce9dc;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        /* =====================================================
           PENGAJUAN
        ===================================================== */

        .pengajuan {
            border: 1px solid #e3ebe9;
            border-radius: 11px;
            padding: 18px;
            margin-bottom: 12px;
        }

        .pengajuan:last-child {
            margin-bottom: 0;
        }

        .pengajuan-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 14px;
        }

        .pengajuan-title {
            margin: 0;
            font-size: 15px;
            color: #17332e;
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
           DATA
        ===================================================== */

        .data-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .data-box {
            background: #f7f9f8;
            border-radius: 8px;
            padding: 12px;
        }

        .data-label {
            display: block;
            font-size: 11px;
            color: #7c8d89;
            margin-bottom: 5px;
        }

        .data-value {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #253735;
        }

        .kode {
            color: #2d765d;
            letter-spacing: 2px;
            font-size: 15px;
        }

        /* =====================================================
           FOOTER PENGAJUAN
        ===================================================== */

        .pengajuan-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 15px;
            padding-top: 14px;
            border-top: 1px solid #edf1ef;
        }

        .pending-info {
            font-size: 12px;
            color: #7b8b88;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
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

        .nominal-keluar {
            font-weight: bold;
            color: #d95353;
        }
        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1000px) {

            .main {
                margin-left: 230px;
                padding: 25px;
            }

            .data-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {

            .main {
                margin-left: 190px;
                padding: 20px;
            }

            .pengajuan-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .pengajuan-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .action-buttons {
                width: 100%;
            }

            .action-buttons .btn,
            .action-buttons form {
                flex: 1;
            }

            .action-buttons form button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

{{-- SIDEBAR NASABAH --}}
@include('layouts.sidebar-nasabah')


<main class="main">

    <div class="content">

        {{-- HEADER --}}
        <div class="page-header">

            <h1>
                Pengajuan Penarikan
            </h1>

            <p>
                Kelola pengajuan penarikan saldo Anda
            </p>

        </div>


        {{-- ERROR --}}
        @if($errors->any())

            <div class="alert-error">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- FORM PENARIKAN --}}
        <div class="card">

            <div class="card-header">

                <h2 class="card-title">
                    Ajukan Penarikan
                </h2>

                <p class="card-description">
                    Masukkan nominal saldo yang ingin Anda tarik
                </p>

            </div>


            <div class="saldo-box">

                <div class="saldo-label">
                    Saldo Saat Ini
                </div>

                <div class="saldo-value">
                    Rp {{ number_format($nasabah->saldo ?? 0, 0, ',', '.') }}
                </div>

            </div>


            <form
                method="POST"
                action="{{ route('nasabah.penarikan.store') }}"
            >

                @csrf

                <div class="form-group">

                    <label class="form-label">
                        Nominal Penarikan
                    </label>

                    <input
                        type="number"
                        name="nominal"
                        min="1000"
                        step="500"
                        value="{{ old('nominal') }}"
                        placeholder="Masukkan nominal penarikan"
                        required
                    >

                    <div class="form-help">
                        Minimal penarikan Rp 1.000.
                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Ajukan Penarikan
                </button>

            </form>

        </div>


        {{-- DAFTAR PENGAJUAN --}}
        <div class="card">

            <div class="card-header">

                <h2 class="card-title">
                    Pengajuan Saya
                </h2>

                <p class="card-description">
                    Daftar pengajuan penarikan yang pernah Anda buat
                </p>

            </div>


            @if($penarikanList->count() > 0)

                @foreach($penarikanList as $penarikan)

                    <div class="pengajuan">

                        <div class="pengajuan-header">

                            <h3 class="pengajuan-title">
                                Pengajuan #{{ $penarikan->id_penarikan }}
                            </h3>

                            @if($penarikan->status === 'pending')

                                <span class="status status-pending">
                                    Pending
                                </span>

                            @elseif($penarikan->status === 'approved')

                                <span class="status status-approved">
                                    Approved
                                </span>

                            @elseif($penarikan->status === 'rejected')

                                <span class="status status-rejected">
                                    Rejected
                                </span>

                            @else

                                <span class="status">
                                    {{ ucfirst($penarikan->status) }}
                                </span>

                            @endif

                        </div>


                        <div class="data-grid">

                            <div class="data-box">

                                <span class="data-label">
                                    Nominal
                                </span>

                                <span class="data-value">
                                    Rp {{ number_format(
                                        (float) $penarikan->nominal,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </div>


                            <div class="data-box">

                                <span class="data-label">
                                    Kode Verifikasi
                                </span>

                                <span class="data-value kode">
                                    {{ $penarikan->kode_verifikasi }}
                                </span>

                            </div>


                            <div class="data-box">

                                <span class="data-label">
                                    Tanggal Pengajuan
                                </span>

                                <span class="data-value">
                                    {{ \Carbon\Carbon::parse($penarikan->tgl_pengajuan)->format('d/m/Y') }}
                                </span>

                            </div>

                        </div>


                        @if($penarikan->status === 'pending')

                            <div class="pengajuan-footer">

                                <div class="pending-info">
                                    Pengajuan masih menunggu verifikasi petugas.
                                </div>

                                <div class="action-buttons">

                                    <a
                                        href="{{ route(
                                            'nasabah.penarikan.edit',
                                            $penarikan->id_penarikan
                                        ) }}"
                                        class="btn btn-edit"
                                    >
                                        ✎ Edit
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'nasabah.penarikan.destroy',
                                            $penarikan->id_penarikan
                                        ) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus pengajuan penarikan ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                        >
                                            🗑 Hapus
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @elseif($penarikan->status === 'approved')

                            <div class="pengajuan-footer">

                                <div class="pending-info">
                                    Penarikan telah diverifikasi oleh petugas.
                                </div>

                            </div>

                        @elseif($penarikan->status === 'rejected')

                            <div class="pengajuan-footer">

                                <div class="pending-info">
                                    Pengajuan penarikan ditolak.
                                </div>

                            </div>

                        @endif

                    </div>

                @endforeach

            @else

                <div class="empty">
                    Belum ada pengajuan penarikan.
                </div>

            @endif

        </div>

    </div>

</main>

</body>
</html>