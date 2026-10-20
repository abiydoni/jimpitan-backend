<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <h1 class="page-title">Pengaturan Versi Aplikasi</h1>
</div>

<div class="card" style="max-width: 620px; margin: 0 auto; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);">
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
        <form id="version-form" onsubmit="saveSettings(event)">
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
                <button type="submit" id="btn-save" class="btn btn-primary" style="padding: 0.65rem 1.5rem; border-radius: 0.5rem; background-color: #4f46e5; color: white; border:none; font-weight: 600; font-size: 0.875rem; cursor:pointer; display:flex; align-items:center; gap:0.5rem;">
                    <span>💾 Simpan Pengaturan</span>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const DEFAULT_PLAY_STORE_URL = 'https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id';

    async function loadSettings() {
        try {
            const res = await fetch(`${API_URL}/config/version`);
            const json = await res.json();
            
            if (json.success && json.data) {
                document.getElementById('latestVersion').value = json.data.latestVersion || '';
                document.getElementById('minVersion').value = json.data.minVersion || '';
                
                // Gunakan URL Play Store default jika kosong atau link lama
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
            console.error('Error loading settings:', error);
            showToast('Error', 'Gagal memuat pengaturan versi');
        }
    }

    async function saveSettings(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-save');
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';
        
        const payload = {
            latestVersion: document.getElementById('latestVersion').value.trim(),
            minVersion: document.getElementById('minVersion').value.trim(),
            updateUrl: document.getElementById('updateUrl').value.trim() || DEFAULT_PLAY_STORE_URL,
            updateUrlLegacy: '', // Dihapus karena satu pintu via Play Store
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
            btn.innerHTML = '<span>💾 Simpan Pengaturan</span>';
        }
    }

    document.addEventListener('DOMContentLoaded', loadSettings);
</script>
<?= $this->endSection() ?>
