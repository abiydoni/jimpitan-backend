<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    /* ===== USERS PAGE - PREMIUM DESIGN ===== */
    .menu-wrap {
        width: 100%;
    }

    /* Hero Header */
    .page-hero {
        background: linear-gradient(135deg, #1e40af 0%, #4f46e5 50%, #7c3aed 100%);
        border-radius: 1.25rem;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        top: -80px; right: -40px;
        width: 260px; height: 260px;
        background: rgba(255,255,255,0.07);
        border-radius: 50%;
    }
    .page-hero::after {
        content: '';
        position: absolute;
        bottom: -60px; right: 100px;
        width: 150px; height: 150px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .hero-text h1 { margin: 0 0 0.35rem 0; font-size: 1.75rem; font-weight: 700; letter-spacing: -0.02em; }
    .hero-text p { margin: 0; opacity: 0.8; font-size: 0.95rem; }
    
    /* Filter / Search Bar */
    .toolbar {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        align-items: center;
        flex-wrap: wrap;
    }
    .toolbar-search {
        flex: 1;
        min-width: 220px;
        position: relative;
    }
    .toolbar-search input {
        width: 100%;
        padding: 0.65rem 1rem 0.65rem 2.5rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.625rem;
        font-family: inherit;
        font-size: 0.875rem;
        background: white;
        box-sizing: border-box;
        transition: border-color 0.2s;
    }
    .toolbar-search input:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.1); }
    .toolbar-search i {
        position: absolute;
        left: 0.875rem; top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 0.85rem;
    }
    
    .toolbar-filter {
        padding: 0.65rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.625rem;
        font-family: inherit;
        font-size: 0.875rem;
        background: white;
        cursor: pointer;
        color: #374151;
        transition: border-color 0.2s;
    }
    .toolbar-filter:focus { outline: none; border-color: #4f46e5; }

    /* Stats Row */
    .stats-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    .stat-chip {
        background: white;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 0.75rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
        min-width: 130px;
    }
    .stat-chip-icon {
        width: 38px; height: 38px;
        border-radius: 0.625rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
    }
    .stat-chip-icon.indigo  { background: #ede9fe; color: #4f46e5; }
    .stat-chip-text { line-height: 1.2; }
    .stat-chip-num { font-size: 1.4rem; font-weight: 800; color: #1f2937; }
    .stat-chip-label { font-size: 0.75rem; color: #6b7280; font-weight: 500; }

    /* Data Table Card */
    .data-card {
        background: white;
        border-radius: 1rem;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th {
        background: #fafafa;
        padding: 0.875rem 1.25rem;
        text-align: left;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #6b7280;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }
    .data-table td {
        padding: 0.9rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.875rem;
        vertical-align: middle;
        overflow: visible;
    }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background-color: #f8fafc; }
    
    .user-info { display: flex; align-items: center; gap: 0.75rem; }
    .user-avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: #e0e7ff;
        color: #4f46e5;
        display: flex; justify-content: center; align-items: center;
        font-weight: 600; font-size: 0.9rem;
    }
    .user-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .user-details { display: flex; flex-direction: column; }
    .user-name { font-weight: 600; color: #1f2937; margin-bottom: 0.1rem; }
    .user-email { font-size: 0.75rem; color: #6b7280; }
    
    /* Roles styling */
    .role-badge {
        display: inline-block;
        padding: 0.15rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.7rem;
        font-weight: 600;
        background: #f3f4f6;
        color: #4b5563;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
    }
    .role-badge.ADMIN_DESA { background: #fee2e2; color: #dc2626; }
    .role-badge.SUPER_ADMIN { background: #ede9fe; color: #4f46e5; }
    
    /* Actions */
    .btn-action {
        width: 32px; height: 32px;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-action:hover { border-color: #4f46e5; color: #4f46e5; background: #eff6ff; }
    
    /* Loader */
    #loader { padding: 3rem; text-align: center; color: #6b7280; }
    
    /* Modal */
    .modal-overlay {
        position: fixed; inset: 0;
        background: rgba(15,23,42,0.6);
        backdrop-filter: blur(4px);
        display: none; justify-content: center; align-items: center;
        z-index: 100;
        opacity: 0; transition: opacity 0.2s;
    }
    .modal-overlay.active { display: flex; opacity: 1; }
    
    .modal-content {
        background: white;
        border-radius: 1rem;
        width: 100%; max-width: 380px;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        transform: translateY(20px);
        transition: transform 0.2s;
        display: flex; flex-direction: column;
    }
    .modal-overlay.active .modal-content { transform: translateY(0); }
    
    .modal-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        display: flex; justify-content: space-between; align-items: center;
    }
    .modal-header h3 { margin: 0; font-size: 0.95rem; font-weight: 600; color: #111827; }
    .btn-close {
        background: none; border: none; font-size: 1.2rem; color: #9ca3af;
        cursor: pointer; transition: color 0.2s;
    }
    .btn-close:hover { color: #1f2937; }
    
    .modal-body { padding: 1rem 1.25rem; flex: 1; overflow-y: auto; }
    .modal-footer {
        padding: 0.75rem 1.25rem;
        border-top: 1px solid #f3f4f6;
        display: flex; justify-content: flex-end; gap: 0.5rem;
    }
    
    .btn {
        padding: 0.5rem 1rem; border-radius: 0.5rem;
        font-size: 0.8rem; font-weight: 500; font-family: inherit;
        cursor: pointer; transition: all 0.2s; border: none;
    }
    .btn-secondary { background: #f3f4f6; color: #374151; }
    .btn-secondary:hover { background: #e5e7eb; }
    .btn-primary { background: #4f46e5; color: white; }
    .btn-primary:hover { background: #4338ca; box-shadow: 0 4px 6px -1px rgba(79,70,229,0.2); }
    
    /* Role List Checkbox */
    .role-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }
    .role-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.6rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.4rem;
        cursor: pointer;
        transition: border-color 0.2s;
    }
    .role-item:hover { border-color: #4f46e5; background: #f8fafc; }
    .role-item span { font-size: 0.75rem; }
    .role-item input[type="checkbox"] {
        width: 1rem; height: 1rem;
        accent-color: #4f46e5;
    }
    
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="menu-wrap">
    
    <div class="page-hero">
        <div class="hero-text">
            <h1>Manajemen Pengguna</h1>
            <p>Kelola data pengguna, hak akses (role), dan status dari satu tempat.</p>
        </div>
    </div>
    
    <div class="stats-row">
        <div class="stat-chip">
            <div class="stat-chip-icon indigo"><i class="fa-solid fa-users"></i></div>
            <div class="stat-chip-text">
                <div class="stat-chip-num" id="total-users">0</div>
                <div class="stat-chip-label">Total Pengguna</div>
            </div>
        </div>
    </div>
    
    <div class="toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-search"></i>
            <input type="text" id="search-input" placeholder="Cari nama atau email..." oninput="filterTable()">
        </div>
        <select class="toolbar-filter" id="village-filter" onchange="fetchUsers()">
            <option value="">Semua Desa</option>
            <!-- Opsi desa diisi via JS -->
        </select>
    </div>
    
    <div class="data-card">
        <div id="loader"><i class="fa-solid fa-circle-notch fa-spin"></i> Memuat data pengguna...</div>
        <table class="data-table" id="users-table" style="display:none;">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Desa</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody id="users-tbody"></tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Roles -->
<div class="modal-overlay" id="role-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Hak Akses</h3>
            <button class="btn-close" onclick="closeRoleModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="edit-uid">
            <input type="hidden" id="edit-village">
            
            <p style="margin: 0 0 1rem 0; font-size: 0.8rem; color: #6b7280;">Pilih hak akses untuk <strong id="edit-user-name" style="color:#111827;"></strong>:</p>
            
            <div id="roles-loader" style="display:none; text-align:center; padding: 1rem; color:#6b7280;">
                <i class="fa-solid fa-circle-notch fa-spin"></i> Memuat daftar role...
            </div>
            
            <div class="role-list" id="role-list-container">
                <!-- Checkboxes diisi via JS -->
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeRoleModal()">Batal</button>
            <button class="btn btn-primary" id="btn-save-roles" onclick="saveRoles()">Simpan Perubahan</button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let allUsers = [];
    
    document.addEventListener('DOMContentLoaded', () => {
        fetchVillages();
        fetchUsers();
    });
    
    async function fetchVillages() {
        try {
            const res = await fetch(`${API_URL}/superadmin/villages`, {
                headers: { 'Authorization': `Bearer ${FIREBASE_ID_TOKEN}` }
            });
            const data = await res.json();
            if(data.success) {
                const select = document.getElementById('village-filter');
                data.data.forEach(v => {
                    const opt = document.createElement('option');
                    opt.value = v.id;
                    opt.textContent = v.name;
                    select.appendChild(opt);
                });
            }
        } catch(e) {
            console.error('Error fetching villages', e);
        }
    }
    
    async function fetchUsers() {
        document.getElementById('loader').style.display = 'block';
        document.getElementById('users-table').style.display = 'none';
        
        const vId = document.getElementById('village-filter').value;
        const url = vId ? `${API_URL}/master/users?villageId=${vId}` : `${API_URL}/master/users`;
        
        try {
            const res = await fetch(url, {
                headers: { 'Authorization': `Bearer ${FIREBASE_ID_TOKEN}` }
            });
            const data = await res.json();
            
            if(data.success) {
                // Sembunyikan role SUPER_ADMIN dari daftar pengguna
                allUsers = data.data.filter(u => !(u.roles && u.roles.includes('SUPER_ADMIN')));
                document.getElementById('total-users').textContent = allUsers.length;
                renderTable(allUsers);
            }
        } catch(e) {
            showToast('Gagal memuat pengguna', e.message);
        } finally {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('users-table').style.display = 'table';
        }
    }
    
    function filterTable() {
        const query = document.getElementById('search-input').value.toLowerCase();
        const filtered = allUsers.filter(u => {
            const name = (u.name || '').toLowerCase();
            const email = (u.email || '').toLowerCase();
            return name.includes(query) || email.includes(query);
        });
        renderTable(filtered);
    }
    
    function renderTable(users) {
        const tbody = document.getElementById('users-tbody');
        tbody.innerHTML = '';
        
        if(users.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding: 2rem; color: #9ca3af;">Tidak ada pengguna ditemukan.</td></tr>`;
            return;
        }
        
        users.forEach(u => {
            // Render roles
            let rolesHtml = '';
            if(u.roles && u.roles.length > 0) {
                u.roles.forEach(r => {
                    rolesHtml += `<span class="role-badge ${r}">${r}</span>`;
                });
            } else {
                rolesHtml = '<span style="color:#9ca3af; font-size:0.8rem;">Tidak ada</span>';
            }
            
            // Render avatar
            let initial = (u.name || '?').charAt(0).toUpperCase();
            let avatarHtml = `<div class="user-avatar">${u.photoUrl ? `<img src="${u.photoUrl}" onerror="this.style.display='none'">` : initial}</div>`;
            
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="user-info">
                        ${avatarHtml}
                        <div class="user-details">
                            <span class="user-name">${u.name || 'Tanpa Nama'}</span>
                            <span class="user-email">${u.email || u.uid}</span>
                        </div>
                    </div>
                </td>
                <td><span style="font-size:0.8rem; color:#4b5563;">${u.villageId || '-'}</span></td>
                <td>${rolesHtml}</td>
                <td>
                    <span style="font-size:0.75rem; font-weight:600; padding:0.15rem 0.5rem; border-radius:1rem; 
                          background:${u.status === 'ACTIVE' ? '#d1fae5' : '#fee2e2'}; 
                          color:${u.status === 'ACTIVE' ? '#059669' : '#dc2626'};">
                        ${u.status}
                    </span>
                </td>
                <td style="text-align:right;">
                    <button class="btn-action" title="Edit Role" onclick="openRoleModal('${u.uid}', '${u.name}', '${u.villageId}')">
                        <i class="fa-solid fa-shield-halved"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }
    
    // MODAL LOGIC
    async function openRoleModal(uid, name, villageId) {
        document.getElementById('edit-uid').value = uid;
        document.getElementById('edit-user-name').textContent = name;
        document.getElementById('edit-village').value = villageId;
        
        const modal = document.getElementById('role-modal');
        modal.classList.add('active');
        
        const container = document.getElementById('role-list-container');
        container.innerHTML = '';
        document.getElementById('roles-loader').style.display = 'block';
        
        try {
            // Get available roles for this village
            const resRoles = await fetch(`${API_URL}/roles/${villageId || 'ALL'}`, {
                headers: { 'Authorization': `Bearer ${FIREBASE_ID_TOKEN}` }
            });
            const dataRoles = await resRoles.json();
            
            // Get user's current roles
            const user = allUsers.find(u => u.uid === uid);
            const userRoles = user && user.roles ? user.roles : [];
            
            if (dataRoles.success) {
                let availableRoles = dataRoles.data;
                // Add some default roles if missing
                const defaultRoles = ['SUPER_ADMIN', 'ADMIN_DESA', 'WARGA', 'BENDAHARA', 'PENGURUS_RT'];
                defaultRoles.forEach(r => {
                    if(!availableRoles.includes(r)) availableRoles.push(r);
                });
                
                availableRoles.forEach(roleName => {
                    const isChecked = userRoles.includes(roleName) ? 'checked' : '';
                    
                    const label = document.createElement('label');
                    label.className = 'role-item';
                    label.innerHTML = `
                        <input type="checkbox" value="${roleName}" ${isChecked}>
                        <span style="font-weight:500; color:#374151;">${roleName}</span>
                    `;
                    container.appendChild(label);
                });
            }
        } catch(e) {
            console.error(e);
            container.innerHTML = '<p style="color:#dc2626;">Gagal memuat role.</p>';
        } finally {
            document.getElementById('roles-loader').style.display = 'none';
        }
    }
    
    function closeRoleModal() {
        document.getElementById('role-modal').classList.remove('active');
    }
    
    async function saveRoles() {
        const uid = document.getElementById('edit-uid').value;
        const villageId = document.getElementById('edit-village').value;
        const btn = document.getElementById('btn-save-roles');
        
        // Kumpulkan role yang dicentang
        const checkboxes = document.querySelectorAll('#role-list-container input[type="checkbox"]:checked');
        const selectedRoles = Array.from(checkboxes).map(cb => cb.value);
        
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';
        
        try {
            const res = await fetch(`${API_URL}/master/users/${uid}/roles`, {
                method: 'PUT',
                headers: { 
                    'Authorization': `Bearer ${FIREBASE_ID_TOKEN}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ roles: selectedRoles, villageId })
            });
            const data = await res.json();
            if(data.success) {
                showToast('Sukses', 'Hak akses berhasil diperbarui.');
                closeRoleModal();
                fetchUsers(); // Refresh table
            } else {
                showToast('Gagal', data.message);
            }
        } catch(e) {
            showToast('Error', e.message);
        } finally {
            btn.disabled = false;
            btn.textContent = 'Simpan Perubahan';
        }
    }
</script>
<?= $this->endSection() ?>
