<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <title>Riwayat Penarikan - Bank Sampah Griya Ayu</title>

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

        .content {
            max-width: 1050px;
            margin: 0 auto;
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

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            font-weight: normal;
            color: #7c8d89;
            padding: 11px 8px;
            border-bottom: 1px solid #edf1ef;
        }

        td {
            padding: 14px 8px;
            font-size: 13px;
            color: #344a45;
            border-bottom: 1px solid #edf1ef;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .nominal {
            font-weight: bold;
            color: #2d765d;
        }

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

        .empty {
            color: #879691;
            font-size: 13px;
            padding: 10px 0;
        }

        .nominal-keluar {
            font-weight: bold;
            color: #d95353;
        }

    </style>

</head>


<body>

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-nasabah')


    <main class="main">

        <div class="content">

            <div class="page-header">

                <h1>
                    Riwayat Penarikan
                </h1>

                <p>
                    Daftar seluruh pengajuan penarikan saldo Anda.
                </p>

            </div>


            <div class="card">

                @if($penarikan->count() > 0)

                    <table>

                        <thead>

                            <tr>
                                <th>Kode Penarikan</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($penarikan as $item)

                                <tr>

                                    <td>
                                        {{ $item->kode_verifikasi }}
                                    </td>


                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tgl_pengajuan)->format('d/m/Y') }}
                                    </td>


                                    <td class="nominal-keluar">
                                        − Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                    </td>


                                    <td>

                                        @if($item->status === 'pending')

                                            <span class="status status-pending">
                                                Menunggu
                                            </span>

                                        @elseif($item->status === 'approved')

                                            <span class="status status-approved">
                                                Disetujui
                                            </span>

                                        @elseif($item->status === 'rejected')

                                            <span class="status status-rejected">
                                                Ditolak
                                            </span>

                                        @else

                                            <span class="status">
                                                {{ ucfirst($item->status) }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="empty">
                        Belum ada riwayat penarikan.
                    </div>

                @endif

            </div>

        </div>

    </main>

</body>

</html>