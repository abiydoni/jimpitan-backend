<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jimpitan Admin | <?= $title ?? 'Dashboard' ?></title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Firebase SDK (untuk token auto-refresh) -->
    <script type="module">
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js';
        import { getAuth, onAuthStateChanged } from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js';

        const firebaseConfig = {
            apiKey: "AIzaSyBAomOJD7Y-ky3k7yxhMzBHrVOcS4Xv0O4",
            authDomain: "jimpitan-9dd06.firebaseapp.com",
            projectId: "jimpitan-9dd06",
            storageBucket: "jimpitan-9dd06.appspot.com",
            messagingSenderId: "230006065254",
            appId: "1:230006065254:web:4c95ce03276ac70e60c5a7"
        };

        const fbApp = initializeApp(firebaseConfig, 'layout-app');
        const fbAuth = getAuth(fbApp);

        // Auto-refresh token setiap kali Firebase memperbarui sesi
        onAuthStateChanged(fbAuth, async (user) => {
            if (user) {
                try {
                    const freshToken = await user.getIdToken(false); // Ambil token (refresh jika perlu)
                    const stored = JSON.parse(localStorage.getItem('jimpitan_admin_user') || '{}');
                    // Perbarui token dan perpanjang expiry
                    stored.token = freshToken;
                    stored.tokenExpiry = Date.now() + (55 * 60 * 1000);
                    localStorage.setItem('jimpitan_admin_user', JSON.stringify(stored));
                    // Update variabel global jika sudah ada
                    if (typeof window !== 'undefined') {
                        window._freshToken = freshToken;
                    }
                } catch(e) {
                    console.warn('Token refresh gagal:', e);
                }
            }
        });
    </script>
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --sidebar-bg: #1e1b4b;
            --sidebar-text: #c7d2fe;
            --sidebar-active: #3730a3;
            --bg-color: #f3f4f6;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --card-bg: #ffffff;
            --danger: #ef4444;
            --success: #10b981;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            font-size: 14px; /* Default size diperkecil */
            background-color: var(--bg-color);
            color: var(--text-dark);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #17153a 100%);
            color: white;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #a855f7);
            z-index: 10;
        }
        
        .sidebar-deco {
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, rgba(30,27,75,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-list {
            list-style: none;
            padding: 1rem 0;
            margin: 0;
            flex: 1;
        }

        .nav-item {
            padding: 0 1rem;
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.2s;
            font-weight: 500;
            position: relative;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: white;
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(90deg, var(--sidebar-active) 0%, rgba(55,48,163,0) 100%);
            color: white;
            border-left: 3px solid #8b5cf6;
        }

        .nav-icon {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .topbar {
            height: 70px;
            background-color: var(--card-bg);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 10;
        }

        .topbar-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        /* Badge */
        .badge {
            background-color: var(--danger);
            color: white;
            padding: 0.1rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            display: none;
        }

        /* Khusus layout halaman yang butuh full-height tanpa padding (seperti chat) */
        .content.no-padding {
            padding: 0;
        }

        /* Utility classes */
        .card {
            background: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }
    </style>
    
    <!-- Render custom styles from sub-views -->
    <?= $this->renderSection('styles') ?>

    <!-- Auth Guard: cek sesi Firebase sebelum halaman dimuat -->
    <script>
        (function() {
            const raw = localStorage.getItem('jimpitan_admin_user');
            if (!raw) {
                // Belum login, redirect ke halaman login
                window.location.replace('/login');
                return;
            }
            try {
                const user = JSON.parse(raw);
                // Cek apakah token masih valid (55 menit)
                if (!user.token || Date.now() > user.tokenExpiry) {
                    localStorage.removeItem('jimpitan_admin_user');
                    window.location.replace('/login');
                }
            } catch(e) {
                localStorage.removeItem('jimpitan_admin_user');
                window.location.replace('/login');
            }
        })();
    </script>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-deco"></div>
        <div class="sidebar-brand">
            <i class="fa-solid fa-leaf"></i> Jimpitan
        </div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="<?= base_url('/') ?>" class="nav-link <?= (url_is('/')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-house nav-icon"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/chat') ?>" class="nav-link <?= (url_is('chat*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-comments nav-icon"></i>
                    <span>Pesan (Chat)</span>
                    <span class="badge" id="global-unread-badge">0</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/saas') ?>" class="nav-link <?= (url_is('saas*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-layer-group nav-icon"></i>
                    <span>SaaS & APK Config</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/master_menu') ?>" class="nav-link <?= (url_is('master_menu*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-bars-staggered nav-icon"></i>
                    <span>Master Menu APK</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/users') ?>" class="nav-link <?= (url_is('users*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-users nav-icon"></i>
                    <span>Manajemen Pengguna</span>
                </a>
            </li>
            <!-- Menu lain bisa ditambahkan di sini nanti -->
            <li class="nav-item">
                <a href="<?= base_url('/villages') ?>" class="nav-link <?= (url_is('villages*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-map-location-dot nav-icon"></i>
                    <span>Data Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/settings') ?>" class="nav-link <?= (url_is('settings*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-gears nav-icon"></i>
                    <span>Pengaturan Versi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/security') ?>" class="nav-link <?= (url_is('security*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-shield-halved nav-icon"></i>
                    <span>Keamanan & Backup</span>
                </a>
            </li>
        </ul>
    </aside>

    <div class="main-wrapper">
        <header class="topbar">
            <div class="topbar-title"><?= $title ?? 'Dashboard' ?></div>
            <div class="topbar-actions">
                <div class="profile-btn" id="profile-btn" style="position:relative;">
                    <div class="profile-img" id="profile-avatar" style="overflow:hidden; font-size:0.9rem;">SA</div>
                    <div>
                        <div style="font-weight: 600; font-size:0.9rem;" id="profile-name">Memuat...</div>
                        <div style="font-size: 0.75rem; color: #94a3b8;" id="profile-email"></div>
                    </div>
                </div>
                <button id="btn-logout" onclick="logout()" title="Keluar" style="background:none; border:1px solid rgba(239,68,68,0.3); color:#ef4444; border-radius:8px; padding:0.5rem 1rem; cursor:pointer; font-size:0.85rem; font-weight:600; display:flex; align-items:center; gap:0.5rem; transition:all 0.2s;" onmouseover="this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.background='none'">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                </button>
            </div>
        </header>

        <main class="content <?= isset($noPadding) && $noPadding ? 'no-padding' : '' ?>">
            <!-- Render Main Content -->
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script>
        // Override default SweetAlert2 agar halaman tidak melompat ke atas
        if (window.Swal) {
            window.Swal = window.Swal.mixin({
                heightAuto: false,
                scrollbarPadding: false
            });
        }

        // Kembalikan ke production server
        const API_URL = localStorage.getItem('custom_api_url') || 'https://jimpitan-server.appsbee.my.id/api';
        
        // Ambil data user yang login dari localStorage
        const _adminSession = JSON.parse(localStorage.getItem('jimpitan_admin_user') || '{}');
        const CURRENT_USER_UID = _adminSession.uid || 'SUPER_ADMIN';
        const CURRENT_USER_NAME = _adminSession.name || 'Appsbee Support';
        const CURRENT_USER_TOKEN = _adminSession.token || '';
        const DUMMY_ADMIN_UID = 'SUPER_ADMIN';
        const DUMMY_VILLAGE_ID = 'ALL';

        // MY_UID sebagai const (tidak berubah)
        const MY_UID = CURRENT_USER_UID;

        // Fungsi untuk mengambil token terbaru
        function getFirebaseToken() {
            const s = JSON.parse(localStorage.getItem('jimpitan_admin_user') || '{}');
            return s.token || '';
        }
        
        // Tetap sediakan variabel konstanta untuk yang butuh token saat load pertama
        const FIREBASE_ID_TOKEN = getFirebaseToken();

        // Tampilkan info user di topbar
        document.addEventListener('DOMContentLoaded', () => {
            const nameEl = document.getElementById('profile-name');
            const emailEl = document.getElementById('profile-email');
            const avatarEl = document.getElementById('profile-avatar');

            if (_adminSession.name) {
                nameEl.textContent = _adminSession.name;
                emailEl.textContent = _adminSession.email || '';
                if (_adminSession.photo) {
                    avatarEl.innerHTML = `<img src="${_adminSession.photo}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;" referrerpolicy="no-referrer" />`;
                } else {
                    avatarEl.textContent = _adminSession.name.charAt(0).toUpperCase();
                }
            }
        });

        // Fungsi logout
        async function logout() {
            const result = await Swal.fire({
                title: 'Logout',
                text: 'Yakin ingin keluar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar'
            });
            if (!result.isConfirmed) return;
            
            localStorage.removeItem('jimpitan_admin_user');
            window.location.href = '/login';
        }

        // Global Functions
        function showToast(title, message, type = 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: type,
                title: title,
                text: message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
        
        // Show Swal Error/Alert Helper
        function showAlert(title, message, type = 'error') {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonColor: '#4f46e5'
            });
        }

        // Global polling untuk Unread Badge
        async function fetchGlobalUnread() {
            try {
                // Kita gunakan DUMMY_ADMIN_UID karena belum ada auth di CI4
                const res = await fetch(`${API_URL}/chat/${DUMMY_VILLAGE_ID}/unread?uid=${CURRENT_USER_UID}`, { cache: 'no-store' });
                const data = await res.json();
                
                if (data.success) {
                    const counts = data.data;
                    let totalUnread = 0;
                    
                    for (let key in counts) {
                        totalUnread += counts[key];
                    }
                    
                    const badge = document.getElementById('global-unread-badge');
                    if (totalUnread > 0) {
                        badge.innerText = totalUnread;
                        badge.style.display = 'block';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            } catch (error) {
                console.error('Gagal mengambil unread chat:', error);
            }
        }

        // Polling setiap 5 detik untuk unread di seluruh halaman
        setInterval(fetchGlobalUnread, 5000);
        fetchGlobalUnread();
    </script>
    
    <!-- Render custom scripts from sub-views -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>
