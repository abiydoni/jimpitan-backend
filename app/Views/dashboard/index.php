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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="dashboard-header">
        <h2>Dashboard Ringkasan</h2>
        <p>Pantau statistik global dan aktivitas transaksi Jimpitan hari ini secara real-time.</p>
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
        
        <!-- Panel Grafik -->
        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">Tren Pemasukan Jimpitan (7 Hari Terakhir)</h3>
            </div>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="jimpitanChart"></canvas>
            </div>
        </div>

        <!-- Panel Tabel -->
        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">Aktivitas Jurnal Terbaru</h3>
            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Jenis</th>
                            <th>Nominal</th>
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

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    function formatDateShort(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', hour: '2-digit', minute: '2-digit' });
    }

    function renderChart(chartData) {
        const ctx = document.getElementById('jimpitanChart').getContext('2d');
        
        const labels = chartData.map(d => d.label);
        const data = chartData.map(d => d.value);

        // Jika grafik sudah ada, perbarui datanya
        if (chartInstance) {
            chartInstance.data.labels = labels;
            chartInstance.data.datasets[0].data = data;
            chartInstance.update();
            return;
        }

        // Buat gradien untuk area di bawah garis
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.2)');
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pemasukan Jimpitan (Rp)',
                    data: data,
                    borderColor: '#4f46e5',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4f46e5',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4 // Membuat garis melengkung elegan
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
                                return formatRupiah(context.raw);
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
                            callback: function(value) {
                                if (value >= 1000000) return (value / 1000000) + 'Jt';
                                if (value >= 1000) return (value / 1000) + 'k';
                                return value;
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
                            maxTicksLimit: 7
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

    async function fetchDashboardStats() {
        try {
            const res = await fetch(`${DASHBOARD_API_URL}/superadmin/summary`);
            const json = await res.json();

            if (json.success) {
                const data = json.data;
                
                // Update Metrik Utama
                if (document.getElementById('stat-desa')) {
                    document.getElementById('stat-desa').innerText = data.totalVillages.toLocaleString('id-ID');
                }
                document.getElementById('stat-warga').innerText = data.totalUsers.toLocaleString('id-ID');
                document.getElementById('stat-jimpitan').innerText = formatRupiah(data.totalJimpitan);
                document.getElementById('stat-pending').innerText = data.pendingReports.toLocaleString('id-ID');

                // Render Chart jika data tersedia
                if (data.chartData && data.chartData.length > 0) {
                    renderChart(data.chartData);
                }

                // Render Tabel Aktivitas
                const tbody = document.getElementById('table-activities');
                tbody.innerHTML = '';

                if (data.recentActivities && data.recentActivities.length > 0) {
                    // Batasi ke 6 aktivitas terbaru saja agar pas di panel
                    const limitedActs = data.recentActivities.slice(0, 6);
                    limitedActs.forEach(act => {
                        const tr = document.createElement('tr');
                        const isIncome = act.type && act.type.toLowerCase() === 'pemasukan';
                        
                        tr.innerHTML = `
                            <td style="color: #6b7280;">${formatDateShort(act.createdAt)}</td>
                            <td><span class="badge-type ${isIncome ? 'type-in' : 'type-out'}">${act.type || 'N/A'}</span></td>
                            <td style="font-weight: 600; color: ${isIncome ? '#059669' : '#dc2626'}">
                                ${isIncome ? '+' : '-'}${formatRupiah(act.amount)}
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="3" style="text-align: center; color: #9ca3af; padding: 2rem 0;">Belum ada aktivitas.</td></tr>';
                }
            } else {
                showToast('Error', 'Gagal memuat statistik dari server.');
            }
        } catch (error) {
            console.error("Gagal menarik data super admin:", error);
            const errHtml = '<span style="color:#dc2626; font-size:0.85rem;">Error</span>';
            if (document.getElementById('stat-desa')) document.getElementById('stat-desa').innerHTML = errHtml;
            document.getElementById('stat-warga').innerHTML = errHtml;
            document.getElementById('stat-jimpitan').innerHTML = errHtml;
            document.getElementById('stat-pending').innerHTML = errHtml;
            document.getElementById('table-activities').innerHTML = '<tr><td colspan="3" style="text-align: center; color: #dc2626; padding: 2rem 0;">Koneksi ke API terputus.</td></tr>';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        fetchDashboardStats();
        // Update statistik setiap 60 detik (menghemat resource)
        setInterval(fetchDashboardStats, 60000);
    });
</script>
<?= $this->endSection() ?>
