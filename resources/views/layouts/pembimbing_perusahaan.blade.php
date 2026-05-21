<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — SIMPKL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --font: 'Poppins', 'Segoe UI', system-ui, sans-serif; }

        [data-theme="light"] {
            --bg: #F8F9FA;
            --surface: #ffffff;
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary: #667eea;
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --text-sub: #9ca3af;
            --border: rgba(102,126,234,.13);
            --sidebar-bg: #ffffff;
            --sidebar-border: rgba(102,126,234,.1);
            --nav-bg: rgba(255,255,255,0.92);
            --card-bg: #ffffff;
            --card-shadow: 0 2px 12px rgba(102,126,234,.08);
            --card-hover: 0 8px 28px rgba(102,126,234,.15);
            --toggle-bg: rgba(102,126,234,.1);
            --toggle-border: rgba(102,126,234,.2);
            --sidebar-active: rgba(102,126,234,.08);
            --sidebar-text: #6b7280;
            --tag-bg: rgba(102,126,234,.06);
        }

        [data-theme="dark"] {
            --bg: #0d0b1e;
            --surface: #1a1730;
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary: #8b9ff4;
            --text: #f0eeff;
            --text-muted: rgba(240,238,255,.55);
            --text-sub: rgba(240,238,255,.35);
            --border: rgba(102,126,234,.18);
            --sidebar-bg: #131126;
            --sidebar-border: rgba(102,126,234,.15);
            --nav-bg: rgba(19,17,38,0.92);
            --card-bg: rgba(255,255,255,.05);
            --card-shadow: 0 2px 12px rgba(0,0,0,.3);
            --card-hover: 0 8px 28px rgba(0,0,0,.4);
            --toggle-bg: rgba(255,255,255,.1);
            --toggle-border: rgba(255,255,255,.15);
            --sidebar-active: rgba(102,126,234,.15);
            --sidebar-text: rgba(240,238,255,.5);
            --tag-bg: rgba(102,126,234,.1);
        }

        html, body { min-height: 100vh; font-family: var(--font); background: var(--bg); color: var(--text); transition: background .4s, color .4s; }

        /* ── LAYOUT ── */
        .layout { display: flex; min-height: 100vh; }

        /* ══ SIDEBAR ══ */
        .sidebar {
            width: 250px; min-height: 100vh; background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0; z-index: 50;
            backdrop-filter: blur(20px); overflow: hidden;
            transition: width .35s cubic-bezier(.4,0,.2,1), background .4s, border-color .4s;
        }
        .sidebar.collapsed { width: 68px; }

        /* ── SB USER ── */
        .sb-user {
            padding: 16px 14px; border-bottom: 1px solid var(--sidebar-border);
            display: flex; align-items: center; gap: 12px; white-space: nowrap; overflow: hidden;
        }
        .sb-avatar {
            width: 40px; height: 40px; border-radius: 50%; background: var(--grad);
            display: flex; align-items: center; justify-content: center;
            font-size: .78rem; font-weight: 700; color: #fff; flex-shrink: 0; letter-spacing: .02em;
        }
        .sb-uinfo { transition: opacity .25s, transform .25s; overflow: hidden; }
        .sidebar.collapsed .sb-uinfo { opacity: 0; transform: translateX(-10px); pointer-events: none; }
        .sb-uname { font-weight: 600; font-size: .825rem; color: var(--text); line-height: 1.3; }
        .sb-urole {
            font-size: .7rem; color: var(--text-muted); margin-top: 2px;
            background: rgba(102,126,234,.1); padding: 2px 8px; border-radius: 20px;
            display: inline-block; font-weight: 500;
        }

        .sb-nav { flex: 1; padding: 14px 12px; overflow-y: auto; overflow-x: hidden; }
        .sb-nav::-webkit-scrollbar { width: 3px; }
        .sb-nav::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

        .nav-grp {
            font-size: .65rem; font-weight: 700; letter-spacing: .09em;
            text-transform: uppercase; color: var(--text-muted);
            padding: 10px 10px 5px; opacity: .7; white-space: nowrap;
            transition: opacity .2s, height .3s;
        }
        .sidebar.collapsed .nav-grp { opacity: 0; pointer-events: none; height: 0; padding: 0; overflow: hidden; }

        .nav-a {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            text-decoration: none; color: var(--sidebar-text);
            font-weight: 500; font-size: .825rem; margin-bottom: 2px;
            transition: all .2s; white-space: nowrap; overflow: hidden;
            position: relative;
        }
        .nav-a:hover { background: rgba(102,126,234,.08); color: var(--primary); }
        .nav-a.active {
            background: linear-gradient(135deg, rgba(102,126,234,.15), rgba(118,75,162,.1));
            color: var(--primary); font-weight: 600;
        }
        .nav-ic {
            font-size: 1.1rem; width: 22px; display: flex; align-items: center;
            justify-content: center; flex-shrink: 0;
        }
        .nav-ic ion-icon { font-size: 1.1rem; }
        .nav-label { transition: opacity .25s, transform .25s; }
        .sidebar.collapsed .nav-label { opacity: 0; transform: translateX(-8px); pointer-events: none; }
        .nav-badge {
            margin-left: auto; background: var(--grad); color: #fff;
            font-size: .62rem; font-weight: 700; padding: 2px 7px; border-radius: 20px;
            transition: opacity .2s; flex-shrink: 0;
        }
        .sidebar.collapsed .nav-badge { opacity: 0; }

        /* Tooltip saat collapsed */
        .sidebar.collapsed .nav-a::after {
            content: attr(data-tip);
            position: absolute; left: 58px; top: 50%; transform: translateY(-50%);
            background: var(--text); color: var(--bg);
            font-size: .72rem; font-weight: 600; padding: 5px 10px;
            border-radius: 8px; white-space: nowrap; pointer-events: none;
            opacity: 0; transition: opacity .15s; z-index: 100;
            box-shadow: 0 4px 12px rgba(0,0,0,.15);
        }
        .sidebar.collapsed .nav-a:hover::after { opacity: 1; }

        .sb-footer {
            padding: 14px 12px; border-top: 1px solid var(--sidebar-border);
            overflow: hidden; white-space: nowrap;
        }
        .btn-logout {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            color: var(--text-muted); font-weight: 500; font-size: .825rem;
            transition: all .2s; cursor: pointer; border: 1.5px solid rgba(239,68,68,.25);
            background: transparent; width: 100%; font-family: var(--font);
        }
        .btn-logout:hover { background: rgba(239,68,68,.07); color: #ef4444; border-color: #ef4444; }
        .sidebar.collapsed .btn-logout .nav-label { opacity: 0; transform: translateX(-8px); pointer-events: none; }

        /* ══ MAIN ══ */
        .main {
            margin-left: 250px; padding-top: 62px;
            flex: 1; display: flex; flex-direction: column; min-height: 100vh;
            transition: margin-left .35s cubic-bezier(.4,0,.2,1);
            min-width: 0;
        }
        .sidebar.collapsed ~ .main,
        .main.collapsed { margin-left: 68px; }

        /* ══ TOPBAR ══ */
        .topbar {
            height: 62px; background: var(--card-bg);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 20px 0 16px; position: fixed;
            left: 250px; right: 0; top: 0; z-index: 40;
            backdrop-filter: blur(16px);
            transition: left .35s cubic-bezier(.4,0,.2,1), background .4s;
        }
        .sidebar.collapsed ~ .main .topbar,
        .topbar.collapsed { left: 68px; }

        .topbar-left { display: flex; align-items: center; gap: 12px; }
        .topbar-title { font-size: 1rem; font-weight: 700; color: var(--text); letter-spacing: -.01em; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }

        /* Hamburger */
        .sb-toggle {
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(102,126,234,.07); border: 1px solid var(--border);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 4.5px; cursor: pointer; transition: all .2s; padding: 0;
        }
        .sb-toggle:hover { background: rgba(102,126,234,.14); }
        .sb-toggle span {
            display: block; width: 16px; height: 2px;
            background: var(--text-muted); border-radius: 2px;
            transition: all .3s cubic-bezier(.4,0,.2,1);
            transform-origin: center;
        }
        .sb-toggle.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .sb-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .sb-toggle.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* Date */
        .topbar-date {
            font-size: .75rem; color: var(--text-muted); font-weight: 500;
            background: var(--toggle-bg); border: 1px solid var(--border);
            padding: 6px 12px; border-radius: 8px;
        }

        /* Theme toggle */
        .theme-toggle {
            width: 38px; height: 22px; border-radius: 20px;
            background: var(--grad); cursor: pointer;
            position: relative; transition: all .3s;
            border: none; display: flex; align-items: center; padding: 2px;
        }
        .toggle-thumb {
            width: 18px; height: 18px; border-radius: 50%; background: rgba(255,255,255,.9);
            display: flex; align-items: center; justify-content: center;
            transition: transform .3s; transform: translateX(0);
        }
        [data-theme="dark"] .toggle-thumb { transform: translateX(16px); }

        /* Notif */
        .notif-btn {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--toggle-bg); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; position: relative; transition: all .2s; color: var(--text-muted);
            font-size: 1rem;
        }
        .notif-btn:hover { background: rgba(102,126,234,.14); color: var(--primary); }
        .notif-dot {
            position: absolute; top: 6px; right: 6px;
            width: 8px; height: 8px; border-radius: 50%;
            background: #ef4444; border: 2px solid var(--card-bg);
        }

        /* ── CONTENT ── */
        .content { padding: 20px; flex: 1; }

        /* ── CARD BASE ── */
        .card {
            background: var(--card-bg); border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            box-shadow: var(--card-shadow); transition: box-shadow .25s;
        }

        /* ── BADGE ── */
        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: .68rem; font-weight: 600; padding: 3px 9px;
            border-radius: 20px;
        }
        .bdot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
        .badge-hadir, .badge-approved { background: rgba(34,197,94,.1); color: #16a34a; }
        .badge-hadir .bdot, .badge-approved .bdot { background: #22c55e; }
        .badge-izin, .badge-pending { background: rgba(245,158,11,.1); color: #d97706; }
        .badge-izin .bdot, .badge-pending .bdot { background: #f59e0b; }
        .badge-sakit { background: rgba(99,102,241,.1); color: #6366f1; }
        .badge-sakit .bdot { background: #6366f1; }
        .badge-alpa, .badge-rejected { background: rgba(239,68,68,.1); color: #dc2626; }
        .badge-alpa .bdot, .badge-rejected .bdot { background: #ef4444; }

        /* ── CARD ACTION ── */
        .card-action {
            font-size: .72rem; font-weight: 600; color: var(--primary);
            text-decoration: none; transition: opacity .15s;
        }
        .card-action:hover { opacity: .7; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @yield('styles')
    </style>
    @yield('head')
</head>
<body>
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        {{-- User Avatar + Info --}}
        <div class="sb-user">
            <div class="sb-avatar">
                @php $profil = Auth::user()->profilPembimbing ?? null; @endphp
                @if($profil?->foto_profil)
                    <img src="{{ asset('storage/'.$profil->foto_profil) }}" alt="foto"
                         style="width:100%;height:100%;border-radius:50%;object-fit:cover">
                @else
                    {{ Auth::user()->inisial() }}
                @endif
            </div>
            <div class="sb-uinfo">
                <div class="sb-uname">{{ Auth::user()->namaLengkap() }}</div>
                <div class="sb-urole">Pembimbing Perusahaan</div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="sb-nav">
            <div class="nav-grp">Menu Utama</div>

            <a href="{{ route('pembimbing.dashboard') }}" data-tip="Dashboard"
               class="nav-a @yield('nav_dashboard')">
                <span class="nav-ic"><ion-icon name="grid-outline"></ion-icon></span>
                <span class="nav-label">Dashboard</span>
            </a>

            <a href="{{ route('pembimbing.profil-perusahaan') }}" data-tip="Profil Perusahaan"
               class="nav-a @yield('nav_profil_perusahaan')">
                <span class="nav-ic"><ion-icon name="business-outline"></ion-icon></span>
                <span class="nav-label">Profil Perusahaan</span>
            </a>

            <div class="nav-grp" style="margin-top:8px">Manajemen Siswa</div>

            <a href="{{ route('pembimbing.daftar-siswa') }}" data-tip="Daftar Siswa PKL"
               class="nav-a @yield('nav_siswa')">
                <span class="nav-ic"><ion-icon name="people-outline"></ion-icon></span>
                <span class="nav-label">Daftar Siswa PKL</span>
            </a>

            <a href="{{ route('pembimbing.validasi-absensi') }}" data-tip="Validasi Absensi"
               class="nav-a @yield('nav_absensi')">
                <span class="nav-ic"><ion-icon name="calendar-outline"></ion-icon></span>
                <span class="nav-label">Validasi Absensi</span>
                @php
                    $pendingAbsensi = \App\Models\Absensi::where('status_pembimbing', 'pending')
                        ->whereHas('siswa', fn($q) => $q->where('pembimbing_perusahaan_id', Auth::id()))
                        ->count();
                @endphp
                @if($pendingAbsensi > 0)
                    <span class="nav-badge">{{ $pendingAbsensi }}</span>
                @endif
            </a>

            <a href="{{ route('pembimbing.review-jurnal') }}" data-tip="Review Jurnal"
               class="nav-a @yield('nav_jurnal')">
                <span class="nav-ic"><ion-icon name="book-outline"></ion-icon></span>
                <span class="nav-label">Review Jurnal</span>
                @php
                    $pendingJurnal = \App\Models\JurnalHarian::where('status', 'pending')
                        ->whereHas('siswa', fn($q) => $q->where('pembimbing_perusahaan_id', Auth::id()))
                        ->count();
                @endphp
                @if($pendingJurnal > 0)
                    <span class="nav-badge">{{ $pendingJurnal }}</span>
                @endif
            </a>

            <div class="nav-grp" style="margin-top:8px">Penilaian & Laporan</div>

            <a href="{{ route('pembimbing.penilaian-siswa') }}" data-tip="Penilaian Siswa"
               class="nav-a @yield('nav_penilaian')">
                <span class="nav-ic"><ion-icon name="star-outline"></ion-icon></span>
                <span class="nav-label">Penilaian Siswa</span>
            </a>

            <a href="{{ route('pembimbing.laporan-insiden') }}" data-tip="Laporan Insiden"
               class="nav-a @yield('nav_insiden')">
                <span class="nav-ic"><ion-icon name="warning-outline"></ion-icon></span>
                <span class="nav-label">Laporan Insiden</span>
            </a>

            <a href="{{ route('pembimbing.unduh-rekap') }}" data-tip="Unduh Rekap Siswa"
               class="nav-a @yield('nav_rekap')">
                <span class="nav-ic"><ion-icon name="download-outline"></ion-icon></span>
                <span class="nav-label">Unduh Rekap Siswa</span>
            </a>

            <div class="nav-grp" style="margin-top:8px">Komunikasi</div>

            <a href="{{ route('pembimbing.komunikasi') }}" data-tip="Komunikasi Sekolah"
               class="nav-a @yield('nav_komunikasi')">
                <span class="nav-ic"><ion-icon name="chatbubbles-outline"></ion-icon></span>
                <span class="nav-label">Komunikasi Sekolah</span>
            </a>

            <div class="nav-grp" style="margin-top:8px">Akun</div>

            <a href="{{ route('pembimbing.profil') }}" data-tip="Profil Saya"
               class="nav-a @yield('nav_profil')">
                <span class="nav-ic"><ion-icon name="person-outline"></ion-icon></span>
                <span class="nav-label">Profil Saya</span>
            </a>
        </nav>

        {{-- Footer: Logout --}}
        <div class="sb-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <ion-icon name="log-out-outline" style="flex-shrink:0;font-size:1rem"></ion-icon>
                    <span class="nav-label">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- TOPBAR -->
    <header class="topbar" id="topnav">
        <div class="topbar-left">
            <div class="sb-toggle" id="sidebarToggle" onclick="toggleSidebar()">
                <span></span><span></span><span></span>
            </div>
            <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
            <div class="theme-toggle" onclick="toggleTheme()" title="Ganti tema">
                <div class="toggle-thumb">
                    <ion-icon id="ico-sun" name="sunny" style="font-size:10px;color:rgba(255,140,0,.9)"></ion-icon>
                    <ion-icon id="ico-moon" name="moon" style="font-size:10px;color:rgba(255,255,255,.9);display:none"></ion-icon>
                </div>
            </div>
            <div class="notif-btn">
                <ion-icon name="notifications-outline" style="font-size:1.05rem"></ion-icon>
                <span class="notif-dot"></span>
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <main class="main" id="main">
        <div class="content">
            @yield('content')
        </div>
    </main>

</div>

<script>
// Theme
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

// Sidebar
let open = true;
function toggleSidebar() {
    open = !open;
    document.getElementById('sidebar').classList.toggle('collapsed', !open);
    document.getElementById('topnav').classList.toggle('collapsed', !open);
    document.getElementById('main').classList.toggle('collapsed', !open);
    document.getElementById('sidebarToggle').classList.toggle('open', open);
    localStorage.setItem('simpkl-sidebar', open ? 'open' : 'collapsed');
}
(function(){
    const state = localStorage.getItem('simpkl-sidebar');
    const sb  = document.getElementById('sidebar');
    const btn = document.getElementById('sidebarToggle');
    const tn  = document.getElementById('topnav');
    const mn  = document.getElementById('main');
    if (state === 'collapsed') {
        open = false;
        sb.classList.add('collapsed');
        tn.classList.add('collapsed');
        mn.classList.add('collapsed');
        btn.classList.remove('open');
    } else {
        btn.classList.add('open');
    }
})();
</script>
@yield('scripts')
</body>
</html>