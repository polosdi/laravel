<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — SIMPKL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --font: 'Poppins', 'Segoe UI', system-ui, sans-serif; }

        [data-theme="light"] {
            --bg: #F8F9FA;
            --nav-bg: rgba(248,249,250,0.85);
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-bg: rgba(255,255,255,.95);
            --card-border: rgba(102,126,234,.15);
            --card-shadow: 0 20px 60px rgba(102,126,234,.15), 0 8px 32px rgba(0,0,0,.06);
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --text-sub: #9ca3af;
            --input-bg: #ffffff;
            --input-border: rgba(102,126,234,.2);
            --input-focus-border: rgba(102,126,234,.6);
            --input-focus-shadow: rgba(102,126,234,.12);
            --label: #6b7280;
            --back: #9ca3af;
            --ico: #9ca3af;
            --left-desc: #6b7280;
            --left-feat: #6b7280;
            --feat-bg: rgba(102,126,234,.06);
            --feat-border: rgba(102,126,234,.12);
            --toggle-bg: rgba(102,126,234,.1);
            --toggle-border: rgba(102,126,234,.2);
            --step-done: #667eea;
            --step-inactive: rgba(102,126,234,.2);
            --divider: rgba(102,126,234,.15);
        }

        [data-theme="dark"] {
            --bg: #0d0b1e;
            --nav-bg: rgba(13,11,30,0.85);
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-bg: rgba(255,255,255,.065);
            --card-border: rgba(255,255,255,.13);
            --card-shadow: 0 32px 80px rgba(0,0,0,.52), 0 8px 32px rgba(102,126,234,.1);
            --text: #ffffff;
            --text-muted: rgba(255,255,255,.45);
            --text-sub: rgba(255,255,255,.35);
            --input-bg: rgba(255,255,255,.057);
            --input-border: rgba(255,255,255,.1);
            --input-focus-border: rgba(102,126,234,.6);
            --input-focus-shadow: rgba(102,126,234,.17);
            --label: rgba(255,255,255,.5);
            --back: rgba(255,255,255,.34);
            --ico: rgba(255,255,255,.38);
            --left-desc: rgba(255,255,255,.52);
            --left-feat: rgba(255,255,255,.55);
            --feat-bg: rgba(255,255,255,.07);
            --feat-border: rgba(255,255,255,.09);
            --toggle-bg: rgba(255,255,255,.1);
            --toggle-border: rgba(255,255,255,.15);
            --step-done: #667eea;
            --step-inactive: rgba(255,255,255,.15);
            --divider: rgba(255,255,255,.1);
        }

        html { min-height: 100%; }
        body { min-height: 100vh; font-family: var(--font); background: var(--bg); color: var(--text); transition: background .4s, color .4s; overflow-x: hidden; }

        /* BG DARK */
        .bg-dark {
            position: fixed; inset: 0; z-index: 0; pointer-events: none; overflow: hidden;
            transition: opacity .4s;
            background: radial-gradient(ellipse 70% 60% at 15% 15%, rgba(102,126,234,.28) 0%, transparent 60%),
                        radial-gradient(ellipse 60% 70% at 85% 85%, rgba(118,75,162,.32) 0%, transparent 55%), #0d0b1e;
        }
        [data-theme="light"] .bg-dark { opacity: 0; }
        [data-theme="dark"]  .bg-dark { opacity: 1; }

        .blob { position: absolute; border-radius: 50%; filter: blur(72px); }
        .b1 { width:420px;height:420px;background:rgba(102,126,234,.18);top:-100px;left:-80px;animation:b1 18s ease-in-out infinite; }
        .b2 { width:340px;height:340px;background:rgba(118,75,162,.22);bottom:-80px;right:-60px;animation:b2 14s ease-in-out infinite; }
        @keyframes b1 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(35px,-45px)} }
        @keyframes b2 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-40px,35px)} }

        #glow { position:fixed;width:450px;height:450px;border-radius:50%;background:radial-gradient(circle,rgba(102,126,234,.12) 0%,transparent 70%);pointer-events:none;transform:translate(-50%,-50%);z-index:1;top:50%;left:50%;transition:opacity .4s; }
        [data-theme="light"] #glow { opacity: 0; }

        /* TOPBAR */
        .topbar {
            position: fixed; top:0; left:0; right:0; z-index: 200;
            padding: 16px 32px 16px 80px;
            display: flex; align-items: center; justify-content: space-between;
            background: var(--nav-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--card-border);
            transition: background .4s, border-color .4s;
        }

        .topbar-brand { display:flex;align-items:center;gap:12px; }

        .topbar-brand-ico {
            width: 36px; height: 36px;
            background: var(--grad); border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(102,126,234,.4);
        }
        .topbar-brand-ico svg { width: 18px; height: 18px; color: white; }

        .topbar-brand-name { font-size: 1.15rem; font-weight: 800; color: var(--text); letter-spacing: -.01em; transition: color .4s; }

        /* TOGGLE */
        .theme-toggle {
            width: 48px; height: 26px;
            background: var(--toggle-bg);
            border: 1px solid var(--toggle-border);
            border-radius: 50px; cursor: pointer;
            display: flex; align-items: center; padding: 3px;
            transition: all .3s; flex-shrink: 0;
        }
        .toggle-thumb {
            width: 18px; height: 18px; border-radius: 50%;
            background: var(--grad);
            transition: transform .3s cubic-bezier(.34,1.4,.64,1);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(102,126,234,.4);
        }
        [data-theme="light"] .toggle-thumb { transform: translateX(0); }
        [data-theme="dark"]  .toggle-thumb { transform: translateX(22px); }
        .toggle-thumb svg { width: 10px; height: 10px; color: white; }

        /* PAGE */
        .page {
            position: relative; z-index: 10;
            display: grid; grid-template-columns: 1fr 420px;
            min-height: 100vh;
            padding-top: 60px;
        }

        /* LEFT */
        .left {
            padding: 60px 48px 60px 80px;
            display: flex; flex-direction: column; justify-content: center;
        }

        .tagline { font-size: clamp(1.8rem,2.8vw,2.8rem); font-weight: 800; color: var(--text); line-height: 1.15; margin-bottom: 18px; letter-spacing: -.02em; transition: color .4s; }
        .tagline .acc { background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        .ldesc { font-size: .9rem; color: var(--left-desc); line-height: 1.75; max-width: 360px; margin-bottom: 40px; transition: color .4s; }

        .feats { display:flex;flex-direction:column;gap:13px; }
        .feat { display:flex;align-items:center;gap:14px; }
        .feat-ico { width:40px;height:40px;border-radius:11px;background:var(--feat-bg);border:1px solid var(--feat-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .4s; }
        .feat-ico svg { width:17px;height:17px;color:#667eea; }
        .feat-txt { font-size:.83rem;color:var(--left-feat);font-weight:500;transition:color .4s; }

        /* RIGHT */
        .right {
            display: flex; align-items: flex-start; justify-content: center;
            padding: 24px 32px 40px 16px;
            min-height: calc(100vh - 60px);
        }

        /* CARD */
        .card {
            width: 100%; max-width: 380px;
            background: var(--card-bg);
            backdrop-filter: blur(28px) saturate(1.4);
            -webkit-backdrop-filter: blur(28px) saturate(1.4);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 24px 26px;
            box-shadow: var(--card-shadow);
            animation: cardIn .7s cubic-bezier(.34,1.3,.64,1) both;
            transition: background .4s, border-color .4s, box-shadow .4s;
            margin-top: 8px;
        }

        @keyframes cardIn { from{opacity:0;transform:scale(.93) translateY(22px)} to{opacity:1;transform:scale(1) translateY(0)} }

        /* STEP INDICATOR */
        .steps {
            display: flex; align-items: center;
            gap: 0; margin-bottom: 20px;
        }

        .step {
            display: flex; align-items: center; gap: 6px;
            flex: 1;
        }

        .step-circle {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .72rem; font-weight: 700;
            flex-shrink: 0;
            transition: all .3s;
        }

        .step.done .step-circle, .step.active .step-circle {
            background: var(--grad); color: white;
            box-shadow: 0 4px 12px rgba(102,126,234,.35);
        }

        .step.inactive .step-circle {
            background: var(--step-inactive); color: var(--text-muted);
        }

        .step-label {
            font-size: .68rem; font-weight: 600;
            color: var(--text-muted); transition: color .3s;
            white-space: nowrap;
        }

        .step.active .step-label { color: #667eea; }
        .step.done .step-label { color: #667eea; }

        .step-line {
            flex: 1; height: 2px; margin: 0 8px;
            background: var(--step-inactive);
            border-radius: 2px; transition: background .3s;
            min-width: 20px;
        }

        .step-line.done { background: var(--grad); }

        /* CARD TITLE */
        .card-title { font-size: 1.35rem; font-weight: 800; color: var(--text); line-height: 1.15; margin-bottom: 2px; letter-spacing: -.02em; transition: color .4s; }
        .card-sub { font-size: .78rem; color: var(--text-sub); margin-bottom: 18px; transition: color .4s; }

        /* ALERTS */
        .alert { padding: 10px 13px; border-radius: 10px; font-size: .78rem; font-weight: 600; margin-bottom: 14px; display:flex;align-items:center;gap:8px; }
        .a-err { background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444; }
        .a-err svg { width:15px;height:15px;flex-shrink:0; }

        /* FORM STEP PANELS */
        .step-panel { display: none; }
        .step-panel.active { display: block; }

        /* FIELDS */
        .field { margin-bottom: 10px; }
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px; }

        .field label {
            display: block; font-size: .69rem; font-weight: 700;
            color: var(--label); letter-spacing: .06em; text-transform: uppercase;
            margin-bottom: 6px; transition: color .4s;
        }

        .iw { position: relative; }

        .iw .ico {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            pointer-events: none; color: var(--ico);
            display: flex; align-items: center; transition: color .2s;
        }
        .iw .ico svg { width: 14px; height: 14px; }
        .iw:focus-within .ico { color: #667eea; }

        .iw input, .iw select, .iw textarea {
            width: 100%;
            padding: 9px 36px 9px 34px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 10px;
            color: var(--text);
            font-family: var(--font);
            font-size: .83rem; font-weight: 500;
            outline: none; transition: all .22s;
        }

        .iw select { padding-left: 34px; cursor: pointer; appearance: none; }
        .iw textarea { padding-left: 34px; resize: none; height: 70px; }

        .iw input::placeholder, .iw textarea::placeholder { color: var(--ico); }
        [data-theme="light"] .iw input, [data-theme="light"] .iw select, [data-theme="light"] .iw textarea { background: white; }

        .iw input:focus, .iw select:focus, .iw textarea:focus {
            border-color: var(--input-focus-border);
            box-shadow: 0 0 0 3px var(--input-focus-shadow);
        }

        .iw .ico-right {
            position: absolute; right: 10px; top: 50%;
            transform: translateY(-50%);
            pointer-events: none; color: var(--ico);
            display: flex; align-items: center;
        }
        .iw .ico-right svg { width: 13px; height: 13px; }

        .eye {
            position: absolute; right: 10px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: var(--eye); display: flex; align-items: center;
            padding: 4px; transition: color .2s; border-radius: 5px;
        }
        .eye:hover { color: #667eea; }
        .eye svg { width: 14px; height: 14px; }

        /* PASSWORD STRENGTH */
        .pwd-strength { margin-top: 6px; }
        .pwd-bars { display: flex; gap: 3px; margin-bottom: 3px; }
        .pwd-bar { flex: 1; height: 3px; border-radius: 3px; background: var(--step-inactive); transition: background .3s; }
        .pwd-bar.weak   { background: #ef4444; }
        .pwd-bar.medium { background: #f59e0b; }
        .pwd-bar.strong { background: #22c55e; }
        .pwd-text { font-size: .65rem; color: var(--text-sub); transition: color .4s; }

        /* HINT TEXT */
        .hint { font-size: .67rem; color: var(--text-sub); margin-top: 4px; transition: color .4s; }

        /* DIVIDER */
        .divider { height: 1px; background: var(--divider); margin: 14px 0; }

        /* BUTTONS */
        .btn-row { display: flex; gap: 8px; margin-top: 16px; }

        .btn-back-step {
            padding: 11px 16px;
            background: var(--feat-bg);
            border: 1px solid var(--card-border);
            border-radius: 11px;
            color: var(--text-muted);
            font-family: var(--font);
            font-size: .82rem; font-weight: 600;
            cursor: pointer; transition: all .2s;
            display: flex; align-items: center; gap: 6px;
        }
        .btn-back-step:hover { border-color: #667eea; color: #667eea; }
        .btn-back-step svg { width: 14px; height: 14px; }

        .btn {
            flex: 1; padding: 11px;
            background: var(--grad); color: white; border: none;
            border-radius: 11px;
            font-family: var(--font); font-size: .85rem; font-weight: 700;
            cursor: pointer; transition: all .28s;
            box-shadow: 0 6px 22px rgba(102,126,234,.4);
            display: flex; align-items: center; justify-content: center;
            gap: 7px; position: relative; overflow: hidden;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(102,126,234,.5); }
        .btn:active { transform: translateY(0); }
        .btn svg { width: 15px; height: 15px; }

        .spin { display:none;width:17px;height:17px;border:2px solid rgba(255,255,255,.3);border-top-color:white;border-radius:50%;animation:spin .65s linear infinite;position:absolute; }
        @keyframes spin { to{transform:rotate(360deg)} }
        .btn.ld .btxt { opacity:0; }
        .btn.ld .spin { display:block; }

        /* FOOTER LINKS */
        .card-footer {
            display: flex; align-items: center; justify-content: center;
            gap: 5px; margin-top: 12px;
            font-size: .74rem; color: var(--text-muted); font-weight: 500;
        }
        .card-footer a { color: #667eea; text-decoration: none; font-weight: 600; transition: color .2s; }
        .card-footer a:hover { color: #764ba2; }

        /* RESPONSIVE */
        @media (max-width: 960px) {
            .page { grid-template-columns: 1fr; }
            .left { display: none; }
            .right { padding: 20px; min-height: calc(100vh - 60px); align-items: flex-start; padding-top: 20px; }
            .topbar { padding: 14px 20px; }
        }
    </style>
</head>
<body>

<div class="bg-dark">
    <div class="blob b1"></div>
    <div class="blob b2"></div>
</div>
<div id="glow"></div>

<!-- TOPBAR -->
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
        <div class="toggle-thumb">
            <svg id="ico-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
            </svg>
            <svg id="ico-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
            </svg>
        </div>
    </button>
</div>

<div class="page">

    <!-- LEFT -->
    <div class="left">
        <h1 class="tagline">
            Mulai Perjalanan<br>
            <span class="acc">PKL-mu</span><br>
            Bersama Kami.
        </h1>
        <p class="ldesc">Daftarkan dirimu sebagai siswa PKL dan nikmati kemudahan mengelola jurnal, nilai, dan laporan dalam satu platform.</p>
        <div class="feats">
            <div class="feat">
                <div class="feat-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <span class="feat-txt">Input e-jurnal harian kapan saja & di mana saja</span>
            </div>
            <div class="feat">
                <div class="feat-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <span class="feat-txt">Lihat nilai & feedback dari guru pembimbing</span>
            </div>
            <div class="feat">
                <div class="feat-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <span class="feat-txt">Pantau sisa hari & progress PKL real-time</span>
            </div>
            <div class="feat">
                <div class="feat-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <span class="feat-txt">Profil digital lengkap untuk keperluan sertifikat</span>
            </div>
        </div>
    </div>

    <!-- RIGHT / CARD -->
    <div class="right">
        <div class="card">

            <!-- Step Indicator -->
            <div class="steps">
                <div class="step active" id="step-ind-1">
                    <div class="step-circle">1</div>
                    <span class="step-label">Akun</span>
                </div>
                <div class="step-line" id="line-1"></div>
                <div class="step inactive" id="step-ind-2">
                    <div class="step-circle">2</div>
                    <span class="step-label">Data Diri</span>
                </div>
            </div>

            <!-- ALERTS -->
            @if ($errors->any())
            <div class="alert a-err">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="regForm">
                @csrf

                <!-- ── STEP 1: AKUN ── -->
                <div class="step-panel active" id="panel-1">
                    <h1 class="card-title">Buat Akun</h1>
                    <p class="card-sub">Isi informasi akun untuk masuk ke SIMPKL</p>

                    <div class="field">
                        <label for="username">Username</label>
                        <div class="iw">
                            <span class="ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <input type="text" id="username" name="username"
                                placeholder="contoh: andi.nugraha"
                                value="{{ old('username') }}"
                                autocomplete="username">
                        </div>
                        <div class="hint">Gunakan huruf kecil, angka, atau titik. Tidak bisa diubah.</div>
                    </div>

                    <div class="field">
                        <label for="password">Kata Sandi</label>
                        <div class="iw">
                            <span class="ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password" name="password"
                                placeholder="Min. 8 karakter"
                                oninput="checkStrength(this.value)">
                            <button type="button" class="eye" onclick="togPwd('password','eye1')">
                                <svg id="eye1-show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="eye1-hide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        <div class="pwd-strength">
                            <div class="pwd-bars">
                                <div class="pwd-bar" id="bar1"></div>
                                <div class="pwd-bar" id="bar2"></div>
                                <div class="pwd-bar" id="bar3"></div>
                                <div class="pwd-bar" id="bar4"></div>
                            </div>
                            <div class="pwd-text" id="pwd-text">Masukkan kata sandi</div>
                        </div>
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <div class="iw">
                            <span class="ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi kata sandi">
                            <button type="button" class="eye" onclick="togPwd('password_confirmation','eye2')">
                                <svg id="eye2-show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="eye2-hide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="btn-row">
                        <button type="button" class="btn" onclick="goStep2()">
                            <span class="btxt">
                                Lanjut — Data Diri
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;margin-left:4px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- ── STEP 2: DATA DIRI ── -->
                <div class="step-panel" id="panel-2">
                    <h1 class="card-title">Data Diri</h1>
                    <p class="card-sub">Lengkapi informasi dirimu sebagai siswa PKL</p>

                    <div class="field">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <div class="iw">
                            <span class="ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <input type="text" id="nama_lengkap" name="nama_lengkap"
                                placeholder="Nama sesuai ijazah"
                                value="{{ old('nama_lengkap') }}">
                        </div>
                    </div>

                    <div class="field">
                        <label for="nis">NIS (Nomor Induk Siswa)</label>
                        <div class="iw">
                            <span class="ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            </span>
                            <input type="text" id="nis" name="nis"
                                placeholder="Contoh: 2223001234"
                                value="{{ old('nis') }}"
                                inputmode="numeric">
                        </div>
                    </div>

                    <div class="field-row">
                        <div class="field" style="margin-bottom:0">
                            <label for="kelas">Kelas</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg>
                                </span>
                                <select id="kelas" name="kelas">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="XI" {{ old('kelas')=='XI' ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ old('kelas')=='XII' ? 'selected' : '' }}>XII</option>
                                </select>
                                <span class="ico-right">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                            </div>
                        </div>
                        <div class="field" style="margin-bottom:0">
                            <label for="jurusan">Jurusan</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                                </span>
                                <select id="jurusan" name="jurusan">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="TKJ" {{ old('jurusan')=='TKJ' ? 'selected' : '' }}>TKJ</option>
                                    <option value="RPL" {{ old('jurusan')=='RPL' ? 'selected' : '' }}>RPL</option>
                                    <option value="AKL" {{ old('jurusan')=='AKL' ? 'selected' : '' }}>AKL</option>
                                    <option value="OTKP" {{ old('jurusan')=='OTKP' ? 'selected' : '' }}>OTKP</option>
                                </select>
                                <span class="ico-right">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="field-row" style="margin-top:10px">
                        <div class="field" style="margin-bottom:0">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                <input type="text" id="tempat_lahir" name="tempat_lahir"
                                    placeholder="Kota"
                                    value="{{ old('tempat_lahir') }}">
                            </div>
                        </div>
                        <div class="field" style="margin-bottom:0">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <div class="iw">
                                <span class="ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </span>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}"
                                    style="padding-left:34px">
                            </div>
                        </div>
                    </div>

                    <div class="field" style="margin-top:10px">
                        <label for="alamat">Alamat</label>
                        <div class="iw">
                            <span class="ico" style="top:16px;transform:none">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <textarea id="alamat" name="alamat" placeholder="Alamat lengkap tempat tinggal">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <div class="btn-row">
                        <button type="button" class="btn-back-step" onclick="goStep1()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                            Kembali
                        </button>
                        <button type="submit" class="btn" id="sb">
                            <div class="spin"></div>
                            <span class="btxt">
                                Daftar Sekarang
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;margin-left:4px"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                        </button>
                    </div>
                </div>

            </form>

            <div class="card-footer">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk sekarang</a>
            </div>

        </div>
    </div>
</div>

<script>
// Cursor glow
const glow = document.getElementById('glow');
let mx = window.innerWidth/2, my = window.innerHeight/2;
window.addEventListener('mousemove', e => { mx=e.clientX; my=e.clientY; });
setInterval(() => { glow.style.left=mx+'px'; glow.style.top=my+'px'; }, 50);

// Theme toggle
function toggleTheme() {
    const html = document.documentElement;
    const isLight = html.getAttribute('data-theme') === 'light';
    html.setAttribute('data-theme', isLight ? 'dark' : 'light');
    document.getElementById('ico-sun').style.display  = isLight ? 'none'  : 'block';
    document.getElementById('ico-moon').style.display = isLight ? 'block' : 'none';
    localStorage.setItem('simpkl-theme', isLight ? 'dark' : 'light');
}
const saved = localStorage.getItem('simpkl-theme');
if (saved === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
    document.getElementById('ico-sun').style.display  = 'none';
    document.getElementById('ico-moon').style.display = 'block';
}

// Step navigation
function goStep2() {
    const username = document.getElementById('username').value.trim();
    const pwd = document.getElementById('password').value;
    const pwdConf = document.getElementById('password_confirmation').value;

    if (!username) { alert('Username wajib diisi!'); return; }
    if (!/^[a-z0-9._]+$/.test(username)) { alert('Username hanya boleh huruf kecil, angka, titik, atau underscore!'); return; }
    if (pwd.length < 8) { alert('Kata sandi minimal 8 karakter!'); return; }
    if (pwd !== pwdConf) { alert('Konfirmasi kata sandi tidak cocok!'); return; }

    document.getElementById('panel-1').classList.remove('active');
    document.getElementById('panel-2').classList.add('active');
    document.getElementById('step-ind-1').className = 'step done';
    document.getElementById('step-ind-2').className = 'step active';
    document.getElementById('line-1').classList.add('done');
}

function goStep1() {
    document.getElementById('panel-2').classList.remove('active');
    document.getElementById('panel-1').classList.add('active');
    document.getElementById('step-ind-1').className = 'step active';
    document.getElementById('step-ind-2').className = 'step inactive';
    document.getElementById('line-1').classList.remove('done');
}

// Toggle password
function togPwd(inputId, eyeId) {
    const inp = document.getElementById(inputId);
    const show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    document.getElementById(eyeId+'-show').style.display = show ? 'none' : 'block';
    document.getElementById(eyeId+'-hide').style.display = show ? 'block' : 'none';
}

// Password strength
function checkStrength(val) {
    const bars = ['bar1','bar2','bar3','bar4'];
    const txt = document.getElementById('pwd-text');
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    bars.forEach((b,i) => {
        const el = document.getElementById(b);
        el.className = 'pwd-bar';
        if (i < score) {
            if (score === 1) el.classList.add('weak');
            else if (score <= 2) el.classList.add('medium');
            else el.classList.add('strong');
        }
    });

    const labels = ['', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
    txt.textContent = val.length === 0 ? 'Masukkan kata sandi' : labels[score] || 'Lemah';
}

// Submit
document.getElementById('regForm').addEventListener('submit', () => {
    const b = document.getElementById('sb');
    b.classList.add('ld'); b.disabled = true;
});

// If errors, go to step 2 if data diri fields have errors
@if($errors->hasAny(['nama_lengkap','nis','kelas','jurusan','tempat_lahir','tanggal_lahir','alamat']))
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('panel-1').classList.remove('active');
        document.getElementById('panel-2').classList.add('active');
        document.getElementById('step-ind-1').className = 'step done';
        document.getElementById('step-ind-2').className = 'step active';
        document.getElementById('line-1').classList.add('done');
    });
@endif
</script>
</body>
</html>