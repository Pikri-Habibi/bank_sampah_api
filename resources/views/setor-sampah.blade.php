<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Setor Sampah - Bank Sampah Griya Ayu</title>

    <link rel="stylesheet" href="{{ asset('css/setor-sampah.css') }}">
</head>

<body>

    @include('layouts.sidebar-petugas')

    <main class="main">

        <div class="page-header">

            <div>
                <h1>Setor Sampah</h1>

                <p>
                    Input data setoran sampah dari nasabah
                </p>
            </div>

        </div>


        <!-- DATA NASABAH -->

        <div class="card">

            <h2>Pilih Nasabah</h2>

            <div class="form-group">

                <label for="nasabah">
                    Nasabah
                </label>

                <select id="nasabah">

                    <option value="">
                        Pilih nasabah
                    </option>

                </select>

            </div>

        </div>


        <!-- DETAIL SAMPAH -->

        <div class="card">

            <div class="card-header">

                <div>
                    <h2>Detail Sampah</h2>

                    <p>
                        Masukkan jenis dan berat sampah yang disetorkan
                    </p>
                </div>

                <button
                    type="button"
                    id="btnTambahSampah"
                >
                    + Tambah Jenis Sampah
                </button>

            </div>


            <div class="table-wrapper">

                <table>

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

                        <!-- BARIS SAMPAH AKAN DITAMBAHKAN DENGAN JAVASCRIPT -->

                    </tbody>

                </table>

            </div>


            <!-- TOTAL -->

            <div class="total-section">

                <div>

                    <span>Total Pendapatan</span>

                    <strong id="totalPendapatan">
                        Rp 0
                    </strong>

                </div>

            </div>


            <!-- BUTTON -->

            <div class="form-actions">

                <button
                    type="button"
                    id="btnBatal"
                >
                    Batal
                </button>

                <button
                    type="button"
                    id="btnSimpan"
                >
                    Simpan Transaksi
                </button>

            </div>

        </div>

    </main>
    <script src="{{ asset('js/setor-sampah.js') }}"></script>
</body>

</html>