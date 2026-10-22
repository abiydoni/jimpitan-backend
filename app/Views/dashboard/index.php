<?= $this->extend('layout/main') ?>

<?= $this->section('styles') ?>
<!-- Memuat Chart.js dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Styling Elegan & Premium */
    .dashboard-header {
        margin-bottom: 2rem;
    }
    
    .dashboard-header h2 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        letter-spacing: -0.02em;
    }
    
    .dashboard-header p {
        color: #6b7280;
        font-size: 0.8125rem;
        margin-top: 0.35rem;
    }

    /* Grid Kartu Statistik */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(229, 231, 235, 0.5);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
    }

    .stat-icon.primary { background: #e0e7ff; color: #4f46e5; }
    .stat-icon.purple { background: #f3e8ff; color: #7e22ce; }
    .stat-icon.success { background: #dcfce7; color: #15803d; }
    .stat-icon.warning { background: #fef3c7; color: #b45309; }

    .stat-content {
        flex: 1;
    }

    .stat-label {
        color: #6b7280;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 1.35rem;
        font-weight: 700;
        color: #111827;
        line-height: 1.2;
    }

    /* Layout Bawah: Grafik & Tabel */
    .dashboard-bottom {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 992px) {
        .dashboard-bottom {
            grid-template-columns: 1fr;
        }
    }

    .panel {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(229, 231, 235, 0.5);
        padding: 1.25rem;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .panel-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    /* Tabel Aktivitas Premium */
    .table-container {
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table th, .table td {
        padding: 0.75rem 0.5rem;
        text-align: left;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.75rem;
    }
    
    .table th {
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .table tbody tr:hover {
        background-color: #f9fafb;
    }
    
    .badge-type {
        padding: 0.2rem 0.6rem;
        border-radius: 9999px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .type-in { background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
    .type-out { background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    
    /* Skeleton Loading */
    .loading-skeleton {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        height: 1.5rem;
        background-color: #e5e7eb;
        border-radius: 0.25rem;
        width: 60%;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .5; }
    }

    /* Toggle Periode Grafik Registrasi */
    .period-toggle-group {
        display: flex;
        background: #f1f5f9;
        padding: 3px;
        border-radius: 8px;
        gap: 2px;
    }

    .btn-period {
        background: transparent;
        border: none;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-period:hover {
        color: #1e293b;
    }

    .btn-period.active {
        background: #ffffff;
        color: #4f46e5;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="dashboard-header">
        <h2>Dashboard Ringkasan</h2>
        <p>Pantau statistik global dan aktivitas registrasi desa serta transaksi Jimpitan secara real-time.</p>
    </div>

    <!-- Metrik Utama -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon primary"><i class="fa-solid fa-map-location-dot"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Desa</div>
                <div class="stat-value" id="stat-desa"><div class="loading-skeleton"></div></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple"><i class="fa-solid fa-users"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Warga</div>
                <div class="stat-value" id="stat-warga"><div class="loading-skeleton"></div></div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon success"><i class="fa-solid fa-sack-dollar"></i></div>
            <div class="stat-content">
                <div class="stat-label">Jimpitan Bulan Ini</div>
                <div class="stat-value" id="stat-jimpitan"><div class="loading-skeleton" style="width: 80%"></div></div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon warning"><i class="fa-solid fa-file-invoice"></i></div>
            <div class="stat-content">
                <div class="stat-label">Total Jurnal (All)</div>
                <div class="stat-value" id="stat-pending"><div class="loading-skeleton"></div></div>
            </div>
        </div>
    </div>

    <!-- Bagian Grafik & Tabel -->
    <div class="dashboard-bottom">
        
        <!-- Panel Grafik Registrasi Desa -->
        <div class="panel">
            <div class="panel-header" style="align-items: flex-start; flex-wrap: wrap; gap: 0.75rem;">
                <div>
                    <h3 class="panel-title" style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="display: inline-flex; width: 28px; height: 28px; background: #e0e7ff; color: #4f46e5; border-radius: 8px; align-items: center; justify-content: center; font-size: 0.85rem;">
                            <i class="fa-solid fa-chart-line"></i>
                        </span>
                        Grafik Registrasi Desa per Hari
                    </h3>
                    <p id="chart-summary-subtitle" style="color: #6b7280; font-size: 0.75rem; margin: 0.25rem 0 0 0;">
                        Memuat data tren registrasi...
                    </p>
                </div>
                <div class="period-toggle-group">
                    <button type="button" class="btn-period active" onclick="setChartPeriod(7, this)">7 Hari</button>
                    <button type="button" class="btn-period" onclick="setChartPeriod(14, this)">14 Hari</button>
                    <button type="button" class="btn-period" onclick="setChartPeriod(30, this)">30 Hari</button>
                </div>
            </div>
            <div style="position: relative; height: 300px; width: 100%; margin-top: 0.5rem;">
                <canvas id="villageChart"></canvas>
            </div>
        </div>

        <!-- Panel Tabel Pendaftar Desa Terbaru -->
        <div class="panel">
            <div class="panel-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="panel-title" style="display: flex; align-items: center; gap: 0.5rem;">
                    <span style="display: inline-flex; width: 28px; height: 28px; background: #f3e8ff; color: #7e22ce; border-radius: 8px; align-items: center; justify-content: center; font-size: 0.85rem;">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </span>
                    Aktivitas Pendaftar Terbaru
                </h3>
                <a href="<?= base_url('/villages') ?>" style="font-size: 0.75rem; color: #4f46e5; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 0.25rem;">
                    Lihat Semua <i class="fa-solid fa-arrow-right" style="font-size: 0.65rem;"></i>
                </a>
            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Waktu Daftar</th>
                            <th>Nama Desa</th>
                            <th>Kode Unik</th>
                        </tr>
                    </thead>
                    <tbody id="table-activities">
                        <tr><td colspan="3" style="text-align: center; color: #9ca3af; padding: 2rem 0;">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const DASHBOARD_API_URL = API_URL + '/dashboard';
    let chartInstance = null; // Menyimpan instansi grafik Chart.js
    let selectedDays = 7;

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    function formatDateShort(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', hour: '2-digit', minute: '2-digit' });
    }

    function renderRecentVillagesTable(villages) {
        const tbody = document.getElementById('table-activities');
        if (!tbody) return;
        tbody.innerHTML = '';

        if (villages && villages.length > 0) {
            // Urutkan berdasarkan createdAt DESC jika ada
            const sorted = [...villages].sort((a, b) => {
                const dateA = a.createdAt ? new Date(a.createdAt).getTime() : 0;
                const dateB = b.createdAt ? new Date(b.createdAt).getTime() : 0;
                return dateB - dateA;
            });

            const limited = sorted.slice(0, 6);
            limited.forEach(v => {
                const tr = document.createElement('tr');
                const safeName = (v.name || 'Desa Tanpa Nama').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                const safeCode = (v.uniqueCode || '-').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                const safeAddress = v.address ? v.address.replace(/</g, '&lt;').replace(/>/g, '&gt;') : '';
                const dateFormatted = v.createdAt ? formatDateShort(v.createdAt) : '-';

                tr.innerHTML = `
                    <td style="color: #6b7280; white-space: nowrap;">
                        <i class="fa-regular fa-calendar-check" style="margin-right: 4px; font-size: 0.75rem; color: #94a3b8;"></i>
                        ${dateFormatted}
                    </td>
                    <td>
                        <div style="font-weight: 600; color: #111827;">${safeName}</div>
                        ${safeAddress ? `<div style="font-size: 0.7rem; color: #9ca3af; margin-top: 1px;">${safeAddress}</div>` : ''}
                    </td>
                    <td>
                        <span style="display:inline-block; padding:0.2rem 0.5rem; border-radius:4px; background:#eef2ff; color:#4f46e5; font-weight:700; font-family:monospace; font-size:0.75rem; border:1px solid #c7d2fe;">
                            ${safeCode}
                        </span>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        } else {
            tbody.innerHTML = '<tr><td colspan="3" style="text-align: center; color: #9ca3af; padding: 2rem 0;">Belum ada data pendaftar desa.</td></tr>';
        }
    }

    async function fetchVillagesFallback() {
        try {
            const res = await fetch(`${API_URL}/master/villages`);
            if (res.ok) {
                const j = await res.json();
                if (j.success && Array.isArray(j.data) && j.data.length > 0) {
                    renderRecentVillagesTable(j.data);
                    return;
                }
            }
        } catch (e) {}

        try {
            const localRes = await fetch(`<?= base_url('/wa_blast/villages') ?>`);
            if (localRes.ok) {
                const localJ = await localRes.json();
                if (localJ.success && Array.isArray(localJ.data) && localJ.data.length > 0) {
                    renderRecentVillagesTable(localJ.data);
                    return;
                }
            }
        } catch (e) {}

        renderRecentVillagesTable([]);
    }

    function renderChart(chartData) {
        const canvas = document.getElementById('villageChart') || document.getElementById('jimpitanChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        
        const labels = chartData.map(d => d.label);
        const data = chartData.map(d => Number(d.value) || 0);

        // Update Subtitle ringkasan
        const totalRegistrations = data.reduce((a, b) => a + b, 0);
        const subtitleEl = document.getElementById('chart-summary-subtitle');
        if (subtitleEl) {
            subtitleEl.innerHTML = `Total <strong style="color: #4f46e5;">${totalRegistrations} desa</strong> terdaftar dalam ${selectedDays} hari terakhir.`;
        }

        // Jika grafik sudah ada, perbarui datanya
        if (chartInstance) {
            chartInstance.data.labels = labels;
            chartInstance.data.datasets[0].data = data;
            chartInstance.data.datasets[0].label = `Registrasi Desa (${selectedDays} Hari)`;
            chartInstance.update();
            return;
        }

        // Buat gradien untuk area di bawah garis
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.25)');
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0.01)');

        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: `Registrasi Desa (${selectedDays} Hari)`,
                    data: data,
                    borderColor: '#4f46e5',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4f46e5',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.35 // Garis melengkung elegan
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleFont: { size: 11, family: 'Inter' },
                        bodyFont: { size: 12, family: 'Inter', weight: 'bold' },
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return `${context.raw} Desa Terdaftar`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false,
                        },
                        ticks: {
                            font: { size: 10 },
                            color: '#9ca3af',
                            precision: 0,
                            stepSize: 1,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value + ' Desa';
                                }
                                return '';
                            }
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: {
                            font: { size: 10 },
                            color: '#9ca3af',
                            maxRotation: 0,
                            autoSkip: true,
                            maxTicksLimit: 10
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    }

    async function fetchDashboardStats(days = selectedDays) {
        selectedDays = days;
        let json = null;

        // 1. Coba fetch dari API_URL server (jimpitan-server)
        try {
            const res = await fetch(`${DASHBOARD_API_URL}/superadmin/summary?days=${days}`);
            if (res.ok) {
                json = await res.json();
            }
        } catch (error) {
            console.warn("Fetch dari DASHBOARD_API_URL gagal, mencoba fallback lokal:", error);
        }

        // 2. Fallback ke endpoint CodeIgniter lokal jika API_URL tidak merespons
        if (!json || !json.success) {
            try {
                const localRes = await fetch(`<?= base_url('/dashboard/summary') ?>?days=${days}`);
                if (localRes.ok) {
                    json = await localRes.json();
                }
            } catch (errLocal) {
                console.warn("Fetch lokal juga gagal:", errLocal);
            }
        }

        if (json && json.success) {
            const data = json.data;
            
            // Update Metrik Utama
            if (document.getElementById('stat-desa')) {
                document.getElementById('stat-desa').innerText = (data.totalVillages || 0).toLocaleString('id-ID');
            }
            document.getElementById('stat-warga').innerText = (data.totalUsers || 0).toLocaleString('id-ID');
            document.getElementById('stat-jimpitan').innerText = formatRupiah(data.totalJimpitan || 0);
            document.getElementById('stat-pending').innerText = (data.pendingReports || 0).toLocaleString('id-ID');

            // Render Chart jika data tersedia
            const chartData = data.chartData || data.villageChartData;
            if (chartData && chartData.length > 0) {
                renderChart(chartData);
            }

            // Render Tabel Aktivitas Pendaftar Terbaru
            if (data.recentVillages && data.recentVillages.length > 0) {
                renderRecentVillagesTable(data.recentVillages);
            } else {
                // Ambil daftar desa terbaru dari fallback endpoint
                fetchVillagesFallback();
            }
        } else {
            console.error("Gagal menarik data super admin.");
            const errHtml = '<span style="color:#dc2626; font-size:0.85rem;">Error</span>';
            if (document.getElementById('stat-desa')) document.getElementById('stat-desa').innerHTML = errHtml;
            document.getElementById('stat-warga').innerHTML = errHtml;
            document.getElementById('stat-jimpitan').innerHTML = errHtml;
            document.getElementById('stat-pending').innerHTML = errHtml;
            document.getElementById('table-activities').innerHTML = '<tr><td colspan="3" style="text-align: center; color: #dc2626; padding: 2rem 0;">Koneksi ke API terputus.</td></tr>';
        }
    }

    function setChartPeriod(days, btn) {
        selectedDays = days;
        document.querySelectorAll('.btn-period').forEach(b => b.classList.remove('active'));
        if (btn) btn.classList.add('active');
        fetchDashboardStats(days);
    }

    document.addEventListener('DOMContentLoaded', () => {
        fetchDashboardStats();
        // Update statistik setiap 60 detik (menghemat resource)
        setInterval(() => fetchDashboardStats(selectedDays), 60000);
    });
</script>
<?= $this->endSection() ?>
