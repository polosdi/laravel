<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMPKL Pembimbing — @yield('title','Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}

        /* ── TEMA (identik dengan index.blade.php) ── */
        :root{--font:'Poppins','Segoe UI',system-ui,sans-serif;}

        [data-theme="light"]{
            --bg:#F8F9FA;--surface:#ffffff;
            --text:#1a1a2e;--text-muted:#6b7280;
            --border:rgba(102,126,234,0.15);
            --shadow:0 20px 60px rgba(102,126,234,0.15);
            --card-bg:#ffffff;--stat-bg:#ffffff;
            --grad:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            --primary:#667eea;
            --toggle-bg:rgba(102,126,234,0.1);
            --toggle-border:rgba(102,126,234,0.2);
            --sb-bg:#ffffff;--sb-border:rgba(102,126,234,0.12);
        }

        [data-theme="dark"]{
            --bg:#0d0b1e;--surface:#1a1730;
            --text:#f0eeff;--text-muted:rgba(240,238,255,0.55);
            --border:rgba(102,126,234,0.2);
            --shadow:0 20px 60px rgba(0,0,0,0.4);
            --card-bg:rgba(255,255,255,0.06);--stat-bg:rgba(255,255,255,0.05);
            --grad:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            --primary:#8b9ff4;
            --toggle-bg:rgba(255,255,255,0.1);
            --toggle-border:rgba(255,255,255,0.15);
            --sb-bg:rgba(255,255,255,0.04);--sb-border:rgba(102,126,234,0.18);
        }

        html{scroll-behavior:smooth}
        body{font-family:var(--font);background:var(--bg);color:var(--text);
             display:flex;min-height:100vh;transition:background .4s,color .4s;overflow-x:hidden}

        /* ══ SIDEBAR ══ */
        .sidebar{
            width:250px;min-height:100vh;background:var(--sb-bg);
            border-right:1px solid var(--sb-border);
            display:flex;flex-direction:column;
            position:fixed;top:0;left:0;bottom:0;z-index:50;
            backdrop-filter:blur(20px);overflow:hidden;
            transition:width .35s cubic-bezier(.4,0,.2,1),
                        background .4s,border-color .4s;
        }
        .sidebar.collapsed{width:68px}

        .sb-logo{
            padding:22px 20px;border-bottom:1px solid var(--sb-border);
            display:flex;align-items:center;gap:10px;text-decoration:none;
            white-space:nowrap;overflow:hidden;
        }
        .sb-logo-icon{
            width:36px;height:36px;background:var(--grad);border-radius:10px;
            display:flex;align-items:center;justify-content:center;
            box-shadow:0 4px 14px rgba(102,126,234,.35);font-size:16px;flex-shrink:0;
        }
        .sb-logo-text{
            font-size:1.15rem;font-weight:800;
            background:var(--grad);-webkit-background-clip:text;
            -webkit-text-fill-color:transparent;background-clip:text;
            transition:opacity .25s,transform .25s;
        }
        .sidebar.collapsed .sb-logo-text{opacity:0;transform:translateX(-10px)}

        .sb-user{
            padding:16px 14px;border-bottom:1px solid var(--sb-border);
            display:flex;align-items:center;gap:12px;white-space:nowrap;overflow:hidden;
        }
        .sb-avatar{
            width:40px;height:40px;border-radius:50%;background:var(--grad);
            display:flex;align-items:center;justify-content:center;
            font-size:.78rem;font-weight:700;color:#fff;flex-shrink:0;letter-spacing:.02em;
        }
        .sb-uinfo{transition:opacity .25s,transform .25s;overflow:hidden}
        .sidebar.collapsed .sb-uinfo{opacity:0;transform:translateX(-10px)}
        .sb-uname{font-weight:600;font-size:.825rem;color:var(--text);line-height:1.3}
        .sb-urole{
            font-size:.7rem;color:var(--text-muted);margin-top:2px;
            background:rgba(102,126,234,.1);padding:2px 8px;border-radius:20px;
            display:inline-block;font-weight:500;
        }

        .sb-nav{flex:1;padding:14px 12px;overflow-y:auto;overflow-x:hidden}

        .nav-grp{
            font-size:.65rem;font-weight:700;letter-spacing:.09em;
            text-transform:uppercase;color:var(--text-muted);
            padding:10px 10px 5px;opacity:.7;white-space:nowrap;
            transition:opacity .2s,height .3s;
        }
        .sidebar.collapsed .nav-grp{opacity:0;pointer-events:none;height:0;padding:0;overflow:hidden}

        .nav-a{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-radius:10px;
            text-decoration:none;color:var(--text-muted);
            font-weight:500;font-size:.825rem;margin-bottom:2px;
            transition:all .2s;white-space:nowrap;overflow:hidden;
            position:relative;
        }
        .nav-a:hover{background:rgba(102,126,234,.08);color:var(--primary)}
        .nav-a.active{
            background:linear-gradient(135deg,rgba(102,126,234,.15),rgba(118,75,162,.1));
            color:var(--primary);font-weight:600;
        }
        .nav-ic{font-size:.95rem;width:20px;text-align:center;flex-shrink:0}
        .nav-label{transition:opacity .25s,transform .25s}
        .sidebar.collapsed .nav-label{opacity:0;transform:translateX(-8px)}
        .nav-badge{
            margin-left:auto;background:var(--grad);color:#fff;
            font-size:.62rem;font-weight:700;padding:2px 7px;border-radius:20px;
            transition:opacity .2s;flex-shrink:0;
        }
        .sidebar.collapsed .nav-badge{opacity:0}

        /* Tooltip saat collapsed */
        .sidebar.collapsed .nav-a::after{
            content:attr(data-tip);
            position:absolute;left:58px;top:50%;transform:translateY(-50%);
            background:var(--text);color:var(--bg);
            font-size:.72rem;font-weight:600;padding:5px 10px;
            border-radius:8px;white-space:nowrap;pointer-events:none;
            opacity:0;transition:opacity .15s;z-index:100;
            box-shadow:0 4px 12px rgba(0,0,0,.15);
        }
        .sidebar.collapsed .nav-a:hover::after{opacity:1}

        .sb-footer{
            padding:14px 12px;border-top:1px solid var(--sb-border);
            overflow:hidden;white-space:nowrap;
        }
        .logout-btn-wrap{display:flex;align-items:center;gap:10px;width:100%}
        .logout-label{transition:opacity .25s,transform .25s;flex:1;text-align:left}
        .sidebar.collapsed .logout-label{opacity:0;transform:translateX(-8px)}

        /* Theme toggle */
        .theme-toggle{
            width:48px;height:26px;background:var(--toggle-bg);
            border:1px solid var(--toggle-border);border-radius:50px;
            cursor:pointer;display:flex;align-items:center;padding:3px;
            transition:all .3s;flex-shrink:0;
        }
        .toggle-thumb{
            width:18px;height:18px;border-radius:50%;background:var(--grad);
            transition:transform .3s cubic-bezier(.34,1.4,.64,1);
            display:flex;align-items:center;justify-content:center;
            box-shadow:0 2px 8px rgba(102,126,234,.4);
        }
        [data-theme="light"] .toggle-thumb{transform:translateX(0)}
        [data-theme="dark"]  .toggle-thumb{transform:translateX(22px)}

        .logout-btn{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-radius:10px;
            color:var(--text-muted);font-weight:500;font-size:.825rem;
            transition:all .2s;cursor:pointer;border:none;background:none;
            width:100%;font-family:var(--font);
        }
        .logout-btn:hover{background:rgba(239,68,68,.08);color:#ef4444}

        /* ══ MAIN ══ */
        .main{
            margin-left:250px;flex:1;display:flex;flex-direction:column;min-height:100vh;
            transition:margin-left .35s cubic-bezier(.4,0,.2,1);
        }
        .sidebar.collapsed ~ .main{margin-left:68px}

        .topbar{
            height:62px;background:var(--card-bg);
            border-bottom:1px solid var(--border);
            display:flex;align-items:center;justify-content:space-between;
            padding:0 20px 0 16px;position:sticky;top:0;z-index:40;
            backdrop-filter:blur(16px);transition:background .4s;
        }
        .topbar-left{display:flex;align-items:center;gap:12px}
        .topbar-title{font-size:1rem;font-weight:700;color:var(--text);letter-spacing:-.01em}
        .topbar-right{display:flex;align-items:center;gap:12px}

        /* Tombol hamburger */
        .sb-toggle{
            width:36px;height:36px;border-radius:10px;
            background:rgba(102,126,234,.07);border:1px solid var(--border);
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;transition:all .2s;flex-shrink:0;
            flex-direction:column;gap:4px;padding:9px;
        }
        .sb-toggle:hover{border-color:var(--primary);background:rgba(102,126,234,.12)}
        .sb-toggle span{
            display:block;height:2px;border-radius:2px;
            background:var(--text-muted);transition:all .3s;width:100%;
        }
        .sb-toggle.open span:nth-child(1){transform:translateY(6px) rotate(45deg)}
        .sb-toggle.open span:nth-child(2){opacity:0;transform:scaleX(0)}
        .sb-toggle.open span:nth-child(3){transform:translateY(-6px) rotate(-45deg)}
        .topbar-date{
            font-size:.73rem;color:var(--text-muted);font-weight:500;
            background:rgba(102,126,234,.07);padding:5px 12px;
            border-radius:20px;border:1px solid var(--border);
        }
        .notif-btn{
            width:36px;height:36px;border-radius:10px;
            background:rgba(102,126,234,.07);border:1px solid var(--border);
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;font-size:.9rem;position:relative;transition:all .2s;
        }
        .notif-btn:hover{border-color:var(--primary);background:rgba(102,126,234,.12)}
        .notif-dot{
            position:absolute;top:7px;right:7px;
            width:6px;height:6px;background:#ef4444;
            border-radius:50%;border:1.5px solid var(--surface);
        }

        .page{padding:26px 28px;flex:1}

        /* ══ ALERTS ══ */
        .al{padding:12px 16px;border-radius:10px;margin-bottom:18px;
            font-size:.825rem;font-weight:500;display:flex;align-items:center;gap:9px}
        .al-ok{background:rgba(34,197,94,.09);border:1px solid rgba(34,197,94,.22);color:#16a34a}
        .al-err{background:rgba(239,68,68,.09);border:1px solid rgba(239,68,68,.2);color:#dc2626}
        .al-info{background:rgba(102,126,234,.09);border:1px solid rgba(102,126,234,.2);color:var(--primary)}

        /* ══ CARD ══ */
        .card{background:var(--card-bg);border:1px solid var(--border);border-radius:16px;overflow:hidden;transition:background .4s}
        .card-head{padding:18px 22px 0;display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
        .card-title{font-size:.92rem;font-weight:700;color:var(--text)}
        .card-link{font-size:.75rem;color:var(--primary);text-decoration:none;font-weight:600;transition:opacity .2s}
        .card-link:hover{opacity:.65}
        .card-body{padding:0 22px 22px}

        /* ══ TABLE ══ */
        .tbl-wrap{overflow-x:auto}
        table{width:100%;border-collapse:collapse}
        th{padding:10px 14px;text-align:left;font-size:.7rem;font-weight:700;
           letter-spacing:.06em;text-transform:uppercase;
           color:var(--text-muted);background:rgba(102,126,234,.04);
           border-bottom:1px solid var(--border)}
        td{padding:12px 14px;font-size:.825rem;color:var(--text);
           border-bottom:1px solid var(--border);vertical-align:middle}
        tr:last-child td{border-bottom:none}
        tr:hover td{background:rgba(102,126,234,.03)}

        /* ══ BADGE ══ */
        .bdg{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;
             border-radius:20px;font-size:.7rem;font-weight:700;letter-spacing:.02em}
        .bdg-ok{background:rgba(34,197,94,.1);color:#16a34a;border:1px solid rgba(34,197,94,.22)}
        .bdg-warn{background:rgba(245,158,11,.1);color:#d97706;border:1px solid rgba(245,158,11,.22)}
        .bdg-err{background:rgba(239,68,68,.1);color:#dc2626;border:1px solid rgba(239,68,68,.2)}
        .bdg-info{background:rgba(102,126,234,.1);color:var(--primary);border:1px solid var(--border)}
        .bdg-gray{background:rgba(107,114,128,.08);color:var(--text-muted);border:1px solid rgba(107,114,128,.15)}

        /* ══ BTN ══ */
        .btn{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:50px;
             font-family:var(--font);font-size:.825rem;font-weight:600;cursor:pointer;border:none;
             transition:all .2s;text-decoration:none;white-space:nowrap}
        .btn-pr{background:var(--grad);color:#fff;box-shadow:0 4px 14px rgba(102,126,234,.3)}
        .btn-pr:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(102,126,234,.45)}
        .btn-out{background:transparent;color:var(--primary);border:1px solid rgba(102,126,234,.35)}
        .btn-out:hover{background:rgba(102,126,234,.07)}
        .btn-ok{background:rgba(34,197,94,.12);color:#16a34a;border:1px solid rgba(34,197,94,.3)}
        .btn-ok:hover{background:rgba(34,197,94,.2)}
        .btn-del{background:rgba(239,68,68,.1);color:#dc2626;border:1px solid rgba(239,68,68,.2)}
        .btn-del:hover{background:rgba(239,68,68,.18)}
        .btn-sm{padding:6px 14px;font-size:.775rem}
        .btn-xs{padding:4px 10px;font-size:.72rem}

        /* ══ FORM ══ */
        .form-grid{display:grid;gap:16px}
        .fg2{grid-template-columns:1fr 1fr}
        .fg3{grid-template-columns:1fr 1fr 1fr}
        .fgrp label{display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px}
        .fgrp input,.fgrp select,.fgrp textarea{
            width:100%;padding:10px 14px;border:1px solid var(--border);border-radius:10px;
            font-family:var(--font);font-size:.84rem;color:var(--text);
            background:var(--card-bg);transition:border-color .2s,box-shadow .2s;outline:none;
        }
        .fgrp input:focus,.fgrp select:focus,.fgrp textarea:focus{
            border-color:var(--primary);box-shadow:0 0 0 3px rgba(102,126,234,.12)
        }
        .fgrp textarea{resize:vertical;min-height:90px}
        .fgrp .err{font-size:.72rem;color:#dc2626;margin-top:4px}
        .fgrp .help{font-size:.72rem;color:var(--text-muted);margin-top:4px}

        /* ══ PAGE HEADER ══ */
        .pg-head{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:22px}
        .pg-head h2{font-size:1.25rem;font-weight:800;color:var(--text)}
        .breadcrumb{display:flex;align-items:center;gap:6px;font-size:.73rem;color:var(--text-muted);margin-bottom:4px}
        .breadcrumb a{color:var(--primary);text-decoration:none;font-weight:500}
        .breadcrumb span{opacity:.5}

        /* ══ EMPTY ══ */
        .empty{text-align:center;padding:44px 20px;color:var(--text-muted)}
        .empty-ic{font-size:2.5rem;margin-bottom:10px}
        .empty p{font-size:.875rem;margin-bottom:16px}

        /* ══ PAGINATION ══ */
        .pagi{display:flex;align-items:center;justify-content:space-between;
              padding:14px 22px;border-top:1px solid var(--border);
              font-size:.78rem;color:var(--text-muted)}
    </style>
    @stack('styles')
</head>
<body>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar">
    <!-- <a href="{{ route('pembimbing.dashboard') }}" class="sb-logo">
        <div class="sb-logo-icon">🎓</div>
        <span class="sb-logo-text">SIMPKL</span>
    </a> -->

    <div class="sb-user">
        <div class="sb-avatar">
            {{ strtoupper(substr(auth()->user()->nama_depan,0,1).substr(auth()->user()->nama_belakang,0,1)) }}
        </div>
        <div class="sb-uinfo">
            <div class="sb-uname">{{ auth()->user()->nama_depan }} {{ auth()->user()->nama_belakang }}</div>
            <div class="sb-urole">Guru Pembimbing</div>
        </div>
    </div>

    <nav class="sb-nav">
        <div class="nav-grp">Utama</div>
        <a href="{{ route('pembimbing.dashboard') }}"
           data-tip="Dashboard"
           class="nav-a {{ request()->routeIs('pembimbing.dashboard') ? 'active' : '' }}">
            <span class="nav-ic">🏠</span> <span class="nav-label">Dashboard</span>
        </a>

        <div class="nav-grp" style="margin-top:8px">Kelola Siswa</div>
        <a href="{{ route('pembimbing.pkl.index') }}"
           data-tip="Pengajuan PKL"
           class="nav-a {{ request()->routeIs('pembimbing.pkl.*') ? 'active' : '' }}">
            <span class="nav-ic">📋</span> <span class="nav-label">Pengajuan PKL</span>
            @php
                $pendingPkl = \App\Models\PklPengajuan::where('pembimbing_id', auth()->id())
                    ->where('status_pembimbing','pending')->count();
            @endphp
            @if($pendingPkl > 0)<span class="nav-badge">{{ $pendingPkl }}</span>@endif
        </a>

        <a href="{{ route('pembimbing.jurnal.index') }}"
           data-tip="Jurnal Harian"
           class="nav-a {{ request()->routeIs('pembimbing.jurnal.*') ? 'active' : '' }}">
            <span class="nav-ic">📓</span> <span class="nav-label">Jurnal Harian</span>
            @php
                $pendingJurnal = \App\Models\JurnalHarian::whereHas('siswa', fn($q) =>
                    $q->whereHas('pklAnggota', fn($q2) =>
                        $q2->whereHas('pengajuan', fn($q3) =>
                            $q3->where('pembimbing_id', auth()->id()))))
                    ->where('status_validasi','pending')->count();
            @endphp
            @if($pendingJurnal > 0)<span class="nav-badge">{{ $pendingJurnal }}</span>@endif
        </a>

        <a href="{{ route('pembimbing.absensi.index') }}"
           data-tip="Rekap Absensi"
           class="nav-a {{ request()->routeIs('pembimbing.absensi.*') ? 'active' : '' }}">
            <span class="nav-ic">📅</span> <span class="nav-label">Rekap Absensi</span>
        </a>

        <a href="{{ route('pembimbing.laporan.index') }}"
           data-tip="Laporan PKL"
           class="nav-a {{ request()->routeIs('pembimbing.laporan.*') ? 'active' : '' }}">
            <span class="nav-ic">📄</span> <span class="nav-label">Laporan PKL</span>
            @php
                $pendingLaporan = \App\Models\LaporanPkl::whereHas('siswa', fn($q) =>
                    $q->whereHas('pklAnggota', fn($q2) =>
                        $q2->whereHas('pengajuan', fn($q3) =>
                            $q3->where('pembimbing_id', auth()->id()))))
                    ->where('status_pembimbing','pending')->count();
            @endphp
            @if($pendingLaporan > 0)<span class="nav-badge">{{ $pendingLaporan }}</span>@endif
        </a>

        <a href="{{ route('pembimbing.nilai.index') }}"
           data-tip="Input Nilai"
           class="nav-a {{ request()->routeIs('pembimbing.nilai.*') ? 'active' : '' }}">
            <span class="nav-ic">⭐</span> <span class="nav-label">Input Nilai</span>
        </a>

        <div class="nav-grp" style="margin-top:8px">Akun</div>
        <a href="{{ route('pembimbing.profil') }}"
           data-tip="Profil Saya"
           class="nav-a {{ request()->routeIs('pembimbing.profil') ? 'active' : '' }}">
            <span class="nav-ic">👤</span> <span class="nav-label">Profil Saya</span>
        </a>
    </nav>

    <div class="sb-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <span style="flex-shrink:0">🚪</span>
                <span class="logout-label">Keluar</span>
            </button>
        </form>
    </div>
</aside>

{{-- ── MAIN ── --}}
<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <div class="sb-toggle" id="sidebarToggle" onclick="toggleSidebar()" title="Buka/tutup sidebar">
                <span></span><span></span><span></span>
            </div>
            <div class="topbar-title">@yield('title','Dashboard')</div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
            <div class="notif-btn">🔔<span class="notif-dot"></span></div>
            <div class="theme-toggle" onclick="toggleTheme()" title="Ganti tema">
                <div class="toggle-thumb">
                    <span id="ico-sun" style="font-size:10px">☀️</span>
                    <span id="ico-moon" style="font-size:10px;display:none">🌙</span>
                </div>
            </div>
        </div>
    </header>

    <main class="page">
        @if(session('success'))<div class="al al-ok">✅ {{ session('success') }}</div>@endif
        @if(session('error'))<div class="al al-err">❌ {{ session('error') }}</div>@endif
        @if(session('info'))<div class="al al-info">ℹ️ {{ session('info') }}</div>@endif
        @yield('content')
    </main>
</div>

@stack('scripts')
<script>
/* ── THEME ── */
function toggleTheme(){
    const html=document.documentElement;
    const isLight=html.getAttribute('data-theme')==='light';
    html.setAttribute('data-theme',isLight?'dark':'light');
    document.getElementById('ico-sun').style.display =isLight?'none':'block';
    document.getElementById('ico-moon').style.display=isLight?'block':'none';
    localStorage.setItem('simpkl-theme',isLight?'dark':'light');
}
const savedTheme=localStorage.getItem('simpkl-theme');
if(savedTheme==='dark'){
    document.documentElement.setAttribute('data-theme','dark');
    document.getElementById('ico-sun').style.display='none';
    document.getElementById('ico-moon').style.display='block';
}

/* ── SIDEBAR TOGGLE ── */
function toggleSidebar(){
    const sb=document.querySelector('.sidebar');
    const btn=document.getElementById('sidebarToggle');
    const isCollapsed=sb.classList.toggle('collapsed');
    btn.classList.toggle('open',!isCollapsed);
    localStorage.setItem('simpkl-sidebar',isCollapsed?'collapsed':'open');
}
/* Restore state dari localStorage */
(function(){
    const state=localStorage.getItem('simpkl-sidebar');
    const sb=document.querySelector('.sidebar');
    const btn=document.getElementById('sidebarToggle');
    if(state==='collapsed'){
        sb.classList.add('collapsed');
        btn.classList.remove('open');
    } else {
        btn.classList.add('open');
    }
})();
</script>
</body>
</html>