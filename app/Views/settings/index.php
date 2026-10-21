<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    /* Reset & Prevent Horizontal Scroll */
    *, *::before, *::after {
        box-sizing: border-box;
    }

    .settings-wrapper {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* Tabs Styling */
    .settings-tabs {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 0.5rem;
        flex-wrap: wrap;
    }

    .settings-tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.4rem;
        font-size: 0.925rem;
        font-weight: 600;
        border-radius: 0.6rem;
        cursor: pointer;
        border: 1px solid #cbd5e1;
        background-color: #ffffff;
        color: #475569;
        transition: all 0.2s ease;
    }

    .settings-tab-btn:hover {
        background-color: #f8fafc;
        color: #0f172a;
    }

    .settings-tab-btn.active-wa {
        background-color: #16a34a;
        color: #ffffff;
        border-color: #16a34a;
        box-shadow: 0 2px 4px rgba(22, 163, 74, 0.25);
    }

    .settings-tab-btn.active-version {
        background-color: #4f46e5;
        color: #ffffff;
        border-color: #4f46e5;
        box-shadow: 0 2px 4px rgba(79, 70, 229, 0.25);
    }

    /* Card Full Width */
    .settings-card {
        width: 100%;
        max-width: 100%;
        background: #ffffff;
        border-radius: 0.85rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .settings-card-header {
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .header-wa {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border-bottom: 1px solid #bbf7d0;
    }

    .header-version {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e2e8f0;
    }

    .settings-card-body {
        padding: 1.75rem 1.5rem;
        width: 100%;
    }

    /* Form Layout Elements - Guaranteed No Overlap */
    .form-group {
        margin-bottom: 1.25rem;
        width: 100%;
        position: static;
        clear: both;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.45rem;
        line-height: 1.3;
    }

    .form-hint {
        display: block;
        font-size: 0.775rem;
        color: #64748b;
        margin-top: 0.35rem;
        line-height: 1.4;
    }

    .form-input {
        display: block;
        width: 100%;
        padding: 0.7rem 0.95rem;
        font-size: 0.9rem;
        font-family: inherit;
        border: 1.5px solid #cbd5e1;
        border-radius: 0.5rem;
        background-color: #ffffff;
        color: #0f172a;
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
    }

    .form-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    .form-input-wa:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.15);
    }

    .form-input-code {
        font-family: 'Consolas', 'Courier New', monospace;
        font-size: 0.875rem;
    }

    /* Flex Grid Rows - Prevents Horizontal Overflow with min-width: 0 */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1.25rem;
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .form-col {
        flex: 1 1 300px;
        min-width: 0; /* Essential to prevent overflow */
    }

    .form-col-full {
        flex: 1 1 100%;
        min-width: 0;
    }

    /* Action Buttons */
    .btn-submit-wa {
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        background-color: #16a34a;
        color: #ffffff;
        border: none;
        font-weight: 700;
        font-size: 0.925rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.15s;
    }

    .btn-submit-wa:hover {
        background-color: #15803d;
    }

    .btn-submit-version {
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        background-color: #4f46e5;
        color: #ffffff;
        border: none;
        font-weight: 700;
        font-size: 0.925rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.15s;
    }

    .btn-submit-version:hover {
        background-color: #4338ca;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="settings-wrapper">
    <!-- Page Header -->
    <div style="margin-bottom: 1.5rem;">
        <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0;">
            Pengaturan Sistem
        </h1>
        <p style="font-size: 0.85rem; color: #64748b; margin: 0.3rem 0 0 0;">
            Kelola konfigurasi pengiriman notifikasi WhatsApp Group dan versi rilis aplikasi Google Play Store.
        </p>
    </div>

    <!-- Hanya 2 Tab Navigasi -->
    <div class="settings-tabs">
        <button type="button" id="tab-btn-wa" onclick="switchSettingsTab('wa')" class="settings-tab-btn active-wa">
            <span>💬</span> Notifikasi WhatsApp Group (Telebot)
        </button>
        <button type="button" id="tab-btn-version" onclick="switchSettingsTab('version')" class="settings-tab-btn">
            <span>📱</span> Google Play Store
        </button>
    </div>

    <!-- ========================================================================= -->
    <!-- 1. TAB KONTEN: WHATSAPP GROUP (TELEBOT & GATEWAY)                          -->
    <!-- ========================================================================= -->
    <div id="tab-content-wa" style="display: block; width: 100%;">
        <div class="settings-card">
            <!-- Header -->
            <div class="settings-card-header header-wa">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 42px; height: 42px; border-radius: 10px; background: #22c55e; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                        💬
                    </div>
                    <div>
                        <h2 style="font-size: 1.15rem; font-weight: 700; color: #14532d; margin: 0;">
                            Konfigurasi WhatsApp Group & Bot Telebot
                        </h2>
                        <p style="font-size: 0.8rem; color: #166534; margin: 0.2rem 0 0 0;">
                            Data tersimpan di tabel <code>system_settings</code> database <code>appsbeem_jimpitan_admin</code> untuk cron <code>auto_jimpitan</code>.
                        </p>
                    </div>
                </div>
                <div>
                    <span id="wa-badge-status" style="font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.85rem; border-radius: 9999px; background: #dcfce7; color: #15803d; border: 1px solid #86efac; display: inline-flex; align-items: center; gap: 0.4rem;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span> PENGIRIMAN AKTIF
                    </span>
                </div>
            </div>

            <!-- Body -->
            <div class="settings-card-body">
                <!-- Info Notice -->
                <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 0.6rem; padding: 0.85rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                    <div style="font-size: 0.825rem; color: #166534; line-height: 1.5;">
                        💡 Script otomatis (<code>auto_send_jimpitan.php</code>, <code>auto_send_jaga.php</code>, <code>auto_send_tagihan.php</code>, <code>auto_send_ultah.php</code>) langsung membaca parameter di bawah ini.
                    </div>
                    <div style="font-size: 0.75rem; color: #15803d; font-weight: 700; background: #ffffff; padding: 0.25rem 0.6rem; border-radius: 0.35rem; border: 1px solid #bbf7d0;">
                        Target Aktif: 6285729705810-1505093181@g.us
                    </div>
                </div>

                <form id="wa-group-form" onsubmit="saveWaSettings(event)">
                    <!-- Toggle Switch Status Notifikasi -->
                    <div class="form-group" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.65rem; padding: 1rem 1.25rem;">
                        <label style="display: flex; align-items: center; justify-content: space-between; cursor: pointer; margin: 0;">
                            <div>
                                <div style="font-size: 0.925rem; font-weight: 700; color: #0f172a;">Status Pengiriman WhatsApp Otomatis</div>
                                <div class="form-hint" style="margin-top: 0.2rem;">
                                    Jika dinonaktifkan, pesan laporan tetap tersimpan di database chat grup warga aplikasi, namun bot tidak mengirim chat keluar ke grup WhatsApp.
                                </div>
                            </div>
                            <input type="checkbox" id="wa-enabled" style="width: 1.35rem; height: 1.35rem; accent-color: #16a34a; cursor: pointer;" onchange="updateWaToggleStatus(this.checked)">
                        </label>
                    </div>

                    <!-- Row 1: Target Number & API URL -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="wa-target-number">🎯 Target WhatsApp Group JID / Nomor ($targetNumber)</label>
                                <input type="text" id="wa-target-number" class="form-input form-input-wa form-input-code" placeholder="Contoh: 6285729705810-1505093181@g.us" required>
                                <span class="form-hint">Format ID Group berakhiran <code>@g.us</code> untuk grup WhatsApp, atau <code>628xxx</code> untuk nomor personal.</span>
                            </div>
                        </div>

                        <div class="form-col">
                            <div class="form-group">
                                <label for="wa-api-url">🌐 URL Gateway Appsbee ($appsbeeUrl)</label>
                                <input type="url" id="wa-api-url" class="form-input form-input-wa form-input-code" placeholder="https://wa-ab.appsbee.my.id/api/send-message" required>
                                <span class="form-hint">Endpoint server API gateway pengiriman pesan teks WhatsApp Appsbee.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: API Key, Session ID, dan Desa Terhubung -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="wa-api-key">🔑 API Key Gateway ($appsbeeApiKey)</label>
                                <div style="display: flex; gap: 0.35rem;">
                                    <input type="password" id="wa-api-key" class="form-input form-input-wa form-input-code" placeholder="wa-xxxx" required style="flex: 1;">
                                    <button type="button" onclick="togglePasswordVisibility('wa-api-key', this)" style="padding: 0 0.85rem; border: 1.5px solid #cbd5e1; border-radius: 0.5rem; background: #ffffff; cursor: pointer; color: #475569;" title="Tampilkan / Sembunyikan">
                                        👁️
                                    </button>
                                </div>
                                <span class="form-hint">Kunci <code>x-api-key</code> autentikasi yang terdaftar pada gateway.</span>
                            </div>
                        </div>

                        <div class="form-col">
                            <div class="form-group">
                                <label for="wa-session-id">📱 Session ID / Nama Device ($sessionId)</label>
                                <input type="text" id="wa-session-id" class="form-input form-input-wa" placeholder="appsbee" required>
                                <span class="form-hint">Nama sesi perangkat WhatsApp pengirim aktif di gateway.</span>
                            </div>
                        </div>

                        <div class="form-col">
                            <div class="form-group">
                                <label for="wa-village-id">🏡 Desa untuk Chat Grup Aplikasi ($villageId)</label>
                                <select id="wa-village-id" class="form-input form-input-wa" style="cursor: pointer;">
                                    <option value="village_001">village_001 (Default)</option>
                                </select>
                                <span class="form-hint">Desa tujuan penyimpanan chat warga dan trigger notifikasi FCM aplikasi.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Tombol Simpan -->
                    <div style="display: flex; justify-content: flex-end; padding-top: 1.25rem; border-top: 1px solid #e2e8f0; margin-top: 1rem;">
                        <button type="submit" id="btn-save-wa" class="btn-submit-wa">
                            <span>💾</span> Simpan Pengaturan WhatsApp
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 2. TAB KONTEN: GOOGLE PLAY STORE                                          -->
    <!-- ========================================================================= -->
    <div id="tab-content-version" style="display: none; width: 100%;">
        <div class="settings-card">
            <!-- Header -->
            <div class="settings-card-header header-version">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 42px; height: 42px; border-radius: 10px; background: #4f46e5; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                        📱
                    </div>
                    <div>
                        <h2 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0;">
                            Konfigurasi Rilis Google Play Store
                        </h2>
                        <p style="font-size: 0.8rem; color: #64748b; margin: 0.2rem 0 0 0;">
                            Pengaturan resmi versi aplikasi Jimpitan satu pintu via Google Play Store.
                        </p>
                    </div>
                </div>
                <div>
                    <a href="https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id" target="_blank" style="font-size: 0.8rem; color: #4f46e5; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 0.35rem; background: #ffffff; padding: 0.45rem 0.9rem; border-radius: 0.5rem; border: 1px solid #cbd5e1;">
                        <span>🛒</span> Buka di Play Store ↗
                    </a>
                </div>
            </div>

            <!-- Body -->
            <div class="settings-card-body">
                <form id="version-form" onsubmit="saveVersionSettings(event)">
                    <!-- Row 1: Versi Terbaru & Versi Minimum -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="latestVersion">Versi Terbaru (Latest Version)</label>
                                <input type="text" id="latestVersion" class="form-input" placeholder="Contoh: 1.10.2" required>
                                <span class="form-hint">Nomor versi APK terkini yang sudah rilis di Play Store.</span>
                            </div>
                        </div>

                        <div class="form-col">
                            <div class="form-group">
                                <label for="minVersion">Versi Minimum (Minimum Version)</label>
                                <input type="text" id="minVersion" class="form-input" placeholder="Contoh: 1.0.0" required>
                                <span class="form-hint">Aplikasi di bawah versi ini akan diminta memperbarui sistem.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Play Store URL -->
                    <div class="form-group">
                        <label for="updateUrl">Tautan Resmi Google Play Store (Update URL)</label>
                        <input type="url" id="updateUrl" class="form-input form-input-code" required value="https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id">
                        <span class="form-hint">Semua pembaruan diarahkan resmi satu pintu ke tautan Play Store ini.</span>
                    </div>

                    <!-- Row 3: Opsi Dialog Pembaruan & Wajib Update -->
                    <div class="form-row" style="margin-bottom: 1.25rem;">
                        <div class="form-col">
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.65rem; padding: 1rem 1.25rem;">
                                <label style="display: flex; align-items: flex-start; gap: 0.75rem; cursor: pointer; margin: 0;">
                                    <input type="checkbox" id="showNotification" style="width: 1.25rem; height: 1.25rem; accent-color: #4f46e5; margin-top: 0.15rem; cursor: pointer;">
                                    <div>
                                        <div style="font-size: 0.875rem; font-weight: 700; color: #0f172a;">Tampilkan Dialog Pembaruan</div>
                                        <div class="form-hint" style="margin-top: 0.2rem;">Menampilkan pop-up "Perbarui Sekarang" atau "Nanti" saat warga membuka aplikasi.</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="form-col">
                            <div style="background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.65rem; padding: 1rem 1.25rem;">
                                <label style="display: flex; align-items: flex-start; gap: 0.75rem; cursor: pointer; margin: 0;">
                                    <input type="checkbox" id="forceUpdate" style="width: 1.25rem; height: 1.25rem; accent-color: #e11d48; margin-top: 0.15rem; cursor: pointer;">
                                    <div>
                                        <div style="font-size: 0.875rem; font-weight: 700; color: #9f1239;">Wajib Update (Force Update)</div>
                                        <div class="form-hint" style="margin-top: 0.2rem; color: #be123c;">Warga dengan versi lama tidak dapat menutup dialog sebelum melakukan update.</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Row 4: Catatan Rilis -->
                    <div class="form-group">
                        <label for="releaseNotes">Catatan Rilis (Release Notes)</label>
                        <textarea id="releaseNotes" class="form-input" rows="3" placeholder="Tuliskan catatan pembaruan yang dapat dibaca warga di aplikasi..."></textarea>
                    </div>

                    <!-- Row 5: Akun Akses Penguji Google Play Store (Reviewer Credentials) -->
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 0.65rem; padding: 1.25rem; margin-bottom: 1.25rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span style="font-size: 1.25rem;">🛡️</span>
                            <div>
                                <div style="font-size: 0.95rem; font-weight: 700; color: #166534;">Akun Penguji Google Play Store (Reviewer Credentials)</div>
                                <div class="form-hint" style="color: #15803d; margin: 0;">Digunakan oleh tim peninjau Google Play saat verifikasi rilis. Tersimpan di pengaturan sistem (tabel system_settings) dan otomatis tersinkron ke aplikasi & Firebase Auth.</div>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 1rem; margin-bottom: 0;">
                            <div class="form-col">
                                <label for="reviewerEmail" style="color: #14532d; font-weight: 600;">Email Penguji</label>
                                <input type="email" id="reviewerEmail" class="form-input form-input-code" placeholder="fourbee02@gmail.com" value="fourbee02@gmail.com" required>
                                <span class="form-hint">Email akun peninjau Google Play Store.</span>
                            </div>
                            <div class="form-col">
                                <label for="reviewerPassword" style="color: #14532d; font-weight: 600;">Password Penguji</label>
                                <input type="text" id="reviewerPassword" class="form-input form-input-code" placeholder="Reviewer2026!" value="Reviewer2026!" required>
                                <span class="form-hint">Password untuk login penguji di aplikasi & Firebase Auth.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Tombol Simpan -->
                    <div style="display: flex; justify-content: flex-end; padding-top: 1.25rem; border-top: 1px solid #e2e8f0; margin-top: 1rem;">
                        <button type="submit" id="btn-save-version" class="btn-submit-version">
                            <span>💾</span> Simpan Pengaturan Versi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const DEFAULT_PLAY_STORE_URL = 'https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id';

    // Perpindahan 2 Tab
    function switchSettingsTab(tabName) {
        const btnWa = document.getElementById('tab-btn-wa');
        const btnVersion = document.getElementById('tab-btn-version');
        const contentWa = document.getElementById('tab-content-wa');
        const contentVersion = document.getElementById('tab-content-version');

        if (tabName === 'wa') {
            btnWa.className = 'settings-tab-btn active-wa';
            btnVersion.className = 'settings-tab-btn';
            contentWa.style.display = 'block';
            contentVersion.style.display = 'none';
        } else if (tabName === 'version') {
            btnWa.className = 'settings-tab-btn';
            btnVersion.className = 'settings-tab-btn active-version';
            contentWa.style.display = 'none';
            contentVersion.style.display = 'block';
        }
    }

    function updateWaToggleStatus(checked) {
        const badge = document.getElementById('wa-badge-status');
        if (checked) {
            badge.innerHTML = '<span style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span> PENGIRIMAN AKTIF';
            badge.style.background = '#dcfce7';
            badge.style.color = '#15803d';
            badge.style.borderColor = '#86efac';
        } else {
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
                updateWaToggleStatus(isEnabled);

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
        btn.innerHTML = '<span>⏳</span> Menyimpan...';

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

                if (document.getElementById('reviewerEmail')) {
                    document.getElementById('reviewerEmail').value = json.data.reviewerEmail || 'fourbee02@gmail.com';
                }
                if (document.getElementById('reviewerPassword')) {
                    document.getElementById('reviewerPassword').value = json.data.reviewerPassword || 'Reviewer2026!';
                }
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
            showNotification: document.getElementById('showNotification').checked,
            reviewerEmail: document.getElementById('reviewerEmail') ? document.getElementById('reviewerEmail').value.trim() : 'fourbee02@gmail.com',
            reviewerPassword: document.getElementById('reviewerPassword') ? document.getElementById('reviewerPassword').value.trim() : 'Reviewer2026!'
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
