<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Setoran Sampah</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7fb; margin: 0; padding: 24px; }
        .container { max-width: 700px; margin: 0 auto; background:white; padding:24px; border-radius:12px; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .field { margin-bottom: 16px; }
        label { display:block; margin-bottom:8px; font-weight:bold; }
        input, select, button { width:100%; padding:10px 12px; border-radius:8px; border:1px solid #d1d5db; }
        button { background:#0f766e; color:white; border:none; cursor:pointer; }
        .link { display:inline-block; margin-top:12px; color:#0f766e; text-decoration:none; }
        .error { color:#b91c1c; margin-bottom:10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Input Setoran Sampah</h2>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('petugas.setoran.store') }}">
            @csrf

            <div class="field">
                <label>Nasabah</label>
                <select name="id_pengguna_nasabah" required>
                    <option value="">Pilih Nasabah</option>
                    @foreach($nasabahList as $nasabah)
                        <option value="{{ $nasabah->id_pengguna_nasabah }}">{{ $nasabah->user->name ?? $nasabah->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Jenis Sampah</label>
                <select name="id_jenis_sampah" id="id_jenis_sampah" required>
                    <option value="">Pilih Jenis Sampah</option>
                    @foreach($jenisSampah as $jenis)
                        @php
                            $hargaAktif = $jenis->harga->first();
                            $hargaValue = $hargaAktif ? (float) $hargaAktif->harga_per_kg : 0;
                        @endphp
                        <option value="{{ $jenis->id_jenis_sampah }}" data-harga="{{ $hargaValue }}">
                            {{ $jenis->nama_sampah }} {{ $hargaAktif ? '— Rp ' . number_format($hargaValue, 0, ',', '.') . ' / kg' : '— Harga belum diatur' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Berat (kg)</label>
                <input type="number" name="berat_kg" id="berat_kg" step="0.01" min="0.1" required>
            </div>

            <div class="field" style="background:#f8fafc; padding:12px; border-radius:8px; border:1px solid #e5e7eb;">
                <strong>Nominal yang akan diterima:</strong>
                <div id="nilai_setoran" style="font-size: 1.2rem; margin-top: 8px;">Rp 0</div>
            </div>

            <button type="submit">Simpan Setoran</button>
        </form>

        <script>
            const jenisSelect = document.getElementById('id_jenis_sampah');
            const beratInput = document.getElementById('berat_kg');
            const nominalBox = document.getElementById('nilai_setoran');

            function formatRupiah(value) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(value);
            }

            function updateNilai() {
                const selectedOption = jenisSelect.options[jenisSelect.selectedIndex];
                const harga = Number(selectedOption?.dataset.harga || 0);
                const berat = Number(beratInput.value || 0);
                const total = harga * berat;
                nominalBox.textContent = formatRupiah(total);
            }

            jenisSelect.addEventListener('change', updateNilai);
            beratInput.addEventListener('input', updateNilai);
        </script>

        <a class="link" href="{{ route('petugas.dashboard') }}">Kembali ke Dashboard</a>
    </div>
</body>
</html>
