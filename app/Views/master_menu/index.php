<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    /* ===== MASTER MENU PAGE - PREMIUM DESIGN ===== */
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
    .hero-actions { display: flex; gap: 0.75rem; z-index: 1; }

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
    .stat-chip-icon.green   { background: #d1fae5; color: #059669; }
    .stat-chip-icon.red     { background: #fee2e2; color: #dc2626; }
    .stat-chip-icon.blue    { background: #dbeafe; color: #2563eb; }
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
    .data-table tbody tr { transition: background 0.12s; }
    .data-table tbody tr:hover td { background: #f9fafb; }

    /* Icon Preview Cell */
    .icon-cell {
        width: 40px;
        height: 40px;
        background: #ede9fe;
        border-radius: 0.625rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f46e5;
        font-size: 1.1rem;
        flex-shrink: 0;
        overflow: visible;
    }
    .icon-cell i {
        color: #4f46e5 !important;
        font-size: 1rem;
        display: inline-block;
    }

    /* Route code chip */
    .route-chip {
        font-family: 'JetBrains Mono', 'Fira Code', monospace;
        background: #f1f5f9;
        color: #0f172a;
        border-radius: 0.375rem;
        padding: 0.2rem 0.5rem;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid #e2e8f0;
    }

    /* Position chip */
    .pos-chip {
        padding: 0.2rem 0.6rem;
        border-radius: 0.375rem;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .pos-top { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .pos-grid { background: #fce7f3; color: #be185d; border: 1px solid #fbcfe8; }
    .pos-bottom { background: #e0e7ff; color: #4338ca; border: 1px solid #c7d2fe; }
    .pos-drawer { background: #f3f4f6; color: #4b5563; border: 1px solid #e5e7eb; }
    .pos-other { background: #f1f5f9; color: #475569; }

    /* Badges */
    .badge { padding: 0.25rem 0.65rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.03em; display: inline-flex; align-items: center; gap: 0.25rem; }
    .badge-active   { background: #d1fae5; color: #065f46; }
    .badge-inactive { background: #fee2e2; color: #991b1b; }
    .badge-core     { background: #ede9fe; color: #5b21b6; }

    /* Drag handle */
    .drag-handle {
        cursor: grab;
        color: #d1d5db;
        font-size: 1rem;
        padding: 0 0.5rem;
        touch-action: none;
    }
    .drag-handle:hover { color: #9ca3af; }

    /* Action buttons */
    .btn-prim {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 0.625rem;
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(79,70,229,0.3);
    }
    .btn-prim:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(79,70,229,0.4); }
    .btn-sec {
        background: rgba(255,255,255,0.15);
        color: white;
        border: 1.5px solid rgba(255,255,255,0.3);
        padding: 0.625rem 1.25rem;
        border-radius: 0.625rem;
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.2s;
    }
    .btn-sec:hover { background: rgba(255,255,255,0.25); }
    .btn-icon {
        padding: 0.4rem 0.6rem;
        border-radius: 0.5rem;
        border: 1.5px solid #e5e7eb;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        white-space: nowrap;
    }
    .btn-icon.edit  { color: #f59e0b; border-color: #fde68a; background: #fffbeb; }
    .btn-icon.edit:hover  { background: #fef3c7; }
    .btn-icon.del   { color: #ef4444; border-color: #fecaca; background: #fff5f5; }
    .btn-icon.del:hover   { background: #fee2e2; }
    .btn-tog {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.3rem 0.65rem;
        border-radius: 0.4rem;
        border: 1.5px solid #e5e7eb;
        background: white;
        cursor: pointer;
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        transition: all 0.2s;
    }
    .btn-tog:hover { border-color: #4f46e5; color: #4f46e5; background: #ede9fe; }
    .btn-tog.active { background: #d1fae5; color: #059669; border-color: #a7f3d0; }
    .btn-tog.inactive { background: #fee2e2; color: #dc2626; border-color: #fca5a5; }

    /* ===== MODAL ===== */
    .modal-backdrop {
        position: fixed; inset: 0;
        background: rgba(15,15,30,0.55);
        backdrop-filter: blur(8px);
        display: flex; align-items: center; justify-content: center;
        z-index: 9999;
        opacity: 0; pointer-events: none;
        transition: opacity 0.25s;
    }
    .modal-backdrop.open { opacity: 1; pointer-events: all; }
    .modal-box {
        background: white;
        border-radius: 1.25rem;
        width: 100%;
        max-width: 580px;
        max-height: 92vh;
        overflow-y: auto;
        box-shadow: 0 25px 60px rgba(0,0,0,0.2);
        transform: translateY(24px) scale(0.97);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .modal-backdrop.open .modal-box { transform: translateY(0) scale(1); }

    .modal-head {
        padding: 1.5rem 1.75rem 1.25rem;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border-radius: 1.25rem 1.25rem 0 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
    }
    .modal-head h3 {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .modal-close {
        width: 32px; height: 32px;
        border-radius: 50%;
        border: none;
        background: rgba(255,255,255,0.2);
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    .modal-close:hover { background: rgba(255,255,255,0.35); }

    .modal-body { padding: 1.75rem; }
    .modal-foot {
        padding: 1.25rem 1.75rem 1.5rem;
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
        border-top: 1px solid #f1f5f9;
    }
    .btn-modal-cancel {
        background: #f1f5f9; color: #374151; border: none;
        padding: 0.65rem 1.25rem; border-radius: 0.625rem;
        font-family: inherit; font-weight: 600; font-size: 0.875rem;
        cursor: pointer; transition: background 0.2s;
    }
    .btn-modal-cancel:hover { background: #e2e8f0; }
    .btn-modal-save {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white; border: none;
        padding: 0.65rem 1.5rem; border-radius: 0.625rem;
        font-family: inherit; font-weight: 600; font-size: 0.875rem;
        cursor: pointer; transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(79,70,229,0.3);
        display: inline-flex; align-items: center; gap: 0.4rem;
    }
    .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(79,70,229,0.4); }

    /* Form Fields */
    .field { margin-bottom: 1.2rem; }
    .field label {
        display: flex; align-items: center; gap: 0.3rem;
        margin-bottom: 0.4rem;
        font-size: 0.78rem;
        font-weight: 700;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .field label .req { color: #ef4444; }
    .field input, .field textarea, .field select {
        width: 100%; box-sizing: border-box;
        padding: 0.7rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.625rem;
        font-family: inherit;
        font-size: 0.875rem;
        color: #1f2937;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: white;
    }
    .field input:focus, .field textarea:focus, .field select:focus {
        outline: none; border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
    }
    .field input[readonly] { background: #f9fafb; color: #6b7280; }
    .field-row { display: flex; gap: 1rem; }
    .field-row .field { flex: 1; }
    .field-hint { font-size: 0.75rem; color: #9ca3af; margin-top: 0.3rem; }

    /* Toggle in modal */
    .toggle-group { display: flex; gap: 1.25rem; margin-top: 0.5rem; }
    .toggle-item {
        flex: 1;
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.875rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .toggle-item:hover { border-color: #a5b4fc; background: #fafafa; }
    .toggle-item-label { font-size: 0.875rem; font-weight: 600; color: #374151; }
    .toggle-item-sub  { font-size: 0.75rem; color: #9ca3af; margin-top: 0.1rem; }
    .sw { position: relative; display: inline-block; width: 44px; height: 24px; flex-shrink: 0; }
    .sw input { opacity: 0; width: 0; height: 0; }
    .sw-slider {
        position: absolute; cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background: #d1d5db; border-radius: 34px;
        transition: 0.3s;
    }
    .sw-slider:before {
        content: ''; position: absolute;
        height: 18px; width: 18px;
        left: 3px; bottom: 3px;
        background: white; border-radius: 50%;
        transition: 0.3s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.25);
    }
    .sw input:checked + .sw-slider { background: #4f46e5; }
    .sw input:checked + .sw-slider:before { transform: translateX(20px); }

    /* Icon picker preview */
    .icon-preview-row {
        display: flex; align-items: center; gap: 0.75rem;
        margin-top: 0.5rem;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border-radius: 0.625rem;
        border: 1.5px solid #e5e7eb;
    }
    .icon-preview-box {
        width: 42px; height: 42px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border-radius: 0.5rem;
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 1.1rem;
        flex-shrink: 0;
    }
    .icon-preview-text { font-size: 0.8rem; color: #6b7280; }

    /* Danger zone banner */
    .danger-banner {
        background: #fff5f5;
        border: 1.5px solid #fecaca;
        border-radius: 0.75rem;
        padding: 0.875rem 1rem;
        display: flex; align-items: flex-start; gap: 0.625rem;
        margin-bottom: 1.25rem;
        font-size: 0.8rem;
        color: #7f1d1d;
    }
    .danger-banner i { color: #ef4444; margin-top: 0.05rem; flex-shrink: 0; }

    /* Empty state */
    .empty-state {
        text-align: center; padding: 4rem 2rem;
        color: #9ca3af;
    }
    .empty-state i { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.4; display: block; }
    .empty-state p { margin: 0; font-size: 0.9rem; }

    @media (max-width: 768px) {
        .menu-wrap { padding: 1rem; }
        .page-hero { flex-direction: column; gap: 1.25rem; }
        .stats-row { flex-wrap: wrap; }
        .stat-chip { flex: 1 1 140px; }
        .data-table th, .data-table td { padding: 0.75rem; }
        .field-row { flex-direction: column; }
        .toggle-group { flex-direction: column; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="menu-wrap">

    <!-- Hero -->
    <div class="page-hero">
        <div class="hero-text">
            <h1><i class="fa-solid fa-bars-staggered" style="margin-right:0.5rem;"></i> Master Menu</h1>
            <p>Atur visibilitas, urutan, ikon, dan struktur navigasi aplikasi mobile secara real-time.</p>
        </div>
        <div class="hero-actions">
            <button class="btn-sec" onclick="loadMenus()"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
            <button class="btn-prim" onclick="openModal()"><i class="fa-solid fa-plus"></i> Tambah Menu</button>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-row" id="stats-row">
        <div class="stat-chip">
            <div class="stat-chip-icon indigo"><i class="fa-solid fa-list"></i></div>
            <div class="stat-chip-text"><div class="stat-chip-num" id="st-total">—</div><div class="stat-chip-label">Total Menu</div></div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon green"><i class="fa-solid fa-eye"></i></div>
            <div class="stat-chip-text"><div class="stat-chip-num" id="st-active">—</div><div class="stat-chip-label">Aktif</div></div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon red"><i class="fa-solid fa-eye-slash"></i></div>
            <div class="stat-chip-text"><div class="stat-chip-num" id="st-inactive">—</div><div class="stat-chip-label">Nonaktif</div></div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon blue"><i class="fa-solid fa-shield-halved"></i></div>
            <div class="stat-chip-text"><div class="stat-chip-num" id="st-core">—</div><div class="stat-chip-label">Core</div></div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar">
        <div class="toolbar-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="search-input" placeholder="Cari menu berdasarkan ID, label, atau ikon..." oninput="filterMenus()">
        </div>
        <select class="toolbar-filter" id="filter-position" onchange="filterMenus()">
            <option value="">Semua Lokasi</option>
            <option value="grid">Beranda Tengah (Grid)</option>
            <option value="footer">Bawah (Footer)</option>
            <option value="hidden">Tersembunyi</option>
        </select>
        <select class="toolbar-filter" id="filter-status" onchange="filterMenus()">
            <option value="">Semua Status</option>
            <option value="active">Aktif</option>
            <option value="inactive">Nonaktif</option>
        </select>
    </div>

    <!-- Table -->
    <div class="data-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:42px;"></th>
                    <th style="width:54px;">Ikon</th>
                    <th>ID / Route</th>
                    <th>Label</th>
                    <th>Posisi</th>
                    <th style="text-align:center;">Order</th>
                    <th>Status</th>
                    <th>Core</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="menu-tbody">
                <tr><td colspan="9">
                    <div class="empty-state"><i class="fa-solid fa-spinner fa-spin"></i><p>Memuat data menu...</p></div>
                </td></tr>
            </tbody>
        </table>
    </div>

</div>

<!-- ========== MODAL: Menu ========== -->
<div class="modal-backdrop" id="menuModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3><i class="fa-solid fa-bars-staggered"></i> <span id="modalTitle">Tambah Menu Baru</span></h3>
            <button class="modal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="menu_old_id">

            <div class="danger-banner" id="danger-banner" style="display:none;">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>Mengubah menu yang sudah ada dapat mempengaruhi navigasi pada aplikasi mobile. Hati-hati saat mengedit ID Route.</div>
            </div>

            <div class="field">
                <label>ID Menu / Route <span class="req">*</span></label>
                <input type="text" id="menu_id" placeholder="Contoh: chat, laporan, settings">
                <div class="field-hint">Digunakan APK untuk navigasi. Jangan ubah jika sudah dipakai.</div>
            </div>

            <div class="field">
                <label>Label Tampilan <span class="req">*</span></label>
                <input type="text" id="menu_label" placeholder="Contoh: Pesan, Laporan Keuangan">
            </div>

            <div class="field">
                <label>Ikon (Pilih Ikon Flutter/Material)</label>
                <select id="menu_icon" onchange="previewIcon()">
                    <option value="">-- Pilih Ikon --</option>
                    <option value="home">Home (Beranda)</option>
                    <option value="account_balance_wallet">Account Balance Wallet (Keuangan/Tagihan)</option>
                    <option value="payments">Payments (Pembayaran/Iuran)</option>
                    <option value="savings_outlined">Savings (Celengan/Setor Jimpitan)</option>
                    <option value="people">People (Warga/Penduduk)</option>
                    <option value="assignment">Assignment (Surat/Administrasi)</option>
                    <option value="chat">Chat (Pesan/Komunikasi)</option>
                    <option value="settings">Settings (Pengaturan)</option>
                    <option value="info">Info (Informasi)</option>
                    <option value="notifications">Notifications (Notifikasi)</option>
                    <option value="warning">Warning (Panic Button/Darurat)</option>
                    <option value="build">Build (Maintenance/Perbaikan)</option>
                    <option value="store">Store (UMKM/Toko)</option>
                    <option value="event">Event (Kegiatan/Agenda)</option>
                    <option value="map">Map (Peta/Lokasi)</option>
                    <option value="security">Security (Keamanan)</option>
                    <option value="article">Article (Berita/Artikel)</option>
                    <option value="campaign">Campaign (Pengumuman)</option>
                    <option value="health_and_safety">Health & Safety (Kesehatan)</option>
                    <option value="support_agent">Support Agent (Layanan)</option>
                    <option value="dashboard">Dashboard</option>
                    <option value="list">List (Daftar)</option>
                </select>
                <div class="icon-preview-row" id="icon-preview-row" style="margin-top:0.75rem;">
                    <div class="icon-preview-box" id="icon-preview-box"><i class="fa-solid fa-layer-group"></i></div>
                    <div class="icon-preview-text" id="icon-preview-text">Preview ikon akan tampil di sini</div>
                </div>
            </div>

            <div class="field-row">
                <div class="field">
                    <label>Posisi Menu</label>
                    <select id="menu_position">
                        <option value="grid">Beranda Tengah (Grid)</option>
                        <option value="footer">Bawah (Footer)</option>
                        <option value="hidden">Tersembunyi (Khusus Tombol)</option>
                    </select>
                </div>
                <div class="field">
                    <label>Urutan (Order)</label>
                    <input type="number" id="menu_order" value="0" min="0">
                </div>
            </div>

            <div class="field">
                <label>Village ID (Opsional)</label>
                <input type="text" id="menu_village_id" placeholder="Kosongkan untuk menu global (semua desa)">
                <div class="field-hint">Isi jika menu ini khusus untuk desa tertentu.</div>
            </div>

            <div class="field">
                <label>Deskripsi (Opsional)</label>
                <textarea id="menu_description" rows="2" placeholder="Penjelasan singkat tentang menu ini..."></textarea>
            </div>

            <div class="field-row">
                <div class="field">
                    <label>Status Menu</label>
                    <select id="menu_is_active">
                        <option value="true">Aktif (Tampil di Aplikasi)</option>
                        <option value="false">Nonaktif (Sembunyikan)</option>
                    </select>
                </div>
                <div class="field">
                    <label>Perlindungan Core</label>
                    <select id="menu_is_core">
                        <option value="false">Normal (Bisa dihapus admin desa)</option>
                        <option value="true">Core Feature (Wajib / Permanen)</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn-modal-cancel" onclick="closeModal()"><i class="fa-solid fa-xmark"></i> Batal</button>
            <button class="btn-modal-save" onclick="saveMenu()"><i class="fa-solid fa-floppy-disk"></i> Simpan Menu</button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let menusData = [];
    let filteredMenus = [];

    document.addEventListener('DOMContentLoaded', () => {
        loadMenus();
    });

    async function loadMenus() {
        document.getElementById('menu-tbody').innerHTML = `<tr><td colspan="9"><div class="empty-state"><i class="fa-solid fa-spinner fa-spin"></i><p>Memuat menu...</p></div></td></tr>`;
        try {
            const res = await fetch(`${API_URL}/master/menus`, {
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success) {
                menusData = r.data.sort((a, b) => (a.order || 0) - (b.order || 0));
                filteredMenus = [...menusData];
                updateStats();
                renderMenus();
            } else {
                document.getElementById('menu-tbody').innerHTML = `<tr><td colspan="9"><div class="empty-state"><i class="fa-solid fa-triangle-exclamation" style="color:#ef4444;"></i><p>Gagal memuat data menu.</p></div></td></tr>`;
            }
        } catch(e) {
            document.getElementById('menu-tbody').innerHTML = `<tr><td colspan="9"><div class="empty-state"><i class="fa-solid fa-wifi" style="color:#ef4444;"></i><p>Koneksi terputus.</p></div></td></tr>`;
        }
    }

    function updateStats() {
        const total    = menusData.length;
        const active   = menusData.filter(m => m.isActive !== false).length;
        const inactive = total - active;
        const core     = menusData.filter(m => m.isCore).length;
        document.getElementById('st-total').textContent   = total;
        document.getElementById('st-active').textContent  = active;
        document.getElementById('st-inactive').textContent = inactive;
        document.getElementById('st-core').textContent    = core;
    }

    function filterMenus() {
        const q    = document.getElementById('search-input').value.toLowerCase();
        const pos  = document.getElementById('filter-position').value;
        const stat = document.getElementById('filter-status').value;

        filteredMenus = menusData.filter(m => {
            const matchQ   = !q || (m.id||'').toLowerCase().includes(q) || (m.label||'').toLowerCase().includes(q) || (m.icon||'').toLowerCase().includes(q);
            const matchPos = !pos || m.position === pos;
            const matchSt  = !stat || (stat === 'active' ? m.isActive !== false : m.isActive === false);
            return matchQ && matchPos && matchSt;
        });
        renderMenus();
    }

    function posChip(pos) {
        const map = { 
            grid: ['pos-grid','Grid'],
            footer: ['pos-bottom','Footer'], 
            hidden: ['pos-other','Hidden'] 
        };
        const [cls, label] = map[pos] || ['pos-other', pos || '—'];
        return `<span class="pos-chip ${cls}">${label}</span>`;
    }

    function renderMenus() {
        const tbody = document.getElementById('menu-tbody');
        if (!filteredMenus.length) {
            tbody.innerHTML = `<tr><td colspan="9"><div class="empty-state"><i class="fa-solid fa-magnifying-glass"></i><p>Tidak ada menu yang cocok.</p></div></td></tr>`;
            return;
        }

        tbody.innerHTML = filteredMenus.map(m => {
            let iconClass = (m.icon || '').trim();
            let iconTag = `<i class="fa-solid fa-question" style="color:#9ca3af;font-size:1rem;"></i>`;
            let iconBg = 'background:#f1f5f9;';

            if (iconClass) {
                iconBg = '';
                if (iconClass.includes('fa-')) {
                    iconTag = `<i class="${iconClass} fa-fw" style="color:#4f46e5;font-size:1rem;"></i>`;
                } else {
                    // Treat as Material Icon if it doesn't have fa-
                    iconTag = `<span class="material-icons" style="color:#4f46e5;font-size:1.1rem;">${iconClass}</span>`;
                }
            }

            const iconHtml = `<div class="icon-cell" style="${iconBg}">${iconTag}</div>`;
            const isAktif = m.isActive !== false;
            const statusToggle = `
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <label class="sw" title="${isAktif ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan'}">
                        <input type="checkbox" onchange="toggleStatus('${m.id}')" ${isAktif ? 'checked' : ''}>
                        <span class="sw-slider"></span>
                    </label>
                    <span style="font-size:0.75rem; font-weight:600; color:${isAktif ? '#4f46e5' : '#9ca3af'};">${isAktif ? 'Aktif' : 'Nonaktif'}</span>
                </div>
            `;

            const isCore = m.isCore === true;
            const coreToggle = `
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <label class="sw" title="${isCore ? 'Klik untuk melepas Core' : 'Klik untuk jadikan Core'}">
                        <input type="checkbox" onchange="toggleCore('${m.id}')" ${isCore ? 'checked' : ''}>
                        <span class="sw-slider" style="${isCore ? 'background:#7c3aed;' : ''}"></span>
                    </label>
                    <span style="font-size:0.75rem; font-weight:600; color:${isCore ? '#7c3aed' : '#9ca3af'};">${isCore ? '<i class="fa-solid fa-shield-halved"></i> Core' : 'Normal'}</span>
                </div>
            `;

            return `<tr data-id="${m.id}">
                <td><span class="drag-handle" title="Seret untuk mengatur urutan"><i class="fa-solid fa-grip-vertical"></i></span></td>
                <td>${iconHtml}</td>
                <td><span class="route-chip">${m.id}</span></td>
                <td><strong>${m.label || '—'}</strong>${m.description ? `<br><small style="color:#9ca3af;">${m.description}</small>` : ''}</td>
                <td>${posChip(m.position)}</td>
                <td style="text-align:center;font-weight:700;color:#6b7280;">${m.order || 0}</td>
                <td>${statusToggle}</td>
                <td>${coreToggle}</td>
                <td>
                    <div style="display:flex;gap:0.4rem;align-items:center;">
                        <button class="btn-icon edit" onclick="openModal('${m.id}')" title="Edit"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn-icon del" onclick="deleteMenu('${m.id}')" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </td>
            </tr>`;
        }).join('');
    }

    // ===== MODAL =====
    function openModal(menuId = null) {
        const isEdit = !!menuId;
        document.getElementById('danger-banner').style.display = isEdit ? 'flex' : 'none';
        document.getElementById('menu_id').readOnly = isEdit;

        if (isEdit) {
            const m = menusData.find(x => x.id === menuId);
            if (!m) return;
            document.getElementById('modalTitle').textContent = 'Edit Menu';
            document.getElementById('menu_old_id').value    = m.id;
            document.getElementById('menu_id').value        = m.id;
            document.getElementById('menu_label').value     = m.label || '';
            
            // Tambahkan option ke select jika ikon dari DB belum ada di list
            const iconSelect = document.getElementById('menu_icon');
            let iconVal = m.icon || '';
            if (iconVal && !Array.from(iconSelect.options).find(o => o.value === iconVal)) {
                const opt = document.createElement('option');
                opt.value = iconVal;
                opt.textContent = iconVal + ' (Custom)';
                iconSelect.appendChild(opt);
            }
            iconSelect.value = iconVal;

            document.getElementById('menu_position').value  = m.position || 'grid';
            document.getElementById('menu_order').value     = m.order || 0;
            document.getElementById('menu_village_id').value = m.villageId || '';
            document.getElementById('menu_description').value = m.description || '';
            document.getElementById('menu_is_active').value = (m.isActive !== false) ? 'true' : 'false';
            document.getElementById('menu_is_core').value   = (m.isCore === true) ? 'true' : 'false';
        } else {
            document.getElementById('modalTitle').textContent  = 'Tambah Menu Baru';
            document.getElementById('menu_old_id').value       = '';
            document.getElementById('menu_id').value           = '';
            document.getElementById('menu_label').value        = '';
            document.getElementById('menu_icon').value         = '';
            document.getElementById('menu_position').value     = 'grid';
            document.getElementById('menu_order').value        = 0;
            document.getElementById('menu_village_id').value   = '';
            document.getElementById('menu_description').value  = '';
            document.getElementById('menu_is_active').value    = 'true';
            document.getElementById('menu_is_core').value      = 'false';
        }
        previewIcon();
        document.getElementById('menuModal').classList.add('open');
    }

    function closeModal() { document.getElementById('menuModal').classList.remove('open'); }
    document.getElementById('menuModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });

    function previewIcon() {
        let val = document.getElementById('menu_icon').value.trim();
        const box = document.getElementById('icon-preview-box');
        const text = document.getElementById('icon-preview-text');
        
        if (val) {
            if (val.includes('fa-')) {
                box.innerHTML = `<i class="${val} fa-fw"></i>`;
                text.innerHTML = `<strong>${val}</strong> (FontAwesome)`;
            } else {
                box.innerHTML = `<span class="material-icons">${val}</span>`;
                text.innerHTML = `<strong>${val}</strong> (Material Icon)`;
            }
        } else {
            box.innerHTML = `<i class="fa-solid fa-layer-group"></i>`;
            text.textContent = 'Preview ikon akan tampil di sini';
        }
    }

    async function saveMenu() {
        const id = document.getElementById('menu_id').value.trim();
        if (!id) { showAlert('Peringatan', 'ID Menu tidak boleh kosong!', 'warning'); return; }
        const label = document.getElementById('menu_label').value.trim();
        if (!label) { showAlert('Peringatan', 'Label Menu tidak boleh kosong!', 'warning'); return; }

        const payload = {
            label,
            icon:        document.getElementById('menu_icon').value.trim(),
            position:    document.getElementById('menu_position').value,
            order:       parseInt(document.getElementById('menu_order').value) || 0,
            villageId:   document.getElementById('menu_village_id').value.trim() || null,
            description: document.getElementById('menu_description').value.trim(),
            isActive:    document.getElementById('menu_is_active').value === 'true',
            isCore:      document.getElementById('menu_is_core').value === 'true',
        };

        const btn = document.querySelector('.btn-modal-save');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';

        try {
            const res = await fetch(`${API_URL}/master/menus/${encodeURIComponent(id)}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${getFirebaseToken()}` },
                body: JSON.stringify(payload)
            });
            const r = await res.json();
            if (r.success) {
                closeModal();
                await loadMenus();
                showToast('Berhasil', `Menu "${label}" berhasil disimpan.`);
            } else {
                showAlert('Gagal Menyimpan', r.message, 'error');
            }
        } catch(e) {
            showAlert('Kesalahan Jaringan', 'Tidak dapat terhubung ke server.', 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Simpan Menu';
        }
    }

    async function toggleStatus(menuId) {
        const m = menusData.find(x => x.id === menuId);
        if (!m) return;
        
        const isAktif = m.isActive !== false;
        const result = await Swal.fire({
            title: isAktif ? 'Nonaktifkan Menu?' : 'Aktifkan Menu?',
            text: isAktif ? 'Menu ini akan disembunyikan dari aplikasi.' : 'Menu ini akan kembali ditampilkan di aplikasi.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: isAktif ? 'Ya, Nonaktifkan' : 'Ya, Aktifkan'
        });

        if (!result.isConfirmed) {
            await loadMenus(); // Kembalikan posisi toggle
            return;
        }

        const newStatus = !isAktif;
        try {
            const res = await fetch(`${API_URL}/master/menus/${encodeURIComponent(menuId)}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${getFirebaseToken()}` },
                body: JSON.stringify({ ...m, isActive: newStatus })
            });
            const r = await res.json();
            if (r.success) {
                await loadMenus();
                showToast('Status Diperbarui', `Status menu berhasil diubah.`);
            } else {
                showAlert('Gagal', r.message, 'error');
                await loadMenus(); // revert UI if failed
            }
        } catch(e) {
            showAlert('Kesalahan Jaringan', 'Tidak dapat terhubung ke server.', 'error');
            await loadMenus();
        }
    }

    async function deleteMenu(id) {
        const m = menusData.find(x => x.id === id);
        if (m && m.isCore) {
            showAlert('Peringatan', 'Menu Core tidak dapat dihapus. Nonaktifkan saja jika tidak diperlukan.', 'warning');
            return;
        }
        const result = await Swal.fire({
            title: 'Hapus Menu?',
            text: 'Menu yang dihapus tidak akan tampil lagi di aplikasi mobile (untuk semua desa jika global).',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: 'Ya, Hapus!'
        });

        if (!result.isConfirmed) return;

        try {
            const res = await fetch(`${API_URL}/master/menus/${encodeURIComponent(id)}`, {
                method: 'DELETE',
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success) {
                await loadMenus();
                showToast('Terhapus', 'Menu berhasil dihapus.');
            } else {
                showAlert('Gagal', r.message, 'error');
            }
        } catch(e) {
            showAlert('Kesalahan Jaringan', 'Tidak dapat terhubung ke server.', 'error');
        }
    }
</script>
<?= $this->endSection() ?>
