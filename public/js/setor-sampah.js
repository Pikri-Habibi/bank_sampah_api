let nomorBaris = 0; 

const btnTambahSampah = document.getElementById('btnTambahSampah');
const detailSampah = document.getElementById('detailSampah');

let jenisSampahData = [];

async function loadJenisSampah() {

    const response = await fetch('/api/jenis-sampah');

    const result = await response.json();

    jenisSampahData = result;
}

btnTambahSampah.addEventListener('click', function () {

    nomorBaris++;

    const baris = document.createElement('tr');

    let pilihanJenisSampah = `
    <option value="">
        Pilih jenis sampah
    </option>
    `;

    jenisSampahData.forEach(item => {

        pilihanJenisSampah += `
            <option value="${item.id_jenis_sampah}">
                ${item.nama_sampah}
            </option>
        `;

    });

    baris.innerHTML = `
        <td>
            ${nomorBaris}
        </td>

        <td>
            <select class="jenis-sampah">
                ${pilihanJenisSampah}
            </select>
        </td>

        <td>
            <input
                type="number"
                class="berat-sampah"
                min="0"
                step="0.01"
                placeholder="0"
            >
        </td>

        <td class="harga-sampah">
            Rp 0
        </td>

        <td class="subtotal-sampah">
            Rp 0
        </td>

        <td>
            <button
                type="button"
                class="btn-hapus-sampah"
            >
                Hapus
            </button>
        </td>
    `;

    detailSampah.appendChild(baris);

    const selectJenis =
    baris.querySelector('.jenis-sampah');

    selectJenis.addEventListener('change', function () {

        const idJenis = this.value;

        const dataJenis = jenisSampahData.find(
            item => item.id_jenis_sampah == idJenis
        );

        if (!dataJenis) {
            return;
        }

        const hargaAktif =
            dataJenis.harga.find(
                harga => Number(harga.status) === 1
            );

        if (!hargaAktif) {
            return;
        }

        const harga =
            Number(hargaAktif.harga_per_kg);

        baris.querySelector('.harga-sampah').textContent =
            `Rp ${harga.toLocaleString('id-ID')}`;

    });

    const inputBerat =
    baris.querySelector('.berat-sampah');

    inputBerat.addEventListener('input', function () {

        const berat = Number(this.value) || 0;

        const idJenis =
            selectJenis.value;

        const dataJenis =
            jenisSampahData.find(
                item => item.id_jenis_sampah == idJenis
            );

        if (!dataJenis) {
            return;
        }

        const hargaAktif =
            dataJenis.harga.find(
                harga => Number(harga.status) === 1
            );

        if (!hargaAktif) {
            return;
        }

        const harga =
            Number(hargaAktif.harga_per_kg);

        const subtotal =
            berat * harga;

        baris.querySelector('.subtotal-sampah').textContent =
            `Rp ${subtotal.toLocaleString('id-ID')}`;

        hitungTotalPendapatan();

    });

    baris.querySelector('.btn-hapus-sampah')
    .addEventListener('click', function () {

        baris.remove();

        updateNomorBaris();

        hitungTotalPendapatan();

    });

});

function updateNomorBaris() {

    const semuaBaris =
        detailSampah.querySelectorAll('tr');

    semuaBaris.forEach((baris, index) => {

        baris.querySelector('td').textContent =
            index + 1;

    });

    nomorBaris = semuaBaris.length;
}

function hitungTotalPendapatan() {

    let total = 0;

    const semuaBaris =
        detailSampah.querySelectorAll('tr');

    semuaBaris.forEach(baris => {

        const subtotalText =
            baris.querySelector('.subtotal-sampah').textContent;

        const subtotal =
            Number(
                subtotalText
                    .replace('Rp ', '')
                    .replace(/\./g, '')
            ) || 0;

        total += subtotal;

    });

    document.getElementById('totalPendapatan').textContent =
        `Rp ${total.toLocaleString('id-ID')}`;

}

loadJenisSampah();