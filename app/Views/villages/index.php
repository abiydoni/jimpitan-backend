<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="content-header" style="display:flex; justify-content:space-between; align-items:center;">
    <h1 class="page-title">Data Desa</h1>
    <button class="btn btn-primary" onclick="openVillageModal()" style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #4f46e5; color: white; border:none; cursor:pointer;">
        <i class="fa-solid fa-plus"></i> Tambah Desa
    </button>
</div>

<div class="card" style="margin-top: 1rem;">
    <div style="padding: 1.5rem; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #e5e7eb; color: #4b5563; font-size: 0.875rem;">
                    <th style="padding: 1rem;">ID / Kode</th>
                    <th style="padding: 1rem;">Nama Desa</th>
                    <th style="padding: 1rem;">Alamat</th>
                    <th style="padding: 1rem;">Kontak</th>
                    <th style="padding: 1rem; text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody id="villages-tbody">
                <tr><td colspan="5" style="text-align:center; padding: 2rem; color: #9ca3af;">Memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form -->
<div id="village-modal" class="modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:0.5rem; width:100%; max-width:500px; padding:1.5rem; box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);">
        <h3 id="modal-title" style="margin-top:0; font-size:1.25rem;">Tambah Desa</h3>
        <form id="village-form" onsubmit="saveVillage(event)">
            <input type="hidden" id="v-id">
            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.875rem; margin-bottom:0.25rem;">Kode Unik (ID Desa)</label>
                <input type="text" id="v-uniqueCode" class="form-control" required style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;" placeholder="contoh: desa_001">
            </div>
            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.875rem; margin-bottom:0.25rem;">Nama Desa</label>
                <input type="text" id="v-name" class="form-control" required style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;" placeholder="Nama RT/RW/Desa">
            </div>
            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.875rem; margin-bottom:0.25rem;">Alamat</label>
                <textarea id="v-address" class="form-control" rows="2" style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;"></textarea>
            </div>
            <div style="margin-bottom:1.5rem;">
                <label style="display:block; font-size:0.875rem; margin-bottom:0.25rem;">Kontak Info</label>
                <input type="text" id="v-contactInfo" class="form-control" style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.375rem;">
            </div>
            <div style="display:flex; justify-content:flex-end; gap:0.5rem;">
                <button type="button" onclick="closeVillageModal()" style="padding:0.5rem 1rem; border-radius:0.375rem; background:#f3f4f6; border:1px solid #d1d5db; cursor:pointer;">Batal</button>
                <button type="submit" id="btn-save-village" style="padding:0.5rem 1rem; border-radius:0.375rem; background:#4f46e5; color:white; border:none; cursor:pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let isEditMode = false;

    async function fetchVillages() {
        try {
            const res = await fetch(`${API_URL}/master/villages`, {
                headers: { 'Authorization': `Bearer ${FIREBASE_ID_TOKEN}` }
            });
            const json = await res.json();
            
            const tbody = document.getElementById('villages-tbody');
            tbody.innerHTML = '';
            
            if (json.success && json.data.length > 0) {
                json.data.forEach(v => {
                    const tr = document.createElement('tr');
                    tr.style.borderBottom = '1px solid #f3f4f6';
                    tr.innerHTML = `
                        <td style="padding: 1rem; font-weight: 500; color:#4f46e5;">${v.uniqueCode}</td>
                        <td style="padding: 1rem; font-weight: 600;">${v.name}</td>
                        <td style="padding: 1rem; color:#6b7280; font-size:0.875rem;">${v.address || '-'}</td>
                        <td style="padding: 1rem; color:#6b7280; font-size:0.875rem;">${v.contactInfo || '-'}</td>
                        <td style="padding: 1rem; text-align:right;">
                            <button onclick='editVillage(${JSON.stringify(v)})' style="background:none; border:none; color:#f59e0b; cursor:pointer; padding:0.25rem;"><i class="fa-solid fa-pen"></i></button>
                            <button onclick='deleteVillage(${v.id}, "${v.name}")' style="background:none; border:none; color:#dc2626; cursor:pointer; padding:0.25rem; margin-left:0.5rem;"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding: 2rem; color: #9ca3af;">Belum ada data desa.</td></tr>';
            }
        } catch (error) {
            console.error('Error fetching villages:', error);
            showToast('Error', 'Gagal memuat data desa');
        }
    }

    function openVillageModal() {
        isEditMode = false;
        document.getElementById('modal-title').textContent = 'Tambah Desa Baru';
        document.getElementById('village-form').reset();
        document.getElementById('v-id').value = '';
        document.getElementById('village-modal').style.display = 'flex';
    }

    function editVillage(v) {
        isEditMode = true;
        document.getElementById('modal-title').textContent = 'Edit Desa';
        document.getElementById('v-id').value = v.id;
        document.getElementById('v-uniqueCode').value = v.uniqueCode;
        document.getElementById('v-name').value = v.name;
        document.getElementById('v-address').value = v.address || '';
        document.getElementById('v-contactInfo').value = v.contactInfo || '';
        document.getElementById('village-modal').style.display = 'flex';
    }

    function closeVillageModal() {
        document.getElementById('village-modal').style.display = 'none';
    }

    async function saveVillage(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-save-village');
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';
        
        const id = document.getElementById('v-id').value;
        const payload = {
            uniqueCode: document.getElementById('v-uniqueCode').value,
            name: document.getElementById('v-name').value,
            address: document.getElementById('v-address').value,
            contactInfo: document.getElementById('v-contactInfo').value
        };
        
        const url = isEditMode ? `${API_URL}/master/villages/${id}` : `${API_URL}/master/villages`;
        const method = isEditMode ? 'PUT' : 'POST';
        
        try {
            const res = await fetch(url, {
                method: method,
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${FIREBASE_ID_TOKEN}`
                },
                body: JSON.stringify(payload)
            });
            const json = await res.json();
            
            if (json.success) {
                showToast('Sukses', isEditMode ? 'Desa diperbarui' : 'Desa berhasil ditambahkan');
                closeVillageModal();
                fetchVillages();
            } else {
                showToast('Gagal', json.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Error saving village:', error);
            showToast('Error', 'Koneksi ke server gagal');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Simpan';
        }
    }

    async function deleteVillage(id, name) {
        if (!confirm(`Apakah Anda yakin ingin menghapus desa "${name}"? Data yang terhubung mungkin akan ikut terpengaruh.`)) return;
        
        try {
            const res = await fetch(`${API_URL}/master/villages/${id}`, {
                method: 'DELETE',
                headers: { 'Authorization': `Bearer ${FIREBASE_ID_TOKEN}` }
            });
            const json = await res.json();
            
            if (json.success) {
                showToast('Sukses', 'Desa berhasil dihapus');
                fetchVillages();
            } else {
                showToast('Gagal', json.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Error deleting village:', error);
            showToast('Error', 'Koneksi ke server gagal');
        }
    }

    document.addEventListener('DOMContentLoaded', fetchVillages);
</script>
<?= $this->endSection() ?>
