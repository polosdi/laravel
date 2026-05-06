<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — SIMPKL</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap');

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --p1: #667eea;
            --p2: #764ba2;
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255,255,255,0.07);
            --glass-border: rgba(255,255,255,0.13);
            --white: #ffffff;
            --white-60: rgba(255,255,255,0.6);
            --white-40: rgba(255,255,255,0.4);
            --white-20: rgba(255,255,255,0.2);
            --white-10: rgba(255,255,255,0.1);
            --font-body: 'Plus Jakarta Sans', -apple-system, 'Segoe UI', sans-serif;
            --font-display: 'Syne', -apple-system, 'Segoe UI', sans-serif;
        }

        html, body {
            height: 100%;
            font-family: var(--font-body);
            overflow: hidden;
        }

        /* ── BACKGROUND ── */
        .bg {
            position: fixed;
            inset: 0;
            background: #0d0b1e;
        }

        .bg-mesh {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 20%, rgba(102,126,234,0.28) 0%, transparent 60%),
                radial-gradient(ellipse 60% 70% at 85% 80%, rgba(118,75,162,0.32) 0%, transparent 55%),
                radial-gradient(ellipse 50% 50% at 60% 10%, rgba(167,139,250,0.15) 0%, transparent 50%);
        }

        /* animated blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            will-change: transform;
        }

        .blob-1 {
            width: 480px; height: 480px;
            background: rgba(102,126,234,0.2);
            top: -120px; left: -80px;
            animation: blob1 18s ease-in-out infinite;
        }

        .blob-2 {
            width: 380px; height: 380px;
            background: rgba(118,75,162,0.22);
            bottom: -100px; right: -60px;
            animation: blob2 14s ease-in-out infinite;
        }

        .blob-3 {
            width: 260px; height: 260px;
            background: rgba(167,139,250,0.15);
            top: 45%; right: 18%;
            animation: blob3 20s ease-in-out infinite;
        }

        @keyframes blob1 {
            0%,100% { transform: translate(0,0) scale(1); }
            33%      { transform: translate(40px,-50px) scale(1.08); }
            66%      { transform: translate(-30px,35px) scale(0.94); }
        }
        @keyframes blob2 {
            0%,100% { transform: translate(0,0) scale(1); }
            40%      { transform: translate(-50px,40px) scale(1.1); }
            70%      { transform: translate(30px,-30px) scale(0.92); }
        }
        @keyframes blob3 {
            0%,100% { transform: translate(0,0); }
            50%      { transform: translate(30px,-40px); }
        }

        /* cursor glow */
        .cursor-glow {
            position: fixed;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(102,126,234,0.18) 0%, transparent 70%);
            pointer-events: none;
            transform: translate(-50%,-50%);
            transition: left .9s cubic-bezier(.23,1,.32,1), top .9s cubic-bezier(.23,1,.32,1);
            z-index: 1;
        }

        /* stars */
        .stars { position: absolute; inset: 0; }
        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle var(--d,3s) ease-in-out var(--dl,0s) infinite;
            opacity: 0;
        }
        @keyframes twinkle {
            0%,100% { opacity:0; transform:scale(.5); }
            50%      { opacity:.7; transform:scale(1.3); }
        }

        /* ── LAYOUT ── */
        .page {
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: 1fr 480px;
            min-height: 100vh;
            align-items: center;
        }

        /* ── LEFT SIDE ── */
        .left {
            padding: 60px 48px 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 52px;
        }

        .brand-icon {
            width: 48px; height: 48px;
            background: var(--grad);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 8px 28px rgba(102,126,234,0.45);
            flex-shrink: 0;
        }

        .brand-name {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--white);
            letter-spacing: -.02em;
        }

        .brand-sub {
            font-size: .7rem;
            color: var(--white-40);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .left-tagline {
            font-family: var(--font-display);
            font-size: clamp(2rem, 3.2vw, 3rem);
            font-weight: 800;
            color: var(--white);
            line-height: 1.12;
            margin-bottom: 20px;
        }

        .left-tagline .accent {
            background: var(--grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .left-desc {
            font-size: .95rem;
            color: var(--white-60);
            line-height: 1.75;
            max-width: 400px;
            margin-bottom: 44px;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .feat {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .feat-icon {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: var(--white-10);
            border: 1px solid var(--white-10);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
            backdrop-filter: blur(10px);
        }

        .feat-text {
            font-size: .875rem;
            color: var(--white-60);
            font-weight: 500;
            line-height: 1.4;
        }

        /* ── RIGHT / CARD ── */
        .right {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 40px;
        }

        .card {
            width: 100%;
            max-width: 400px;
            background: rgba(255,255,255,0.065);
            backdrop-filter: blur(28px) saturate(1.4);
            -webkit-backdrop-filter: blur(28px) saturate(1.4);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 28px;
            padding: 44px 40px;
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.04) inset,
                0 32px 80px rgba(0,0,0,0.5),
                0 8px 32px rgba(102,126,234,0.12);
            animation: cardIn .7s cubic-bezier(.34,1.4,.64,1) both;
        }

        @keyframes cardIn {
            from { opacity:0; transform: scale(.93) translateY(24px); }
            to   { opacity:1; transform: scale(1)   translateY(0); }
        }

        .card-title {
            font-family: var(--font-display);
            font-size: 1.9rem;
            font-weight: 800;
            color: var(--white);
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .card-sub {
            font-size: .84rem;
            color: var(--white-40);
            margin-bottom: 30px;
            font-weight: 400;
        }

        /* alerts */
        .alert {
            padding: 11px 15px;
            border-radius: 12px;
            font-size: .8rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alert-err { background: rgba(239,68,68,.13); border:1px solid rgba(239,68,68,.28); color:#fca5a5; }
        .alert-ok  { background: rgba(34,197,94,.13);  border:1px solid rgba(34,197,94,.28);  color:#86efac; }

        /* role pills */
        .role-label {
            font-size: .75rem;
            font-weight: 700;
            color: var(--white-40);
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .roles {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 26px;
        }

        .role-pill {
            padding: 9px 10px;
            background: var(--white-10);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            color: var(--white-40);
            font-family: var(--font-body);
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
        }

        .role-pill:hover {
            background: rgba(102,126,234,.18);
            border-color: rgba(102,126,234,.4);
            color: var(--white);
        }

        .role-pill.active {
            background: rgba(102,126,234,.22);
            border-color: rgba(102,126,234,.55);
            color: var(--white);
            box-shadow: 0 0 16px rgba(102,126,234,.2);
        }

        /* form fields */
        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            font-size: .76rem;
            font-weight: 700;
            color: var(--white-60);
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .input-wrap { position: relative; }

        .input-wrap .ico {
            position: absolute;
            left: 15px; top: 50%;
            transform: translateY(-50%);
            font-size: .95rem;
            pointer-events: none;
            opacity: .45;
            transition: opacity .2s;
        }

        .input-wrap:focus-within .ico { opacity: .9; }

        .input-wrap input {
            width: 100%;
            padding: 13px 44px 13px 42px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.11);
            border-radius: 12px;
            color: var(--white);
            font-family: var(--font-body);
            font-size: .88rem;
            font-weight: 500;
            outline: none;
            transition: all .22s;
        }

        .input-wrap input::placeholder { color: rgba(255,255,255,.22); }

        .input-wrap input:focus {
            background: rgba(255,255,255,.10);
            border-color: rgba(102,126,234,.65);
            box-shadow: 0 0 0 3px rgba(102,126,234,.18);
        }

        .eye-btn {
            position: absolute;
            right: 13px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer;
            color: rgba(255,255,255,.35);
            display: flex; align-items: center;
            padding: 4px;
            transition: color .2s;
        }
        .eye-btn:hover { color: rgba(255,255,255,.8); }

        /* options row */
        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
        }

        .check-label {
            display: flex;
            align-items: center;
            gap: 9px;
            cursor: pointer;
            font-size: .8rem;
            color: var(--white-60);
            font-weight: 500;
            user-select: none;
        }

        .chk {
            width: 17px; height: 17px;
            border: 1.5px solid rgba(255,255,255,.22);
            border-radius: 5px;
            background: rgba(255,255,255,.05);
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            position: relative;
            transition: all .2s;
            flex-shrink: 0;
        }

        .chk:checked {
            background: var(--grad);
            border-color: transparent;
        }

        .chk:checked::after {
            content: '';
            position: absolute;
            left: 5px; top: 2px;
            width: 5px; height: 9px;
            border: 2px solid white;
            border-top: none; border-left: none;
            transform: rotate(45deg);
        }

        .link-forgot {
            font-size: .8rem;
            color: rgba(102,126,234,.9);
            text-decoration: none;
            font-weight: 600;
            transition: color .2s;
        }
        .link-forgot:hover { color: #a78bfa; }

        /* submit */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--grad);
            color: white;
            border: none;
            border-radius: 13px;
            font-family: var(--font-body);
            font-size: .92rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .28s;
            box-shadow: 0 8px 28px rgba(102,126,234,.42);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            letter-spacing: .01em;
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.14), transparent 60%);
            opacity: 0;
            transition: opacity .28s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 38px rgba(102,126,234,.55);
        }

        .btn-login:hover::after { opacity: 1; }
        .btn-login:active { transform: translateY(0); }

        .spinner {
            display: none;
            width: 20px; height: 20px;
            border: 2.5px solid rgba(255,255,255,.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin .65s linear infinite;
            position: absolute;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .btn-login.loading .btn-txt { opacity:0; }
        .btn-login.loading .spinner { display:block; }

        /* back */
        .back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 24px;
            font-size: .8rem;
            color: var(--white-40);
            text-decoration: none;
            transition: color .2s;
            font-weight: 500;
        }
        .back:hover { color: var(--white-60); }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .page { grid-template-columns: 1fr; }
            .left { display: none; }
            .right {
                padding: 24px;
                background: linear-gradient(135deg, #0f0c29, #1a1240);
            }
        }
    </style>
</head>
<body>

<!-- BG -->
<div class="bg">
    <div class="bg-mesh"></div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="stars" id="stars"></div>
    <div class="cursor-glow" id="glow"></div>
</div>

<div class="page">

    <!-- LEFT -->
    <div class="left">
        <div class="brand">
            <div class="brand-icon">🎓</div>
            <div>
                <div class="brand-name">SIMPKL</div>
                <div class="brand-sub">Sistem Informasi PKL</div>
            </div>
        </div>

        <h1 class="left-tagline">
            Satu Platform,<br>
            <span class="accent">Semua PKL</span><br>
            Terpantau.
        </h1>

        <p class="left-desc">
            SIMPKL membantu siswa, guru, dan sekolah mengelola seluruh proses PKL secara digital — efisien, transparan, dan mudah diakses kapan saja.
        </p>

        <div class="features">
            <div class="feat">
                <div class="feat-icon">📔</div>
                <span class="feat-text">E-Jurnal harian otomatis jadi data absen</span>
            </div>
            <div class="feat">
                <div class="feat-icon">📊</div>
                <span class="feat-text">Monitoring real-time untuk guru pembimbing</span>
            </div>
            <div class="feat">
                <div class="feat-icon">🏭</div>
                <span class="feat-text">Manajemen mitra industri & MOU digital</span>
            </div>
            <div class="feat">
                <div class="feat-icon">📄</div>
                <span class="feat-text">Laporan & rekap otomatis siap unduh</span>
            </div>
        </div>
    </div>

    <!-- RIGHT / CARD -->
    <div class="right">
        <div class="card">

            <h1 class="card-title">Selamat<br>Datang 👋</h1>
            <p class="card-sub">Masuk untuk melanjutkan ke dashboard kamu</p>

            @if ($errors->any())
            <div class="alert alert-err">⚠️ {{ $errors->first() }}</div>
            @endif

            @if (session('status'))
            <div class="alert alert-ok">✅ {{ session('status') }}</div>
            @endif

            <!-- Role -->
            <div class="role-label">Masuk sebagai</div>
            <div class="roles">
                <button class="role-pill active" type="button" onclick="pickRole(this,'siswa')">👨‍🎓 Siswa</button>
                <button class="role-pill" type="button" onclick="pickRole(this,'guru')">👩‍🏫 Guru</button>
                <button class="role-pill" type="button" onclick="pickRole(this,'hubin')">🏢 Hubin</button>
                <button class="role-pill" type="button" onclick="pickRole(this,'admin')">⚙️ Admin</button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" id="form">
                @csrf
                <input type="hidden" name="role_hint" id="roleVal" value="siswa">

                <div class="field">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <span class="ico">✉️</span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="contoh@smk.sch.id"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                        >
                    </div>
                </div>

                <div class="field">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrap">
                        <span class="ico">🔒</span>
                        <input
                            type="password"
                            id="pwd"
                            name="password"
                            placeholder="Masukkan kata sandi"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" class="eye-btn" onclick="togglePwd()" title="Tampilkan/sembunyikan">
                            <svg id="eyeIco" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="options">
                    <label class="check-label">
                        <input type="checkbox" class="chk" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-forgot">Lupa sandi?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <div class="spinner"></div>
                    <span class="btn-txt">Masuk ke Dashboard →</span>
                </button>
            </form>

            <a href="{{ url('/') }}" class="back">← Kembali ke Beranda</a>
        </div>
    </div>

</div>

<script>
// Cursor glow
const glow = document.getElementById('glow');
window.addEventListener('mousemove', e => {
    glow.style.left = e.clientX + 'px';
    glow.style.top  = e.clientY + 'px';
});

// Stars
const sc = document.getElementById('stars');
for (let i = 0; i < 90; i++) {
    const s = document.createElement('div');
    s.className = 'star';
    const sz = .8 + Math.random() * 1.8;
    s.style.cssText = `
        left:${Math.random()*100}%;
        top:${Math.random()*100}%;
        width:${sz}px; height:${sz}px;
        --d:${2+Math.random()*5}s;
        --dl:${-Math.random()*5}s;
    `;
    sc.appendChild(s);
}

// Role picker
function pickRole(btn, role) {
    document.querySelectorAll('.role-pill').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('roleVal').value = role;
}

// Toggle password
function togglePwd() {
    const inp = document.getElementById('pwd');
    const ico = document.getElementById('eyeIco');
    const show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    ico.innerHTML = show
        ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
}

// Loading state on submit
document.getElementById('form').addEventListener('submit', () => {
    const btn = document.getElementById('loginBtn');
    btn.classList.add('loading');
    btn.disabled = true;
});
</script>
</body>
</html>