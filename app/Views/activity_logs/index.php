<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    /* ===== ACTIVITY LOGS - AUDIT TRAIL ===== */
    .logs-wrap {
        width: 100%;
    }

    /* Hero Header */
    .page-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #312e81 100%);
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        margin-bottom: 1rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px -3px rgba(15, 23, 42, 0.2);
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -30px;
        width: 240px; height: 240px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, rgba(99, 102, 241, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 1;
    }
    .page-hero::after {
        content: '';
        position: absolute;
        bottom: -50px; right: 120px;
        width: 140px; height: 140px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(56, 189, 248, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 1;
    }
    .hero-text {
        position: relative;
        z-index: 10;
    }
    .hero-text h1 { 
        margin: 0 0 0.2rem 0; 
        font-size: 1.25rem; 
        font-weight: 700; 
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .hero-text p { 
        margin: 0; 
        opacity: 0.82; 
        font-size: 0.8rem; 
        max-width: 650px;
        line-height: 1.35;
    }

    /* Realtime Pill & Pulse */
    .realtime-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(16, 185, 129, 0.16);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.32);
        padding: 0.2rem 0.55rem;
        border-radius: 9999px;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        user-select: none;
        backdrop-filter: blur(4px);
    }
    .realtime-pill.paused {
        background: rgba(148, 163, 184, 0.12);
        color: #cbd5e1;
        border-color: rgba(148, 163, 184, 0.25);
    }
    .pulsing-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: #10b981;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulseGreen 1.8s infinite;
        display: inline-block;
    }
    .pulsing-dot.paused {
        background-color: #94a3b8;
        box-shadow: none;
        animation: none;
    }
    @keyframes pulseGreen {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .btn-realtime-toggle {
        padding: 0.35rem 0.65rem;
        background: rgba(255, 255, 255, 0.12);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        transition: all 0.2s;
    }
    .btn-realtime-toggle:hover {
        background: rgba(255, 255, 255, 0.22);
    }
    @keyframes highlightRow {
        0% { background-color: #dbeafe !important; }
        50% { background-color: #eff6ff !important; }
        100% { background-color: transparent !important; }
    }
    .row-highlight-new {
        animation: highlightRow 3s cubic-bezier(0.25, 1, 0.5, 1) forwards;
    }

    /* Stats Grid */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    .stat-chip {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.65rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-chip:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    }
    .stat-icon {
        width: 28px;
        height: 28px;
        border-radius: 0.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .stat-num {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }
    .stat-label {
        font-size: 0.68rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    /* Toolbar Filter */
    .toolbar-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        margin-bottom: 0.75rem;
        display: flex;
        gap: 0.65rem;
        align-items: center;
        flex-wrap: wrap;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .toolbar-search {
        flex: 1;
        min-width: 200px;
        position: relative;
    }
    .toolbar-search input {
        width: 100%;
        padding: 0.35rem 0.75rem 0.35rem 2.2rem;
        border: 1.5px solid #cbd5e1;
        border-radius: 0.5rem;
        font-family: inherit;
        font-size: 0.8rem;
        background: #f8fafc;
        box-sizing: border-box;
        transition: all 0.2s;
    }
    .toolbar-search input:focus {
        outline: none;
        background: #ffffff;
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.12);
    }
    .toolbar-search i {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.8rem;
    }
    .toolbar-select {
        padding: 0.35rem 0.65rem;
        border: 1.5px solid #cbd5e1;
        border-radius: 0.5rem;
        font-family: inherit;
        font-size: 0.8rem;
        background: #f8fafc;
        cursor: pointer;
        color: #334155;
        font-weight: 500;
        transition: all 0.2s;
    }
    .toolbar-select:focus {
        outline: none;
        background: #ffffff;
        border-color: #4f46e5;
    }
    .btn-refresh {
        padding: 0.35rem 0.75rem;
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        transition: background 0.2s;
    }
    .btn-refresh:hover {
        background: #4338ca;
    }

    /* Logs Table Card */
    .table-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.625rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .logs-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.78rem !important;
    }
    .logs-table thead tr {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        font-size: 0.68rem !important;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .logs-table th {
        padding: 4px 6px !important;
        font-weight: 700;
    }
    .logs-table td {
        padding: 3px 6px !important;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle !important;
        line-height: 1.25 !important;
    }
    .logs-table tbody tr:hover {
        background: #f8fafc;
    }

    /* Action Badges */
    .badge-action {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 1px 5px !important;
        border-radius: 9999px;
        font-size: 0.65rem !important;
        font-weight: 700;
        letter-spacing: 0.02em;
        white-space: nowrap;
    }
    .badge-open { background: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe; }
    .badge-login { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-login-pending { background: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }
    .badge-join { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
    .badge-claim { background: #ffedd5; color: #c2410c; border: 1px solid #fed7aa; }
    .badge-link { background: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; }
    .badge-save { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
    .badge-delete { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
    .badge-village { background: #ede9fe; color: #6d28d9; border: 1px solid #ddd6fe; }
    .badge-default { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

    /* Device Badges */
    .device-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.2rem 0.55rem;
        border-radius: 9999px;
        font-size: 0.725rem;
        font-weight: 600;
        margin-top: 3px;
        white-space: nowrap;
        border: 1px solid transparent;
        line-height: 1.25;
        transition: transform 0.15s ease;
    }
    .device-badge:hover {
        transform: translateY(-1px);
    }
    .device-android-apk {
        background: #ecfdf5;
        color: #065f46;
        border-color: #a7f3d0;
    }
    .device-android-apk i {
        color: #10b981;
        font-size: 0.8rem;
    }
    .device-android-web {
        background: #f0fdf4;
        color: #166534;
        border-color: #bbf7d0;
    }
    .device-android-web i {
        color: #22c55e;
        font-size: 0.8rem;
    }
    .device-apple {
        background: #f8fafc;
        color: #1e293b;
        border-color: #cbd5e1;
    }
    .device-apple i {
        color: #0f172a;
        font-size: 0.8rem;
    }
    .device-windows {
        background: #eff6ff;
        color: #1e40af;
        border-color: #bfdbfe;
    }
    .device-windows i {
        color: #2563eb;
        font-size: 0.8rem;
    }
    .device-mac {
        background: #f1f5f9;
        color: #334155;
        border-color: #cbd5e1;
    }
    .device-mac i {
        color: #475569;
        font-size: 0.8rem;
    }
    .device-linux {
        background: #fffbeb;
        color: #92400e;
        border-color: #fde68a;
    }
    .device-linux i {
        color: #d97706;
        font-size: 0.8rem;
    }
    .device-api {
        background: #fdf2f8;
        color: #9d174d;
        border-color: #fbcfe8;
    }
    .device-api i {
        color: #ec4899;
        font-size: 0.75rem;
    }
    .device-web {
        background: #f1f5f9;
        color: #475569;
        border-color: #cbd5e1;
    }
    .device-web i {
        color: #64748b;
        font-size: 0.8rem;
    }


    /* Village Tag */
    .village-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #f1f5f9;
        color: #334155;
        font-weight: 600;
        font-size: 0.775rem;
        padding: 0.2rem 0.55rem;
        border-radius: 0.375rem;
        border: 1px solid #e2e8f0;
    }
    .village-code-badge {
        font-family: monospace;
        font-size: 0.725rem;
        color: #6366f1;
        background: #eef2ff;
        padding: 0.1rem 0.35rem;
        border-radius: 0.25rem;
        font-weight: 700;
    }

    /* User Cell */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 0.65rem;
    }
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.8rem;
        flex-shrink: 0;
    }
    .user-meta-name {
        font-weight: 600;
        color: #0f172a;
        line-height: 1.25;
    }
    .user-meta-sub {
        font-size: 0.75rem;
        color: #64748b;
        max-width: 170px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Pagination */
    .pagination-bar {
        padding: 0.85rem 1.25rem;
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        font-size: 0.825rem;
        color: #64748b;
    }
    .pagination-btns {
        display: flex;
        gap: 0.35rem;
    }
    .btn-page {
        padding: 0.4rem 0.75rem;
        border: 1px solid #cbd5e1;
        background: white;
        color: #334155;
        border-radius: 0.375rem;
        font-size: 0.825rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-page:hover:not(:disabled) {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
    .btn-page.active {
        background: #4f46e5;
        border-color: #4f46e5;
        color: white;
    }
    .btn-page:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    /* Modal Detail */
    .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(2px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .modal-box {
        background: white;
        border-radius: 1rem;
        width: 100%;
        max-width: 650px;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        overflow: hidden;
    }
    .modal-head {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
    }
    .modal-body {
        padding: 1.5rem;
        overflow-y: auto;
    }
    .code-box {
        background: #0f172a;
        color: #38bdf8;
        padding: 1rem;
        border-radius: 0.625rem;
        font-family: 'Consolas', 'Monaco', monospace;
        font-size: 0.8rem;
        overflow-x: auto;
        white-space: pre-wrap;
        word-break: break-all;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="logs-wrap">
    <!-- Hero Header -->
    <div class="page-hero">
        <div class="hero-text">
            <h1><i class="fa-solid fa-clock-rotate-left" style="color: #60a5fa;"></i> Log Aktivitas Sistem (Audit Trail)</h1>
            <p>
                Rekam jejak setiap login warga, pendaftaran akun baru, klaim akun, penghapusan, hingga penautan akun warga secara transparan dan akurat.
            </p>
        </div>
        <div style="display:flex; align-items:center; gap:0.65rem; flex-wrap:wrap; justify-content:flex-end; position:relative; z-index:10;">
            <!-- Realtime Live Pill -->
            <div class="realtime-pill" id="realtime-pill" title="Status pemantauan realtime">
                <span class="pulsing-dot" id="realtime-dot"></span>
                <span id="realtime-status-text">Realtime Aktif (3s)</span>
            </div>

            <!-- Toggle Jeda Realtime -->
            <button class="btn-realtime-toggle" id="btn-toggle-realtime" onclick="toggleRealtime()" title="Jeda atau lanjutkan pembaruan otomatis">
                <i class="fa-solid fa-pause" id="realtime-toggle-icon"></i>
                <span id="realtime-toggle-text">Jeda</span>
            </button>

            <!-- Manual Refresh -->
            <button class="btn-refresh" id="btn-manual-refresh" onclick="fetchLogs(1, false)">
                <i class="fa-solid fa-arrows-rotate" id="refresh-icon"></i> Segarkan
            </button>
        </div>
    </div>

    <!-- Floating Banner Jika ada log baru saat user di halaman > 1 -->
    <div id="new-logs-banner" style="display:none; margin-bottom: 1.25rem; background: linear-gradient(90deg, #3730a3, #4f46e5); color: white; padding: 0.75rem 1.25rem; border-radius: 0.75rem; box-shadow: 0 4px 15px rgba(79,70,229,0.3); align-items: center; justify-content: space-between; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'" onclick="fetchLogs(1, false)">
        <div style="display:flex; align-items:center; gap:0.65rem;">
            <i class="fa-solid fa-bell fa-shake" style="color: #fde047; font-size:1.1rem;"></i>
            <span id="new-logs-banner-text">Ada aktivitas baru tercatat! Klik untuk melihat halaman pertama.</span>
        </div>
        <span style="background: rgba(255,255,255,0.2); padding: 0.25rem 0.65rem; border-radius: 0.375rem; font-size: 0.775rem;">Buka Halaman 1 &rarr;</span>
    </div>

    <!-- Stats Row -->
    <div class="stats-row">
        <div class="stat-chip">
            <div class="stat-icon" style="background:#eef2ff; color:#4f46e5;">
                <i class="fa-solid fa-list-check"></i>
            </div>
            <div>
                <div class="stat-num" id="stat-total">0</div>
                <div class="stat-label">Total Aktivitas</div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-icon" style="background:#dcfce7; color:#16a34a;">
                <i class="fa-solid fa-right-to-bracket"></i>
            </div>
            <div>
                <div class="stat-num" id="stat-login">0</div>
                <div class="stat-label">Login & Buka App</div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-icon" style="background:#f3e8ff; color:#9333ea;">
                <i class="fa-solid fa-link"></i>
            </div>
            <div>
                <div class="stat-num" id="stat-link">0</div>
                <div class="stat-label">Tautkan / Klaim Akun</div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-icon" style="background:#fee2e2; color:#dc2626;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <div class="stat-num" id="stat-delete">0</div>
                <div class="stat-label">Aksi Hapus / Kritis</div>
            </div>
        </div>
    </div>

    <!-- Toolbar & Filter -->
    <div class="toolbar-card">
        <div class="toolbar-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="search-input" placeholder="Cari nama warga, email, NIK, deskripsi, atau IP..." oninput="debounceSearch()">
        </div>

        <select id="filter-action" class="toolbar-select" onchange="fetchLogs(1, false)">
            <option value="ALL">🔍 Semua Tipe Aksi</option>
            <option value="APP_OPEN">📱 APP_OPEN (Membuka Aplikasi)</option>
            <option value="LOGIN">🟢 LOGIN (Login Berhasil)</option>
            <option value="LOGIN_PENDING_VILLAGE">🟡 LOGIN_PENDING_VILLAGE (Login Belum Ada RT)</option>
            <option value="JOIN_VILLAGE_PENDING">🔵 JOIN_VILLAGE_PENDING (Pendaftar Warga Baru)</option>
            <option value="CLAIM_ACCOUNT">🟠 CLAIM_ACCOUNT (Klaim Akun Warga)</option>
            <option value="LINK_ACCOUNT">🟣 LINK_ACCOUNT (Tautkan Akun ke Warga Lama)</option>
            <option value="SAVE_FAMILY">🟢 SAVE_FAMILY (Tambah/Update Warga/KK)</option>
            <option value="DELETE_USER">🔴 DELETE_USER (Hapus Warga)</option>
            <option value="DELETE_FAMILY">🔴 DELETE_FAMILY (Hapus Anggota Keluarga)</option>
            <option value="REGISTER_VILLAGE">🏛️ REGISTER_VILLAGE (Daftar Desa Baru)</option>
            <option value="BULK_IMPORT_USERS">📦 BULK_IMPORT_USERS (Import Warga)</option>
        </select>

        <select id="filter-village" class="toolbar-select" onchange="fetchLogs(1, false)">
            <option value="ALL">🏡 Semua Desa / RT</option>
        </select>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div style="overflow-x: auto;">
            <table class="logs-table">
                <thead>
                    <tr>
                        <th style="width: 140px;">Waktu</th>
                        <th style="width: 220px;">Aktor / Pengguna</th>
                        <th style="width: 180px;">Desa / Wilayah</th>
                        <th style="width: 160px;">Aksi</th>
                        <th>Keterangan Aktivitas</th>
                        <th style="width: 140px;">Perangkat & IP</th>
                        <th style="width: 80px; text-align: center;">Detail</th>
                    </tr>
                </thead>
                <tbody id="logs-tbody">
                    <tr>
                        <td colspan="7" style="text-align:center; padding: 3rem; color: #94a3b8;">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.75rem; color: #4f46e5; margin-bottom: 0.5rem; display: block;"></i>
                            Memuat log aktivitas...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-bar">
            <div>
                Menampilkan <strong id="showing-start">0</strong> - <strong id="showing-end">0</strong> dari <strong id="showing-total">0</strong> aktivitas
            </div>
            <div class="pagination-btns" id="pagination-buttons">
                <!-- Tombol Pagination diinjeksi via JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Payload -->
<div class="modal-backdrop" id="detail-modal" onclick="closeModalOnBackdrop(event)">
    <div class="modal-box">
        <div class="modal-head">
            <h3 style="margin:0; font-size:1.1rem; font-weight:700; color:#0f172a; display:flex; align-items:center; gap:0.5rem;">
                <i class="fa-solid fa-circle-info" style="color:#4f46e5;"></i> Rincian Audit Log
            </h3>
            <button onclick="closeDetailModal()" style="background:none; border:none; font-size:1.4rem; color:#94a3b8; cursor:pointer; line-height:1;">&times;</button>
        </div>
        <div class="modal-body" id="detail-modal-body">
            <!-- Konten diisi JavaScript -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let currentPage = 1;
    const limitPerPage = 50;
    let totalLogs = 0;
    let totalPages = 1;
    let debounceTimer = null;
    let currentLogsData = [];

    // Realtime Polling state
    let isRealtimeActive = true;
    let realtimeTimer = null;
    let isFetching = false;
    let lastKnownTopId = null;
    const POLL_INTERVAL = 3000; // Cek aktivitas baru setiap 3 detik

    async function getSafeToken() {
        return (typeof FIREBASE_ID_TOKEN !== 'undefined' && FIREBASE_ID_TOKEN) ? FIREBASE_ID_TOKEN : getFirebaseToken();
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadVillagesDropdown();
        fetchLogs(1, false);
        startRealtimePolling();
    });

    // Pause polling jika tab browser tidak aktif untuk hemat bandwidth
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopRealtimePolling();
        } else if (isRealtimeActive) {
            startRealtimePolling();
            pollRealtimeLogs();
        }
    });

    function startRealtimePolling() {
        stopRealtimePolling();
        realtimeTimer = setInterval(pollRealtimeLogs, POLL_INTERVAL);
    }

    function stopRealtimePolling() {
        if (realtimeTimer) {
            clearInterval(realtimeTimer);
            realtimeTimer = null;
        }
    }

    function toggleRealtime() {
        isRealtimeActive = !isRealtimeActive;
        const pill = document.getElementById('realtime-pill');
        const dot = document.getElementById('realtime-dot');
        const statusText = document.getElementById('realtime-status-text');
        const toggleIcon = document.getElementById('realtime-toggle-icon');
        const toggleText = document.getElementById('realtime-toggle-text');

        if (isRealtimeActive) {
            pill.classList.remove('paused');
            dot.classList.remove('paused');
            statusText.textContent = 'Realtime Aktif (3s)';
            toggleIcon.className = 'fa-solid fa-pause';
            toggleText.textContent = 'Jeda';
            startRealtimePolling();
            pollRealtimeLogs();
        } else {
            pill.classList.add('paused');
            dot.classList.add('paused');
            statusText.textContent = 'Realtime Dijeda';
            toggleIcon.className = 'fa-solid fa-play';
            toggleText.textContent = 'Lanjutkan';
            stopRealtimePolling();
        }
    }

    function pollRealtimeLogs() {
        if (!isRealtimeActive || isFetching) return;

        // Jangan auto-refresh jika modal detail sedang terbuka
        const modal = document.getElementById('detail-modal');
        if (modal && modal.style.display === 'flex') return;

        // Jangan auto-refresh jika pengguna sedang mengetik di kotak pencarian
        const searchInput = document.getElementById('search-input');
        if (searchInput && document.activeElement === searchInput) return;

        fetchLogs(currentPage, true);
    }

    function debounceSearch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchLogs(1, false);
        }, 350);
    }

    async function loadVillagesDropdown() {
        const select = document.getElementById('filter-village');
        try {
            const token = await getSafeToken();
            let villages = [];

            // 1. Coba dari API_URL
            try {
                const res = await fetch(`${API_URL}/superadmin/villages`, {
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                const json = await res.json();
                if (json.success && Array.isArray(json.data)) {
                    villages = json.data;
                }
            } catch (errApi) {
                console.warn('Gagal fetch villages dari API_URL, coba lokal...', errApi);
            }

            // 2. Fallback lokal jika kosong
            if (villages.length === 0) {
                try {
                    const localRes = await fetch(`<?= base_url('/wa_blast/villages') ?>`);
                    const localJson = await localRes.json();
                    if (localJson.success && Array.isArray(localJson.data)) {
                        villages = localJson.data;
                    }
                } catch (errLocal) {}
            }

            villages.forEach(v => {
                const opt = document.createElement('option');
                opt.value = v.id;
                opt.textContent = `${v.name} (${v.uniqueCode || '-'})`;
                select.appendChild(opt);
            });
        } catch (e) {
            console.error('Error loading villages dropdown:', e);
        }
    }

    async function fetchLogs(page = 1, isSilent = false) {
        if (isFetching) return;
        isFetching = true;
        currentPage = page;

        const tbody = document.getElementById('logs-tbody');
        const icon = document.getElementById('refresh-icon');

        if (!isSilent) {
            if (icon) icon.classList.add('fa-spin');
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align:center; padding: 2.5rem; color: #94a3b8;">
                        <i class="fa-solid fa-spinner fa-spin" style="font-size: 1.5rem; color: #4f46e5; margin-bottom: 0.5rem; display: block;"></i>
                        Memuat data...
                    </td>
                </tr>
            `;
        }

        const action = document.getElementById('filter-action').value;
        const villageId = document.getElementById('filter-village').value;
        const search = document.getElementById('search-input').value.trim();

        const queryParams = new URLSearchParams({
            page: currentPage,
            limit: limitPerPage,
            action: action,
            villageId: villageId,
            search: search
        });

        let json = null;

        try {
            // 1. Coba fetch dari API_URL (Node.js jimpitan-server)
            try {
                const token = await getSafeToken();
                const res = await fetch(`${API_URL}/master/activity-logs?${queryParams.toString()}`, {
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                if (res.ok) {
                    json = await res.json();
                }
            } catch (errApi) {
                // Silently fallback
            }

            // 2. Fallback ke endpoint CI4 lokal (/activity_logs/data)
            if (!json || !json.success) {
                try {
                    const localRes = await fetch(`<?= base_url('/activity_logs/data') ?>?${queryParams.toString()}`);
                    if (localRes.ok) {
                        json = await localRes.json();
                    }
                } catch (errLocal) {}
            }
        } finally {
            isFetching = false;
            if (icon && !isSilent) icon.classList.remove('fa-spin');
        }

        if (!json || !json.success) {
            if (!isSilent) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align:center; padding: 2.5rem; color: #ef4444;">
                            <i class="fa-solid fa-circle-exclamation" style="font-size: 1.5rem; margin-bottom: 0.5rem; display: block;"></i>
                            Gagal memuat log aktivitas: ${json ? (json.message || 'Error server') : 'Koneksi terputus'}.
                        </td>
                    </tr>
                `;
            }
            return;
        }

        const newLogs = json.data || [];
        const incomingTopId = newLogs.length > 0 ? newLogs[0].id : null;
        totalLogs = json.total || newLogs.length;
        totalPages = json.totalPages || Math.ceil(totalLogs / limitPerPage) || 1;

        // Deteksi apakah ada item baru
        const hasNewItems = lastKnownTopId && incomingTopId && (lastKnownTopId !== incomingTopId);
        const newIdsSet = new Set();

        if (hasNewItems && isSilent) {
            const prevIds = new Set(currentLogsData.map(l => l.id));
            newLogs.forEach(l => {
                if (!prevIds.has(l.id)) {
                    newIdsSet.add(l.id);
                }
            });
        }

        // Jika user sedang melihat halaman > 1 dan ada log baru masuk
        const banner = document.getElementById('new-logs-banner');
        if (currentPage > 1 && hasNewItems) {
            if (banner) {
                banner.style.display = 'flex';
                document.getElementById('new-logs-banner-text').textContent = 
                    `Ada ${newIdsSet.size || 'beberapa'} aktivitas baru baru saja tercatat! Klik di sini untuk melihat.`;
            }
        } else {
            if (banner) banner.style.display = 'none';
        }

        // Perbarui data jika bukan silent ATAU ada item baru ATAU data awal
        if (!isSilent || hasNewItems || currentLogsData.length === 0) {
            currentLogsData = newLogs;
            lastKnownTopId = incomingTopId;
            updateStats(currentLogsData, totalLogs);
            renderTable(currentLogsData, newIdsSet);
            renderPagination();
        } else {
            // Update stats tetap berjalan halus
            updateStats(currentLogsData, totalLogs);
        }
    }

    function updateStats(logs, total) {
        document.getElementById('stat-total').textContent = total.toLocaleString('id-ID');
        
        let loginCount = 0;
        let linkCount = 0;
        let deleteCount = 0;

        logs.forEach(l => {
            const act = (l.action || '').toUpperCase();
            if (act.includes('LOGIN') || act.includes('APP_OPEN')) loginCount++;
            if (act.includes('LINK') || act.includes('CLAIM') || act.includes('JOIN')) linkCount++;
            if (act.includes('DELETE') || act.includes('CLEANUP')) deleteCount++;
        });

        document.getElementById('stat-login').textContent = loginCount;
        document.getElementById('stat-link').textContent = linkCount;
        document.getElementById('stat-delete').textContent = deleteCount;
    }

    function formatTime(isoStr) {
        if (!isoStr) return '-';
        const d = new Date(isoStr);
        if (isNaN(d.getTime())) return isoStr;

        const pad = n => String(n).padStart(2, '0');
        const day = pad(d.getDate());
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const month = months[d.getMonth()];
        const year = d.getFullYear();
        const hours = pad(d.getHours());
        const mins = pad(d.getMinutes());
        const secs = pad(d.getSeconds());

        return `
            <div style="font-weight:600; color:#1e293b; font-size:0.825rem;">${day} ${month} ${year}</div>
            <div style="font-size:0.75rem; color:#64748b; font-family:monospace;">${hours}:${mins}:${secs} WIB</div>
        `;
    }

    function getActionBadge(action) {
        const act = (action || '').toUpperCase();
        let badgeClass = 'badge-default';
        let icon = '<i class="fa-solid fa-circle-dot"></i>';

        switch (act) {
            case 'APP_OPEN':
                badgeClass = 'badge-open';
                icon = '<i class="fa-solid fa-mobile-screen"></i>';
                break;
            case 'LOGIN':
                badgeClass = 'badge-login';
                icon = '<i class="fa-solid fa-right-to-bracket"></i>';
                break;
            case 'LOGIN_PENDING_VILLAGE':
                badgeClass = 'badge-login-pending';
                icon = '<i class="fa-solid fa-user-clock"></i>';
                break;
            case 'JOIN_VILLAGE_PENDING':
                badgeClass = 'badge-join';
                icon = '<i class="fa-solid fa-user-plus"></i>';
                break;
            case 'CLAIM_ACCOUNT':
                badgeClass = 'badge-claim';
                icon = '<i class="fa-solid fa-id-badge"></i>';
                break;
            case 'LINK_ACCOUNT':
                badgeClass = 'badge-link';
                icon = '<i class="fa-solid fa-link"></i>';
                break;
            case 'SAVE_FAMILY':
                badgeClass = 'badge-save';
                icon = '<i class="fa-solid fa-user-check"></i>';
                break;
            case 'DELETE_USER':
            case 'DELETE_FAMILY':
            case 'CLEANUP_USERS':
                badgeClass = 'badge-delete';
                icon = '<i class="fa-solid fa-trash-can"></i>';
                break;
            case 'REGISTER_VILLAGE':
                badgeClass = 'badge-village';
                icon = '<i class="fa-solid fa-landmark"></i>';
                break;
            case 'BULK_IMPORT_USERS':
                badgeClass = 'badge-join';
                icon = '<i class="fa-solid fa-file-import"></i>';
                break;
        }

        return `<span class="badge-action ${badgeClass}">${icon} ${escapeHtml(action)}</span>`;
    }

    function parseDeviceInfo(userAgent) {
        const ua = (userAgent || '').trim();
        if (!ua) {
            return {
                badgeClass: 'device-web',
                icon: 'fa-solid fa-globe',
                label: 'Web Browser',
                fullName: 'Tidak Diketahui'
            };
        }

        // 1. Android Flutter APK (Dart HTTP Client / OkHttp / Dalvik / Jimpitan App)
        if (/Dart|dart:io|okhttp|Dalvik|jimpitan/i.test(ua)) {
            return {
                badgeClass: 'device-android-apk',
                icon: 'fa-brands fa-android',
                label: 'Android APK',
                fullName: 'Aplikasi Android Jimpitan (Flutter Native)'
            };
        }

        // 2. Android Mobile Web (Chrome / Firefox / Samsung di HP Android)
        if (/Android/i.test(ua)) {
            let browser = 'Chrome';
            if (/SamsungBrowser/i.test(ua)) browser = 'Samsung Browser';
            else if (/Firefox/i.test(ua)) browser = 'Firefox';
            else if (/Opera|OPR/i.test(ua)) browser = 'Opera';

            return {
                badgeClass: 'device-android-web',
                icon: 'fa-brands fa-android',
                label: 'Android Web',
                fullName: `HP Android (${browser})`
            };
        }

        // 3. Apple iOS (iPhone / iPad)
        if (/iPhone|iPad|iPod|CFNetwork|Darwin/i.test(ua)) {
            const isTablet = /iPad/i.test(ua);
            return {
                badgeClass: 'device-apple',
                icon: 'fa-brands fa-apple',
                label: isTablet ? 'iPad' : 'iPhone iOS',
                fullName: isTablet ? 'Apple iPad' : 'Apple iPhone'
            };
        }

        // 4. Windows PC
        if (/Windows/i.test(ua)) {
            let browser = 'Web';
            if (/Edg\//i.test(ua)) browser = 'Edge';
            else if (/Chrome\//i.test(ua)) browser = 'Chrome';
            else if (/Firefox\//i.test(ua)) browser = 'Firefox';

            return {
                badgeClass: 'device-windows',
                icon: 'fa-brands fa-windows',
                label: 'Windows PC',
                fullName: `PC Windows (${browser})`
            };
        }

        // 5. Mac OS
        if (/Macintosh|Mac OS X/i.test(ua)) {
            let browser = 'Safari';
            if (/Chrome\//i.test(ua)) browser = 'Chrome';
            else if (/Firefox\//i.test(ua)) browser = 'Firefox';

            return {
                badgeClass: 'device-mac',
                icon: 'fa-brands fa-apple',
                label: 'macOS PC',
                fullName: `Apple Mac (${browser})`
            };
        }

        // 6. Linux PC
        if (/Linux/i.test(ua)) {
            return {
                badgeClass: 'device-linux',
                icon: 'fa-brands fa-linux',
                label: 'Linux PC',
                fullName: 'Komputer Linux'
            };
        }

        // 7. API Tool / Postman / curl
        if (/Postman|curl|insomnia|axios|node-fetch/i.test(ua)) {
            const tool = ua.split('/')[0] || 'API Tool';
            return {
                badgeClass: 'device-api',
                icon: 'fa-solid fa-terminal',
                label: 'API Tool',
                fullName: `API Client (${tool})`
            };
        }

        // 8. Fallback
        return {
            badgeClass: 'device-web',
            icon: 'fa-solid fa-desktop',
            label: 'Web Browser',
            fullName: 'Web Browser'
        };
    }

    function getDeviceBadge(userAgent) {
        const info = parseDeviceInfo(userAgent);
        return `<span class="device-badge ${info.badgeClass}" title="${escapeHtml(info.fullName + ' | ' + (userAgent || ''))}">
            <i class="${info.icon}"></i> <span>${escapeHtml(info.label)}</span>
        </span>`;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function renderTable(logs, newIdsSet = new Set()) {
        const tbody = document.getElementById('logs-tbody');
        tbody.innerHTML = '';

        if (logs.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align:center; padding: 3rem; color: #94a3b8;">
                        <i class="fa-regular fa-folder-open" style="font-size: 2rem; margin-bottom: 0.5rem; display: block; color: #cbd5e1;"></i>
                        Tidak ada log aktivitas yang cocok dengan filter.
                    </td>
                </tr>
            `;
            return;
        }

        logs.forEach((log, index) => {
            const tr = document.createElement('tr');

            // Tambahkan animasi highlight jika baris ini baru saja masuk secara realtime
            if (newIdsSet && newIdsSet.has(log.id)) {
                tr.classList.add('row-highlight-new');
            }

            const userName = log.userName || (log.userEmail ? log.userEmail.split('@')[0] : 'Sistem/Anonim');
            const initial = userName.charAt(0).toUpperCase();
            const userEmail = log.userEmail || (log.userId ? `UID: ${log.userId.slice(0, 8)}...` : '-');

            let villageDisplay = '<span style="color:#94a3b8; font-size:0.75rem;">- Global -</span>';
            const vObj = log.Village || log.village;
            if (vObj && vObj.name) {
                villageDisplay = `
                    <div class="village-tag">
                        <span>🏡 ${escapeHtml(vObj.name)}</span>
                        ${vObj.uniqueCode ? `<span class="village-code-badge">${escapeHtml(vObj.uniqueCode)}</span>` : ''}
                    </div>
                `;
            } else if (log.villageName) {
                villageDisplay = `
                    <div class="village-tag">
                        <span>🏡 ${escapeHtml(log.villageName)}</span>
                        ${log.villageUniqueCode ? `<span class="village-code-badge">${escapeHtml(log.villageUniqueCode)}</span>` : ''}
                    </div>
                `;
            } else if (log.villageId) {
                villageDisplay = `<span class="village-tag" style="font-family:monospace; font-size:0.75rem;">ID: ${escapeHtml(log.villageId)}</span>`;
            }

            const ip = log.ip || log.ipAddress || '-';
            const userAgent = log.userAgent || '';
            const deviceBadge = getDeviceBadge(userAgent);

            tr.innerHTML = `
                <td>${formatTime(log.createdAt)}</td>
                <td>
                    <div class="user-cell">
                        <div class="user-avatar">${initial}</div>
                        <div>
                            <div class="user-meta-name" title="${escapeHtml(userName)}">${escapeHtml(userName)}</div>
                            <div class="user-meta-sub" title="${escapeHtml(userEmail)}">${escapeHtml(userEmail)}</div>
                        </div>
                    </div>
                </td>
                <td>${villageDisplay}</td>
                <td>${getActionBadge(log.action)}</td>
                <td>
                    <div style="font-size:0.85rem; color:#1e293b; line-height:1.4;">${escapeHtml(log.description || '-')}</div>
                    ${log.targetName ? `<div style="font-size:0.75rem; color:#6366f1; margin-top:2px;"><i class="fa-solid fa-arrow-turn-down-right"></i> Target: <strong>${escapeHtml(log.targetName)}</strong></div>` : ''}
                </td>
                <td>
                    <div style="font-size:0.75rem; font-family:monospace; color:#475569;">${escapeHtml(ip)}</div>
                    <div>${deviceBadge}</div>
                </td>
                <td style="text-align: center;">
                    <button onclick="showDetailModal(${index})" style="background:#f1f5f9; border:1px solid #cbd5e1; border-radius:0.375rem; padding:0.35rem 0.6rem; color:#475569; cursor:pointer; font-size:0.8rem; transition:all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'" title="Lihat Payload Detail">
                        <i class="fa-solid fa-code"></i>
                    </button>
                </td>
            `;

            tbody.appendChild(tr);
        });
    }

    function renderPagination() {
        const start = totalLogs === 0 ? 0 : (currentPage - 1) * limitPerPage + 1;
        const end = Math.min(currentPage * limitPerPage, totalLogs);

        document.getElementById('showing-start').textContent = start;
        document.getElementById('showing-end').textContent = end;
        document.getElementById('showing-total').textContent = totalLogs;

        const container = document.getElementById('pagination-buttons');
        container.innerHTML = '';

        if (totalPages <= 1) return;

        // Prev Button
        const prevBtn = document.createElement('button');
        prevBtn.className = 'btn-page';
        prevBtn.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => fetchLogs(currentPage - 1, false);
        container.appendChild(prevBtn);

        // Page buttons (windowing)
        const maxVisible = 5;
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + maxVisible - 1);

        if (endPage - startPage < maxVisible - 1) {
            startPage = Math.max(1, endPage - maxVisible + 1);
        }

        for (let p = startPage; p <= endPage; p++) {
            const pageBtn = document.createElement('button');
            pageBtn.className = `btn-page ${p === currentPage ? 'active' : ''}`;
            pageBtn.textContent = p;
            pageBtn.onclick = () => fetchLogs(p, false);
            container.appendChild(pageBtn);
        }

        // Next Button
        const nextBtn = document.createElement('button');
        nextBtn.className = 'btn-page';
        nextBtn.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.onclick = () => fetchLogs(currentPage + 1, false);
        container.appendChild(nextBtn);
    }

    function showDetailModal(index) {
        const log = currentLogsData[index];
        if (!log) return;

        const modalBody = document.getElementById('detail-modal-body');

        let detailsFormatted = '{}';
        if (log.details) {
            try {
                const parsed = typeof log.details === 'string' ? JSON.parse(log.details) : log.details;
                detailsFormatted = JSON.stringify(parsed, null, 2);
            } catch (e) {
                detailsFormatted = String(log.details);
            }
        }

        modalBody.innerHTML = `
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:0.75rem; margin-bottom:1.25rem;">
                <div style="background:#f8fafc; padding:0.75rem; border-radius:0.5rem; border:1px solid #e2e8f0;">
                    <div style="font-size:0.75rem; color:#64748b; font-weight:600;">ID LOG</div>
                    <div style="font-size:0.875rem; font-weight:700; color:#0f172a; font-family:monospace;">${escapeHtml(log.id)}</div>
                </div>
                <div style="background:#f8fafc; padding:0.75rem; border-radius:0.5rem; border:1px solid #e2e8f0;">
                    <div style="font-size:0.75rem; color:#64748b; font-weight:600;">AKSI</div>
                    <div style="margin-top:2px;">${getActionBadge(log.action)}</div>
                </div>
                <div style="background:#f8fafc; padding:0.75rem; border-radius:0.5rem; border:1px solid #e2e8f0;">
                    <div style="font-size:0.75rem; color:#64748b; font-weight:600;">AKTOR (USER)</div>
                    <div style="font-size:0.875rem; font-weight:600; color:#0f172a;">${escapeHtml(log.userName || '-')}</div>
                    <div style="font-size:0.75rem; color:#64748b;">${escapeHtml(log.userEmail || log.userId || '-')}</div>
                </div>
                <div style="background:#f8fafc; padding:0.75rem; border-radius:0.5rem; border:1px solid #e2e8f0;">
                    <div style="font-size:0.75rem; color:#64748b; font-weight:600;">DESA / WILAYAH</div>
                    <div style="font-size:0.875rem; font-weight:600; color:#0f172a;">${escapeHtml(log.Village?.name || log.village?.name || log.villageName || log.villageId || '-')}</div>
                </div>
                <div style="background:#f8fafc; padding:0.75rem; border-radius:0.5rem; border:1px solid #e2e8f0;">
                    <div style="font-size:0.75rem; color:#64748b; font-weight:600;">ALAMAT IP CLIENT</div>
                    <div style="font-size:0.825rem; font-family:monospace; color:#334155;">${escapeHtml(log.ip || log.ipAddress || '-')}</div>
                </div>
                <div style="background:#f8fafc; padding:0.75rem; border-radius:0.5rem; border:1px solid #e2e8f0;">
                    <div style="font-size:0.75rem; color:#64748b; font-weight:600;">WAKTU REKAM</div>
                    <div style="font-size:0.825rem; color:#334155;">${log.createdAt || '-'}</div>
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <div style="font-size:0.8rem; font-weight:700; color:#334155; margin-bottom:0.35rem;">Keterangan Aktivitas:</div>
                <div style="background:#f8fafc; padding:0.75rem; border-radius:0.5rem; border:1px solid #e2e8f0; font-size:0.875rem; color:#1e293b; line-height:1.45;">
                    ${escapeHtml(log.description || '-')}
                </div>
            </div>

            <div style="margin-bottom:1rem;">
                <div style="font-size:0.8rem; font-weight:700; color:#334155; margin-bottom:0.35rem;">Perangkat & User Agent:</div>
                <div style="background:#f8fafc; padding:0.75rem; border-radius:0.5rem; border:1px solid #e2e8f0;">
                    <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:0.5rem;">
                        ${getDeviceBadge(log.userAgent)}
                        <span style="font-size:0.85rem; font-weight:600; color:#1e293b;">${escapeHtml(parseDeviceInfo(log.userAgent).fullName)}</span>
                    </div>
                    <div style="font-size:0.75rem; color:#64748b; font-family:monospace; word-break:break-all; background:#ffffff; padding:0.5rem; border-radius:0.375rem; border:1px solid #e2e8f0;">
                        ${escapeHtml(log.userAgent || 'Tidak ada data User-Agent')}
                    </div>
                </div>
            </div>

            <div>
                <div style="font-size:0.8rem; font-weight:700; color:#334155; margin-bottom:0.35rem;">Payload Data Details (JSON):</div>
                <pre class="code-box"><code>${escapeHtml(detailsFormatted)}</code></pre>
            </div>
        `;

        document.getElementById('detail-modal').style.display = 'flex';
    }

    function closeDetailModal() {
        document.getElementById('detail-modal').style.display = 'none';
    }

    function closeModalOnBackdrop(e) {
        if (e.target.id === 'detail-modal') {
            closeDetailModal();
        }
    }
</script>
<?= $this->endSection() ?>
