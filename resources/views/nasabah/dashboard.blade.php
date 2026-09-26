<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>Dashboard Nasabah - Bank Sampah Griya Ayu</title>

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
           MAIN CONTENT
        ===================================================== */

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
            color: #17332e;
        }

        .page-header p {
            margin: 6px 0 0;
            color: #71847f;
            font-size: 14px;
        }

        /* =====================================================
        NOTIFIKASI
        ===================================================== */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .notification-wrapper {
            position: relative;
        }

        .notification-button {
            position: relative;

            width: 42px;
            height: 42px;

            border: none;
            border-radius: 10px;

            background: white;
            color: #2d765d;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;

            cursor: pointer;

            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);

            transition: 0.2s;
        }

        .notification-button:hover {
            background: #eaf5f1;
        }

        /* BULATAN MERAH */
        .notification-badge {
            position: absolute;

            top: -4px;
            right: -4px;

            min-width: 17px;
            height: 17px;

            padding: 0 4px;

            border-radius: 50%;

            background: #e53935;
            color: white;

            font-size: 9px;
            font-weight: bold;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 2px solid #f4f8f7;
        }

        .notification-dropdown {
            position: absolute;
            top: 50px;
            right: 0;

            width: 350px;

            background: white;
            border-radius: 12px;

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);

            padding: 0;

            display: none;

            z-index: 1000;

            overflow: hidden;
        }

        .notification-dropdown.show {
            display: block;
        }

        .notification-header {
            padding: 15px 17px;

            font-size: 14px;
            font-weight: bold;

            color: #17332e;

            border-bottom: 1px solid #edf1ef;
        }

        .notification-list {
            max-height: 350px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 14px 17px;

            border-bottom: 1px solid #edf1ef;

            cursor: pointer;

            transition: background 0.2s;
        }

        .notification-item:hover {
            background: #f7faf8;
        }

        .notification-item.unread {
            background: #f0f8f5;
        }

        .notification-title {
            font-size: 13px;
            font-weight: bold;
            color: #17332e;
        }

        .notification-message {
            margin-top: 5px;

            font-size: 12px;
            line-height: 1.5;

            color: #71847f;
        }

        .notification-time {
            margin-top: 7px;

            font-size: 10px;
            color: #9aa9a5;
        }

        .notification-empty {
            padding: 25px 17px;

            text-align: center;

            font-size: 12px;
            color: #879691;
        }

        /* =====================================================
           SUMMARY CARDS
        ===================================================== */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .card-label {
            color: #71847f;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .card-value {
            font-size: 25px;
            font-weight: bold;
            color: #17332e;
        }

        .card-description {
            margin-top: 8px;
            font-size: 12px;
            color: #2d765d;
        }

        .card-icon {
            float: right;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            line-height: 1;
        }

        .icon-green {
            background: #e6f5ed;
            color: #2d765d;
        }

        .icon-blue {
            background: #e9f1ff;
            color: #3977d4;
        }

        .icon-orange {
            background: #fff1df;
            color: #e89529;
        }

        /* =====================================================
           CONTENT GRID
        ===================================================== */

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 18px;
        }

        .panel {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .panel-title {
            font-size: 17px;
            font-weight: bold;
            color: #17332e;
        }

        .panel-link {
            text-decoration: none;
            color: #2d765d;
            font-size: 12px;
            font-weight: bold;
        }

        /* =====================================================
           TABLE
        ===================================================== */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            color: #7c8d89;
            font-weight: normal;
            padding: 10px 8px;
            border-bottom: 1px solid #edf1ef;
        }

        td {
            padding: 13px 8px;
            font-size: 13px;
            border-bottom: 1px solid #edf1ef;
            color: #344a45;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .nominal {
            font-weight: bold;
            color: #2d765d;
        }

        /* =====================================================
        STATISTIK SAMPAH
        ===================================================== */

        .statistik-item {
            margin-bottom: 18px;
        }

        .statistik-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 7px;
        }

        .statistik-nama {
            font-size: 13px;
            color: #344a45;
        }

        .statistik-berat {
            font-size: 13px;
            font-weight: bold;
            color: #2d765d;
        }

        .statistik-bar {
            width: 100%;
            height: 8px;
            background: #edf3f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .statistik-progress {
            height: 100%;
            background: #2d765d;
            border-radius: 10px;
        }

        .statistik-panel {
            margin-bottom: 25px;
        }

        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: inline-block;
            padding: 5px 9px;
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
           QUICK ACTION
        ===================================================== */

        .action-card {
            background: linear-gradient(135deg, #123d36, #2d765d);
            color: white;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 18px;
        }

        .action-card h3 {
            margin: 0 0 8px;
            font-size: 17px;
        }

        .action-card p {
            margin: 0 0 18px;
            color: #d9ece6;
            font-size: 12px;
            line-height: 1.5;
        }

        .action-button {
            display: inline-block;
            padding: 10px 15px;
            background: white;
            color: #205b4c;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
        }

        .action-button:hover {
            background: #f1f1f1;
        }

        /* =====================================================
           WITHDRAWAL
        ===================================================== */

        .withdrawal-item {
            padding: 13px 0;
            border-bottom: 1px solid #edf1ef;
        }

        .withdrawal-item:last-child {
            border-bottom: none;
        }

        .withdrawal-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .withdrawal-code {
            font-size: 11px;
            color: #7a8c87;
        }

        .withdrawal-value {
            margin-top: 5px;
            font-size: 15px;
            font-weight: bold;
        }

        .empty {
            color: #879691;
            font-size: 13px;
            padding: 10px 0;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1000px) {

            .cards {
                grid-template-columns: 1fr;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {

            .main {
                margin-left: 190px;
                padding: 20px;
            }
        }

        /* =====================================================
        POPUP SUCCESS
        ===================================================== */

        .popup-overlay {
            position: fixed;
            inset: 0;

            background: rgba(15, 40, 35, 0.45);

            display: flex;
            align-items: center;
            justify-content: center;

            z-index: 9999;
        }

        .popup-box {
            width: 380px;
            max-width: calc(100% - 40px);

            background: white;

            border-radius: 16px;

            padding: 26px;

            text-align: center;

            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
        }

        .popup-icon {
            width: 52px;
            height: 52px;

            margin: 0 auto 15px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 25px;
            font-weight: bold;
        }

        .popup-icon.success {
            background: #e8f7ef;
            color: #287d65;
        }

        .popup-title {
            margin-bottom: 8px;

            font-size: 18px;
            font-weight: bold;

            color: #17332e;
        }

        .popup-message {
            margin-bottom: 22px;

            color: #71847f;

            font-size: 13px;
            line-height: 1.5;
        }

        .popup-button {
            min-width: 90px;

            padding: 10px 16px;

            border: none;
            border-radius: 8px;

            font-size: 13px;
            font-weight: bold;

            cursor: pointer;
        }

        .popup-button.primary {
            background: #2d765d;
            color: white;
        }
    </style>
</head>

<body>

    {{-- SIDEBAR NASABAH --}}
    @include('layouts.sidebar-nasabah')

    {{-- POPUP SUCCESS --}}
    @if(session('success'))
        <div class="popup-overlay show" id="successPopup">

            <div class="popup-box">

                <div class="popup-icon success">
                    ✓
                </div>

                <div class="popup-title">
                    Berhasil
                </div>

                <div class="popup-message">
                    {{ session('success') }}
                </div>

                <button
                    class="popup-button primary"
                    onclick="closeSuccessPopup()"
                >
                    OK
                </button>

            </div>

        </div>
    @endif


    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <main class="main">

        {{-- HEADER --}}
        <div class="page-header">

            <div>

                <h1>
                    Dashboard Nasabah
                </h1>

                <p>
                    Selamat datang,
                    {{ $nasabah->user->name ?? Auth::user()->name ?? 'Nasabah' }}.
                    Berikut ringkasan aktivitas tabungan Anda.
                </p>

            </div>


            {{-- NOTIFIKASI --}}

            <div class="notification-wrapper">

            <button
                type="button"
                class="notification-button"
                onclick="toggleNotifications()"
            >

                <i class="fa-solid fa-bell"></i>

                @if($jumlahNotifikasiBelumDibaca > 0)

                    <span class="notification-badge">
                        {{ $jumlahNotifikasiBelumDibaca }}
                    </span>

                @endif

            </button>


            {{-- DROPDOWN NOTIFIKASI --}}

            <div
                class="notification-dropdown"
                id="notificationDropdown"
            >

                <div class="notification-header">
                    Notifikasi
                </div>


                <div class="notification-list">

                    @forelse($notifikasi as $item)

                        <div
                            class="notification-item {{ !$item->dibaca ? 'unread' : '' }}"
                        >

                            <div class="notification-title">
                                {{ $item->judul }}
                            </div>

                            <div class="notification-message">
                                {{ $item->pesan }}
                            </div>

                            <div class="notification-time">
                                {{ $item->created_at->format('d M Y, H:i') }}
                            </div>

                        </div>

                    @empty

                        <div class="notification-empty">
                            Belum ada notifikasi.
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

        </div>


        {{-- =================================================
            SUMMARY CARDS
        ================================================== --}}

        <div class="cards">

            {{-- SALDO --}}
            <div class="card">

                <div class="card-icon icon-green">
                    <i class="fa-solid fa-wallet"></i>
                </div>

                <div class="card-label">
                    Saldo Saat Ini
                </div>

                <div class="card-value">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </div>

                <div class="card-description">
                    Saldo yang tersedia
                </div>

            </div>


            {{-- TOTAL SETORAN --}}
            <div class="card">

                <div class="card-icon icon-blue">
                    <i class="fa-solid fa-recycle"></i>
                </div>

                <div class="card-label">
                    Total Setoran
                </div>

                <div class="card-value">
                    {{ $totalSetoran }}
                </div>

                <div class="card-description">
                    Seluruh transaksi setoran
                </div>

            </div>


            {{-- TOTAL BERAT --}}
            <div class="card">

                <div class="card-icon icon-orange">
                    <i class="fa-solid fa-trash-can"></i>
                </div>

                <div class="card-label">
                    Total Sampah
                </div>

                <div class="card-value">
                    {{ number_format($totalBerat, 2, ',', '.') }} kg
                </div>

                <div class="card-description">
                    Total berat sampah disetor
                </div>

            </div>


            {{-- TOTAL PENDAPATAN --}}
            <div class="card">

                <div class="card-icon icon-green">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>

                <div class="card-label">
                    Total Pendapatan
                </div>

                <div class="card-value">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </div>

                <div class="card-description">
                    Total hasil seluruh setoran
                </div>

            </div>

        </div>


        {{-- =================================================
             CONTENT
        ================================================== --}}

        {{-- STATISTIK SETORAN --}}

        <div class="panel statistik-panel">

            <div class="panel-header">

                <div class="panel-title">
                    <i class="fa-solid fa-chart-column"></i>
                    Statistik Setoran {{ now()->year }}
                </div>

            </div>

            @if(count($statistikSampah) > 0)

                @php
                    $beratMaksimal = 500;
                @endphp

                @foreach($statistikSampah as $namaSampah => $berat)

                    @php
                        $persentase = $beratMaksimal > 0
                            ? ($berat / $beratMaksimal) * 100
                            : 0;
                    @endphp

                    <div class="statistik-item">

                        <div class="statistik-info">

                            <span class="statistik-nama">
                                {{ $namaSampah }}
                            </span>

                            <span class="statistik-berat">
                                {{ number_format($berat, 2, ',', '.') }} / 500 kg
                            </span>

                        </div>

                        <div class="statistik-bar">

                            <div
                                class="statistik-progress"
                                style="width: {{ $persentase }}%;"
                            ></div>

                        </div>

                    </div>

                @endforeach

            @else

                <div class="empty">
                    Belum ada data setoran sampah.
                </div>

            @endif

        </div>

        <div class="content-grid">


            {{-- =================================================
                 TRANSAKSI TERBARU
            ================================================== --}}

            <div class="panel">

                <div class="panel-header">

                    <div class="panel-title">
                        Transaksi Setoran Terbaru
                    </div>

                    <a
                        href="{{ route('nasabah.riwayat') }}"
                        class="panel-link"
                    >
                        Lihat semua
                    </a>

                </div>


                @if($transaksiTerakhir->count() > 0)

                    <table>

                        <thead>

                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis Sampah</th>
                                <th>Berat</th>
                                <th>Nominal</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($transaksiTerakhir as $setoran)

                                <tr>

                                    <td>
                                        {{ $setoran->tgl_setoran }}
                                    </td>

                                    <td>

                                        @if($setoran->detailSetoran->count())

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

                                    <td>

                                        @php
                                            $totalBerat = $setoran->detailSetoran->sum('total_berat');
                                        @endphp

                                        {{ number_format($totalBerat, 2, ',', '.') }} kg

                                    </td>

                                    <td class="nominal">

                                        @php
                                            $totalNominal = $setoran->detailSetoran->sum(function ($detail) {
                                                return $detail->total_berat * $detail->harga_per_kg;
                                            });
                                        @endphp

                                        Rp {{ number_format($totalNominal, 0, ',', '.') }}

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="empty">
                        Belum ada transaksi setoran.
                    </div>

                @endif

            </div>


            {{-- =================================================
                 RIGHT CONTENT
            ================================================== --}}

            <div>

                {{-- ACTION PENARIKAN --}}
                <div class="action-card">

                    <h3>
                        Butuh uang dari saldo?
                    </h3>

                    <p>
                        Ajukan penarikan saldo tabungan Anda
                        melalui menu penarikan.
                    </p>

                    <a
                        href="{{ route('nasabah.penarikan.create') }}"
                        class="action-button"
                    >
                        Ajukan Penarikan
                    </a>

                </div>


                {{-- PENARIKAN TERBARU --}}
                <div class="panel">

                    <div class="panel-header">

                        <div class="panel-title">
                            Penarikan Terbaru
                        </div>

                        <a
                            href="{{ route('nasabah.riwayat') }}"
                            class="panel-link"
                        >
                            Riwayat
                        </a>

                    </div>


                    @if($penarikanTerakhir->count() > 0)

                        @foreach($penarikanTerakhir as $penarikan)

                            <div class="withdrawal-item">

                                <div class="withdrawal-top">

                                    <span class="withdrawal-code">
                                        {{ $penarikan->kode_penarikan }}
                                    </span>


                                    @if($penarikan->status === 'pending')

                                        <span class="status status-pending">
                                            Menunggu
                                        </span>

                                    @elseif($penarikan->status === 'approved')

                                        <span class="status status-approved">
                                            Disetujui
                                        </span>

                                    @elseif($penarikan->status === 'rejected')

                                        <span class="status status-rejected">
                                            Ditolak
                                        </span>

                                    @else

                                        <span class="status">
                                            {{ ucfirst($penarikan->status) }}
                                        </span>

                                    @endif

                                </div>


                                <div class="withdrawal-value">
                                    Rp {{ number_format($penarikan->nominal, 0, ',', '.') }}
                                </div>

                            </div>

                        @endforeach

                    @else

                        <div class="empty">
                            Belum ada pengajuan penarikan.
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </main>

    <script>

    function closeSuccessPopup() {

        const popup = document.getElementById('successPopup');

        if (popup) {
            popup.remove();
        }

    }

    function toggleNotifications() {

        const dropdown = document.getElementById('notificationDropdown');

        if (!dropdown) {
            return;
        }

        // Jika dropdown sedang terbuka
        if (dropdown.classList.contains('show')) {

            // Tutup dropdown
            dropdown.classList.remove('show');

            // Tandai notifikasi sebagai sudah dibaca
            fetch("{{ route('nasabah.notifikasi.baca') }}", {
                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {

                if (data.success) {

                    // Hilangkan badge merah
                    const badge = document.querySelector('.notification-badge');

                    if (badge) {
                        badge.remove();
                    }

                    // Setelah dropdown ditutup,
                    // ubah notifikasi menjadi tampilan sudah dibaca
                    const unreadItems =
                        document.querySelectorAll('.notification-item.unread');

                    unreadItems.forEach(item => {
                        item.classList.remove('unread');
                    });

                }

            })
            .catch(error => {
                console.error(
                    'Gagal menandai notifikasi:',
                    error
                );
            });

        } else {

            // Buka dropdown
            dropdown.classList.add('show');

        }

    }

    </script>

</body>
</html>