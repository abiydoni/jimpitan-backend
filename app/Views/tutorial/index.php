<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Buku Panduan & Tutorial Resmi Jimpitan Mobile APK | Appsbee</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Tutorial lengkap penggunaan aplikasi Jimpitan Mobile APK untuk RT, RW, dan Desa. Panduan registrasi desa, join warga, input & import CSV data warga, scan QR jimpitan harian, iuran kas, dan pembukuan keuangan.">
    <meta name="keywords" content="tutorial jimpitan, panduan jimpitan apk, aplikasi kas rt, jimpitan ronda, import csv warga, scan qr jimpitan">
    <meta name="author" content="Appsbee Jimpitan">
    <link rel="icon" type="image/png" href="<?= base_url('tutorial_assets/jimpitan_logo.png') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --primary-light: #d1fae5;
            --secondary: #4f46e5;
            --secondary-dark: #3730a3;
            --secondary-light: #e0e7ff;
            --accent: #f59e0b;
            --accent-light: #fef3c7;
            --dark: #0f172a;
            --dark-card: #1e293b;
            --dark-border: #334155;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --bg-page: #f8fafc;
            --card-bg: #ffffff;
            --card-border: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.05);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 18px;
            --radius-xl: 24px;
        }

        /* Dark mode preferences */
        body.dark-mode {
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --bg-page: #0b0f19;
            --card-bg: #151d2f;
            --card-border: #243049;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
            --primary-light: rgba(16, 185, 129, 0.15);
            --secondary-light: rgba(79, 70, 229, 0.2);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-tap-highlight-color: transparent;
        }

        html {
            scroll-behavior: smooth;
            font-size: 15px;
        }

        @media (min-width: 768px) {
            html { font-size: 16px; }
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-page);
            color: var(--text-main);
            line-height: 1.65;
            padding-bottom: 90px;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        /* Top Sticky Header */
        .top-navbar {
            position: sticky;
            top: 0;
            z-index: 990;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--card-border);
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
        }
        body.dark-mode .top-navbar {
            background: rgba(15, 23, 42, 0.94);
            border-bottom: 1px solid var(--card-border);
        }

        .nav-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0.65rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            color: inherit;
        }

        .nav-brand img {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            object-fit: cover;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.35);
        }

        .nav-brand-text {
            display: flex;
            flex-direction: column;
        }

        .nav-brand-name {
            font-family: 'Outfit', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary-dark);
            letter-spacing: -0.02em;
            line-height: 1.15;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }
        body.dark-mode .nav-brand-name {
            color: #34d399;
        }

        .nav-brand-badge {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
            background: var(--primary-light);
            color: var(--primary-dark);
            border-radius: 99px;
            border: 1px solid rgba(16,185,129,0.3);
        }
        body.dark-mode .nav-brand-badge {
            color: #6ee7b7;
        }

        .nav-brand-sub {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.95rem;
            text-decoration: none;
        }
        .btn-icon:hover {
            color: var(--primary);
            border-color: var(--primary);
            transform: translateY(-1px);
        }

        .btn-pill-action {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.42rem 0.85rem;
            border-radius: 99px;
            font-size: 0.78rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-pill-wa {
            background: #25d366;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(37, 211, 102, 0.3);
        }
        .btn-pill-wa:hover {
            background: #1ebc59;
            transform: translateY(-1px);
        }
        .btn-pill-primary {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.3);
        }
        .btn-pill-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* Live Search Bar */
        .search-container {
            max-width: 1240px;
            margin: 0.75rem auto 0;
            padding: 0 1rem;
        }
        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }
        .search-box i {
            position: absolute;
            left: 1rem;
            color: var(--text-muted);
            font-size: 0.95rem;
            pointer-events: none;
        }
        .search-input {
            width: 100%;
            padding: 0.65rem 1rem 0.65rem 2.6rem;
            border-radius: 12px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            color: var(--text-main);
            font-size: 0.88rem;
            font-family: inherit;
            box-shadow: var(--shadow-sm);
            outline: none;
            transition: all 0.2s;
        }
        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.18);
        }
        .search-clear {
            position: absolute;
            right: 0.8rem;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            display: none;
            font-size: 0.85rem;
            padding: 4px;
        }

        /* Quick Topics Carousel / Scroll Pills */
        .pills-scroll-container {
            max-width: 1240px;
            margin: 0.65rem auto 0;
            padding: 0 1rem;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .pills-scroll-container::-webkit-scrollbar {
            display: none;
        }
        .pills-wrapper {
            display: inline-flex;
            gap: 0.45rem;
            padding-bottom: 0.4rem;
        }
        .topic-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.38rem 0.85rem;
            border-radius: 99px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            color: var(--text-muted);
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
        }
        .topic-pill:hover, .topic-pill.active {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            transform: translateY(-1px);
        }
        .topic-pill i {
            font-size: 0.75rem;
        }

        /* Hero Header */
        .hero-section {
            max-width: 1240px;
            margin: 1.25rem auto 1.5rem;
            padding: 0 1rem;
        }
        .hero-card {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 45%, #0f172a 100%);
            border-radius: var(--radius-xl);
            padding: 2.25rem 1.5rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }
        @media (min-width: 768px) {
            .hero-card {
                padding: 3.25rem 2.75rem;
                display: grid;
                grid-template-columns: 1.35fr 1fr;
                gap: 2rem;
                align-items: center;
            }
        }
        .hero-card::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(52, 211, 153, 0.3) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            padding: 0.3rem 0.8rem;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #a7f3d0;
            margin-bottom: 0.85rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }
        .hero-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.85rem;
            letter-spacing: -0.02em;
        }
        @media (min-width: 768px) {
            .hero-title { font-size: 2.45rem; }
        }
        .hero-desc {
            font-size: 0.95rem;
            color: #d1fae5;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        .hero-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.65rem;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }
        .stat-item {
            text-align: left;
        }
        .stat-number {
            font-family: 'Outfit', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.1;
        }
        .stat-label {
            font-size: 0.72rem;
            color: #a7f3d0;
            font-weight: 500;
        }

        .hero-visual {
            display: none;
            position: relative;
        }
        @media (min-width: 768px) {
            .hero-visual {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }
        .hero-img-stack {
            position: relative;
            max-width: 320px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.4);
            border: 2px solid rgba(255, 255, 255, 0.15);
            cursor: pointer;
            transition: transform 0.3s;
        }
        .hero-img-stack:hover {
            transform: scale(1.02);
        }
        .hero-img-stack img {
            width: 100%;
            display: block;
        }

        /* Layout Main Content & TOC Sidebar */
        .main-layout {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        @media (min-width: 1024px) {
            .main-layout {
                display: grid;
                grid-template-columns: 280px 1fr;
                gap: 2rem;
                align-items: start;
            }
        }

        /* Sticky TOC Sidebar Desktop */
        .toc-sidebar {
            display: none;
        }
        @media (min-width: 1024px) {
            .toc-sidebar {
                display: block;
                position: sticky;
                top: 80px;
                background: var(--card-bg);
                border: 1px solid var(--card-border);
                border-radius: var(--radius-lg);
                padding: 1.25rem;
                box-shadow: var(--shadow-sm);
                max-height: calc(100vh - 100px);
                overflow-y: auto;
            }
        }
        .toc-title {
            font-family: 'Outfit', sans-serif;
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--text-main);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .toc-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }
        .toc-item a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.65rem;
            border-radius: var(--radius-sm);
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 600;
            transition: all 0.2s;
            line-height: 1.35;
        }
        .toc-item a:hover, .toc-item a.active {
            background: var(--primary-light);
            color: var(--primary-dark);
        }
        body.dark-mode .toc-item a:hover, body.dark-mode .toc-item a.active {
            color: #34d399;
        }
        .toc-num {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            font-weight: 700;
            background: rgba(0,0,0,0.06);
            padding: 1px 5px;
            border-radius: 4px;
            min-width: 22px;
            text-align: center;
        }
        body.dark-mode .toc-num {
            background: rgba(255,255,255,0.08);
        }

        /* Content Stream */
        .content-stream {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Tutorial Module Card */
        .tutorial-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            scroll-margin-top: 80px;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        @media (min-width: 768px) {
            .tutorial-card {
                padding: 2.25rem;
            }
        }
        .tutorial-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .card-header-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.85rem;
            flex-wrap: wrap;
        }

        .module-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.28rem 0.75rem;
            border-radius: 99px;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .badge-rt {
            background: var(--primary-light);
            color: var(--primary-dark);
            border: 1px solid rgba(16,185,129,0.3);
        }
        body.dark-mode .badge-rt { color: #6ee7b7; }
        .badge-warga {
            background: var(--secondary-light);
            color: var(--secondary-dark);
            border: 1px solid rgba(79,70,229,0.3);
        }
        body.dark-mode .badge-warga { color: #a5b4fc; }
        .badge-ronda {
            background: var(--accent-light);
            color: #b45309;
            border: 1px solid rgba(245,158,11,0.3);
        }
        body.dark-mode .badge-ronda { color: #fde68a; }
        .badge-bendahara {
            background: #fce7f3;
            color: #be185d;
            border: 1px solid rgba(190,24,93,0.3);
        }
        body.dark-mode .badge-bendahara { color: #fbcfe8; }

        .btn-copy-link {
            background: none;
            border: 1px solid var(--card-border);
            padding: 0.25rem 0.65rem;
            border-radius: 8px;
            font-size: 0.75rem;
            color: var(--text-muted);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: all 0.2s;
        }
        .btn-copy-link:hover {
            color: var(--primary);
            border-color: var(--primary);
        }

        .card-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.25;
            margin-bottom: 0.65rem;
            letter-spacing: -0.01em;
        }
        @media (min-width: 768px) {
            .card-title { font-size: 1.65rem; }
        }

        .card-lead {
            font-size: 0.92rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        /* Two column layout for visual & steps */
        .module-body-grid {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        @media (min-width: 860px) {
            .module-body-grid {
                display: grid;
                grid-template-columns: 1fr 340px;
                gap: 2rem;
                align-items: start;
            }
            .module-body-grid.reverse {
                grid-template-columns: 340px 1fr;
            }
            .module-body-grid.reverse .module-visual {
                order: -1;
            }
        }

        /* Step Sequence */
        .step-sequence {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .step-row {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            padding: 0.85rem 1rem;
            background: rgba(0,0,0,0.015);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-md);
            transition: background 0.2s;
        }
        body.dark-mode .step-row {
            background: rgba(255,255,255,0.02);
        }
        .step-row:hover {
            background: rgba(16, 185, 129, 0.04);
            border-color: rgba(16, 185, 129, 0.3);
        }

        .step-badge {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: var(--primary);
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(16,185,129,0.3);
        }

        .step-content {
            flex: 1;
        }
        .step-title {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.25rem;
        }
        .step-desc {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.55;
        }

        /* Code / Field Highlights */
        .badge-field {
            font-family: 'JetBrains Mono', monospace;
            background: rgba(0,0,0,0.06);
            color: var(--secondary);
            font-size: 0.78rem;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
        }
        body.dark-mode .badge-field {
            background: rgba(255,255,255,0.08);
            color: #a5b4fc;
        }

        /* Callout Alerts */
        .callout-box {
            margin-top: 1.25rem;
            padding: 1rem 1.15rem;
            border-radius: var(--radius-md);
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            font-size: 0.85rem;
            line-height: 1.55;
        }
        .callout-tip {
            background: rgba(16, 185, 129, 0.08);
            border-left: 4px solid var(--primary);
            color: #065f46;
        }
        body.dark-mode .callout-tip {
            background: rgba(16, 185, 129, 0.12);
            color: #a7f3d0;
        }
        .callout-warning {
            background: rgba(245, 158, 11, 0.08);
            border-left: 4px solid var(--accent);
            color: #92400e;
        }
        body.dark-mode .callout-warning {
            background: rgba(245, 158, 11, 0.12);
            color: #fde68a;
        }
        .callout-info {
            background: rgba(79, 70, 229, 0.08);
            border-left: 4px solid var(--secondary);
            color: #3730a3;
        }
        body.dark-mode .callout-info {
            background: rgba(79, 70, 229, 0.12);
            color: #c7d2fe;
        }

        /* Visual Media Frame / Screenshot Showcase */
        .module-visual {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.65rem;
        }
        .phone-mockup-frame {
            width: 100%;
            max-width: 320px;
            background: #000000;
            border-radius: 36px;
            padding: 8px;
            box-shadow: 0 15px 35px -5px rgba(0,0,0,0.25), 0 0 0 1px rgba(255,255,255,0.1) inset;
            position: relative;
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .phone-mockup-frame:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -5px rgba(0,0,0,0.35);
        }
        .phone-screen {
            border-radius: 28px;
            overflow: hidden;
            background: #ffffff;
            position: relative;
        }
        .phone-screen img {
            width: 100%;
            display: block;
            object-fit: cover;
        }
        .zoom-overlay-hint {
            position: absolute;
            bottom: 12px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(15, 23, 42, 0.82);
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 99px;
            backdrop-filter: blur(6px);
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            pointer-events: none;
            opacity: 0.9;
            white-space: nowrap;
        }

        .visual-caption {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-align: center;
            font-weight: 500;
        }

        /* Interactive CSV Table Guide */
        .table-responsive-box {
            width: 100%;
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid var(--card-border);
            margin: 1.25rem 0;
            background: var(--card-bg);
            box-shadow: var(--shadow-sm);
        }
        .data-guide-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.82rem;
            text-align: left;
            min-width: 600px;
        }
        .data-guide-table th {
            background: rgba(0,0,0,0.03);
            color: var(--text-main);
            padding: 0.65rem 0.85rem;
            font-weight: 700;
            border-bottom: 2px solid var(--card-border);
            font-family: 'Outfit', sans-serif;
        }
        body.dark-mode .data-guide-table th {
            background: rgba(255,255,255,0.04);
        }
        .data-guide-table td {
            padding: 0.65rem 0.85rem;
            border-bottom: 1px solid var(--card-border);
            color: var(--text-muted);
            vertical-align: top;
        }
        .data-guide-table tr:last-child td {
            border-bottom: none;
        }
        .data-guide-table tr:hover td {
            background: rgba(16, 185, 129, 0.03);
        }

        /* Download Card Banner */
        .download-template-banner {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 60%, #4338ca 100%);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin: 1.25rem 0;
            box-shadow: var(--shadow-md);
        }
        @media (min-width: 640px) {
            .download-template-banner {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                padding: 1.75rem;
            }
        }
        .dt-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .dt-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            color: #a5b4fc;
        }
        .dt-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        .dt-desc {
            font-size: 0.8rem;
            color: #c7d2fe;
        }
        .btn-download-csv {
            background: #ffffff;
            color: #312e81;
            padding: 0.65rem 1.25rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 800;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-download-csv:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.25);
            background: #f8fafc;
        }

        /* Mockup Interactive UI Elements */
        .mockup-ui-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            box-shadow: var(--shadow-sm);
        }
        .scanner-camera-view {
            background: #0f172a;
            border-radius: 16px;
            padding: 1.5rem 1rem;
            color: #ffffff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .scanner-reticle {
            width: 160px;
            height: 160px;
            margin: 0.85rem auto;
            border: 2px dashed #10b981;
            border-radius: 16px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .scanner-beam {
            position: absolute;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, #34d399, transparent);
            box-shadow: 0 0 12px #34d399;
            animation: scanAnim 2.5s ease-in-out infinite alternate;
        }
        @keyframes scanAnim {
            0% { top: 10%; }
            100% { top: 90%; }
        }

        .dues-grid-mockup {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .dues-month-box {
            padding: 0.65rem 0.35rem;
            text-align: center;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            border: 1px solid transparent;
        }
        .dues-paid {
            background: #dcfce7;
            color: #15803d;
            border-color: #86efac;
        }
        body.dark-mode .dues-paid {
            background: rgba(16, 185, 129, 0.2);
            color: #86efac;
            border-color: rgba(16, 185, 129, 0.4);
        }
        .dues-unpaid {
            background: #f1f5f9;
            color: #64748b;
            border-color: #cbd5e1;
        }
        body.dark-mode .dues-unpaid {
            background: rgba(255,255,255,0.05);
            color: #94a3b8;
            border-color: rgba(255,255,255,0.1);
        }

        /* FAQ Accordion */
        .faq-accordion {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 1.25rem;
        }
        .faq-item {
            border: 1px solid var(--card-border);
            border-radius: var(--radius-md);
            overflow: hidden;
            background: var(--card-bg);
            transition: all 0.2s;
        }
        .faq-question {
            padding: 1rem 1.15rem;
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            cursor: pointer;
            user-select: none;
        }
        .faq-question i {
            transition: transform 0.25s ease;
            color: var(--primary);
        }
        .faq-item.open .faq-question i {
            transform: rotate(180deg);
        }
        .faq-answer {
            padding: 0 1.15rem 1rem 1.15rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.6;
            display: none;
        }
        .faq-item.open .faq-answer {
            display: block;
        }

        /* Footer */
        .tutorial-footer {
            max-width: 1240px;
            margin: 3rem auto 0;
            padding: 2rem 1rem;
            border-top: 1px solid var(--card-border);
            text-align: center;
            color: var(--text-muted);
            font-size: 0.82rem;
        }
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .footer-links a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 600;
        }
        body.dark-mode .footer-links a {
            color: #34d399;
        }

        /* Lightbox Modal */
        .lightbox-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.92);
            backdrop-filter: blur(8px);
            z-index: 10000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .lightbox-modal.active {
            display: flex;
            opacity: 1;
        }
        .lightbox-content {
            position: relative;
            max-width: 95vw;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .lightbox-img {
            max-width: 100%;
            max-height: 82vh;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
            object-fit: contain;
            user-select: none;
        }
        .lightbox-caption {
            color: #ffffff;
            font-size: 0.88rem;
            margin-top: 0.85rem;
            text-align: center;
            font-weight: 600;
        }
        .lightbox-close {
            position: absolute;
            top: -45px;
            right: 0;
            background: rgba(255,255,255,0.2);
            color: #ffffff;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background 0.2s;
        }
        .lightbox-close:hover {
            background: rgba(255,255,255,0.4);
        }

        /* Floating Scroll Top FAB */
        .fab-scroll-top {
            position: fixed;
            bottom: 24px;
            right: 20px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--primary);
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
            cursor: pointer;
            z-index: 900;
            opacity: 0;
            pointer-events: none;
            transition: all 0.25s ease;
            font-size: 1.1rem;
        }
        .fab-scroll-top.visible {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }
        .fab-scroll-top:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
        }

        /* Toast notification */
        .copy-toast {
            position: fixed;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: #0f172a;
            color: #ffffff;
            padding: 0.6rem 1.25rem;
            border-radius: 99px;
            font-size: 0.82rem;
            font-weight: 600;
            z-index: 9999;
            box-shadow: 0 10px 20px rgba(0,0,0,0.25);
            opacity: 0;
            pointer-events: none;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .copy-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* Print styles */
        @media print {
            .top-navbar, .search-container, .pills-scroll-container, .toc-sidebar, .fab-scroll-top, .btn-copy-link, .nav-actions {
                display: none !important;
            }
            body {
                background: #ffffff !important;
                color: #000000 !important;
                font-size: 12pt !important;
            }
            .tutorial-card {
                border: 1px solid #ccc !important;
                box-shadow: none !important;
                page-break-inside: avoid;
                margin-bottom: 20pt !important;
            }
        }
    </style>
</head>
<body>

    <!-- Top Sticky Navbar -->
    <header class="top-navbar">
        <div class="nav-inner">
            <a href="<?= base_url('/tutorial') ?>" class="nav-brand">
                <img src="<?= base_url('tutorial_assets/jimpitan_logo.png') ?>" alt="Jimpitan App" onerror="this.src='https://ui-avatars.com/api/?name=J&background=10b981&color=fff'">
                <div class="nav-brand-text">
                    <span class="nav-brand-name">
                        Jimpitan <span class="nav-brand-badge">Buku Panduan</span>
                    </span>
                    <span class="nav-brand-sub">Tutorial Resmi Mobile APK</span>
                </div>
            </a>

            <div class="nav-actions">
                <button class="btn-icon" id="btn-theme-toggle" title="Ganti Mode Gelap/Terang" aria-label="Toggle Dark Mode">
                    <i class="fa-solid fa-moon"></i>
                </button>
                <a href="https://wa.me/?text=Halo,%20berikut%20buku%20panduan%20lengkap%20penggunaan%20aplikasi%20Jimpitan%20APK%20(mulai%20pembuatan%20desa,%20join,%20input%20warga,%20hingga%20ronda%20dan%20kas):%20<?= urlencode(base_url('/tutorial')) ?>" target="_blank" class="btn-pill-action btn-pill-wa" title="Bagikan ke WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>Share WA</span>
                </a>
                <a href="<?= base_url('tutorial/download_template') ?>" class="btn-pill-action btn-pill-primary" title="Download Template CSV Warga">
                    <i class="fa-solid fa-file-csv"></i>
                    <span>Template CSV</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Search Bar with Live Filter -->
    <div class="search-container">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="live-search" class="search-input" placeholder="Cari panduan... (contoh: pembuatan desa, join, nik, csv, scan qr, kas, ronda, kartu keluarga)" autocomplete="off">
            <button class="search-clear" id="search-clear" title="Bersihkan pencarian">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

    <!-- Quick Jump Horizontal Pills -->
    <div class="pills-scroll-container">
        <div class="pills-wrapper">
            <a href="#modul-pembuatan-desa" class="topic-pill active"><i class="fa-solid fa-house-chimney-medical"></i> 1. Pembuatan Desa</a>
            <a href="#modul-join-desa" class="topic-pill"><i class="fa-solid fa-user-plus"></i> 2. Gabung Desa</a>
            <a href="#modul-input-warga" class="topic-pill"><i class="fa-solid fa-address-card"></i> 3. Input Data Warga</a>
            <a href="#modul-import-csv" class="topic-pill"><i class="fa-solid fa-file-import"></i> 4. Import CSV Massal</a>
            <a href="#modul-scan-qr" class="topic-pill"><i class="fa-solid fa-qrcode"></i> 5. Scan QR Ronda</a>
            <a href="#modul-checklist-manual" class="topic-pill"><i class="fa-solid fa-clipboard-check"></i> 6. Input Manual</a>
            <a href="#modul-setor-ronda" class="topic-pill"><i class="fa-solid fa-hand-holding-dollar"></i> 7. Setor Ronda</a>
            <a href="#modul-iuran-warga" class="topic-pill"><i class="fa-solid fa-money-bill-transfer"></i> 8. Iuran Kas RT</a>
            <a href="#modul-buku-kas" class="topic-pill"><i class="fa-solid fa-book-journal-whills"></i> 9. Buku Kas</a>
            <a href="#modul-jadwal-ronda" class="topic-pill"><i class="fa-solid fa-calendar-days"></i> 10. Jadwal Ronda</a>
            <a href="#modul-inventaris" class="topic-pill"><i class="fa-solid fa-boxes-stacked"></i> 11. Inventaris</a>
            <a href="#modul-chat" class="topic-pill"><i class="fa-solid fa-comments"></i> 12. Chat & Pengumuman</a>
            <a href="#modul-roles" class="topic-pill"><i class="fa-solid fa-users-gear"></i> 13. Hak Akses (Role)</a>
            <a href="#modul-faq" class="topic-pill"><i class="fa-solid fa-circle-question"></i> 14. Tanya Jawab (FAQ)</a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-card">
            <div class="hero-text-content">
                <span class="hero-tag"><i class="fa-solid fa-certificate"></i> Panduan Resmi Versi <?= esc($version ?? '1.10.x') ?></span>
                <h1 class="hero-title">Panduan Lengkap Penggunaan Aplikasi Jimpitan APK</h1>
                <p class="hero-desc">
                    Pelajari langkah praktis pengelolaan lingkungan RT/RW/Desa modern. Mulai dari pendaftaran desa baru, cara warga bergabung, input Kartu Keluarga, import massal file CSV, operasional scan QR ronda harian, hingga pembukuan kas otomatis.
                </p>
                <div style="display: flex; gap: 0.65rem; flex-wrap: wrap;">
                    <a href="#modul-pembuatan-desa" class="btn-pill-action btn-pill-primary" style="padding: 0.65rem 1.25rem; font-size: 0.88rem;">
                        <i class="fa-solid fa-rocket"></i> Mulai Panduan
                    </a>
                    <a href="<?= base_url('tutorial/download_template') ?>" class="btn-pill-action" style="background: rgba(255,255,255,0.18); color: #fff; padding: 0.65rem 1.25rem; font-size: 0.88rem;">
                        <i class="fa-solid fa-download"></i> Unduh Format CSV
                    </a>
                </div>
                <div class="hero-stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">14+</div>
                        <div class="stat-label">Modul Tutorial</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Mobile Friendly</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">Gratis</div>
                        <div class="stat-label">Dapat Dibuka Siapa Saja</div>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-img-stack" onclick="openLightbox('<?= base_url('tutorial_assets/1_pembuatan_desa.jpg') ?>', 'Screenshot Antarmuka Aplikasi Jimpitan Mobile')">
                    <img src="<?= base_url('tutorial_assets/1_pembuatan_desa.jpg') ?>" alt="Screenshot Jimpitan APK">
                    <div class="zoom-overlay-hint"><i class="fa-solid fa-expand"></i> Ketuk untuk Zoom</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Layout with Sidebar -->
    <div class="main-layout">
        
        <!-- Desktop Sticky TOC Sidebar -->
        <aside class="toc-sidebar">
            <div class="toc-title"><i class="fa-solid fa-list-check"></i> Daftar Modul</div>
            <ul class="toc-list">
                <li class="toc-item"><a href="#modul-pembuatan-desa"><span class="toc-num">01</span> Pembuatan Desa Baru</a></li>
                <li class="toc-item"><a href="#modul-join-desa"><span class="toc-num">02</span> Cara Warga Bergabung</a></li>
                <li class="toc-item"><a href="#modul-input-warga"><span class="toc-num">03</span> Input Data Warga & KK</a></li>
                <li class="toc-item"><a href="#modul-import-csv"><span class="toc-num">04</span> Import Data Massal (CSV)</a></li>
                <li class="toc-item"><a href="#modul-scan-qr"><span class="toc-num">05</span> Scan QR Ronda Harian</a></li>
                <li class="toc-item"><a href="#modul-checklist-manual"><span class="toc-num">06</span> Input Manual & Checklist</a></li>
                <li class="toc-item"><a href="#modul-setor-ronda"><span class="toc-num">07</span> Setor Uang ke Bendahara</a></li>
                <li class="toc-item"><a href="#modul-iuran-warga"><span class="toc-num">08</span> Pembayaran Iuran Kas RT</a></li>
                <li class="toc-item"><a href="#modul-buku-kas"><span class="toc-num">09</span> Buku Kas & Keuangan</a></li>
                <li class="toc-item"><a href="#modul-jadwal-ronda"><span class="toc-num">10</span> Jadwal Ronda Malam</a></li>
                <li class="toc-item"><a href="#modul-inventaris"><span class="toc-num">11</span> Inventaris Barang RT</a></li>
                <li class="toc-item"><a href="#modul-chat"><span class="toc-num">12</span> Chat & Siaran RT</a></li>
                <li class="toc-item"><a href="#modul-roles"><span class="toc-num">13</span> Manajemen Hak Akses</a></li>
                <li class="toc-item"><a href="#modul-faq"><span class="toc-num">14</span> Tanya Jawab & Tips</a></li>
            </ul>
        </aside>

        <!-- Tutorial Modules Stream -->
        <main class="content-stream">

            <!-- ========================================== -->
            <!-- MODUL 01: PEMBUATAN DESA BARU -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-pembuatan-desa">
                <div class="card-header-meta">
                    <span class="module-badge badge-rt"><i class="fa-solid fa-crown"></i> Modul 01 • Khusus Ketua RT / Inisiator</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-pembuatan-desa')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">1. Pembuatan & Registrasi Desa / RT Baru</h2>
                <p class="card-lead">
                    Langkah awal untuk memulai digitalisasi lingkungan RT/RW/Desa Anda di aplikasi Jimpitan. Ketua RT atau perwakilan pengurus mendaftarkan nama lingkungan untuk pertama kali.
                </p>

                <div class="module-body-grid">
                    <div class="module-steps">
                        <div class="step-sequence">
                            <div class="step-row">
                                <div class="step-badge">1</div>
                                <div class="step-content">
                                    <div class="step-title">Buka Aplikasi & Pilih "Daftarkan Desa Baru"</div>
                                    <div class="step-desc">
                                        Unduh aplikasi <strong>Jimpitan</strong> dari Google Play Store. Pada layar awal pendaftaran/login, ketuk tombol <strong>"Daftarkan Desa Baru"</strong> dan masuk menggunakan akun Google resmi pengurus.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">2</div>
                                <div class="step-content">
                                    <div class="step-title">Lengkapi Data Identitas Lingkungan</div>
                                    <div class="step-desc">
                                        Isi formulir nama komunitas Anda:
                                        <ul style="margin: 0.35rem 0 0 1.25rem;">
                                            <li><span class="badge-field">Nama Desa / RT</span>: Contoh <code>Desa Sukamaju / RT 04</code></li>
                                            <li><span class="badge-field">Alamat Lengkap</span>: Contoh <code>Jalan Mawar No. 15, Bandung</code></li>
                                            <li><span class="badge-field">RT/RW</span>: Contoh <code>RT 04 / RW 09</code></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">3</div>
                                <div class="step-content">
                                    <div class="step-title">Isi Data Admin Utama Lingkungan (Wajib)</div>
                                    <div class="step-desc">
                                        Masukkan data penanggung jawab (Ketua RT / Administrator):
                                        <ul style="margin: 0.35rem 0 0 1.25rem;">
                                            <li><span class="badge-field">Nomor KK Admin</span>: 16 digit angka</li>
                                            <li><span class="badge-field">NIK Admin</span>: 16 digit KTP resmi</li>
                                            <li><span class="badge-field">Nama Lengkap Admin</span>: Sesuai identitas</li>
                                            <li><span class="badge-field">Nomor WhatsApp</span>: Minimal 10 digit angka (digunakan untuk notifikasi sistem & kontak warga)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">4</div>
                                <div class="step-content">
                                    <div class="step-title">Dapatkan 5 Digit Kode Undangan Desa</div>
                                    <div class="step-desc">
                                        Setelah menekan <strong>"Daftarkan Desa Sekarang"</strong>, sistem otomatis membuat lingkungan Anda dan memberikan <strong>5 Digit Kode Unik</strong> (misalnya <code>DESA1</code> atau <code>X8K2M</code>). Simpan dan bagikan kode ini kepada seluruh warga lingkungan Anda agar mereka bisa bergabung.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="callout-box callout-tip">
                            <i class="fa-solid fa-lightbulb" style="font-size: 1.25rem; margin-top: 2px;"></i>
                            <div>
                                <strong>Tips Pengurus:</strong> Akun Google yang dipakai mendaftar otomatis memiliki hak akses sebagai <strong>Admin Desa (Super User)</strong> dengan kewenangan penuh mengatur tarif, menyetujui warga, dan mengelola pembukuan kas.
                            </div>
                        </div>
                    </div>

                    <div class="module-visual">
                        <div class="phone-mockup-frame" onclick="openLightbox('<?= base_url('tutorial_assets/1_pembuatan_desa.jpg') ?>', 'Formulir Registrasi Desa Baru Jimpitan')">
                            <div class="phone-screen">
                                <img src="<?= base_url('tutorial_assets/1_pembuatan_desa.jpg') ?>" alt="Registrasi Desa Baru">
                                <div class="zoom-overlay-hint"><i class="fa-solid fa-expand"></i> Perbesar Gambar</div>
                            </div>
                        </div>
                        <span class="visual-caption">Tampilan Form Registrasi Desa Baru di HP</span>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 02: JOIN DESA (CARA WARGA BERGABUNG) -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-join-desa">
                <div class="card-header-meta">
                    <span class="module-badge badge-warga"><i class="fa-solid fa-users"></i> Modul 02 • Panduan Untuk Warga</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-join-desa')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">2. Cara Warga Bergabung ke Desa (Join Desa)</h2>
                <p class="card-lead">
                    Warga dapat dengan mudah terhubung ke sistem RT masing-masing. Tersedia dua jalur bergabung: verifikasi otomatis instan via NIK atau menunggu persetujuan pengurus.
                </p>

                <div class="module-body-grid reverse">
                    <div class="module-steps">
                        <div class="step-sequence">
                            <div class="step-row">
                                <div class="step-badge">1</div>
                                <div class="step-content">
                                    <div class="step-title">Pilih Menu "Bergabung dengan Desa"</div>
                                    <div class="step-desc">
                                        Warga mengunduh aplikasi Jimpitan di HP, lalu login dengan akun Google masing-masing. Di menu utama, ketuk <strong>"Bergabung ke Desa"</strong>.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">2</div>
                                <div class="step-content">
                                    <div class="step-title">Masukkan 5 Digit Kode Desa RT Anda</div>
                                    <div class="step-desc">
                                        Ketikkan 5 digit kode desa yang dibagikan oleh Ketua RT (misalnya: <code>DESA1</code>). Sistem akan otomatis memverifikasi keberadaan lingkungan tersebut.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">3</div>
                                <div class="step-content">
                                    <div class="step-title">Isi Nama Lengkap & NIK 16 Digit</div>
                                    <div class="step-desc">
                                        Warga memasukkan Nama Lengkap sesuai KTP dan NIK (Nomor Induk Kependudukan 16 digit).
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">4</div>
                                <div class="step-content">
                                    <div class="step-title">Jalur Aktivasi Otomatis (Instant Sync)</div>
                                    <div class="step-desc">
                                        <strong>Kelebihan Jimpitan:</strong> Jika data NIK warga tersebut <em>sudah diinput terlebih dahulu oleh Admin RT</em> (misal melalui formulir warga atau Import CSV), maka sistem akan <strong>LANGSUNG AKTIF SECARA OTOMATIS</strong> tanpa perlu menunggu persetujuan! Warga bisa langsung melihat tagihan iuran keluarga & riwayat jimpitan rumahnya.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">5</div>
                                <div class="step-content">
                                    <div class="step-title">Jalur Pengajuan Baru (Pending Approval)</div>
                                    <div class="step-desc">
                                        Jika NIK belum pernah didaftarkan oleh admin, pengajuan warga akan masuk ke status <em>"Menunggu Persetujuan Admin RT"</em>. Admin RT cukup membuka menu Warga di aplikasi dan menekan tombol centang (Setujui).
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="callout-box callout-warning">
                            <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.25rem; margin-top: 2px;"></i>
                            <div>
                                <strong>Ketentuan Keamanan:</strong> 1 akun Google hanya dapat terdaftar aktif di 1 desa. Jika warga berpindah domisili ke desa lain, hubungi admin desa lama untuk menonaktifkan status sebelumnya.
                            </div>
                        </div>
                    </div>

                    <div class="module-visual">
                        <div class="phone-mockup-frame" onclick="openLightbox('<?= base_url('tutorial_assets/2_join_desa.jpg') ?>', 'Layar Bergabung ke Desa Jimpitan')">
                            <div class="phone-screen">
                                <img src="<?= base_url('tutorial_assets/2_join_desa.jpg') ?>" alt="Join Desa Jimpitan">
                                <div class="zoom-overlay-hint"><i class="fa-solid fa-expand"></i> Perbesar Gambar</div>
                            </div>
                        </div>
                        <span class="visual-caption">Tampilan Form Gabung Desa di HP Warga</span>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 03: INPUT DATA WARGA & KARTU KELUARGA -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-input-warga">
                <div class="card-header-meta">
                    <span class="module-badge badge-rt"><i class="fa-solid fa-id-card"></i> Modul 03 • Pengurus RT & Pendataan</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-input-warga')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">3. Input Data Warga & Kartu Keluarga (KK)</h2>
                <p class="card-lead">
                    Aplikasi Jimpitan mengelompokkan data warga berbasis <strong>Kartu Keluarga (KK)</strong> dan <strong>Nomor Rumah</strong>, sehingga tagihan iuran kas dan stiker QR jimpitan terorganisir per pintu rumah secara rapi.
                </p>

                <div class="module-body-grid">
                    <div class="module-steps">
                        <div class="step-sequence">
                            <div class="step-row">
                                <div class="step-badge">1</div>
                                <div class="step-content">
                                    <div class="step-title">Buka Menu "Data Warga" -> Tambah Warga (+)</div>
                                    <div class="step-desc">
                                        Dari dashboard utama aplikasi Jimpitan, masuk ke menu <strong>Data Warga</strong>, kemudian tekan tombol melayang tambah warga (<strong>+</strong>).
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">2</div>
                                <div class="step-content">
                                    <div class="step-title">Isi Data Pokok Rumah Tangga (KK)</div>
                                    <div class="step-desc">
                                        Lengkapi informasi utama rumah:
                                        <ul style="margin: 0.35rem 0 0 1.25rem;">
                                            <li><span class="badge-field">Nomor KK</span>: 16 digit angka Kartu Keluarga</li>
                                            <li><span class="badge-field">Alamat / RT RW</span>: Contoh <code>Jl. Merpati No. 45, RT 03 RW 08</code></li>
                                            <li><span class="badge-field">Nomor WhatsApp</span>: Kontak aktif kepala keluarga (bisa menerima struk iuran digital)</li>
                                            <li><span class="badge-field">Kode Rumah</span>: Opsional. Sistem otomatis membuat kode rumah jika dikosongkan.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">3</div>
                                <div class="step-content">
                                    <div class="step-title">Tambah Anggota Keluarga dalam 1 KK</div>
                                    <div class="step-desc">
                                        Dalam 1 Nomor KK, Anda bisa menambahkan banyak anggota keluarga sekaligus (Kepala Keluarga, Istri, Anak, Orang Tua) dengan menekan tombol <strong>"+ Tambah Anggota"</strong>:
                                        <ul style="margin: 0.35rem 0 0 1.25rem;">
                                            <li>Isi NIK 16 digit & Nama Lengkap masing-masing</li>
                                            <li>Tentukan Status Hubungan, Status Perkawinan, Jenis Kelamin, Agama, dan Pekerjaan</li>
                                            <li>Tentukan Jabatan / Role: <code>WARGA</code>, <code>PETUGAS RONDA</code>, <code>BENDAHARA</code>, dll.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">4</div>
                                <div class="step-content">
                                    <div class="step-title">Simpan & Cetak QR Code Rumah Warga</div>
                                    <div class="step-desc">
                                        Setelah data disimpan, sistem otomatis menggenerasikan <strong>QR Code Unik Rumah</strong>. QR Code ini dapat diunduh, dicetak, dan ditempelkan di depan pintu atau kotak jimpitan rumah warga.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="callout-box callout-info">
                            <i class="fa-solid fa-qrcode" style="font-size: 1.25rem; margin-top: 2px;"></i>
                            <div>
                                <strong>Stiker QR Rumah:</strong> 1 QR Code mewakili 1 Rumah / KK. Saat petugas ronda memindai QR Code tersebut di malam hari, uang jimpitan langsung tercatat atas nama rumah keluarga bersangkutan.
                            </div>
                        </div>
                    </div>

                    <div class="module-visual">
                        <div class="phone-mockup-frame" onclick="openLightbox('<?= base_url('tutorial_assets/3_input_warga.jpg') ?>', 'Formulir Data Warga & Kartu Keluarga di Jimpitan')">
                            <div class="phone-screen">
                                <img src="<?= base_url('tutorial_assets/3_input_warga.jpg') ?>" alt="Formulir Data Warga Jimpitan">
                                <div class="zoom-overlay-hint"><i class="fa-solid fa-expand"></i> Perbesar Gambar</div>
                            </div>
                        </div>
                        <span class="visual-caption">Tampilan Form Input Data Warga & Kartu Keluarga</span>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 04: IMPORT DATA WARGA MASSAL (CSV) -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-import-csv">
                <div class="card-header-meta">
                    <span class="module-badge badge-rt"><i class="fa-solid fa-file-excel"></i> Modul 04 • Fitur Unggulan Efisiensi RT</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-import-csv')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">4. Import Data Warga Massal (File CSV / Excel)</h2>
                <p class="card-lead">
                    Jika lingkungan Anda memiliki puluhan hingga ratusan kepala keluarga, menginput satu-per-satu memakan banyak waktu. Fitur <strong>Import CSV Massal</strong> memungkinkan Anda mengunggah seluruh data warga RT hanya dalam hitungan 5 detik!
                </p>

                <!-- Download Template Banner Card -->
                <div class="download-template-banner">
                    <div class="dt-info">
                        <div class="dt-icon"><i class="fa-solid fa-file-csv"></i></div>
                        <div>
                            <div class="dt-title">Unduh Template CSV Data Warga</div>
                            <div class="dt-desc">Gunakan file template resmi yang telah disesuaikan dengan format sistem Jimpitan</div>
                        </div>
                    </div>
                    <a href="<?= base_url('tutorial/download_template') ?>" class="btn-download-csv">
                        <i class="fa-solid fa-cloud-arrow-down"></i> Unduh File Template (.csv)
                    </a>
                </div>

                <div class="step-sequence">
                    <div class="step-row">
                        <div class="step-badge">1</div>
                        <div class="step-content">
                            <div class="step-title">Buka File Template di Microsoft Excel / Google Sheets</div>
                            <div class="step-desc">
                                Buka file <code>template_warga_jimpitan.csv</code> yang telah diunduh menggunakan Microsoft Excel, Google Spreadsheet, atau WPS Office di laptop maupun HP.
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">2</div>
                        <div class="step-content">
                            <div class="step-title">Isi Kolom Data Warga Sesuai Panduan Kolom</div>
                            <div class="step-desc">
                                Masukkan baris data warga Anda. <strong>PENTING:</strong> Warga yang memiliki <code>No KK</code> yang sama akan <em>otomatis dikelompokkan ke dalam 1 Kartu Keluarga yang sama</em> oleh sistem Jimpitan!
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Panduan Kolom CSV -->
                <div class="table-responsive-box">
                    <table class="data-guide-table">
                        <thead>
                            <tr>
                                <th>Nama Kolom</th>
                                <th>Kewajiban</th>
                                <th>Contoh Isi</th>
                                <th>Keterangan & Pilihan Dropdown</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>No KK</strong></td>
                                <td><span style="color:#ef4444; font-weight:700;">WAJIB</span></td>
                                <td><code>3273010101900001</code></td>
                                <td>16 digit nomor Kartu Keluarga (harus berupa teks/angka).</td>
                            </tr>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td><span style="color:#ef4444; font-weight:700;">WAJIB</span></td>
                                <td><code>3273010101900001</code></td>
                                <td>16 digit NIK anggota keluarga (tidak boleh duplikat).</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap</strong></td>
                                <td><span style="color:#ef4444; font-weight:700;">WAJIB</span></td>
                                <td><code>Bambang Sudarmono</code></td>
                                <td>Nama lengkap sesuai KTP.</td>
                            </tr>
                            <tr>
                                <td><strong>Status Hubungan</strong></td>
                                <td>Opsional</td>
                                <td><code>Kepala Keluarga</code></td>
                                <td>Pilihan: <em>Kepala Keluarga, Istri, Anak, Orang Tua, Anggota Keluarga</em>. Default: Anggota Keluarga.</td>
                            </tr>
                            <tr>
                                <td><strong>Status Perkawinan</strong></td>
                                <td>Opsional</td>
                                <td><code>Kawin</code></td>
                                <td>Pilihan: <em>Belum Kawin, Kawin, Cerai Hidup, Cerai Mati</em>. Default: Belum Kawin.</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>Opsional</td>
                                <td><code>Laki-laki</code></td>
                                <td>Pilihan: <em>Laki-laki</em> atau <em>Perempuan</em>. Default: Laki-laki.</td>
                            </tr>
                            <tr>
                                <td><strong>Tempat Lahir</strong></td>
                                <td>Opsional</td>
                                <td><code>Bandung</code></td>
                                <td>Kota/kabupaten kelahiran.</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td>Opsional</td>
                                <td><code>1985-05-12</code></td>
                                <td>Format: <code>YYYY-MM-DD</code> (contoh: 1985-05-12) atau <code>DD-MM-YYYY</code>.</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>Disarankan</td>
                                <td><code>Jl. Mawar No. 12 RT 04</code></td>
                                <td>Nama jalan dan nomor rumah domisili.</td>
                            </tr>
                            <tr>
                                <td><strong>Agama</strong></td>
                                <td>Opsional</td>
                                <td><code>Islam</code></td>
                                <td>Pilihan: <em>Islam, Kristen, Katolik, Hindu, Buddha, Konghucu, Lainnya</em>.</td>
                            </tr>
                            <tr>
                                <td><strong>Pekerjaan</strong></td>
                                <td>Opsional</td>
                                <td><code>Wiraswasta</code></td>
                                <td>Pilihan: <em>PNS, TNI/Polri, Karyawan Swasta, Wiraswasta, Pelajar, Ibu Rumah Tangga, Belum Bekerja</em>, dll.</td>
                            </tr>
                            <tr>
                                <td><strong>Status Hidup</strong></td>
                                <td>Opsional</td>
                                <td><code>Aktif</code></td>
                                <td>Pilihan: <em>Aktif, Pindah, Meninggal</em>. Default: Aktif.</td>
                            </tr>
                            <tr>
                                <td><strong>No HP / WhatsApp</strong></td>
                                <td>Disarankan</td>
                                <td><code>081234567890</code></td>
                                <td>Nomor WhatsApp aktif untuk pengiriman struk pembayaran dan notifikasi jimpitan.</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan (Role)</strong></td>
                                <td>Opsional</td>
                                <td><code>WARGA</code></td>
                                <td>Pilihan: <code>WARGA</code>, <code>PETUGAS RONDA</code>, <code>BENDAHARA</code>, atau <code>ADMIN_DESA</code>.</td>
                            </tr>
                            <tr>
                                <td><strong>Kode Rumah</strong></td>
                                <td>Otomatis</td>
                                <td><code>A-12</code> (Boleh Kosong)</td>
                                <td>Bisa dikosongkan. Sistem akan membuatkan kode rumah unik secara otomatis.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="step-sequence">
                    <div class="step-row">
                        <div class="step-badge">3</div>
                        <div class="step-content">
                            <div class="step-title">Simpan File Sebagai CSV (Comma Separated Values)</div>
                            <div class="step-desc">
                                Di Excel, klik <strong>Save As -> Format: CSV (Comma delimited) (*.csv)</strong> atau <strong>CSV UTF-8</strong>. Sistem Jimpitan cerdas mendukung pembatas koma (<code>,</code>) maupun titik-koma (<code>;</code>).
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">4</div>
                        <div class="step-content">
                            <div class="step-title">Unggah File CSV di Aplikasi Jimpitan APK</div>
                            <div class="step-desc">
                                Buka aplikasi Jimpitan di HP -> Buka menu <strong>Data Warga</strong> -> Ketuk ikon <strong>Import CSV</strong> di bilah atas -> Pilih file CSV yang sudah Anda isi -> Periksa pratinjau data valid -> Ketuk <strong>"Impor Sekarang"</strong>. Seluruh data KK dan warga langsung tersinkronisasi!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="callout-box callout-tip">
                    <i class="fa-solid fa-circle-check" style="font-size: 1.25rem; margin-top: 2px;"></i>
                    <div>
                        <strong>Otomatisasi NIK & Join Warga:</strong> Setelah data warga diimpor melalui CSV, ketika warga asli mengunduh aplikasi dan melakukan <em>"Join Desa"</em> dengan memasukkan NIK-nya, akun warga tersebut akan <strong>langsung aktif secara otomatis</strong> tanpa perlu persetujuan manual lagi!
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 05: OPERASIONAL RONDA & SCAN QR JIMPITAN -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-scan-qr">
                <div class="card-header-meta">
                    <span class="module-badge badge-ronda"><i class="fa-solid fa-shield-halved"></i> Modul 05 • Petugas Ronda Malam</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-scan-qr')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">5. Operasional Ronda & Scan QR Jimpitan Harian</h2>
                <p class="card-lead">
                    Tradisi jimpitan koin/beras kini menjadi modern dan transparan! Petugas ronda berkeliling di malam hari sambil memindai stiker QR Code di tiap rumah warga menggunakan kamera HP.
                </p>

                <div class="module-body-grid">
                    <div class="module-steps">
                        <div class="step-sequence">
                            <div class="step-row">
                                <div class="step-badge">1</div>
                                <div class="step-content">
                                    <div class="step-title">Buka Menu "Scan Jimpitan"</div>
                                    <div class="step-desc">
                                        Saat jam patroli ronda dimulai, petugas membuka menu <strong>Scan Jimpitan</strong> di HP. Kamera belakang akan otomatis aktif dengan lampu kilat (flash) jika lingkungan gelap.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">2</div>
                                <div class="step-content">
                                    <div class="step-title">Fitur Layar Tetap Menyala (Wakelock)</div>
                                    <div class="step-desc">
                                        Aplikasi Jimpitan secara cerdas mengaktifkan <em>Wakelock</em>, sehingga layar HP tidak akan terkunci atau mati sendiri selama petugas berjalan keliling ronda.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">3</div>
                                <div class="step-content">
                                    <div class="step-title">Arahkan Kamera ke Stiker QR Code Rumah</div>
                                    <div class="step-desc">
                                        Arahkan kamera ke kode QR di depan rumah warga. Seketika berbunyi nada <strong>Beep</strong> dan layar menampilkan notifikasi sukses berisi: Nama Kepala Keluarga, Nomor Rumah, Nominal Jimpitan (misal: Rp 1.000), dan Nama Petugas Ronda.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">4</div>
                                <div class="step-content">
                                    <div class="step-title">Rekap Realtime Otomatis</div>
                                    <div class="step-desc">
                                        Total rumah yang sudah discan dan akumulasi saldo jimpitan malam ini otomatis bertambah secara live (diperbarui setiap 3 detik) tanpa perlu hitung manual.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="callout-box callout-info">
                            <i class="fa-solid fa-bell" style="font-size: 1.25rem; margin-top: 2px;"></i>
                            <div>
                                <strong>Pencegahan Scan Ganda:</strong> Sistem memiliki proteksi anti-duplikasi. Jika rumah yang sama discan dua kali pada malam yang sama, aplikasi akan menampilkan peringatan bahwa rumah tersebut sudah dijimpit malam ini.
                            </div>
                        </div>
                    </div>

                    <!-- Scanner Simulation Mockup -->
                    <div class="module-visual">
                        <div class="phone-mockup-frame" style="background:#090d16;">
                            <div class="phone-screen" style="background:#0f172a; padding: 1.25rem; color:#fff;">
                                <div style="display:flex; justify-content:space-between; align-items:center; font-size:0.8rem; margin-bottom:0.75rem;">
                                    <span><i class="fa-solid fa-moon" style="color:#f59e0b;"></i> Ronda Malam</span>
                                    <span style="background:#10b981; padding:2px 8px; border-radius:99px; font-weight:700; font-size:0.7rem;">LIVE SCAN</span>
                                </div>
                                <div class="scanner-camera-view">
                                    <div style="font-size:0.75rem; color:#94a3b8;">Arahkan ke QR Code Rumah</div>
                                    <div class="scanner-reticle">
                                        <div class="scanner-beam"></div>
                                        <i class="fa-solid fa-qrcode" style="font-size:3.5rem; opacity:0.6; color:#a7f3d0;"></i>
                                    </div>
                                    <div style="background:rgba(16,185,129,0.2); border:1px solid #10b981; border-radius:8px; padding:6px; margin-top:8px;">
                                        <div style="font-size:0.75rem; font-weight:700; color:#34d399;">Bambang S (No. 45)</div>
                                        <div style="font-size:0.7rem; color:#d1fae5;">Nominal: Rp 1.000 (Berhasil)</div>
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:space-between; margin-top:0.85rem; font-size:0.75rem;">
                                    <span>Terkumpul: <strong>Rp 48.000</strong></span>
                                    <span>Rumah: <strong>48 / 65 KK</strong></span>
                                </div>
                            </div>
                        </div>
                        <span class="visual-caption">Simulasi Layar Scanner Jimpitan Realtime</span>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 06: INPUT MANUAL & CHECKLIST WARGA -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-checklist-manual">
                <div class="card-header-meta">
                    <span class="module-badge badge-ronda"><i class="fa-solid fa-list-check"></i> Modul 06 • Petugas Ronda</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-checklist-manual')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">6. Input Manual & Checklist Warga Belum Discan</h2>
                <p class="card-lead">
                    Bagaimana jika stiker QR di depan rumah basah terkena hujan, rusak, atau warga menitipkan uang jimpitan secara langsung? Jimpitan menyediakan fitur <strong>Checklist Warga & Input Manual</strong>.
                </p>

                <div class="step-sequence">
                    <div class="step-row">
                        <div class="step-badge">1</div>
                        <div class="step-content">
                            <div class="step-title">Buka Tab "Checklist Warga" di Halaman Scan</div>
                            <div class="step-desc">
                                Pada halaman scanner, ketuk tab <strong>"Belum Discan"</strong> atau buka menu <strong>Input Manual Jimpitan</strong>.
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">2</div>
                        <div class="step-content">
                            <div class="step-title">Cari Nama Warga / Nomor Rumah</div>
                            <div class="step-desc">
                                Gunakan kolom pencarian cepat untuk mencari nama kepala keluarga atau nomor rumah warga yang bersangkutan.
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">3</div>
                        <div class="step-content">
                            <div class="step-title">Ketuk Checklist untuk Mencatat Jimpitan</div>
                            <div class="step-desc">
                                Cukup ketuk ikon centang di samping nama warga. Nominal jimpitan harian langsung tercatat sama seperti saat memindai QR Code, lengkap dengan catatan bahwa entri dicatat melalui input manual.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="callout-box callout-tip">
                    <i class="fa-solid fa-magnifying-glass" style="font-size: 1.25rem; margin-top: 2px;"></i>
                    <div>
                        <strong>Pantau Rumah Terlewat:</strong> Tab <em>"Belum Discan"</em> memudahkan regu ronda memantau rumah-rumah mana saja yang belum didatangi, sehingga tidak ada warga yang terlewatkan sebelum putaran ronda selesai.
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 07: SETOR JIMPITAN KE BENDAHARA -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-setor-ronda">
                <div class="card-header-meta">
                    <span class="module-badge badge-bendahara"><i class="fa-solid fa-hand-holding-dollar"></i> Modul 07 • Ronda & Bendahara</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-setor-ronda')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">7. Penyetoran Hasil Jimpitan ke Bendahara</h2>
                <p class="card-lead">
                    Setelah putaran ronda selesai, uang koin/tunai jimpitan yang terkumpul di kaleng ronda harus diserahterimakan kepada Bendahara RT untuk dimasukkan ke pembukuan resmi.
                </p>

                <div class="step-sequence">
                    <div class="step-row">
                        <div class="step-badge">1</div>
                        <div class="step-content">
                            <div class="step-title">Petugas Ronda Membuka Menu "Setor Jimpitan"</div>
                            <div class="step-desc">
                                Aplikasi secara otomatis menampilkan rekap: jumlah rumah yang dijimpit malam ini, daftar nama petugas yang bertugas, dan <strong>Total Uang Fisik yang Harus Disetor</strong> (contoh: 58 rumah x Rp 1.000 = Rp 58.000).
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">2</div>
                        <div class="step-content">
                            <div class="step-title">Serahkan Uang Fisik ke Bendahara RT</div>
                            <div class="step-desc">
                                Petugas menyerahkan uang fisik hasil jimpitan kepada Bendahara. Bendahara menghitung kecocokan nominal uang dengan aplikasi.
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">3</div>
                        <div class="step-content">
                            <div class="step-title">Konfirmasi Setoran & Masuk Buku Kas Otomatis</div>
                            <div class="step-desc">
                                Begitu Bendahara menekan <strong>"Konfirmasi Terima Setoran"</strong>, uang setoran tersebut otomatis tercatat sebagai <strong>Pemasukan Kas Lingkungan</strong> di Buku Kas tanpa perlu input ulang.
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 08: PEMBAYARAN IURAN KAS RT & STRUK -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-iuran-warga">
                <div class="card-header-meta">
                    <span class="module-badge badge-bendahara"><i class="fa-solid fa-money-check-dollar"></i> Modul 08 • Keuangan & Warga</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-iuran-warga')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">8. Pembayaran Iuran Kas RT & Tagihan KK</h2>
                <p class="card-lead">
                    Pencatatan iuran bulanan warga (Kas RT, Kebersihan/Sampah, Kematian, Pembangunan) yang transparan dengan kartu status 12 bulan dan struk digital resmi format PDF.
                </p>

                <div class="module-body-grid">
                    <div class="module-steps">
                        <div class="step-sequence">
                            <div class="step-row">
                                <div class="step-badge">1</div>
                                <div class="step-content">
                                    <div class="step-title">Pilih Nama Kartu Keluarga (KK)</div>
                                    <div class="step-desc">
                                        Masuk ke menu <strong>Iuran Warga</strong> -> pilih jenis iuran (misal: <em>Iuran Kas RT Rp 25.000/bulan</em>) -> pilih nama Kepala Keluarga yang ingin membayar.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">2</div>
                                <div class="step-content">
                                    <div class="step-title">Lihat Kartu 12 Bulan (Januari s.d. Desember)</div>
                                    <div class="step-desc">
                                        Layar menampilkan kisi 12 bulan untuk tahun bersangkutan:
                                        <ul style="margin: 0.35rem 0 0 1.25rem;">
                                            <li><span style="color:#10b981; font-weight:700;">Warna Hijau (LUNAS)</span>: Bulan yang sudah dibayar.</li>
                                            <li><span style="color:#64748b; font-weight:700;">Warna Abu-abu / Merah</span>: Bulan yang belum lunas / tertunggak.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">3</div>
                                <div class="step-content">
                                    <div class="step-title">Ketuk Bulan yang Ingin Dibayar</div>
                                    <div class="step-desc">
                                        Warga bisa membayar 1 bulan, beberapa bulan, atau langsung 1 tahun sekaligus dengan mengetuk kotak bulan yang diinginkan.
                                    </div>
                                </div>
                            </div>

                            <div class="step-row">
                                <div class="step-badge">4</div>
                                <div class="step-content">
                                    <div class="step-title">Cetak Kuitansi PDF & Kirim via WhatsApp</div>
                                    <div class="step-desc">
                                        Setelah pembayaran disimpan, aplikasi dapat mencetak <strong>Struk Kuitansi Resmi PDF</strong> dan langsung mengirimkannya ke nomor WhatsApp warga dengan 1 ketukan tombol!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visual Dues Card -->
                    <div class="module-visual">
                        <div class="mockup-ui-card" style="width:100%;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.75rem;">
                                <div>
                                    <div style="font-weight:800; font-size:0.95rem;">Bambang S (KK)</div>
                                    <div style="font-size:0.75rem; color:var(--text-muted);">Iuran Kas RT 04 (Rp 25.000/bln)</div>
                                </div>
                                <span style="background:var(--primary-light); color:var(--primary-dark); padding:2px 8px; border-radius:99px; font-weight:700; font-size:0.7rem;">Tahun 2026</span>
                            </div>
                            
                            <div class="dues-grid-mockup">
                                <div class="dues-month-box dues-paid">JAN<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">FEB<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">MAR<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">APR<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">MEI<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">JUN<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">JUL<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">AGU<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">SEP<br>✓ Lunas</div>
                                <div class="dues-month-box dues-paid">OKT<br>✓ Lunas</div>
                                <div class="dues-month-box dues-unpaid">NOV<br>Pending</div>
                                <div class="dues-month-box dues-unpaid">DES<br>Pending</div>
                            </div>

                            <button class="btn-pill-action btn-pill-wa" style="width:100%; justify-content:center; margin-top:1rem; border-radius:10px;">
                                <i class="fa-brands fa-whatsapp"></i> Kirim Struk Kuitansi ke WA Warga
                            </button>
                        </div>
                        <span class="visual-caption">Simulasi Tampilan Kartu Iuran 12 Bulan Warga</span>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 09: BUKU KAS & JURNAL KEUANGAN RT -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-buku-kas">
                <div class="card-header-meta">
                    <span class="module-badge badge-bendahara"><i class="fa-solid fa-book-bookmark"></i> Modul 09 • Transparansi Kas</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-buku-kas')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">9. Buku Kas & Jurnal Keuangan RT</h2>
                <p class="card-lead">
                    Seluruh aliran dana masuk dan keluar tercatat dengan audit trail lengkap. Menghilangkan kecurigaan antar warga dan menjaga transparansi amanah pengurus RT.
                </p>

                <div class="step-sequence">
                    <div class="step-row">
                        <div class="step-badge">1</div>
                        <div class="step-content">
                            <div class="step-title">Pemasukan Otomatis (Auto-Journal)</div>
                            <div class="step-desc">
                                Setiap setoran jimpitan ronda dan pembayaran iuran bulanan warga <strong>otomatis masuk</strong> sebagai jurnal penerimaan kas tanpa bendahara perlu mengetik ulang nominal.
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">2</div>
                        <div class="step-content">
                            <div class="step-title">Pencatatan Pengeluaran Kas & Bukti Nota</div>
                            <div class="step-desc">
                                Untuk pengeluaran operasional (contoh: membeli lampu jalan, konsumsi kerja bakti, santunan duka cita):
                                <ul style="margin: 0.35rem 0 0 1.25rem;">
                                    <li>Ketuk tombol <strong>"+ Pengeluaran Baru"</strong></li>
                                    <li>Isi nominal uang, kategori pengeluaran, dan keterangan</li>
                                    <li>Ambil foto kuitansi/nota fisik sebagai bukti sah yang tersimpan di sistem</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">3</div>
                        <div class="step-content">
                            <div class="step-title">Cetak Laporan Keuangan Bulanan</div>
                            <div class="step-desc">
                                Di akhir bulan atau saat rapat RT, pengurus dapat mengunduh dan mencetak rekapitulasi buku kas format PDF lengkap dengan rincian saldo awal, total pemasukan, total pengeluaran, dan saldo kas akhir.
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 10: JADWAL RONDA MALAM -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-jadwal-ronda">
                <div class="card-header-meta">
                    <span class="module-badge badge-ronda"><i class="fa-solid fa-calendar-check"></i> Modul 10 • Keamanan Lingkungan</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-jadwal-ronda')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">10. Penjadwalan Ronda Malam & Regu Piket</h2>
                <p class="card-lead">
                    Mengatur jadwal giliran ronda malam warga dari hari Senin hingga Minggu, lengkap dengan susunan regu ronda dan notifikasi pengingat otomatis.
                </p>

                <div class="step-sequence">
                    <div class="step-row">
                        <div class="step-badge">1</div>
                        <div class="step-content">
                            <div class="step-title">Buka Menu "Jadwal Ronda"</div>
                            <div class="step-desc">
                                Admin/Pengurus membuka menu Jadwal Ronda, lalu memilih hari yang ingin diatur (Senin s.d. Minggu).
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">2</div>
                        <div class="step-content">
                            <div class="step-title">Pilih Nama Petugas Ronda per Hari</div>
                            <div class="step-desc">
                                Centang nama-nama warga yang bertugas pada regu malam tersebut. Warga yang ditugaskan otomatis mendapatkan hak akses membuka menu scanner jimpitan saat malam tugas mereka tiba.
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">3</div>
                        <div class="step-content">
                            <div class="step-title">Warga Melihat Jadwal Gilirannya Sendiri</div>
                            <div class="step-desc">
                                Seluruh warga lingkungan dapat melihat di HP masing-masing kapan jadwal ronda mereka tiba tanpa perlu melihat papan tulis pos kamling lagi.
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 11: INVENTARIS BARANG RT -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-inventaris">
                <div class="card-header-meta">
                    <span class="module-badge badge-rt"><i class="fa-solid fa-boxes-stacked"></i> Modul 11 • Aset Lingkungan</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-inventaris')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">11. Inventaris Barang RT & Peminjaman Warga</h2>
                <p class="card-lead">
                    Mencatat seluruh aset kepunyaan lingkungan (kursi lipat, terpal/tenda, sound system, mesin pemotong rumput) dan memantau status peminjaman warga agar barang tidak hilang.
                </p>

                <div class="step-sequence">
                    <div class="step-row">
                        <div class="step-badge">1</div>
                        <div class="step-content">
                            <div class="step-title">Pencatatan Master Barang Aset</div>
                            <div class="step-desc">
                                Masukkan nama barang, jumlah unit, kondisi fisik (Baik/Rusak), dan lokasi penyimpanan (misal: Pos Ronda atau Rumah Ketua RT).
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">2</div>
                        <div class="step-content">
                            <div class="step-title">Pencatatan Peminjaman Warga</div>
                            <div class="step-desc">
                                Saat ada warga mengadakan hajatan atau tasyakuran yang meminjam barang:
                                <ul style="margin: 0.35rem 0 0 1.25rem;">
                                    <li>Pilih nama warga peminjam</li>
                                    <li>Pilih barang & jumlah yang dipinjam (contoh: 50 Kursi Plastik & 1 Tenda)</li>
                                    <li>Tentukan tanggal pinjam dan rencana tanggal pengembalian</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">3</div>
                        <div class="step-content">
                            <div class="step-title">Pengembalian & Pengecekan Kondisi</div>
                            <div class="step-desc">
                                Saat barang dikembalikan, pengurus memverifikasi jumlah dan kondisi barang. Stok barang di sistem otomatis kembali tersedia.
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 12: CHAT & PENGUMUMAN RT -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-chat">
                <div class="card-header-meta">
                    <span class="module-badge badge-warga"><i class="fa-solid fa-bullhorn"></i> Modul 12 • Komunikasi Warga</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-chat')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">12. Fitur Chat & Siaran Pengumuman RT</h2>
                <p class="card-lead">
                    Saluran komunikasi resmi khusus lingkungan RT/RW tanpa khawatir tertimbun obrolan grup WhatsApp umum.
                </p>

                <div class="step-sequence">
                    <div class="step-row">
                        <div class="step-badge">1</div>
                        <div class="step-content">
                            <div class="step-title">Siaran Pengumuman Resmi Pengurus</div>
                            <div class="step-desc">
                                Ketua RT atau pengurus dapat mengirimkan siaran resmi kepada seluruh warga, seperti: pengumuman kerja bakti hari Minggu, peringatan 17 Agustus, informasi pemadaman air/listrik, atau berita lelayu (duka cita).
                            </div>
                        </div>
                    </div>

                    <div class="step-row">
                        <div class="step-badge">2</div>
                        <div class="step-content">
                            <div class="step-title">Chat Langsung Antar Pengurus & Warga</div>
                            <div class="step-desc">
                                Warga dapat mengirim pesan konfirmasi atau bertanya perihal administrasi surat pengantar secara langsung kepada Ketua RT atau Bendahara.
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 13: MANAJEMEN HAK AKSES (ROLES) -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-roles">
                <div class="card-header-meta">
                    <span class="module-badge badge-rt"><i class="fa-solid fa-users-gear"></i> Modul 13 • Keamanan & Otoritas</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-roles')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">13. Manajemen Hak Akses & Peran (Roles)</h2>
                <p class="card-lead">
                    Setiap pengguna di aplikasi Jimpitan memiliki batasan hak akses sesuai tugasnya di lingkungan, menjamin keamanan data pribadi dan keuangan RT.
                </p>

                <div class="table-responsive-box">
                    <table class="data-guide-table">
                        <thead>
                            <tr>
                                <th>Peran (Role)</th>
                                <th>Target Pengguna</th>
                                <th>Hak Akses Utama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="module-badge badge-rt">ADMIN DESA / KETUA RT</span></td>
                                <td>Ketua RT, RW, atau Kepala Desa</td>
                                <td>Kewenangan penuh: Mengatur profil desa, menyetujui warga baru, mengubah tarif iuran, mengatur role pengguna, dan mengelola inventaris.</td>
                            </tr>
                            <tr>
                                <td><span class="module-badge badge-bendahara">BENDAHARA</span></td>
                                <td>Bendahara RT / Seksi Keuangan</td>
                                <td>Mencatat iuran bulanan warga, menerima setoran uang jimpitan dari petugas ronda, mencatat pengeluaran kas, dan mencetak kuitansi/laporan keuangan.</td>
                            </tr>
                            <tr>
                                <td><span class="module-badge badge-ronda">PETUGAS RONDA</span></td>
                                <td>Warga yang mendapat giliran ronda</td>
                                <td>Memindai stiker QR jimpitan keliling, melihat checklist rumah belum dijimpit, input jimpitan manual, dan menyerahkan setoran ronda ke bendahara.</td>
                            </tr>
                            <tr>
                                <td><span class="module-badge badge-warga">WARGA BIASA</span></td>
                                <td>Seluruh warga lingkungan</td>
                                <td>Melihat kartu status iuran keluarga sendiri (Lunas/Pending), riwayat scan jimpitan rumahnya, melihat jadwal ronda, dan membaca siaran pengumuman.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>

            <!-- ========================================== -->
            <!-- MODUL 14: TANYA JAWAB (FAQ) -->
            <!-- ========================================== -->
            <article class="tutorial-card" id="modul-faq">
                <div class="card-header-meta">
                    <span class="module-badge badge-warga"><i class="fa-solid fa-circle-question"></i> Modul 14 • Bantuan Cepat</span>
                    <button class="btn-copy-link" onclick="copySectionLink('modul-faq')">
                        <i class="fa-regular fa-copy"></i> Salin Link
                    </button>
                </div>
                <h2 class="card-title">14. Tanya Jawab (FAQ) & Solusi Kendala Lapangan</h2>
                <p class="card-lead">
                    Pertanyaan yang paling sering diajukan oleh pengurus RT dan warga saat menggunakan aplikasi Jimpitan.
                </p>

                <div class="faq-accordion">
                    <div class="faq-item open">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>Bagaimana jika warga belum memiliki HP Android / tidak mengerti aplikasi?</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            Tidak masalah sama sekali! Warga yang tidak memiliki HP tetap bisa didaftarkan oleh Admin RT melalui formulir data warga atau Import CSV. Rumah mereka tetap mendapatkan stiker QR Code jimpitan dan tetap bisa dijimpit oleh petugas ronda, serta dicatat iuran bulanannya oleh bendahara.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>Bagaimana cara mencetak stiker QR Code untuk rumah warga?</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            Buka menu <strong>Data Warga</strong> di aplikasi, pilih salah satu Kartu Keluarga atau tekan tombol <strong>Cetak Semua QR Warga</strong>. Aplikasi akan menghasilkan dokumen PDF berisi kumpulan stiker QR Code yang siap dicetak di kertas stiker dan ditempelkan di depan pintu rumah warga.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>Apakah satu akun Google bisa dipakai di dua desa berbeda?</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            Satu akun Google hanya dapat terdaftar aktif di 1 desa untuk mencegah tumpang tindih data kependudukan. Jika seorang warga pindah rumah ke desa lain, admin desa lama dapat menonaktifkan status warga tersebut terlebih dahulu.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>Apakah aplikasi Jimpitan aman dan terjamin kerahasiaan datanya?</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            Sangat aman. Sistem Jimpitan menggunakan enkripsi standar industri, autentikasi aman via Google Firebase, pembatasan hak akses berbasis peran (Role-Based Access Control), dan sistem audit log aktivitas yang mencatat setiap aksi transaksi di lingkungan Anda.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>Di mana saya bisa mengunduh file template CSV warga?</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            Anda dapat mengunduhnya langsung dari tombol <strong>"Unduh Format CSV"</strong> di bagian atas halaman web ini atau melalui tombol unduh di Modul 04. Anda juga bisa mengunduhnya langsung dari dalam aplikasi Jimpitan di menu <em>Bantuan & Info Desa</em>.
                        </div>
                    </div>
                </div>
            </article>

        </main>
    </div>

    <!-- Footer -->
    <footer class="tutorial-footer">
        <div class="footer-links">
            <a href="<?= base_url('/') ?>" target="_blank"><i class="fa-solid fa-gauge-high"></i> Portal Admin Jimpitan</a>
            <a href="<?= base_url('tutorial/download_template') ?>"><i class="fa-solid fa-file-csv"></i> Unduh Template CSV</a>
            <a href="https://play.google.com/store/apps/details?id=jimpitan.appsbee.my.id" target="_blank"><i class="fa-brands fa-google-play"></i> Unduh APK di Google Play</a>
            <a href="https://wa.me/?text=Buku%20Panduan%20Jimpitan:%20<?= urlencode(base_url('/tutorial')) ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i> Bagikan ke Grup RT</a>
        </div>
        <p>&copy; <?= date('Y') ?> Jimpitan Mobile Application • Dikelola oleh Tim Pengembang Appsbee. Hak cipta dilindungi undang-undang.</p>
    </footer>

    <!-- Lightbox Zoom Modal for Mobile/Desktop -->
    <div class="lightbox-modal" id="lightbox-modal" onclick="closeLightbox(event)">
        <div class="lightbox-content">
            <button class="lightbox-close" onclick="closeLightbox(event)" title="Tutup Zoom"><i class="fa-solid fa-xmark"></i></button>
            <img src="" alt="Zoom Screenshot" class="lightbox-img" id="lightbox-img">
            <div class="lightbox-caption" id="lightbox-caption"></div>
        </div>
    </div>

    <!-- Floating Back to Top Button -->
    <button class="fab-scroll-top" id="fab-scroll-top" title="Kembali ke atas" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- Copy Section Link Toast -->
    <div class="copy-toast" id="copy-toast">
        <i class="fa-solid fa-check-circle" style="color:#10b981;"></i>
        <span>Tautan bab berhasil disalin! Siap dibagikan ke WhatsApp.</span>
    </div>

    <script>
        // Theme Toggle (Dark / Light mode) with localStorage persistence
        const btnTheme = document.getElementById('btn-theme-toggle');
        const currentTheme = localStorage.getItem('jimpitan_tutorial_theme');
        if (currentTheme === 'dark' || (!currentTheme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark-mode');
            btnTheme.innerHTML = '<i class="fa-solid fa-sun"></i>';
        }

        btnTheme.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            btnTheme.innerHTML = isDark ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';
            localStorage.setItem('jimpitan_tutorial_theme', isDark ? 'dark' : 'light');
        });

        // Floating Back To Top button visibility on scroll
        const fabTop = document.getElementById('fab-scroll-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                fabTop.classList.add('visible');
            } else {
                fabTop.classList.remove('visible');
            }
            updateActiveToc();
        });

        // Live Search Filter
        const searchInput = document.getElementById('live-search');
        const searchClear = document.getElementById('search-clear');
        const cards = document.querySelectorAll('.tutorial-card');

        searchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            if (query.length > 0) {
                searchClear.style.display = 'block';
            } else {
                searchClear.style.display = 'none';
            }

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (query === '' || text.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            searchClear.style.display = 'none';
            cards.forEach(card => card.style.display = 'block');
            searchInput.focus();
        });

        // Lightbox Functions
        function openLightbox(src, caption) {
            const modal = document.getElementById('lightbox-modal');
            const img = document.getElementById('lightbox-img');
            const cap = document.getElementById('lightbox-caption');
            img.src = src;
            cap.textContent = caption || 'Pratinjau Layar';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox(e) {
            if (e.target.id === 'lightbox-modal' || e.target.classList.contains('lightbox-close') || e.target.parentElement.classList.contains('lightbox-close')) {
                const modal = document.getElementById('lightbox-modal');
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const modal = document.getElementById('lightbox-modal');
                if (modal.classList.contains('active')) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        });

        // Copy Section Direct URL Link
        function copySectionLink(sectionId) {
            const url = window.location.origin + window.location.pathname + '#' + sectionId;
            navigator.clipboard.writeText(url).then(() => {
                showToast('Tautan bab berhasil disalin! Siap dibagikan ke WhatsApp.');
            }).catch(() => {
                // Fallback prompt
                prompt('Salin tautan ini untuk dibagikan:', url);
            });
        }

        function showToast(message) {
            const toast = document.getElementById('copy-toast');
            toast.querySelector('span').textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Toggle FAQ Accordion
        function toggleFaq(el) {
            const item = el.parentElement;
            item.classList.toggle('open');
        }

        // Highlight Active TOC Item on Scroll
        function updateActiveToc() {
            const fromTop = window.scrollY + 120;
            const tocLinks = document.querySelectorAll('.toc-item a, .topic-pill');
            
            cards.forEach(card => {
                if (card.offsetTop <= fromTop && (card.offsetTop + card.offsetHeight) > fromTop) {
                    const id = card.getAttribute('id');
                    tocLinks.forEach(link => {
                        if (link.getAttribute('href') === '#' + id) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>
