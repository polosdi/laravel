<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — SIMPKL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --font: 'Poppins', 'Segoe UI', system-ui, sans-serif;
        }

        /* ── DARK THEME (default) ── */
        [data-theme="dark"] {
            --bg: #0d0b1e;
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-bg: rgba(255,255,255,.07);
            --card-border: rgba(255,255,255,.13);
            --card-shadow: 0 32px 80px rgba(0,0,0,.52), 0 8px 32px rgba(102,126,234,.1);
            --text: #ffffff;
            --text-muted: rgba(255,255,255,.45);
            --text-sub: rgba(255,255,255,.38);
            --input-bg: rgba(255,255,255,.057);
            --input-border: rgba(255,255,255,.1);
            --input-focus-border: rgba(102,126,234,.6);
            --input-focus-shadow: rgba(102,126,234,.17);
            --label: rgba(255,255,255,.5);
            --role-bg: rgba(255,255,255,.07);
            --role-border: rgba(255,255,255,.1);
            --role-active-bg: rgba(102,126,234,.22);
            --role-active-border: rgba(102,126,234,.52);
            --back: rgba(255,255,255,.34);
            --ico: rgba(255,255,255,.38);
            --eye: rgba(255,255,255,.3);
            --left-desc: rgba(255,255,255,.52);
            --left-feat: rgba(255,255,255,.55);
            --feat-bg: rgba(255,255,255,.07);
            --feat-border: rgba(255,255,255,.09);
            --chk-border: rgba(255,255,255,.2);
            --chk-bg: rgba(255,255,255,.05);
            --toggle-bg: rgba(255,255,255,.1);
        }

        /* ── LIGHT THEME ── */
        [data-theme="light"] {
            --bg: #F8F9FA;
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary: #8b9ff4;
            --card-bg: rgba(255,255,255,.92);
            --card-border: rgba(102,126,234,.15);
            --card-shadow: 0 20px 60px rgba(102,126,234,.15), 0 8px 32px rgba(0,0,0,.06);
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --text-sub: #9ca3af;
            --input-bg: #f8f9fa;
            --input-border: rgba(102,126,234,.2);
            --input-focus-border: rgba(102,126,234,.6);
            --input-focus-shadow: rgba(102,126,234,.12);
            --label: #6b7280;
            --role-bg: rgba(102,126,234,.06);
            --role-border: rgba(102,126,234,.15);
            --role-active-bg: rgba(102,126,234,.15);
            --role-active-border: rgba(102,126,234,.4);
            --back: #9ca3af;
            --ico: #9ca3af;
            --eye: #9ca3af;
            --left-desc: #6b7280;
            --left-feat: #6b7280;
            --feat-bg: rgba(102,126,234,.06);
            --feat-border: rgba(102,126,234,.12);
            --chk-border: rgba(102,126,234,.3);
            --chk-bg: rgba(102,126,234,.05);
            --toggle-bg: rgba(102,126,234,.1);
        }

        html, body { height: 100%; overflow: hidden; font-family: var(--font); background: var(--bg); transition: background .4s ease; }

        /* ── BG DARK ── */
        .bg-dark {
            position: fixed; inset: 0; z-index: 0; pointer-events: none; overflow: hidden;
            transition: opacity .4s ease;
        }

        [data-theme="light"] .bg-dark { opacity: 0; }
        [data-theme="dark"] .bg-dark { opacity: 1; }

        .bg-dark::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 70% 60% at 15% 15%, rgba(102,126,234,.28) 0%, transparent 60%),
                        radial-gradient(ellipse 60% 70% at 85% 85%, rgba(118,75,162,.32) 0%, transparent 55%),
                        #0d0b1e;
        }

        .blob { position: absolute; border-radius: 50%; filter: blur(72px); }
        .b1 { width:420px;height:420px;background:rgba(102,126,234,.18);top:-100px;left:-80px;animation:b1 18s ease-in-out infinite; }
        .b2 { width:340px;height:340px;background:rgba(118,75,162,.22);bottom:-80px;right:-60px;animation:b2 14s ease-in-out infinite; }
        .b3 { width:220px;height:220px;background:rgba(167,139,250,.13);top:40%;right:15%;animation:b3 20s ease-in-out infinite; }
        @keyframes b1 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(35px,-45px)} }
        @keyframes b2 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-40px,35px)} }
        @keyframes b3 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(25px,-30px)} }

        /* BG LIGHT */
        .bg-light {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            transition: opacity .4s ease;
            background:
                radial-gradient(ellipse 50% 40% at 10% 10%, rgba(102,126,234,.08) 0%, transparent 60%),
                radial-gradient(ellipse 40% 50% at 90% 90%, rgba(118,75,162,.08) 0%, transparent 55%),
                #F8F9FA;
        }
        [data-theme="light"] .bg-light { opacity: 1; }
        [data-theme="dark"] .bg-light { opacity: 0; }

        /* cursor glow */
        #glow {
            position: fixed; width:450px;height:450px;border-radius:50%;
            background: radial-gradient(circle, rgba(102,126,234,.15) 0%, transparent 70%);
            pointer-events:none; transform:translate(-50%,-50%); z-index:1; top:50%; left:50%;
            transition: opacity .4s;
        }
        [data-theme="light"] #glow { opacity: 0; }

        .star { position:absolute;background:white;border-radius:50%;opacity:0;animation:tw var(--d,3s) ease-in-out var(--dl,0s) infinite; }
        @keyframes tw { 0%,100%{opacity:0;transform:scale(.5)} 50%{opacity:.6;transform:scale(1.2)} }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 200;
            padding: 18px 28px 18px 80px;
            display: flex; align-items: center; justify-content: space-between;
        }

        .topbar-brand {
            display: flex; align-items: center; gap: 12px;
        }

        .topbar-brand-ico {
            width: 38px; height: 38px;
            background: var(--grad);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(102,126,234,.4);
        }

        .topbar-brand-ico svg { width: 20px; height: 20px; color: white; }

        .topbar-brand-name {
            font-size: 1.2rem; font-weight: 800;
            color: var(--text); letter-spacing: -.01em;
            transition: color .4s;
        }

        /* ── TOGGLE BUTTON ── */
        .theme-toggle {
            position: static;
            top: auto; right: auto;
            z-index: 200;
            width: 52px; height: 28px;
            background: var(--toggle-bg);
            border: 1px solid var(--card-border);
            border-radius: 50px;
            cursor: pointer;
            transition: all .3s ease;
            display: flex;
            align-items: center;
            padding: 3px;
            backdrop-filter: blur(10px);
        }

        .toggle-thumb {
            width: 20px; height: 20px;
            border-radius: 50%;
            background: var(--grad);
            transition: transform .3s cubic-bezier(.34,1.4,.64,1);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(102,126,234,.4);
        }

        [data-theme="light"] .toggle-thumb { transform: translateX(24px); }
        [data-theme="dark"] .toggle-thumb { transform: translateX(0); }

        .toggle-thumb svg { width: 11px; height: 11px; color: white; }

        /* ── PAGE ── */
        .page {
            position: fixed; inset: 0; z-index: 10;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 74px 20px 20px;
            overflow: hidden;
        }

        /* ── LEFT ── */
        .left {
            padding: 80px 48px 64px 80px;
            display: flex; flex-direction: column; justify-content: center;
        }

        .brand {
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 56px;
        }

        .brand-ico {
            width: 48px; height: 48px;
            background: var(--grad);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 28px rgba(102,126,234,.45);
            flex-shrink: 0;
        }

        .brand-ico svg { width: 24px; height: 24px; color: white; }

        .brand-name {
            font-size: 1.55rem; font-weight: 800;
            color: var(--text); display: block;
            letter-spacing: -.01em;
            transition: color .4s;
        }

        .brand-sub {
            font-size: .68rem; color: var(--text-muted);
            font-weight: 500; text-transform: uppercase; letter-spacing: .1em;
            transition: color .4s;
        }

        .tagline {
            font-size: clamp(2rem,3vw,3.2rem);
            font-weight: 800; color: var(--text);
            line-height: 1.15; margin-bottom: 22px;
            letter-spacing: -.02em;
            transition: color .4s;
        }

        .tagline .acc {
            background: var(--grad);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .ldesc {
            font-size: .92rem; color: var(--left-desc);
            line-height: 1.78; max-width: 380px;
            margin-bottom: 44px; font-weight: 400;
            transition: color .4s;
        }

        .feats { display: flex; flex-direction: column; gap: 14px; }

        .feat { display: flex; align-items: center; gap: 16px; }

        .feat-ico {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: var(--feat-bg);
            border: 1px solid var(--feat-border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: all .4s;
        }

        .feat-ico svg { width: 18px; height: 18px; color: var(--primary, #667eea); }

        .feat-txt {
            font-size: .855rem; color: var(--left-feat);
            font-weight: 500; transition: color .4s;
        }

        /* ── RIGHT ── */
        .right {
            display: flex; align-items: flex-start; justify-content: center;
            width: 100%;
            max-width: 460px;
        }

        /* ── CARD ── */
        .card {
            width: 100%; max-width: 420px;
            background: var(--card-bg);
            backdrop-filter: blur(32px) saturate(1.5);
            -webkit-backdrop-filter: blur(32px) saturate(1.5);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 32px 36px 28px;
            box-shadow: var(--card-shadow);
            animation: cardIn .7s cubic-bezier(.34,1.3,.64,1) both;
            transition: background .4s, border-color .4s, box-shadow .4s;
        }

        @keyframes cardIn {
            from { opacity:0; transform:scale(.93) translateY(22px); }
            to   { opacity:1; transform:scale(1) translateY(0); }
        }

        .card-title {
            font-size: 1.55rem; font-weight: 800;
            color: var(--text); line-height: 1.2;
            margin-bottom: 4px; letter-spacing: -.02em;
            transition: color .4s;
        }

        .card-sub {
            font-size: .825rem; color: var(--text-sub);
            margin-bottom: 20px; font-weight: 400;
            line-height: 1.5;
            transition: color .4s;
        }

        .alert {
            padding: 12px 16px; border-radius: 12px;
            font-size: .8rem; font-weight: 600;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }

        .a-err { background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444; }
        .a-ok  { background:rgba(34,197,94,.12); border:1px solid rgba(34,197,94,.25); color:#22c55e; }

        .a-err svg, .a-ok svg { width:16px;height:16px;flex-shrink:0; }

        /* fields */
        .field { margin-bottom: 15px; }

        .field label {
            display: block;
            font-size: .7rem; font-weight: 700;
            color: var(--label);
            letter-spacing: .08em; text-transform: uppercase;
            margin-bottom: 7px; transition: color .4s;
        }

        .iw { position: relative; }

        .iw .ico {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--ico);
            transition: color .2s;
            display: flex; align-items: center;
        }

        .iw .ico svg { width: 16px; height: 16px; }

        .iw:focus-within .ico { color: #667eea; }

        .iw input {
            width: 100%;
            padding: 12px 40px 12px 42px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 12px;
            color: var(--text);
            font-family: var(--font);
            font-size: .875rem; font-weight: 500;
            outline: none;
            transition: all .22s;
        }

        .iw input::placeholder { color: var(--ico); }

        .iw input:focus {
            border-color: var(--input-focus-border);
            box-shadow: 0 0 0 3px var(--input-focus-shadow);
        }

        [data-theme="light"] .iw input { background: white; }

        .eye {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer;
            color: var(--eye);
            display: flex; align-items: center;
            padding: 5px; transition: color .2s;
            border-radius: 6px;
        }

        .eye:hover { color: #667eea; }
        .eye svg { width: 16px; height: 16px; }

        /* opts */
        .opts {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
            margin-top: 4px;
        }

        .chk-wrap {
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 9px;
            cursor: pointer;
            font-size: .8rem; color: var(--text-muted);
            font-weight: 500; user-select: none;
            transition: color .4s;
        }

        .chk {
            width: 17px; height: 17px;
            border: 1.5px solid var(--chk-border);
            border-radius: 5px;
            background: var(--chk-bg);
            appearance: none; -webkit-appearance: none;
            cursor: pointer; position: relative;
            transition: all .2s; flex-shrink: 0;
        }

        .chk:checked { background: var(--grad); border-color: transparent; }

        .chk:checked::after {
            content: '';
            position: absolute;
            left: 4px; top: 1px;
            width: 6px; height: 10px;
            border: 2px solid white;
            border-top: none; border-left: none;
            transform: rotate(45deg);
        }

        .lupa {
            font-size: .8rem;
            color: #667eea;
            text-decoration: none; font-weight: 600;
            transition: color .2s;
        }
        .lupa:hover { color: #764ba2; }

        /* submit */
        .btn {
            margin-top: 30px;
            width: 100%; padding: 14px;
            background: var(--grad);
            color: white; border: none;
            border-radius: 13px;
            font-family: var(--font);
            font-size: .95rem; font-weight: 700;
            cursor: pointer;
            transition: all .28s;
            box-shadow: 0 8px 28px rgba(102,126,234,.42);
            display: flex; align-items: center; justify-content: center;
            gap: 8px; position: relative; overflow: hidden;
            letter-spacing: .01em;
        }

        .btn::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.15), transparent 60%);
            opacity: 0; transition: opacity .28s;
        }

        .btn:hover { transform: translateY(-2px); box-shadow: 0 14px 38px rgba(102,126,234,.55); }
        .btn:hover::after { opacity: 1; }
        .btn:active { transform: translateY(0); }

        .btn svg { width: 18px; height: 18px; }

        .spin {
            display: none; width: 20px; height: 20px;
            border: 2.5px solid rgba(255,255,255,.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin .65s linear infinite;
            position: absolute;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .btn.ld .btxt { opacity: 0; }
        .btn.ld .spin { display: block; }

        .back {
            display: flex; align-items: center; justify-content: center;
            gap: 6px; margin-top: 16px;
            font-size: .8rem; color: var(--back);
            text-decoration: none;
            transition: color .2s; font-weight: 500;
        }
        .back:hover { color: #667eea; }
        .back svg { width: 14px; height: 14px; }

        .card-footer {
            display: flex; align-items: center; justify-content: center;
            gap: 6px; margin-top: 8px;
            font-size: .775rem; color: var(--text-muted);
            font-weight: 500; transition: color .4s;
        }

        .card-footer a {
            color: #667eea; text-decoration: none;
            font-weight: 600; transition: color .2s;
        }
        .card-footer a:hover { color: #764ba2; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .left { display: none; }
            .right { width: 100%; }
            .theme-toggle { top: 16px; right: 16px; }
        }

        @media (max-width: 480px) {
            .page { padding: 68px 16px 16px; }
            .card { padding: 24px 20px 20px; border-radius: 20px; }
            .card-title { font-size: 1.3rem; }
        }
    </style>
</head>
<body>

<!-- BG DARK -->
<div class="bg-dark">
    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>
    <div id="sf"></div>
</div>

<!-- BG LIGHT -->
<div class="bg-light"></div>

<!-- Cursor glow -->
<!-- <div id="glow"></div> -->

<!-- TOPBAR: Logo kiri + Toggle kanan, sejajar -->
<div class="topbar">
    <div class="topbar-brand">
        <div class="topbar-brand-ico">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
        </div>
        <span class="topbar-brand-name">SIMPKL</span>
    </div>
    <button class="theme-toggle" onclick="toggleTheme()" title="Ganti tema">
        <div class="toggle-thumb" id="thumb">
            <svg id="ico-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
            </svg>
            <svg id="ico-light" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
            </svg>
        </div>
    </button>
</div>

<div class="page">

    <!-- LEFT -->
    <!-- <div class="left">

        <h1 class="tagline">
            Satu Platform,<br>
            <span class="acc">Semua PKL</span><br>
            Terpantau.
        </h1>

        <p class="ldesc">
            SIMPKL membantu siswa, guru, dan sekolah mengelola seluruh proses PKL secara digital — efisien, transparan, dan mudah diakses kapan saja.
        </p>

        <div class="feats">
            <div class="feat">
                <div class="feat-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <span class="feat-txt">E-Jurnal harian otomatis jadi data absen</span>
            </div>
            <div class="feat">
                <div class="feat-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                </div>
                <span class="feat-txt">Monitoring real-time untuk guru pembimbing</span>
            </div>
            <div class="feat">
                <div class="feat-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                </div>
                <span class="feat-txt">Manajemen mitra industri & MOU digital</span>
            </div>
            <div class="feat">
                <div class="feat-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </div>
                <span class="feat-txt">Laporan & rekap otomatis siap unduh</span>
            </div>
        </div>
    </div> -->

    <!-- RIGHT / CARD -->
    <div class="right">
        <div class="card">
            <h1 class="card-title">Selamat Datang 👋</h1>
            <p class="card-sub">Masuk untuk melanjutkan ke dashboard kamu</p>

            @if ($errors->any())
            <div class="alert a-err">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ $errors->first() }}
            </div>
            @endif

            @if (session('status'))
            <div class="alert a-ok">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="frm">
                @csrf
                
                <div class="field">
                    <label for="username">Username</label>
                    <div class="iw">
                        <span class="ico">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <input type="text" id="username" name="username"
                            placeholder="Masukkan username kamu"
                            value="{{ old('username') }}"
                            autocomplete="username" required>
                    </div>
                </div>

                <div class="field">
                    <label for="pwd">Kata Sandi</label>
                    <div class="iw">
                        <span class="ico">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <input type="password" id="pwd" name="password"
                            placeholder="Masukkan kata sandi"
                            autocomplete="current-password" required>
                        <button type="button" class="eye" onclick="togPwd()" id="eyebtn">
                            <svg id="eye-show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eye-hide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="opts">
                    <label class="chk-wrap">
                        <input type="checkbox" class="chk" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="lupa">Lupa sandi?</a>
                    @endif
                </div>

                <button type="submit" class="btn" id="sb">
                    <div class="spin"></div>
                    <span class="btxt">
                        Masuk ke Dashboard
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;display:inline;vertical-align:middle;margin-left:4px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </span>
                </button>
            </form>

            <a href="{{ url('/') }}" class="back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali ke Beranda
            </a>
            <div class="card-footer">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </div>
    </div>
</div>

<script>
// Cursor glow
// const glow = document.getElementById('glow');
// let mx = window.innerWidth/2, my = window.innerHeight/2;
// window.addEventListener('mousemove', e => { mx=e.clientX; my=e.clientY; });
// setInterval(() => { glow.style.left=mx+'px'; glow.style.top=my+'px'; }, 50);

// Stars
const sf = document.getElementById('sf');
sf.style.cssText = 'position:absolute;inset:0;overflow:hidden;';
for(let i=0;i<60;i++){
    const s=document.createElement('div'); s.className='star';
    const sz=.7+Math.random()*1.6;
    s.style.cssText=`width:${sz}px;height:${sz}px;left:${Math.random()*100}%;top:${Math.random()*100}%;--d:${2+Math.random()*4}s;--dl:${-(Math.random()*4)}s`;
    sf.appendChild(s);
}

// Theme toggle
function toggleTheme() {
    const html = document.documentElement;
    const isDark = html.getAttribute('data-theme') === 'dark';
    html.setAttribute('data-theme', isDark ? 'light' : 'dark');
    document.getElementById('ico-dark').style.display = isDark ? 'none' : 'block';
    document.getElementById('ico-light').style.display = isDark ? 'block' : 'none';
    localStorage.setItem('simpkl-theme', isDark ? 'light' : 'dark');
}

// Load saved theme
const saved = localStorage.getItem('simpkl-theme');
if (saved === 'light') {
    document.documentElement.setAttribute('data-theme', 'light');
    document.getElementById('ico-dark').style.display = 'none';
    document.getElementById('ico-light').style.display = 'block';
}

// Role

// Toggle password
function togPwd(){
    const inp=document.getElementById('pwd');
    const show = inp.type==='password';
    inp.type = show ? 'text' : 'password';
    document.getElementById('eye-show').style.display = show ? 'none' : 'block';
    document.getElementById('eye-hide').style.display = show ? 'block' : 'none';
}

// Submit
document.getElementById('frm').addEventListener('submit',()=>{
    const b=document.getElementById('sb');
    b.classList.add('ld'); b.disabled=true;
});
</script>
</body>
</html>