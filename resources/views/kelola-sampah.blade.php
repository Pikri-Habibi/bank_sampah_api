<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="{{ asset('css/kelola-sampah.css') }}">

    <title>Kelola Sampah - Bank Sampah Griya Ayu</title>
</head>

<body>

    <!-- =========================
         SIDEBAR
    ========================= -->

    @include('layouts.sidebar-admin')

    <!-- =========================
         MAIN
    ========================= -->

    <main class="main">

        <div class="page-header">

            <div>
                <h1>
                    Master Harga Sampah
                </h1>

                <p>
                    Kelola daftar harga sampah per kilogram di Griya Ayu
                </p>
            </div>

            <button class="btn-add" onclick="openAddModal()">
                <i data-lucide="plus"></i>
                Tambah Jenis Sampah
            </button>

        </div>


        <!-- SEARCH -->

        <div class="filter-area">

            <div class="search-box">

                <span class="search-icon">
                    <i data-lucide="search"></i>
                </span>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari jenis sampah..."
                    oninput="filterData()"
                >

            </div>

            <select
                class="status-filter"
                id="statusFilter"
                onchange="filterData()"
            >

                <option value="all">
                    Semua Status
                </option>

                <option value="1">
                    Aktif
                </option>

                <option value="0">
                    Nonaktif
                </option>

            </select>

        </div>


        <!-- TABLE -->

        <div class="table-card">

            <table>

                <thead>

                    <tr>

                        <th>NO</th>

                        <th>JENIS SAMPAH</th>

                        <th>SATUAN</th>

                        <th>HARGA/KG</th>

                        <th>STATUS</th>

                        <th>AKSI</th>

                    </tr>

                </thead>

                <tbody id="tableBody">

                    <tr>
                        <td colspan="6" class="empty">
                            Memuat data...
                        </td>
                    </tr>

                </tbody>

            </table>


            <div class="table-footer">

                <div class="table-info" id="tableInfo">
                    Memuat data...
                </div>

                <div class="pagination">

                    <button class="page-btn">
                        <i data-lucide="chevron-left"></i>
                    </button>

                    <button class="page-btn active">
                        1
                    </button>

                    <button class="page-btn">
                        <i data-lucide="chevron-right"></i>
                    </button>

                </div>

            </div>

        </div>

    </main>


    <!-- =========================
         MODAL TAMBAH / EDIT
    ========================= -->

    <div class="modal" id="modal">

        <div class="modal-content">

            <h2 id="modalTitle">
                Tambah Harga Sampah
            </h2>

            <input
                type="hidden"
                id="editId"
            >

            <div class="form-group">

                <label>Jenis Sampah</label>

                <input
                    type="text"
                    id="jenisSampah"
                    placeholder="Contoh: Botol Kaca"
                >

            </div>


            <div class="form-group">

                <label>
                    Harga per Kg
                </label>

                <input
                    type="number"
                    id="harga"
                    placeholder="Contoh: 2000"
                >

            </div>


            <div class="form-group">

                <label>
                    Status
                </label>

                <select id="status">

                    <option value="1">
                        Aktif
                    </option>

                    <option value="0">
                        Nonaktif
                    </option>

                </select>

            </div>


            <div class="modal-buttons">

                <button
                    class="btn-cancel"
                    onclick="closeModal()"
                >
                    Batal
                </button>

                <button
                    class="btn-save"
                    onclick="saveData()"
                >
                    Simpan
                </button>

            </div>

        </div>

    </div>


    <!-- =========================
         JAVASCRIPT
    ========================= -->
    <script src="{{ asset('js/kelola-sampah.js') }}"></script>
</body>
</html>