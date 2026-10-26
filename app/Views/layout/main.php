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
        import { initializeApp, getApps } from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js';
        import { getAuth, onAuthStateChanged } from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js';

        const firebaseConfig = {
            apiKey: "AIzaSyBvK2SEaBTV2tUo6hbSv4xi5mh4i-9Ea4E",
            authDomain: "jimpitan-26fda.firebaseapp.com",
            projectId: "jimpitan-26fda",
            storageBucket: "jimpitan-26fda.firebasestorage.app",
            messagingSenderId: "230006065254",
            appId: "1:230006065254:web:4c95ce03276ac70e60c5a7",
            measurementId: "G-18GE22356Y"
        };

        const fbApp = getApps().length === 0 ? initializeApp(firebaseConfig) : getApps()[0];
        const fbAuth = getAuth(fbApp);
        window.fbAuth = fbAuth;

        // Auto-refresh token setiap kali Firebase memperbarui sesi
        onAuthStateChanged(fbAuth, async (user) => {
            if (user) {
                try {
                    const freshToken = await user.getIdToken(false);
                    const stored = JSON.parse(localStorage.getItem('jimpitan_admin_user') || '{}');
                    stored.token = freshToken;
                    stored.tokenExpiry = Date.now() + (55 * 60 * 1000);
                    localStorage.setItem('jimpitan_admin_user', JSON.stringify(stored));
                    window.FIREBASE_ID_TOKEN = freshToken;
                } catch(e) {
                    console.warn('Token refresh gagal:', e);
                }
            }
        });

        window.getFreshFirebaseToken = async function() {
            if (window.fbAuth && window.fbAuth.currentUser) {
                try {
                    const freshToken = await window.fbAuth.currentUser.getIdToken(true);
                    const stored = JSON.parse(localStorage.getItem('jimpitan_admin_user') || '{}');
                    stored.token = freshToken;
                    stored.tokenExpiry = Date.now() + (55 * 60 * 1000);
                    localStorage.setItem('jimpitan_admin_user', JSON.stringify(stored));
                    window.FIREBASE_ID_TOKEN = freshToken;
                    return freshToken;
                } catch (e) {
                    console.warn('Gagal ambil fresh token:', e);
                }
            }
            const s = JSON.parse(localStorage.getItem('jimpitan_admin_user') || '{}');
            return s.token || '';
        };
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
            --topbar-height: 48px;
            --sidebar-width: 215px;
        }

        /* Root Font Scaling untuk Monitor Standar (1366x768 / 1080p scaled) */
        html {
            font-size: 13px;
        }
        @media (max-width: 1440px) {
            html {
                font-size: 12.5px;
            }
        }
        @media (max-width: 1280px) {
            html {
                font-size: 12px;
            }
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            font-size: 0.8125rem; /* ~12.5px - 13px */
            line-height: 1.35;
            background-color: var(--bg-color);
            color: var(--text-dark);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Heading Normalization */
        h1, .h1 { font-size: 1.35rem; line-height: 1.25; margin-top: 0; }
        h2, .h2 { font-size: 1.15rem; line-height: 1.25; margin-top: 0; }
        h3, .h3 { font-size: 1rem; line-height: 1.25; margin-top: 0; }
        h4, .h4 { font-size: 0.9rem; line-height: 1.25; margin-top: 0; }

        /* Sidebar Ringkas & Rapi */
        .sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #17153a 100%);
            color: white;
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
            position: relative;
            box-shadow: 2px 0 15px rgba(0,0,0,0.08);
            z-index: 20;
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4f46e5, #a855f7);
            z-index: 10;
        }
        
        .sidebar-deco {
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 160px;
            height: 160px;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, rgba(30,27,75,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 0.85rem 1rem;
            font-size: 1.15rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-list {
            list-style: none;
            padding: 0.5rem 0;
            margin: 0;
            flex: 1;
            overflow-y: auto;
        }

        .nav-item {
            padding: 0 0.5rem;
            margin-bottom: 0.15rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.45rem 0.65rem;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 0.4rem;
            transition: all 0.15s;
            font-weight: 500;
            font-size: 0.8rem;
            position: relative;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.07);
            color: white;
            transform: translateX(3px);
        }

        .nav-link.active {
            background: linear-gradient(90deg, var(--sidebar-active) 0%, rgba(55,48,163,0) 100%);
            color: white;
            border-left: 3px solid #8b5cf6;
        }

        .nav-icon {
            font-size: 0.95rem;
            width: 18px;
            text-align: center;
            flex-shrink: 0;
        }

        /* Main Content Wrapper */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        .topbar {
            height: var(--topbar-height);
            min-height: var(--topbar-height);
            background-color: var(--card-bg);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.25rem;
            z-index: 10;
        }

        .topbar-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #0f172a;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .profile-img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.72rem;
        }

        .content {
            flex: 1;
            padding: 0.85rem 1.15rem;
            overflow-y: auto;
            min-width: 0;
        }

        /* Badge */
        .badge {
            background-color: var(--danger);
            color: white;
            padding: 0.1rem 0.4rem;
            border-radius: 9999px;
            font-size: 0.68rem;
            font-weight: 600;
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            display: none;
        }

        .content.no-padding {
            padding: 0;
        }

        /* Card Utility */
        .card {
            background: var(--card-bg);
            border-radius: 0.625rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            padding: 0.85rem 1rem;
        }

        /* ===== GLOBAL MAXIMUM COMPACT TABLE SYSTEM ===== */
        /* Pepetkan jarak semua baris tabel maksimal dan rapikan font */
        table, .table, .data-table, .custom-table, .logs-table {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 0.78rem !important; /* ~11.5px - 12px */
            line-height: 1.25 !important;
        }
        
        table th, .table th, .data-table th, .custom-table th, .logs-table th {
            padding: 4px 6px !important;
            font-size: 0.68rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.04em !important;
            line-height: 1.2 !important;
            white-space: nowrap !important;
            height: auto !important;
            border-bottom: 1.5px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
            color: #475569 !important;
        }

        table td, .table td, .data-table td, .custom-table td, .logs-table td {
            padding: 3px 6px !important;
            font-size: 0.78rem !important;
            line-height: 1.25 !important;
            vertical-align: middle !important;
            height: auto !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        table tr, .table tr, .data-table tr, .custom-table tr, .logs-table tr {
            height: auto !important;
            min-height: unset !important;
        }

        table tr:hover td, .table tr:hover td, .data-table tr:hover td, .custom-table tr:hover td, .logs-table tr:hover td {
            background-color: #f8fafc !important;
        }

        /* Compact Elements inside Table Cells */
        table .user-info, .data-table .user-info {
            display: flex !important;
            align-items: center !important;
            gap: 0.45rem !important;
        }

        table .user-avatar, .data-table .user-avatar {
            width: 22px !important;
            height: 22px !important;
            font-size: 0.65rem !important;
            border-radius: 50% !important;
            flex-shrink: 0 !important;
        }

        table .user-details, .data-table .user-details {
            display: flex !important;
            flex-direction: column !important;
            line-height: 1.15 !important;
        }

        table .user-name, .data-table .user-name {
            font-size: 0.78rem !important;
            margin-bottom: 0 !important;
            line-height: 1.15 !important;
            font-weight: 600 !important;
        }

        table .user-email, .data-table .user-email {
            font-size: 0.68rem !important;
            line-height: 1.1 !important;
            color: #64748b !important;
        }

        table .role-badge, .data-table .role-badge,
        table .status-badge, .data-table .status-badge,
        table .badge-type, .data-table .badge-type,
        table .badge-action, .logs-table .badge-action,
        table .badge-wa-ok, table .badge-wa-missing,
        table .badge, .data-table .badge {
            padding: 1px 5px !important;
            font-size: 0.65rem !important;
            line-height: 1.1 !important;
            border-radius: 4px !important;
            margin: 0 2px 0 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            position: static !important;
            transform: none !important;
            font-weight: 600 !important;
        }

        table .btn-action, .data-table .btn-action,
        table .btn-icon, .data-table .btn-icon,
        table .btn-sm, .custom-table .btn-sm,
        table button, .data-table button {
            padding: 1.5px 5px !important;
            font-size: 0.68rem !important;
            height: 22px !important;
            min-width: 22px !important;
            border-radius: 4px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 3px !important;
            line-height: 1 !important;
        }

        table .icon-cell, .data-table .icon-cell {
            width: 24px !important;
            height: 24px !important;
            font-size: 0.75rem !important;
            border-radius: 4px !important;
        }

        /* Form inputs standard sizing */
        .form-control, input[type="text"], input[type="search"], input[type="password"], input[type="number"], select, textarea {
            font-size: 0.8125rem !important;
            padding: 0.35rem 0.6rem !important;
            border-radius: 0.375rem !important;
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
                if (!user.uid) {
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
                <a href="<?= base_url('/wa_blast') ?>" class="nav-link <?= (url_is('wa_blast*')) ? 'active' : '' ?>">
                    <i class="fa-brands fa-whatsapp nav-icon" style="color: #25d366; font-size: 1.35rem;"></i>
                    <span>WhatsApp Blasting</span>
                    <span style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 2px 7px; border-radius: 999px; font-size: 0.68rem; font-weight: 700; margin-left: auto;">KK</span>
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
                    <span>Pengaturan Sistem</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/security') ?>" class="nav-link <?= (url_is('security*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-shield-halved nav-icon"></i>
                    <span>Keamanan & Backup</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/activity_logs') ?>" class="nav-link <?= (url_is('activity_logs*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-clock-rotate-left nav-icon" style="color: #60a5fa;"></i>
                    <span>Log Aktivitas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/tutorial') ?>" target="_blank" class="nav-link <?= (url_is('tutorial*') || url_is('panduan*')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-book-open-reader nav-icon" style="color: #10b981;"></i>
                    <span>Panduan & Tutorial</span>
                    <span style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 2px 7px; border-radius: 999px; font-size: 0.68rem; font-weight: 700; margin-left: auto;">Web</span>
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
