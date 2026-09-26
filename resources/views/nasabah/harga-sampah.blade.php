<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Harga Sampah - Bank Sampah Griya Ayu</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

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

        .harga-panel {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .harga-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 18px 5px;

            border-bottom: 1px solid #edf1ef;
        }

        .harga-item:last-child {
            border-bottom: none;
        }

        .harga-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .harga-icon {
            width: 42px;
            height: 42px;

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #e6f5ed;
            color: #2d765d;

            font-size: 18px;
        }

        .harga-nama {
            font-size: 14px;
            font-weight: bold;
            color: #344a45;
        }

        .harga-keterangan {
            margin-top: 4px;
            font-size: 11px;
            color: #879691;
        }

        .harga-nilai {
            font-size: 17px;
            font-weight: bold;
            color: #2d765d;
        }

        .harga-satuan {
            font-size: 11px;
            font-weight: normal;
            color: #71847f;
        }

        .info-harga {
            margin-top: 18px;
            padding: 13px 15px;

            border-radius: 10px;

            background: #f1f8f5;
            color: #52746a;

            font-size: 12px;
            line-height: 1.5;
        }

        .empty {
            padding: 20px 0;

            color: #879691;
            font-size: 13px;
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
                Harga Sampah
            </h1>

            <p>
                Harga pembelian sampah yang berlaku saat ini
                di Bank Sampah Griya Ayu.
            </p>

        </div>


        {{-- DAFTAR HARGA --}}
        <div class="harga-panel">

            @if($hargaSampah->count() > 0)

                @foreach($hargaSampah as $harga)

                    <div class="harga-item">

                        <div class="harga-info">

                            <div class="harga-icon">
                                <i class="fa-solid fa-tags"></i>
                            </div>

                            <div>

                                <div class="harga-nama">
                                    {{ $harga->jenisSampah->nama_sampah }}
                                </div>

                                <div class="harga-keterangan">
                                    Harga per kilogram
                                </div>

                            </div>

                        </div>


                        <div class="harga-nilai">

                            Rp {{ number_format(
                                $harga->harga_per_kg,
                                0,
                                ',',
                                '.'
                            ) }}

                            <span class="harga-satuan">
                                / kg
                            </span>

                        </div>

                    </div>

                @endforeach

            @else

                <div class="empty">
                    Belum ada harga sampah yang tersedia.
                </div>

            @endif


            <div class="info-harga">

                <i class="fa-solid fa-circle-info"></i>

                Harga sampah dapat berubah sesuai
                kebijakan Bank Sampah Griya Ayu.

            </div>

        </div>

    </main>

</body>
</html>