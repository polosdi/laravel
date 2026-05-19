<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — SIMPKL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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

        /* ── SIDEBAR ── */
        .sidebar {
            width: 240px; flex-shrink: 0;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex; flex-direction: column;
            position: fixed; top:0; left:0; bottom:0;
            z-index: 100;
            transition: background .4s, border-color .4s, width .3s cubic-bezier(.4,0,.2,1);
            overflow: hidden;
        }

        .sidebar.collapsed { width: 64px; }

        .sidebar-header {
            padding: 0 16px;
            display: flex; align-items: center; gap: 10px;
            border-bottom: 1px solid var(--sidebar-border);
            height: 64px; flex-shrink: 0;
        }

        .brand-ico {
            width: 36px; height: 36px; flex-shrink: 0;
            background: var(--grad); border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(102,126,234,.4);
        }
        .brand-ico svg { width: 18px; height: 18px; color: white; }

        .brand-name {
            font-size: 1.1rem; font-weight: 800;
            background: var(--grad);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            white-space: nowrap;
            transition: opacity .2s, transform .2s;
        }
        .sidebar.collapsed .brand-name { opacity: 0; transform: translateX(-8px); pointer-events: none; }

        /* NAV */
        .sidebar-nav { flex: 1; padding: 12px 8px; overflow-y: auto; overflow-x: hidden; }
        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

        .nav-section-label {
            font-size: .6rem; font-weight: 700;
            color: var(--text-sub); letter-spacing: .1em; text-transform: uppercase;
            padding: 0 10px; margin: 14px 0 5px;
            white-space: nowrap;
            transition: opacity .2s;
        }
        .sidebar.collapsed .nav-section-label { opacity: 0; }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; border-radius: 10px;
            cursor: pointer; transition: all .18s;
            color: var(--sidebar-text);
            text-decoration: none;
            white-space: nowrap;
            position: relative;
            margin-bottom: 2px;
        }

        .nav-item:hover { background: var(--sidebar-active); color: var(--primary); }

        .nav-item.active {
            background: var(--sidebar-active);
            color: var(--primary); font-weight: 600;
        }

        .nav-item.active::before {
            content: ''; position: absolute;
            left: 0; top: 25%; bottom: 25%;
            width: 3px; border-radius: 0 3px 3px 0;
            background: var(--text);
        }

        .nav-item.danger { color: #ef4444; }
        .nav-item.danger:hover { background: rgba(239,68,68,.08); color: #ef4444; }

        .btn-logout {
            display: flex; align-items: center; gap: 8px;
            padding: 9px 12px; width: 100%; border-radius: 10px;
            background: transparent; border: 1.5px solid rgba(239,68,68,.25);
            color: #ef4444; font-family: var(--font);
            font-size: .8rem; font-weight: 600;
            cursor: pointer; transition: all .2s; text-align: left;
        }
        .btn-logout:hover { background: rgba(239,68,68,.07); border-color: #ef4444; }
        .sidebar.collapsed .btn-logout .nav-label { opacity: 0; width: 0; overflow: hidden; }

        .nav-ico {
            width: 36px; height: 36px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .nav-ico svg { width: 18px; height: 18px; }

        .nav-label { font-size: .82rem; transition: opacity .2s, transform .2s; }
        .sidebar.collapsed .nav-label { opacity: 0; transform: translateX(-8px); pointer-events: none; }

        .nav-badge {
            margin-left: auto; padding: 2px 7px;
            background: var(--grad); color: white;
            border-radius: 20px; font-size: .6rem; font-weight: 700;
            transition: opacity .2s;
        }
        .sidebar.collapsed .nav-badge { opacity: 0; }

        /* Tooltip for collapsed sidebar */
        .nav-item .tooltip {
            display: none;
            position: absolute; left: 56px; top: 50%;
            transform: translateY(-50%);
            background: var(--sidebar-bg);
            border: 1px solid var(--border);
            color: var(--text);
            padding: 5px 10px; border-radius: 8px;
            font-size: .75rem; font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 4px 16px rgba(0,0,0,.12);
            z-index: 999; pointer-events: none;
        }

        .sidebar.collapsed .nav-item:hover .tooltip { display: block; }

        /* SIDEBAR FOOTER */
        .sidebar-footer {
            padding: 8px;
            border-top: 1px solid var(--sidebar-border);
            flex-shrink: 0;
        }

        .user-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px; border-radius: 10px;
            background: var(--tag-bg); margin-bottom: 4px;
            overflow: hidden;
        }

        .user-avatar {
            width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
            background: var(--grad);
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; font-weight: 700; color: white;
        }

        .user-info { min-width: 0; transition: opacity .2s, transform .2s; }
        .sidebar.collapsed .user-info { opacity: 0; transform: translateX(-8px); pointer-events: none; }
        .user-name { font-size: .8rem; font-weight: 700; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; transition: color .4s; }
        .user-role { font-size: .67rem; color: var(--text-sub); transition: color .4s; }

        /* ── TOPNAV ── */
        .topnav {
            position: fixed; top:0; right:0;
            left: 240px; height: 64px; z-index: 90;
            background: var(--nav-bg);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            padding: 0 24px; gap: 12px;
            transition: left .3s cubic-bezier(.4,0,.2,1), background .4s, border-color .4s;
        }

        .topnav.collapsed { left: 64px; }

        .hamburger {
            width: 34px; height: 34px; border-radius: 9px;
            background: var(--tag-bg); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all .2s; flex-shrink: 0;
            color: var(--text-muted);
        }
        .hamburger:hover { background: rgba(102,126,234,.12); color: var(--primary); }
        .hamburger svg { width: 16px; height: 16px; }

        .topnav-title { font-size: .95rem; font-weight: 700; color: var(--text); transition: color .4s; }
        .topnav-breadcrumb { font-size: .75rem; color: var(--text-muted); transition: color .4s; }

        .topnav-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }

        .theme-toggle {
            width: 46px; height: 24px;
            background: var(--toggle-bg); border: 1px solid var(--toggle-border);
            border-radius: 50px; cursor: pointer;
            display: flex; align-items: center; padding: 3px;
            transition: all .3s;
        }
        .toggle-thumb {
            width: 16px; height: 16px; border-radius: 50%;
            background: var(--grad);
            transition: transform .3s cubic-bezier(.34,1.4,.64,1);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(102,126,234,.4);
        }
        [data-theme="light"] .toggle-thumb { transform: translateX(0); }
        [data-theme="dark"]  .toggle-thumb { transform: translateX(22px); }
        .toggle-thumb svg { width: 9px; height: 9px; color: white; }

        .icon-btn {
            width: 34px; height: 34px; border-radius: 9px;
            background: var(--tag-bg); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all .2s; position: relative;
            color: var(--text-muted);
        }
        .icon-btn:hover { background: rgba(102,126,234,.12); color: var(--primary); }
        .icon-btn svg { width: 16px; height: 16px; }
        .notif-dot {
            position: absolute; top: 6px; right: 6px;
            width: 7px; height: 7px; border-radius: 50%;
            background: #ef4444; border: 2px solid var(--nav-bg);
        }

        /* ── MAIN ── */
        .main {
            margin-left: 240px; padding-top: 64px;
            min-height: 100vh;
            flex: 1;
            min-width: 0;
            width: calc(100vw - 240px);
            transition: margin-left .3s cubic-bezier(.4,0,.2,1);
        }
        .main.collapsed { margin-left: 64px; width: calc(100vw - 64px); }

        .content { padding: 24px 28px; width: 100%; box-sizing: border-box; }

        /* ── SHARED COMPONENTS (used across pages) ── */
        .page-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 22px; flex-wrap: wrap; gap: 12px;
        }
        .page-title { font-size: 1.35rem; font-weight: 800; color: var(--text); transition: color .4s; }
        .page-sub { font-size: .8rem; color: var(--text-muted); margin-top: 2px; transition: color .4s; }
        .page-actions { display: flex; align-items: center; gap: 8px; }

        .btn-primary {
            padding: 9px 18px; background: var(--grad);
            color: white; border: none; border-radius: 10px;
            font-family: var(--font); font-size: .82rem; font-weight: 600;
            cursor: pointer; transition: all .2s;
            display: inline-flex; align-items: center; gap: 6px;
            box-shadow: 0 4px 14px rgba(102,126,234,.35);
            text-decoration: none;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 7px 20px rgba(102,126,234,.45); }
        .btn-primary svg { width: 15px; height: 15px; }

        .btn-secondary {
            padding: 9px 16px;
            background: var(--tag-bg); border: 1px solid var(--border);
            color: var(--text-muted); border-radius: 10px;
            font-family: var(--font); font-size: .82rem; font-weight: 600;
            cursor: pointer; transition: all .2s;
            display: inline-flex; align-items: center; gap: 6px;
            text-decoration: none;
        }
        .btn-secondary:hover { border-color: #667eea; color: #667eea; }
        .btn-secondary svg { width: 15px; height: 15px; }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: background .4s, border-color .4s;
        }

        /* card-body: untuk konten bebas tanpa komponen tabel */
        .card-body { padding: 20px 22px; }

        .card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
        }
        .card-title-sm { font-size: .9rem; font-weight: 700; color: var(--text); transition: color .4s; }
        .card-subtitle { font-size: .72rem; color: var(--text-muted); margin-top: 2px; transition: color .4s; }
        .card-action { font-size: .75rem; color: #667eea; font-weight: 600; cursor: pointer; text-decoration: none; transition: color .2s; }
        .card-action:hover { color: #764ba2; }

        .stat-card {
            background: var(--card-bg); border: 1px solid var(--border);
            border-radius: 16px; padding: 18px;
            transition: all .3s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: var(--card-hover); }

        .stat-card-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }

        .stat-icon {
            width: 40px; height: 40px; border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
        }
        .stat-icon svg { width: 19px; height: 19px; }
        .stat-icon.purple { background: rgba(102,126,234,.12); color: #667eea; }
        .stat-icon.green  { background: rgba(34,197,94,.12);   color: #22c55e; }
        .stat-icon.amber  { background: rgba(245,158,11,.12);  color: #f59e0b; }
        .stat-icon.pink   { background: rgba(236,72,153,.12);  color: #ec4899; }
        .stat-icon.blue   { background: rgba(59,130,246,.12);  color: #3b82f6; }

        .stat-badge { padding: 3px 8px; border-radius: 20px; font-size: .63rem; font-weight: 700; }
        .stat-badge.up   { background: rgba(34,197,94,.1);   color: #22c55e; }
        .stat-badge.warn { background: rgba(245,158,11,.1);  color: #f59e0b; }
        .stat-badge.info { background: rgba(102,126,234,.1); color: #667eea; }
        .stat-badge.down { background: rgba(239,68,68,.1);   color: #ef4444; }

        .stat-num { font-size: 1.8rem; font-weight: 800; color: var(--text); line-height: 1; transition: color .4s; }
        .stat-label { font-size: .72rem; color: var(--text-muted); margin-top: 4px; transition: color .4s; }

        .progress-bar { height: 5px; background: var(--border); border-radius: 5px; overflow: hidden; margin: 10px 0 4px; }
        .progress-fill { height: 100%; border-radius: 5px; background: var(--grad); }
        .progress-label { display: flex; justify-content: space-between; font-size: .63rem; color: var(--text-sub); transition: color .4s; }

        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 6px; font-size: .65rem; font-weight: 700; }
        .badge.approved,
        .badge-hadir  { background: rgba(34,197,94,.1);   color: #22c55e; }
        .badge.pending,
        .badge-izin   { background: rgba(245,158,11,.1);  color: #f59e0b; }
        .badge.rejected,
        .badge-alpa   { background: rgba(239,68,68,.1);   color: #ef4444; }
        .badge.info,
        .badge-sakit  { background: rgba(59,130,246,.1);  color: #3b82f6; }

        /* Table */
        .table-wrap { overflow-x: auto; }
        .table-wrap table { width: 100%; border-collapse: collapse; }
        .table-wrap th {
            padding: 10px 16px;
            font-size: .7rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .05em; color: var(--text-sub);
            border-bottom: 1px solid var(--border);
            text-align: left; white-space: nowrap;
            background: var(--tag-bg);
        }
        .table-wrap td {
            padding: 12px 16px;
            font-size: .8rem; color: var(--text);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .table-wrap tbody tr:last-child td { border-bottom: none; }
        .table-wrap tbody tr:hover { background: var(--sidebar-active); }

        .info-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; }
        .info-item:last-child { margin-bottom: 0; }
        .info-ico { width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0; background: rgba(102,126,234,.08); display: flex; align-items: center; justify-content: center; color: #667eea; }
        .info-ico svg { width: 15px; height: 15px; }
        .info-label { font-size: .67rem; color: var(--text-sub); font-weight: 500; transition: color .4s; }
        .info-value { font-size: .82rem; font-weight: 600; color: var(--text); margin-top: 1px; transition: color .4s; }

        .divider { height: 1px; background: var(--border); margin: 16px 0; }

        .empty-state { text-align: center; padding: 40px 16px; }
        .empty-icon { width: 56px; height: 56px; border-radius: 16px; background: var(--tag-bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; color: var(--text-sub); }
        .empty-icon svg { width: 24px; height: 24px; }
        .empty-title { font-size: .88rem; font-weight: 700; color: var(--text); margin-bottom: 4px; transition: color .4s; }
        .empty-desc { font-size: .75rem; color: var(--text-muted); line-height: 1.6; transition: color .4s; }

        .grid-2 { display: grid; grid-template-columns: 1fr 320px; gap: 20px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }

        @media (max-width: 1100px) {
            .grid-2 { grid-template-columns: 1fr; }
            .grid-4 { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .topnav, .main { left: 0 !important; margin-left: 0 !important; }
            .grid-3, .grid-4 { grid-template-columns: 1fr 1fr; }
            .content { padding: 16px; }
        }

        @yield('styles')
    </style>
</head>
<body>
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        {{-- Brand Header --}}
        <div class="sidebar-header">
            <div class="brand-ico">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            </div>
            <span class="brand-name">SIMPKL</span>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>

            <a href="{{ route('siswa.dashboard') }}" class="nav-item @yield('nav_dashboard')">
                <div class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
                <span class="nav-label">Dashboard</span>
                <span class="tooltip">Dashboard</span>
            </a>

            <a href="{{ route('siswa.profil') }}" class="nav-item @yield('nav_profil')">
                <div class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                <span class="nav-label">Profil Saya</span>
                <span class="tooltip">Profil Saya</span>
            </a>

            <div class="nav-section-label">PKL</div>

            <a href="{{ route('siswa.pkl.pengajuan') }}" class="nav-item @yield('nav_pengajuan')">
                <div class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg></div>
                <span class="nav-label">Pengajuan PKL</span>
                <span class="tooltip">Pengajuan PKL</span>
            </a>

            <a href="{{ route('siswa.jurnal') }}" class="nav-item @yield('nav_jurnal')">
                <div class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
                <span class="nav-label">Jurnal Harian</span>
                @php $jp = \App\Models\JurnalHarian::olehSiswa(Auth::id())->pending()->count(); @endphp
                @if($jp > 0)<span class="nav-badge">{{ $jp }}</span>@endif
                <span class="tooltip">Jurnal Harian</span>
            </a>

            <a href="{{ route('siswa.absensi') }}" class="nav-item @yield('nav_absensi')">
                <div class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                <span class="nav-label">Absensi</span>
                <span class="tooltip">Absensi</span>
            </a>

            <div class="nav-section-label">Laporan</div>

            <a href="{{ route('siswa.laporan') }}" class="nav-item @yield('nav_laporan')">
                <div class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
                <span class="nav-label">Laporan PKL</span>
                <span class="tooltip">Laporan PKL</span>
            </a>

            <a href="{{ route('siswa.nilai') }}" class="nav-item @yield('nav_nilai')">
                <div class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                <span class="nav-label">Nilai PKL</span>
                <span class="tooltip">Nilai PKL</span>
            </a>

            <a href="{{ route('siswa.log') }}" class="nav-item @yield('nav_log')">
                <div class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                <span class="nav-label">Log Aktivitas</span>
                <span class="tooltip">Log Aktivitas</span>
            </a>
        </nav>

        {{-- Footer: User Card + Logout --}}
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    @php $profil = Auth::user()->profilSiswa; @endphp
                    @if($profil?->foto_profil)
                        <img src="{{ asset('storage/'.$profil->foto_profil) }}" alt="foto"
                             style="width:100%;height:100%;border-radius:50%;object-fit:cover">
                    @else
                        {{ Auth::user()->inisial() }}
                    @endif
                </div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->namaLengkap() }}</div>
                    <div class="user-role">Siswa PKL</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px;flex-shrink:0"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    <span class="nav-label">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- TOPNAV -->
    <div class="topnav" id="topnav">
        <button class="hamburger" onclick="toggleSidebar()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <div>
            <div class="topnav-title">@yield('page_title', 'Dashboard')</div>
        </div>
        <div class="topnav-right">
            <button class="theme-toggle" onclick="toggleTheme()">
                <div class="toggle-thumb">
                    <svg id="ico-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </svg>
                    <svg id="ico-moon" style="display:none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                </div>
            </button>
            <div class="icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                <div class="notif-dot"></div>
            </div>
        </div>
    </div>

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
}

</script>
</body>
</html>