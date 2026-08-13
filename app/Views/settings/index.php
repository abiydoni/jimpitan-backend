<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <h1 class="page-title">Pengaturan Versi Aplikasi</h1>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
        <h2 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin:0;">Konfigurasi Pembaruan (Update)</h2>
        <p style="font-size: 0.875rem; color: #6b7280; margin-top:0.25rem;">Atur versi aplikasi dan tautan unduhan untuk dikirim ke pengguna.</p>
    </div>
    <div style="padding: 1.5rem;">
        <form id="version-form" onsubmit="saveSettings(event)">
            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-size: 0.875rem; font-weight: 500; margin-bottom:0.5rem; color:#374151;">Versi Terbaru (Latest Version)</label>
                <input type="text" id="latestVersion" class="form-control" placeholder="Contoh: 1.9.4" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-size: 0.875rem; font-weight: 500; margin-bottom:0.5rem; color:#374151;">Versi Minimum (Min Version)</label>
                <input type="text" id="minVersion" class="form-control" placeholder="Contoh: 1.0.0" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-size: 0.875rem; font-weight: 500; margin-bottom:0.5rem; color:#374151;">Upload File APK Baru (Opsional)</label>
                <div style="display:flex; gap: 0.5rem;">
                    <input type="file" id="apkFile" accept=".apk" class="form-control" style="flex:1; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color:#fff;">
                    <button type="button" id="btn-upload" onclick="uploadApk()" class="btn btn-secondary" style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #10b981; color: white; border:none; cursor:pointer;">Upload APK</button>
                </div>
                <div id="progressContainer" style="display: none; margin-top: 0.75rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                        <span id="progressText" style="font-size: 0.75rem; font-weight: 500; color: #4b5563;">Menyiapkan unggahan...</span>
                        <span id="progressPercent" style="font-size: 0.75rem; font-weight: 600; color: #10b981;">0%</span>
                    </div>
                    <div style="width: 100%; height: 0.5rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                        <div id="progressBar" style="width: 0%; height: 100%; background: linear-gradient(90deg, #10b981, #059669); border-radius: 9999px; transition: width 0.15s ease-out;"></div>
                    </div>
                </div>
                <p style="font-size: 0.75rem; color: #6b7280; margin-top:0.25rem;">Jika berhasil, URL di bawah akan terisi otomatis.</p>
            </div>
            
            <div style="margin-bottom: 1rem;">
                <label style="display:block; font-size: 0.875rem; font-weight: 500; margin-bottom:0.5rem; color:#374151;">URL Unduhan (Update URL)</label>
                <input type="url" id="updateUrl" class="form-control" placeholder="https://play.google.com/... atau URL APK" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display:flex; align-items:center; cursor:pointer;">
                    <input type="checkbox" id="showNotification" style="width:1.25rem; height:1.25rem; margin-right:0.5rem;">
                    <span style="font-size: 0.875rem; font-weight: 500; color:#2563eb;">Tampilkan Notifikasi Pop-Up Update</span>
                </label>
                <p style="font-size: 0.75rem; color: #6b7280; margin-left:1.75rem; margin-top:0.25rem;">Centang ini untuk memunculkan pop-up notifikasi update secara otomatis di aplikasi Flutter saat pengguna masuk ke dashboard.</p>
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display:flex; align-items:center; cursor:pointer;">
                    <input type="checkbox" id="forceUpdate" style="width:1.25rem; height:1.25rem; margin-right:0.5rem;">
                    <span style="font-size: 0.875rem; font-weight: 500; color:#dc2626;">Wajib Update (Force Update)</span>
                </label>
                <p style="font-size: 0.75rem; color: #6b7280; margin-left:1.75rem; margin-top:0.25rem;">Centang ini jika pengguna tidak diizinkan memakai aplikasi sebelum update.</p>
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display:block; font-size: 0.875rem; font-weight: 500; margin-bottom:0.5rem; color:#374151;">Catatan Rilis (Release Notes)</label>
                <textarea id="releaseNotes" class="form-control" rows="3" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;"></textarea>
            </div>
            <div style="text-align: right;">
                <button type="submit" id="btn-save" class="btn btn-primary" style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #4f46e5; color: white; border:none; cursor:pointer;">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    async function loadSettings() {
        try {
            const res = await fetch(`${API_URL}/config/version`);
            const json = await res.json();
            
            if (json.success && json.data) {
                document.getElementById('latestVersion').value = json.data.latestVersion || '';
                document.getElementById('minVersion').value = json.data.minVersion || '';
                document.getElementById('updateUrl').value = json.data.updateUrl || '';
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

    function uploadApk() {
        const fileInput = document.getElementById('apkFile');
        if (!fileInput.files || fileInput.files.length === 0) {
            showToast('Peringatan', 'Pilih file APK terlebih dahulu!');
            return;
        }

        const file = fileInput.files[0];
        if (!file.name.toLowerCase().endsWith('.apk')) {
            showToast('Peringatan', 'Hanya file berakhiran .apk yang diperbolehkan!');
            return;
        }

        const btn = document.getElementById('btn-upload');
        const progressContainer = document.getElementById('progressContainer');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const progressPercent = document.getElementById('progressPercent');

        btn.disabled = true;
        btn.textContent = 'Mengunggah...';

        progressContainer.style.display = 'block';
        progressBar.style.width = '0%';
        progressText.textContent = 'Menyiapkan unggahan...';
        progressPercent.textContent = '0%';

        const formData = new FormData();
        formData.append('apk', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', `${API_URL}/config/upload-apk`, true);

        if (typeof FIREBASE_ID_TOKEN !== 'undefined' && FIREBASE_ID_TOKEN) {
            xhr.setRequestHeader('Authorization', `Bearer ${FIREBASE_ID_TOKEN}`);
        }

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                const loadedMB = (e.loaded / (1024 * 1024)).toFixed(1);
                const totalMB = (e.total / (1024 * 1024)).toFixed(1);

                progressBar.style.width = percent + '%';
                progressText.textContent = `Mengunggah APK: ${loadedMB} MB / ${totalMB} MB`;
                progressPercent.textContent = percent + '%';
            }
        };

        xhr.onload = function () {
            btn.disabled = false;
            btn.textContent = 'Upload APK';

            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    const json = JSON.parse(xhr.responseText);
                    if (json.success && json.data) {
                        document.getElementById('updateUrl').value = json.data.fileUrl;
                        showToast('Sukses', 'APK berhasil diunggah! Menyimpan pengaturan secara otomatis...');
                        setTimeout(() => {
                            document.getElementById('btn-save').click();
                        }, 500);
                    } else {
                        showToast('Gagal', json.message || 'Gagal mengunggah APK');
                        progressContainer.style.display = 'none';
                    }
                } catch (err) {
                    showToast('Gagal', 'Respon server tidak valid');
                    progressContainer.style.display = 'none';
                }
            } else {
                showToast('Gagal', `Gagal mengunggah APK (Status ${xhr.status})`);
                progressContainer.style.display = 'none';
            }
            fileInput.value = '';
        };

        xhr.onerror = function () {
            btn.disabled = false;
            btn.textContent = 'Upload APK';
            showToast('Error', 'Koneksi ke server gagal saat upload APK');
            progressContainer.style.display = 'none';
            fileInput.value = '';
        };

        xhr.send(formData);
    }

    async function saveSettings(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-save');
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';
        
        const payload = {
            latestVersion: document.getElementById('latestVersion').value,
            minVersion: document.getElementById('minVersion').value,
            updateUrl: document.getElementById('updateUrl').value,
            releaseNotes: document.getElementById('releaseNotes').value,
            forceUpdate: document.getElementById('forceUpdate').checked,
            showNotification: document.getElementById('showNotification').checked
        };
        
        try {
            const res = await fetch(`${API_URL}/config/version`, {
                method: 'PUT',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${FIREBASE_ID_TOKEN}` // asumsi ada global var FIREBASE_ID_TOKEN
                },
                body: JSON.stringify(payload)
            });
            const json = await res.json();
            
            if (json.success) {
                showToast('Sukses', 'Pengaturan versi berhasil diperbarui!');
            } else {
                showToast('Gagal', json.message || 'Terjadi kesalahan saat menyimpan');
            }
        } catch (error) {
            console.error('Error saving settings:', error);
            showToast('Error', 'Koneksi ke server gagal');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Simpan Pengaturan';
        }
    }

    document.addEventListener('DOMContentLoaded', loadSettings);
</script>
<?= $this->endSection() ?>
