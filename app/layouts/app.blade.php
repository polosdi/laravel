<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIMPKL') — SIMPKL</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary:     #667eea;
            --primary-end: #764ba2;
            --gradient:    linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --bg:          #F8F9FA;
            --surface:     #ffffff;
            --text:        #1a1a2e;
            --text-muted:  #6b7280;
            --text-light:  #9ca3af;
            --border:      rgba(102,126,234,0.15);
            --shadow:      0 20px 60px rgba(102,126,234,0.15);
            --shadow-sm:   0 4px 16px rgba(102,126,234,0.10);
            --sidebar-w:   260px;
            --topbar-h:    64px;
            --fs-xs:   0.75rem;
            --fs-sm:   0.8125rem;
            --fs-base: 0.9375rem;
            --fs-lg:   1.125rem;
            --fs-xl:   1.25rem;
            --r-sm:  8px;  --r-md: 12px; --r-lg: 16px;
            --r-xl:  20px; --r-2xl:24px; --r-full:9999px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            font-size: var(--fs-base);
            line-height: 1.65;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 0;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-w); height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            display: flex; flex-direction: column;
            z-index: 200; transition: transform .3s ease;
        }
        .sidebar-logo {
            display: flex; align-items: center; gap: 10px;
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
        }
        .sidebar-logo-icon {
            width: 38px; height: 38px;
            background: var(--gradient);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px; flex-shrink: 0;
        }
        .sidebar-logo-text {
            font-family: 'Syne', sans-serif; font-size: 1.2rem; font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sidebar-user {
            padding: 16px 20px; display: flex; align-items: center; gap: 10px;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-avatar {
            width: 40px; height: 40px; background: var(--gradient);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif; font-weight: 800; font-size: .85rem;
            color: white; flex-shrink: 0;
        }
        .sidebar-avatar img {
            width: 100%; height: 100%; border-radius: 50%; object-fit: cover;
        }
        .user-name  { font-weight: 600; font-size: var(--fs-sm); color: var(--text); line-height: 1.2; }
        .user-role  { font-size: var(--fs-xs); color: var(--primary); font-weight: 500; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 12px; }
        .nav-group-label {
            font-size: 10px; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; color: var(--text-light);
            padding: 8px 8px 4px; margin-top: 4px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: var(--r-md);
            text-decoration: none; color: var(--text-muted);
            font-weight: 500; font-size: var(--fs-sm);
            transition: all .2s; margin-bottom: 2px;
        }
        .nav-item:hover  { background: rgba(102,126,234,.07); color: var(--primary); }
        .nav-item.active { background: linear-gradient(135deg,rgba(102,126,234,.14),rgba(118,75,162,.10)); color: var(--primary); font-weight: 600; }
        .nav-icon { width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
        .nav-badge {
            margin-left: auto; background: var(--gradient); color: white;
            font-size: 10px; font-weight: 700; padding: 2px 7px;
            border-radius: var(--r-full); line-height: 1.4;
        }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid var(--border); }
        .btn-logout {
            display: flex; align-items: center; gap: 8px; padding: 9px 14px;
            border-radius: var(--r-md); width: 100%;
            background: transparent; border: 1.5px solid rgba(239,68,68,.25);
            color: #ef4444; font-family: 'DM Sans',sans-serif;
            font-size: var(--fs-sm); font-weight: 600;
            cursor: pointer; transition: all .2s;
        }
        .btn-logout:hover { background: rgba(239,68,68,.07); border-color: #ef4444; }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed; top: 0; left: var(--sidebar-w); right: 0;
            height: var(--topbar-h);
            background: rgba(248,249,250,.9); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; z-index: 100;
        }
        .page-title { font-family: 'Syne',sans-serif; font-size: var(--fs-xl); font-weight: 800; color: var(--text); }
        .page-sub   { font-size: var(--fs-xs); color: var(--text-muted); margin-top: -2px; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-date {
            font-size: var(--fs-xs); color: var(--text-muted);
            background: rgba(102,126,234,.06); border: 1px solid var(--border);
            padding: 5px 12px; border-radius: var(--r-full);
        }
        .topbar-notif {
            width: 36px; height: 36px; background: var(--surface);
            border: 1.5px solid var(--border); border-radius: var(--r-md);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; cursor: pointer; position: relative; transition: all .2s;
        }
        .topbar-notif:hover { border-color: var(--primary); }
        .notif-dot {
            position: absolute; top: 5px; right: 5px;
            width: 7px; height: 7px; background: #ef4444;
            border-radius: 50%; border: 1.5px solid white;
        }
        .mobile-toggle { display: none; background: none; border: none; font-size: 22px; cursor: pointer; color: var(--text); }

        /* ── MAIN ── */
        .main { margin-left: var(--sidebar-w); margin-top: var(--topbar-h); padding: 28px; position: relative; z-index: 1; min-height: calc(100vh - var(--topbar-h)); }

        /* ── ALERT ── */
        .alert { padding: 12px 16px; border-radius: var(--r-md); margin-bottom: 20px; font-size: var(--fs-sm); font-weight: 500; display: flex; align-items: center; gap: 8px; }
        .alert-success { background: rgba(34,197,94,.1); color: #15803d; border: 1px solid rgba(34,197,94,.2); }
        .alert-error   { background: rgba(239,68,68,.1); color: #dc2626; border: 1px solid rgba(239,68,68,.2); }
        .alert-info    { background: rgba(102,126,234,.1); color: var(--primary); border: 1px solid var(--border); }

        /* ── CARDS ── */
        .card { background: var(--surface); border-radius: var(--r-xl); border: 1px solid var(--border); box-shadow: var(--shadow-sm); overflow: hidden; }
        .card-header { padding: 18px 20px 14px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .card-title  { font-family: 'Syne',sans-serif; font-size: var(--fs-lg); font-weight: 700; color: var(--text); }
        .card-body   { padding: 20px; }
        .card-link   { font-size: var(--fs-xs); font-weight: 600; color: var(--primary); text-decoration: none; transition: opacity .2s; }
        .card-link:hover { opacity: .7; }

        /* ── BADGE ── */
        .badge { display: inline-flex; align-items: center; gap: 4px; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: var(--r-full); }
        .badge-pending   { background: rgba(245,158,11,.1); color: #d97706; }
        .badge-valid,
        .badge-disetujui,
        .badge-hadir     { background: rgba(34,197,94,.1); color: #16a34a; }
        .badge-tolak,
        .badge-ditolak,
        .badge-alpa      { background: rgba(239,68,68,.1); color: #dc2626; }
        .badge-izin      { background: rgba(245,158,11,.1); color: #d97706; }
        .badge-sakit     { background: rgba(59,130,246,.1); color: #2563eb; }
        .badge-revisi    { background: rgba(249,115,22,.1); color: #ea580c; }
        .badge-aktif     { background: rgba(34,197,94,.1); color: #16a34a; }
        .badge-nonaktif  { background: rgba(156,163,175,.1); color: #6b7280; }

        /* ── BUTTONS ── */
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; background: var(--gradient); color: white;
            border: none; border-radius: var(--r-full);
            font-family: 'DM Sans',sans-serif; font-size: var(--fs-sm);
            font-weight: 600; cursor: pointer; text-decoration: none;
            box-shadow: 0 4px 14px rgba(102,126,234,.35);
            transition: all .25s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(102,126,234,.45); }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 18px;
            background: rgba(102,126,234,.08); border: 1.5px solid var(--border);
            border-radius: var(--r-full); color: var(--primary);
            font-family: 'DM Sans',sans-serif; font-size: var(--fs-sm);
            font-weight: 600; cursor: pointer; text-decoration: none;
            transition: all .2s;
        }
        .btn-secondary:hover { background: rgba(102,126,234,.14); }
        .btn-danger {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 18px;
            background: rgba(239,68,68,.08); border: 1.5px solid rgba(239,68,68,.25);
            border-radius: var(--r-full); color: #ef4444;
            font-family: 'DM Sans',sans-serif; font-size: var(--fs-sm);
            font-weight: 600; cursor: pointer; text-decoration: none;
            transition: all .2s;
        }
        .btn-danger:hover { background: rgba(239,68,68,.14); }

        /* ── FORM ── */
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: var(--fs-sm); font-weight: 600; color: var(--text); margin-bottom: 6px; }
        .form-label span { color: #ef4444; }
        .form-control {
            width: 100%; padding: 10px 14px;
            border: 1.5px solid var(--border); border-radius: var(--r-md);
            font-family: 'DM Sans',sans-serif; font-size: var(--fs-sm);
            color: var(--text); background: var(--surface);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(102,126,234,.12); }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { font-size: var(--fs-xs); color: #ef4444; margin-top: 4px; }
        .form-hint { font-size: var(--fs-xs); color: var(--text-muted); margin-top: 4px; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        select.form-control { cursor: pointer; }

        /* ── TABLE ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: var(--fs-sm); }
        thead th { font-size: var(--fs-xs); font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--text-muted); padding: 10px 14px; text-align: left; border-bottom: 1.5px solid var(--border); white-space: nowrap; }
        tbody td { padding: 12px 14px; border-bottom: 1px solid var(--border); color: var(--text); vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: rgba(102,126,234,.025); }

        /* ── PAGINATION ── */
        .pagination-wrap { display: flex; justify-content: center; padding: 16px 0; }
        .pagination { display: flex; gap: 4px; list-style: none; }
        .page-item .page-link {
            display: flex; align-items: center; justify-content: center;
            width: 34px; height: 34px; border-radius: var(--r-md);
            text-decoration: none; font-size: var(--fs-xs); font-weight: 600;
            color: var(--text-muted); border: 1px solid var(--border);
            transition: all .2s;
        }
        .page-item.active .page-link { background: var(--gradient); color: white; border: none; }
        .page-item .page-link:hover { border-color: var(--primary); color: var(--primary); }

        /* ── OVERLAY MOBILE ── */
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.35); z-index: 150; }
        .overlay.show { display: block; }

        /* ── ANIMATE ── */
        @keyframes fadeSlideUp { from { opacity:0; transform:translateY(14px); } to { opacity:1; transform:translateY(0); } }
        .main > * { animation: fadeSlideUp .45s ease both; }
        .main > *:nth-child(1){animation-delay:.00s}
        .main > *:nth-child(2){animation-delay:.06s}
        .main > *:nth-child(3){animation-delay:.12s}
        .main > *:nth-child(4){animation-delay:.18s}
        .main > *:nth-child(5){animation-delay:.24s}

        /* ── RESPONSIVE ── */
        @media (max-width:768px) {
            :root { --sidebar-w: 0px; }
            .sidebar { transform: translateX(-260px); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0 !important; }
            .topbar { left: 0 !important; }
            .mobile-toggle { display: block; }
        }

        @yield('styles')
    </style>

    @stack('head')
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

{{-- ═══ SIDEBAR ═══ --}}
<aside class="sidebar" id="sidebar">
    <a class="sidebar-logo" href="{{ route('home') }}">
        <div class="sidebar-logo-icon">🎓</div>
        <span class="sidebar-logo-text">SIMPKL</span>
    </a>

    <div class="sidebar-user">
        <div class="sidebar-avatar">
            @php $profil = Auth::user()->profilSiswa; @endphp
            @if($profil?->foto_profil)
                <img src="{{ asset('storage/'.$profil->foto_profil) }}" alt="foto">
            @else
                {{ Auth::user()->inisial() }}
            @endif
        </div>
        <div>
            <div class="user-name">{{ Auth::user()->namaLengkap() }}</div>
            <div class="user-role">Siswa PKL</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-group-label">Menu Utama</div>

        <a href="{{ route('siswa.dashboard') }}" class="nav-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">🏠</span> Dashboard
        </a>
        <a href="{{ route('siswa.profil') }}" class="nav-item {{ request()->routeIs('siswa.profil*') ? 'active' : '' }}">
            <span class="nav-icon">👤</span> Profil Saya
        </a>

        <div class="nav-group-label">PKL</div>

        <a href="{{ route('siswa.pkl.pengajuan') }}" class="nav-item {{ request()->routeIs('siswa.pkl*') ? 'active' : '' }}">
            <span class="nav-icon">📋</span> Pengajuan PKL
        </a>
        <a href="{{ route('siswa.jurnal') }}" class="nav-item {{ request()->routeIs('siswa.jurnal*') ? 'active' : '' }}">
            <span class="nav-icon">📓</span> Jurnal Harian
            @php $jp = \App\Models\JurnalHarian::olehSiswa(Auth::id())->pending()->count(); @endphp
            @if($jp > 0)<span class="nav-badge">{{ $jp }}</span>@endif
        </a>
        <a href="{{ route('siswa.absensi') }}" class="nav-item {{ request()->routeIs('siswa.absensi*') ? 'active' : '' }}">
            <span class="nav-icon">📅</span> Absensi
        </a>

        <div class="nav-group-label">Laporan</div>

        <a href="{{ route('siswa.laporan') }}" class="nav-item {{ request()->routeIs('siswa.laporan*') ? 'active' : '' }}">
            <span class="nav-icon">📄</span> Laporan PKL
        </a>
        <a href="{{ route('siswa.nilai') }}" class="nav-item {{ request()->routeIs('siswa.nilai*') ? 'active' : '' }}">
            <span class="nav-icon">⭐</span> Nilai PKL
        </a>
        <a href="{{ route('siswa.log') }}" class="nav-item {{ request()->routeIs('siswa.log*') ? 'active' : '' }}">
            <span class="nav-icon">🕐</span> Log Aktivitas
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">🚪 Keluar</button>
        </form>
    </div>
</aside>

{{-- ═══ TOPBAR ═══ --}}
<header class="topbar">
    <div style="display:flex;align-items:center;gap:12px;">
        <button class="mobile-toggle" onclick="openSidebar()">☰</button>
        <div>
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <div class="page-sub">@yield('page-sub', 'Selamat datang kembali 👋')</div>
        </div>
    </div>
    <div class="topbar-right">
        <span class="topbar-date">📅 {{ now()->translatedFormat('d F Y') }}</span>
        <div class="topbar-notif" title="Notifikasi">🔔<span class="notif-dot"></span></div>
    </div>
</header>

{{-- ═══ MAIN ═══ --}}
<main class="main">

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">ℹ️ {{ session('info') }}</div>
    @endif

    @yield('content')
</main>

<script>
function openSidebar()  { document.getElementById('sidebar').classList.add('open'); document.getElementById('overlay').classList.add('show'); }
function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('show'); }

// Progress bar animation
window.addEventListener('load', () => {
    document.querySelectorAll('.progress-fill').forEach(el => {
        const w = el.dataset.width || el.style.width;
        el.style.width = '0';
        setTimeout(() => { el.style.width = w; }, 300);
    });
});
</script>

@stack('scripts')
</body>
</html>
