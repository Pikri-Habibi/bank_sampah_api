<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
    <title>Kelola Pengguna - Bank Sampah</title>

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

        /* ================= MAIN CONTENT ================= */

        .main {
            margin-left: 230px;
            min-height: 100vh;
            padding: 32px 40px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 14px;
        }

        /* ================= ALERT ================= */

        .alert {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .alert svg {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            flex-shrink: 0;
        }

        .alert-error {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        /* ================= TOPBAR ================= */

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .btn-primary {
            background-color: #123d36;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #1a5549;
        }

        .btn-primary svg {
            width: 16px;
            height: 16px;
        }

        /* ================= STATS ================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            padding: 18px 20px;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            border: 1px solid #eef0ef;
        }

        .stat-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #123d36;
        }

        .stat-sub {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 2px;
        }

        /* ================= TABLE ================= */

        .table-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            overflow: hidden;
            border: 1px solid #eef0ef;
        }

        .table-header {
            padding: 16px 20px;
            border-bottom: 1px solid #eef0ef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 8px 12px 8px 34px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 13px;
            width: 240px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #123d36;
        }

        .search-box svg {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #9ca3af;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            padding: 12px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        th:last-child {
            text-align: center;
        }

        tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.15s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        td {
            padding: 14px 20px;
            font-size: 14px;
            white-space: nowrap;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-cell-avatar {
            width: 36px;
            height: 36px;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 13px;
            flex-shrink: 0;
        }

        .user-cell-name {
            font-weight: 500;
            color: #111827;
        }

        /* ================= BADGE ================= */

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-admin {
            background-color: #f3e8ff;
            color: #6b21a8;
        }

        .badge-petugas {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-nasabah {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* ================= ACTION ================= */

        .actions {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-icon {
            background: #f3f4f6;
            border: none;
            cursor: pointer;
            padding: 7px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-icon:hover {
            background: #e5e7eb;
        }

        .btn-icon svg {
            width: 15px;
            height: 15px;
        }

        .btn-edit {
            color: #2563eb;
        }

        .btn-delete {
            color: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
            font-size: 14px;
        }

        /* ================= MODAL ================= */

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow-y: auto;
            padding: 40px 20px;
        }

        .modal.active {
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            padding: 24px;
            position: relative;
            animation: slideUp 0.25s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 17px;
            font-weight: 600;
            color: #111827;
        }

        .btn-close {
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            padding: 4px;
            border-radius: 6px;
        }

        .btn-close:hover {
            background: #f3f4f6;
            color: #6b7280;
        }

        .btn-close svg {
            width: 20px;
            height: 20px;
        }

        /* ================= FORM ================= */

        .form-group {
            margin-bottom: 14px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            font-family: inherit;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #123d36;
            box-shadow: 0 0 0 3px rgba(18, 61, 54, 0.1);
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            flex: 1;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-family: inherit;
        }

        .btn-submit {
            background-color: #123d36;
            color: white;
        }

        .btn-submit:hover {
            background-color: #1a5549;
        }

        .btn-cancel {
            background-color: #f3f4f6;
            color: #374151;
        }

        .btn-cancel:hover {
            background-color: #e5e7eb;
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        /* ================= DELETE ================= */

        .delete-modal-content {
            text-align: center;
        }

        .delete-icon {
            width: 56px;
            height: 56px;
            background-color: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .delete-icon svg {
            width: 28px;
            height: 28px;
            color: #dc2626;
        }

        .delete-title {
            font-size: 17px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .delete-message {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 20px;
        }

        .delete-message strong {
            color: #111827;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    @include('layouts.sidebar-admin')


    <!-- MAIN CONTENT -->
    <main class="main">

        <div class="page-header">
            <h1>Kelola Pengguna</h1>
            <p>Manajemen data pengguna sistem bank sampah</p>
        </div>


        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="alert">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                <span>{{ session('success') }}</span>
            </div>
        @endif


        <!-- VALIDATION ERROR -->
        @if($errors->any())
            <div class="alert alert-error">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif


        <!-- STATS -->
        <div class="stats">

            <div class="stat-card">
                <div class="stat-label">Total Pengguna</div>

                <div class="stat-value">
                    {{ $users->count() }}
                </div>

                <div class="stat-sub">
                    Semua role
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-label">Admin</div>

                <div class="stat-value">
                    {{ $users->where('role', 'admin')->count() }}
                </div>

                <div class="stat-sub">
                    Pengelola sistem
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-label">Petugas</div>

                <div class="stat-value">
                    {{ $users->where('role', 'petugas')->count() }}
                </div>

                <div class="stat-sub">
                    Petugas lapangan
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-label">Nasabah</div>

                <div class="stat-value">
                    {{ $users->where('role', 'nasabah')->count() }}
                </div>

                <div class="stat-sub">
                    Nasabah aktif
                </div>
            </div>

        </div>


        <!-- TOPBAR -->
        <div class="topbar">

            <div></div>

            <button class="btn-primary" onclick="openAddModal()">

                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"/>
                </svg>

                Tambah Pengguna

            </button>

        </div>


        <!-- TABLE -->
        <div class="table-container">

            <div class="table-header">

                <div class="table-title">
                    Daftar Pengguna
                </div>

                <div class="search-box">

                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>

                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Cari pengguna..."
                        oninput="searchTable()"
                    >

                </div>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($users as $index => $u)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>


                                <td>

                                    <div class="user-cell">

                                        <div class="user-cell-avatar">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </div>

                                        <div class="user-cell-name">
                                            {{ $u->name }}
                                        </div>

                                    </div>

                                </td>


                                <td style="color:#6b7280;">
                                    {{ $u->email }}
                                </td>


                                <td>

                                    <span class="badge badge-{{ $u->role }}">
                                        {{ ucfirst($u->role) }}
                                    </span>

                                </td>


                                <td>

                                    <span class="badge badge-{{ $u->status ?? 'active' }}">

                                        {{
                                            ($u->status ?? 'active') == 'active'
                                                ? 'Aktif'
                                                : 'Nonaktif'
                                        }}

                                    </span>

                                </td>


                                <td>

                                    <div class="actions">

                                        <!-- EDIT -->
                                        <button
                                            type="button"
                                            class="btn-icon btn-edit"
                                            onclick="openEditModal(
                                                {{ $u->id }},
                                                '{{ addslashes($u->name) }}',
                                                '{{ $u->role }}',
                                                '{{ $u->status ?? 'active' }}'
                                            )"
                                            title="Edit"
                                        >

                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>

                                        </button>


                                        <!-- DELETE -->
                                        @if (! $u->isProtected())
                                            <button
                                                type="button"
                                                class="btn-icon btn-delete"
                                                onclick="openDeleteModal(
                                                    {{ $u->id }},
                                                    '{{ addslashes($u->name) }}'
                                                )"
                                                title="Hapus"
                                            >

                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>

                                            </button>
                                        @else
                                            <button
                                                type="button"
                                                class="btn-icon btn-delete"
                                                title="Super Admin utama tidak dapat dihapus"
                                                style="opacity: 0.5; cursor: not-allowed;"
                                                disabled
                                            >
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z"/>
                                                </svg>
                                            </button>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="empty-state">
                                    Tidak ada data pengguna
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>


    <!-- ================================================= -->
    <!-- ADD MODAL -->
    <!-- ================================================= -->

    <div id="addModal" class="modal">

        <div class="modal-content">

            <div class="modal-header">

                <h3 class="modal-title">
                    Tambah Pengguna Baru
                </h3>

                <button
                    type="button"
                    class="btn-close"
                    onclick="closeAddModal()"
                >

                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                </button>

            </div>


            <!-- FORM LARAVEL -->
            <form
                action="{{ route('admin.users.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-group">

                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-input"
                        value="{{ old('name') }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-input"
                        required
                        minlength="6"
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Role
                    </label>

                    <select
                        name="role"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Pilih Role
                        </option>

                        <option value="admin">
                            Admin
                        </option>

                        <option value="petugas">
                            Petugas
                        </option>

                        <option value="nasabah">
                            Nasabah
                        </option>

                    </select>

                </div>


                <div class="modal-actions">

                    <button
                        type="button"
                        class="btn btn-cancel"
                        onclick="closeAddModal()"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-submit"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- EDIT MODAL -->
    <!-- ================================================= -->

    <div id="editModal" class="modal">

        <div class="modal-content">

            <div class="modal-header">

                <h3 class="modal-title">
                    Edit Pengguna
                </h3>

                <button
                    type="button"
                    class="btn-close"
                    onclick="closeEditModal()"
                >

                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                </button>

            </div>


            <form
                id="editUserForm"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="form-group">

                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="editName"
                        class="form-input"
                        required
                    >

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Role
                    </label>

                    <select
                        name="role"
                        id="editRole"
                        class="form-select"
                        required
                    >

                        <option value="admin">
                            Admin
                        </option>

                        <option value="petugas">
                            Petugas
                        </option>

                        <option value="nasabah">
                            Nasabah
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        id="editStatus"
                        class="form-select"
                        required
                    >

                        <option value="active">
                            Aktif
                        </option>

                        <option value="inactive">
                            Nonaktif
                        </option>

                    </select>

                </div>


                <div class="modal-actions">

                    <button
                        type="button"
                        class="btn btn-cancel"
                        onclick="closeEditModal()"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-submit"
                    >
                        Update
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- DELETE MODAL -->
    <!-- ================================================= -->

    <div id="deleteModal" class="modal">

        <div class="modal-content delete-modal-content">

            <div class="delete-icon">

                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>

            </div>


            <h3 class="delete-title">
                Hapus Pengguna
            </h3>


            <p class="delete-message">
                Apakah Anda yakin ingin menghapus
                <strong id="deleteUserName"></strong>?
                Tindakan ini tidak dapat dibatalkan.
            </p>


            <form
                id="deleteUserForm"
                method="POST"
            >

                @csrf

                @method('DELETE')


                <div class="modal-actions">

                    <button
                        type="button"
                        class="btn btn-cancel"
                        onclick="closeDeleteModal()"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Ya, Hapus
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- JAVASCRIPT -->
    <!-- ================================================= -->

    <script>

        /* ================= ADD MODAL ================= */

        function openAddModal() {
            document
                .getElementById('addModal')
                .classList.add('active');
        }


        function closeAddModal() {
            document
                .getElementById('addModal')
                .classList.remove('active');
        }


        /* ================= EDIT MODAL ================= */

        function openEditModal(id, name, role, status) {

            document.getElementById('editName').value = name;

            document.getElementById('editRole').value = role;

            document.getElementById('editStatus').value =
                status || 'active';

            document.getElementById('editUserForm').action =
                "{{ url('/admin/kelola-pengguna') }}/" + id;

            document
                .getElementById('editModal')
                .classList.add('active');
        }


        function closeEditModal() {

            document
                .getElementById('editModal')
                .classList.remove('active');

        }


        /* ================= DELETE MODAL ================= */

        function openDeleteModal(id, name) {

            document.getElementById('deleteUserName').textContent =
                name;

            document.getElementById('deleteUserForm').action =
                "{{ url('/admin/kelola-pengguna') }}/" + id;

            document
                .getElementById('deleteModal')
                .classList.add('active');
        }


        function closeDeleteModal() {

            document
                .getElementById('deleteModal')
                .classList.remove('active');

        }


        /* ================= SEARCH ================= */

        function searchTable() {

            const search =
                document
                    .getElementById('searchInput')
                    .value
                    .toLowerCase();

            const rows =
                document.querySelectorAll(
                    'tbody tr'
                );

            rows.forEach(row => {

                const text =
                    row.textContent.toLowerCase();

                if (text.includes(search)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }

            });

        }


        /* ================= CLOSE MODAL ================= */

        window.addEventListener('click', function(event) {

            const modals =
                document.querySelectorAll('.modal');

            modals.forEach(modal => {

                if (event.target === modal) {
                    modal.classList.remove('active');
                }

            });

        });

    </script>

</body>
</html>
