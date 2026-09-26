<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>Edit Penarikan - Bank Sampah Griya Ayu</title>

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
            margin-bottom: 18px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            margin: 0;
            font-size: 17px;
            font-weight: bold;
            color: #17332e;
        }

        .card-description {
            margin: 6px 0 20px;
            font-size: 13px;
            color: #71847f;
        }

        /* =====================================================
           INFO SALDO
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
            font-size: 23px;
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

        .kode-info {
            font-size: 12px;
            color: #71847f;
            margin-top: 8px;
        }

        .kode-info strong {
            color: #2d765d;
            letter-spacing: 2px;
        }

        /* =====================================================
           ERROR
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

        /* =====================================================
           BUTTON
        ===================================================== */

        .buttons {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            padding: 10px 15px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-primary {
            background: #2d765d;
            color: white;
        }

        .btn-primary:hover {
            background: #25644f;
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
           RESPONSIVE
        ===================================================== */

        @media (max-width: 700px) {

            .main {
                margin-left: 190px;
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
            }

            .buttons .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

{{-- SIDEBAR NASABAH --}}
@include('layouts.sidebar-nasabah')


<main class="main">

    {{-- HEADER --}}
    <div class="page-header">

        <h1>
            Edit Penarikan
        </h1>

        <p>
            Ubah nominal pengajuan penarikan saldo Anda
        </p>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="alert-error">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    {{-- FORM --}}
    <div class="card">

        <h2 class="card-title">
            Edit Nominal Penarikan
        </h2>

        <p class="card-description">
            Perbarui nominal pengajuan penarikan Anda.
        </p>


        {{-- SALDO --}}
        <div class="saldo-box">

            <div class="saldo-label">
                Saldo Anda Saat Ini
            </div>

            <div class="saldo-value">
                Rp {{ number_format(
                    $nasabah->saldo ?? 0,
                    0,
                    ',',
                    '.'
                ) }}
            </div>

        </div>


        <form
            method="POST"
            action="{{ route(
                'nasabah.penarikan.update',
                $penarikan->id_penarikan
            ) }}"
        >

            @csrf
            @method('PUT')


            <div class="form-group">

                <label class="form-label">
                    Nominal Penarikan
                </label>

                <input
                    type="number"
                    name="nominal"
                    min="1000"
                    step="1000"
                    value="{{ old('nominal', $penarikan->nominal) }}"
                    required
                >

            </div>


            <div class="kode-info">

                Kode verifikasi tetap:

                <strong>
                    {{ $penarikan->kode_verifikasi }}
                </strong>

            </div>


            <div class="buttons">

                <a
                    href="{{ route('nasabah.penarikan.create') }}"
                    class="btn btn-secondary"
                >
                    ← Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</main>

</body>
</html>