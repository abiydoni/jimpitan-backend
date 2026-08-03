<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    /* ===== SAAS PAGE - PREMIUM DESIGN ===== */
    .saas-wrap {
        width: 100%;
    }

    /* Hero Header */
    .page-hero {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%);
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
        top: -60px; right: -60px;
        width: 250px; height: 250px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }
    .page-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; right: 80px;
        width: 180px; height: 180px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .hero-text h1 {
        margin: 0 0 0.35rem 0;
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: -0.02em;
    }
    .hero-text p {
        margin: 0;
        opacity: 0.8;
        font-size: 0.95rem;
    }
    .hero-stats {
        display: flex;
        gap: 1.5rem;
        z-index: 1;
    }
    .hero-stat {
        text-align: center;
        background: rgba(255,255,255,0.12);
        border-radius: 0.75rem;
        padding: 0.875rem 1.25rem;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.2);
        min-width: 90px;
    }
    .hero-stat-num {
        font-size: 1.75rem;
        font-weight: 700;
        line-height: 1;
        display: block;
    }
    .hero-stat-label {
        font-size: 0.7rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.2rem;
        display: block;
    }

    /* Tabs */
    .tabs-nav {
        display: flex;
        gap: 0.25rem;
        background: white;
        border-radius: 1rem;
        padding: 0.375rem;
        margin-bottom: 1.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        border: 1px solid #e5e7eb;
    }
    .tab-btn {
        flex: 1 1 0%;
        padding: 0.75rem 0.5rem;
        border: none;
        background: transparent;
        border-radius: 0.625rem;
        cursor: pointer;
        font-family: inherit;
        font-weight: 600;
        font-size: 0.875rem;
        color: #6b7280;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tab-btn:hover {
        color: #4f46e5;
        background: #f5f3ff;
    }
    .tab-btn.active {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        box-shadow: 0 4px 12px rgba(79,70,229,0.35);
    }
    .tab-badge {
        background: rgba(255,255,255,0.25);
        border-radius: 9999px;
        padding: 0.1rem 0.45rem;
        font-size: 0.7rem;
        font-weight: 700;
    }
    .tab-btn:not(.active) .tab-badge {
        background: #e5e7eb;
        color: #6b7280;
    }

    .tab-panel { display: none; animation: slideUp 0.25s ease; }
    .tab-panel.active { display: block; }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Action Bar */
    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.25rem;
    }
    .action-bar-title {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
    }
    .action-bar-title small {
        color: #6b7280;
        font-weight: 400;
        margin-left: 0.5rem;
        font-size: 0.825rem;
    }

    /* Buttons */
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
        background: white;
        color: #374151;
        border: 1.5px solid #e5e7eb;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-sec:hover { background: #f9fafb; border-color: #d1d5db; }
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
    }
    .btn-icon:hover { background: #f1f5f9; }
    .btn-icon.edit { color: #f59e0b; border-color: #fde68a; background: #fffbeb; }
    .btn-icon.edit:hover { background: #fef3c7; }
    .btn-icon.del { color: #ef4444; border-color: #fecaca; background: #fff5f5; }
    .btn-icon.del:hover { background: #fee2e2; }
    .btn-icon.ok { color: #10b981; border-color: #a7f3d0; background: #f0fdf4; }
    .btn-icon.ok:hover { background: #dcfce7; }

    /* Plans Grid */
    .plans-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
    }
    .plan-card {
        background: white;
        border-radius: 1rem;
        padding: 1.25rem;
        border: 1.5px solid #e5e7eb;
        position: relative;
        overflow: hidden;
        transition: all 0.25s;
    }
    .plan-card:hover {
        border-color: #a5b4fc;
        box-shadow: 0 8px 24px rgba(79,70,229,0.1);
        transform: translateY(-2px);
    }
    .plan-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, #4f46e5, #a855f7);
    }
    .plan-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
        gap: 0.5rem;
    }
    .plan-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
        flex: 1;
        line-height: 1.3;
        word-break: break-word;
    }
    .plan-actions { display: flex; gap: 0.25rem; flex-shrink: 0; }
    .plan-price-box {
        margin: 0.5rem 0;
        display: flex;
        align-items: baseline;
        gap: 0.25rem;
        flex-wrap: wrap;
    }
    .plan-price-num {
        font-size: 1.25rem;
        font-weight: 800;
        color: #4f46e5;
        letter-spacing: -0.02em;
    }
    .plan-price-period {
        font-size: 0.7rem;
        color: #9ca3af;
        font-weight: 500;
    }
    .plan-features {
        list-style: none;
        padding: 0;
        margin: 1rem 0 0 0;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .plan-features li {
        display: flex;
        align-items: flex-start;
        gap: 0.4rem;
        font-size: 0.75rem;
        color: #374151;
        line-height: 1.4;
    }
    .plan-features li i {
        color: #10b981;
        font-size: 0.7rem;
        flex-shrink: 0;
        margin-top: 0.2rem;
    }
    .plan-footer {
        margin-top: 1rem;
        padding-top: 0.75rem;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.75rem;
        color: #9ca3af;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    /* Data Table */
    .data-card {
        background: white;
        border-radius: 1rem;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
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
    }
    .data-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.875rem;
        vertical-align: middle;
    }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background: #fafafa; }
    .data-table tbody tr { transition: background 0.15s; }

    /* Badges */
    .status-badge {
        padding: 0.25rem 0.7rem;
        border-radius: 9999px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        position: static;
        transform: none;
    }
    .badge-active    { background: #d1fae5; color: #065f46; }
    .badge-inactive  { background: #fee2e2; color: #991b1b; }
    .badge-pending   { background: #fef3c7; color: #92400e; }
    .badge-paid      { background: #d1fae5; color: #065f46; }
    .badge-core      { background: #ede9fe; color: #5b21b6; }

    /* Toggle (Switch) */
    .sw { position: relative; display: inline-block; width: 44px; height: 24px; }
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
    .sw.danger input:checked + .sw-slider { background: #ef4444; }
    .sw.warning input:checked + .sw-slider { background: #f59e0b; }
    .sw.success input:checked + .sw-slider { background: #10b981; }

    /* Selects in table */
    .inline-select {
        padding: 0.4rem 0.75rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.5rem;
        font-family: inherit;
        font-size: 0.825rem;
        background: white;
        color: #374151;
        cursor: pointer;
        transition: border-color 0.2s;
        max-width: 170px;
    }
    .inline-select:focus { outline: none; border-color: #4f46e5; }
    .inline-num {
        padding: 0.4rem 0.5rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.5rem;
        font-family: inherit;
        font-size: 0.825rem;
        width: 80px;
        text-align: center;
    }
    .inline-num:focus { outline: none; border-color: #4f46e5; }

    /* Empty / Loading */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #9ca3af;
    }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; opacity: 0.4; }
    .empty-state p { margin: 0; font-size: 0.95rem; }

    /* ===== MODAL ===== */
    .modal-backdrop {
        position: fixed; inset: 0;
        background: rgba(15,15,30,0.55);
        backdrop-filter: blur(6px);
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
        max-width: 520px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 25px 60px rgba(0,0,0,0.2);
        transform: translateY(24px) scale(0.97);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .modal-backdrop.open .modal-box { transform: translateY(0) scale(1); }
    .modal-head {
        padding: 1.5rem 1.75rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-head h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .modal-head h3 span.modal-icon {
        width: 36px; height: 36px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border-radius: 0.625rem;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 0.9rem;
    }
    .modal-close {
        width: 32px; height: 32px;
        border-radius: 50%;
        border: none;
        background: #f1f5f9;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: #6b7280;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    .modal-close:hover { background: #fee2e2; color: #ef4444; }
    .modal-body { padding: 1.5rem 1.75rem; }
    .modal-foot {
        padding: 1rem 1.75rem 1.5rem;
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
        border-top: 1px solid #f1f5f9;
    }

    /* Form fields in modal */
    .field { margin-bottom: 1.25rem; }
    .field label {
        display: block;
        margin-bottom: 0.4rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .field label .req { color: #ef4444; }
    .field input, .field textarea, .field select {
        width: 100%;
        padding: 0.7rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.625rem;
        font-family: inherit;
        font-size: 0.875rem;
        color: #1f2937;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
        background: white;
    }
    .field input:focus, .field textarea:focus, .field select:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
    }
    .field-row { display: flex; gap: 1rem; }
    .field-row .field { flex: 1; }
    .field-hint {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-top: 0.3rem;
    }

    /* Config save feedback */
    .save-ok { color: #10b981; }

    @media (max-width: 768px) {
        .saas-wrap { padding: 1rem; }
        .page-hero { flex-direction: column; gap: 1.5rem; }
        .hero-stats { flex-wrap: wrap; }
        .plans-grid { grid-template-columns: 1fr; }
        .tabs-nav { flex-wrap: wrap; }
        .tab-btn { font-size: 0.8rem; padding: 0.6rem 0.5rem; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="saas-wrap">

    <!-- Hero -->
    <div class="page-hero">
        <div class="hero-text">
            <h1><i class="fa-solid fa-crown" style="margin-right:0.5rem;"></i> SaaS &amp; Kendali APK</h1>
            <p>Kelola paket langganan, status desa, tagihan, dan konfigurasi fitur aplikasi secara real-time.</p>
        </div>
        <div class="hero-stats" id="hero-stats">
            <div class="hero-stat"><span class="hero-stat-num" id="stat-plans">—</span><span class="hero-stat-label">Paket</span></div>
            <div class="hero-stat"><span class="hero-stat-num" id="stat-active">—</span><span class="hero-stat-label">Aktif</span></div>
            <div class="hero-stat"><span class="hero-stat-num" id="stat-invoices">—</span><span class="hero-stat-label">Invoice</span></div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs-nav">
        <button class="tab-btn active" id="tab-btn-plans" onclick="switchTab('plans', this)">
            <i class="fa-solid fa-box-open"></i> Paket Langganan <span class="tab-badge" id="badge-plans">0</span>
        </button>
        <button class="tab-btn" id="tab-btn-subscriptions" onclick="switchTab('subscriptions', this)">
            <i class="fa-solid fa-city"></i> Langganan Desa <span class="tab-badge" id="badge-subs">0</span>
        </button>
        <button class="tab-btn" id="tab-btn-invoices" onclick="switchTab('invoices', this)">
            <i class="fa-solid fa-file-invoice-dollar"></i> Tagihan <span class="tab-badge" id="badge-inv">0</span>
        </button>
        <button class="tab-btn" id="tab-btn-apk_config" onclick="switchTab('apk_config', this)">
            <i class="fa-solid fa-mobile-screen-button"></i> Kendali APK
        </button>
        <button class="tab-btn" id="tab-btn-settings" onclick="switchTab('settings', this)">
            <i class="fa-solid fa-cogs"></i> Pengaturan SaaS
        </button>
    </div>

    <!-- TAB 1: Plans -->
    <div class="tab-panel active" id="panel-plans">
        <div class="action-bar">
            <div class="action-bar-title">Paket Langganan<small>Semua paket yang tersedia untuk desa</small></div>
            <button class="btn-prim" onclick="openPlanModal()"><i class="fa-solid fa-plus"></i> Tambah Paket</button>
        </div>
        <div class="plans-grid" id="plans-container">
            <div style="grid-column:1/-1;" class="empty-state"><i class="fa-solid fa-spinner fa-spin"></i><p>Memuat paket...</p></div>
        </div>
    </div>

    <!-- TAB 2: Subscriptions -->
    <div class="tab-panel" id="panel-subscriptions">
        <div class="action-bar">
            <div class="action-bar-title">Langganan Desa<small>Status berlangganan setiap desa</small></div>
        </div>
        <div class="data-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Desa</th>
                        <th>Paket Aktif</th>
                        <th>Status</th>
                        <th>Berlaku Sampai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="subs-tbody"><tr><td colspan="5" style="text-align:center;padding:3rem;" class="empty-state"><i class="fa-solid fa-spinner fa-spin" style="font-size:1.5rem;"></i></td></tr></tbody>
            </table>
        </div>
    </div>

    <!-- TAB 3: Invoices -->
    <div class="tab-panel" id="panel-invoices">
        <div class="action-bar">
            <div class="action-bar-title">Tagihan (Invoices)<small>Riwayat dan status pembayaran</small></div>
        </div>
        <div class="data-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Desa</th>
                        <th>Jumlah</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="invoices-tbody"><tr><td colspan="5" style="text-align:center;padding:3rem;"><i class="fa-solid fa-spinner fa-spin" style="font-size:1.5rem;color:#9ca3af;"></i></td></tr></tbody>
            </table>
        </div>
    </div>

    <!-- TAB 4: APK Config -->
    <div class="tab-panel" id="panel-apk_config">
        <div class="action-bar">
            <div class="action-bar-title">Kendali APK<small>Aktifkan/matikan fitur per desa secara real-time</small></div>
        </div>
        <div class="data-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Desa</th>
                        <th style="text-align:center;">Fitur Chat</th>
                        <th style="text-align:center;">Maintenance</th>
                        <th style="text-align:center;">Panic Button</th>
                        <th style="text-align:center;">Maks. Warga</th>
                        <th style="text-align:center;">Simpan</th>
                    </tr>
                </thead>
                <tbody id="config-tbody"><tr><td colspan="6" style="text-align:center;padding:3rem;"><i class="fa-solid fa-spinner fa-spin" style="font-size:1.5rem;color:#9ca3af;"></i></td></tr></tbody>
            </table>
        </div>
    </div>
    <!-- TAB 5: Settings -->
    <div class="tab-panel" id="panel-settings">
        <div class="action-bar">
            <div class="action-bar-title">Pengaturan SaaS<small>Konfigurasi global untuk layanan SaaS</small></div>
        </div>
        <div class="data-card" style="padding: 2rem;">
            <div class="field">
                <label>Informasi Rekening Bank (Ditampilkan di Aplikasi)</label>
                <textarea id="setting_bank_account" rows="4" placeholder="Contoh: Bank BCA 12345678 a/n Jimpitan Digital" style="width:100%; border:1px solid #e5e7eb; border-radius:0.5rem; padding:0.6rem;"></textarea>
                <div class="field-hint">Berikan instruksi transfer yang jelas untuk pengguna.</div>
            </div>
            <div class="field">
                <label>Persentase Pajak (PPN) %</label>
                <input type="number" id="setting_tax_percentage" placeholder="Contoh: 11" style="width:100%; border:1px solid #e5e7eb; border-radius:0.5rem; padding:0.6rem;">
                <div class="field-hint">Besaran persentase pajak yang akan ditambahkan ke total tagihan desa.</div>
            </div>
            <button class="btn-prim" onclick="saveSaasSettings()"><i class="fa-solid fa-save"></i> Simpan Pengaturan</button>
        </div>
    </div>

</div>

<!-- ========== MODAL: Plan ========== -->
<div class="modal-backdrop" id="planModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3><span class="modal-icon"><i class="fa-solid fa-box-open"></i></span> <span id="planModalTitle">Tambah Paket</span></h3>
            <button class="modal-close" onclick="closePlanModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="plan_id">
            <div class="field">
                <label>Nama Paket <span class="req">*</span></label>
                <input type="text" id="plan_name" placeholder="Contoh: Starter, Pro, Enterprise">
            </div>
            <div class="field-row">
                <div class="field">
                    <label>Harga (Rp) <span class="req">*</span></label>
                    <input type="number" id="plan_price" placeholder="50000">
                </div>
                <div class="field">
                    <label>Durasi Paket <span class="req">*</span></label>
                    <select id="plan_duration_months" style="width:100%; border:1px solid #e5e7eb; border-radius:0.5rem; padding:0.6rem;">
                        <option value="1">1 Bulan (Bulanan)</option>
                        <option value="3">3 Bulan (Triwulan)</option>
                        <option value="6">6 Bulan (Semester)</option>
                        <option value="12">1 Tahun (Tahunan)</option>
                        <option value="24">2 Tahun (VIP Special)</option>
                    </select>
                </div>
                <div class="field">
                    <label>Maks. Warga (KK)</label>
                    <input type="number" id="plan_max_users" placeholder="100">
                </div>
            </div>
            <div class="field">
                <label>Deskripsi Fitur</label>
                <textarea id="plan_description" rows="3" placeholder="Iuran RT, Laporan Keuangan, Chat Warga..."></textarea>
                <div class="field-hint">Pisahkan fitur dengan koma untuk tampilkan sebagai checklist.</div>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn-sec" onclick="closePlanModal()">Batal</button>
            <button class="btn-prim" onclick="savePlan()"><i class="fa-solid fa-floppy-disk"></i> Simpan Paket</button>
        </div>
    </div>
</div>
<div class="modal-backdrop" id="subModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3><span class="modal-icon"><i class="fa-solid fa-file-invoice"></i></span> Edit Langganan</h3>
            <button class="modal-close" onclick="closeSubModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="sub_village_id">
            <div class="field">
                <label>Nama Desa</label>
                <input type="text" id="sub_village_name" readonly style="background-color: #f3f4f6; color: #6b7280;">
            </div>
            <div class="field">
                <label>Paket Langganan</label>
                <select id="sub_plan_id" class="inline-select" style="width:100%; border:1px solid #e5e7eb; border-radius:0.5rem; padding:0.6rem;">
                </select>
            </div>
            <div class="field-row">
                <div class="field">
                    <label>Status</label>
                    <select id="sub_status" style="width:100%; border:1px solid #e5e7eb; border-radius:0.5rem; padding:0.6rem;">
                        <option value="ACTIVE">Aktif (ACTIVE)</option>
                        <option value="SUSPENDED">Ditangguhkan (SUSPENDED)</option>
                        <option value="PENDING">Menunggu Pembayaran (PENDING)</option>
                    </select>
                </div>
                <div class="field">
                    <label>Tanggal Berakhir (Expired)</label>
                    <input type="datetime-local" id="sub_end_date" style="width:100%; border:1px solid #e5e7eb; border-radius:0.5rem; padding:0.6rem;">
                    <div style="margin-top:0.5rem; display:flex; gap:0.25rem; flex-wrap:wrap;">
                        <button type="button" class="btn-sec" style="padding:0.2rem 0.5rem; font-size:0.7rem; color:#4f46e5; border-color:#e0e7ff; background:#e0e7ff;" onclick="addFreeDuration(1, 'month')">+1 Bulan</button>
                        <button type="button" class="btn-sec" style="padding:0.2rem 0.5rem; font-size:0.7rem; color:#4f46e5; border-color:#e0e7ff; background:#e0e7ff;" onclick="addFreeDuration(1, 'year')">+1 Tahun</button>
                        <button type="button" class="btn-prim" style="padding:0.2rem 0.5rem; font-size:0.7rem;" onclick="addFreeDuration(99, 'year')">Gratis Selamanya</button>
                    </div>
                    <div class="field-hint" style="margin-top:0.25rem;">Gunakan tombol di atas untuk memberikan akses gratis ke desa.</div>
                </div>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn-sec" onclick="closeSubModal()">Batal</button>
            <button class="btn-prim" onclick="saveSub()"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let plansData = [];
    let villagesData = [];
    let subsData = [];
    let invoicesData = [];

    document.addEventListener('DOMContentLoaded', () => {
        loadPlans();
        loadSettings();
    });

    // ===== TAB SWITCHER =====
    function switchTab(tabId, btn) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('panel-' + tabId).classList.add('active');

        if (tabId === 'plans')       loadPlans();
        if (tabId === 'subscriptions') loadSubscriptions();
        if (tabId === 'invoices')    loadInvoices();
        if (tabId === 'apk_config')  loadApkConfig();
    }

    // ===== TAB 1: PLANS =====
    async function loadPlans() {
        try {
            const res = await fetch(`${API_URL}/saas/plans`, {
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success) {
                plansData = r.data;
                document.getElementById('badge-plans').textContent = plansData.length;
                document.getElementById('stat-plans').textContent = plansData.length;
                renderPlans();
            }
        } catch(e) { console.error(e); }
    }

    function getDurationBadge(months) {
        const m = parseInt(months) || 1;
        if (m >= 24) return `<span class="status-badge" style="background:#ffe4e6;color:#e11d48;font-weight:700;"><i class="fa-solid fa-crown"></i> 2 Tahun (24 Bln)</span>`;
        if (m >= 12) return `<span class="status-badge" style="background:#f3e8ff;color:#7c3aed;font-weight:700;"><i class="fa-solid fa-trophy"></i> 1 Tahun (12 Bln)</span>`;
        if (m >= 6) return `<span class="status-badge" style="background:#fef3c7;color:#d97706;font-weight:700;"><i class="fa-solid fa-bolt"></i> 6 Bulan</span>`;
        if (m >= 3) return `<span class="status-badge" style="background:#ccfbf1;color:#0d9488;font-weight:700;"><i class="fa-solid fa-tag"></i> 3 Bulan</span>`;
        return `<span class="status-badge" style="background:#e0e7ff;color:#4f46e5;font-weight:700;"><i class="fa-solid fa-calendar"></i> 1 Bulan</span>`;
    }
    function getDurationText(months) {
        const m = parseInt(months) || 1;
        if (m >= 24) return '/ 2 tahun';
        if (m >= 12) return '/ 1 tahun';
        if (m >= 6) return '/ 6 bulan';
        if (m >= 3) return '/ 3 bulan';
        return '/ bulan';
    }

    function renderPlans() {
        const c = document.getElementById('plans-container');
        if (!plansData.length) {
            c.innerHTML = `<div style="grid-column:1/-1;" class="empty-state"><i class="fa-solid fa-box-open"></i><p>Belum ada paket. Klik "+ Tambah Paket" untuk mulai.</p></div>`;
            return;
        }
        c.innerHTML = plansData.map(p => {
            const price = parseInt(p.basePrice || p.price || 0).toLocaleString('id-ID');
            const durBadge = getDurationBadge(p.durationMonths);
            const durText = getDurationText(p.durationMonths);
            const feats = typeof p.features === 'object' && p.features
                ? (Array.isArray(p.features) 
                    ? p.features.map(v => `<li><i class="fa-solid fa-circle-check"></i> ${v}</li>`).join('') 
                    : Object.entries(p.features).map(([k,v]) => `<li><i class="fa-solid fa-circle-check"></i> ${k}: ${v}</li>`).join(''))
                : (p.features ? String(p.features).split(',').map(f=>`<li><i class="fa-solid fa-circle-check"></i> ${f.trim()}</li>`).join('') : '');
            const maxKk = p.maxKk || p.maxUsers || '-';
            return `
                <div class="plan-card">
                    <div class="plan-card-header">
                        <h3 class="plan-name">${p.name}</h3>
                        <div class="plan-actions">
                            <button class="btn-icon edit" onclick="openPlanModal(${plansData.indexOf(p)})" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-icon del" onclick="deletePlan('${p.id}')" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="plan-price-box">
                        <span class="plan-price-num">Rp ${price}</span>
                        <span class="plan-price-period">${durText}</span>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fa-solid fa-circle-check"></i> Maks ${maxKk} KK/Warga</li>
                        ${feats}
                    </ul>
                    <div class="plan-footer">
                        <span>ID: <code>${p.id}</code></span>
                        <div>${durBadge}</div>
                    </div>
                </div>`;
        }).join('');
    }

    function openPlanModal(planIdxOrNull = null) {
        const modal = document.getElementById('planModal');
        if (planIdxOrNull !== null && planIdxOrNull !== '') {
            // planIdxOrNull is now the array index (number), avoids ID type mismatch
            const p = (typeof planIdxOrNull === 'number') ? plansData[planIdxOrNull] : plansData.find(x => String(x.id) === String(planIdxOrNull));
            if (!p) { showAlert('Error', 'Data paket tidak ditemukan. Coba refresh halaman.', 'error'); return; }
            document.getElementById('planModalTitle').textContent = 'Edit Paket';
            document.getElementById('plan_id').value = p.id;
            document.getElementById('plan_name').value = p.name || '';
            document.getElementById('plan_price').value = p.basePrice || p.price || '';
            // features could be object or string array
            let descVal = '';
            if (typeof p.features === 'object' && p.features) {
                descVal = Array.isArray(p.features) ? p.features.join(', ') : Object.entries(p.features).map(([k,v])=>`${k}: ${v}`).join(', ');
            } else if (p.features) {
                descVal = String(p.features);
            }
            document.getElementById('plan_description').value = descVal;
            document.getElementById('plan_max_users').value = p.maxKk || p.maxUsers || '';
            document.getElementById('plan_duration_months').value = p.durationMonths || 1;
        } else {
            document.getElementById('planModalTitle').textContent = 'Tambah Paket Baru';
            document.getElementById('plan_id').value = '';
            document.getElementById('plan_name').value = '';
            document.getElementById('plan_price').value = '';
            document.getElementById('plan_description').value = '';
            document.getElementById('plan_max_users').value = '';
            document.getElementById('plan_duration_months').value = '1';
        }
        modal.classList.add('open');
    }
    function closePlanModal() { document.getElementById('planModal').classList.remove('open'); }

    document.getElementById('planModal').addEventListener('click', e => { if (e.target === e.currentTarget) closePlanModal(); });

    async function savePlan() {
        const id = document.getElementById('plan_id').value;
        const durMonths = parseInt(document.getElementById('plan_duration_months').value) || 1;
        const durUnit = durMonths >= 12 ? 'YEARLY' : 'MONTHLY';
        const descRaw = document.getElementById('plan_description').value.trim();
        const featuresArr = descRaw ? descRaw.split(',').map(f => f.trim()).filter(f => f !== '') : [];
        const payload = {
            name: document.getElementById('plan_name').value.trim(),
            price: parseFloat(document.getElementById('plan_price').value) || 0,
            basePrice: parseFloat(document.getElementById('plan_price').value) || 0,
            features: featuresArr,
            maxUsers: parseInt(document.getElementById('plan_max_users').value) || 0,
            maxKk: parseInt(document.getElementById('plan_max_users').value) || 0,
            durationMonths: durMonths,
            durationUnit: durUnit
        };
        if (!payload.name) { showAlert('Peringatan', 'Nama paket tidak boleh kosong.', 'warning'); return; }

        const url = id ? `${API_URL}/saas/plans/${id}` : `${API_URL}/saas/plans`;
        try {
            const res = await fetch(url, {
                method: id ? 'PUT' : 'POST',
                headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${getFirebaseToken()}` },
                body: JSON.stringify(payload)
            });
            const r = await res.json();
            if (r.success) { closePlanModal(); loadPlans(); showToast('Berhasil', 'Paket berhasil disimpan.'); }
            else showAlert('Gagal', r.message, 'error');
        } catch(e) { showAlert('Kesalahan', 'Kesalahan jaringan.', 'error'); }
    }

    async function deletePlan(id) {
        const result = await Swal.fire({
            title: 'Hapus Paket?',
            text: 'Desa yang sudah berlangganan tidak akan terpengaruh.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus'
        });
        if (!result.isConfirmed) return;

        try {
            const res = await fetch(`${API_URL}/saas/plans/${id}`, {
                method: 'DELETE',
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success) { loadPlans(); showToast('Dihapus', 'Paket berhasil dihapus.'); }
            else showAlert('Gagal', 'Gagal menghapus: ' + r.message, 'error');
        } catch(e) { showAlert('Kesalahan', 'Kesalahan jaringan.', 'error'); }
    }

    // ===== TAB 2: SUBSCRIPTIONS =====
    async function loadVillagesData() {
        try {
            const res = await fetch(`${API_URL}/superadmin/villages`, {
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success) { villagesData = r.data; return r.data; }
            return [];
        } catch(e) { return []; }
    }

    async function loadSubscriptions() {
        if (!plansData.length) await loadPlans();
        const villages = await loadVillagesData();
        const tbody = document.getElementById('subs-tbody');
        let activeCount = 0;
        document.getElementById('badge-subs').textContent = villages.length;

        if (!villages.length) {
            tbody.innerHTML = `<tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-city"></i><p>Tidak ada data desa.</p></div></td></tr>`;
            return;
        }

        let planOpts = `<option value="">-- Pilih Paket --</option>` + plansData.map(p => {
            const durText = p.durationMonths && p.durationMonths >= 12 ? `${p.durationMonths/12} Thn` : `${p.durationMonths||1} Bln`;
            return `<option value="${p.id}">${p.name} (${durText}) — Rp ${parseInt(p.basePrice||p.price||0).toLocaleString('id-ID')}</option>`;
        }).join('');

        tbody.innerHTML = villages.map(v => {
            const sub = v.subscriptions && v.subscriptions.length > 0 ? v.subscriptions[0] : null;
            let badge = `<span class="status-badge badge-inactive"><i class="fa-solid fa-circle" style="font-size:0.5rem;"></i> Tidak Aktif</span>`;
            let planName = '<em style="color:#9ca3af;">—</em>';
            let expiry = '—';
            if (sub) {
                const isExpired = sub.endDate && new Date(sub.endDate) < new Date();
                if (sub.status === 'ACTIVE') {
                    if (isExpired) {
                        badge = `<span class="status-badge" style="background:#fee2e2;color:#ef4444;"><i class="fa-solid fa-circle-exclamation" style="font-size:0.5rem;"></i> Expired</span>`;
                    } else {
                        badge = `<span class="status-badge badge-active"><i class="fa-solid fa-circle" style="font-size:0.5rem;"></i> Aktif</span>`; activeCount++;
                    }
                }
                else if (sub.status === 'PENDING') badge = `<span class="status-badge badge-pending"><i class="fa-solid fa-clock" style="font-size:0.5rem;"></i> Pending</span>`;
                else if (sub.status === 'SUSPENDED') badge = `<span class="status-badge" style="background:#fee2e2;color:#ef4444;"><i class="fa-solid fa-ban" style="font-size:0.5rem;"></i> Suspended</span>`;
                
                if (sub.plan) {
                    const durText = sub.plan.durationMonths && sub.plan.durationMonths >= 12 ? `${sub.plan.durationMonths/12} Thn` : `${sub.plan.durationMonths||1} Bln`;
                    planName = `<strong>${sub.plan.name}</strong> <small style="color:#6b7280;font-weight:600;">(${durText})</small>`;
                }
                if (sub.endDate) expiry = new Date(sub.endDate).toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
            }
            const subDataStr = sub ? encodeURIComponent(JSON.stringify(sub)) : '';
            return `<tr>
                <td><strong>${v.name}</strong><br><small style="color:#9ca3af;font-family:monospace;">${v.id}</small></td>
                <td>${planName}</td>
                <td>${badge}</td>
                <td style="font-size:0.8rem;">${expiry}</td>
                <td>
                    <button class="btn-icon edit" onclick="openSubModal('${v.id}', '${v.name.replace(/'/g, "\\'")}', '${subDataStr}')" title="Edit Langganan"><i class="fa-solid fa-pen"></i> Edit</button>
                </td>
            </tr>`;
        }).join('');

        // Pre-select existing plan
        villages.forEach(v => {
            const sub = v.subscriptions && v.subscriptions.length > 0 ? v.subscriptions[0] : null;
            if (sub && sub.planId) {
                const el = document.getElementById(`sel_${v.id}`);
                if (el) el.value = sub.planId;
            }
        });

        document.getElementById('stat-active').textContent = activeCount;
    }

    function openSubModal(villageId, villageName, subDataStr) {
        document.getElementById('sub_village_id').value = villageId;
        document.getElementById('sub_village_name').value = villageName;
        
        // Populate Plan dropdown
        const selPlan = document.getElementById('sub_plan_id');
        selPlan.innerHTML = `<option value="">-- Pilih Paket --</option>` + plansData.map(p => `<option value="${p.id}">${p.name}</option>`).join('');
        
        const sub = subDataStr ? JSON.parse(decodeURIComponent(subDataStr)) : null;
        
        if (sub) {
            document.getElementById('sub_plan_id').value = sub.planId || '';
            document.getElementById('sub_status').value = sub.status || 'ACTIVE';
            
            if (sub.endDate) {
                const d = new Date(sub.endDate);
                const tzOffset = d.getTimezoneOffset() * 60000;
                const localISOTime = (new Date(d - tzOffset)).toISOString().slice(0, 16);
                document.getElementById('sub_end_date').value = localISOTime;
            } else {
                document.getElementById('sub_end_date').value = '';
            }
        } else {
            document.getElementById('sub_plan_id').value = '';
            document.getElementById('sub_status').value = 'ACTIVE';
            
            // Default +14 days
            const d = new Date();
            d.setDate(d.getDate() + 14);
            const tzOffset = d.getTimezoneOffset() * 60000;
            const localISOTime = (new Date(d - tzOffset)).toISOString().slice(0, 16);
            document.getElementById('sub_end_date').value = localISOTime;
        }
        
        document.getElementById('subModal').classList.add('open');
    }

    function closeSubModal() { document.getElementById('subModal').classList.remove('open'); }
    document.getElementById('subModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeSubModal(); });

    function addFreeDuration(amount, unit) {
        let currentDate = document.getElementById('sub_end_date').value;
        let d = currentDate ? new Date(currentDate) : new Date();
        
        // Pastikan paket otomatis jadi aktif
        document.getElementById('sub_status').value = 'ACTIVE';
        
        if (unit === 'month') {
            d.setMonth(d.getMonth() + amount);
        } else if (unit === 'year') {
            if (amount === 99) {
                d.setFullYear(2099); // "Selamanya" (sampai tahun 2099)
                d.setMonth(11);
                d.setDate(31);
            } else {
                d.setFullYear(d.getFullYear() + amount);
            }
        }
        
        const tzOffset = d.getTimezoneOffset() * 60000;
        const localISOTime = (new Date(d - tzOffset)).toISOString().slice(0, 16);
        document.getElementById('sub_end_date').value = localISOTime;
    }

    async function saveSub() {
        const villageId = document.getElementById('sub_village_id').value;
        const payload = {
            planId: parseInt(document.getElementById('sub_plan_id').value) || null,
            status: document.getElementById('sub_status').value,
            endDate: document.getElementById('sub_end_date').value
        };
        
        if (!payload.planId) { showAlert('Peringatan', 'Pilih paket terlebih dahulu!', 'warning'); return; }
        
        if (payload.endDate) {
            payload.endDate = new Date(payload.endDate).toISOString();
        }

        try {
            const res = await fetch(`${API_URL}/saas/subscriptions/${villageId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${getFirebaseToken()}` },
                body: JSON.stringify(payload)
            });
            const r = await res.json();
            
            if (r.success) { 
                showToast('Berhasil', `Langganan diperbarui.`); 
                closeSubModal(); 
                loadSubscriptions(); 
            } else {
                showAlert('Gagal', r.message, 'error');
            }
        } catch(e) { showAlert('Kesalahan', 'Kesalahan jaringan.', 'error'); }
    }

    // ===== TAB 3: INVOICES =====
    async function loadInvoices() {
        try {
            const res = await fetch(`${API_URL}/saas/invoices`, {
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            const tbody = document.getElementById('invoices-tbody');
            if (r.success && r.data.length) {
                invoicesData = r.data;
                document.getElementById('badge-inv').textContent = r.data.length;
                document.getElementById('stat-invoices').textContent = r.data.filter(i=>i.status==='PENDING_VERIFICATION').length + ' verif';
                tbody.innerHTML = r.data.map(inv => {
                    let badge = '';
                    if (inv.status === 'PAID') badge = `<span class="status-badge badge-paid"><i class="fa-solid fa-circle-check"></i> LUNAS</span>`;
                    else if (inv.status === 'PENDING_VERIFICATION') badge = `<span class="status-badge badge-pending"><i class="fa-solid fa-clock"></i> VERIFIKASI</span>`;
                    else if (inv.status === 'UNPAID') badge = `<span class="status-badge" style="background:#fee2e2;color:#ef4444;"><i class="fa-solid fa-times"></i> BELUM BAYAR</span>`;
                    else badge = `<span class="status-badge badge-inactive">EXPIRED</span>`;
                    
                    const vName = inv.village ? inv.village.name : '—';
                    const amount = parseInt(inv.totalAmount || 0).toLocaleString('id-ID');
                    const dateObj = new Date(inv.createdAt);
                    const period = `${dateObj.getDate()}/${dateObj.getMonth()+1}/${dateObj.getFullYear()}`;
                    const durText = inv.durationMonths && inv.durationMonths >= 12 ? `${inv.durationMonths/12} Thn` : `${inv.durationMonths||1} Bln`;
                    const planBadge = inv.planName ? `<br><span class="status-badge" style="background:#f3f4f6;color:#4b5563;font-size:0.7rem;margin-top:4px;">${inv.planName} (${durText})</span>` : '';
                    
                    let approveBtn = `<span style="color:#9ca3af;font-size:0.8rem;">—</span>`;
                    if (inv.status === 'PENDING_VERIFICATION') {
                        const proofStr = inv.paymentProof ? encodeURIComponent(inv.paymentProof) : '';
                        approveBtn = `<button class="btn-icon edit" onclick="viewProof('${inv.id}', '${proofStr}')"><i class="fa-solid fa-eye"></i> Cek Bukti</button>`;
                    }
                    
                    const deleteBtn = `<button class="btn-icon del" onclick="deleteInvoiceItem('${inv.id}')" title="Hapus Tagihan"><i class="fa-solid fa-trash"></i></button>`;
                    
                    return `<tr>
                        <td><strong>${vName}</strong>${planBadge}</td>
                        <td style="font-weight:700;color:#4f46e5;">Rp ${amount}</td>
                        <td style="font-size:0.825rem;">${period}</td>
                        <td>${badge}</td>
                        <td style="display:flex; gap:0.4rem;">${approveBtn} ${deleteBtn}</td>
                    </tr>`;
                }).join('');
            } else {
                tbody.innerHTML = `<tr><td colspan="5"><div class="empty-state"><i class="fa-solid fa-file-invoice"></i><p>Tidak ada tagihan ditemukan.</p></div></td></tr>`;
            }
        } catch(e) { console.error(e); }
    }

    function viewProof(id, proofStr) {
        let proof = decodeURIComponent(proofStr);
        if (!proof) {
            showAlert('Peringatan', 'Tidak ada foto bukti pembayaran.', 'info');
            return;
        }
        
        if (!proof.startsWith('http') && !proof.startsWith('data:image')) {
            proof = 'data:image/jpeg;base64,' + proof;
        }
        
        // Buat modal dinamis untuk lihat bukti
        const m = document.createElement('div');
        m.className = 'modal-backdrop open';
        m.innerHTML = `
            <div class="modal-box" style="max-width:400px; text-align:center;">
                <div class="modal-head"><h3>Bukti Pembayaran</h3><button class="modal-close" onclick="this.closest('.modal-backdrop').remove()"><i class="fa-solid fa-xmark"></i></button></div>
                <div class="modal-body">
                    <img src="${proof}" style="max-width:100%; border-radius:8px; margin-bottom:1rem; cursor:zoom-in;" onclick="zoomImage(this.src)" onerror="this.onerror=null; this.src=''; this.alt='Format gambar tidak didukung atau rusak'; this.style.display='none'; const p=document.createElement('p'); p.style.color='red'; p.textContent='Gagal memuat gambar bukti.'; this.parentNode.appendChild(p);" title="Klik untuk memperbesar" />
                </div>
                <div class="modal-foot" style="justify-content:space-between;">
                    <button class="btn-sec" onclick="this.closest('.modal-backdrop').remove()">Tutup</button>
                    <div style="display:flex; gap:0.5rem;">
                        <button class="btn-sec" style="color:var(--danger); border-color:var(--danger);" onclick="rejectInvoice('${id}'); this.closest('.modal-backdrop').remove()"><i class="fa-solid fa-times"></i> Tolak</button>
                        <button class="btn-prim" onclick="approveInvoice('${id}'); this.closest('.modal-backdrop').remove()"><i class="fa-solid fa-check"></i> Approve (Lunas)</button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(m);
    }

    function zoomImage(src) {
        const lb = document.createElement('div');
        lb.style.position = 'fixed';
        lb.style.top = '0';
        lb.style.left = '0';
        lb.style.width = '100vw';
        lb.style.height = '100vh';
        lb.style.backgroundColor = 'rgba(0,0,0,0.9)';
        lb.style.zIndex = '99999';
        lb.style.display = 'flex';
        lb.style.justifyContent = 'center';
        lb.style.alignItems = 'center';
        lb.style.cursor = 'zoom-out';
        lb.innerHTML = '<img src="' + src + '" style="max-width:95%; max-height:95%; object-fit:contain;" />';
        lb.onclick = () => lb.remove();
        document.body.appendChild(lb);
    }

    async function approveInvoice(id) {
        const result = await Swal.fire({
            title: 'Approve Invoice?',
            text: 'Tandai invoice ini sebagai LUNAS?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lunas'
        });
        if (!result.isConfirmed) return;

        try {
            const res = await fetch(`${API_URL}/saas/invoices/${id}/approve`, {
                method: 'POST',
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success) { showToast('Berhasil', 'Invoice ditandai lunas.'); loadInvoices(); loadSubscriptions(); }
            else showAlert('Gagal', r.message, 'error');
        } catch(e) { showAlert('Kesalahan', 'Kesalahan jaringan.', 'error'); }
    }

    async function rejectInvoice(id) {
        const result = await Swal.fire({
            title: 'Tolak Bukti?',
            text: 'Status akan dikembalikan menjadi BELUM BAYAR (UNPAID).',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tolak',
            confirmButtonColor: '#ef4444'
        });
        if (!result.isConfirmed) return;

        try {
            const res = await fetch(`${API_URL}/saas/invoices/${id}/reject`, {
                method: 'POST',
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success) { showToast('Ditolak', 'Bukti pembayaran ditolak.'); loadInvoices(); }
            else showAlert('Gagal', r.message, 'error');
        } catch(e) { showAlert('Kesalahan', 'Kesalahan jaringan.', 'error'); }
    }

    async function deleteInvoiceItem(id) {
        const result = await Swal.fire({
            title: 'Hapus Tagihan?',
            text: 'Apakah Anda yakin ingin menghapus tagihan ini secara permanen? Data yang dihapus tidak dapat dikembalikan.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            confirmButtonColor: '#ef4444'
        });
        if (!result.isConfirmed) return;

        try {
            const res = await fetch(`${API_URL}/saas/invoices/${id}`, {
                method: 'DELETE',
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success) { showToast('Dihapus', 'Tagihan berhasil dihapus.'); loadInvoices(); }
            else showAlert('Gagal', r.message, 'error');
        } catch(e) { showAlert('Kesalahan', 'Kesalahan jaringan.', 'error'); }
    }

    // ===== TAB 4: APK CONFIG =====
    async function loadApkConfig() {
        const villages = await loadVillagesData();
        const tbody = document.getElementById('config-tbody');
        if (!villages.length) {
            tbody.innerHTML = `<tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-city"></i><p>Tidak ada desa.</p></div></td></tr>`;
            return;
        }
        tbody.innerHTML = villages.map(v => {
            const c = v.config || {};
            const chat  = c.feature_chat_enabled !== false;
            const maint = c.maintenance_mode === true;
            const panic = c.panic_button_enabled === true;
            const limit = c.max_users_limit || 0;
            return `<tr>
                <td><strong>${v.name}</strong><br><small style="color:#9ca3af;font-family:monospace;font-size:0.75rem;">${v.id}</small></td>
                <td style="text-align:center;">
                    <label class="sw success"><input type="checkbox" id="chat_${v.id}" ${chat?'checked':''}><span class="sw-slider"></span></label>
                </td>
                <td style="text-align:center;">
                    <label class="sw danger"><input type="checkbox" id="maint_${v.id}" ${maint?'checked':''}><span class="sw-slider"></span></label>
                </td>
                <td style="text-align:center;">
                    <label class="sw warning"><input type="checkbox" id="panic_${v.id}" ${panic?'checked':''}><span class="sw-slider"></span></label>
                </td>
                <td style="text-align:center;">
                    <input type="number" class="inline-num" id="limit_${v.id}" value="${limit}" min="0">
                </td>
                <td style="text-align:center;">
                    <button class="btn-icon ok" onclick="saveConfig('${v.id}')"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </td>
            </tr>`;
        }).join('');
    }

    async function saveConfig(id) {
        const payload = {
            feature_chat_enabled:  document.getElementById(`chat_${id}`).checked,
            maintenance_mode:      document.getElementById(`maint_${id}`).checked,
            panic_button_enabled:  document.getElementById(`panic_${id}`).checked,
            max_users_limit:       parseInt(document.getElementById(`limit_${id}`).value) || 0,
        };
        try {
            const res = await fetch(`${API_URL}/superadmin/villages/${id}/config`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${getFirebaseToken()}` },
                body: JSON.stringify({ config: payload })
            });
            const r = await res.json();
            if (r.success) showToast('Konfigurasi Disimpan', 'APK akan menyesuaikan secara real-time.');
            else showAlert('Gagal', r.message, 'error');
        } catch(e) { showAlert('Kesalahan', 'Kesalahan jaringan.', 'error'); }
    }

    // ===== TAB 5: PENGATURAN SAAS =====
    async function loadSettings() {
        try {
            const res = await fetch(`${API_URL}/saas/settings`, {
                headers: { 'Authorization': `Bearer ${getFirebaseToken()}` }
            });
            const r = await res.json();
            if (r.success && r.data) {
                const bankInfo = r.data.find(s => s.key === 'BANK_ACCOUNT_INFO');
                if (bankInfo) document.getElementById('setting_bank_account').value = bankInfo.value || '';
                
                const taxInfo = r.data.find(s => s.key === 'TAX_PERCENTAGE');
                if (taxInfo) document.getElementById('setting_tax_percentage').value = taxInfo.value || '';
            }
        } catch(e) { console.error('Gagal memuat pengaturan', e); }
    }

    async function saveSaasSettings() {
        const bankAccountInfo = document.getElementById('setting_bank_account').value.trim();
        const taxPercentage = document.getElementById('setting_tax_percentage').value.trim();
        
        try {
            const res = await fetch(`${API_URL}/saas/settings`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${getFirebaseToken()}` },
                body: JSON.stringify({ bankAccountInfo, taxPercentage })
            });
            const r = await res.json();
            if (r.success) showToast('Disimpan', 'Pengaturan SaaS berhasil diperbarui.');
            else showAlert('Gagal', r.message, 'error');
        } catch(e) { showAlert('Kesalahan', 'Kesalahan jaringan.', 'error'); }
    }
</script>
<?= $this->endSection() ?>
