<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Jimpitan Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0f172a;
            overflow: hidden;
        }

        /* ---- Sisi Kiri (Ilustrasi) ---- */
        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            position: relative;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.3) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139,92,246,0.2) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(10deg); }
        }

        .brand-logo {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 3rem;
            z-index: 1;
        }

        .brand-logo .icon-wrap {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            box-shadow: 0 8px 20px rgba(99,102,241,0.5);
        }

        .left-illustration {
            z-index: 1;
            text-align: center;
            max-width: 420px;
        }

        .left-illustration h2 {
            font-size: 2.25rem;
            font-weight: 700;
            color: white;
            line-height: 1.3;
            margin-bottom: 1.25rem;
        }

        .left-illustration p {
            color: #c7d2fe;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        /* Floating cards ilustrasi */
        .floating-cards {
            display: flex;
            gap: 1rem;
            margin-top: 3rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .info-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: cardFloat 5s ease-in-out infinite;
        }

        .info-card:nth-child(2) { animation-delay: -1.5s; }
        .info-card:nth-child(3) { animation-delay: -3s; }

        @keyframes cardFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .info-card i {
            font-size: 1.5rem;
            color: #a5b4fc;
        }

        .info-card span {
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* ---- Sisi Kanan (Form Login) ---- */
        .right-panel {
            width: 460px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            background: #0f172a;
            position: relative;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        /* Error Banner */
        #error-banner {
            display: none;
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            color: #f87171;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Google Button */
        .btn-google {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.875rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-google::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(139,92,246,0.2));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-google:hover {
            border-color: rgba(99,102,241,0.6);
            background: rgba(99,102,241,0.1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99,102,241,0.3);
        }

        .btn-google:hover::before { opacity: 1; }

        .btn-google:active { transform: translateY(0); }

        .btn-google:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .google-icon {
            width: 22px;
            height: 22px;
        }

        /* Loading spinner */
        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: none;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.75rem 0;
            color: #475569;
            font-size: 0.85rem;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.1);
        }

        /* Info akses */
        .access-info {
            background: rgba(99,102,241,0.1);
            border: 1px solid rgba(99,102,241,0.2);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            text-align: center;
        }

        .access-info p {
            color: #94a3b8;
            font-size: 0.85rem;
            line-height: 1.6;
        }

        .access-info strong {
            color: #a5b4fc;
        }

        /* Footer */
        .login-footer {
            margin-top: 2.5rem;
            text-align: center;
            color: #475569;
            font-size: 0.8rem;
        }

        /* Loading overlay */
        #loading-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15,23,42,0.85);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1.5rem;
        }

        #loading-overlay .big-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(99,102,241,0.3);
            border-top-color: #6366f1;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        #loading-overlay p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; }
        }
    </style>
</head>
<body>

<!-- Left Panel -->
<div class="left-panel">
    <div class="brand-logo">
        <div class="icon-wrap"><i class="fa-solid fa-leaf"></i></div>
        Jimpitan
    </div>
    <div class="left-illustration">
        <h2>Panel Kontrol Super Admin</h2>
        <p>Kelola seluruh desa, pantau aktivitas warga, dan monitor keuangan jimpitan dari satu tempat.</p>
        <div class="floating-cards">
            <div class="info-card">
                <i class="fa-solid fa-city"></i>
                <span>Multi Desa</span>
            </div>
            <div class="info-card">
                <i class="fa-solid fa-comments"></i>
                <span>Pesan Real-time</span>
            </div>
            <div class="info-card">
                <i class="fa-solid fa-chart-line"></i>
                <span>Statistik Live</span>
            </div>
        </div>
    </div>
</div>

<!-- Right Panel -->
<div class="right-panel">
    <div class="login-box">
        <div class="login-header">
            <h1>Selamat Datang</h1>
            <p>Masuk untuk mengakses panel admin</p>
        </div>

        <div id="error-banner" style="display:none;">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span id="error-text">Terjadi kesalahan. Coba lagi.</span>
        </div>

        <button class="btn-google" id="btn-google-login" onclick="signInWithGoogle()">
            <svg class="google-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <div class="spinner" id="spinner"></div>
            <span id="btn-text">Masuk dengan Google</span>
        </button>

        <div class="divider">Informasi Akses</div>

        <div class="access-info">
            <p>Panel ini hanya untuk <strong>Super Admin Appsbee</strong>.<br>
            Login dengan akun Google yang telah diotorisasi.<br>
            Akun tidak dikenal akan ditolak secara otomatis.</p>
        </div>

        <div class="login-footer">
            &copy; <?= date('Y') ?> Appsbee — Jimpitan Digital
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay">
    <div class="big-spinner"></div>
    <p id="loading-text">Memverifikasi akun...</p>
</div>

<!-- Firebase SDKs -->
<script type="module">
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js';
    import { getAuth, GoogleAuthProvider, signInWithPopup, onAuthStateChanged } from 'https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js';

    const firebaseConfig = {
        apiKey: "AIzaSyBvK2SEaBTV2tUo6hbSv4xi5mh4i-9Ea4E",
        authDomain: "jimpitan-26fda.firebaseapp.com",
        projectId: "jimpitan-26fda",
        storageBucket: "jimpitan-26fda.firebasestorage.app",
        messagingSenderId: "230006065254",
        appId: "1:230006065254:web:4c95ce03276ac70e60c5a7",
        measurementId: "G-18GE22356Y"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    const provider = new GoogleAuthProvider();

    // Jika sudah login sebelumnya, langsung redirect
    onAuthStateChanged(auth, async (user) => {
        if (user) {
            showLoading('Memuat dashboard...');
            const token = await user.getIdToken();
            saveSession(user, token);
            window.location.href = '<?= base_url('/') ?>';
        }
    });

    // Expose ke global scope untuk onclick
    window.signInWithGoogle = async function() {
        const btn = document.getElementById('btn-google-login');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btn-text');
        const errorBanner = document.getElementById('error-banner');

        errorBanner.style.display = 'none';
        btn.disabled = true;
        spinner.style.display = 'block';
        btnText.textContent = 'Menghubungkan...';

        try {
            const result = await signInWithPopup(auth, provider);
            const user = result.user;

            showLoading('Memverifikasi akses...');

            // Verifikasi ke API: cek apakah user ini ada sebagai SUPER_ADMIN atau admin
            const token = await user.getIdToken();
            
            // Simpan sesi di localStorage
            saveSession(user, token);

            showLoading('Memuat dashboard...');
            window.location.href = '<?= base_url('/') ?>';
        } catch (error) {
            console.error('Login error:', error);
            btn.disabled = false;
            spinner.style.display = 'none';
            btnText.textContent = 'Masuk dengan Google';
            
            let msg = 'Gagal masuk. Coba lagi.';
            if (error.code === 'auth/popup-closed-by-user') {
                msg = 'Popup ditutup sebelum selesai. Coba lagi.';
            } else if (error.code === 'auth/cancelled-popup-request') {
                msg = 'Permintaan dibatalkan. Coba lagi.';
            } else if (error.code === 'auth/network-request-failed') {
                msg = 'Gagal terhubung ke internet.';
            }

            errorBanner.style.display = 'flex';
            document.getElementById('error-text').textContent = msg;
        }
    };

    function saveSession(user, token) {
        localStorage.setItem('jimpitan_admin_user', JSON.stringify({
            uid: user.uid,
            name: user.displayName,
            email: user.email,
            photo: user.photoURL,
            token: token,
            tokenExpiry: Date.now() + (55 * 60 * 1000), // 55 menit
        }));
    }

    function showLoading(text) {
        const overlay = document.getElementById('loading-overlay');
        document.getElementById('loading-text').textContent = text;
        overlay.style.display = 'flex';
    }
</script>

</body>
</html>
