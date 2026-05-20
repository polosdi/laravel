<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — SIMPKL</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        .sidebar{
            width:250px;min-height:100vh;background:var(--sidebar-bg);
            border-right:1px solid var(--sidebar-border);
            display:flex;flex-direction:column;
            position:fixed;top:0;left:0;bottom:0;z-index:50;
            backdrop-filter:blur(20px);overflow:hidden;
            transition:width .35s cubic-bezier(.4,0,.2,1),
                        background .4s,border-color .4s;
        }
        .sidebar.collapsed{width:68px}

        /* ── SB USER ── */
        .sb-user{
            padding:16px 14px;border-bottom:1px solid var(--sidebar-border);
            display:flex;align-items:center;gap:12px;white-space:nowrap;overflow:hidden;
        }
        .sb-avatar{
            width:40px;height:40px;border-radius:50%;background:var(--grad);
            display:flex;align-items:center;justify-content:center;
            font-size:.78rem;font-weight:700;color:#fff;flex-shrink:0;letter-spacing:.02em;
        }
        .sb-uinfo{transition:opacity .25s,transform .25s;overflow:hidden}
        .sidebar.collapsed .sb-uinfo{opacity:0;transform:translateX(-10px);pointer-events:none}
        .sb-uname{font-weight:600;font-size:.825rem;color:var(--text);line-height:1.3}
        .sb-urole{
            font-size:.7rem;color:var(--text-muted);margin-top:2px;
            background:rgba(102,126,234,.1);padding:2px 8px;border-radius:20px;
            display:inline-block;font-weight:500;
        }

        .sb-nav{flex:1;padding:14px 12px;overflow-y:auto;overflow-x:hidden}
        .sb-nav::-webkit-scrollbar{width:3px}
        .sb-nav::-webkit-scrollbar-thumb{background:var(--border);border-radius:3px}

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
            text-decoration:none;color:var(--sidebar-text);
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
        .sidebar.collapsed .nav-label{opacity:0;transform:translateX(-8px);pointer-events:none}
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
            padding:14px 12px;border-top:1px solid var(--sidebar-border);
            overflow:hidden;white-space:nowrap;
        }
        .btn-logout{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-radius:10px;
            color:var(--text-muted);font-weight:500;font-size:.825rem;
            transition:all .2s;cursor:pointer;border:1.5px solid rgba(239,68,68,.25);
            background:transparent;width:100%;font-family:var(--font);
        }
        .btn-logout:hover{background:rgba(239,68,68,.07);color:#ef4444;border-color:#ef4444}
        .sidebar.collapsed .btn-logout .nav-label{opacity:0;transform:translateX(-8px);pointer-events:none}

        /* ══ MAIN ══ */
        .main{
            margin-left:250px;padding-top:62px;
            flex:1;display:flex;flex-direction:column;min-height:100vh;
            transition:margin-left .35s cubic-bezier(.4,0,.2,1);
            min-width:0;
        }
        .sidebar.collapsed ~ .main,
        .main.collapsed{margin-left:68px}

        /* ══ TOPBAR ══ */
        .topbar{
            height:62px;background:var(--card-bg);
            border-bottom:1px solid var(--border);
            display:flex;align-items:center;justify-content:space-between;
            padding:0 20px 0 16px;position:fixed;
            left:250px;right:0;top:0;z-index:40;
            backdrop-filter:blur(16px);
            transition:left .35s cubic-bezier(.4,0,.2,1),background .4s;
        }
        .sidebar.collapsed ~ .main .topbar,
        .topbar.collapsed{left:68px}

        .topbar-left{display:flex;align-items:center;gap:12px}
        .topbar-title{font-size:1rem;font-weight:700;color:var(--text);letter-spacing:-.01em}
        .topbar-right{display:flex;align-items:center;gap:12px}

        /* Hamburger */
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
            cursor:pointer;font-size:.9rem;color:var(--text-muted);position:relative;transition:all .2s;
        }
        .notif-btn:hover{border-color:var(--primary);background:rgba(102,126,234,.12);color:var(--primary)}
        .notif-dot{
            position:absolute;top:7px;right:7px;
            width:6px;height:6px;background:#ef4444;
            border-radius:50%;border:1.5px solid var(--surface);
        }
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
        .toggle-thumb i{font-size:9px;color:rgba(255,255,255,.95);line-height:1}

        .content{padding:26px 28px;flex:1}
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

        /* ── SB USER (avatar di atas sidebar) ── */
        .sb-user {
            padding: 16px 14px;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex; align-items: center; gap: 12px;
            white-space: nowrap; overflow: hidden;
        }
        .sb-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: var(--grad); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: .78rem; font-weight: 700; color: #fff; letter-spacing: .02em;
        }
        .sb-uinfo { transition: opacity .25s, transform .25s; overflow: hidden; }
        .sidebar.collapsed .sb-uinfo { opacity: 0; transform: translateX(-10px); pointer-events: none; }
        .sb-uname { font-weight: 600; font-size: .82rem; color: var(--text); line-height: 1.3; }
        .sb-urole {
            font-size: .68rem; color: var(--text-muted); margin-top: 2px;
            background: rgba(102,126,234,.1); padding: 2px 8px;
            border-radius: 20px; display: inline-block; font-weight: 500;
        }

        /* ── NAV-ICO for FA icons ── */
        .nav-ico { width: 36px; height: 36px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: .92rem; }

        /* ── SB-TOGGLE (hamburger animasi) ── */
        .sb-toggle {
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(102,126,234,.07); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all .2s; flex-shrink: 0;
            flex-direction: column; gap: 4px; padding: 9px;
        }
        .sb-toggle:hover { border-color: var(--primary); background: rgba(102,126,234,.12); }
        .sb-toggle span {
            display: block; height: 2px; border-radius: 2px;
            background: var(--text-muted); transition: all .3s; width: 100%;
        }
        .sb-toggle.open span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
        .sb-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .sb-toggle.open span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }

        /* ── TOPBAR DATE PILL ── */
        .topbar-date {
            font-size: .72rem; color: var(--text-muted); font-weight: 500;
            background: rgba(102,126,234,.07); padding: 5px 12px;
            border-radius: 20px; border: 1px solid var(--border);
        }

        /* ── TOPNAV LEFT ── */
        .topnav-left { display: flex; align-items: center; gap: 12px; }

        /* Tooltip saat collapsed */
        .sidebar.collapsed .nav-item::after {
            content: attr(data-tip);
            position: absolute; left: 58px; top: 50%; transform: translateY(-50%);
            background: var(--text); color: var(--bg);
            font-size: .72rem; font-weight: 600; padding: 5px 10px;
            border-radius: 8px; white-space: nowrap; pointer-events: none;
            opacity: 0; transition: opacity .15s; z-index: 100;
            box-shadow: 0 4px 12px rgba(0,0,0,.15);
        }
        .sidebar.collapsed .nav-item:hover::after { opacity: 1; }

        /* ── SIDEBAR BORDER ── */
        .sidebar { border-right: 1px solid var(--sidebar-border); }

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
                @php $profil = Auth::user()->profilSiswa; @endphp
                @if($profil?->foto_profil)
                    <img src="{{ asset('storage/'.$profil->foto_profil) }}" alt="foto"
                         style="width:100%;height:100%;border-radius:50%;object-fit:cover">
                @else
                    {{ Auth::user()->inisial() }}
                @endif
            </div>
            <div class="sb-uinfo">
                <div class="sb-uname">{{ Auth::user()->namaLengkap() }}</div>
                <div class="sb-urole">Siswa PKL</div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="sb-nav">
            <div class="nav-grp">Menu Utama</div>

            <a href="{{ route('siswa.dashboard') }}" data-tip="Dashboard"
               class="nav-a @yield('nav_dashboard')">
                <span class="nav-ic"><i class="fa-solid fa-gauge"></i></span>
                <span class="nav-label">Dashboard</span>
            </a>

            <div class="nav-grp" style="margin-top:8px">PKL</div>

            <a href="{{ route('siswa.pkl.pengajuan') }}" data-tip="Pengajuan PKL"
               class="nav-a @yield('nav_pengajuan')">
                <span class="nav-ic"><i class="fa-solid fa-file-circle-plus"></i></span>
                <span class="nav-label">Pengajuan PKL</span>
            </a>

            <a href="{{ route('siswa.jurnal') }}" data-tip="Jurnal Harian"
               class="nav-a @yield('nav_jurnal')">
                <span class="nav-ic"><i class="fa-solid fa-book-open"></i></span>
                <span class="nav-label">Jurnal Harian</span>
                @php $jp = \App\Models\JurnalHarian::olehSiswa(Auth::id())->pending()->count(); @endphp
                @if($jp > 0)<span class="nav-badge">{{ $jp }}</span>@endif
            </a>

            <a href="{{ route('siswa.absensi') }}" data-tip="Absensi"
               class="nav-a @yield('nav_absensi')">
                <span class="nav-ic"><i class="fa-solid fa-calendar-check"></i></span>
                <span class="nav-label">Absensi</span>
            </a>

            <div class="nav-grp" style="margin-top:8px">Laporan</div>

            <a href="{{ route('siswa.laporan') }}" data-tip="Laporan PKL"
               class="nav-a @yield('nav_laporan')">
                <span class="nav-ic"><i class="fa-solid fa-file-lines"></i></span>
                <span class="nav-label">Laporan PKL</span>
            </a>

            <a href="{{ route('siswa.nilai') }}" data-tip="Nilai PKL"
               class="nav-a @yield('nav_nilai')">
                <span class="nav-ic"><i class="fa-solid fa-star"></i></span>
                <span class="nav-label">Nilai PKL</span>
            </a>

            <a href="{{ route('siswa.log') }}" data-tip="Log Aktivitas"
               class="nav-a @yield('nav_log')">
                <span class="nav-ic"><i class="fa-solid fa-clock-rotate-left"></i></span>
                <span class="nav-label">Log Aktivitas</span>
            </a>

            <div class="nav-grp" style="margin-top:8px">Akun</div>

            <a href="{{ route('siswa.profil') }}" data-tip="Profil Saya"
               class="nav-a @yield('nav_profil')">
                <span class="nav-ic"><i class="fa-solid fa-user-pen"></i></span>
                <span class="nav-label">Profil Saya</span>
            </a>
        </nav>

        {{-- Footer: Logout --}}
        <div class="sb-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket" style="flex-shrink:0;font-size:.82rem"></i>
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
                    <i id="ico-sun" class="fa-solid fa-sun" style="font-size:9px;color:rgba(255,255,255,.95)"></i>
                    <i id="ico-moon" class="fa-solid fa-moon" style="font-size:9px;color:rgba(255,255,255,.95);display:none"></i>
                </div>
            </div>
            <div class="notif-btn">
                <i class="fa-solid fa-bell" style="font-size:.85rem"></i>
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
</body>
</html>
