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
        font-size: 0.8rem;
        background: white;
        cursor: pointer;
        color: #374151;
        transition: border-color 0.2s;
    }
    .toolbar-filter:focus { outline: none; border-color: #4f46e5; }

    /* Stats Row - Compact */
    .stats-row {
        display: flex;
        gap: 0.65rem;
        margin-bottom: 0.85rem;
        flex-wrap: wrap;
    }
    .stat-chip {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.5rem 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex: 1;
        min-width: 110px;
    }
    .stat-chip-icon {
        width: 28px; height: 28px;
        border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem;
        flex-shrink: 0;
    }
    .stat-chip-icon.indigo  { background: #ede9fe; color: #4f46e5; }
    .stat-chip-icon.green   { background: #d1fae5; color: #059669; }
    .stat-chip-icon.amber   { background: #fef3c7; color: #d97706; }
    .stat-chip-icon.red     { background: #fee2e2; color: #dc2626; }
    .stat-chip-text { line-height: 1.15; }
    .stat-chip-num { font-size: 1.15rem; font-weight: 800; color: #1f2937; }
    .stat-chip-label { font-size: 0.68rem; color: #6b7280; font-weight: 500; }

    /* Data Table Card - Ultra Compact */
    .data-card {
        background: white;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th {
        background: #fafafa;
        padding: 4px 6px !important;
        text-align: left;
        font-size: 0.68rem !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #6b7280;
        border-bottom: 1.5px solid #e5e7eb;
        white-space: nowrap;
        line-height: 1.2;
    }
    .data-table td {
        padding: 3px 6px !important;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.78rem !important;
        vertical-align: middle;
        overflow: visible;
        line-height: 1.25;
    }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background-color: #f8fafc; }
    
    .user-info { display: flex; align-items: center; gap: 0.45rem; }
    .user-avatar {
        width: 22px; height: 22px;
        border-radius: 50%;
        background: #e0e7ff;
        color: #4f46e5;
        display: flex; justify-content: center; align-items: center;
        font-weight: 600; font-size: 0.65rem;
        flex-shrink: 0;
    }
    .user-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
    .user-details { display: flex; flex-direction: column; line-height: 1.15; }
    .user-name { font-weight: 600; color: #1f2937; margin-bottom: 0; font-size: 0.78rem; }
    .user-email { font-size: 0.68rem; color: #6b7280; }
    
    /* Roles styling */
    .role-badge {
        display: inline-block;
        padding: 1px 5px;
        border-radius: 4px;
        font-size: 0.65rem;
        font-weight: 600;
        background: #f3f4f6;
        color: #4b5563;
        margin-right: 0.2rem;
        margin-bottom: 0;
        line-height: 1.1;
    }
    .role-badge.ADMIN_DESA { background: #fee2e2; color: #dc2626; }
    .role-badge.SUPER_ADMIN { background: #ede9fe; color: #4f46e5; }
    
    /* Actions */
    .btn-action {
        width: 22px; height: 22px;
        border-radius: 4px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.15s;
        font-size: 0.7rem;
        padding: 0;
    }
    .btn-action:hover { border-color: #4f46e5; color: #4f46e5; background: #eff6ff; }
    .btn-action.btn-delete:hover { border-color: #dc2626; color: #dc2626; background: #fef2f2; }
    
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
        <div class="stat-chip">
            <div class="stat-chip-icon green"><i class="fa-solid fa-user-check"></i></div>
            <div class="stat-chip-text">
                <div class="stat-chip-num" id="active-users">0</div>
                <div class="stat-chip-label">Pengguna Aktif</div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon amber"><i class="fa-solid fa-user-clock"></i></div>
            <div class="stat-chip-text">
                <div class="stat-chip-num" id="pending-users">0</div>
                <div class="stat-chip-label">Pending Approval</div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon red"><i class="fa-solid fa-user-xmark"></i></div>
            <div class="stat-chip-text">
                <div class="stat-chip-num" id="incomplete-users">0</div>
                <div class="stat-chip-label">Incomplete / Batal</div>
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
        <select class="toolbar-filter" id="status-filter" onchange="filterTable()">
            <option value="">Semua Status</option>
            <option value="ACTIVE">Aktif (ACTIVE)</option>
            <option value="PENDING">Pending (PENDING)</option>
            <option value="INCOMPLETE">Incomplete (INCOMPLETE)</option>
        </select>
        <button type="button" class="btn btn-danger" id="btn-cleanup" onclick="cleanupIncomplete()" style="display:inline-flex; align-items:center; gap:0.5rem; background:#dc2626; color:white; padding:0.65rem 1.15rem; border-radius:0.625rem; font-weight:600; font-size:0.875rem; cursor:pointer; border:none; box-shadow:0 1px 2px rgba(220,38,38,0.2);">
            <i class="fa-solid fa-broom"></i> Bersihkan Akun Incomplete
        </button>
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

    // Helper aman untuk mengambil token Firebase tanpa risiko hang
    async function getSafeToken() {
        try {
            if (typeof getFreshFirebaseToken === 'function') {
                const tokenPromise = getFreshFirebaseToken();
                const timeoutPromise = new Promise(resolve => setTimeout(() => resolve(null), 3000));
                const token = await Promise.race([tokenPromise, timeoutPromise]);
                if (token) return token;
            }
        } catch (e) {
            console.warn('getSafeToken error:', e);
        }
        return (typeof FIREBASE_ID_TOKEN !== 'undefined' && FIREBASE_ID_TOKEN) ? FIREBASE_ID_TOKEN : getFirebaseToken();
    }
    
    function initUsersPage() {
        fetchVillages();
        fetchUsers();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initUsersPage);
    } else {
        initUsersPage();
    }
    
    async function fetchVillages() {
        try {
            const token = await getSafeToken();

            const res = await fetch(`${API_URL}/superadmin/villages`, {
                headers: { 'Authorization': `Bearer ${token}` }
            });
            const data = await res.json();
            if(data.success && Array.isArray(data.data)) {
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
            const token = await getSafeToken();

            const res = await fetch(url, {
                headers: { 'Authorization': `Bearer ${token}` }
            });
            const data = await res.json();
            
            if(data.success && Array.isArray(data.data)) {
                // Sembunyikan role SUPER_ADMIN dari daftar pengguna
                allUsers = data.data.filter(u => {
                    const roleList = (u.roles || []).map(r => typeof r === 'string' ? r : (r.name || ''));
                    return !roleList.includes('SUPER_ADMIN');
                });
                
                const activeCount = allUsers.filter(u => u.status === 'ACTIVE').length;
                const pendingCount = allUsers.filter(u => u.status === 'PENDING').length;
                const incompleteCount = allUsers.filter(u => u.status === 'INCOMPLETE').length;

                document.getElementById('total-users').textContent = allUsers.length;
                document.getElementById('active-users').textContent = activeCount;
                document.getElementById('pending-users').textContent = pendingCount;
                document.getElementById('incomplete-users').textContent = incompleteCount;

                filterTable();
            } else {
                showToast('Gagal memuat pengguna', data.message || 'Respons server tidak valid');
            }
        } catch(e) {
            console.error('Fetch users error:', e);
            showToast('Gagal memuat pengguna', e.message);
        } finally {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('users-table').style.display = 'table';
        }
    }
    
    function filterTable() {
        const query = (document.getElementById('search-input').value || '').toLowerCase();
        const statusFilter = document.getElementById('status-filter').value;

        const filtered = allUsers.filter(u => {
            const name = (u.name || '').toLowerCase();
            const email = (u.email || '').toLowerCase();
            const matchesQuery = name.includes(query) || email.includes(query);
            const matchesStatus = !statusFilter || u.status === statusFilter;
            return matchesQuery && matchesStatus;
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
            // Render roles safely
            let rolesHtml = '';
            if(u.roles && u.roles.length > 0) {
                u.roles.forEach(r => {
                    const rName = typeof r === 'string' ? r : (r.name || '');
                    if (rName) {
                        rolesHtml += `<span class="role-badge ${rName}">${rName}</span>`;
                    }
                });
            }
            if (!rolesHtml) {
                rolesHtml = '<span style="color:#9ca3af; font-size:0.8rem;">Tidak ada</span>';
            }
            
            // Render avatar
            let initial = (u.name || u.email || '?').charAt(0).toUpperCase();
            let avatarHtml = `<div class="user-avatar">${u.photoUrl ? `<img src="${u.photoUrl}" onerror="this.style.display='none'">` : initial}</div>`;
            
            let statusBadge = '';
            if (u.status === 'ACTIVE') {
                statusBadge = `<span style="font-size:0.75rem; font-weight:600; padding:0.15rem 0.5rem; border-radius:1rem; background:#d1fae5; color:#059669;">ACTIVE</span>`;
            } else if (u.status === 'PENDING') {
                statusBadge = `<span style="font-size:0.75rem; font-weight:600; padding:0.15rem 0.5rem; border-radius:1rem; background:#fef3c7; color:#d97706;">PENDING</span>`;
            } else {
                statusBadge = `<span style="font-size:0.75rem; font-weight:600; padding:0.15rem 0.5rem; border-radius:1rem; background:#fee2e2; color:#dc2626;">${u.status || 'INCOMPLETE'}</span>`;
            }

            const safeUid = (u.uid || '').replace(/'/g, "\\'");
            const safeName = (u.name || '').replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(/"/g, '&quot;');
            const safeVillage = (u.villageId || '').replace(/'/g, "\\'");
            const displayTitle = (u.name || u.email || 'Pengguna').replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(/"/g, '&quot;');
            const displayName = (u.name || 'Tanpa Nama').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            const displayEmail = (u.email || u.uid || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="user-info">
                        ${avatarHtml}
                        <div class="user-details">
                            <span class="user-name">${displayName}</span>
                            <span class="user-email">${displayEmail}</span>
                        </div>
                    </div>
                </td>
                <td><span style="font-size:0.8rem; color:#4b5563;">${u.villageId || '-'}</span></td>
                <td>${rolesHtml}</td>
                <td>${statusBadge}</td>
                <td style="text-align:right;">
                    <div style="display:inline-flex; gap:0.35rem;">
                        <button class="btn-action" title="Edit Role" onclick="openRoleModal('${safeUid}', '${safeName}', '${safeVillage}')">
                            <i class="fa-solid fa-shield-halved"></i>
                        </button>
                        <button class="btn-action btn-delete" title="Hapus Pengguna" onclick="deleteUser('${safeUid}', '${displayTitle}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    async function cleanupIncomplete() {
        const orphanCount = allUsers.filter(u => u.status === 'INCOMPLETE' && (!u.villageId || u.villageId === '-' || u.villageId === '')).length;
        if (orphanCount === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Database Bersih',
                text: 'Tidak ada akun incomplete yang belum memilih desa.'
            });
            return;
        }

        const result = await Swal.fire({
            title: 'Bersihkan Akun Incomplete?',
            html: `Ditemukan <b>${orphanCount}</b> akun berstatus <code>INCOMPLETE</code> yang tidak terhubung dengan desa manapun (pengguna batal atau automated bot Google Play).<br><br>Akun-akun ini akan dihapus dari sistem agar manajemen pengguna tetap rapi.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Bersihkan Sekarang',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed) {
            Swal.fire({
                title: 'Membersihkan...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            try {
                const token = await getSafeToken();

                const res = await fetch(`${API_URL}/master/users/cleanup-incomplete`, {
                    method: 'DELETE',
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                const data = await res.json();
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                    fetchUsers();
                } else {
                    Swal.fire('Gagal', data.message || 'Gagal membersihkan akun', 'error');
                }
            } catch (e) {
                Swal.fire('Error', e.message, 'error');
            }
        }
    }

    async function deleteUser(uid, name) {
        const result = await Swal.fire({
            title: 'Hapus Pengguna?',
            html: `Apakah Anda yakin ingin menghapus pengguna <b>${name}</b>?<br><span style="font-size:0.85rem; color:#6b7280;">Seluruh hak akses pengguna ini akan dicabut.</span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed) {
            try {
                const token = await getSafeToken();

                const res = await fetch(`${API_URL}/master/users/${uid}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                const data = await res.json();
                if (data.success) {
                    showToast('Sukses', 'Pengguna berhasil dihapus');
                    fetchUsers();
                } else {
                    showToast('Gagal', data.message);
                }
            } catch (e) {
                showToast('Error', e.message);
            }
        }
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
            const token = await getSafeToken();

            // Get available roles for this village
            const resRoles = await fetch(`${API_URL}/roles/${villageId || 'ALL'}`, {
                headers: { 'Authorization': `Bearer ${token}` }
            });
            const dataRoles = await resRoles.json();
            
            // Get user's current roles
            const user = allUsers.find(u => u.uid === uid);
            const userRoles = user && user.roles ? user.roles : [];
            
            if (dataRoles.success) {
                let availableRoles = dataRoles.data;
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
        
        const checkboxes = document.querySelectorAll('#role-list-container input[type="checkbox"]:checked');
        const selectedRoles = Array.from(checkboxes).map(cb => cb.value);
        
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';
        
        try {
            const token = await getSafeToken();

            const res = await fetch(`${API_URL}/master/users/${uid}/roles`, {
                method: 'PUT',
                headers: { 
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ roles: selectedRoles, villageId })
            });
            const data = await res.json();
            if(data.success) {
                showToast('Sukses', 'Hak akses berhasil diperbarui.');
                closeRoleModal();
                fetchUsers();
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
