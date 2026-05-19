<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — SIMPKL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --font: 'Poppins', 'Segoe UI', system-ui, sans-serif; }

        /* ── EXACT SAME THEMES AS LOGIN ── */
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
            --back: rgba(255,255,255,.34);
            --ico: rgba(255,255,255,.38);
            --eye: rgba(255,255,255,.3);
            --left-desc: rgba(255,255,255,.52);
            --left-feat: rgba(255,255,255,.55);
            --feat-bg: rgba(255,255,255,.07);
            --feat-border: rgba(255,255,255,.09);
            --toggle-bg: rgba(255,255,255,.1);
        }

        [data-theme="light"] {
            --bg: #F8F9FA;
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            --back: #9ca3af;
            --ico: #9ca3af;
            --eye: #9ca3af;
            --left-desc: #6b7280;
            --left-feat: #6b7280;
            --feat-bg: rgba(102,126,234,.06);
            --feat-border: rgba(102,126,234,.12);
            --toggle-bg: rgba(102,126,234,.1);
        }

        html, body { min-height: 100vh; font-family: var(--font); background: var(--bg); transition: background .4s; overflow-x: hidden; }

        /* BG — exact same as login */
        .bg-dark { position:fixed;inset:0;z-index:0;pointer-events:none;overflow:hidden;transition:opacity .4s; }
        [data-theme="light"] .bg-dark { opacity:0; }
        [data-theme="dark"]  .bg-dark { opacity:1; }
        .bg-dark::before { content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 60% at 15% 15%,rgba(102,126,234,.28) 0%,transparent 60%),radial-gradient(ellipse 60% 70% at 85% 85%,rgba(118,75,162,.32) 0%,transparent 55%),#0d0b1e; }
        .blob { position:absolute;border-radius:50%;filter:blur(72px); }
        .b1 { width:420px;height:420px;background:rgba(102,126,234,.18);top:-100px;left:-80px;animation:b1 18s ease-in-out infinite; }
        .b2 { width:340px;height:340px;background:rgba(118,75,162,.22);bottom:-80px;right:-60px;animation:b2 14s ease-in-out infinite; }
        .b3 { width:220px;height:220px;background:rgba(167,139,250,.13);top:40%;right:15%;animation:b3 20s ease-in-out infinite; }
        @keyframes b1 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(35px,-45px)} }
        @keyframes b2 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-40px,35px)} }
        @keyframes b3 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(25px,-30px)} }

        .bg-light { position:fixed;inset:0;z-index:0;pointer-events:none;transition:opacity .4s;background:radial-gradient(ellipse 50% 40% at 10% 10%,rgba(102,126,234,.08) 0%,transparent 60%),radial-gradient(ellipse 40% 50% at 90% 90%,rgba(118,75,162,.08) 0%,transparent 55%),#F8F9FA; }
        [data-theme="light"] .bg-light { opacity:1; }
        [data-theme="dark"]  .bg-light { opacity:0; }

        #glow { position:fixed;width:450px;height:450px;border-radius:50%;background:radial-gradient(circle,rgba(102,126,234,.15) 0%,transparent 70%);pointer-events:none;transform:translate(-50%,-50%);z-index:1;top:50%;left:50%;transition:opacity .4s; }
        [data-theme="light"] #glow { opacity:0; }
        .star { position:absolute;background:white;border-radius:50%;opacity:0;animation:tw var(--d,3s) ease-in-out var(--dl,0s) infinite; }
        @keyframes tw { 0%,100%{opacity:0;transform:scale(.5)} 50%{opacity:.6;transform:scale(1.2)} }

        /* TOPBAR — exact same as login */
        .topbar { position:fixed;top:0;left:0;right:0;z-index:200;padding:18px 28px 18px 80px;display:flex;align-items:center;justify-content:space-between; }
        .topbar-brand { display:flex;align-items:center;gap:12px; }
        .topbar-brand-ico { width:38px;height:38px;background:var(--grad);border-radius:11px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(102,126,234,.4); }
        .topbar-brand-ico svg { width:20px;height:20px;color:white; }
        .topbar-brand-name { font-size:1.2rem;font-weight:800;color:var(--text);letter-spacing:-.01em;transition:color .4s; }
        .theme-toggle { width:52px;height:28px;background:var(--toggle-bg);border:1px solid var(--card-border);border-radius:50px;cursor:pointer;transition:all .3s;display:flex;align-items:center;padding:3px;backdrop-filter:blur(10px); }
        .toggle-thumb { width:20px;height:20px;border-radius:50%;background:var(--grad);transition:transform .3s cubic-bezier(.34,1.4,.64,1);display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(102,126,234,.4); }
        [data-theme="light"] .toggle-thumb { transform:translateX(24px); }
        [data-theme="dark"]  .toggle-thumb { transform:translateX(0); }
        .toggle-thumb svg { width:11px;height:11px;color:white; }

        /* PAGE LAYOUT — exact same as login */
        .page { position:relative;z-index:10;display:flex;align-items:center;justify-content:center;min-height:100vh;padding:70px 20px 32px; }

        /* RIGHT */
        .right { display:flex;align-items:center;justify-content:center;width:100%;margin-top:40px; }

        /* CARD */
        .card { width:100%;max-width:390px;background:var(--card-bg);backdrop-filter:blur(28px) saturate(1.4);-webkit-backdrop-filter:blur(28px) saturate(1.4);border:1px solid var(--card-border);border-radius:24px;padding:28px 36px 28px;box-shadow:var(--card-shadow);animation:cardIn .7s cubic-bezier(.34,1.3,.64,1) both;transition:background .4s,border-color .4s,box-shadow .4s,max-width .35s cubic-bezier(.4,0,.2,1); }
        .card.card-wide { max-width:620px; }
        @keyframes cardIn { from{opacity:0;transform:scale(.93) translateY(22px)} to{opacity:1;transform:scale(1) translateY(0)} }

        .card-title { font-size:1.45rem;font-weight:800;color:var(--text);line-height:1.15;margin-bottom:2px;letter-spacing:-.02em;transition:color .4s; }
        .card-sub { font-size:.8rem;color:var(--text-sub);margin-bottom:18px;font-weight:400;transition:color .4s; }

        /* STEP INDICATOR */
        .steps { display:flex;align-items:center;margin-bottom:18px;gap:0; }
        .step { display:flex;align-items:center;gap:6px;flex:1; }
        .step-circle { width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;flex-shrink:0;transition:all .3s; }
        .step.done .step-circle, .step.active .step-circle { background:var(--grad);color:white;box-shadow:0 4px 12px rgba(102,126,234,.35); }
        .step.inactive .step-circle { background:rgba(255,255,255,.1);color:var(--text-muted);border:1.5px solid var(--input-border); }
        [data-theme="light"] .step.inactive .step-circle { background:rgba(102,126,234,.08); }
        .step-label { font-size:.68rem;font-weight:600;color:var(--text-muted);white-space:nowrap;transition:color .3s; }
        .step.active .step-label, .step.done .step-label { color:#667eea; }
        .step-line { flex:1;height:2px;margin:0 8px;background:rgba(255,255,255,.12);border-radius:2px;transition:background .3s;min-width:20px; }
        [data-theme="light"] .step-line { background:rgba(102,126,234,.15); }
        .step-line.done { background:var(--grad); }

        /* ALERTS */
        .alert { padding:10px 13px;border-radius:10px;font-size:.78rem;font-weight:600;margin-bottom:14px;display:flex;align-items:center;gap:8px; }
        .a-err { background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444; }
        .a-err svg { width:15px;height:15px;flex-shrink:0; }

        /* STEP PANELS */
        .step-panel { display:none; }
        .step-panel.active { display:block; }

        /* FIELDS — exact same style as login */
        .field { margin-bottom:10px; }
        .field-row { display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px; }

        .field label { display:block;font-size:.69rem;font-weight:700;color:var(--label);letter-spacing:.06em;text-transform:uppercase;margin-bottom:6px;transition:color .4s; }

        .iw { position:relative; }
        .iw .ico { position:absolute;left:12px;top:50%;transform:translateY(-50%);pointer-events:none;color:var(--ico);display:flex;align-items:center;transition:color .2s; }
        .iw .ico svg { width:14px;height:14px; }
        .iw:focus-within .ico { color:#667eea; }

        .iw input, .iw select, .iw textarea {
            width:100%;padding:9px 36px 9px 34px;
            background:var(--input-bg);border:1px solid var(--input-border);
            border-radius:10px;color:var(--text);
            font-family:var(--font);font-size:.83rem;font-weight:500;
            outline:none;transition:all .22s;
        }
        .iw select { padding-left:34px;cursor:pointer;appearance:none; }
        .iw textarea { padding-left:34px;resize:none;height:65px; }
        .iw input::placeholder, .iw textarea::placeholder { color:var(--ico); }
        [data-theme="light"] .iw input, [data-theme="light"] .iw select, [data-theme="light"] .iw textarea { background:white; }
        .iw input:focus, .iw select:focus, .iw textarea:focus { border-color:var(--input-focus-border);box-shadow:0 0 0 3px var(--input-focus-shadow); }
       
.iw select option { background:#1e1b3a; color:white; }
.iw select option:checked { background:#667eea; color:white; }

        .ico-right { position:absolute;right:10px;top:50%;transform:translateY(-50%);pointer-events:none;color:var(--ico);display:flex;align-items:center; }
        .ico-right svg { width:13px;height:13px; }

        .eye { position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--eye);display:flex;align-items:center;padding:4px;transition:color .2s;border-radius:5px; }
        .eye:hover { color:#667eea; }
        .eye svg { width:14px;height:14px; }

        /* PASSWORD STRENGTH */
        .pwd-strength { margin-top:5px; }
        .pwd-bars { display:flex;gap:3px;margin-bottom:3px; }
        .pwd-bar { flex:1;height:3px;border-radius:3px;background:var(--input-border);transition:background .3s; }
        .pwd-bar.weak { background:#ef4444; }
        .pwd-bar.medium { background:#f59e0b; }
        .pwd-bar.strong { background:#22c55e; }
        .pwd-text { font-size:.63rem;color:var(--text-sub);transition:color .4s; }

        .hint { font-size:.66rem;color:var(--text-sub);margin-top:4px;transition:color .4s; }

        /* BTN ROW */
        .btn-row { display:flex;gap:8px;margin-top:14px; }

        .btn-back {
            padding:10px 14px;
            background:var(--feat-bg);border:1px solid var(--card-border);
            border-radius:10px;color:var(--text-muted);
            font-family:var(--font);font-size:.8rem;font-weight:600;
            cursor:pointer;transition:all .2s;
            display:flex;align-items:center;gap:6px;
        }
        .btn-back:hover { border-color:#667eea;color:#667eea; }
        .btn-back svg { width:14px;height:14px; }

        /* SUBMIT — exact same as login */
        .btn { flex:1;padding:11px;background:var(--grad);color:white;border:none;border-radius:11px;font-family:var(--font);font-size:.87rem;font-weight:700;cursor:pointer;transition:all .28s;box-shadow:0 6px 22px rgba(102,126,234,.4);display:flex;align-items:center;justify-content:center;gap:7px;position:relative;overflow:hidden;letter-spacing:.01em; }
        .btn:hover { transform:translateY(-2px);box-shadow:0 12px 32px rgba(102,126,234,.5); }
        .btn:active { transform:translateY(0); }
        .btn svg { width:15px;height:15px; }

        /* NEXT STEP BUTTON — lebih besar */
        .btn-next { padding:16px 20px;font-size:1.05rem;border-radius:14px;box-shadow:0 10px 32px rgba(102,126,234,.48); }
        .btn-next:hover { box-shadow:0 16px 42px rgba(102,126,234,.62); }
        .spin { display:none;width:17px;height:17px;border:2px solid rgba(255,255,255,.3);border-top-color:white;border-radius:50%;animation:spin .65s linear infinite;position:absolute; }
        @keyframes spin { to{transform:rotate(360deg)} }
        .btn.ld .btxt { opacity:0; }
        .btn.ld .spin { display:block; }

        /* FOOTER — exact same as login */
        .back { display:flex;align-items:center;justify-content:center;gap:6px;margin-top:14px;font-size:.79rem;color:var(--back);text-decoration:none;transition:color .2s;font-weight:500; }
        .back:hover { color:#667eea; }
        .back svg { width:14px;height:14px; }

        .card-footer { display:flex;align-items:center;justify-content:center;gap:5px;margin-top:10px;font-size:.74rem;color:var(--text-muted);font-weight:500; }
        .card-footer a { color:#667eea;text-decoration:none;font-weight:600;transition:color .2s; }
        .card-footer a:hover { color:#764ba2; }

        @media (max-width:960px) { .page{padding:70px 16px 24px} .topbar{padding:16px 20px} }
        @media (max-width:660px) { .card{padding:24px 20px;border-radius:18px} .field-row{grid-template-columns:1fr} }
    </style>
</head>
<body>

<div class="bg-dark">
    <div class="blob b1"></div><div class="blob b2"></div><div class="blob b3"></div>
    <div id="sf"></div>
</div>
<div class="bg-light"></div>
<div id="glow"></div>

<!-- TOPBAR — exact same as login -->
<div class="topbar">
    <div class="topbar-brand">
        <div class="topbar-brand-ico">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
        </div>
        <span class="topbar-brand-name">SIMPKL</span>
    </div>
    <button class="theme-toggle" onclick="toggleTheme()">
        <div class="toggle-thumb">
            <svg id="ico-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg id="ico-light" style="display:none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
        </div>
    </button>
</div>


<!-- LEFT — exact same structure as login -->
<!-- <div class="left">
        <h1 class="tagline">
            Mulai Perjalanan<br>
            <span class="acc">PKL-mu</span><br>
            Bersama Kami.
        </h1>
        <p class="ldesc">Daftarkan dirimu sebagai siswa PKL dan nikmati kemudahan mengelola jurnal, nilai, dan laporan dalam satu platform.</p>
        <div class="feats">
            <div class="feat">
                <div class="feat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
                <span class="feat-txt">Input e-jurnal harian kapan saja & di mana saja</span>
            </div>
            <div class="feat">
                <div class="feat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                <span class="feat-txt">Lihat nilai & feedback dari guru pembimbing</span>
            </div>
            <div class="feat">
                <div class="feat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                <span class="feat-txt">Pantau sisa hari & progress PKL real-time</span>
            </div>
            <div class="feat">
                <div class="feat-ico"><svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                <span class="feat-txt">Profil digital lengkap untuk keperluan sertifikat</span>
            </div>
        </div>
    </div> -->

    <!-- RIGHT / CARD -->
    <div class="right">
        <div class="card">

            <!-- Step Indicator -->
            <div class="steps">
                <div class="step active" id="si1">
                    <div class="step-circle">1</div>
                    <span class="step-label">Akun</span>
                </div>
                <div class="step-line" id="line1"></div>
                <div class="step inactive" id="si2">
                    <div class="step-circle">2</div>
                    <span class="step-label">Data Diri</span>
                </div>
            </div>

            @if ($errors->any())
            <div class="alert a-err">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="regForm">
                @csrf

                <!-- STEP 1 -->
                <div class="step-panel active" id="p1">
                    <h1 class="card-title">Buat Akun</h1>
                    <p class="card-sub">Isi informasi akun untuk masuk ke SIMPKL</p>

                    <div class="field">
                        <label>Username</label>
                        <div class="iw">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                            <input type="text" name="username" placeholder="contoh: andi.nugraha" value="{{ old('username') }}" autocomplete="username">
                        </div>
                        <div class="hint">Gunakan huruf kecil, angka, atau titik. Tidak bisa diubah.</div>
                    </div>

                    <div class="field">
                        <label>Kata Sandi</label>
                        <div class="iw">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
                            <input type="password" id="pwd1" name="password" placeholder="Min. 8 karakter" oninput="checkStr(this.value)">
                            <button type="button" class="eye" onclick="togPwd('pwd1','e1s','e1h')">
                                <svg id="e1s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="e1h" style="display:none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        <div class="pwd-strength">
                            <div class="pwd-bars"><div class="pwd-bar" id="b1"></div><div class="pwd-bar" id="b2"></div><div class="pwd-bar" id="b3"></div><div class="pwd-bar" id="b4"></div></div>
                            <div class="pwd-text" id="pt">Masukkan kata sandi</div>
                        </div>
                    </div>

                    <div class="field">
                        <label>Konfirmasi Kata Sandi</label>
                        <div class="iw">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
                            <input type="password" id="pwd2" name="password_confirmation" placeholder="Ulangi kata sandi">
                            <button type="button" class="eye" onclick="togPwd('pwd2','e2s','e2h')">
                                <svg id="e2s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="e2h" style="display:none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="btn-row" style="margin-top:14px">
                        <button type="button" class="btn btn-next" onclick="goStep2()">
                            <span class="btxt">Lanjut — Data Diri <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;width:14px;height:14px;margin-left:3px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
                        </button>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="step-panel" id="p2">
                    <h1 class="card-title">Data Diri</h1>
                    <p class="card-sub">Lengkapi informasi dirimu sebagai siswa PKL</p>

                    <div class="field-row">
                        <div class="field" style="margin-bottom:0">
                            <label>Nama Lengkap</label>
                            <div class="iw">
                                <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                                <input type="text" name="nama_lengkap" placeholder="Nama lengkap" value="{{ old('nama_lengkap') }}">
                            </div>
                        </div>
                        <div class="field" style="margin-bottom:0">
                            <label>NIS</label>
                            <div class="iw">
                                <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></span>
                                <input type="text" name="nis" placeholder="Contoh: 2223001234" value="{{ old('nis') }}" inputmode="numeric">
                            </div>
                        </div>
                    </div>

                    <div class="field-row">
                        <div class="field" style="margin-bottom:0">
                            <label>Kelas</label>
                            <div class="iw">
                                <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg></span>
                                <select name="kelas">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="XI" {{ old('kelas')=='XI'?'selected':'' }}>XI</option>
                                    <option value="XII" {{ old('kelas')=='XII'?'selected':'' }}>XII</option>
                                </select>
                                <span class="ico-right"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></span>
                            </div>
                        </div>
                        <div class="field" style="margin-bottom:0">
                            <label>Jurusan</label>
                            <div class="iw">
                                <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></span>
                                <select name="jurusan">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="TKJ"  {{ old('jurusan')=='TKJ'?'selected':'' }}>TKJ</option>
                                    <option value="RPL"  {{ old('jurusan')=='RPL'?'selected':'' }}>RPL</option>
                                    <option value="AKL"  {{ old('jurusan')=='AKL'?'selected':'' }}>AKL</option>
                                    <option value="OTKP" {{ old('jurusan')=='OTKP'?'selected':'' }}>OTKP</option>
                                </select>
                                <span class="ico-right"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></span>
                            </div>
                        </div>
                    </div>

                    <div class="field-row" style="margin-top:10px">
                        <div class="field" style="margin-bottom:0">
                            <label>Tempat Lahir</label>
                            <div class="iw">
                                <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
                                <input type="text" name="tempat_lahir" placeholder="Kota tempat lahir" value="{{ old('tempat_lahir') }}">
                            </div>
                        </div>
                        <div class="field" style="margin-bottom:0">
                            <label>Tanggal Lahir</label>
                            <div class="iw">
                                <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" style="padding-left:34px">
                            </div>
                        </div>
                    </div>

                    <div class="field" style="margin-top:10px">
                        <label>Alamat</label>
                        <div class="iw">
                            <span class="ico" style="top:14px;transform:none"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
                            <textarea name="alamat" placeholder="Alamat lengkap tempat tinggal" style="height:80px">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <div class="btn-row">
                        <button type="button" class="btn-back" onclick="goStep1()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                            Kembali
                        </button>
                        <button type="submit" class="btn" id="sb">
                            <div class="spin"></div>
                            <span class="btxt">Daftar Sekarang <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;width:14px;height:14px;margin-left:3px"><polyline points="20 6 9 17 4 12"/></svg></span>
                        </button>
                    </div>
                </div>

            </form>

            <a href="{{ route('login') }}" class="back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali ke Login
            </a>
            <div class="card-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk sekarang</a>
            </div>
        </div>
    </div>


<script>
// Cursor glow — exact same as login
// const glow = document.getElementById('glow');
// let mx = window.innerWidth/2, my = window.innerHeight/2;
// window.addEventListener('mousemove', e => { mx=e.clientX; my=e.clientY; });
// setInterval(() => { glow.style.left=mx+'px'; glow.style.top=my+'px'; }, 50);

// Stars — exact same as login
const sf = document.getElementById('sf');
sf.style.cssText = 'position:absolute;inset:0;overflow:hidden;';
for(let i=0;i<60;i++){
    const s=document.createElement('div'); s.className='star';
    const sz=.7+Math.random()*1.6;
    s.style.cssText=`width:${sz}px;height:${sz}px;left:${Math.random()*100}%;top:${Math.random()*100}%;--d:${2+Math.random()*4}s;--dl:${-(Math.random()*4)}s`;
    sf.appendChild(s);
}

// Theme — exact same as login
function toggleTheme() {
    const html = document.documentElement;
    const isDark = html.getAttribute('data-theme') === 'dark';
    html.setAttribute('data-theme', isDark ? 'light' : 'dark');
    document.getElementById('ico-dark').style.display = isDark ? 'none' : 'block';
    document.getElementById('ico-light').style.display = isDark ? 'block' : 'none';
    localStorage.setItem('simpkl-theme', isDark ? 'light' : 'dark');
}
const saved = localStorage.getItem('simpkl-theme');
if (saved === 'light') {
    document.documentElement.setAttribute('data-theme', 'light');
    document.getElementById('ico-dark').style.display = 'none';
    document.getElementById('ico-light').style.display = 'block';
}

// Step nav

function goStep2() {
    const u = document.querySelector('[name=username]').value.trim();
    const p = document.getElementById('pwd1').value;  // jangan di-trim, password bisa ada spasi
    const c = document.getElementById('pwd2').value;

    console.log('len:', p.length); // hapus setelah fix

    if (!u) { alert('Username wajib diisi!'); return; }
    if (!/^[a-z0-9._]+$/.test(u)) { alert('Username hanya huruf kecil, angka, titik, atau underscore!'); return; }
    // if (p.length < 8) { alert('Kata sandi minimal 8 karakter!'); return; }
    if (p !== c) { alert('Konfirmasi kata sandi tidak cocok!'); return; }

    document.getElementById('p1').classList.remove('active');
    document.getElementById('p2').classList.add('active');
    document.getElementById('si1').className = 'step done';
    document.getElementById('si2').className = 'step active';
    document.getElementById('line1').classList.add('done');
    document.querySelector('.card').classList.add('card-wide');
}

function goStep1() {
    document.getElementById('p2').classList.remove('active');
    document.getElementById('p1').classList.add('active');
    document.getElementById('si1').className = 'step active';
    document.getElementById('si2').className = 'step inactive';
    document.getElementById('line1').classList.remove('done');
    document.querySelector('.card').classList.remove('card-wide');
}

// Toggle password
function togPwd(id, showId, hideId) {
    const inp = document.getElementById(id);
    const show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    document.getElementById(showId).style.display = show ? 'none' : 'block';
    document.getElementById(hideId).style.display = show ? 'block' : 'none';
}

// Password strength
function checkStr(v) {
    let s = 0;
    if (v.length >= 8) s++;
    if (/[A-Z]/.test(v)) s++;
    if (/[0-9]/.test(v)) s++;
    if (/[^A-Za-z0-9]/.test(v)) s++;
    ['b1','b2','b3','b4'].forEach((id,i) => {
        const el = document.getElementById(id);
        el.className = 'pwd-bar';
        if (i < s) el.classList.add(s===1?'weak':s<=2?'medium':'strong');
    });
    document.getElementById('pt').textContent = v.length===0?'Masukkan kata sandi':['','Lemah','Cukup','Kuat','Sangat Kuat'][s]||'Lemah';
}

// Submit
document.getElementById('regForm').addEventListener('submit', () => {
    const b = document.getElementById('sb');
    b.classList.add('ld'); b.disabled = true;
});

// If errors, go to step 2
@if($errors->hasAny(['nama_lengkap','nis','kelas','jurusan','tempat_lahir','tanggal_lahir','alamat']))
document.addEventListener('DOMContentLoaded', () => {
    goStep2();
});
@endif
</script>
</body>
</html>