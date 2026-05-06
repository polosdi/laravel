<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPKL — Sistem Informasi Praktik Kerja Lapangan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #667eea;
            --primary-end: #764ba2;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --bg: #F8F9FA;
            --surface: #ffffff;
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --border: rgba(102,126,234,0.15);
            --shadow: 0 20px 60px rgba(102,126,234,0.15);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ─── NOISE TEXTURE OVERLAY ─── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

        /* ─── NAVBAR ─── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 20px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(248,249,250,0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .nav-logo-text {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 36px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--primary); }

        .btn-nav {
            padding: 10px 24px;
            background: var(--gradient);
            color: white !important;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 20px rgba(102,126,234,0.35);
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(102,126,234,0.45) !important;
        }

        /* ─── HERO ─── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 60px 80px;
            position: relative;
            overflow: hidden;
        }

        /* Animated gradient orbs */
        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            animation: floatOrb 8s ease-in-out infinite;
        }

        .hero-orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #667eea, transparent);
            top: -100px; right: -100px;
            animation-delay: 0s;
        }

        .hero-orb-2 {
            width: 350px; height: 350px;
            background: radial-gradient(circle, #764ba2, transparent);
            bottom: 0; left: 20%;
            animation-delay: 3s;
        }

        .hero-orb-3 {
            width: 250px; height: 250px;
            background: radial-gradient(circle, #a78bfa, transparent);
            top: 30%; left: -50px;
            animation-delay: 5s;
        }

        @keyframes floatOrb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(20px, -30px) scale(1.05); }
            66% { transform: translate(-15px, 20px) scale(0.95); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: rgba(102,126,234,0.1);
            border: 1px solid rgba(102,126,234,0.25);
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 28px;
            animation: fadeSlideUp 0.6s ease both;
        }

        .hero-badge::before {
            content: '';
            width: 8px; height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.4); }
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2.8rem, 5vw, 4.2rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 24px;
            animation: fadeSlideUp 0.6s ease 0.1s both;
        }

        .hero-title .highlight {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
        }

        .hero-desc {
            font-size: 1.05rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 40px;
            animation: fadeSlideUp 0.6s ease 0.2s both;
        }

        .hero-cta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            animation: fadeSlideUp 0.6s ease 0.3s both;
        }

        .btn-primary {
            padding: 14px 32px;
            background: var(--gradient);
            color: white;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 30px rgba(102,126,234,0.4);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 40px rgba(102,126,234,0.5);
        }

        .btn-secondary {
            padding: 14px 32px;
            background: white;
            color: var(--text);
            border: 2px solid var(--border);
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-3px);
        }

        /* ─── HERO VISUAL ─── */
        .hero-visual {
            position: absolute;
            right: 60px;
            top: 50%;
            transform: translateY(-50%);
            width: 480px;
            animation: fadeSlideLeft 0.8s ease 0.4s both;
        }

        @keyframes fadeSlideLeft {
            from { opacity: 0; transform: translateY(-50%) translateX(40px); }
            to { opacity: 1; transform: translateY(-50%) translateX(0); }
        }

        .dashboard-preview {
            background: white;
            border-radius: 24px;
            padding: 24px;
            box-shadow: var(--shadow), 0 0 0 1px var(--border);
            position: relative;
        }

        .dash-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .dash-dot {
            width: 12px; height: 12px;
            border-radius: 50%;
        }

        .dash-dot.red { background: #ff5f57; }
        .dash-dot.yellow { background: #febc2e; }
        .dash-dot.green { background: #28c840; }

        .dash-title-bar {
            margin-left: auto;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            background: var(--bg);
            padding: 4px 12px;
            border-radius: 20px;
        }

        .dash-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .dash-stat {
            padding: 16px;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        .dash-stat-1 { background: linear-gradient(135deg, #667eea20, #764ba210); border: 1px solid rgba(102,126,234,0.2); }
        .dash-stat-2 { background: linear-gradient(135deg, #22c55e20, #16a34a10); border: 1px solid rgba(34,197,94,0.2); }
        .dash-stat-3 { background: linear-gradient(135deg, #f59e0b20, #d9770010); border: 1px solid rgba(245,158,11,0.2); }
        .dash-stat-4 { background: linear-gradient(135deg, #ec489920, #db277710); border: 1px solid rgba(236,72,153,0.2); }

        .dash-stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text);
        }

        .dash-stat-label {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 2px;
        }

        .dash-progress-section {
            margin-bottom: 14px;
        }

        .dash-progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .dash-progress-bar {
            height: 8px;
            background: var(--bg);
            border-radius: 10px;
            overflow: hidden;
        }

        .dash-progress-fill {
            height: 100%;
            border-radius: 10px;
            background: var(--gradient);
            animation: expandBar 1.5s ease 0.8s both;
        }

        @keyframes expandBar {
            from { width: 0; }
        }

        .dash-progress-fill.green { background: linear-gradient(90deg, #22c55e, #16a34a); }
        .dash-progress-fill.amber { background: linear-gradient(90deg, #f59e0b, #d97706); }

        .dash-students {
            display: flex;
            align-items: center;
            gap: -6px;
        }

        .dash-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            border: 2px solid white;
            margin-left: -6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            color: white;
        }

        .dash-avatar:first-child { margin-left: 0; }

        .dash-avatar-1 { background: linear-gradient(135deg, #667eea, #764ba2); }
        .dash-avatar-2 { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .dash-avatar-3 { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .dash-avatar-4 { background: linear-gradient(135deg, #ec4899, #db2777); }
        .dash-avatar-more { background: var(--bg); color: var(--text-muted) !important; font-size: 0.65rem !important; }

        .dash-students-info {
            margin-left: 10px;
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Floating card */
        .float-card {
            position: absolute;
            background: white;
            border-radius: 16px;
            padding: 14px 18px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: floatCard 3s ease-in-out infinite;
        }

        .float-card-1 {
            bottom: -20px;
            left: -30px;
            animation-delay: 0s;
        }

        .float-card-2 {
            top: -20px;
            right: -20px;
            animation-delay: 1.5s;
        }

        @keyframes floatCard {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .float-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .float-icon.purple { background: rgba(102,126,234,0.15); }
        .float-icon.green { background: rgba(34,197,94,0.15); }

        .float-text-main { font-size: 0.85rem; font-weight: 700; color: var(--text); }
        .float-text-sub { font-size: 0.72rem; color: var(--text-muted); font-weight: 500; }

        /* ─── STATS SECTION ─── */
        .stats-section {
            padding: 80px 60px;
            background: white;
            position: relative;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2px;
            max-width: 1100px;
            margin: 0 auto;
            background: var(--border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .stat-item {
            background: white;
            padding: 48px 36px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: linear-gradient(135deg, rgba(102,126,234,0.04), rgba(118,75,162,0.04));
        }

        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 6px;
        }

        /* ─── FEATURES ─── */
        .features-section {
            padding: 100px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .section-label::before {
            content: '';
            display: block;
            width: 24px;
            height: 2px;
            background: var(--gradient);
            border-radius: 2px;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2rem, 3.5vw, 2.8rem);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 16px;
        }

        .section-desc {
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 540px;
            line-height: 1.7;
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .feature-card:hover::before { transform: scaleX(1); }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(102,126,234,0.15);
            border-color: rgba(102,126,234,0.3);
        }

        .feature-icon {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, rgba(102,126,234,0.12), rgba(118,75,162,0.08));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
            border: 1px solid rgba(102,126,234,0.15);
        }

        .feature-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text);
        }

        .feature-desc {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .feature-tag {
            display: inline-block;
            margin-top: 16px;
            padding: 4px 12px;
            background: rgba(102,126,234,0.08);
            color: var(--primary);
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        /* ─── ROLES SECTION ─── */
        .roles-section {
            padding: 100px 60px;
            background: white;
        }

        .roles-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .roles-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 60px;
        }

        .role-card {
            border-radius: 20px;
            padding: 32px 24px;
            transition: all 0.3s ease;
            cursor: default;
        }

        .role-card-1 {
            background: linear-gradient(135deg, #667eea15, #764ba208);
            border: 1px solid rgba(102,126,234,0.2);
        }

        .role-card-2 {
            background: linear-gradient(135deg, #22c55e15, #16a34a08);
            border: 1px solid rgba(34,197,94,0.2);
        }

        .role-card-3 {
            background: linear-gradient(135deg, #f59e0b15, #d9770608);
            border: 1px solid rgba(245,158,11,0.2);
        }

        .role-card-4 {
            background: linear-gradient(135deg, #ec489915, #db277708);
            border: 1px solid rgba(236,72,153,0.2);
        }

        .role-card:hover { transform: translateY(-4px); }

        .role-emoji {
            font-size: 2.5rem;
            margin-bottom: 16px;
            display: block;
        }

        .role-name {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .role-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .role-features {
            margin-top: 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .role-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .role-feature-item::before {
            content: '✓';
            flex-shrink: 0;
            font-weight: 700;
            color: var(--primary);
            margin-top: 1px;
        }

        /* ─── TESTIMONIALS ─── */
        .testimonials-section {
            padding: 100px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 60px;
        }

        .testimonial-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(102,126,234,0.1);
        }

        .testimonial-stars {
            color: #f59e0b;
            font-size: 1rem;
            letter-spacing: 2px;
            margin-bottom: 16px;
        }

        .testimonial-text {
            font-size: 0.9rem;
            line-height: 1.7;
            color: var(--text-muted);
            margin-bottom: 24px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .testimonial-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
        }

        .testimonial-name {
            font-weight: 700;
            font-size: 0.9rem;
        }

        .testimonial-role {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* ─── CTA SECTION ─── */
        .cta-section {
            margin: 0 60px 100px;
            background: var(--gradient);
            border-radius: 32px;
            padding: 80px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%; left: -20%;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .cta-section::after {
            content: '';
            position: absolute;
            bottom: -30%; right: -10%;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
        }

        .cta-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            font-weight: 800;
            color: white;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .cta-desc {
            color: rgba(255,255,255,0.8);
            font-size: 1rem;
            margin-bottom: 36px;
            position: relative;
            z-index: 1;
        }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 40px;
            background: white;
            color: var(--primary);
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
        }

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 40px rgba(0,0,0,0.3);
        }

        /* ─── FOOTER ─── */
        footer {
            background: white;
            border-top: 1px solid var(--border);
            padding: 48px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-copy {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .footer-links {
            display: flex;
            gap: 24px;
        }

        .footer-links a {
            font-size: 0.82rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover { color: var(--primary); }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ─── SCROLL ANIMATIONS ─── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1100px) {
            .hero-visual { display: none; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .roles-grid { grid-template-columns: repeat(2, 1fr); }
            .testimonials-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            nav { padding: 16px 24px; }
            .nav-links { display: none; }
            .hero { padding: 100px 24px 60px; }
            .stats-section, .features-section, .roles-section, .testimonials-section { padding: 60px 24px; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .features-grid { grid-template-columns: 1fr; }
            .roles-grid { grid-template-columns: 1fr 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .cta-section { margin: 0 24px 60px; padding: 60px 24px; }
            footer { flex-direction: column; gap: 20px; text-align: center; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar">
    <a href="#" class="nav-logo">
        <div class="nav-logo-icon">🎓</div>
        <span class="nav-logo-text">SIMPKL</span>
    </a>
    <ul class="nav-links">
        <li><a href="#fitur">Fitur</a></li>
        <li><a href="#pengguna">Pengguna</a></li>
        <li><a href="#testimoni">Testimoni</a></li>
        <li><a href="{{ route('login') }}" class="btn-nav">Masuk →</a></li>
    </ul>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-orb hero-orb-3"></div>

    <div class="hero-content">
        <div class="hero-badge">Sistem Digital PKL Terpadu</div>
        <h1 class="hero-title">
            Kelola PKL Lebih
            <span class="highlight">Cerdas & Efisien</span>
        </h1>
        <p class="hero-desc">
            Platform digital untuk mengelola seluruh proses Praktik Kerja Lapangan — dari penempatan siswa, e-jurnal harian, monitoring guru, hingga laporan akhir — semua dalam satu sistem terintegrasi.
        </p>
        <div class="hero-cta">
            <a href="{{ route('login') }}" class="btn-primary">
                Mulai Sekarang →
            </a>
            <a href="#fitur" class="btn-secondary">
                Lihat Fitur ↓
            </a>
        </div>
    </div>

    <!-- Dashboard Preview -->
    <div class="hero-visual">
        <div class="float-card float-card-2">
            <div class="float-icon green">✅</div>
            <div>
                <div class="float-text-main">Jurnal Disetujui</div>
                <div class="float-text-sub">Hari ini, 08.15 WIB</div>
            </div>
        </div>

        <div class="dashboard-preview">
            <div class="dash-header">
                <div class="dash-dot red"></div>
                <div class="dash-dot yellow"></div>
                <div class="dash-dot green"></div>
                <div class="dash-title-bar">Dashboard SIMPKL</div>
            </div>

            <div class="dash-stats">
                <div class="dash-stat dash-stat-1">
                    <div class="dash-stat-num" data-count="247">0</div>
                    <div class="dash-stat-label">Siswa PKL Aktif</div>
                </div>
                <div class="dash-stat dash-stat-2">
                    <div class="dash-stat-num" data-count="58">0</div>
                    <div class="dash-stat-label">Mitra Industri</div>
                </div>
                <div class="dash-stat dash-stat-3">
                    <div class="dash-stat-num" data-count="12">0</div>
                    <div class="dash-stat-label">Guru Pembimbing</div>
                </div>
                <div class="dash-stat dash-stat-4">
                    <div class="dash-stat-num" data-count="94">0</div>
                    <div class="dash-stat-label">% Kehadiran</div>
                </div>
            </div>

            <div class="dash-progress-section">
                <div class="dash-progress-label">
                    <span>TKJ — Progress PKL</span>
                    <span>78%</span>
                </div>
                <div class="dash-progress-bar">
                    <div class="dash-progress-fill" style="width: 78%"></div>
                </div>
            </div>

            <div class="dash-progress-section">
                <div class="dash-progress-label">
                    <span>RPL — Progress PKL</span>
                    <span>65%</span>
                </div>
                <div class="dash-progress-bar">
                    <div class="dash-progress-fill green" style="width: 65%"></div>
                </div>
            </div>

            <div class="dash-progress-section">
                <div class="dash-progress-label">
                    <span>AKL — Progress PKL</span>
                    <span>82%</span>
                </div>
                <div class="dash-progress-bar">
                    <div class="dash-progress-fill amber" style="width: 82%"></div>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 16px;">
                <div class="dash-students">
                    <div class="dash-avatar dash-avatar-1">AN</div>
                    <div class="dash-avatar dash-avatar-2">RD</div>
                    <div class="dash-avatar dash-avatar-3">MS</div>
                    <div class="dash-avatar dash-avatar-4">FT</div>
                    <div class="dash-avatar dash-avatar-more">+243</div>
                </div>
                <div class="dash-students-info">Siswa sedang PKL</div>
            </div>
        </div>

        <div class="float-card float-card-1">
            <div class="float-icon purple">📊</div>
            <div>
                <div class="float-text-main">Laporan Siap</div>
                <div class="float-text-sub">Unduh rekap semester</div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-item reveal">
            <span class="stat-num counter" data-target="247">0</span>
            <span class="stat-label">Siswa PKL Aktif</span>
        </div>
        <div class="stat-item reveal">
            <span class="stat-num counter" data-target="58">0</span>
            <span class="stat-label">Mitra Industri</span>
        </div>
        <div class="stat-item reveal">
            <span class="stat-num counter" data-target="12">0</span>
            <span class="stat-label">Guru Pembimbing</span>
        </div>
        <div class="stat-item reveal">
            <span class="stat-num counter" data-target="4">0</span>
            <span class="stat-label">Jurusan Terdaftar</span>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="features-section" id="fitur">
    <div class="section-label">Fitur Unggulan</div>
    <h2 class="section-title">Semua yang Kamu Butuhkan<br>Ada di SIMPKL</h2>
    <p class="section-desc">Dirancang untuk mempermudah setiap tahap PKL — dari awal hingga selesai, tanpa kertas berlebihan.</p>

    <div class="features-grid">
        <div class="feature-card reveal">
            <div class="feature-icon">📔</div>
            <div class="feature-title">E-Jurnal Harian</div>
            <p class="feature-desc">Siswa mencatat kegiatan harian secara digital. Data jurnal otomatis menjadi rekap absensi yang terstruktur.</p>
            <span class="feature-tag">Siswa</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">📊</div>
            <div class="feature-title">Monitoring Real-time</div>
            <p class="feature-desc">Guru pembimbing dapat memantau jurnal, kehadiran, dan perkembangan siswa kapan saja secara langsung.</p>
            <span class="feature-tag">Guru Pembimbing</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">🏭</div>
            <div class="feature-title">Manajemen Mitra</div>
            <p class="feature-desc">Kelola database perusahaan mitra, MOU, dan penempatan siswa di setiap industri dengan mudah dan rapi.</p>
            <span class="feature-tag">Wakasek Hubin</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">⭐</div>
            <div class="feature-title">Sistem Penilaian</div>
            <p class="feature-desc">Penilaian dari guru dan pembimbing industri terakumulasi otomatis. Nilai transparan dan dapat diakses siswa.</p>
            <span class="feature-tag">Guru & Industri</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">📄</div>
            <div class="feature-title">Laporan Otomatis</div>
            <p class="feature-desc">Rekap absen, nilai, dan data PKL dapat diunduh dalam hitungan detik. Tidak perlu rekap manual lagi.</p>
            <span class="feature-tag">Admin & Wakasek</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">💬</div>
            <div class="feature-title">Bimbingan Online</div>
            <p class="feature-desc">Fitur catatan revisi dan komunikasi antara guru pembimbing dan siswa langsung di dalam sistem.</p>
            <span class="feature-tag">Guru & Siswa</span>
        </div>
    </div>
</section>

<!-- ROLES -->
<section class="roles-section" id="pengguna">
    <div class="roles-inner">
        <div class="section-label">Siapa yang Menggunakan?</div>
        <h2 class="section-title">Dirancang untuk<br>Semua Peran</h2>

        <div class="roles-grid">
            <div class="role-card role-card-1 reveal">
                <span class="role-emoji">👨‍🎓</span>
                <div class="role-name">Siswa</div>
                <p class="role-desc">Akses jurnal, nilai, dan status PKL kapan saja.</p>
                <div class="role-features">
                    <div class="role-feature-item">Dashboard status PKL & sisa hari</div>
                    <div class="role-feature-item">Input e-jurnal harian</div>
                    <div class="role-feature-item">Lihat nilai & logbook</div>
                    <div class="role-feature-item">Profil digital untuk sertifikat</div>
                </div>
            </div>
            <div class="role-card role-card-2 reveal">
                <span class="role-emoji">👩‍🏫</span>
                <div class="role-name">Guru Pembimbing</div>
                <p class="role-desc">Monitor dan nilai siswa bimbingan secara efisien.</p>
                <div class="role-features">
                    <div class="role-feature-item">Panel monitoring real-time</div>
                    <div class="role-feature-item">Sistem grading kompetensi</div>
                    <div class="role-feature-item">Bimbingan & revisi jurnal</div>
                    <div class="role-feature-item">Plotting lokasi IDUKA</div>
                </div>
            </div>
            <div class="role-card role-card-3 reveal">
                <span class="role-emoji">🏢</span>
                <div class="role-name">Wakasek Hubin</div>
                <p class="role-desc">Kelola kemitraan industri dan analitik penempatan.</p>
                <div class="role-features">
                    <div class="role-feature-item">Manajemen MOU mitra industri</div>
                    <div class="role-feature-item">Grafik sebaran siswa</div>
                    <div class="role-feature-item">Validasi penempatan PKL</div>
                    <div class="role-feature-item">Rekap laporan per angkatan</div>
                </div>
            </div>
            <div class="role-card role-card-4 reveal">
                <span class="role-emoji">⚙️</span>
                <div class="role-name">Admin</div>
                <p class="role-desc">Kelola seluruh data dan konfigurasi sistem.</p>
                <div class="role-features">
                    <div class="role-feature-item">Manajemen akun pengguna</div>
                    <div class="role-feature-item">Master data kelas & jurusan</div>
                    <div class="role-feature-item">Konfigurasi periode PKL</div>
                    <div class="role-feature-item">Pengaturan tahun ajaran</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials-section" id="testimoni">
    <div class="section-label">Testimoni</div>
    <h2 class="section-title">Apa Kata Mereka?</h2>
    <p class="section-desc">Pendapat nyata dari siswa, guru, dan pihak sekolah yang telah menggunakan SIMPKL.</p>

    <div class="testimonials-grid">
        <div class="testimonial-card reveal">
            <div class="testimonial-stars">★★★★★</div>
            <p class="testimonial-text">"Sekarang nulis jurnal jadi lebih gampang, tinggal buka HP input kegiatan. Guruku juga langsung bisa lihat tanpa harus ketemu."</p>
            <div class="testimonial-author">
                <div class="testimonial-avatar" style="background: linear-gradient(135deg,#667eea,#764ba2)">AN</div>
                <div>
                    <div class="testimonial-name">Andi Nugraha</div>
                    <div class="testimonial-role">Siswa PKL — Jurusan TKJ</div>
                </div>
            </div>
        </div>
        <div class="testimonial-card reveal">
            <div class="testimonial-stars">★★★★★</div>
            <p class="testimonial-text">"Memantau 30+ siswa sekaligus jadi jauh lebih mudah. Saya bisa langsung kasih feedback tanpa harus nunggu siswa datang ke sekolah."</p>
            <div class="testimonial-author">
                <div class="testimonial-avatar" style="background: linear-gradient(135deg,#22c55e,#16a34a)">SR</div>
                <div>
                    <div class="testimonial-name">Sari Rahayu, S.Pd.</div>
                    <div class="testimonial-role">Guru Pembimbing PKL</div>
                </div>
            </div>
        </div>
        <div class="testimonial-card reveal">
            <div class="testimonial-stars">★★★★★</div>
            <p class="testimonial-text">"Rekap data mitra dan siswa yang dulunya makan waktu berhari-hari, sekarang bisa langsung download dalam hitungan menit."</p>
            <div class="testimonial-author">
                <div class="testimonial-avatar" style="background: linear-gradient(135deg,#f59e0b,#d97706)">BW</div>
                <div>
                    <div class="testimonial-name">Budi Wahyono, M.Pd.</div>
                    <div class="testimonial-role">Wakasek Bidang Hubin</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<div class="cta-section reveal">
    <h2 class="cta-title">Siap Digitalisasi PKL Sekolahmu?</h2>
    <p class="cta-desc">Bergabung bersama ratusan siswa dan guru yang sudah merasakan kemudahan SIMPKL.</p>
    <a href="{{ route('login') }}" class="btn-cta">
        🚀 Masuk ke Sistem
    </a>
</div>

<!-- FOOTER -->
<footer>
    <div class="footer-logo">SIMPKL</div>
    <div class="footer-copy">© {{ date('Y') }} SIMPKL. Sistem Informasi Praktik Kerja Lapangan.</div>
    <div class="footer-links">
        <a href="#">Tentang</a>
        <a href="#">Panduan</a>
        <a href="{{ route('login') }}">Login</a>
    </div>
</footer>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('navbar');
        if (window.scrollY > 20) {
            nav.style.boxShadow = '0 4px 30px rgba(102,126,234,0.1)';
        } else {
            nav.style.boxShadow = 'none';
        }
    });

    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    revealEls.forEach(el => observer.observe(el));

    // Counter animation
    function animateCounter(el) {
        const target = parseInt(el.dataset.target || el.dataset.count);
        const duration = 1800;
        const step = target / (duration / 16);
        let current = 0;
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = Math.floor(current) + (el.dataset.target === '94' ? '%' : '');
            if (current >= target) {
                el.textContent = target + (el.dataset.target === '94' ? '%' : '');
                clearInterval(timer);
            }
        }, 16);
    }

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

    // Hero dashboard counter
    document.querySelectorAll('.dash-stat-num[data-count]').forEach(el => {
        const target = parseInt(el.dataset.count);
        const suffix = el.dataset.count === '94' ? '%' : '';
        let count = 0;
        const step = target / 60;
        const t = setInterval(() => {
            count = Math.min(count + step, target);
            el.textContent = Math.floor(count) + suffix;
            if (count >= target) { el.textContent = target + suffix; clearInterval(t); }
        }, 20);
    });
</script>
</body>
</html>