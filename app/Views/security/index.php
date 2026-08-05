<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<style>
    /* ===== SECURITY PAGE - PREMIUM DESIGN ===== */
    .menu-wrap {
        width: 100%;
    }

    /* Hero Header */
    .page-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
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
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .hero-text h1 { margin: 0 0 0.35rem 0; font-size: 1.75rem; font-weight: 700; letter-spacing: -0.02em; }
    .hero-text p { margin: 0; opacity: 0.8; font-size: 0.95rem; }

    /* Action Cards */
    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .action-card {
        background: white;
        border-radius: 1rem;
        border: 1px solid #e5e7eb;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
    }

    .action-icon {
        width: 48px; height: 48px;
        border-radius: 0.75rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .icon-backup { background: #dbeafe; color: #2563eb; }
    .icon-clear { background: #fee2e2; color: #dc2626; }

    .action-card h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1.15rem;
        font-weight: 700;
        color: #1f2937;
    }

    .action-card p {
        margin: 0 0 1.5rem 0;
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.5;
        flex-grow: 1;
    }

    .btn {
        padding: 0.75rem 1.25rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
    }
    .btn-primary { background: #4f46e5; color: white; }
    .btn-primary:hover { background: #4338ca; box-shadow: 0 4px 6px -1px rgba(79,70,229,0.2); }
    .btn-danger { background: #ef4444; color: white; }
    .btn-danger:hover { background: #dc2626; box-shadow: 0 4px 6px -1px rgba(239,68,68,0.2); }
    .btn:disabled { opacity: 0.6; cursor: not-allowed; }

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="menu-wrap">
    
    <div class="page-hero">
        <div class="hero-text">
            <h1>Keamanan & Backup</h1>
            <p>Kelola keamanan sistem, pencadangan database, dan pembersihan file sementara secara langsung.</p>
        </div>
    </div>
    
    <div class="action-grid">
        <!-- Database Backup -->
        <div class="action-card">
            <div class="action-icon icon-backup"><i class="fa-solid fa-database"></i></div>
            <h3>Pencadangan Database</h3>
            <p>Unduh file <strong>.sql</strong> yang berisi seluruh skema dan isi tabel dari database aplikasi. Lakukan ini secara rutin agar data Anda aman jika terjadi hal yang tidak diinginkan.</p>
            <button class="btn btn-primary" id="btn-backup" onclick="downloadBackup()">
                <i class="fa-solid fa-download"></i> Unduh File Backup
            </button>
        </div>

        <!-- Clear Logs/Cache -->
        <div class="action-card">
            <div class="action-icon icon-clear"><i class="fa-solid fa-trash-can"></i></div>
            <h3>Bersihkan File Sementara</h3>
            <p>Sistem backend terkadang menghasilkan file sementara atau log saat sedang berjalan. Hapus file-file ini secara berkala untuk menjaga kapasitas penyimpanan server agar tetap lega.</p>
            <button class="btn btn-danger" id="btn-clear" onclick="clearSystemCache()">
                <i class="fa-solid fa-broom"></i> Bersihkan Sistem
            </button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    async function downloadBackup() {
        const btn = document.getElementById('btn-backup');
        
        // Konfirmasi
        const result = await Swal.fire({
            title: 'Unduh Backup',
            text: 'Mempersiapkan file backup database mungkin memakan waktu beberapa detik. Lanjutkan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Unduh',
            cancelButtonText: 'Batal'
        });
        
        if (!result.isConfirmed) return;

        btn.disabled = true;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Menyiapkan...';
        
        try {
            const res = await fetch(`${API_URL}/security/backup`, {
                headers: { 'Authorization': `Bearer ${FIREBASE_ID_TOKEN}` }
            });
            
            if (!res.ok) {
                let errorMsg = 'Gagal melakukan backup';
                try {
                    const errorData = await res.json();
                    errorMsg = errorData.message || errorMsg;
                } catch(e) {}
                throw new Error(errorMsg);
            }
            
            // Convert stream to blob
            const blob = await res.blob();
            
            // Ambil filename dari header disposition jika ada, atau buat manual
            let filename = `backup-jimpitan-${new Date().toISOString().slice(0,10)}.sql`;
            const disposition = res.headers.get('Content-Disposition');
            if (disposition && disposition.indexOf('attachment') !== -1) {
                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                var matches = filenameRegex.exec(disposition);
                if (matches != null && matches[1]) { 
                    filename = matches[1].replace(/['"]/g, '');
                }
            }

            // Create temporary download link
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            
            // Clean up
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
            
            showToast('Berhasil', 'Backup database berhasil diunduh.', 'success');
        } catch(e) {
            showAlert('Gagal', e.message, 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    }

    async function clearSystemCache() {
        const btn = document.getElementById('btn-clear');
        
        // Konfirmasi
        const result = await Swal.fire({
            title: 'Bersihkan Sistem?',
            text: 'Proses ini akan menghapus file log dan file temporary dari server. Lanjutkan?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Bersihkan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc2626'
        });
        
        if (!result.isConfirmed) return;

        btn.disabled = true;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Membersihkan...';
        
        try {
            const res = await fetch(`${API_URL}/security/clear-logs`, {
                method: 'POST',
                headers: { 
                    'Authorization': `Bearer ${FIREBASE_ID_TOKEN}`,
                    'Content-Type': 'application/json'
                }
            });
            const data = await res.json();
            
            if(data.success) {
                showToast('Sukses', data.message, 'success');
            } else {
                throw new Error(data.message || 'Gagal membersihkan sistem');
            }
        } catch(e) {
            showAlert('Error', e.message, 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    }
</script>
<?= $this->endSection() ?>
