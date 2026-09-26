<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>Setor Sampah - Bank Sampah Griya Ayu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #172b2b;
        }

        .petugas-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #50ba8c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .petugas-name {
            font-size: 12px;
            font-weight: bold;
        }

        .petugas-role {
            font-size: 10px;
            color: #a9cbc4;
            margin-top: 2px;
        }

        .logout {
            color: #ff6b61 !important;
            padding-left: 0 !important;
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
            margin-bottom: 32px;
        }

        .page-header h1 {
            margin: 0 0 5px;
            font-size: 28px;
            color: #153b38;
        }

        .page-header p {
            margin: 0;
            color: #6b7f7b;
            font-size: 14px;
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
        }

        .card-title {
            margin: 0;
            font-size: 19px;
            color: #172b2b;
        }

        .card-description {
            margin: 5px 0 0;
            font-size: 13px;
            color: #7b8b88;
        }


        /* =========================
           FORM
        ========================= */

        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
            color: #203735;
        }

        select,
        input {
            width: 100%;
            height: 41px;
            border: 1px solid #d7e1df;
            border-radius: 8px;
            padding: 0 13px;
            font-size: 13px;
            background: white;
            color: #253735;
            outline: none;
        }

        select:focus,
        input:focus {
            border-color: #2c8069;
            box-shadow: 0 0 0 3px rgba(44, 128, 105, 0.08);
        }


        /* =========================
           BUTTON
        ========================= */

        button {
            font-family: inherit;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-primary {
            background: #2c8069;
            color: white;
        }

        .btn-primary:hover {
            background: #246c59;
        }

        .btn-danger {
            background: #fff1f0;
            color: #d84b43;
            border: 1px solid #ffd2ce;
        }

        .btn-danger:hover {
            background: #ffe4e1;
        }

        .btn-cancel {
            background: white;
            color: #374b48;
            border: 1px solid #d9e1df;
        }

        .btn-cancel:hover {
            background: #f7f9f8;
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
            padding: 13px 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .setoran-table td {
            padding: 10px;
            border-bottom: 1px solid #edf1f0;
            vertical-align: middle;
            font-size: 13px;
        }

        .setoran-table td:first-child,
        .setoran-table th:first-child {
            text-align: center;
            width: 50px;
        }

        .setoran-table .harga {
            white-space: nowrap;
        }

        .setoran-table .subtotal {
            font-weight: bold;
            white-space: nowrap;
        }

        .empty-row td {
            text-align: center !important;
            color: #899693;
            padding: 35px 10px;
        }


        /* =========================
           TOTAL
        ========================= */

        .total-section {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #edf1f0;
        }

        .total-box {
            text-align: right;
        }

        .total-label {
            font-size: 12px;
            color: #7b8b88;
            margin-bottom: 4px;
        }

        .total-value {
            font-size: 24px;
            font-weight: bold;
            color: #16715e;
        }


        /* =========================
           ACTION
        ========================= */

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }


        /* =========================
           ERROR
        ========================= */

        .alert-error {
            background: #fff1f0;
            color: #b42318;
            border: 1px solid #ffd3cf;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
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
        }
    </style>
</head>

<body>

    <!-- =========================
         SIDEBAR
    ========================== -->

    @include('layouts.sidebar-petugas')


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main">

        <div class="content">

            <!-- HEADER -->

            <div class="page-header">

                <h1>
                    Setor Sampah
                </h1>

                <p>
                    Input data setoran sampah dari nasabah
                </p>

            </div>


            <!-- ERROR -->

            @if ($errors->any())

                <div class="alert-error">

                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach

                </div>

            @endif


            <form method="POST" action="{{ route('petugas.setoran.store') }}">

                @csrf


                <!-- =========================
                     NASABAH
                ========================== -->

                <div class="card">

                    <div class="card-header">

                        <div>
                            <h2 class="card-title">
                                Pilih Nasabah
                            </h2>
                        </div>

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Nasabah
                        </label>

                        <select name="id_pengguna_nasabah" required>

                            <option value="">
                                Pilih nasabah
                            </option>

                            @foreach($nasabahList as $nasabah)

                                <option value="{{ $nasabah->id_pengguna_nasabah }}">

                                    {{ $nasabah->user->name ?? $nasabah->nama_lengkap }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <!-- =========================
                     DETAIL SAMPAH
                ========================== -->

                <div class="card">

                    <div class="card-header">

                        <div>

                            <h2 class="card-title">
                                Detail Sampah
                            </h2>

                            <p class="card-description">
                                Masukkan jenis dan berat sampah yang disetorkan
                            </p>

                        </div>


                        <button
                            type="button"
                            class="btn btn-primary"
                            onclick="tambahJenisSampah()"
                        >
                            + Tambah Jenis Sampah
                        </button>

                    </div>


                    <div class="table-wrapper">

                        <table class="setoran-table">

                            <thead>

                                <tr>

                                    <th>No</th>

                                    <th>Jenis Sampah</th>

                                    <th>Berat (Kg)</th>

                                    <th>Harga/Kg</th>

                                    <th>Subtotal</th>

                                    <th>Aksi</th>

                                </tr>

                            </thead>

                            <tbody id="detailSampah">

                                <tr class="empty-row" id="emptyRow">

                                    <td colspan="6">
                                        Belum ada jenis sampah.
                                        Klik "+ Tambah Jenis Sampah".
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>


                    <!-- TOTAL -->

                    <div class="total-section">

                        <div class="total-box">

                            <div class="total-label">
                                Total Pendapatan
                            </div>

                            <div class="total-value" id="totalPendapatan">
                                Rp 0
                            </div>

                        </div>

                    </div>


                    <!-- BUTTON -->

                    <div class="action-buttons">

                        <a
                            href="{{ route('petugas.dashboard') }}"
                            class="btn btn-cancel"
                            style="text-decoration:none;"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Simpan Transaksi
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </main>


    <!-- =========================
         JAVASCRIPT
    ========================== -->

    <script>

        let nomorBaris = 0;


        /*
        |--------------------------------------------------------------------------
        | Data Jenis Sampah
        |--------------------------------------------------------------------------
        |
        | Data ini diambil dari Laravel.
        |
        */

        const jenisSampah = @json(
            $jenisSampah->map(function ($jenis) {

                $harga = $jenis->harga->first();

                return [
                    'id' => $jenis->id_jenis_sampah,
                    'nama' => $jenis->nama_sampah,
                    'harga' => $harga ? (float) $harga->harga_per_kg : 0
                ];

            })->values()
        );


        /*
        |--------------------------------------------------------------------------
        | Format Rupiah
        |--------------------------------------------------------------------------
        */

        function formatRupiah(angka)
        {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(angka);
        }


        /*
        |--------------------------------------------------------------------------
        | Tambah Jenis Sampah
        |--------------------------------------------------------------------------
        */

        function tambahJenisSampah()
        {
            const emptyRow = document.getElementById('emptyRow');

            if (emptyRow) {
                emptyRow.remove();
            }

            const tbody = document.getElementById('detailSampah');

            const index = nomorBaris++;

            let options = `
                <option value="">
                    Pilih jenis sampah
                </option>
            `;

            jenisSampah.forEach(function(jenis) {

                options += `
                    <option
                        value="${jenis.id}"
                        data-harga="${jenis.harga}"
                    >
                        ${jenis.nama}
                    </option>
                `;

            });


            const row = document.createElement('tr');

            row.dataset.index = index;

            row.innerHTML = `

                <td>
                    ${index + 1}
                </td>


                <td>

                    <select
                        name="items[${index}][id_jenis_sampah]"
                        class="jenis-sampah"
                        onchange="ubahHarga(this)"
                        required
                    >

                        ${options}

                    </select>

                </td>


                <td>

                    <input
                        type="number"
                        name="items[${index}][berat_kg]"
                        class="berat-sampah"
                        min="0.01"
                        step="0.01"
                        placeholder="0"
                        oninput="hitungSubtotal(this)"
                        required
                    >

                </td>


                <td class="harga">
                    Rp 0
                </td>


                <td class="subtotal">
                    Rp 0
                </td>


                <td>

                    <button
                        type="button"
                        class="btn btn-danger"
                        onclick="hapusBaris(this)"
                    >
                        Hapus
                    </button>

                </td>

            `;


            tbody.appendChild(row);

        }


        /*
        |--------------------------------------------------------------------------
        | Ketika Jenis Sampah Dipilih
        |--------------------------------------------------------------------------
        */

        function ubahHarga(select)
        {
            const row = select.closest('tr');

            const option =
                select.options[select.selectedIndex];

            const harga =
                Number(option.dataset.harga || 0);

            row.querySelector('.harga').textContent =
                formatRupiah(harga);

            hitungSubtotal(
                row.querySelector('.berat-sampah')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Hitung Subtotal
        |--------------------------------------------------------------------------
        */

        function hitungSubtotal(input)
        {
            const row = input.closest('tr');

            const select =
                row.querySelector('.jenis-sampah');

            const option =
                select.options[select.selectedIndex];

            const harga =
                Number(option?.dataset.harga || 0);

            const berat =
                Number(input.value || 0);

            const subtotal =
                harga * berat;


            row.querySelector('.subtotal').textContent =
                formatRupiah(subtotal);


            hitungTotal();
        }


        /*
        |--------------------------------------------------------------------------
        | Hitung Total Semua Sampah
        |--------------------------------------------------------------------------
        */

        function hitungTotal()
        {
            let total = 0;

            document
                .querySelectorAll('#detailSampah tr')
                .forEach(function(row) {

                    const select =
                        row.querySelector('.jenis-sampah');

                    const input =
                        row.querySelector('.berat-sampah');


                    if (!select || !input) {
                        return;
                    }


                    const option =
                        select.options[select.selectedIndex];

                    const harga =
                        Number(option?.dataset.harga || 0);

                    const berat =
                        Number(input.value || 0);


                    total += harga * berat;

                });


            document.getElementById('totalPendapatan')
                .textContent = formatRupiah(total);
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus Baris
        |--------------------------------------------------------------------------
        */

        function hapusBaris(button)
        {
            const row =
                button.closest('tr');

            row.remove();

            const tbody =
                document.getElementById('detailSampah');

            const rows =
                tbody.querySelectorAll('tr');

            if (rows.length === 0) {

                tbody.innerHTML = `

                    <tr class="empty-row" id="emptyRow">

                        <td colspan="6">

                            Belum ada jenis sampah.
                            Klik "+ Tambah Jenis Sampah".

                        </td>

                    </tr>

                `;

                nomorBaris = 0;

            } else {

                // Rapikan nomor yang terlihat
                rows.forEach(function(row, index) {

                    row.querySelector('td').textContent =
                        index + 1;

                });

                // Sesuaikan nomor untuk baris berikutnya
                nomorBaris = rows.length;
            }

            hitungTotal();
        }

    </script>

</body>
</html>