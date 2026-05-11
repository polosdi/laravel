<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPKL — Sistem Informasi Praktik Kerja Lapangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root { --font: 'Poppins', 'Segoe UI', system-ui, sans-serif; }

        /* ── LIGHT THEME ── */
        [data-theme="light"] {
            --bg: #F8F9FA;
            --surface: #ffffff;
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --border: rgba(102,126,234,0.15);
            --shadow: 0 20px 60px rgba(102,126,234,0.15);
            --nav-bg: rgba(248,249,250,0.85);
            --card-bg: #ffffff;
            --stat-bg: #ffffff;
            --section-alt: #ffffff;
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary: #667eea;
            --toggle-bg: rgba(102,126,234,0.1);
            --toggle-border: rgba(102,126,234,0.2);
        }

        /* ── DARK THEME ── */
        [data-theme="dark"] {
            --bg: #0d0b1e;
            --surface: #1a1730;
            --text: #f0eeff;
            --text-muted: rgba(240,238,255,0.55);
            --border: rgba(102,126,234,0.2);
            --shadow: 0 20px 60px rgba(0,0,0,0.4);
            --nav-bg: rgba(13,11,30,0.85);
            --card-bg: rgba(255,255,255,0.06);
            --stat-bg: rgba(255,255,255,0.05);
            --section-alt: rgba(255,255,255,0.03);
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary: #8b9ff4;
            --toggle-bg: rgba(255,255,255,0.1);
            --toggle-border: rgba(255,255,255,0.15);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            transition: background .4s, color .4s;
        }

        /* ── THEME TOGGLE ── */
        .theme-toggle {
            width: 52px; height: 28px;
            background: var(--toggle-bg);
            border: 1px solid var(--toggle-border);
            border-radius: 50px;
            cursor: pointer;
            display: flex; align-items: center;
            padding: 3px;
            transition: all .3s;
            flex-shrink: 0;
        }

        .toggle-thumb {
            width: 20px; height: 20px;
            border-radius: 50%;
            background: var(--grad);
            transition: transform .3s cubic-bezier(.34,1.4,.64,1);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(102,126,234,.4);
        }

        [data-theme="light"] .toggle-thumb { transform: translateX(0); }
        [data-theme="dark"]  .toggle-thumb { transform: translateX(24px); }

        .toggle-thumb svg { width: 11px; height: 11px; color: white; }

        /* ── NAVBAR ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 18px 60px;
            display: flex; align-items: center; justify-content: space-between;
            background: var(--nav-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: all .3s;
        }

        .nav-logo {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 38px; height: 38px;
            background: var(--grad);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(102,126,234,.35);
        }

        .nav-logo-icon svg { width: 20px; height: 20px; color: white; }

        .nav-logo-text {
            font-size: 1.3rem; font-weight: 800;
            background: var(--grad);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex; align-items: center; gap: 32px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none; color: var(--text-muted);
            font-weight: 500; font-size: .88rem;
            transition: color .2s;
        }

        .nav-links a:hover { color: var(--primary); }

        .nav-right {
            display: flex; align-items: center; gap: 16px;
        }

        .btn-nav {
            padding: 9px 22px;
            background: var(--grad);
            color: white !important;
            border-radius: 50px;
            font-weight: 600; font-size: .85rem;
            transition: all .3s !important;
            box-shadow: 0 4px 16px rgba(102,126,234,.35);
            display: flex; align-items: center; gap: 6px;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102,126,234,.45) !important;
        }

        .btn-nav svg { width: 14px; height: 14px; }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center;
            padding: 120px 60px 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-orb {
            position: absolute; border-radius: 50%;
            filter: blur(80px); opacity: 0.3;
            animation: floatOrb 8s ease-in-out infinite;
        }

        .hero-orb-1 { width:500px;height:500px;background:radial-gradient(circle,#667eea,transparent);top:-100px;right:-100px;animation-delay:0s; }
        .hero-orb-2 { width:350px;height:350px;background:radial-gradient(circle,#764ba2,transparent);bottom:0;left:20%;animation-delay:3s; }
        .hero-orb-3 { width:250px;height:250px;background:radial-gradient(circle,#a78bfa,transparent);top:30%;left:-50px;animation-delay:5s; }

        @keyframes floatOrb {
            0%,100% { transform:translate(0,0) scale(1); }
            33% { transform:translate(20px,-30px) scale(1.05); }
            66% { transform:translate(-15px,20px) scale(0.95); }
        }

        .hero-content {
            position: relative; z-index: 1;
            max-width: 560px;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 7px 16px;
            background: rgba(102,126,234,.1);
            border: 1px solid rgba(102,126,234,.25);
            border-radius: 50px;
            font-size: .78rem; font-weight: 600;
            color: var(--primary);
            margin-bottom: 28px;
            animation: fadeSlideUp .6s ease both;
        }

        .hero-badge::before {
            content: ''; width: 7px; height: 7px;
            background: #22c55e; border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.4)} }

        .hero-title {
            font-size: clamp(2.8rem,5vw,4.2rem);
            font-weight: 800; line-height: 1.1;
            margin-bottom: 24px;
            animation: fadeSlideUp .6s ease .1s both;
        }

        .hero-title .highlight {
            background: var(--grad);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; display: block;
        }

        .hero-desc {
            font-size: 1rem; color: var(--text-muted);
            line-height: 1.72; margin-bottom: 40px;
            animation: fadeSlideUp .6s ease .2s both;
        }

        .hero-cta {
            display: flex; gap: 14px; flex-wrap: wrap;
            animation: fadeSlideUp .6s ease .3s both;
        }

        .btn-primary {
            padding: 13px 28px;
            background: var(--grad); color: white;
            border-radius: 50px; font-weight: 700; font-size: .92rem;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 8px 28px rgba(102,126,234,.4);
            transition: all .3s;
        }

        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(102,126,234,.5); }
        .btn-primary svg { width: 16px; height: 16px; }

        .btn-secondary {
            padding: 13px 28px;
            background: var(--surface); color: var(--text);
            border: 2px solid var(--border);
            border-radius: 50px; font-weight: 600; font-size: .92rem;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all .3s;
        }

        .btn-secondary:hover { border-color: var(--primary); color: var(--primary); transform: translateY(-3px); }
        .btn-secondary svg { width: 16px; height: 16px; }

        /* ── HERO VISUAL ── */
        .hero-visual {
            position: absolute;
            right: 48px; top: 50%;
            transform: translateY(-50%);
            width: 440px;
            animation: fadeSlideLeft .8s ease .4s both;
            z-index: 2;
        }

        @keyframes fadeSlideLeft {
            from { opacity:0; transform:translateY(-50%) translateX(40px); }
            to   { opacity:1; transform:translateY(-50%) translateX(0); }
        }

        .dashboard-preview {
            background: var(--surface);
            border-radius: 22px; padding: 22px;
            box-shadow: var(--shadow), 0 0 0 1px var(--border);
            transition: background .4s, box-shadow .4s;
        }

        .dash-header {
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 18px; padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
        }

        .dash-dot { width:11px;height:11px;border-radius:50%; }
        .dash-dot.red   { background:#ff5f57; }
        .dash-dot.yellow{ background:#febc2e; }
        .dash-dot.green { background:#28c840; }

        .dash-title-bar {
            margin-left: auto; font-size: .72rem; font-weight: 600;
            color: var(--text-muted); background: var(--bg);
            padding: 3px 10px; border-radius: 20px;
            transition: background .4s, color .4s;
        }

        .dash-stats {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 10px; margin-bottom: 14px;
        }

        .dash-stat { padding: 14px; border-radius: 14px; }
        .dash-stat-1 { background:linear-gradient(135deg,#667eea20,#764ba210);border:1px solid rgba(102,126,234,.2); }
        .dash-stat-2 { background:linear-gradient(135deg,#22c55e20,#16a34a10);border:1px solid rgba(34,197,94,.2); }
        .dash-stat-3 { background:linear-gradient(135deg,#f59e0b20,#d9770010);border:1px solid rgba(245,158,11,.2); }
        .dash-stat-4 { background:linear-gradient(135deg,#ec489920,#db277710);border:1px solid rgba(236,72,153,.2); }

        .dash-stat-num {
            font-size: 1.7rem; font-weight: 800;
            color: var(--text); transition: color .4s;
        }

        .dash-stat-label { font-size: .68rem; color: var(--text-muted); font-weight: 500; margin-top: 2px; transition: color .4s; }

        .dash-progress-section { margin-bottom: 12px; }

        .dash-progress-label {
            display: flex; justify-content: space-between;
            font-size: .7rem; font-weight: 600;
            color: var(--text-muted); margin-bottom: 6px;
            transition: color .4s;
        }

        .dash-progress-bar { height: 7px; background: var(--bg); border-radius: 10px; overflow: hidden; transition: background .4s; }

        .dash-progress-fill {
            height: 100%; border-radius: 10px;
            background: var(--grad);
            animation: expandBar 1.5s ease .8s both;
        }

        @keyframes expandBar { from { width:0; } }
        .dash-progress-fill.green { background: linear-gradient(90deg,#22c55e,#16a34a); }
        .dash-progress-fill.amber { background: linear-gradient(90deg,#f59e0b,#d97706); }

        .dash-students { display:flex; align-items:center; }
        .dash-avatar {
            width:28px;height:28px;border-radius:50%;
            border:2px solid var(--surface);
            margin-left:-6px; display:flex; align-items:center; justify-content:center;
            font-size:.62rem; font-weight:700; color:white;
            transition: border-color .4s;
        }
        .dash-avatar:first-child { margin-left:0; }
        .dash-avatar-1{background:linear-gradient(135deg,#667eea,#764ba2)}
        .dash-avatar-2{background:linear-gradient(135deg,#22c55e,#16a34a)}
        .dash-avatar-3{background:linear-gradient(135deg,#f59e0b,#d97706)}
        .dash-avatar-4{background:linear-gradient(135deg,#ec4899,#db2777)}
        .dash-avatar-more{background:var(--bg);color:var(--text-muted) !important;font-size:.6rem !important;}

        .dash-students-info { margin-left:10px;font-size:.7rem;color:var(--text-muted);font-weight:500;transition:color .4s; }

        /* Float cards */
        .float-card {
            position: absolute;
            background: var(--surface);
            border-radius: 14px; padding: 12px 16px;
            box-shadow: 0 10px 36px rgba(0,0,0,.12);
            display: flex; align-items: center; gap: 10px;
            animation: floatCard 3s ease-in-out infinite;
            transition: background .4s;
            z-index: 3;
        }

        .float-card-1 { bottom: -16px; left: -24px; animation-delay: 0s; }
        .float-card-2 { top: -16px; right: 0; animation-delay: 1.5s; }

        @keyframes floatCard { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }

        .float-icon {
            width: 34px; height: 34px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
        }

        .float-icon svg { width: 16px; height: 16px; }
        .float-icon.purple { background: rgba(102,126,234,.15); color: #667eea; }
        .float-icon.green  { background: rgba(34,197,94,.15);   color: #22c55e; }

        .float-text-main { font-size: .8rem; font-weight: 700; color: var(--text); transition: color .4s; }
        .float-text-sub  { font-size: .68rem; color: var(--text-muted); font-weight: 500; transition: color .4s; }

        /* ── STATS ── */
        .stats-section {
            padding: 80px 60px;
            background: var(--section-alt);
            transition: background .4s;
        }

        .stats-grid {
            display: grid; grid-template-columns: repeat(4,1fr);
            gap: 2px; max-width: 1100px; margin: 0 auto;
            background: var(--border);
            border-radius: 22px; overflow: hidden;
            box-shadow: var(--shadow);
        }

        .stat-item {
            background: var(--stat-bg);
            padding: 44px 32px; text-align: center;
            transition: all .3s;
        }

        .stat-item:hover { background: rgba(102,126,234,.04); }

        .stat-num {
            font-size: 2.8rem; font-weight: 800;
            background: var(--grad);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; display: block;
        }

        .stat-label { font-size: .82rem; color: var(--text-muted); font-weight: 500; margin-top: 6px; transition: color .4s; }

        /* ── FEATURES ── */
        .features-section {
            padding: 100px 60px;
            max-width: 1200px; margin: 0 auto;
        }

        .section-label {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: .75rem; font-weight: 700;
            letter-spacing: .1em; text-transform: uppercase;
            color: var(--primary); margin-bottom: 14px;
        }

        .section-label::before {
            content: ''; display: block; width: 22px; height: 2px;
            background: var(--grad); border-radius: 2px;
        }

        .section-title {
            font-size: clamp(1.9rem,3.5vw,2.7rem);
            font-weight: 800; line-height: 1.15; margin-bottom: 14px;
        }

        .section-desc {
            color: var(--text-muted); font-size: .95rem;
            max-width: 520px; line-height: 1.7;
            margin-bottom: 56px; transition: color .4s;
        }

        .features-grid {
            display: grid; grid-template-columns: repeat(3,1fr);
            gap: 22px;
        }

        .feature-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px; padding: 30px;
            transition: all .3s; position: relative; overflow: hidden;
        }

        .feature-card::before {
            content: ''; position: absolute;
            top:0;left:0;right:0;height:3px;
            background: var(--grad);
            transform: scaleX(0); transition: transform .3s;
            transform-origin: left;
        }

        .feature-card:hover::before { transform: scaleX(1); }
        .feature-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(102,126,234,.15); border-color: rgba(102,126,234,.3); }

        .feature-icon {
            width: 50px; height: 50px;
            background: linear-gradient(135deg,rgba(102,126,234,.12),rgba(118,75,162,.08));
            border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
            border: 1px solid rgba(102,126,234,.15);
        }

        .feature-icon svg { width: 22px; height: 22px; color: #667eea; }

        .feature-title {
            font-size: 1rem; font-weight: 700;
            margin-bottom: 10px; color: var(--text); transition: color .4s;
        }

        .feature-desc {
            font-size: .855rem; color: var(--text-muted);
            line-height: 1.7; transition: color .4s;
        }

        .feature-tag {
            display: inline-block; margin-top: 16px;
            padding: 3px 11px;
            background: rgba(102,126,234,.08);
            color: var(--primary); border-radius: 20px;
            font-size: .7rem; font-weight: 600; transition: color .4s;
        }

        /* ── ROLES ── */
        .roles-section {
            padding: 100px 60px;
            background: var(--section-alt);
            transition: background .4s;
        }

        .roles-inner { max-width: 1200px; margin: 0 auto; }

        .roles-grid {
            display: grid; grid-template-columns: repeat(4,1fr);
            gap: 18px; margin-top: 56px;
        }

        .role-card {
            border-radius: 20px; padding: 28px 22px;
            transition: all .3s; cursor: default;
        }

        .role-card-1 { background:linear-gradient(135deg,#667eea15,#764ba208);border:1px solid rgba(102,126,234,.2); }
        .role-card-2 { background:linear-gradient(135deg,#22c55e15,#16a34a08);border:1px solid rgba(34,197,94,.2); }
        .role-card-3 { background:linear-gradient(135deg,#f59e0b15,#d9770608);border:1px solid rgba(245,158,11,.2); }
        .role-card-4 { background:linear-gradient(135deg,#ec489915,#db277708);border:1px solid rgba(236,72,153,.2); }
        .role-card:hover { transform: translateY(-4px); }

        .role-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }

        .role-icon svg { width: 22px; height: 22px; }
        .role-icon-1 { background:rgba(102,126,234,.15);color:#667eea; }
        .role-icon-2 { background:rgba(34,197,94,.15);  color:#22c55e; }
        .role-icon-3 { background:rgba(245,158,11,.15); color:#f59e0b; }
        .role-icon-4 { background:rgba(236,72,153,.15); color:#ec4899; }

        .role-name { font-size: .95rem; font-weight: 800; margin-bottom: 8px; color: var(--text); transition: color .4s; }
        .role-desc { font-size: .78rem; color: var(--text-muted); line-height: 1.6; transition: color .4s; }

        .role-features { margin-top: 14px; display:flex; flex-direction:column; gap:6px; }

        .role-feature-item {
            display: flex; align-items: flex-start; gap: 8px;
            font-size: .76rem; color: var(--text-muted); transition: color .4s;
        }

        .role-feature-item::before {
            content: ''; flex-shrink: 0;
            width: 14px; height: 14px; margin-top: 1px;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' fill='none' stroke='%23667eea' stroke-width='3' stroke-linecap='round' stroke-linejoin='round' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='20 6 9 17 4 12'/%3E%3C/svg%3E") no-repeat center;
            background-size: contain;
        }

        /* ── TESTIMONIALS ── */
        .testimonials-section {
            padding: 100px 60px;
            max-width: 1200px; margin: 0 auto;
        }

        .testimonials-grid {
            display: grid; grid-template-columns: repeat(3,1fr);
            gap: 22px; margin-top: 56px;
        }

        .testimonial-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px; padding: 30px;
            transition: all .3s;
        }

        .testimonial-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(102,126,234,.1); }

        .testimonial-stars {
            display: flex; gap: 3px; margin-bottom: 14px;
        }

        .testimonial-stars svg { width: 16px; height: 16px; color: #f59e0b; fill: #f59e0b; }

        .testimonial-text {
            font-size: .875rem; line-height: 1.72;
            color: var(--text-muted); margin-bottom: 22px;
            font-style: italic; transition: color .4s;
        }

        .testimonial-author { display:flex;align-items:center;gap:12px; }

        .testimonial-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .9rem; font-weight: 700; color: white;
            flex-shrink: 0;
        }

        .testimonial-name { font-weight: 700; font-size: .875rem; color: var(--text); transition: color .4s; }
        .testimonial-role { font-size: .75rem; color: var(--text-muted); transition: color .4s; }

        /* ── CTA ── */
        .cta-section {
            margin: 0 60px 100px;
            background: var(--grad);
            border-radius: 30px; padding: 76px 60px;
            text-align: center; position: relative; overflow: hidden;
        }

        .cta-section::before {
            content: ''; position: absolute;
            top:-50%;left:-20%;width:400px;height:400px;
            background: rgba(255,255,255,.07);border-radius:50%;
        }

        .cta-section::after {
            content: ''; position: absolute;
            bottom:-30%;right:-10%;width:300px;height:300px;
            background: rgba(255,255,255,.05);border-radius:50%;
        }

        .cta-title {
            font-size: clamp(1.7rem,3vw,2.5rem);
            font-weight: 800; color: white;
            margin-bottom: 14px; position: relative; z-index: 1;
        }

        .cta-desc {
            color: rgba(255,255,255,.8);
            font-size: .95rem; margin-bottom: 34px;
            position: relative; z-index: 1;
        }

        .btn-cta {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 36px;
            background: white; color: #667eea;
            border-radius: 50px; font-weight: 700; font-size: .95rem;
            text-decoration: none;
            transition: all .3s;
            box-shadow: 0 8px 28px rgba(0,0,0,.18);
            position: relative; z-index: 1;
        }

        .btn-cta:hover { transform: translateY(-3px); box-shadow: 0 14px 38px rgba(0,0,0,.28); }
        .btn-cta svg { width: 16px; height: 16px; }

        /* ── FOOTER ── */
        footer {
            background: var(--section-alt);
            border-top: 1px solid var(--border);
            padding: 44px 60px;
            display: flex; align-items: center; justify-content: space-between;
            transition: background .4s;
        }

        .footer-logo {
            font-size: 1.15rem; font-weight: 800;
            background: var(--grad);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-copy { font-size: .8rem; color: var(--text-muted); transition: color .4s; }

        .footer-links { display:flex;gap:22px; }
        .footer-links a {
            font-size: .8rem; color: var(--text-muted);
            text-decoration: none; transition: color .2s;
        }
        .footer-links a:hover { color: var(--primary); }

        /* ── ANIMATIONS ── */
        @keyframes fadeSlideUp { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }

        .reveal { opacity:0;transform:translateY(28px);transition:all .6s ease; }
        .reveal.visible { opacity:1;transform:translateY(0); }

        /* ── RESPONSIVE ── */
        @media (max-width:1100px) {
            .hero-visual { display:none; }
            .stats-grid { grid-template-columns:repeat(2,1fr); }
            .features-grid { grid-template-columns:repeat(2,1fr); }
            .roles-grid { grid-template-columns:repeat(2,1fr); }
            .testimonials-grid { grid-template-columns:1fr 1fr; }
        }

        @media (max-width:768px) {
            nav { padding:14px 22px; }
            .nav-links { display:none; }
            .hero { padding:100px 22px 60px; }
            .stats-section,.features-section,.roles-section,.testimonials-section { padding:60px 22px; }
            .stats-grid { grid-template-columns:1fr 1fr; }
            .features-grid { grid-template-columns:1fr; }
            .roles-grid { grid-template-columns:1fr 1fr; }
            .testimonials-grid { grid-template-columns:1fr; }
            .cta-section { margin:0 22px 60px;padding:56px 22px; }
            footer { flex-direction:column;gap:18px;text-align:center;padding:36px 22px; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar">
    <a href="#" class="nav-logo">
        <div class="nav-logo-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
        </div>
        <span class="nav-logo-text">SIMPKL</span>
    </a>
    <ul class="nav-links">
        <li><a href="#fitur">Fitur</a></li>
        <li><a href="#pengguna">Pengguna</a></li>
        <li><a href="#testimoni">Testimoni</a></li>
    </ul>
    <div class="nav-right">
        <button class="theme-toggle" onclick="toggleTheme()" title="Ganti tema">
            <div class="toggle-thumb" id="thumb">
                <svg id="ico-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
                <svg id="ico-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                </svg>
            </div>
        </button>
        <a href="{{ route('login') }}" class="btn-nav">
            Masuk
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>
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
        <p class="hero-desc">Platform digital untuk mengelola seluruh proses Praktik Kerja Lapangan — dari penempatan siswa, e-jurnal harian, monitoring guru, hingga laporan akhir — semua dalam satu sistem terintegrasi.</p>
        <div class="hero-cta">
            <a href="{{ route('login') }}" class="btn-primary">
                Mulai Sekarang
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            <a href="#fitur" class="btn-secondary">
                Lihat Fitur
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
            </a>
        </div>
    </div>

    <!-- Dashboard Preview — fixed, no overflow -->
    <div class="hero-visual">
        <div class="float-card float-card-2">
            <div class="float-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
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
                    <div class="dash-stat-num" data-count="94">0%</div>
                    <div class="dash-stat-label">Kehadiran</div>
                </div>
            </div>
            <div class="dash-progress-section">
                <div class="dash-progress-label"><span>TKJ</span><span>78%</span></div>
                <div class="dash-progress-bar"><div class="dash-progress-fill" style="width:78%"></div></div>
            </div>
            <div class="dash-progress-section">
                <div class="dash-progress-label"><span>RPL</span><span>65%</span></div>
                <div class="dash-progress-bar"><div class="dash-progress-fill green" style="width:65%"></div></div>
            </div>
            <div class="dash-progress-section">
                <div class="dash-progress-label"><span>AKL</span><span>82%</span></div>
                <div class="dash-progress-bar"><div class="dash-progress-fill amber" style="width:82%"></div></div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:14px;">
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
            <div class="float-icon purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            </div>
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
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            </div>
            <div class="feature-title">E-Jurnal Harian</div>
            <p class="feature-desc">Siswa mencatat kegiatan harian secara digital. Data jurnal otomatis menjadi rekap absensi yang terstruktur.</p>
            <span class="feature-tag">Siswa</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </div>
            <div class="feature-title">Monitoring Real-time</div>
            <p class="feature-desc">Guru pembimbing dapat memantau jurnal, kehadiran, dan perkembangan siswa kapan saja secara langsung.</p>
            <span class="feature-tag">Guru Pembimbing</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            </div>
            <div class="feature-title">Manajemen Mitra</div>
            <p class="feature-desc">Kelola database perusahaan mitra, MOU, dan penempatan siswa di setiap industri dengan mudah dan rapi.</p>
            <span class="feature-tag">Wakasek Hubin</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <div class="feature-title">Sistem Penilaian</div>
            <p class="feature-desc">Penilaian dari guru dan pembimbing industri terakumulasi otomatis. Nilai transparan dan dapat diakses siswa.</p>
            <span class="feature-tag">Guru & Industri</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div class="feature-title">Laporan Otomatis</div>
            <p class="feature-desc">Rekap absen, nilai, dan data PKL dapat diunduh dalam hitungan detik. Tidak perlu rekap manual lagi.</p>
            <span class="feature-tag">Admin & Wakasek</span>
        </div>
        <div class="feature-card reveal">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
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
                <div class="role-icon role-icon-1">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
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
                <div class="role-icon role-icon-2">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
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
                <div class="role-icon role-icon-3">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </div>
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
                <div class="role-icon role-icon-4">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
                </div>
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
            <div class="testimonial-stars">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <p class="testimonial-text">"Sekarang nulis jurnal jadi lebih gampang, tinggal buka HP input kegiatan. Guruku juga langsung bisa lihat tanpa harus ketemu."</p>
            <div class="testimonial-author">
                <div class="testimonial-avatar" style="background:linear-gradient(135deg,#667eea,#764ba2)">AN</div>
                <div>
                    <div class="testimonial-name">Andi Nugraha</div>
                    <div class="testimonial-role">Siswa PKL — Jurusan TKJ</div>
                </div>
            </div>
        </div>
        <div class="testimonial-card reveal">
            <div class="testimonial-stars">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <p class="testimonial-text">"Memantau 30+ siswa sekaligus jadi jauh lebih mudah. Saya bisa langsung kasih feedback tanpa harus nunggu siswa datang ke sekolah."</p>
            <div class="testimonial-author">
                <div class="testimonial-avatar" style="background:linear-gradient(135deg,#22c55e,#16a34a)">SR</div>
                <div>
                    <div class="testimonial-name">Sari Rahayu, S.Pd.</div>
                    <div class="testimonial-role">Guru Pembimbing PKL</div>
                </div>
            </div>
        </div>
        <div class="testimonial-card reveal">
            <div class="testimonial-stars">
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <p class="testimonial-text">"Rekap data mitra dan siswa yang dulunya makan waktu berhari-hari, sekarang bisa langsung download dalam hitungan menit."</p>
            <div class="testimonial-author">
                <div class="testimonial-avatar" style="background:linear-gradient(135deg,#f59e0b,#d97706)">BW</div>
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
        Masuk ke Sistem
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
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
// Navbar scroll
window.addEventListener('scroll', () => {
    document.getElementById('navbar').style.boxShadow =
        window.scrollY > 20 ? '0 4px 28px rgba(102,126,234,.1)' : 'none';
});

// Reveal on scroll
const obs = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => e.target.classList.add('visible'), i * 70);
            obs.unobserve(e.target);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

// Counter animation
function animateCounter(el) {
    const target = parseInt(el.dataset.target);
    const dur = 1800, step = target / (dur / 16);
    let cur = 0;
    const t = setInterval(() => {
        cur = Math.min(cur + step, target);
        el.textContent = Math.floor(cur);
        if (cur >= target) { el.textContent = target; clearInterval(t); }
    }, 16);
}

const cObs = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) { animateCounter(e.target); cObs.unobserve(e.target); }
    });
}, { threshold: 0.5 });
document.querySelectorAll('.counter').forEach(el => cObs.observe(el));

// Hero dashboard counters
document.querySelectorAll('.dash-stat-num[data-count]').forEach(el => {
    const target = parseInt(el.dataset.count);
    const suffix = el.textContent.includes('%') ? '%' : '';
    let count = 0;
    const step = target / 60;
    const t = setInterval(() => {
        count = Math.min(count + step, target);
        el.textContent = Math.floor(count) + suffix;
        if (count >= target) { el.textContent = target + suffix; clearInterval(t); }
    }, 20);
});

// Theme toggle
function toggleTheme() {
    const html = document.documentElement;
    const isLight = html.getAttribute('data-theme') === 'light';
    html.setAttribute('data-theme', isLight ? 'dark' : 'light');
    document.getElementById('ico-sun').style.display  = isLight ? 'none'  : 'block';
    document.getElementById('ico-moon').style.display = isLight ? 'block' : 'none';
    localStorage.setItem('simpkl-theme', isLight ? 'dark' : 'light');
}

// Load saved theme
const saved = localStorage.getItem('simpkl-theme');
if (saved === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
    document.getElementById('ico-sun').style.display  = 'none';
    document.getElementById('ico-moon').style.display = 'block';
}
</script>
</body>
</html>