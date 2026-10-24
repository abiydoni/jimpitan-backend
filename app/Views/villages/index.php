<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="content-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:0.75rem; margin-bottom:0.85rem;">
    <div>
        <h1 class="page-title" style="font-size:1.15rem; font-weight:700; color:#0f172a; margin:0; display:flex; align-items:center; gap:0.4rem;">
            <span>🏡</span> Data Desa & Wilayah
        </h1>
        <p style="font-size:0.75rem; color:#64748b; margin:0.15rem 0 0 0;">
            Kelola data master desa, kode unik, alamat, dan pengaturan wilayah.
        </p>
    </div>
    <button class="btn btn-primary" onclick="openVillageModal()" style="padding: 0.35rem 0.85rem; border-radius: 0.4rem; background-color: #4f46e5; color: white; border:none; font-weight:600; font-size:0.8rem; cursor:pointer; display:flex; align-items:center; gap:0.35rem; box-shadow:0 1px 3px rgba(79,70,229,0.2);">
        <i class="fa-solid fa-plus"></i> Tambah Desa
    </button>
</div>

<div class="card" style="width: 100%; border-radius: 0.5rem; border: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(0,0,0,0.04); padding: 0; overflow: hidden; background: #ffffff;">
    <div style="padding: 0; overflow-x: auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Kode Unik</th>
                    <th>Nama Desa</th>
                    <th>ID Sistem</th>
                    <th>Alamat</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody id="villages-tbody">
                <tr>
                    <td colspan="5" style="text-align:center; padding: 1.5rem; color: #94a3b8;">
                        <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.25rem; margin-bottom: 0.35rem; display: block; color: #4f46e5;"></i>
                        Memuat data desa...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form -->
<div id="village-modal" class="modal" style="display:none; position:fixed; inset:0; background:rgba(15,23,42,0.6); z-index:1000; align-items:center; justify-content:center; backdrop-filter: blur(2px);">
    <div style="background:white; border-radius:0.75rem; width:100%; max-width:520px; padding:1.75rem; box-shadow:0 20px 25px -5px rgba(0,0,0,0.15); margin: 1rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem; padding-bottom:0.75rem; border-bottom:1px solid #e2e8f0;">
            <h3 id="modal-title" style="margin:0; font-size:1.15rem; font-weight:700; color:#0f172a;">Tambah Desa Baru</h3>
            <button type="button" onclick="closeVillageModal()" style="background:none; border:none; font-size:1.25rem; color:#94a3b8; cursor:pointer;">&times;</button>
        </div>
        <form id="village-form" onsubmit="saveVillage(event)">
            <input type="hidden" id="v-id">
            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.825rem; font-weight:600; color:#334155; margin-bottom:0.35rem;">Kode Unik (5 Digit / ID Desa)</label>
                <input type="text" id="v-uniqueCode" class="form-control" required style="width:100%; padding:0.6rem 0.85rem; border:1.5px solid #cbd5e1; border-radius:0.5rem; font-family:monospace; font-size:0.9rem;" placeholder="contoh: 12345">
            </div>
            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.825rem; font-weight:600; color:#334155; margin-bottom:0.35rem;">Nama Desa / RT / RW</label>
                <input type="text" id="v-name" class="form-control" required style="width:100%; padding:0.6rem 0.85rem; border:1.5px solid #cbd5e1; border-radius:0.5rem; font-size:0.9rem;" placeholder="Nama RT/RW/Desa">
            </div>
            <div style="margin-bottom:1rem;">
                <label style="display:block; font-size:0.825rem; font-weight:600; color:#334155; margin-bottom:0.35rem;">Alamat Lengkap</label>
                <textarea id="v-address" class="form-control" rows="2" style="width:100%; padding:0.6rem 0.85rem; border:1.5px solid #cbd5e1; border-radius:0.5rem; font-size:0.9rem;" placeholder="Dusun, RT/RW, Kelurahan..."></textarea>
            </div>
            <div style="margin-bottom:1.5rem;">
                <label style="display:block; font-size:0.825rem; font-weight:600; color:#334155; margin-bottom:0.35rem;">Kontak / Keterangan Info</label>
                <input type="text" id="v-contactInfo" class="form-control" style="width:100%; padding:0.6rem 0.85rem; border:1.5px solid #cbd5e1; border-radius:0.5rem; font-size:0.9rem;" placeholder="No. telp ketua / info tambahan">
            </div>
            <div style="display:flex; justify-content:flex-end; gap:0.6rem; padding-top:1rem; border-top:1px solid #e2e8f0;">
                <button type="button" onclick="closeVillageModal()" style="padding:0.6rem 1.25rem; border-radius:0.5rem; background:#f1f5f9; border:1px solid #cbd5e1; color:#475569; font-weight:600; font-size:0.875rem; cursor:pointer;">Batal</button>
                <button type="submit" id="btn-save-village" style="padding:0.6rem 1.5rem; border-radius:0.5rem; background:#4f46e5; color:white; border:none; font-weight:600; font-size:0.875rem; cursor:pointer; box-shadow:0 2px 4px rgba(79,70,229,0.25);">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let isEditMode = false;
    window._villagesList = [];

    async function fetchVillages() {
        const tbody = document.getElementById('villages-tbody');
        try {
            let json = { success: false, data: [] };

            // 1. Coba fetch dari API_URL server
            try {
                const token = (typeof getFreshFirebaseToken === 'function') 
                    ? await getFreshFirebaseToken() 
                    : (typeof FIREBASE_ID_TOKEN !== 'undefined' ? FIREBASE_ID_TOKEN : getFirebaseToken());

                const res = await fetch(`${API_URL}/master/villages`, {
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                json = await res.json();
            } catch (errApi) {
                console.warn('API_URL fetch failed, trying local fallback:', errApi);
            }

            // 2. Fallback ke endpoint lokal jika API gagal
            if (!json || !json.success || !Array.isArray(json.data)) {
                try {
                    const localRes = await fetch(`<?= base_url('/wa_blast/villages') ?>`);
                    const localJson = await localRes.json();
                    if (localJson && localJson.success) {
                        json = localJson;
                    }
                } catch (errLocal) {}
            }
            
            tbody.innerHTML = '';
            window._villagesList = json.data || [];
            
            if (json.success && window._villagesList.length > 0) {
                window._villagesList.forEach(v => {
                    const tr = document.createElement('tr');
                    tr.style.borderBottom = '1px solid #f1f5f9';
                    tr.onmouseover = () => tr.style.background = '#f8fafc';
                    tr.onmouseout = () => tr.style.background = '#ffffff';

                    const safeName = (v.name || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    const safeAddress = (v.address || '-').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    const safeCode = v.uniqueCode || '-';
                    const villageId = v.id;

                    tr.innerHTML = `
                        <td>
                            <span style="display:inline-block; padding:1px 5px; border-radius:3px; background:#eef2ff; color:#4f46e5; font-weight:700; font-family:monospace; font-size:0.75rem; border:1px solid #c7d2fe;">
                                ${safeCode}
                            </span>
                        </td>
                        <td style="font-weight: 600; color:#0f172a;">
                            ${safeName}
                        </td>
                        <td style="color:#64748b; font-size:0.72rem; font-family:monospace;">
                            ${villageId}
                        </td>
                        <td style="color:#64748b; font-size:0.75rem;">
                            ${safeAddress}
                        </td>
                        <td style="text-align:right; white-space:nowrap;">
                            <button type="button" onclick="sendVillageNotification('${villageId}')" title="Kirim Notifikasi Chat Registrasi Desa" style="background:#e0e7ff; border:1px solid #c7d2fe; color:#4338ca; cursor:pointer; padding:2px 6px; border-radius:4px; font-size:0.7rem; font-weight:600; margin-right:2px; transition:all 0.15s; display:inline-flex; align-items:center; gap:0.25rem;">
                                <i class="fa-solid fa-paper-plane"></i> Chat
                            </button>
                            <button type="button" onclick="onEditClick('${villageId}')" title="Edit Desa" style="background:#fef3c7; border:1px solid #fde68a; color:#b45309; cursor:pointer; padding:2px 6px; border-radius:4px; font-size:0.7rem; font-weight:600; margin-right:2px; transition:all 0.15s;">
                                <i class="fa-solid fa-pen"></i> Edit
                            </button>
                            <button type="button" onclick="confirmDeleteVillage('${villageId}')" title="Hapus Desa" style="background:#fee2e2; border:1px solid #fecaca; color:#b91c1c; cursor:pointer; padding:2px 6px; border-radius:4px; font-size:0.7rem; font-weight:600; transition:all 0.15s;">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding: 3rem; color: #94a3b8;">Belum ada data desa yang terdaftar.</td></tr>';
            }
        } catch (error) {
            console.error('Error fetching villages:', error);
            tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding: 2.5rem; color: #ef4444;">Gagal memuat data desa. Silakan refresh halaman.</td></tr>';
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

    function onEditClick(id) {
        const v = (window._villagesList || []).find(item => String(item.id) === String(id));
        if (!v) return;
        editVillage(v);
    }

    function editVillage(v) {
        isEditMode = true;
        document.getElementById('modal-title').textContent = 'Edit Desa';
        document.getElementById('v-id').value = v.id;
        document.getElementById('v-uniqueCode').value = v.uniqueCode || '';
        document.getElementById('v-name').value = v.name || '';
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
            uniqueCode: document.getElementById('v-uniqueCode').value.trim(),
            name: document.getElementById('v-name').value.trim(),
            address: document.getElementById('v-address').value.trim(),
            contactInfo: document.getElementById('v-contactInfo').value.trim()
        };
        
        const url = isEditMode ? `${API_URL}/master/villages/${id}` : `${API_URL}/master/villages`;
        const method = isEditMode ? 'PUT' : 'POST';
        
        try {
            const token = (typeof getFreshFirebaseToken === 'function') 
                ? await getFreshFirebaseToken() 
                : (typeof FIREBASE_ID_TOKEN !== 'undefined' ? FIREBASE_ID_TOKEN : getFirebaseToken());

            const res = await fetch(url, {
                method: method,
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}` 
                },
                body: JSON.stringify(payload)
            });
            const json = await res.json();
            
            if (json.success) {
                showToast('Sukses', isEditMode ? 'Desa diperbarui' : 'Desa berhasil ditambahkan');
                closeVillageModal();
                fetchVillages();
            } else {
                showToast('Gagal', json.message || 'Terjadi kesalahan saat menyimpan desa');
            }
        } catch (error) {
            console.error('Error saving village:', error);
            showToast('Error', 'Koneksi ke server gagal');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Simpan';
        }
    }

    /**
     * Konfirmasi Hapus Desa dengan Rincian Seluruh Tabel yang Ikut Terhapus
     */
    async function confirmDeleteVillage(id) {
        const v = (window._villagesList || []).find(item => String(item.id) === String(id)) || { id: id, name: id, uniqueCode: '' };
        const villageName = v.name || id;
        const villageCode = v.uniqueCode ? `(${v.uniqueCode})` : '';

        const affectedHtml = `
            <div style="text-align: left; margin-top: 0.5rem;">
                <p style="font-size: 0.9rem; color: #1f2937; margin-bottom: 0.75rem;">
                    Apakah Anda yakin ingin menghapus desa <strong>"${villageName}"</strong> ${villageCode}?
                </p>
                <div style="background-color: #fff1f2; border: 1.5px solid #fecdd3; border-radius: 0.6rem; padding: 0.85rem 1rem; max-height: 250px; overflow-y: auto;">
                    <div style="font-size: 0.825rem; font-weight: 700; color: #9f1239; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem;">
                        <span>⚠️</span> Daftar Tabel & Data Terkait yang Ikut Terhapus:
                    </div>
                    <ul style="font-size: 0.775rem; color: #374151; margin: 0; padding-left: 1.25rem; line-height: 1.65;">
                        <li><strong>users</strong> &mdash; Seluruh data warga & kepala keluarga desa</li>
                        <li><strong>chat_messages</strong> &mdash; Semua percakapan & pesan grup warga</li>
                        <li><strong>group_read_states</strong> &mdash; Riwayat status baca pesan grup</li>
                        <li><strong>jimpitan_history</strong> &mdash; Riwayat setoran & scanning jimpitan</li>
                        <li><strong>dues_journals</strong> &mdash; Jurnal kas & catatan iuran desa</li>
                        <li><strong>inventory_items & inventory_loans</strong> &mdash; Barang & pinjaman inventaris</li>
                        <li><strong>tariffs & exemptions</strong> &mdash; Master tarif iuran & pembebasan warga</li>
                        <li><strong>schedules</strong> &mdash; Jadwal giliran ronda / jaga malam</li>
                        <li><strong>slides</strong> &mdash; Banner info pengumuman desa</li>
                        <li><strong>menus</strong> &mdash; Pengaturan menu kustom aplikasi desa</li>
                        <li><strong>roles</strong> &mdash; Penugasan jabatan & role pengurus desa</li>
                        <li><strong>village_subscriptions & invoices</strong> &mdash; Langganan SaaS & tagihan desa</li>
                        <li><strong>wa_blast_history</strong> &mdash; Riwayat pengiriman WhatsApp Blasting</li>
                        <li><strong>villages</strong> &mdash; Master data desa utama</li>
                    </ul>
                </div>
                <p style="font-size: 0.8rem; color: #dc2626; font-weight: 700; margin: 0.75rem 0 0 0; display: flex; align-items: center; gap: 0.35rem;">
                    <span>🛑</span> Tindakan ini bersifat PERMANEN dan tidak dapat dibatalkan.
                </p>
            </div>
        `;

        const result = await Swal.fire({
            title: 'Hapus Desa & Seluruh Relasi Data?',
            html: affectedHtml,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus Semua Data',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            width: '580px'
        });

        if (!result.isConfirmed) return;

        Swal.fire({
            title: 'Menghapus Data Desa...',
            text: 'Sedang membersihkan seluruh data di tabel-tabel terkait...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            const token = (typeof getFreshFirebaseToken === 'function') 
                ? await getFreshFirebaseToken() 
                : (typeof FIREBASE_ID_TOKEN !== 'undefined' ? FIREBASE_ID_TOKEN : getFirebaseToken());

            let res;
            let json = { success: false };

            // 1. Coba hapus via API server (jimpitan-server)
            try {
                res = await fetch(`${API_URL}/master/villages/${encodeURIComponent(id)}`, {
                    method: 'DELETE',
                    headers: { 
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    }
                });
                json = await res.json();
            } catch (errApi) {
                console.warn('API_URL delete failed, trying local CI4 endpoint:', errApi);
            }

            // 2. Jika API server gagal atau tidak success, coba endpoint lokal CI4 (/villages/:id)
            if (!json || !json.success) {
                try {
                    const localRes = await fetch(`<?= base_url('/villages/') ?>/${encodeURIComponent(id)}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                    const localJson = await localRes.json();
                    if (localJson && localJson.success) {
                        json = localJson;
                    }
                } catch (errLocal) {
                    console.error('Local CI4 delete failed:', errLocal);
                }
            }

            if (json && json.success) {
                await Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus',
                    text: json.message || `Desa "${villageName}" dan semua data terkait berhasil dihapus bersih.`,
                    timer: 2500,
                    showConfirmButton: false
                });
                fetchVillages();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menghapus',
                    text: (json && json.message) ? json.message : 'Terjadi kesalahan saat menghapus desa.'
                });
            }
        } catch (error) {
            console.error('Error deleting village:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Koneksi ke server gagal: ' + error.message
            });
        }
    }

    async function sendVillageNotification(id) {
        const v = (window._villagesList || []).find(item => String(item.id) === String(id));
        const villageName = v ? (v.name || 'Desa') : 'Desa';

        const result = await Swal.fire({
            title: 'Kirim Notifikasi Chat?',
            html: `Kirim notifikasi pendaftaran untuk desa <b>${villageName}</b>?<br><br>` +
                  `<div style="text-align:left; background:#f8fafc; border:1px solid #e2e8f0; padding:0.75rem 1rem; border-radius:0.5rem; font-size:0.825rem; color:#475569; line-height:1.5;">` +
                  `• <b>Super Admin</b> menerima rincian pendaftaran dari <i>Sistem Registrasi</i>.<br>` +
                  `• <b>Admin Desa</b> menerima pesan sambutan & panduan dari <i>Appsbee Support</i>.` +
                  `</div>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: '<i class="fa-solid fa-paper-plane"></i> Ya, Kirim Chat',
            cancelButtonText: 'Batal'
        });

        if (!result.isConfirmed) return;

        Swal.fire({
            title: 'Mengirim Chat...',
            text: 'Mohon tunggu sebentar, pesan sedang diproses.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            let json = null;
            const token = (typeof getFreshFirebaseToken === 'function') 
                ? await getFreshFirebaseToken() 
                : (typeof FIREBASE_ID_TOKEN !== 'undefined' ? FIREBASE_ID_TOKEN : getFirebaseToken());

            // 1. Coba via API Server Node.js
            try {
                const res = await fetch(`${API_URL}/master/villages/${encodeURIComponent(id)}/notify`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    }
                });
                json = await res.json();
            } catch (errApi) {
                console.warn('API_URL notify failed, trying local CI4 fallback:', errApi);
            }

            // 2. Fallback via local CI4 endpoint jika API Server Node.js gagal
            if (!json || !json.success) {
                try {
                    const localRes = await fetch(`<?= base_url('/villages/notify/') ?>/${encodeURIComponent(id)}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                    const localJson = await localRes.json();
                    if (localJson && localJson.success) {
                        json = localJson;
                    }
                } catch (errLocal) {
                    console.error('Local CI4 notify failed:', errLocal);
                }
            }

            if (json && json.success) {
                const resConfirm = await Swal.fire({
                    icon: 'success',
                    title: 'Chat Berhasil Dikirim!',
                    html: `Pesan notifikasi untuk desa <b>${villageName}</b> berhasil dikirimkan:<br><br>` +
                          `<div style="text-align:left; background:#f0fdf4; border:1px solid #bbf7d0; padding:0.6rem 0.85rem; border-radius:0.4rem; font-size:0.8rem; color:#166534; line-height:1.4;">` +
                          `✓ Pesan rincian pendaftaran masuk ke Chat Personal Super Admin.<br>` +
                          `✓ Pesan sambutan resmi masuk ke Chat Personal Admin Desa.` +
                          `</div>`,
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: '<i class="fa-solid fa-comments"></i> Buka Menu Chat',
                    cancelButtonText: 'Tutup'
                });

                if (resConfirm.isConfirmed) {
                    window.location.href = '<?= base_url('/chat?partner=SYSTEM_BOT') ?>';
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengirim Chat',
                    text: (json && json.message) ? json.message : 'Terjadi kesalahan saat mengirim notifikasi chat.'
                });
            }
        } catch (error) {
            console.error('Error sending village notification:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Koneksi ke server gagal: ' + error.message
            });
        }
    }

    document.addEventListener('DOMContentLoaded', fetchVillages);
</script>
<?= $this->endSection() ?>
