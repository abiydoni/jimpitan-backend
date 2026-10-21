<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="content-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
    <div>
        <h1 class="page-title" style="font-size: 1.6rem; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 0.6rem;">
            <span>⚙️</span> Pengaturan Sistem
        </h1>
        <p style="font-size: 0.875rem; color: #64748b; margin: 0.35rem 0 0 0;">
            Kelola konfigurasi pengiriman notifikasi WhatsApp Group, bot auto jimpitan, dan parameter rilis Google Play Store.
        </p>
    </div>

    <!-- Filter Navigasi Cepat -->
    <div style="display: flex; gap: 0.5rem; background: #f1f5f9; padding: 0.35rem; border-radius: 0.65rem; border: 1px solid #e2e8f0;">
        <button type="button" id="filter-btn-all" onclick="filterSections('all')" class="quick-filter-btn active" style="padding: 0.45rem 1rem; border-radius: 0.5rem; font-size: 0.825rem; font-weight: 600; cursor: pointer; border: none; background: #ffffff; color: #0f172a; box-shadow: 0 1px 2px rgba(0,0,0,0.06); transition: all 0.15s;">
            📋 Semua Pengaturan
        </button>
        <button type="button" id="filter-btn-wa" onclick="filterSections('wa')" class="quick-filter-btn" style="padding: 0.45rem 1rem; border-radius: 0.5rem; font-size: 0.825rem; font-weight: 600; cursor: pointer; border: none; background: transparent; color: #64748b; transition: all 0.15s;">
            💬 WhatsApp Group
        </button>
        <button type="button" id="filter-btn-version" onclick="filterSections('version')" class="quick-filter-btn" style="padding: 0.45rem 1rem; border-radius: 0.5rem; font-size: 0.825rem; font-weight: 600; cursor: pointer; border: none; background: transparent; color: #64748b; transition: all 0.15s;">
            📱 Google Play Store
        </button>
    </div>
</div>

<!-- ========================================================================= -->
<!-- 1. CARD: KONFIGURASI WHATSAPP GROUP & BOT AUTO JIMPITAN                   -->
<!-- ========================================================================= -->
<div id="section-wa" class="settings-card-wrapper" style="width: 100%; margin-bottom: 2rem;">
    <div class="card" style="width: 100%; border-radius: 0.85rem; border: 1px solid #bbf7d0; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.03); background: #ffffff;">
        <!-- Header -->
        <div style="padding: 1.25rem 1.75rem; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-bottom: 1px solid #bbf7d0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 0.85rem;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: #22c55e; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; box-shadow: 0 2px 6px rgba(34,197,94,0.3);">
                    💬
                </div>
                <div>
                    <h2 style="font-size: 1.15rem; font-weight: 700; color: #14532d; margin: 0;">
                        Konfigurasi WhatsApp Group & Bot Telebot
                    </h2>
                    <p style="font-size: 0.8rem; color: #166534; margin: 0.2rem 0 0 0;">
                        Tersimpan di tabel <code>system_settings</code> database <code>appsbeem_jimpitan_admin</code> untuk cron <code>auto_jimpitan</code>.
                    </p>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span id="wa-badge-status" style="font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.85rem; border-radius: 9999px; background: #dcfce7; color: #15803d; border: 1px solid #86efac; display: inline-flex; align-items: center; gap: 0.4rem;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span> SINKRON DENGAN BOT
                </span>
            </div>
        </div>

        <!-- Body Form -->
        <div style="padding: 1.75rem;">
            <!-- Callout Petunjuk -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #22c55e; border-radius: 0.5rem; padding: 0.85rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="font-size: 0.825rem; color: #334155; line-height: 1.5;">
                    💡 Seluruh script cron (<strong>auto_send_jimpitan.php</strong>, <strong>auto_send_jaga.php</strong>, <strong>auto_send_tagihan.php</strong>, <strong>auto_send_ultah.php</strong>) langsung membaca parameter ini tanpa perlu restart bot.
                </div>
                <div style="font-size: 0.75rem; color: #15803d; font-weight: 600; background: #dcfce7; padding: 0.2rem 0.6rem; border-radius: 0.35rem;">
                    Target Aktif: 6285729705810-1505093181@g.us
                </div>
            </div>

            <form id="wa-group-form" onsubmit="saveWaSettings(event)">
                <!-- Toggle Aktifkan / Nonaktifkan -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Status Pengiriman Otomatis WhatsApp Group</div>
                        <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">
                            Jika dinonaktifkan, pesan notifikasi tetap tersimpan di riwayat chat grup warga aplikasi, namun pengiriman WhatsApp keluar akan dilewati.
                        </div>
                    </div>
                    <label style="position: relative; display: inline-block; width: 48px; height: 26px; margin: 0; cursor: pointer;">
                        <input type="checkbox" id="wa-enabled" style="opacity: 0; width: 0; height: 0;" onchange="updateWaToggleLabel(this.checked)">
                        <span id="wa-slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #cbd5e1; transition: .3s; border-radius: 34px;"></span>
                        <span id="wa-slider-dot" style="position: absolute; content: ''; height: 20px; width: 20px; left: 3px; bottom: 3px; background-color: white; transition: .3s; border-radius: 50%; box-shadow: 0 1px 3px rgba(0,0,0,0.2);"></span>
                    </label>
                </div>

                <!-- Grid Baris 1: Target Number & API URL -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                            <span>🎯 ID Group / Nomor WhatsApp Tujuan ($targetNumber)</span>
                            <span style="font-size: 0.75rem; color: #64748b; font-weight: normal;">WA_GROUP_TARGET_NUMBER</span>
                        </label>
                        <input type="text" id="wa-target-number" class="form-control" placeholder="Contoh: 6285729705810-1505093181@g.us" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.9rem; font-family: monospace; background: #fdfdfd;">
                        <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.3rem; display: block;">
                            Gunakan ID grup (akhiran <code>@g.us</code>) untuk pengiriman ke grup WhatsApp warga, atau nomor (<code>628xxx</code>) untuk chat personal.
                        </span>
                    </div>

                    <div>
                        <label style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                            <span>🌐 URL Gateway WhatsApp Appsbee ($appsbeeUrl)</span>
                            <span style="font-size: 0.75rem; color: #64748b; font-weight: normal;">WA_API_URL</span>
                        </label>
                        <input type="url" id="wa-api-url" class="form-control" placeholder="https://wa-ab.appsbee.my.id/api/send-message" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.9rem; font-family: monospace; background: #fdfdfd;">
                        <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.3rem; display: block;">
                            Endpoint API server gateway WhatsApp untuk mengirimkan payload pesan teks.
                        </span>
                    </div>
                </div>

                <!-- Grid Baris 2: API Key, Session ID, dan Desa Terhubung -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                            <span>🔑 API Key Gateway ($appsbeeApiKey)</span>
                            <span style="font-size: 0.75rem; color: #64748b; font-weight: normal;">WA_API_KEY</span>
                        </label>
                        <div style="position: relative;">
                            <input type="password" id="wa-api-key" class="form-control" placeholder="wa-xxxx" required style="width: 100%; padding: 0.65rem 2.5rem 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.9rem; font-family: monospace; background: #fdfdfd;">
                            <button type="button" onclick="togglePasswordVisibility('wa-api-key', this)" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 1rem; color: #64748b;" title="Lihat/Sembunyikan">
                                👁️
                            </button>
                        </div>
                        <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.3rem; display: block;">
                            Header otentikasi <code>x-api-key</code> yang terdaftar di gateway.
                        </span>
                    </div>

                    <div>
                        <label style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                            <span>📱 Session ID Pengirim ($sessionId)</span>
                            <span style="font-size: 0.75rem; color: #64748b; font-weight: normal;">WA_SESSION_ID</span>
                        </label>
                        <input type="text" id="wa-session-id" class="form-control" placeholder="appsbee" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.9rem; background: #fdfdfd;">
                        <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.3rem; display: block;">
                            Nama sesi perangkat WhatsApp pengirim aktif di server gateway.
                        </span>
                    </div>

                    <div>
                        <label style="display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                            <span>🏡 Chat Group Desa Terhubung ($villageId)</span>
                            <span style="font-size: 0.75rem; color: #64748b; font-weight: normal;">WA_GROUP_VILLAGE_ID</span>
                        </label>
                        <select id="wa-village-id" class="form-control" style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.9rem; background: #ffffff;">
                            <option value="village_001">village_001 (Default)</option>
                        </select>
                        <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.3rem; display: block;">
                            Menghubungkan pesan laporan ke grup chat warga & notifikasi FCM desa.
                        </span>
                    </div>
                </div>

                <!-- Footer Tombol Simpan -->
                <div style="display: flex; justify-content: flex-end; align-items: center; padding-top: 1.25rem; border-top: 1px solid #e2e8f0;">
                    <button type="submit" id="btn-save-wa" class="btn btn-primary" style="padding: 0.75rem 2rem; border-radius: 0.5rem; background: #16a34a; color: white; border: none; font-weight: 700; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 2px 4px rgba(22,163,74,0.2); transition: background 0.15s;" onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#16a34a'">
                        <span>💾</span> Simpan Pengaturan WhatsApp
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- 2. CARD: KONFIGURASI VERSI GOOGLE PLAY STORE                              -->
<!-- ========================================================================= -->
<div id="section-version" class="settings-card-wrapper" style="width: 100%; margin-bottom: 2.5rem;">
    <div class="card" style="width: 100%; border-radius: 0.85rem; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.03); background: #ffffff;">
        <!-- Header -->
        <div style="padding: 1.25rem 1.75rem; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 0.85rem;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: #4f46e5; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; box-shadow: 0 2px 6px rgba(79,70,229,0.3);">
                    📱
                </div>
                <div>
                    <h2 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0;">
                        Konfigurasi Rilis Google Play Store
                    </h2>
                    <p style="font-size: 0.8rem; color: #64748b; margin: 0.2rem 0 0 0;">
                        Pengaturan pengecekan versi aplikasi APK warga secara terpusat melalui Google Play Store.
                    </p>
                </div>
            </div>
            <div>
                <a href="https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id" target="_blank" style="font-size: 0.8rem; color: #4f46e5; text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 0.35rem; background: #ffffff; padding: 0.35rem 0.85rem; border-radius: 0.5rem; border: 1px solid #cbd5e1;">
                    <span>🛒</span> Buka Play Store ↗
                </a>
            </div>
        </div>

        <!-- Body Form -->
        <div style="padding: 1.75rem;">
            <form id="version-form" onsubmit="saveVersionSettings(event)">
                <!-- Grid Baris 1: Versi Terbaru & Versi Minimum -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                            Versi Terbaru (Latest Version)
                        </label>
                        <input type="text" id="latestVersion" class="form-control" placeholder="Contoh: 1.10.2" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.9rem; background: #fdfdfd;">
                        <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.3rem; display: block;">
                            Sesuai nomor versi APK resmi yang telah dipublikasikan di Google Play Store.
                        </span>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                            Versi Minimum (Minimum Version)
                        </label>
                        <input type="text" id="minVersion" class="form-control" placeholder="Contoh: 1.0.0" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.9rem; background: #fdfdfd;">
                        <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.3rem; display: block;">
                            Versi aplikasi di bawah batas ini akan otomatis diminta untuk melakukan pembaruan.
                        </span>
                    </div>
                </div>

                <!-- Tautan Resmi Play Store (Full Width) -->
                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                        Tautan Resmi Google Play Store (Update URL)
                    </label>
                    <input type="url" id="updateUrl" class="form-control" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.85rem; font-family: monospace; background: #fdfdfd;" value="https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id">
                    <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.3rem; display: block;">
                        Semua pembaruan aplikasi diarahkan satu pintu melalui tautan resmi Google Play Store ini.
                    </span>
                </div>

                <!-- Opsi Notifikasi & Force Update -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1rem; margin-bottom: 1.25rem;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem 1.25rem;">
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; margin: 0;">
                            <input type="checkbox" id="showNotification" style="width: 1.25rem; height: 1.25rem; accent-color: #4f46e5; cursor: pointer;">
                            <div>
                                <div style="font-size: 0.875rem; font-weight: 700; color: #0f172a;">Tampilkan Dialog Pembaruan</div>
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.15rem;">Menampilkan pop-up dialog elegan "Perbarui Sekarang" atau "Nanti" di aplikasi warga.</div>
                            </div>
                        </label>
                    </div>

                    <div style="background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.75rem; padding: 1rem 1.25rem;">
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; margin: 0;">
                            <input type="checkbox" id="forceUpdate" style="width: 1.25rem; height: 1.25rem; accent-color: #e11d48; cursor: pointer;">
                            <div>
                                <div style="font-size: 0.875rem; font-weight: 700; color: #9f1239;">Wajib Update (Force Update)</div>
                                <div style="font-size: 0.75rem; color: #be123c; margin-top: 0.15rem;">Pengguna versi lama tidak dapat menutup dialog sebelum memperbarui aplikasi.</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Catatan Rilis -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-bottom: 0.4rem;">
                        Catatan Rilis (Release Notes)
                    </label>
                    <textarea id="releaseNotes" class="form-control" rows="3" placeholder="Tuliskan ringkasan pembaruan yang dapat dibaca warga pada dialog update..." style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.875rem; background: #fdfdfd;"></textarea>
                </div>

                <!-- Footer Tombol Simpan -->
                <div style="display: flex; justify-content: flex-end; align-items: center; padding-top: 1.25rem; border-top: 1px solid #e2e8f0;">
                    <button type="submit" id="btn-save-version" class="btn btn-primary" style="padding: 0.75rem 2rem; border-radius: 0.5rem; background: #4f46e5; color: white; border: none; font-weight: 700; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 2px 4px rgba(79,70,229,0.2); transition: background 0.15s;" onmouseover="this.style.background='#4338ca'" onmouseout="this.style.background='#4f46e5'">
                        <span>💾</span> Simpan Pengaturan Versi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const DEFAULT_PLAY_STORE_URL = 'https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id';

    // Navigasi Filter / Tab
    function filterSections(mode) {
        const btnAll = document.getElementById('filter-btn-all');
        const btnWa = document.getElementById('filter-btn-wa');
        const btnVersion = document.getElementById('filter-btn-version');

        const secWa = document.getElementById('section-wa');
        const secVersion = document.getElementById('section-version');

        // Reset Styles
        [btnAll, btnWa, btnVersion].forEach(b => {
            b.style.background = 'transparent';
            b.style.color = '#64748b';
            b.style.boxShadow = 'none';
        });

        if (mode === 'all') {
            btnAll.style.background = '#ffffff';
            btnAll.style.color = '#0f172a';
            btnAll.style.boxShadow = '0 1px 2px rgba(0,0,0,0.06)';

            secWa.style.display = 'block';
            secVersion.style.display = 'block';
        } else if (mode === 'wa') {
            btnWa.style.background = '#ffffff';
            btnWa.style.color = '#15803d';
            btnWa.style.boxShadow = '0 1px 2px rgba(0,0,0,0.06)';

            secWa.style.display = 'block';
            secVersion.style.display = 'none';
        } else if (mode === 'version') {
            btnVersion.style.background = '#ffffff';
            btnVersion.style.color = '#4f46e5';
            btnVersion.style.boxShadow = '0 1px 2px rgba(0,0,0,0.06)';

            secWa.style.display = 'none';
            secVersion.style.display = 'block';
        }
    }

    // Toggle switch slider UI update
    function updateWaToggleLabel(checked) {
        const slider = document.getElementById('wa-slider');
        const dot = document.getElementById('wa-slider-dot');
        const badge = document.getElementById('wa-badge-status');

        if (checked) {
            slider.style.backgroundColor = '#22c55e';
            dot.style.transform = 'translateX(22px)';
            badge.innerHTML = '<span style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span> PENGIRIMAN AKTIF';
            badge.style.background = '#dcfce7';
            badge.style.color = '#15803d';
            badge.style.borderColor = '#86efac';
        } else {
            slider.style.backgroundColor = '#cbd5e1';
            dot.style.transform = 'translateX(0px)';
            badge.innerHTML = '<span style="width: 8px; height: 8px; border-radius: 50%; background: #94a3b8;"></span> PENGIRIMAN DIJEDA';
            badge.style.background = '#f1f5f9';
            badge.style.color = '#64748b';
            badge.style.borderColor = '#cbd5e1';
        }
    }

    function togglePasswordVisibility(fieldId, btn) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = '🙈';
        } else {
            input.type = 'password';
            btn.textContent = '👁️';
        }
    }

    // ==========================================
    // 1. LOAD & SAVE WA GROUP SETTINGS
    // ==========================================
    async function loadWaGroupSettings() {
        try {
            const res = await fetch(`<?= base_url('/settings/wa_group') ?>`);
            const json = await res.json();

            if (json.success && json.data) {
                const d = json.data;
                document.getElementById('wa-target-number').value = d.targetNumber || '6285729705810-1505093181@g.us';
                document.getElementById('wa-api-url').value = d.appsbeeUrl || 'https://wa-ab.appsbee.my.id/api/send-message';
                document.getElementById('wa-api-key').value = d.appsbeeApiKey || 'wa-69aa3dbf930020c93f34b83add6374e8';
                document.getElementById('wa-session-id').value = d.sessionId || 'appsbee';

                const isEnabled = (d.isEnabled !== false);
                const chk = document.getElementById('wa-enabled');
                chk.checked = isEnabled;
                updateWaToggleLabel(isEnabled);

                // Populate Desa Dropdown
                const sel = document.getElementById('wa-village-id');
                sel.innerHTML = '';
                if (Array.isArray(d.villages) && d.villages.length > 0) {
                    d.villages.forEach(v => {
                        const opt = document.createElement('option');
                        opt.value = v.id;
                        opt.textContent = `${v.name || v.id} (${v.id})${v.uniqueCode ? ' - Kode: ' + v.uniqueCode : ''}`;
                        if (v.id === d.villageId) opt.selected = true;
                        sel.appendChild(opt);
                    });
                } else {
                    const opt = document.createElement('option');
                    opt.value = d.villageId || 'village_001';
                    opt.textContent = d.villageId || 'village_001';
                    opt.selected = true;
                    sel.appendChild(opt);
                }
            }
        } catch (error) {
            console.error('Error loading WA group settings:', error);
            showToast('Error', 'Gagal memuat pengaturan WhatsApp');
        }
    }

    async function saveWaSettings(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-save-wa');
        btn.disabled = true;
        btn.innerHTML = '<span>⏳</span> Menyimpan ke Database...';

        const payload = {
            targetNumber: document.getElementById('wa-target-number').value.trim(),
            appsbeeUrl: document.getElementById('wa-api-url').value.trim(),
            appsbeeApiKey: document.getElementById('wa-api-key').value.trim(),
            sessionId: document.getElementById('wa-session-id').value.trim(),
            villageId: document.getElementById('wa-village-id').value,
            isEnabled: document.getElementById('wa-enabled').checked
        };

        try {
            const res = await fetch(`<?= base_url('/settings/wa_group') ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });
            const json = await res.json();

            if (json.success) {
                showToast('Sukses', json.message || 'Pengaturan WhatsApp Group berhasil disimpan!');
            } else {
                showToast('Gagal', json.message || 'Terjadi kesalahan saat menyimpan pengaturan');
            }
        } catch (error) {
            console.error('Error saving WA settings:', error);
            showToast('Error', 'Koneksi ke backend gagal');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<span>💾</span> Simpan Pengaturan WhatsApp';
        }
    }

    // ==========================================
    // 2. LOAD & SAVE VERSION SETTINGS
    // ==========================================
    async function loadVersionSettings() {
        try {
            const res = await fetch(`${API_URL}/config/version`);
            const json = await res.json();
            
            if (json.success && json.data) {
                document.getElementById('latestVersion').value = json.data.latestVersion || '';
                document.getElementById('minVersion').value = json.data.minVersion || '';
                
                let url = json.data.updateUrl || '';
                if (!url || url.includes('.apk') || url.includes('com.appsbeem.jimpitan')) {
                    url = DEFAULT_PLAY_STORE_URL;
                }
                document.getElementById('updateUrl').value = url;
                
                document.getElementById('releaseNotes').value = json.data.releaseNotes || '';
                document.getElementById('forceUpdate').checked = json.data.forceUpdate === true;
                const notifVal = json.data.showNotification !== undefined ? json.data.showNotification : json.data.showUpdateNotification;
                document.getElementById('showNotification').checked = notifVal !== false;
            }
        } catch (error) {
            console.error('Error loading version settings:', error);
        }
    }

    async function saveVersionSettings(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-save-version');
        btn.disabled = true;
        btn.innerHTML = '<span>⏳</span> Menyimpan...';
        
        const payload = {
            latestVersion: document.getElementById('latestVersion').value.trim(),
            minVersion: document.getElementById('minVersion').value.trim(),
            updateUrl: document.getElementById('updateUrl').value.trim() || DEFAULT_PLAY_STORE_URL,
            updateUrlLegacy: '',
            releaseNotes: document.getElementById('releaseNotes').value.trim(),
            forceUpdate: document.getElementById('forceUpdate').checked,
            showNotification: document.getElementById('showNotification').checked
        };
        
        try {
            const token = (typeof getFreshFirebaseToken === 'function') 
                ? await getFreshFirebaseToken() 
                : (typeof FIREBASE_ID_TOKEN !== 'undefined' ? FIREBASE_ID_TOKEN : getFirebaseToken());

            const res = await fetch(`${API_URL}/config/version`, {
                method: 'PUT',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify(payload)
            });
            const json = await res.json();
            
            if (json.success) {
                showToast('Sukses', 'Pengaturan versi Play Store berhasil disimpan!');
            } else if (res.status === 401 || res.status === 403) {
                showToast('Sesi Berakhir', json.message || 'Token autentikasi kedaluwarsa. Silakan refresh atau login ulang.');
            } else {
                showToast('Gagal', json.message || 'Terjadi kesalahan saat menyimpan');
            }
        } catch (error) {
            console.error('Error saving settings:', error);
            showToast('Error', 'Koneksi ke server gagal');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<span>💾</span> Simpan Pengaturan Versi';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadWaGroupSettings();
        loadVersionSettings();
    });
</script>
<?= $this->endSection() ?>
