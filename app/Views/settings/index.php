<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="content-header" style="margin-bottom: 1.5rem;">
    <div>
        <h1 class="page-title" style="font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0;">Pengaturan Sistem</h1>
        <p style="font-size: 0.875rem; color: #6b7280; margin: 0.25rem 0 0 0;">Konfigurasi notifikasi WhatsApp Group, bot auto jimpitan, dan versi rilis aplikasi.</p>
    </div>
</div>

<!-- Tab Navigasi -->
<div style="display: flex; gap: 0.75rem; margin-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem;">
    <button type="button" id="tab-btn-wa" onclick="switchTab('wa')" style="padding: 0.65rem 1.25rem; border-radius: 0.5rem; font-weight: 600; font-size: 0.9rem; cursor: pointer; border: none; display: flex; align-items: center; gap: 0.5rem; background-color: #25d366; color: white; transition: all 0.2s;">
        <span>💬</span> Notifikasi WhatsApp Group (Telebot)
    </button>
    <button type="button" id="tab-btn-version" onclick="switchTab('version')" style="padding: 0.65rem 1.25rem; border-radius: 0.5rem; font-weight: 600; font-size: 0.9rem; cursor: pointer; border: 1px solid #d1d5db; display: flex; align-items: center; gap: 0.5rem; background-color: #ffffff; color: #4b5563; transition: all 0.2s;">
        <span>📱</span> Rilis Google Play Store
    </button>
</div>

<!-- ========================================== -->
<!-- 1. TAB WHATSAPP GROUP & BOT TELEBOT        -->
<!-- ========================================== -->
<div id="tab-content-wa" style="display: block;">
    <div class="card" style="max-width: 850px; margin: 0 auto; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); background: #ffffff;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; background: linear-gradient(to right, #f0fdf4, #ffffff);">
            <div style="display:flex; align-items:center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display:flex; align-items:center; gap:0.75rem;">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background-color: #dcfce7; display:flex; align-items:center; justify-content:center; color: #15803d; font-size: 1.4rem;">
                        💬
                    </div>
                    <div>
                        <h2 style="font-size: 1.2rem; font-weight: 700; color: #111827; margin:0;">Konfigurasi WhatsApp Group & Auto Jimpitan</h2>
                        <p style="font-size: 0.825rem; color: #4b5563; margin:0.15rem 0 0 0;">Parameter ini disimpan di tabel <code>system_settings</code> database <code>appsbeem_jimpitan_admin</code>.</p>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span id="wa-status-badge" style="font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.75rem; border-radius: 9999px; background-color: #dcfce7; color: #15803d; border: 1px solid #86efac;">
                        ● AKTIF DI DATABASE
                    </span>
                </div>
            </div>
        </div>

        <div style="padding: 1.75rem;">
            <!-- Info Callout -->
            <div style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 0.75rem; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; gap: 0.75rem; align-items: flex-start;">
                <span style="font-size: 1.25rem;">ℹ️</span>
                <div style="font-size: 0.825rem; color: #1e40af; line-height: 1.45;">
                    Semua script otomatis di folder <code>telebot/auto_jimpitan</code> (laporan jimpitan, jadwal ronda, tagihan, dan ulang tahun) mengambil konfigurasi <strong>$targetNumber</strong>, <strong>$appsbeeUrl</strong>, dan <strong>$appsbeeApiKey</strong> langsung dari form ini secara dinamis.
                </div>
            </div>

            <form id="wa-group-form" onsubmit="saveWaSettings(event)">
                <!-- Toggle Aktifkan Notifikasi -->
                <div style="margin-bottom: 1.5rem; padding: 1.25rem; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.75rem;">
                    <label style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                        <div>
                            <div style="font-size: 0.95rem; font-weight: 700; color: #1e293b;">Aktifkan Pengiriman Otomatis WhatsApp Group</div>
                            <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">Jika dimatikan, pesan cron tetap masuk ke database & chat warga aplikasi namun pesan WA keluar dilewati.</div>
                        </div>
                        <input type="checkbox" id="wa-enabled" style="width: 1.4rem; height: 1.4rem; cursor: pointer; accent-color: #25d366;">
                    </label>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                    <!-- Target Number -->
                    <div style="grid-column: span 2;">
                        <label style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom:0.4rem; color:#374151;">
                            🎯 WhatsApp Group JID / Nomor Target ($targetNumber)
                        </label>
                        <input type="text" id="wa-target-number" class="form-control" placeholder="Contoh: 6285729705810-1505093181@g.us" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.9rem; font-family: monospace;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:0.35rem;">
                            <span style="font-size: 0.75rem; color: #6b7280;">Gunakan akhiran <code>@g.us</code> untuk Group WhatsApp, atau <code>628xxx</code> untuk nomor personal.</span>
                            <span style="font-size: 0.725rem; color: #059669; font-weight: 600;">Grup Aktif: 6285729705810-1505093181@g.us</span>
                        </div>
                    </div>

                    <!-- Appsbee URL -->
                    <div style="grid-column: span 2;">
                        <label style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom:0.4rem; color:#374151;">
                            🌐 URL Gateway WhatsApp ($appsbeeUrl)
                        </label>
                        <input type="url" id="wa-api-url" class="form-control" placeholder="https://wa-ab.appsbee.my.id/api/send-message" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.9rem; font-family: monospace;">
                        <span style="font-size: 0.75rem; color: #6b7280; display:block; margin-top:0.35rem;">Endpoint API pengiriman pesan teks gateway WhatsApp Appsbee.</span>
                    </div>

                    <!-- Appsbee API Key -->
                    <div>
                        <label style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom:0.4rem; color:#374151;">
                            🔑 API Key Gateway ($appsbeeApiKey)
                        </label>
                        <div style="position: relative;">
                            <input type="password" id="wa-api-key" class="form-control" placeholder="wa-xxxx" required style="width: 100%; padding: 0.65rem 2.5rem 0.65rem 0.85rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.9rem; font-family: monospace;">
                            <button type="button" onclick="togglePasswordVisibility('wa-api-key', this)" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 1rem; color: #6b7280;">
                                👁️
                            </button>
                        </div>
                        <span style="font-size: 0.75rem; color: #6b7280; display:block; margin-top:0.35rem;">Header <code>x-api-key</code> yang terdaftar di gateway.</span>
                    </div>

                    <!-- Session ID -->
                    <div>
                        <label style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom:0.4rem; color:#374151;">
                            📱 Session ID / Nama Device ($sessionId)
                        </label>
                        <input type="text" id="wa-session-id" class="form-control" placeholder="appsbee" required style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.9rem;">
                        <span style="font-size: 0.75rem; color: #6b7280; display:block; margin-top:0.35rem;">Nama sesi/perangkat WhatsApp yang terhubung di server gateway.</span>
                    </div>

                    <!-- Village ID untuk Chat Group Aplikasi -->
                    <div style="grid-column: span 2;">
                        <label style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom:0.4rem; color:#374151;">
                            🏡 Hubungkan ke Chat Group Desa ($villageId)
                        </label>
                        <select id="wa-village-id" class="form-control" style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.9rem; background: #fff;">
                            <option value="village_001">village_001 (Default)</option>
                        </select>
                        <span style="font-size: 0.75rem; color: #6b7280; display:block; margin-top:0.35rem;">ID desa tempat pesan laporan disimpan ke tabel <code>chat_messages</code> dan diteruskan notifikasi FCM aplikasi.</span>
                    </div>
                </div>

                <div style="display:flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                    <button type="submit" id="btn-save-wa" class="btn btn-primary" style="padding: 0.65rem 1.75rem; border-radius: 0.5rem; background-color: #16a34a; color: white; border:none; font-weight: 700; font-size: 0.9rem; cursor:pointer; display:flex; align-items:center; gap:0.5rem;">
                        <span>💾 Simpan Pengaturan WhatsApp</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. TAB KONFIGURASI VERSI GOOGLE PLAY STORE -->
<!-- ========================================== -->
<div id="tab-content-version" style="display: none;">
    <div class="card" style="max-width: 650px; margin: 0 auto; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); background: #ffffff;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; background: linear-gradient(to right, #ffffff, #f8fafc);">
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background-color: #ecfdf5; display:flex; align-items:center; justify-content:center; color: #059669; font-size: 1.25rem;">
                    📱
                </div>
                <div>
                    <h2 style="font-size: 1.15rem; font-weight: 700; color: #111827; margin:0;">Konfigurasi Google Play Store</h2>
                    <p style="font-size: 0.825rem; color: #6b7280; margin:0.15rem 0 0 0;">Pengaturan rilis versi resmi satu pintu melalui Google Play.</p>
                </div>
            </div>
        </div>
        <div style="padding: 1.5rem;">
            <form id="version-form" onsubmit="saveVersionSettings(event)">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display:block; font-size: 0.85rem; font-weight: 600; margin-bottom:0.4rem; color:#374151;">Versi Terbaru (Latest)</label>
                        <input type="text" id="latestVersion" class="form-control" placeholder="Contoh: 1.10.2" required style="width: 100%; padding: 0.55rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.9rem;">
                        <span style="font-size: 0.725rem; color: #6b7280;">Sesuai rilis di Play Store</span>
                    </div>
                    <div>
                        <label style="display:block; font-size: 0.85rem; font-weight: 600; margin-bottom:0.4rem; color:#374151;">Versi Minimum (Min)</label>
                        <input type="text" id="minVersion" class="form-control" placeholder="Contoh: 1.0.0" required style="width: 100%; padding: 0.55rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.9rem;">
                        <span style="font-size: 0.725rem; color: #6b7280;">Di bawah versi ini wajib update</span>
                    </div>
                </div>

                <!-- Tautan Resmi Google Play Store -->
                <div style="margin-bottom: 1.25rem; padding: 1.25rem; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.75rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color:#1e293b; margin:0; display:flex; align-items:center; gap:0.4rem;">
                            <span>🛒</span> Tautan Resmi Google Play Store
                        </label>
                        <a href="https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id" target="_blank" style="font-size: 0.75rem; color: #4f46e5; text-decoration: none; font-weight: 600;">Lihat di Play Store ↗</a>
                    </div>
                    <input type="url" id="updateUrl" class="form-control" required style="width: 100%; padding: 0.6rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.85rem; background-color:#fff; color:#1e293b;" value="https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id">
                    <p style="font-size: 0.725rem; color: #64748b; margin: 0.4rem 0 0 0;">Semua pembaruan diarahkan satu pintu ke tautan ini. Pengguna dapat memilih <strong>Perbarui</strong> atau <strong>Tunda</strong>.</p>
                </div>

                <!-- Opsi Notifikasi & Force Update -->
                <div style="margin-bottom: 1.25rem; padding: 1rem; background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 0.75rem;">
                    <div style="margin-bottom: 0.75rem;">
                        <label style="display:flex; align-items:center; cursor:pointer;">
                            <input type="checkbox" id="showNotification" style="width:1.2rem; height:1.2rem; margin-right:0.6rem; accent-color: #4f46e5;">
                            <span style="font-size: 0.875rem; font-weight: 600; color:#1e293b;">Tampilkan Konfirmasi Pembaruan di Aplikasi</span>
                        </label>
                        <p style="font-size: 0.75rem; color: #6b7280; margin-left:1.8rem; margin-top:0.2rem; margin-bottom:0;">Menampilkan dialog kecil dan elegan di aplikasi dengan tombol <strong>"Perbarui"</strong> dan <strong>"Nanti"</strong>.</p>
                    </div>
                    <hr style="border:0; border-top:1px dashed #e5e7eb; margin: 0.6rem 0;">
                    <div>
                        <label style="display:flex; align-items:center; cursor:pointer;">
                            <input type="checkbox" id="forceUpdate" style="width:1.2rem; height:1.2rem; margin-right:0.6rem; accent-color: #dc2626;">
                            <span style="font-size: 0.875rem; font-weight: 600; color:#dc2626;">Wajib Update (Tanpa Opsi Tunda)</span>
                        </label>
                        <p style="font-size: 0.75rem; color: #6b7280; margin-left:1.8rem; margin-top:0.2rem; margin-bottom:0;">Aktifkan hanya untuk update kritis/darurat di mana pengguna tidak boleh memakai versi lama sebelum mengupdate.</p>
                    </div>
                </div>

                <!-- Catatan Rilis -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display:block; font-size: 0.85rem; font-weight: 600; margin-bottom:0.4rem; color:#374151;">Catatan Rilis (Release Notes)</label>
                    <textarea id="releaseNotes" class="form-control" rows="3" placeholder="Tuliskan ringkasan pembaruan yang dapat dibaca warga..." style="width: 100%; padding: 0.6rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;"></textarea>
                </div>

                <div style="display:flex; justify-content: flex-end;">
                    <button type="submit" id="btn-save-version" class="btn btn-primary" style="padding: 0.65rem 1.5rem; border-radius: 0.5rem; background-color: #4f46e5; color: white; border:none; font-weight: 600; font-size: 0.875rem; cursor:pointer; display:flex; align-items:center; gap:0.5rem;">
                        <span>💾 Simpan Pengaturan Versi</span>
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

    function switchTab(tab) {
        const btnWa = document.getElementById('tab-btn-wa');
        const btnVer = document.getElementById('tab-btn-version');
        const contentWa = document.getElementById('tab-content-wa');
        const contentVer = document.getElementById('tab-content-version');

        if (tab === 'wa') {
            btnWa.style.backgroundColor = '#25d366';
            btnWa.style.color = '#ffffff';
            btnWa.style.borderColor = 'transparent';

            btnVer.style.backgroundColor = '#ffffff';
            btnVer.style.color = '#4b5563';
            btnVer.style.borderColor = '#d1d5db';

            contentWa.style.display = 'block';
            contentVer.style.display = 'none';
        } else {
            btnVer.style.backgroundColor = '#4f46e5';
            btnVer.style.color = '#ffffff';
            btnVer.style.borderColor = 'transparent';

            btnWa.style.backgroundColor = '#ffffff';
            btnWa.style.color = '#4b5563';
            btnWa.style.borderColor = '#d1d5db';

            contentWa.style.display = 'none';
            contentVer.style.display = 'block';
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
                document.getElementById('wa-enabled').checked = (d.isEnabled !== false);

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
        btn.textContent = 'Menyimpan ke Database...';

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
            btn.innerHTML = '<span>💾 Simpan Pengaturan WhatsApp</span>';
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
        btn.textContent = 'Menyimpan...';
        
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
            btn.innerHTML = '<span>💾 Simpan Pengaturan Versi</span>';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadWaGroupSettings();
        loadVersionSettings();
    });
</script>
<?= $this->endSection() ?>
