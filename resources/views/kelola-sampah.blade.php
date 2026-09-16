<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Sampah - Bank Sampah Griya Ayu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #172b27;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100vh;
            background: #123d36;
            color: white;
            padding: 22px 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 32px;
        }

        .brand-icon {
            font-size: 34px;
        }

        .brand-name {
            font-size: 15px;
            font-weight: bold;
            line-height: 1.2;
        }

        .menu-title {
            color: #91afa8;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;

            text-decoration: none;
            color: #c6d6d2;

            padding: 11px 13px;
            border-radius: 9px;

            font-size: 14px;
        }

        .menu a:hover {
            background: #245f4f;
            color: white;
        }

        .menu a.active {
            background: #2d765d;
            color: white;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        /* USER */

        .sidebar-bottom {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 20px;

            border-top: 1px solid rgba(255,255,255,0.12);
            padding-top: 18px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;

            border-radius: 50%;
            background: #4eb37f;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 13px;
            font-weight: bold;
        }

        .user-name {
            font-size: 12px;
            font-weight: bold;
        }

        .user-role {
            font-size: 10px;
            color: #9bb5ae;
            margin-top: 2px;
        }

        .logout {
            color: #ff6464;
            text-decoration: none;
            font-size: 13px;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 230px;
            padding: 35px 32px;
            min-height: 100vh;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 27px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #7a8784;
            font-size: 14px;
        }

        /* =========================
           BUTTON
        ========================= */

        .btn-add {
            border: none;
            background: #2d765d;
            color: white;

            padding: 11px 17px;

            border-radius: 8px;

            font-size: 13px;
            font-weight: bold;

            cursor: pointer;
        }

        .btn-add:hover {
            background: #245f4f;
        }

        /* =========================
           FILTER
        ========================= */

        .filter-area {
            display: flex;
            gap: 14px;

            margin-bottom: 22px;
        }

        .search-box {
            flex: 1;

            position: relative;
        }

        .search-box input {
            width: 100%;

            padding: 11px 14px 11px 38px;

            border: 1px solid #dfe6e3;
            border-radius: 8px;

            background: white;

            outline: none;

            font-size: 13px;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 11px;

            color: #94a29e;
        }

        .status-filter {
            width: 150px;

            padding: 11px;

            border: 1px solid #dfe6e3;
            border-radius: 8px;

            background: white;

            font-size: 13px;

            outline: none;
        }

        /* =========================
           TABLE CARD
        ========================= */

        .table-card {
            background: white;

            border-radius: 13px;

            padding: 20px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f7faf9;
        }

        th {
            padding: 13px 16px;

            text-align: left;

            font-size: 11px;

            color: #697671;
        }

        td {
            padding: 15px 16px;

            font-size: 12px;

            border-top: 1px solid #edf1ef;
        }

        .name {
            font-weight: bold;
        }

        .unit {
            color: #73827e;
        }

        .price {
            color: #247051;
            font-weight: bold;
        }

        /* STATUS */

        .status {
            display: inline-block;

            padding: 5px 10px;

            border-radius: 7px;

            font-size: 10px;
            font-weight: bold;
        }

        .status.active {
            background: #e8f5ed;
            color: #28734f;
        }

        .status.inactive {
            background: #ffe8e8;
            color: #d92d2d;
        }

        /* ACTION */

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 25px;
            height: 25px;

            border: none;

            border-radius: 6px;

            cursor: pointer;

            font-size: 13px;
        }

        .btn-edit {
            background: #eaf5ef;
            color: #28734f;
        }

        .btn-delete {
            background: #ffe9e9;
            color: #d92d2d;
        }

        .empty {
            text-align: center;
            color: #8a9692;
            padding: 30px;
        }

        /* =========================
           FOOTER TABLE
        ========================= */

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 18px;
        }

        .table-info {
            color: #7b8783;
            font-size: 12px;
        }

        .pagination {
            display: flex;
            gap: 5px;
        }

        .page-btn {
            width: 28px;
            height: 28px;

            border: 1px solid #dfe6e3;

            background: white;

            border-radius: 6px;

            cursor: pointer;
        }

        .page-btn.active {
            background: #2d765d;
            color: white;
            border-color: #2d765d;
        }

        /* =========================
           MODAL
        ========================= */

        .modal {
            display: none;

            position: fixed;

            inset: 0;

            background: rgba(0,0,0,0.35);

            align-items: center;
            justify-content: center;

            z-index: 100;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            width: 400px;

            background: white;

            border-radius: 12px;

            padding: 25px;
        }

        .modal-content h2 {
            font-size: 19px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;

            font-size: 12px;
            font-weight: bold;

            margin-bottom: 7px;
        }

        .form-group input,
        .form-group select {
            width: 100%;

            padding: 10px;

            border: 1px solid #dfe6e3;

            border-radius: 7px;

            outline: none;

            font-size: 13px;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;

            gap: 8px;

            margin-top: 20px;
        }

        .btn-cancel {
            border: 1px solid #dfe6e3;

            background: white;

            padding: 9px 15px;

            border-radius: 7px;

            cursor: pointer;
        }

        .btn-save {
            border: none;

            background: #2d765d;
            color: white;

            padding: 9px 15px;

            border-radius: 7px;

            cursor: pointer;
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
                padding: 20px;
            }

            .page-header {
                align-items: flex-start;
                gap: 15px;
            }

            .filter-area {
                flex-direction: column;
            }

            .status-filter {
                width: 100%;
            }

            .table-card {
                overflow-x: auto;
            }

            table {
                min-width: 750px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         SIDEBAR
    ========================= -->

    <aside class="sidebar">

        <div class="brand">

            <div class="brand-icon">
                ♻
            </div>

            <div class="brand-name">
                Bank Sampah<br>
                Griya Ayu
            </div>

        </div>

        <div class="menu-title">
            Menu Koordinator
        </div>

        <nav class="menu">

            <a href="/dashboard-admin">
                <span class="menu-icon">▦</span>
                <span>Dashboard</span>
            </a>

            <a href="/kelola-sampah" class="active">
                <span class="menu-icon">▤</span>
                <span>Kelola Sampah</span>
            </a>

            <a href="#">
                <span class="menu-icon">◎</span>
                <span>Manajemen Pengguna</span>
            </a>

            <a href="#">
                <span class="menu-icon">↗</span>
                <span>Laporan</span>
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="user-info">

                <div class="user-avatar">
                    S
                </div>

                <div>
                    <div class="user-name">
                        Ibu Dina
                    </div>

                    <div class="user-role">
                        Admin
                    </div>
                </div>

            </div>

            <a href="#" class="logout">
                ⇥ Keluar
            </a>

        </div>

    </aside>


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
                ＋ Tambah Harga
            </button>

        </div>


        <!-- SEARCH -->

        <div class="filter-area">

            <div class="search-box">

                <span class="search-icon">
                    🔍
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
                        ‹
                    </button>

                    <button class="page-btn active">
                        1
                    </button>

                    <button class="page-btn">
                        ›
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

                <label>
                    Jenis Sampah
                </label>

                <select id="jenisSampah">

                    <option value="">
                        Pilih jenis sampah
                    </option>

                </select>

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

    <script>

        let jenisSampahData = [];
        let hargaData = [];


        /*
        ==========================================
        LOAD DATA JENIS SAMPAH
        ==========================================
        */

        async function loadJenisSampah() {

            try {

                const response = await fetch('/api/jenis-sampah');

                const result = await response.json();

                jenisSampahData = result.data ?? result;

                const select = document.getElementById('jenisSampah');

                select.innerHTML = `
                    <option value="">
                        Pilih jenis sampah
                    </option>
                `;

                jenisSampahData.forEach(item => {

                    select.innerHTML += `
                        <option value="${item.id_jenis_sampah}">
                            ${item.nama_sampah}
                        </option>
                    `;

                });

            } catch (error) {

                console.error(error);

                alert('Gagal mengambil data jenis sampah.');

            }

        }


        /*
        ==========================================
        LOAD DATA HARGA
        ==========================================
        */

        async function loadHarga() {

            try {

                const response = await fetch('/api/harga-sampah');

                const result = await response.json();

                hargaData = result.data ?? result;

                renderTable(hargaData);

            } catch (error) {

                console.error(error);

                document.getElementById('tableBody').innerHTML = `
                    <tr>
                        <td colspan="6" class="empty">
                            Gagal mengambil data harga sampah.
                        </td>
                    </tr>
                `;

            }

        }


        /*
        ==========================================
        RENDER TABLE
        ==========================================
        */

        function renderTable(data) {

            const tbody = document.getElementById('tableBody');

            tbody.innerHTML = '';

            if (data.length === 0) {

                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada data harga sampah.
                        </td>
                    </tr>
                `;

                document.getElementById('tableInfo').textContent =
                    'Menampilkan 0 data';

                return;
            }


            data.forEach((item, index) => {

                const jenis = jenisSampahData.find(
                    j => j.id_jenis_sampah == item.id_jenis_sampah
                );

                const namaSampah =
                    jenis?.nama_sampah ?? 'Tidak diketahui';


                const harga = Number(
                    item.harga_per_kg ?? 0
                ).toLocaleString('id-ID');


                const statusAktif =
                    Number(item.status) === 1;


                tbody.innerHTML += `

                    <tr>

                        <td>
                            ${index + 1}
                        </td>

                        <td class="name">
                            ${namaSampah}
                        </td>

                        <td class="unit">
                            Kg
                        </td>

                        <td class="price">
                            Rp ${harga}
                        </td>

                        <td>

                            <span class="status ${
                                statusAktif
                                ? 'active'
                                : 'inactive'
                            }">

                                ${
                                    statusAktif
                                    ? 'Aktif'
                                    : 'Nonaktif'
                                }

                            </span>

                        </td>

                        <td>

                            <div class="actions">

                                <button
                                    class="btn-action btn-edit"
                                    onclick="editData(${item.id_harga})"
                                    title="Edit"
                                >
                                    ✎
                                </button>

                                <button
                                    class="btn-action btn-delete"
                                    onclick="deleteData(${item.id_harga})"
                                    title="Hapus"
                                >
                                    🗑
                                </button>

                            </div>

                        </td>

                    </tr>

                `;

            });


            document.getElementById('tableInfo').textContent =
                `Menampilkan 1 - ${data.length} dari ${data.length} data`;

        }


        /*
        ==========================================
        FILTER
        ==========================================
        */

        function filterData() {

            const search =
                document.getElementById('searchInput')
                    .value
                    .toLowerCase();

            const status =
                document.getElementById('statusFilter')
                    .value;


            const filtered = hargaData.filter(item => {

                const jenis = jenisSampahData.find(
                    j => j.id_jenis_sampah == item.id_jenis_sampah
                );

                const nama =
                    jenis?.nama_sampah?.toLowerCase() ?? '';


                const cocokNama =
                    nama.includes(search);


                const cocokStatus =
                    status === 'all' ||
                    String(item.status) === status;


                return cocokNama && cocokStatus;

            });


            renderTable(filtered);

        }


        /*
        ==========================================
        OPEN ADD MODAL
        ==========================================
        */

        function openAddModal() {

            document.getElementById('modalTitle').textContent =
                'Tambah Harga Sampah';

            document.getElementById('editId').value = '';

            document.getElementById('jenisSampah').value = '';

            document.getElementById('harga').value = '';

            document.getElementById('status').value = '1';

            document
                .getElementById('modal')
                .classList.add('show');

        }


        /*
        ==========================================
        CLOSE MODAL
        ==========================================
        */

        function closeModal() {

            document
                .getElementById('modal')
                .classList.remove('show');

        }


        /*
        ==========================================
        EDIT DATA
        ==========================================
        */

        function editData(id) {

            const item = hargaData.find(
                data => data.id_harga == id
            );

            if (!item) {
                alert('Data tidak ditemukan.');
                return;
            }


            document.getElementById('modalTitle').textContent =
                'Edit Harga Sampah';


            document.getElementById('editId').value =
                item.id_harga;


            document.getElementById('jenisSampah').value =
                item.id_jenis_sampah;


            document.getElementById('harga').value =
                item.harga_per_kg;


            document.getElementById('status').value =
                item.status;


            document
                .getElementById('modal')
                .classList.add('show');

        }


        /*
        ==========================================
        SAVE DATA
        ==========================================
        */

        async function saveData() {

            const id =
                document.getElementById('editId').value;

            const idJenis =
                document.getElementById('jenisSampah').value;

            const harga =
                document.getElementById('harga').value;

            const status =
                document.getElementById('status').value;


            if (!idJenis || !harga) {

                alert(
                    'Jenis sampah dan harga wajib diisi.'
                );

                return;
            }


            const data = {

                id_jenis_sampah: idJenis,

                harga_per_kg: harga,

                status: status

            };


            try {

                let response;


                if (id) {

                    /*
                    EDIT
                    */

                    response = await fetch(
                        `/api/harga-sampah/${id}`,
                        {
                            method: 'PUT',

                            headers: {
                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json'
                            },

                            body: JSON.stringify(data)
                        }
                    );

                } else {

                    /*
                    TAMBAH
                    */

                    response = await fetch(
                        '/api/harga-sampah',
                        {
                            method: 'POST',

                            headers: {
                                'Content-Type':
                                    'application/json',

                                'Accept':
                                    'application/json'
                            },

                            body: JSON.stringify(data)
                        }
                    );

                }


                if (!response.ok) {

                    const error =
                        await response.json();

                    console.error(error);

                    alert(
                        'Gagal menyimpan data.'
                    );

                    return;

                }


                alert(
                    id
                    ? 'Harga berhasil diperbarui.'
                    : 'Harga berhasil ditambahkan.'
                );


                closeModal();

                await loadHarga();

            } catch (error) {

                console.error(error);

                alert(
                    'Terjadi kesalahan saat menyimpan data.'
                );

            }

        }


        /*
        ==========================================
        DELETE DATA
        ==========================================
        */

        async function deleteData(id) {

            const yakin = confirm(
                'Yakin ingin menghapus harga sampah ini?'
            );


            if (!yakin) {
                return;
            }


            try {

                const response = await fetch(
                    `/api/harga-sampah/${id}`,
                    {
                        method: 'DELETE',

                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


                if (!response.ok) {

                    alert(
                        'Gagal menghapus data.'
                    );

                    return;

                }


                alert(
                    'Harga sampah berhasil dihapus.'
                );


                await loadHarga();

            } catch (error) {

                console.error(error);

                alert(
                    'Terjadi kesalahan saat menghapus data.'
                );

            }

        }


        /*
        ==========================================
        INITIAL LOAD
        ==========================================
        */

        async function init() {

            await loadJenisSampah();

            await loadHarga();

        }


        init();

    </script>

</body>
</html>