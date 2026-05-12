<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi — SIMPKL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --font: 'Poppins', 'Segoe UI', system-ui, sans-serif; }

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
            --feat-bg: rgba(255,255,255,.07);
            --feat-border: rgba(255,255,255,.09);
            --toggle-bg: rgba(255,255,255,.1);
            --toggle-border: rgba(255,255,255,.15);
            --nav-bg: rgba(13,11,30,0.85);
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
            --input-bg: #ffffff;
            --input-border: rgba(102,126,234,.2);
            --input-focus-border: rgba(102,126,234,.6);
            --input-focus-shadow: rgba(102,126,234,.12);
            --label: #6b7280;
            --back: #9ca3af;
            --ico: #9ca3af;
            --feat-bg: rgba(102,126,234,.06);
            --feat-border: rgba(102,126,234,.12);
            --toggle-bg: rgba(102,126,234,.1);
            --toggle-border: rgba(102,126,234,.2);
            --nav-bg: rgba(248,249,250,0.85);
        }

        html { min-height: 100%; }
        body { min-height: 100vh; font-family: var(--font); background: var(--bg); color: var(--text); transition: background .4s, color .4s; overflow-x: hidden; }

        /* BG */
        .bg-dark {
            position: fixed; inset: 0; z-index: 0; pointer-events: none; overflow: hidden;
            transition: opacity .4s;
        }
        [data-theme="light"] .bg-dark { opacity: 0; }
        [data-theme="dark"]  .bg-dark { opacity: 1; }
        .bg-dark::before {
            content: ''; position: absolute; inset: 0;
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

        #glow { position:fixed;width:450px;height:450px;border-radius:50%;background:radial-gradient(circle,rgba(102,126,234,.12) 0%,transparent 70%);pointer-events:none;transform:translate(-50%,-50%);z-index:1;top:50%;left:50%;transition:opacity .4s; }
        [data-theme="light"] #glow { opacity: 0; }

        /* TOPBAR */
        .topbar {
            position: fixed; top:0; left:0; right:0; z-index: 200;
            padding: 16px 32px;
            display: flex; align-items: center; justify-content: space-between;
            background: var(--nav-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--card-border);
            transition: background .4s, border-color .4s;
        }

        .topbar-brand { display:flex;align-items:center;gap:12px;text-decoration:none; }
        .topbar-brand-ico {
            width: 36px; height: 36px; background: var(--grad);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(102,126,234,.4);
        }
        .topbar-brand-ico svg { width: 18px; height: 18px; color: white; }
        .topbar-brand-name { font-size: 1.15rem; font-weight: 800; color: var(--text); letter-spacing: -.01em; transition: color .4s; }

        .theme-toggle {
            width: 48px; height: 26px; background: var(--toggle-bg);
            border: 1px solid var(--toggle-border); border-radius: 50px;
            cursor: pointer; display: flex; align-items: center; padding: 3px; transition: all .3s;
        }
        .toggle-thumb {
            width: 18px; height: 18px; border-radius: 50%; background: var(--grad);
            transition: transform .3s cubic-bezier(.34,1.4,.64,1);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(102,126,234,.4);
        }
        [data-theme="dark"]  .toggle-thumb { transform: translateX(22px); }
        [data-theme="light"] .toggle-thumb { transform: translateX(0); }
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

        .left-icon {
            width: 64px; height: 64px; border-radius: 18px;
            background: linear-gradient(135deg, rgba(102,126,234,.15), rgba(118,75,162,.1));
            border: 1px solid rgba(102,126,234,.2);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 28px;
        }
        .left-icon svg { width: 30px; height: 30px; color: #667eea; }

        .tagline { font-size: clamp(1.8rem,2.8vw,2.8rem); font-weight: 800; color: var(--text); line-height: 1.15; margin-bottom: 18px; letter-spacing: -.02em; transition: color .4s; }
        .tagline .acc { background: var(--grad); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        .ldesc { font-size: .9rem; color: var(--text-muted); line-height: 1.75; max-width: 360px; margin-bottom: 36px; transition: color .4s; }

        .steps-info { display: flex; flex-direction: column; gap: 18px; }

        .step-info {
            display: flex; align-items: flex-start; gap: 16px;
        }

        .step-num {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--grad); color: white;
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; font-weight: 700;
            flex-shrink: 0; box-shadow: 0 4px 12px rgba(102,126,234,.3);
        }

        .step-info-content {}
        .step-info-title { font-size: .875rem; font-weight: 700; color: var(--text); margin-bottom: 2px; transition: color .4s; }
        .step-info-desc { font-size: .78rem; color: var(--text-muted); line-height: 1.5; transition: color .4s; }

        /* RIGHT */
        .right {
            display: flex; align-items: center; justify-content: center;
            padding: 32px; min-height: calc(100vh - 60px);
        }

        /* CARD */
        .card {
            width: 100%; max-width: 380px;
            background: var(--card-bg);
            backdrop-filter: blur(28px) saturate(1.4);
            -webkit-backdrop-filter: blur(28px) saturate(1.4);
            border: 1px solid var(--card-border);
            border-radius: 20px; padding: 28px 26px;
            box-shadow: var(--card-shadow);
            animation: cardIn .7s cubic-bezier(.34,1.3,.64,1) both;
            transition: background .4s, border-color .4s, box-shadow .4s;
        }

        @keyframes cardIn { from{opacity:0;transform:scale(.93) translateY(22px)} to{opacity:1;transform:scale(1) translateY(0)} }

        /* CARD ICON */
        .card-icon {
            width: 48px; height: 48px; border-radius: 14px;
            background: linear-gradient(135deg, rgba(102,126,234,.15), rgba(118,75,162,.1));
            border: 1px solid rgba(102,126,234,.2);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }
        .card-icon svg { width: 22px; height: 22px; color: #667eea; }

        .card-title { font-size: 1.4rem; font-weight: 800; color: var(--text); line-height: 1.15; margin-bottom: 4px; letter-spacing: -.02em; transition: color .4s; }
        .card-sub { font-size: .8rem; color: var(--text-sub); margin-bottom: 22px; line-height: 1.6; transition: color .4s; }

        /* ALERTS */
        .alert { padding: 11px 14px; border-radius: 11px; font-size: .79rem; font-weight: 600; margin-bottom: 16px; display:flex;align-items:flex-start;gap:9px; }
        .a-err { background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444; }
        .a-ok  { background:rgba(34,197,94,.12); border:1px solid rgba(34,197,94,.25); color:#22c55e; }
        .alert svg { width:16px;height:16px;flex-shrink:0;margin-top:1px; }

        /* SUCCESS STATE */
        .success-state {
            display: none;
            text-align: center;
            padding: 8px 0;
        }

        .success-state.show { display: block; }

        .success-icon {
            width: 64px; height: 64px; border-radius: 50%;
            background: linear-gradient(135deg, rgba(34,197,94,.15), rgba(22,163,74,.1));
            border: 1px solid rgba(34,197,94,.25);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .success-icon svg { width: 28px; height: 28px; color: #22c55e; }

        .success-title { font-size: 1.2rem; font-weight: 800; color: var(--text); margin-bottom: 8px; transition: color .4s; }
        .success-desc { font-size: .82rem; color: var(--text-muted); line-height: 1.65; margin-bottom: 22px; transition: color .4s; }
        .success-email { font-weight: 700; color: #667eea; }

        /* FORM */
        .form-state {}

        .field { margin-bottom: 14px; }
        .field label {
            display: block; font-size: .7rem; font-weight: 700;
            color: var(--label); letter-spacing: .06em; text-transform: uppercase;
            margin-bottom: 7px; transition: color .4s;
        }

        .iw { position: relative; }
        .iw .ico {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            pointer-events: none; color: var(--ico);
            display: flex; align-items: center; transition: color .2s;
        }
        .iw .ico svg { width: 15px; height: 15px; }
        .iw:focus-within .ico { color: #667eea; }

        .iw input {
            width: 100%; padding: 11px 36px 11px 36px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 11px; color: var(--text);
            font-family: var(--font); font-size: .855rem; font-weight: 500;
            outline: none; transition: all .22s;
        }
        [data-theme="light"] .iw input { background: white; }
        .iw input::placeholder { color: var(--ico); }
        .iw input:focus {
            border-color: var(--input-focus-border);
            box-shadow: 0 0 0 3px var(--input-focus-shadow);
        }

        .hint { font-size: .68rem; color: var(--text-sub); margin-top: 5px; line-height: 1.5; transition: color .4s; }

        /* SUBMIT BTN */
        .btn {
            width: 100%; padding: 12px;
            background: var(--grad); color: white; border: none;
            border-radius: 12px; font-family: var(--font);
            font-size: .88rem; font-weight: 700;
            cursor: pointer; transition: all .28s;
            box-shadow: 0 6px 22px rgba(102,126,234,.4);
            display: flex; align-items: center; justify-content: center;
            gap: 8px; position: relative; overflow: hidden; margin-top: 4px;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(102,126,234,.5); }
        .btn:active { transform: translateY(0); }
        .btn svg { width: 16px; height: 16px; }

        .spin { display:none;width:18px;height:18px;border:2px solid rgba(255,255,255,.3);border-top-color:white;border-radius:50%;animation:spin .65s linear infinite;position:absolute; }
        @keyframes spin { to{transform:rotate(360deg)} }
        .btn.ld .btxt { opacity:0; }
        .btn.ld .spin { display:block; }

        /* BACK BTN */
        .btn-outline {
            width: 100%; padding: 11px;
            background: transparent;
            border: 1px solid var(--card-border);
            border-radius: 12px; font-family: var(--font);
            font-size: .85rem; font-weight: 600;
            color: var(--text-muted);
            cursor: pointer; transition: all .22s;
            display: flex; align-items: center; justify-content: center;
            gap: 8px; text-decoration: none; margin-top: 8px;
        }
        .btn-outline:hover { border-color: #667eea; color: #667eea; }
        .btn-outline svg { width: 15px; height: 15px; }

        /* FOOTER */
        .card-footer {
            display: flex; align-items: center; justify-content: center;
            gap: 5px; margin-top: 16px;
            font-size: .74rem; color: var(--text-muted); font-weight: 500;
        }
        .card-footer a { color: #667eea; text-decoration: none; font-weight: 600; transition: color .2s; }
        .card-footer a:hover { color: #764ba2; }

        /* RESPONSIVE */
        @media (max-width: 960px) {
            .page { grid-template-columns: 1fr; }
            .left { display: none; }
            .right { padding: 20px; min-height: calc(100vh - 60px); }
            .topbar { padding: 14px 20px; }
        }
    </style>
</head>
<body>

<div class="bg-dark">
    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>
</div>
<div id="glow"></div>

<!-- TOPBAR -->
<div class="topbar">
    <a href="{{ url('/') }}" class="topbar-brand">
        <div class="topbar-brand-ico">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
        </div>
        <span class="topbar-brand-name">SIMPKL</span>
    </a>
    <button class="theme-toggle" onclick="toggleTheme()" title="Ganti tema">
        <div class="toggle-thumb">
            <svg id="ico-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
            </svg>
            <svg id="ico-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
            </svg>
        </div>
    </button>
</div>

<div class="page">

    <!-- LEFT -->
    <div class="left">
        <div class="left-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
        </div>

        <h1 class="tagline">
            Lupa Kata Sandi?<br>
            <span class="acc">Tenang,</span><br>
            Kami Bantu.
        </h1>

        <p class="ldesc">Ikuti langkah berikut untuk mereset kata sandi akun SIMPKL kamu dengan mudah dan aman.</p>

        <div class="steps-info">
            <div class="step-info">
                <div class="step-num">1</div>
                <div class="step-info-content">
                    <div class="step-info-title">Masukkan Username</div>
                    <div class="step-info-desc">Masukkan username akun SIMPKL kamu yang terdaftar.</div>
                </div>
            </div>
            <div class="step-info">
                <div class="step-num">2</div>
                <div class="step-info-content">
                    <div class="step-info-title">Hubungi Admin</div>
                    <div class="step-info-desc">Admin sekolah akan memverifikasi identitasmu dan mereset password.</div>
                </div>
            </div>
            <div class="step-info">
                <div class="step-num">3</div>
                <div class="step-info-content">
                    <div class="step-info-title">Password Baru</div>
                    <div class="step-info-desc">Kamu akan mendapat password sementara dan bisa mengubahnya setelah login.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="card">

            <div class="card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>

            <!-- SUCCESS STATE -->
            <div class="success-state" id="successState">
                <div class="success-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <div class="success-title">Permintaan Terkirim!</div>
                <div class="success-desc">
                    Permintaan reset untuk username <span class="success-email" id="sentUsername"></span> sudah dicatat. Hubungi admin sekolah untuk proses selanjutnya.
                </div>
                <a href="{{ route('login') }}" class="btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Kembali ke Login
                </a>
            </div>

            <!-- FORM STATE -->
            <div class="form-state" id="formState">
                <h1 class="card-title">Reset Kata Sandi</h1>
                <p class="card-sub">Masukkan username kamu dan kami akan membantu proses reset kata sandi.</p>

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

                <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
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
                        <div class="hint">Username yang kamu gunakan saat mendaftar di SIMPKL.</div>
                    </div>

                    <button type="submit" class="btn" id="sb">
                        <div class="spin"></div>
                        <span class="btxt">
                            Kirim Permintaan Reset
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;margin-left:4px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </span>
                    </button>
                </form>

                <a href="{{ route('login') }}" class="btn-outline">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Kembali ke Login
                </a>
            </div>

            <div class="card-footer">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar sekarang</a>
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
    const isDark = html.getAttribute('data-theme') === 'dark';
    html.setAttribute('data-theme', isDark ? 'light' : 'dark');
    document.getElementById('ico-sun').style.display  = isDark ? 'block' : 'none';
    document.getElementById('ico-moon').style.display = isDark ? 'none'  : 'block';
    localStorage.setItem('simpkl-theme', isDark ? 'light' : 'dark');
}
const saved = localStorage.getItem('simpkl-theme');
if (saved === 'light') {
    document.documentElement.setAttribute('data-theme', 'light');
    document.getElementById('ico-sun').style.display  = 'block';
    document.getElementById('ico-moon').style.display = 'none';
}

// Submit with success state
document.getElementById('forgotForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value.trim();
    if (!username) return;

    const btn = document.getElementById('sb');
    btn.classList.add('ld');
    btn.disabled = true;

    // Simulate sending (replace with actual form submit if needed)
    setTimeout(() => {
        document.getElementById('sentUsername').textContent = username;
        document.getElementById('formState').style.display = 'none';
        document.getElementById('successState').classList.add('show');
    }, 1200);

    // Uncomment below to actually submit to Laravel:
    // this.submit();
});
</script>
</body>
</html>