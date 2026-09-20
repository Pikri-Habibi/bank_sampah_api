

lucide.createIcons();
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
                            <i data-lucide="pencil"></i>
                        </button>

                        <button
                            class="btn-action btn-delete"
                            onclick="deleteData(${item.id_harga})"
                            title="Hapus"
                        >
                            <i data-lucide="trash-2"></i>
                        </button>

                    </div>

                </td>

            </tr>

        `;

    });

    lucide.createIcons();

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
        'Tambah Jenis Sampah';

    document.getElementById('editId').value = '';

    document.getElementById('jenisSampah').value = '';

    document.getElementById('harga').value = '';

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
        'Edit Sampah';


    document.getElementById('editId').value =
        item.id_jenis_sampah;


    const jenis = jenisSampahData.find(
        j => j.id_jenis_sampah == item.id_jenis_sampah
    );

    document.getElementById('jenisSampah').value =
        jenis?.nama_sampah ?? '';


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

    const namaSampah =
        document.getElementById('jenisSampah').value;

    const harga =
        document.getElementById('harga').value;
    
    const status =
        document.getElementById('status').value;

    if (!namaSampah || !harga) {
        alert('Jenis sampah dan harga wajib diisi.');
        return;
    }

    const data = {
        nama_sampah: namaSampah,
        harga_per_kg: harga,
        status: status
    };

    try {

        let response;

        if (id) {

            // EDIT HARGA
            response = await fetch(
                `/api/jenis-sampah/${id}`,
                {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        nama_sampah: namaSampah,
                        harga_per_kg: harga,
                        status: status
                    })
                }
            );

        } else {

            // TAMBAH JENIS SAMPAH + HARGA
            response = await fetch(
                '/api/jenis-sampah-dengan-harga',
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                }
            );
        }

        if (!response.ok) {

            const error = await response.json();

            console.error(error);

            alert(
                error.message ??
                'Gagal menyimpan data.'
            );

            return;
        }

        alert(
            id
                ? 'Sampah berhasil diperbarui.'
                : 'Jenis sampah dan harga berhasil ditambahkan.'
        );

        closeModal();

        await loadJenisSampah();
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
            'Sampah berhasil dihapus.'
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

    lucide.createIcons();

}

init();

