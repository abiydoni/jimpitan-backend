<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    /* ===== WHATSAPP BLASTING - PREMIUM SUITE ===== */
    .blast-wrapper {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Hero Banner */
    .page-hero {
        background: linear-gradient(135deg, #065f46 0%, #059669 40%, #0d9488 75%, #4f46e5 100%);
        border-radius: 1.25rem;
        padding: 2.25rem 2.5rem;
        margin-bottom: 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(5, 150, 105, 0.25);
    }
    .page-hero::before {
        content: '';
        position: absolute;
        top: -80px; right: -40px;
        width: 280px; height: 280px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }
    .page-hero::after {
        content: '';
        position: absolute;
        bottom: -70px; right: 140px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 700px;
    }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.18);
        backdrop-filter: blur(8px);
        padding: 0.35rem 0.85rem;
        border-radius: 2rem;
        font-size: 0.78rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        border: 1px solid rgba(255,255,255,0.25);
    }
    .hero-content h1 {
        margin: 0 0 0.45rem 0;
        font-size: 1.85rem;
        font-weight: 800;
        letter-spacing: -0.02em;
    }
    .hero-content p {
        margin: 0;
        opacity: 0.9;
        font-size: 0.95rem;
        line-height: 1.5;
    }
    .hero-actions {
        display: flex;
        gap: 0.75rem;
        z-index: 1;
        flex-wrap: wrap;
    }

    /* Top Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.75rem;
    }
    .stat-card {
        background: white;
        border-radius: 1rem;
        padding: 1.25rem 1.5rem;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.06);
    }
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .stat-info .stat-val {
        font-size: 1.6rem;
        font-weight: 800;
        line-height: 1.1;
        color: #111827;
    }
    .stat-info .stat-lbl {
        font-size: 0.8rem;
        color: #6b7280;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    /* Navigation Tabs */
    .tab-nav {
        display: flex;
        gap: 0.5rem;
        background: #f1f5f9;
        padding: 0.4rem;
        border-radius: 0.85rem;
        margin-bottom: 1.75rem;
        border: 1px solid #e2e8f0;
        flex-wrap: wrap;
    }
    .tab-btn {
        padding: 0.65rem 1.25rem;
        border: none;
        background: transparent;
        color: #64748b;
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.65rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }
    .tab-btn:hover {
        color: #0f172a;
        background: rgba(255,255,255,0.6);
    }
    .tab-btn.active {
        background: white;
        color: #059669;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    }

    /* Main Grid for Blasting Tab */
    .blast-grid {
        display: grid;
        grid-template-columns: 1.25fr 0.95fr;
        gap: 1.75rem;
        align-items: start;
    }
    @media (max-width: 1024px) {
        .blast-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Cards */
    .panel-card {
        background: white;
        border-radius: 1.15rem;
        border: 1px solid #e5e7eb;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.25rem;
        padding-bottom: 0.85rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .panel-header h3 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .panel-header .header-badge {
        font-size: 0.75rem;
        padding: 0.2rem 0.65rem;
        border-radius: 1rem;
        font-weight: 600;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.15rem;
    }
    .form-label {
        display: block;
        font-size: 0.825rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.4rem;
    }
    .form-control, .form-select {
        width: 100%;
        padding: 0.65rem 0.95rem;
        border: 1.5px solid #d1d5db;
        border-radius: 0.65rem;
        font-family: inherit;
        font-size: 0.875rem;
        color: #1f2937;
        background-color: white;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12);
    }
    textarea.form-control {
        min-height: 160px;
        line-height: 1.5;
        font-family: 'Consolas', 'Menlo', 'Courier New', monospace;
        font-size: 0.875rem;
    }

    /* Variable Tags (Placeholders) */
    .var-tags-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-top: 0.5rem;
        padding: 0.65rem;
        background: #f8fafc;
        border-radius: 0.65rem;
        border: 1px dashed #cbd5e1;
    }
    .var-tag {
        background: white;
        border: 1px solid #cbd5e1;
        color: #047857;
        padding: 0.25rem 0.55rem;
        border-radius: 0.45rem;
        font-size: 0.75rem;
        font-weight: 600;
        font-family: monospace;
        cursor: pointer;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    .var-tag:hover {
        background: #ecfdf5;
        border-color: #059669;
        color: #065f46;
        transform: translateY(-1px);
    }

    /* WhatsApp Phone Mockup Preview */
    .wa-mockup {
        background: #efeae2;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" opacity="0.05"><path d="M20 20 L40 40 M40 20 L20 40" stroke="%23000" stroke-width="2"/></svg>');
        border-radius: 1.25rem;
        overflow: hidden;
        border: 1px solid #d1d5db;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
    }
    .wa-mockup-header {
        background: #075e54;
        color: white;
        padding: 0.85rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .wa-mockup-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #128c7e;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    .wa-mockup-title {
        flex: 1;
    }
    .wa-mockup-name {
        font-weight: 700;
        font-size: 0.9rem;
        line-height: 1.2;
    }
    .wa-mockup-status {
        font-size: 0.72rem;
        opacity: 0.8;
    }
    .wa-mockup-body {
        padding: 1.25rem 1rem;
        min-height: 280px;
        max-height: 480px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .wa-bubble {
        background: #dcf8c6;
        padding: 0.75rem 0.95rem;
        border-radius: 0.75rem 0.75rem 0.2rem 0.75rem;
        max-width: 90%;
        margin-left: auto;
        font-size: 0.85rem;
        line-height: 1.45;
        color: #111827;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        white-space: pre-wrap;
        word-break: break-word;
        position: relative;
    }
    .wa-bubble-time {
        text-align: right;
        font-size: 0.68rem;
        color: #6b7280;
        margin-top: 0.4rem;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.25rem;
    }
    .wa-checkmarks {
        color: #34b7f1;
        font-size: 0.75rem;
    }

    /* Buttons */
    .btn {
        padding: 0.65rem 1.25rem;
        border-radius: 0.65rem;
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
    }
    .btn-emerald {
        background: #059669;
        color: white;
    }
    .btn-emerald:hover {
        background: #047857;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }
    .btn-wa {
        background: #25d366;
        color: white;
        font-weight: 700;
    }
    .btn-wa:hover {
        background: #20bd5a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    }
    .btn-outline {
        background: white;
        border: 1.5px solid #d1d5db;
        color: #374151;
    }
    .btn-outline:hover {
        background: #f9fafb;
        border-color: #9ca3af;
    }
    .btn-danger {
        background: #ef4444;
        color: white;
    }
    .btn-danger:hover {
        background: #dc2626;
    }
    .btn-sm {
        padding: 0.4rem 0.75rem;
        font-size: 0.78rem;
        border-radius: 0.5rem;
    }

    /* Recipient Table */
    .table-container {
        max-height: 380px;
        overflow-y: auto;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.825rem;
        text-align: left;
    }
    .custom-table th {
        background: #f8fafc;
        padding: 0.75rem 1rem;
        font-weight: 600;
        color: #475569;
        border-bottom: 1.5px solid #e2e8f0;
        position: sticky;
        top: 0;
        z-index: 5;
    }
    .custom-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
    }
    .custom-table tr:hover {
        background: #f8fafc;
    }
    .custom-table.table-compact th {
        padding: 0.35rem 0.55rem;
        font-size: 0.78rem;
        background: #f1f5f9;
        border-bottom: 1px solid #cbd5e1;
    }
    .custom-table.table-compact td {
        padding: 0.22rem 0.55rem;
        font-size: 0.8rem;
        line-height: 1.25;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }
    .custom-table.table-compact tr {
        height: 28px;
    }
    .custom-table.table-compact .btn-sm {
        padding: 0.15rem 0.45rem;
        font-size: 0.72rem;
        border-radius: 0.35rem;
    }
    .custom-table.table-compact .badge-wa-ok,
    .custom-table.table-compact .badge-wa-missing {
        padding: 0.1rem 0.45rem;
        font-size: 0.72rem;
    }

    /* Status Badges */
    .badge-wa-ok {
        background: #d1fae5;
        color: #065f46;
        padding: 0.2rem 0.55rem;
        border-radius: 1rem;
        font-weight: 600;
        font-size: 0.72rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    .badge-wa-missing {
        background: #fee2e2;
        color: #991b1b;
        padding: 0.2rem 0.55rem;
        border-radius: 1rem;
        font-weight: 600;
        font-size: 0.72rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Progress Modal */
    .progress-bar-wrap {
        width: 100%;
        height: 12px;
        background: #e2e8f0;
        border-radius: 1rem;
        overflow: hidden;
        margin: 1rem 0;
    }
    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #059669);
        width: 0%;
        transition: width 0.3s ease;
    }
    .blast-log-box {
        background: #0f172a;
        color: #f8fafc;
        font-family: 'Consolas', monospace;
        font-size: 0.78rem;
        padding: 1rem;
        border-radius: 0.65rem;
        max-height: 220px;
        overflow-y: auto;
        text-align: left;
        line-height: 1.6;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="blast-wrapper">

    <!-- Hero Header -->
    <div class="page-hero">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fa-brands fa-whatsapp"></i> Modul WhatsApp Blasting Backend (Tanpa Ubah APK)
            </div>
            <h1>Blasting WhatsApp Kepala Keluarga (KK)</h1>
            <p>Kirim undangan rapat rutin RT/RW, kerja bakti, pengumuman warga, dan tagihan iuran secara otomatis ke nomor WhatsApp seluruh Kepala Keluarga dengan satu klik.</p>
        </div>
        <div class="hero-actions">
            <button class="btn btn-outline" onclick="openTestModal()" style="background: rgba(255,255,255,0.15); color:white; border-color: rgba(255,255,255,0.3);">
                <i class="fa-solid fa-paper-plane"></i> Test Kirim WA
            </button>
            <button class="btn btn-outline" onclick="switchTab('settings')" style="background: rgba(255,255,255,0.15); color:white; border-color: rgba(255,255,255,0.3);">
                <i class="fa-solid fa-gears"></i> Pengaturan Gateway
            </button>
            <button class="btn btn-emerald" onclick="loadAllData()" style="background: white; color: #065f46; font-weight:700;">
                <i class="fa-solid fa-rotate"></i> Refresh
            </button>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background:#ecfdf5; color:#059669;">
                <i class="fa-solid fa-people-roof"></i>
            </div>
            <div class="stat-info">
                <div class="stat-val" id="stat-total-kk">0</div>
                <div class="stat-lbl" id="stat-total-label">Kepala Keluarga (KK)</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7; color:#16a34a;">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
            <div class="stat-info">
                <div class="stat-val" id="stat-ready-wa">0</div>
                <div class="stat-lbl" id="stat-ready-label">No. WhatsApp Valid</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef2f2; color:#dc2626;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="stat-info">
                <div class="stat-val" id="stat-missing-wa">0</div>
                <div class="stat-lbl" id="stat-missing-label">Belum Ada No. WA</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#e0e7ff; color:#4f46e5;">
                <i class="fa-solid fa-server"></i>
            </div>
            <div class="stat-info">
                <div class="stat-val" id="stat-provider-name" style="font-size:1.15rem; text-transform:uppercase;">APPSBEE</div>
                <div class="stat-lbl" id="stat-provider-status">Gateway Aktif</div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="tab-nav">
        <button class="tab-btn active" id="tab-btn-blast" onclick="switchTab('blast')">
            <i class="fa-solid fa-bullhorn"></i> Kirim Blasting KK
        </button>
        <button class="tab-btn" id="tab-btn-templates" onclick="switchTab('templates')">
            <i class="fa-solid fa-file-lines"></i> Template Undangan
        </button>
        <button class="tab-btn" id="tab-btn-settings" onclick="switchTab('settings')">
            <i class="fa-solid fa-sliders"></i> Pengaturan Gateway WA
        </button>
        <button class="tab-btn" id="tab-btn-history" onclick="switchTab('history')">
            <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Pengiriman
        </button>
    </div>

    <!-- TAB 1: KIRIM BLASTING -->
    <div id="tab-content-blast">
        <div class="blast-grid">
            
            <!-- Left Side: Form Editor -->
            <div>
                <!-- Parameter Acara & Target -->
                <div class="panel-card">
                    <div class="panel-header">
                        <h3><i class="fa-solid fa-sliders" style="color:#059669;"></i> 1. Target & Parameter Acara</h3>
                        <span class="header-badge" style="background:#ecfdf5; color:#065f46;">Wajib</span>
                    </div>

                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label"><i class="fa-solid fa-map-location-dot"></i> Filter Wilayah / Desa</label>
                            <select id="filter-village" class="form-select" onchange="loadRecipients()">
                                <option value="ALL">Semua Desa / Wilayah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fa-solid fa-users-rays"></i> Target Penerima Pesan</label>
                            <select id="target-recipient-type" class="form-select" onchange="loadRecipients()" style="font-weight:600; color:#065f46; background-color:#f0fdf4; border-color:#86efac;">
                                <option value="KK" selected>👥 Hanya Kepala Keluarga (KK Saja - 62 KK)</option>
                                <option value="WARGA">👨‍👩‍👧‍👦 Seluruh Warga (Semua Anggota Keluarga)</option>
                            </select>
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label"><i class="fa-solid fa-wand-magic-sparkles"></i> Pilih Template Undangan</label>
                            <select id="select-template-fast" class="form-select" onchange="applyTemplateFast()">
                                <option value="">-- Pilih Format Template Cepat --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fa-solid fa-heading"></i> Judul / Nama Acara (Agenda)</label>
                            <input type="text" id="event-title" class="form-control" placeholder="Contoh: Rapat Koordinasi Warga RT 02 / Kerja Bakti Bulanan" value="Rapat Koordinasi Rutin Warga" oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns: 1.25fr 0.75fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label"><i class="fa-solid fa-calendar-day"></i> Hari & Tanggal Pelaksanaan (Pilih Kalender)</label>
                            <div style="display:flex; gap:0.5rem; align-items:center;">
                                <input type="date" id="event-date-picker" class="form-control" style="max-width:155px; font-weight:600; cursor:pointer;" onchange="onDatePickerChange()">
                                <input type="text" id="event-date" class="form-control" style="background:#f8fafc; font-weight:700; color:#0f172a; border-color:#cbd5e1;" readonly placeholder="Hari, DD Bulan YYYY">
                            </div>
                            <div style="font-size:0.75rem; color:#059669; margin-top:0.3rem;">
                                <i class="fa-solid fa-circle-check"></i> Default otomatis tanggal 9 setiap bulan, nama hari akurat dari kalender.
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fa-solid fa-clock"></i> Waktu / Jam</label>
                            <input type="text" id="event-time" class="form-control" placeholder="Contoh: 19:00 WIB" value="19:00 WIB" oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label"><i class="fa-solid fa-location-dot"></i> Tempat / Lokasi Pertemuan</label>
                            <input type="text" id="event-location" class="form-control" placeholder="Contoh: Balai Warga RT 02 / Rumah Bpk. Ketua RT" oninput="updateLivePreview()">
                        </div>
                        <div class="form-group">
                            <label class="form-label"><i class="fa-solid fa-link"></i> Link Lokasi Maps / Dokumen (Opsional)</label>
                            <input type="text" id="event-link" class="form-control" placeholder="https://maps.app.goo.gl/..." oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-comment-dots"></i> Catatan Tambahan / Keterangan</label>
                        <input type="text" id="event-notes" class="form-control" placeholder="Contoh: Harap membawa catatan usulan ronda malam & jimpitan" oninput="updateLivePreview()">
                    </div>

                    <div style="display:grid; grid-template-columns: 1fr; gap: 0.85rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e2e8f0;">
                        <div class="form-group" style="margin-bottom:0.5rem;">
                            <label class="form-label"><i class="fa-solid fa-users-rectangle"></i> Kirim Salinan ke Grup WhatsApp RT/Desa (Opsional)</label>
                            <input type="text" id="target-group-wa" class="form-control" placeholder="Contoh: 120363398680818900@g.us atau 6285729705810-1505093181@g.us">
                            <div style="font-size:0.75rem; color:#6b7280; margin-top:0.25rem;">Jika diisi, 1 salinan undangan juga akan dikirimkan langsung ke Grup WhatsApp Warga.</div>
                        </div>
                        <div style="display:flex; align-items:center; gap:0.5rem;">
                            <input type="checkbox" id="copy-to-group-chat" style="width:18px; height:18px; accent-color:#059669; cursor:pointer;" checked>
                            <label for="copy-to-group-chat" style="font-size:0.85rem; font-weight:600; color:#374151; cursor:pointer;">
                                Posting juga salinan undangan ini ke Chat Grup Warga di Aplikasi Jimpitan
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Template Pesan Editor -->
                <div class="panel-card">
                    <div class="panel-header">
                        <h3><i class="fa-solid fa-file-pen" style="color:#059669;"></i> 2. Desain Isi Pesan WhatsApp</h3>
                        <span style="font-size:0.75rem; color:#6b7280;">Mendukung format *tebal*, _miring_, dan enter</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Teks Pesan (Gunakan variabel dinamis agar otomatis mengisi data per KK):</label>
                        <textarea id="message-template" class="form-control" oninput="updateLivePreview()"></textarea>
                    </div>

                    <div>
                        <span style="font-size:0.78rem; font-weight:600; color:#4b5563;">Klik tag di bawah ini untuk menyisipkan otomatis ke teks:</span>
                        <div class="var-tags-wrap">
                            <span class="var-tag" onclick="insertTag('{nama}')"><i class="fa-solid fa-plus"></i> {nama} (Nama KK)</span>
                            <span class="var-tag" onclick="insertTag('{no_kk}')"><i class="fa-solid fa-plus"></i> {no_kk} (Nomor KK)</span>
                            <span class="var-tag" onclick="insertTag('{desa}')"><i class="fa-solid fa-plus"></i> {desa} (Nama Desa/RT)</span>
                            <span class="var-tag" onclick="insertTag('{alamat}')"><i class="fa-solid fa-plus"></i> {alamat} (Alamat)</span>
                            <span class="var-tag" onclick="insertTag('{acara}')"><i class="fa-solid fa-plus"></i> {acara} (Nama Acara)</span>
                            <span class="var-tag" onclick="insertTag('{tanggal}')"><i class="fa-solid fa-plus"></i> {tanggal}</span>
                            <span class="var-tag" onclick="insertTag('{jam}')"><i class="fa-solid fa-plus"></i> {jam}</span>
                            <span class="var-tag" onclick="insertTag('{tempat}')"><i class="fa-solid fa-plus"></i> {tempat}</span>
                            <span class="var-tag" onclick="insertTag('{catatan}')"><i class="fa-solid fa-plus"></i> {catatan}</span>
                            <span class="var-tag" onclick="insertTag('{link}')"><i class="fa-solid fa-plus"></i> {link}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Button Card -->
                <div class="panel-card" style="background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%); border-color: #a7f3d0;">
                    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
                        <div>
                            <div style="font-weight:700; font-size:1rem; color:#065f46;">Siap Melakukan Pengiriman?</div>
                            <div style="font-size:0.825rem; color:#047857; margin-top:0.2rem;">
                                Pesan akan dikirim berurutan dengan jeda aman anti-banned ke <strong id="selected-count-label">0 KK</strong>.
                            </div>
                        </div>
                        <div style="display:flex; gap:0.75rem;">
                            <button class="btn btn-wa" style="font-size:0.95rem; padding:0.75rem 1.5rem;" onclick="startWhatsAppBlast()">
                                <i class="fa-solid fa-rocket"></i> Mulai Blasting Otomatis
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Side: Live WhatsApp Preview & Recipient Checklist -->
            <div>
                <!-- Mockup Preview -->
                <div class="panel-card" style="padding: 1rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.75rem; padding: 0 0.5rem;">
                        <h4 style="margin:0; font-size:0.95rem; font-weight:700; color:#374151;">
                            <i class="fa-brands fa-whatsapp" style="color:#25d366;"></i> Live Realtime WhatsApp Preview
                        </h4>
                        <span style="font-size:0.75rem; color:#6b7280;">Preview rendering di HP warga</span>
                    </div>

                    <div class="wa-mockup">
                        <div class="wa-mockup-header">
                            <div class="wa-mockup-avatar"><i class="fa-solid fa-user"></i></div>
                            <div class="wa-mockup-title">
                                <div class="wa-mockup-name" id="preview-target-name">Bpk. Ahmad Fauzi (Contoh KK)</div>
                                <div class="wa-mockup-status">online</div>
                            </div>
                            <div><i class="fa-solid fa-ellipsis-vertical"></i></div>
                        </div>
                        <div class="wa-mockup-body">
                            <div class="wa-bubble">
                                <div id="live-bubble-text">Memuat pratinjau pesan...</div>
                                <div class="wa-bubble-time">
                                    <span id="preview-time-now">19:30</span>
                                    <span class="wa-checkmarks"><i class="fa-solid fa-check-double"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Penerima KK Checklist Table -->
                <div class="panel-card">
                    <div class="panel-header">
                        <div>
                            <h3><i class="fa-solid fa-users-viewfinder" style="color:#059669;"></i> 3. Seleksi Penerima KK</h3>
                            <div style="font-size:0.78rem; color:#6b7280; margin-top:0.2rem;">
                                Centang KK yang ingin dikirimi undangan.
                            </div>
                        </div>
                        <div style="display:flex; gap:0.5rem;">
                            <button class="btn btn-outline btn-sm" onclick="selectAllValid(true)">
                                <i class="fa-solid fa-check"></i> Pilih Semua WA
                            </button>
                            <button class="btn btn-outline btn-sm" onclick="selectAllValid(false)">
                                <i class="fa-solid fa-xmark"></i> Batal
                            </button>
                        </div>
                    </div>

                    <div style="margin-bottom:0.75rem;">
                        <input type="text" id="search-recipient" class="form-control" placeholder="Cari nama Kepala Keluarga / No. KK..." oninput="filterRecipientTable()">
                    </div>

                    <div class="table-container">
                        <table class="custom-table table-compact">
                            <thead>
                                <tr>
                                    <th style="width:36px; text-align:center;">
                                        <input type="checkbox" id="check-all-box" onchange="toggleCheckAll(this.checked)" checked>
                                    </th>
                                    <th>Kepala Keluarga</th>
                                    <th>Nomor WhatsApp</th>
                                    <th style="text-align:right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="recipients-tbody">
                                <tr><td colspan="4" style="text-align:center; padding:2rem; color:#9ca3af;">Memuat data KK...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- TAB 2: TEMPLATE UNDANGAN -->
    <div id="tab-content-templates" style="display:none;">
        <div class="panel-card">
            <div class="panel-header">
                <div>
                    <h3><i class="fa-solid fa-layer-group" style="color:#059669;"></i> Kelola Template Pesan & Undangan</h3>
                    <div style="font-size:0.8rem; color:#6b7280; margin-top:0.2rem;">
                        Simpan template favorit untuk digunakan kembali secara cepat saat mengirim undangan rutin.
                    </div>
                </div>
                <button class="btn btn-emerald btn-sm" onclick="openAddTemplateModal()">
                    <i class="fa-solid fa-plus"></i> Tambah Template Baru
                </button>
            </div>

            <div id="templates-list-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap:1.25rem;">
                <!-- Diisi via JS -->
            </div>
        </div>
    </div>

    <!-- TAB 3: PENGATURAN WA GATEWAY -->
    <div id="tab-content-settings" style="display:none;">
        <div style="display:grid; grid-template-columns: 1.2fr 0.8fr; gap:1.75rem;">
            
            <div class="panel-card">
                <div class="panel-header">
                    <h3><i class="fa-solid fa-gear" style="color:#059669;"></i> Konfigurasi Gateway WhatsApp</h3>
                    <span class="header-badge" style="background:#e0e7ff; color:#3730a3;">Multi-Provider Support</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Provider Gateway WhatsApp</label>
                    <select id="cfg-provider" class="form-select" onchange="onProviderChange()">
                        <option value="appsbee" selected>Appsbee WA (Gateway Utama - wa-ab.appsbee.my.id)</option>
                        <option value="fonnte">Fonnte (Rekomendasi Eksternal)</option>
                        <option value="wablas">Wablas (API WhatsApp Indonesia)</option>
                        <option value="starsender">Starsender (WhatsApp API)</option>
                        <option value="whacenter">Whacenter (Multi Device API)</option>
                        <option value="generic">Custom REST API / Generic Webhook</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">API Key / Token Rahasia <span style="color:#ef4444;">*</span></label>
                    <input type="password" id="cfg-api-key" class="form-control" placeholder="Masukkan Token API WhatsApp Gateway...">
                    <div style="font-size:0.75rem; color:#6b7280; margin-top:0.3rem;">Token API diperoleh dari server gateway WhatsApp Anda (default: Appsbee WA).</div>
                </div>

                <div class="form-group">
                    <label class="form-label">API Endpoint URL (Opsional / Default)</label>
                    <input type="text" id="cfg-api-url" class="form-control" placeholder="https://wa-ab.appsbee.my.id/api/send-message">
                    <div style="font-size:0.75rem; color:#6b7280; margin-top:0.3rem;">Biarkan sesuai default kecuali jika Anda menggunakan custom server domain sendiri.</div>
                </div>

                <div class="form-group" id="group-cfg-sender">
                    <label class="form-label" id="lbl-sender-number">Session ID WhatsApp (Default: appsbee)</label>
                    <input type="text" id="cfg-sender-number" class="form-control" placeholder="appsbee">
                </div>

                <div class="form-group">
                    <label class="form-label">Jeda / Delay Antar Pengiriman Pesan (Detik)</label>
                    <input type="number" id="cfg-delay" class="form-control" min="1" max="10" value="2">
                    <div style="font-size:0.75rem; color:#6b7280; margin-top:0.3rem;">Rekomendasi 2-3 detik agar terhindar dari pemblokiran atau anti-spam WhatsApp.</div>
                </div>

                <div style="margin-top:1.5rem; display:flex; gap:0.75rem;">
                    <button class="btn btn-emerald" onclick="saveSettings()">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan
                    </button>
                    <button class="btn btn-outline" onclick="openTestModal()">
                        <i class="fa-solid fa-paper-plane"></i> Uji Coba Kirim Pesan
                    </button>
                </div>
            </div>

            <!-- Petunjuk & Panduan Singkat -->
            <div class="panel-card" style="background:#f8fafc;">
                <div class="panel-header">
                    <h3><i class="fa-solid fa-circle-info" style="color:#0284c7;"></i> Panduan Provider WhatsApp</h3>
                </div>
                <div style="font-size:0.85rem; line-height:1.6; color:#334155;">
                    <p><strong>1. Fonnte (Sangat Direkomendasikan):</strong><br>
                    - Daftar gratis / berbayar di <a href="https://fonnte.com" target="_blank" style="color:#059669; font-weight:600;">fonnte.com</a><br>
                    - Sambungkan nomor WhatsApp Admin via Scan QR.<br>
                    - Buka menu <em>API & Devices</em>, salin Token API ke form ini.<br>
                    - URL Default: <code>https://api.fonnte.com/send</code></p>

                    <p><strong>2. Opsi Kirim Tanpa Gateway (Gratis 100%):</strong><br>
                    - Jika Anda belum berlangganan gateway, Anda tetap bisa menggunakan fitur <strong>Direct Chat / WA Web</strong> di tabel daftar KK untuk mengirimkan pesan satu per satu secara langsung dari WhatsApp Web tanpa biaya sepeser pun!</p>

                    <p><strong>3. Keamanan Nomor Pengirim:</strong><br>
                    - Gunakan nomor resmi RT/RW atau pengurus.<br>
                    - Jaga delay minimal 2 detik saat mengirim ke lebih dari 50 warga sekaligus.</p>
                </div>
            </div>

        </div>
    </div>

    <!-- TAB 4: RIWAYAT BLASTING -->
    <div id="tab-content-history" style="display:none;">
        <div class="panel-card">
            <div class="panel-header">
                <div>
                    <h3><i class="fa-solid fa-clock-rotate-left" style="color:#059669;"></i> Riwayat Blasting yang Pernah Dikirim</h3>
                    <div style="font-size:0.8rem; color:#6b7280; margin-top:0.2rem;">Catatan log pengiriman undangan dan pengumuman warga</div>
                </div>
                <button class="btn btn-outline btn-sm" onclick="loadHistory()">
                    <i class="fa-solid fa-rotate"></i> Muat Ulang Riwayat
                </button>
            </div>

            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Waktu & Tanggal</th>
                            <th>Judul Acara / Agenda</th>
                            <th>Target Desa</th>
                            <th>Total KK</th>
                            <th>Sukses</th>
                            <th>Gagal</th>
                            <th>Pengirim</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="history-tbody">
                        <tr><td colspan="8" style="text-align:center; padding:2rem; color:#9ca3af;">Memuat riwayat...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- MODAL: UJI COBA KIRIM WA -->
<div id="testModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:1rem; width:90%; max-width:480px; padding:1.75rem; box-shadow:0 20px 25px -5px rgba(0,0,0,0.2);">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem;">
            <h3 style="margin:0; font-size:1.1rem; font-weight:700;"><i class="fa-solid fa-paper-plane" style="color:#059669;"></i> Uji Coba WhatsApp Gateway</h3>
            <button onclick="closeTestModal()" style="background:none; border:none; font-size:1.2rem; cursor:pointer; color:#9ca3af;">&times;</button>
        </div>
        <div class="form-group">
            <label class="form-label">Nomor WhatsApp Penguji (Nomor HP Anda)</label>
            <input type="text" id="test-phone" class="form-control" placeholder="Contoh: 081234567890 atau 62812...">
        </div>
        <div class="form-group">
            <label class="form-label">Pesan Uji Coba</label>
            <textarea id="test-message" class="form-control" style="min-height:90px;">Halo! Ini adalah pesan uji coba integrasi WhatsApp Blasting dari Aplikasi Jimpitan. Gateway WhatsApp berhasil terhubung!</textarea>
        </div>
        <div style="display:flex; justify-content:flex-end; gap:0.75rem; margin-top:1.5rem;">
            <button class="btn btn-outline" onclick="closeTestModal()">Tutup</button>
            <button class="btn btn-emerald" id="btn-do-test" onclick="executeTestSend()">
                <i class="fa-solid fa-paper-plane"></i> Kirim Pesan Uji Coba
            </button>
        </div>
    </div>
</div>

<!-- MODAL: PROGRESS BLASTING LIVE -->
<div id="blastModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); backdrop-filter:blur(4px); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:1.25rem; width:92%; max-width:620px; padding:2rem; box-shadow:0 25px 50px -12px rgba(0,0,0,0.25); text-align:center;">
        <div style="width:64px; height:64px; border-radius:50%; background:#ecfdf5; color:#059669; display:flex; align-items:center; justify-content:center; font-size:2rem; margin:0 auto 1rem;">
            <i class="fa-brands fa-whatsapp fa-bounce"></i>
        </div>
        <h3 style="margin:0 0 0.5rem; font-size:1.25rem; font-weight:800;" id="blast-modal-title">Proses Pengiriman Blasting WA...</h3>
        <p style="margin:0; font-size:0.85rem; color:#64748b;" id="blast-modal-desc">Mohon tunggu, server sedang mengirim pesan satu per satu dengan jeda aman anti-spam.</p>

        <div class="progress-bar-wrap">
            <div class="progress-bar-fill" id="blast-progress-bar"></div>
        </div>
        <div style="display:flex; justify-content:space-between; font-size:0.8rem; font-weight:700; color:#374151; margin-bottom:1rem;">
            <span id="blast-progress-text">0% Selesai</span>
            <span id="blast-count-text">0 / 0 KK</span>
        </div>

        <div class="blast-log-box" id="blast-live-logs">
            [Sistem] Menyiapkan daftar antrean Kepala Keluarga...<br>
        </div>

        <div style="margin-top:1.5rem; display:flex; justify-content:center; gap:0.75rem;" id="blast-modal-action-box">
            <button class="btn btn-outline" id="btn-cancel-blast" onclick="cancelWhatsAppBlast()" style="color:#ef4444; border-color:#fca5a5;">
                <i class="fa-solid fa-stop"></i> Hentikan Proses
            </button>
            <button class="btn btn-emerald" id="btn-close-blast-modal" onclick="closeBlastModal()" style="display:none;">
                <i class="fa-solid fa-check"></i> Selesai & Tutup Jendela
            </button>
        </div>
    </div>
</div>

<!-- MODAL: DETAIL RIWAYAT -->
<div id="historyDetailModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:1rem; width:90%; max-width:680px; padding:1.75rem; box-shadow:0 20px 25px -5px rgba(0,0,0,0.2);">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <h3 style="margin:0; font-size:1.15rem; font-weight:700;" id="detail-modal-title">Detail Riwayat Pengiriman</h3>
            <button onclick="closeHistoryDetailModal()" style="background:none; border:none; font-size:1.2rem; cursor:pointer; color:#9ca3af;">&times;</button>
        </div>
        <div style="margin-bottom:1rem; font-size:0.85rem; color:#475569;" id="detail-modal-meta"></div>
        <div class="table-container" style="max-height:320px;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nama KK</th>
                        <th>No. WA</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody id="detail-history-tbody"></tbody>
            </table>
        </div>
        <div style="display:flex; justify-content:flex-end; margin-top:1.25rem;">
            <button class="btn btn-outline" onclick="closeHistoryDetailModal()">Tutup</button>
        </div>
    </div>
</div>

<script>
    // ===== STATE & DATA =====
    const WA_BASE_URL = '<?= rtrim(base_url('wa_blast'), '/') ?>';
    let allRecipients = [];
    let allVillages = [];
    let savedTemplates = [];
    let activeConfig = {};
    let isBlastingActive = false;

    // Inisialisasi saat halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', async () => {
        // Atur tanggal kalender default ke tanggal 9 (rutinitas warga setiap tanggal 9)
        const today = new Date();
        let targetYear = today.getFullYear();
        let targetMonth = today.getMonth();

        // Jika hari ini sudah melewati tanggal 9, jadwalkan ke tanggal 9 bulan berikutnya
        if (today.getDate() > 9) {
            targetMonth += 1;
            if (targetMonth > 11) {
                targetMonth = 0;
                targetYear += 1;
            }
        }

        const yyyy = targetYear;
        const mm = String(targetMonth + 1).padStart(2, '0');
        const dd = '09';
        const datePicker = document.getElementById('event-date-picker');
        if (datePicker) {
            datePicker.value = `${yyyy}-${mm}-${dd}`;
            onDatePickerChange();
        }

        document.getElementById('event-time').value = '19:00 WIB';
        document.getElementById('event-location').value = 'Balai Pertemuan Warga';

        await loadAllData();
    });

    // Hitung hari & tanggal otomatis dari kalender (Senin - Minggu akurat)
    function onDatePickerChange() {
        const picker = document.getElementById('event-date-picker');
        if (!picker || !picker.value) return;

        const parts = picker.value.split('-');
        if (parts.length !== 3) return;

        const dateObj = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        const dayName = days[dateObj.getDay()];
        const dayNum = dateObj.getDate();
        const monthName = months[dateObj.getMonth()];
        const yearNum = dateObj.getFullYear();

        const formatted = `${dayName}, ${dayNum} ${monthName} ${yearNum}`;
        document.getElementById('event-date').value = formatted;
        updateLivePreview();
    }

    // Tab switcher
    function switchTab(tabId) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById(`tab-btn-${tabId}`).classList.add('active');

        document.getElementById('tab-content-blast').style.display     = (tabId === 'blast') ? 'block' : 'none';
        document.getElementById('tab-content-templates').style.display = (tabId === 'templates') ? 'block' : 'none';
        document.getElementById('tab-content-settings').style.display  = (tabId === 'settings') ? 'block' : 'none';
        document.getElementById('tab-content-history').style.display   = (tabId === 'history') ? 'block' : 'none';

        if (tabId === 'history') {
            loadHistory();
        }
    }

    // Load semua data awal secara berurutan
    async function loadAllData() {
        await loadVillages();
        await Promise.all([
            loadSettings(),
            loadRecipients()
        ]);
        updateLivePreview();
    }

    // Ambil daftar Desa langsung dari database lokal
    async function loadVillages() {
        try {
            const res = await fetch(`${WA_BASE_URL}/villages`);
            const json = await res.json();
            if (json.success && Array.isArray(json.data)) {
                allVillages = json.data;
                const sel = document.getElementById('filter-village');
                sel.innerHTML = '<option value="ALL">Semua Desa / Wilayah</option>';
                allVillages.forEach(v => {
                    const opt = document.createElement('option');
                    opt.value = v.id;
                    opt.textContent = `${v.name} (${v.id})`;
                    sel.appendChild(opt);
                });

                // Pilih desa pertama yang tersedia (misal village_001) agar langsung menampilkan data
                if (allVillages.length > 0) {
                    sel.value = allVillages[0].id;
                }
            }
        } catch (e) {
            console.error('Gagal mengambil daftar desa:', e);
        }
    }

    // Ambil Pengaturan WA & Templates dari database
    async function loadSettings() {
        try {
            const res = await fetch(`${WA_BASE_URL}/settings`);
            const json = await res.json();
            if (json.success && json.data) {
                activeConfig = json.data;
                const provider = activeConfig.provider || 'appsbee';
                document.getElementById('cfg-provider').value = provider;
                document.getElementById('cfg-api-key').value = activeConfig.apiKey || '';
                document.getElementById('cfg-api-url').value = activeConfig.apiUrl || '';
                document.getElementById('cfg-sender-number').value = activeConfig.senderNumber || '';
                document.getElementById('cfg-delay').value = activeConfig.delaySec || 2;

                document.getElementById('stat-provider-name').textContent = provider.toUpperCase();
                document.getElementById('stat-provider-status').textContent = 'Gateway Terhubung';
                document.getElementById('stat-provider-status').style.color = '#16a34a';

                onProviderChange();

                savedTemplates = activeConfig.templates || [];
                renderFastTemplateSelect();
                renderTemplateManager();

                // Pilih template pertama secara default jika kosong atau masih format lama
                const currentText = document.getElementById('message-template').value;
                if (savedTemplates.length > 0 && (!currentText.trim() || currentText.includes('Assalamu') || currentText.includes('────') || currentText.includes('{jam} WIB') || currentText.includes('Silaturahmi'))) {
                    document.getElementById('message-template').value = savedTemplates[0].content;
                    document.getElementById('select-template-fast').value = savedTemplates[0].id;
                }
            }
        } catch (e) {
            console.error('Gagal memuat pengaturan WA:', e);
        }
    }

    // Render Fast Template Dropdown
    function renderFastTemplateSelect() {
        const sel = document.getElementById('select-template-fast');
        sel.innerHTML = '<option value="">-- Pilih Format Template Cepat --</option>';
        savedTemplates.forEach(t => {
            const opt = document.createElement('option');
            opt.value = t.id;
            opt.textContent = `[${t.category}] ${t.title}`;
            sel.appendChild(opt);
        });
    }

    function applyTemplateFast() {
        const tId = document.getElementById('select-template-fast').value;
        const found = savedTemplates.find(t => t.id === tId);
        if (found) {
            document.getElementById('message-template').value = found.content;
            updateLivePreview();
        }
    }

    // Ambil daftar penerima (KK atau Seluruh Warga) langsung dari database lokal
    async function loadRecipients() {
        const villageId = document.getElementById('filter-village').value;
        const targetType = document.getElementById('target-recipient-type')?.value || 'KK';
        const tbody = document.getElementById('recipients-tbody');
        const targetLabel = targetType === 'KK' ? 'Kepala Keluarga' : 'Seluruh Warga';
        tbody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding:2rem; color:#9ca3af;"><i class="fa-solid fa-spinner fa-spin"></i> Memuat data ${targetLabel}...</td></tr>`;

        try {
            const url = `${WA_BASE_URL}/recipients?villageId=${villageId}&targetType=${targetType}`;
            const res = await fetch(url);
            const json = await res.json();

            if (json.success) {
                allRecipients = json.data || [];
                const isKkOnly = targetType === 'KK';

                // Update angka counter di dashboard statistik
                document.getElementById('stat-total-kk').textContent = json.totalTarget || 0;
                const statTotalLabel = document.getElementById('stat-total-label');
                if (statTotalLabel) {
                    statTotalLabel.innerHTML = isKkOnly 
                        ? `Kepala Keluarga (KK) <span style="font-size:0.75rem; color:#64748b;">(Warga: ${json.totalWarga})</span>`
                        : `Seluruh Warga <span style="font-size:0.75rem; color:#64748b;">(KK: ${json.totalKK})</span>`;
                }

                document.getElementById('stat-ready-wa').textContent = json.validWaCount || 0;
                document.getElementById('stat-missing-wa').textContent = json.missingWaCount || 0;

                renderRecipientTable(allRecipients);
                updateLivePreview();
            } else {
                tbody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding:1.5rem; color:#ef4444;">${json.message || 'Gagal memuat data'}</td></tr>`;
            }
        } catch (e) {
            tbody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding:1.5rem; color:#ef4444;">Kesalahan jaringan: ${e.message}</td></tr>`;
        }
    }

    // Render tabel daftar penerima
    function renderRecipientTable(list) {
        const tbody = document.getElementById('recipients-tbody');
        tbody.innerHTML = '';

        if (!list || list.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding:2rem; color:#9ca3af;">Tidak ada data penerima yang cocok dengan filter.</td></tr>';
            updateSelectedCount();
            return;
        }

        list.forEach((r, idx) => {
            const tr = document.createElement('tr');
            const isChecked = r.isValidWa ? 'checked' : '';
            const statusBadge = r.isValidWa 
                ? `<span class="badge-wa-ok"><i class="fa-solid fa-circle-check"></i> ${r.formattedPhone}</span>`
                : `<span class="badge-wa-missing"><i class="fa-solid fa-circle-xmark"></i> ${r.phoneNumber || 'Tidak ada No WA'}</span>`;

            // Action manual: Open WhatsApp Web with personalized text
            const directChatBtn = r.isValidWa
                ? `<button class="btn btn-outline btn-sm" onclick="openDirectWhatsApp('${r.formattedPhone}', '${encodeURIComponent(r.name)}') title="Kirim Pesan Manual via WA Web"><i class="fa-brands fa-whatsapp" style="color:#25d366;"></i> Chat</button>`
                : `<span style="font-size:0.75rem; color:#9ca3af;">-</span>`;

            tr.innerHTML = `
                <td style="text-align:center; width:34px;">
                    <input type="checkbox" class="recipient-checkbox" data-uid="${r.uid}" ${isChecked} onchange="updateSelectedCount()" style="cursor:pointer; vertical-align:middle;">
                </td>
                <td>
                    <span style="font-weight:600; color:#0f172a; font-size:0.815rem;">${escapeHtml(r.name)}</span>
                </td>
                <td style="white-space:nowrap;">${statusBadge}</td>
                <td style="text-align:right; white-space:nowrap;">${directChatBtn}</td>
            `;
            tbody.appendChild(tr);
        });

        updateSelectedCount();
    }

    function filterRecipientTable() {
        const q = (document.getElementById('search-recipient').value || '').toLowerCase().trim();
        const filtered = allRecipients.filter(r => {
            return (r.name || '').toLowerCase().includes(q) || 
                   (r.noKK || '').toLowerCase().includes(q) || 
                   (r.phoneNumber || '').includes(q);
        });
        renderRecipientTable(filtered);
    }

    function toggleCheckAll(checked) {
        document.querySelectorAll('.recipient-checkbox').forEach(cb => {
            cb.checked = checked;
        });
        updateSelectedCount();
    }

    function selectAllValid(onlyValid) {
        document.querySelectorAll('.recipient-checkbox').forEach(cb => {
            const uid = cb.getAttribute('data-uid');
            const target = allRecipients.find(r => r.uid === uid);
            if (onlyValid) {
                cb.checked = target ? target.isValidWa : false;
            } else {
                cb.checked = false;
            }
        });
        document.getElementById('check-all-box').checked = onlyValid;
        updateSelectedCount();
    }

    function getSelectedRecipients() {
        const selectedUids = [];
        document.querySelectorAll('.recipient-checkbox:checked').forEach(cb => {
            selectedUids.push(cb.getAttribute('data-uid'));
        });
        return allRecipients.filter(r => selectedUids.includes(r.uid));
    }

    function updateSelectedCount() {
        const count = getSelectedRecipients().length;
        document.getElementById('selected-count-label').textContent = `${count} KK`;
    }

    // Sisipkan Variabel Tag ke Textarea
    function insertTag(tag) {
        const textarea = document.getElementById('message-template');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;

        textarea.value = text.substring(0, start) + tag + text.substring(end);
        textarea.selectionStart = textarea.selectionEnd = start + tag.length;
        textarea.focus();
        updateLivePreview();
    }

    // Update Pratinjau WhatsApp secara realtime
    function updateLivePreview() {
        const rawTemplate = document.getElementById('message-template').value;
        const title   = document.getElementById('event-title').value || 'Rapat Koordinasi Rutin Warga';
        const date    = document.getElementById('event-date').value || '-';
        const time    = (document.getElementById('event-time').value || '19:00 WIB').trim();
        const loc     = document.getElementById('event-location').value || '-';
        const link    = document.getElementById('event-link').value || '';
        const notes   = document.getElementById('event-notes').value || '-';

        const villageSelect = document.getElementById('filter-village');
        const villageText = villageSelect.options[villageSelect.selectedIndex]?.text.split('(')[0].trim() || 'Warga';

        // Contoh KK untuk simulasi
        const sampleKk = allRecipients.find(r => r.isValidWa) || {
            name: 'Bpk. Ahmad Fauzi',
            noKK: '3301020304050001',
            alamat: 'RT 02 / RW 01',
            villageName: villageText
        };

        document.getElementById('preview-target-name').textContent = `${sampleKk.name} (Simulasi KK)`;

        let cleanTemplate = rawTemplate;
        if (/WIB/i.test(time)) {
            cleanTemplate = cleanTemplate.replace(/\{jam\}\s*WIB/gi, '{jam}');
        }

        let rendered = cleanTemplate
            .replace(/\{nama\}/gi, sampleKk.name)
            .replace(/\{no_kk\}/gi, sampleKk.noKK)
            .replace(/\{alamat\}/gi, sampleKk.alamat || '-')
            .replace(/\{desa\}/gi, sampleKk.villageName || villageText)
            .replace(/\{acara\}/gi, title)
            .replace(/\{tanggal\}/gi, date)
            .replace(/\{jam\}/gi, time)
            .replace(/\{tempat\}/gi, loc)
            .replace(/\{catatan\}/gi, notes)
            .replace(/\{link\}/gi, link)
            .replace(/\bWIB\s+WIB\b/gi, 'WIB');

        // Ubah format WhatsApp sederhana (*bold*, _italic_) ke HTML untuk visualisasi
        let formattedHtml = escapeHtml(rendered)
            .replace(/\*(.*?)\*/g, '<strong>$1</strong>')
            .replace(/_(.*?)_/g, '<em>$1</em>')
            .replace(/~(.*?)~/g, '<del>$1</del>');

        document.getElementById('live-bubble-text').innerHTML = formattedHtml;

        const now = new Date();
        document.getElementById('preview-time-now').textContent = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.innerText = text;
        return div.innerHTML;
    }

    // Provider form change behavior
    function onProviderChange() {
        const prov = document.getElementById('cfg-provider').value;
        const urlInput = document.getElementById('cfg-api-url');
        const senderGroup = document.getElementById('group-cfg-sender');
        const lblSender = document.getElementById('lbl-sender-number');

        if (prov === 'appsbee') {
            urlInput.placeholder = 'https://wa-ab.appsbee.my.id/api/send-message';
            senderGroup.style.display = 'block';
            if (lblSender) lblSender.textContent = 'Session ID WhatsApp (Default: appsbee)';
        } else if (prov === 'fonnte') {
            urlInput.placeholder = 'https://api.fonnte.com/send';
            senderGroup.style.display = 'none';
        } else if (prov === 'wablas') {
            urlInput.placeholder = 'https://phone.wablas.com/api/send-message';
            senderGroup.style.display = 'none';
        } else if (prov === 'starsender') {
            urlInput.placeholder = 'https://starsender.online/api/sendText';
            senderGroup.style.display = 'none';
        } else if (prov === 'whacenter') {
            urlInput.placeholder = 'https://app.whacenter.com/api/send';
            senderGroup.style.display = 'block';
            if (lblSender) lblSender.textContent = 'Device ID Whacenter';
        } else {
            urlInput.placeholder = 'https://wa-ab.appsbee.my.id/api/send-message';
            senderGroup.style.display = 'block';
            if (lblSender) lblSender.textContent = 'Session ID / Device ID';
        }
    }

    // Simpan Pengaturan Gateway
    async function saveSettings() {
        const payload = {
            provider: document.getElementById('cfg-provider').value,
            apiKey: document.getElementById('cfg-api-key').value.trim(),
            apiUrl: document.getElementById('cfg-api-url').value.trim(),
            senderNumber: document.getElementById('cfg-sender-number').value.trim(),
            delaySec: parseInt(document.getElementById('cfg-delay').value, 10) || 2,
            templates: savedTemplates
        };

        try {
            const res = await fetch(`${WA_BASE_URL}/settings`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });
            const json = await res.json();
            if (json.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan',
                    text: 'Pengaturan WhatsApp Gateway berhasil diperbarui di database.',
                    timer: 1800,
                    showConfirmButton: false
                });
                await loadSettings();
            } else {
                Swal.fire('Gagal Menyimpan', json.message, 'error');
            }
        } catch (e) {
            Swal.fire('Kesalahan Jaringan', e.message, 'error');
        }
    }

    // Modal Uji Coba Kirim
    function openTestModal() {
        document.getElementById('testModal').style.display = 'flex';
    }
    function closeTestModal() {
        document.getElementById('testModal').style.display = 'none';
    }

    async function executeTestSend() {
        const phone = document.getElementById('test-phone').value.trim();
        const msg = document.getElementById('test-message').value.trim();

        if (!phone) {
            Swal.fire('Peringatan', 'Masukkan nomor WhatsApp tujuan uji coba!', 'warning');
            return;
        }

        const btn = document.getElementById('btn-do-test');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';

        try {
            const res = await fetch(`${WA_BASE_URL}/test`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    targetPhone: phone,
                    message: msg,
                    customConfig: {
                        provider: document.getElementById('cfg-provider').value,
                        apiKey: document.getElementById('cfg-api-key').value.trim(),
                        apiUrl: document.getElementById('cfg-api-url').value.trim(),
                        senderNumber: document.getElementById('cfg-sender-number').value.trim()
                    }
                })
            });
            const json = await res.json();
            if (json.success) {
                closeTestModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Pesan Terkirim!',
                    text: `Pesan uji coba berhasil terkirim melalui WhatsApp Gateway ke nomor: ${phone}`,
                    confirmButtonColor: '#059669'
                });
            } else {
                Swal.fire('Gagal Mengirim', json.message || 'Periksa API Key dan koneksi internet Anda.', 'error');
            }
        } catch (e) {
            Swal.fire('Kesalahan Jaringan', e.message, 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Kirim Pesan Uji Coba';
        }
    }

    // Direct Chat WA Web per KK
    function openDirectWhatsApp(phone, encodedName) {
        const rawTemplate = document.getElementById('message-template').value;
        const title   = document.getElementById('event-title').value || '';
        const date    = document.getElementById('event-date').value || '';
        const time    = (document.getElementById('event-time').value || '19:00 WIB').trim();
        const loc     = document.getElementById('event-location').value || '';
        const link    = document.getElementById('event-link').value || '';
        const notes   = document.getElementById('event-notes').value || '';

        const villageSelect = document.getElementById('filter-village');
        const villageText = villageSelect.options[villageSelect.selectedIndex]?.text.split('(')[0].trim() || 'Warga';

        const name = decodeURIComponent(encodedName);
        const recipient = allRecipients.find(r => r.name === name) || {};

        let cleanText = rawTemplate;
        if (/WIB/i.test(time)) {
            cleanText = cleanText.replace(/\{jam\}\s*WIB/gi, '{jam}');
        }

        let text = cleanText
            .replace(/\{nama\}/gi, name)
            .replace(/\{no_kk\}/gi, recipient.noKK || '-')
            .replace(/\{alamat\}/gi, recipient.alamat || '-')
            .replace(/\{desa\}/gi, recipient.villageName || villageText)
            .replace(/\{acara\}/gi, title)
            .replace(/\{tanggal\}/gi, date)
            .replace(/\{jam\}/gi, time)
            .replace(/\{tempat\}/gi, loc)
            .replace(/\{catatan\}/gi, notes)
            .replace(/\{link\}/gi, link)
            .replace(/\bWIB\s+WIB\b/gi, 'WIB');

        const waUrl = `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
        window.open(waUrl, '_blank');
    }

    // ===== LIVE REALTIME BLASTING ENGINE (PER-KK PROGRESS TRACKING) =====
    let isBlastRunning = false;
    let cancelBlastRequested = false;

    function cancelWhatsAppBlast() {
        if (!isBlastRunning) return;
        cancelBlastRequested = true;
        appendBlastLog(`[PERINGATAN] Menghentikan antrean pengiriman... Mohon tunggu pengiriman yang sedang berjalan selesai.`);
        const cancelBtn = document.getElementById('btn-cancel-blast');
        if (cancelBtn) {
            cancelBtn.disabled = true;
            cancelBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sedang Menghentikan...';
        }
    }

    function renderMessageForUser(rawTemplate, recipient, ctx) {
        let cleanTemplate = rawTemplate;
        if (/WIB/i.test(ctx.time)) {
            cleanTemplate = cleanTemplate.replace(/\{jam\}\s*WIB/gi, '{jam}');
        }

        let rendered = cleanTemplate
            .replace(/\{nama\}/gi, recipient.name || 'Warga')
            .replace(/\{no_kk\}/gi, recipient.noKK || '-')
            .replace(/\{alamat\}/gi, recipient.alamat || '-')
            .replace(/\{desa\}/gi, recipient.villageName || ctx.villageText)
            .replace(/\{acara\}/gi, ctx.title)
            .replace(/\{tanggal\}/gi, ctx.date)
            .replace(/\{jam\}/gi, ctx.time)
            .replace(/\{tempat\}/gi, ctx.loc)
            .replace(/\{catatan\}/gi, ctx.notes)
            .replace(/\{link\}/gi, ctx.link)
            .replace(/\bWIB\s+WIB\b/gi, 'WIB');

        return rendered;
    }

    function renderMessageForGroup(rawTemplate, ctx) {
        let cleanTemplate = rawTemplate
            .replace('Bpk/Ibu: *{nama}*', '*{nama}*')
            .replace('Bpk: *{nama}*', '*{nama}*')
            .replace('No. KK: {no_kk} - {desa}', 'Wilayah: {desa}')
            .replace('No. KK: {no_kk}', 'Wilayah: {desa}')
            .replace('Kepala Keluarga - {alamat}', 'Wilayah: {desa}')
            .replace('Warga Lingkungan: {alamat}', 'Wilayah: {desa}');

        if (/WIB/i.test(ctx.time)) {
            cleanTemplate = cleanTemplate.replace(/\{jam\}\s*WIB/gi, '{jam}');
        }

        let rendered = cleanTemplate
            .replace(/\{nama\}/gi, 'Bapak/Ibu Seluruh Warga & Kepala Keluarga')
            .replace(/\{no_kk\}/gi, '-')
            .replace(/\{alamat\}/gi, '-')
            .replace(/\{desa\}/gi, ctx.villageText)
            .replace(/\{acara\}/gi, ctx.title)
            .replace(/\{tanggal\}/gi, ctx.date)
            .replace(/\{jam\}/gi, ctx.time)
            .replace(/\{tempat\}/gi, ctx.loc)
            .replace(/\{catatan\}/gi, ctx.notes)
            .replace(/\{link\}/gi, ctx.link)
            .replace(/\bWIB\s+WIB\b/gi, 'WIB');

        return rendered;
    }

    // EKSEKUSI REAL-TIME BLASTING DENGAN STATUSBAR BERJALAN PER-KK
    async function startWhatsAppBlast() {
        if (isBlastRunning) return;

        const selected = getSelectedRecipients();
        if (selected.length === 0) {
            Swal.fire('Tidak Ada Penerima', 'Pilih minimal satu Kepala Keluarga yang memiliki nomor WhatsApp!', 'warning');
            return;
        }

        const title = document.getElementById('event-title').value.trim();
        const rawTemplate = document.getElementById('message-template').value.trim();

        if (!title || !rawTemplate) {
            Swal.fire('Form Belum Lengkap', 'Judul acara dan template pesan tidak boleh kosong!', 'warning');
            return;
        }

        // Cek API Key
        if (!activeConfig.apiKey && activeConfig.provider !== 'generic') {
            const resConfirm = await Swal.fire({
                title: 'Gateway Belum Dikonfigurasi',
                text: 'API Key WhatsApp belum diisi. Apakah Anda ingin membuka tab Pengaturan terlebih dahulu?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                confirmButtonText: 'Buka Pengaturan',
                cancelButtonText: 'Batal'
            });
            if (resConfirm.isConfirmed) {
                switchTab('settings');
            }
            return;
        }

        const targetType = document.getElementById('target-recipient-type')?.value || 'KK';
        const targetName = targetType === 'KK' ? 'Kepala Keluarga (KK)' : 'Warga';
        const delaySec = Math.max(1, activeConfig.delaySec || 2);

        const confirm = await Swal.fire({
            title: `Mulai Blasting ke ${selected.length} ${targetName}?`,
            html: `
                <div style="text-align:left; font-size:0.9rem;">
                    <p>Pesan undangan <strong>"${title}"</strong> akan dikirimkan berurutan satu per satu ke <strong>${selected.length} ${targetName}</strong>.</p>
                    <p style="color:#059669; font-weight:600;"><i class="fa-solid fa-shield-halved"></i> Jeda antar pesan: ${delaySec} detik (Aman dari banned).</p>
                    <p style="font-size:0.8rem; color:#64748b;">Progress bar dan nama KK yang terkirim akan bergerak langsung secara real-time di layar.</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#059669',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: 'Ya, Mulai Kirim Sekarang!'
        });

        if (!confirm.isConfirmed) return;

        // Inisialisasi State & Buka Progress Modal
        isBlastRunning = true;
        cancelBlastRequested = false;

        const date    = document.getElementById('event-date').value || '-';
        const time    = (document.getElementById('event-time').value || '19:00 WIB').trim();
        const loc     = document.getElementById('event-location').value || '-';
        const link    = document.getElementById('event-link').value || '';
        const notes   = document.getElementById('event-notes').value || '-';
        const villageSelect = document.getElementById('filter-village');
        const villageText = villageSelect.options[villageSelect.selectedIndex]?.text.split('(')[0].trim() || 'Warga';
        const villageId = villageSelect.value;

        const ctx = { title, date, time, loc, link, notes, villageText };

        openBlastModal(selected.length);

        const total = selected.length;
        const results = [];
        let successCount = 0;
        let failedCount = 0;

        appendBlastLog(`[${new Date().toLocaleTimeString()}] Menyiapkan antrean ${total} ${targetName} dengan jeda aman ${delaySec} detik...`);

        // LOOP PER-KK DENGAN PROGRESS STATUS BAR BERJALAN REALTIME
        for (let i = 0; i < total; i++) {
            if (cancelBlastRequested) {
                appendBlastLog(`[INFO] Pengiriman dihentikan oleh pengguna pada nomor ${i + 1} dari ${total}.`);
                break;
            }

            const r = selected[i];
            const currentNum = i + 1;

            // Update Progress Bar & Status Text sebelum mulai kirim
            const currentPct = Math.round(((i) / total) * 100);
            document.getElementById('blast-progress-bar').style.width = `${currentPct}%`;
            document.getElementById('blast-progress-text').textContent = `Mengirim ${currentNum} dari ${total} KK (${currentPct}%)...`;
            document.getElementById('blast-count-text').textContent = `Terkirim: ${successCount} / ${total} KK (Gagal: ${failedCount})`;

            if (!r.isValidWa || !r.formattedPhone) {
                failedCount++;
                results.push({
                    uid: r.uid,
                    name: r.name || 'Tanpa Nama',
                    noKK: r.noKK || '-',
                    phone: r.phoneNumber || '-',
                    status: 'FAILED',
                    error: 'Nomor WhatsApp tidak valid atau kosong'
                });
                appendBlastLog(`❌ [${currentNum}/${total}] ${r.name}: Gagal (Nomor tidak valid/kosong)`);
                continue;
            }

            const msgText = renderMessageForUser(rawTemplate, r, ctx);

            try {
                const res = await fetch(`${WA_BASE_URL}/send_single`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        targetPhone: r.formattedPhone,
                        message: msgText,
                        isGroup: false
                    })
                });

                const resJson = await res.json();

                if (resJson.success) {
                    successCount++;
                    results.push({
                        uid: r.uid,
                        name: r.name || 'Tanpa Nama',
                        noKK: r.noKK || '-',
                        phone: r.formattedPhone,
                        status: 'SUCCESS',
                        messageId: resJson.messageId || ''
                    });
                    appendBlastLog(`✅ [${currentNum}/${total}] ${r.name} (${r.formattedPhone}): Terkirim`);
                } else {
                    failedCount++;
                    results.push({
                        uid: r.uid,
                        name: r.name || 'Tanpa Nama',
                        noKK: r.noKK || '-',
                        phone: r.formattedPhone,
                        status: 'FAILED',
                        error: resJson.error || 'Ditolak gateway'
                    });
                    appendBlastLog(`❌ [${currentNum}/${total}] ${r.name}: Gagal (${resJson.error || 'Gateway error'})`);
                }
            } catch (err) {
                failedCount++;
                results.push({
                    uid: r.uid,
                    name: r.name || 'Tanpa Nama',
                    noKK: r.noKK || '-',
                    phone: r.formattedPhone,
                    status: 'FAILED',
                    error: err.message
                });
                appendBlastLog(`❌ [${currentNum}/${total}] ${r.name}: Gagal koneksi (${err.message})`);
            }

            // Update Progress Bar & Status Text setelah kirim
            const donePct = Math.round(((currentNum) / total) * 100);
            document.getElementById('blast-progress-bar').style.width = `${donePct}%`;
            document.getElementById('blast-progress-text').textContent = `Selesai ${currentNum} dari ${total} KK (${donePct}%)`;
            document.getElementById('blast-count-text').textContent = `Terkirim: ${successCount} / ${total} KK (Gagal: ${failedCount})`;

            // Jeda aman anti-spam jika bukan orang terakhir
            if (i < total - 1 && !cancelBlastRequested) {
                await new Promise(resWait => setTimeout(resWait, delaySec * 1000));
            }
        }

        // OPSI: Kirim 1 Salinan ke Grup WhatsApp jika diisi
        const targetGroupWa = (document.getElementById('target-group-wa')?.value || '').trim();
        if (targetGroupWa && !cancelBlastRequested) {
            appendBlastLog(`📢 Mengirim 1 salinan undangan ke Grup WhatsApp (${targetGroupWa})...`);
            const groupMsgText = renderMessageForGroup(rawTemplate, ctx);
            try {
                const groupRes = await fetch(`${WA_BASE_URL}/send_single`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        targetPhone: targetGroupWa,
                        message: groupMsgText,
                        isGroup: true
                    })
                });
                const groupJson = await groupRes.json();
                if (groupJson.success) {
                    appendBlastLog(`📢 Salinan WhatsApp Group BERHASIL terkirim!`);
                    results.push({
                        uid: 'WA_GROUP',
                        name: `Grup WhatsApp (${targetGroupWa})`,
                        noKK: '-',
                        phone: targetGroupWa,
                        status: 'SUCCESS'
                    });
                } else {
                    appendBlastLog(`⚠️ Salinan WhatsApp Group GAGAL: ${groupJson.error}`);
                    results.push({
                        uid: 'WA_GROUP',
                        name: `Grup WhatsApp (${targetGroupWa})`,
                        noKK: '-',
                        phone: targetGroupWa,
                        status: 'FAILED',
                        error: groupJson.error
                    });
                }
            } catch (gErr) {
                appendBlastLog(`⚠️ Salinan WhatsApp Group gagal koneksi: ${gErr.message}`);
            }
        }

        // SIMPAN RIWAYAT LENGKAP KE DATABASE (wa_blast_history)
        appendBlastLog(`[${new Date().toLocaleTimeString()}] Menyimpan riwayat pengiriman ke database...`);
        try {
            await fetch(`${WA_BASE_URL}/record_history`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    villageId: villageId === 'ALL' ? null : villageId,
                    title,
                    messageTemplate: rawTemplate,
                    targetFilter: targetType,
                    totalTarget: total,
                    successCount,
                    failedCount,
                    details: results,
                    sentBy: 'Admin Desa',
                    copyToGroupChat: document.getElementById('copy-to-group-chat')?.checked ?? true,
                    eventDetails: {
                        acara: title,
                        tanggal: date,
                        jam: time,
                        tempat: loc,
                        catatan: notes,
                        link: link
                    }
                })
            });
            appendBlastLog(`✅ Riwayat pengiriman berhasil tersimpan ke sistem.`);
        } catch (hErr) {
            console.error('Gagal menyimpan riwayat:', hErr);
        }

        // Tampilkan State Selesai
        isBlastRunning = false;
        document.getElementById('blast-progress-bar').style.width = '100%';
        document.getElementById('blast-modal-title').textContent = cancelBlastRequested ? 'Blasting Dihentikan!' : 'Blasting WhatsApp Selesai!';
        document.getElementById('blast-modal-desc').textContent = `Proses selesai. Sukses: ${successCount}, Gagal: ${failedCount} dari total ${total} penerima.`;
        document.getElementById('blast-progress-text').textContent = '100% Selesai';
        document.getElementById('blast-count-text').textContent = `Total Terkirim: ${successCount} / ${total} KK`;

        const cancelBtn = document.getElementById('btn-cancel-blast');
        if (cancelBtn) cancelBtn.style.display = 'none';
        document.getElementById('btn-close-blast-modal').style.display = 'inline-flex';
    }

    function openBlastModal(total) {
        document.getElementById('blastModal').style.display = 'flex';
        document.getElementById('blast-modal-title').textContent = 'Proses Pengiriman Blasting WA...';
        document.getElementById('blast-modal-desc').textContent = 'Mohon tunggu, sistem sedang mengirim pesan satu per satu dengan jeda aman anti-spam.';
        document.getElementById('blast-progress-bar').style.width = '0%';
        document.getElementById('blast-progress-text').textContent = `Mengirim 1 dari ${total} KK (0%)...`;
        document.getElementById('blast-count-text').textContent = `Terkirim: 0 / ${total} KK`;
        document.getElementById('blast-live-logs').innerHTML = `[${new Date().toLocaleTimeString()}] Menghubungi WhatsApp Gateway server...<br>`;

        const cancelBtn = document.getElementById('btn-cancel-blast');
        if (cancelBtn) {
            cancelBtn.style.display = 'inline-flex';
            cancelBtn.disabled = false;
            cancelBtn.innerHTML = '<i class="fa-solid fa-stop"></i> Hentikan Proses';
        }
        document.getElementById('btn-close-blast-modal').style.display = 'none';
    }

    function appendBlastLog(msg) {
        const box = document.getElementById('blast-live-logs');
        if (!box) return;
        box.innerHTML += `${msg}<br>`;
        box.scrollTop = box.scrollHeight;
    }

    function closeBlastModal() {
        if (isBlastRunning) {
            Swal.fire({
                title: 'Pengiriman Masih Berjalan',
                text: 'Proses blasting masih berlangsung. Hentikan proses terlebih dahulu jika ingin menutup jendela.',
                icon: 'warning'
            });
            return;
        }
        document.getElementById('blastModal').style.display = 'none';
    }

    // ===== TEMPLATE MANAGER =====
    function renderTemplateManager() {
        const container = document.getElementById('templates-list-grid');
        container.innerHTML = '';

        savedTemplates.forEach((t, i) => {
            const card = document.createElement('div');
            card.style.background = 'white';
            card.style.border = '1px solid #e2e8f0';
            card.style.borderRadius = '0.85rem';
            card.style.padding = '1.25rem';
            card.style.boxShadow = '0 1px 3px rgba(0,0,0,0.05)';
            card.style.display = 'flex';
            card.style.flexDirection = 'column';
            card.style.justifyContent = 'space-between';

            card.innerHTML = `
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:0.6rem;">
                        <span style="font-size:0.75rem; font-weight:700; background:#ecfdf5; color:#065f46; padding:0.2rem 0.55rem; border-radius:1rem;">${t.category}</span>
                    </div>
                    <h4 style="margin:0 0 0.5rem; font-size:0.95rem; font-weight:700; color:#1e293b;">${t.title}</h4>
                    <p style="margin:0; font-size:0.78rem; color:#64748b; line-height:1.4; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">
                        ${escapeHtml(t.content)}
                    </p>
                </div>
                <div style="margin-top:1rem; display:flex; gap:0.5rem; justify-content:flex-end;">
                    <button class="btn btn-outline btn-sm" onclick="useTemplateFromManager(${i})">
                        <i class="fa-solid fa-check"></i> Gunakan
                    </button>
                    <button class="btn btn-outline btn-sm" style="color:#ef4444;" onclick="deleteTemplateFromManager(${i})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(card);
        });
    }

    function useTemplateFromManager(index) {
        const t = savedTemplates[index];
        if (t) {
            document.getElementById('message-template').value = t.content;
            switchTab('blast');
            updateLivePreview();
            Swal.fire({
                icon: 'success',
                title: 'Template Diterapkan',
                text: `Template "${t.title}" telah dimuat ke editor pesan.`,
                timer: 1400,
                showConfirmButton: false
            });
        }
    }

    async function deleteTemplateFromManager(index) {
        const confirm = await Swal.fire({
            title: 'Hapus Template Ini?',
            text: 'Template yang dihapus tidak dapat dipulihkan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus'
        });
        if (!confirm.isConfirmed) return;

        savedTemplates.splice(index, 1);
        renderFastTemplateSelect();
        renderTemplateManager();
        await saveSettings();
    }

    async function openAddTemplateModal() {
        const { value: formValues } = await Swal.fire({
            title: 'Tambah Template Baru',
            html: `
                <div style="text-align:left; font-size:0.875rem;">
                    <div style="margin-bottom:0.75rem;">
                        <label style="font-weight:600; display:block; margin-bottom:0.3rem;">Judul Template</label>
                        <input id="swal-title" class="swal2-input" placeholder="Contoh: Undangan Rapat RT 03" style="width:100%; box-sizing:border-box; margin:0;">
                    </div>
                    <div style="margin-bottom:0.75rem;">
                        <label style="font-weight:600; display:block; margin-bottom:0.3rem;">Kategori</label>
                        <select id="swal-cat" class="swal2-input" style="width:100%; box-sizing:border-box; margin:0;">
                            <option value="RAPAT">Rapat Rutin</option>
                            <option value="ACARA">Acara / Gotong Royong</option>
                            <option value="IURAN">Iuran / Tagihan</option>
                            <option value="UMUM">Umum</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-weight:600; display:block; margin-bottom:0.3rem;">Isi Format Pesan</label>
                        <textarea id="swal-content" class="swal2-textarea" style="width:100%; box-sizing:border-box; margin:0; height:120px;" placeholder="Gunakan {nama}, {no_kk}, {desa}, dll."></textarea>
                    </div>
                </div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Simpan Template',
            confirmButtonColor: '#059669',
            preConfirm: () => {
                const title = document.getElementById('swal-title').value.trim();
                const category = document.getElementById('swal-cat').value;
                const content = document.getElementById('swal-content').value.trim();
                if (!title || !content) {
                    Swal.showValidationMessage('Judul dan isi template wajib diisi!');
                    return false;
                }
                return { title, category, content };
            }
        });

        if (formValues) {
            const newTpl = {
                id: `tpl_custom_${Date.now()}`,
                title: formValues.title,
                category: formValues.category,
                content: formValues.content
            };
            savedTemplates.push(newTpl);
            renderFastTemplateSelect();
            renderTemplateManager();
            await saveSettings();
        }
    }

    // ===== RIWAYAT PENGIRIMAN =====
    async function loadHistory() {
        const tbody = document.getElementById('history-tbody');
        tbody.innerHTML = '<tr><td colspan="8" style="text-align:center; padding:2rem; color:#9ca3af;"><i class="fa-solid fa-spinner fa-spin"></i> Memuat riwayat...</td></tr>';

        try {
            const res = await fetch(`${WA_BASE_URL}/history`);
            const json = await res.json();

            if (json.success && Array.isArray(json.data)) {
                if (json.data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="8" style="text-align:center; padding:2rem; color:#9ca3af;">Belum ada riwayat blasting yang tercatat.</td></tr>';
                    return;
                }

                tbody.innerHTML = '';
                json.data.forEach(h => {
                    const dateStr = new Date(h.createdAt).toLocaleString('id-ID');
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td><span style="font-weight:600; color:#334155;">${dateStr}</span></td>
                        <td><strong>${escapeHtml(h.title)}</strong></td>
                        <td><span style="font-size:0.78rem; background:#f1f5f9; padding:0.2rem 0.5rem; border-radius:0.4rem;">${h.villageId || 'Semua Desa'}</span></td>
                        <td><strong>${h.totalTarget}</strong></td>
                        <td><span style="color:#059669; font-weight:700;">${h.successCount}</span></td>
                        <td><span style="color:#dc2626; font-weight:700;">${h.failedCount}</span></td>
                        <td><span style="font-size:0.78rem; color:#64748b;">${h.sentBy || 'Admin'}</span></td>
                        <td style="text-align:right;">
                            <button class="btn btn-outline btn-sm" onclick="viewHistoryDetail('${h.id}')" title="Lihat Penerima">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-outline btn-sm" style="color:#ef4444;" onclick="deleteHistory('${h.id}')" title="Hapus Log">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
        } catch (e) {
            tbody.innerHTML = `<tr><td colspan="8" style="text-align:center; padding:1.5rem; color:#ef4444;">Gagal memuat: ${e.message}</td></tr>`;
        }
    }

    async function viewHistoryDetail(id) {
        try {
            const res = await fetch(`${WA_BASE_URL}/history`);
            const json = await res.json();
            const item = json.data?.find(x => x.id === id);

            if (!item) return;

            document.getElementById('detail-modal-title').textContent = `Detail: ${item.title}`;
            document.getElementById('detail-modal-meta').innerHTML = `
                Tanggal: <strong>${new Date(item.createdAt).toLocaleString('id-ID')}</strong> &bull; Total Target: <strong>${item.totalTarget}</strong> &bull; Sukses: <strong style="color:#059669;">${item.successCount}</strong> &bull; Gagal: <strong style="color:#dc2626;">${item.failedCount}</strong>
            `;

            const tbody = document.getElementById('detail-history-tbody');
            tbody.innerHTML = '';

            const details = item.details || [];
            details.forEach(d => {
                const tr = document.createElement('tr');
                const isSuccess = d.status === 'SUCCESS';
                tr.innerHTML = `
                    <td><strong>${d.name || '-'}</strong></td>
                    <td><code>${d.phone || '-'}</code></td>
                    <td>
                        <span style="font-size:0.75rem; font-weight:700; padding:0.2rem 0.5rem; border-radius:1rem; background:${isSuccess ? '#ecfdf5' : '#fef2f2'}; color:${isSuccess ? '#059669' : '#dc2626'};">
                            ${d.status}
                        </span>
                    </td>
                    <td><small style="color:#64748b;">${d.error || 'Pesan Diterima'}</small></td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('historyDetailModal').style.display = 'flex';
        } catch (e) {
            Swal.fire('Gagal Memuat Detail', e.message, 'error');
        }
    }

    function closeHistoryDetailModal() {
        document.getElementById('historyDetailModal').style.display = 'none';
    }

    async function deleteHistory(id) {
        const confirm = await Swal.fire({
            title: 'Hapus Log Riwayat Ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus'
        });
        if (!confirm.isConfirmed) return;

        try {
            const res = await fetch(`${WA_BASE_URL}/history/${id}`, {
                method: 'DELETE'
            });
            const json = await res.json();
            if (json.success) {
                loadHistory();
            }
        } catch (e) {
            Swal.fire('Kesalahan Jaringan', e.message, 'error');
        }
    }
</script>
<?= $this->endSection() ?>
