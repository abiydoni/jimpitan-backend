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
            <div style="margin-bottom: 1.25rem; padding: 1rem; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem;">
                <label style="display:block; font-size: 0.875rem; font-weight: 600; margin-bottom:0.25rem; color:#1e293b;">1. File APK HP Baru (64-bit / ARM64-v8a)</label>
                <p style="font-size: 0.75rem; color: #64748b; margin-bottom: 0.75rem;">Untuk smartphone Android generasi baru (ukuran unduhan lebih ringan & performa maksimal).</p>
                <div style="display:flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <input type="file" id="apkFile" accept=".apk" class="form-control" style="flex:1; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color:#fff;">
                    <button type="button" id="btn-upload" onclick="uploadApk('apkFile', 'updateUrl', 'progressContainer', 'progressBar', 'progressText', 'progressPercent', 'btn-upload')" class="btn btn-secondary" style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #10b981; color: white; border:none; cursor:pointer;">Upload APK Baru</button>
                </div>
                <div id="progressContainer" style="display: none; margin-bottom: 0.75rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                        <span id="progressText" style="font-size: 0.75rem; font-weight: 500; color: #4b5563;">Menyiapkan unggahan...</span>
                        <span id="progressPercent" style="font-size: 0.75rem; font-weight: 600; color: #10b981;">0%</span>
                    </div>
                    <div style="width: 100%; height: 0.5rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                        <div id="progressBar" style="width: 0%; height: 100%; background: linear-gradient(90deg, #10b981, #059669); border-radius: 9999px; transition: width 0.15s ease-out;"></div>
                    </div>
                </div>
                <label style="display:block; font-size: 0.75rem; font-weight: 500; margin-bottom:0.25rem; color:#475569;">URL Unduhan HP Baru (Update URL)</label>
                <input type="url" id="updateUrl" class="form-control" placeholder="https://.../jimpitan-arm64-v8a-release.apk" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;">
            </div>

            <div style="margin-bottom: 1.25rem; padding: 1rem; background-color: #fffbeb; border: 1px solid #fef3c7; border-radius: 0.5rem;">
                <label style="display:block; font-size: 0.875rem; font-weight: 600; margin-bottom:0.25rem; color:#92400e;">2. File APK HP Lama (32-bit / ARMeabi-v7a) - Opsional</label>
                <p style="font-size: 0.75rem; color: #b45309; margin-bottom: 0.75rem;">Khusus untuk smartphone Android tipe lama/32-bit. Aplikasi akan otomatis mendeteksi dan mengunduh link ini jika user memakai HP lama.</p>
                <div style="display:flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <input type="file" id="apkFileLegacy" accept=".apk" class="form-control" style="flex:1; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color:#fff;">
                    <button type="button" id="btn-upload-legacy" onclick="uploadApk('apkFileLegacy', 'updateUrlLegacy', 'progressContainerLegacy', 'progressBarLegacy', 'progressTextLegacy', 'progressPercentLegacy', 'btn-upload-legacy')" class="btn btn-secondary" style="padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #d97706; color: white; border:none; cursor:pointer;">Upload APK Lama</button>
                </div>
                <div id="progressContainerLegacy" style="display: none; margin-bottom: 0.75rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                        <span id="progressTextLegacy" style="font-size: 0.75rem; font-weight: 500; color: #92400e;">Menyiapkan unggahan...</span>
                        <span id="progressPercentLegacy" style="font-size: 0.75rem; font-weight: 600; color: #d97706;">0%</span>
                    </div>
                    <div style="width: 100%; height: 0.5rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                        <div id="progressBarLegacy" style="width: 0%; height: 100%; background: linear-gradient(90deg, #d97706, #b45309); border-radius: 9999px; transition: width 0.15s ease-out;"></div>
                    </div>
                </div>
                <label style="display:block; font-size: 0.75rem; font-weight: 500; margin-bottom:0.25rem; color:#92400e;">URL Unduhan HP Lama (Update URL Legacy)</label>
                <input type="url" id="updateUrlLegacy" class="form-control" placeholder="https://.../jimpitan-armeabi-v7a-release.apk" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;">
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
                document.getElementById('updateUrlLegacy').value = json.data.updateUrlLegacy || '';
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

    async function uploadApk(fileInputId, targetUrlId, progressContainerId, progressBarId, progressTextId, progressPercentId, btnId) {
        const fileInput = document.getElementById(fileInputId);
        if (!fileInput.files || fileInput.files.length === 0) {
            showToast('Peringatan', 'Pilih file APK terlebih dahulu!');
            return;
        }

        const file = fileInput.files[0];
        if (!file.name.toLowerCase().endsWith('.apk')) {
            showToast('Peringatan', 'Hanya file berakhiran .apk yang diperbolehkan!');
            return;
        }

        const btn = document.getElementById(btnId);
        const progressContainer = document.getElementById(progressContainerId);
        const progressBar = document.getElementById(progressBarId);
        const progressText = document.getElementById(progressTextId);
        const progressPercent = document.getElementById(progressPercentId);

        const originalBtnText = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Mengunggah...';

        progressContainer.style.display = 'block';
        progressBar.style.width = '0%';
        progressText.textContent = 'Menyiapkan unggahan...';
        progressPercent.textContent = '0%';

        const token = (typeof getFreshFirebaseToken === 'function') 
            ? await getFreshFirebaseToken() 
            : (typeof FIREBASE_ID_TOKEN !== 'undefined' ? FIREBASE_ID_TOKEN : getFirebaseToken());

        const formData = new FormData();
        formData.append('apk', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', `${API_URL}/config/upload-apk`, true);

        if (token) {
            xhr.setRequestHeader('Authorization', `Bearer ${token}`);
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
            btn.textContent = originalBtnText;

            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    const json = JSON.parse(xhr.responseText);
                    if (json.success && json.data) {
                        document.getElementById(targetUrlId).value = json.data.fileUrl;
                        showToast('Sukses', 'APK berhasil diunggah! URL telah terisi.');
                    } else {
                        showToast('Gagal', json.message || 'Gagal mengunggah APK');
                        progressContainer.style.display = 'none';
                    }
                } catch (err) {
                    showToast('Gagal', 'Respon server tidak valid');
                    progressContainer.style.display = 'none';
                }
            } else if (xhr.status === 401 || xhr.status === 403) {
                showToast('Sesi Berakhir', 'Sesi login telah kedaluwarsa. Silakan refresh halaman atau login ulang.');
                progressContainer.style.display = 'none';
            } else {
                showToast('Gagal', `Gagal mengunggah APK (Status ${xhr.status})`);
                progressContainer.style.display = 'none';
            }
            fileInput.value = '';
        };

        xhr.onerror = function () {
            btn.disabled = false;
            btn.textContent = originalBtnText;
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
            updateUrlLegacy: document.getElementById('updateUrlLegacy').value,
            releaseNotes: document.getElementById('releaseNotes').value,
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
                showToast('Sukses', 'Pengaturan versi berhasil diperbarui!');
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
            btn.textContent = 'Simpan Pengaturan';
        }
    }

    document.addEventListener('DOMContentLoaded', loadSettings);
</script>
<?= $this->endSection() ?>
