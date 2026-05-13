<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard — SIMPKL</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root { --font: 'Poppins', 'Segoe UI', system-ui, sans-serif; --sidebar-w: 260px; --sidebar-collapsed: 72px; }

[data-theme="light"] {
    --bg: #F0F2F8;
    --surface: #ffffff;
    --text: #1a1a2e;
    --text-muted: #6b7280;
    --border: rgba(102,126,234,0.15);
    --shadow: 0 4px 24px rgba(102,126,234,0.10);
    --card-bg: #ffffff;
    --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --primary: #667eea;
    --primary-soft: rgba(102,126,234,0.1);
    --sidebar-bg: #ffffff;
    --sidebar-text: #4b5563;
    --sidebar-active: rgba(102,126,234,0.12);
    --sidebar-active-text: #667eea;
    --topbar-bg: #ffffff;
    --toggle-bg: rgba(102,126,234,0.1);
    --toggle-border: rgba(102,126,234,0.2);
    --input-bg: #f9fafb;
    --input-border: rgba(102,126,234,0.2);
    --table-head: #f8f9fa;
    --table-hover: rgba(102,126,234,0.04);
    --badge-info-bg: rgba(59,130,246,0.1); --badge-info: #3b82f6;
    --badge-ok-bg: rgba(34,197,94,0.1); --badge-ok: #16a34a;
    --badge-warn-bg: rgba(245,158,11,0.1); --badge-warn: #d97706;
    --badge-err-bg: rgba(239,68,68,0.1); --badge-err: #dc2626;
}

[data-theme="dark"] {
    --bg: #0d0b1e;
    --surface: #1a1730;
    --text: #f0eeff;
    --text-muted: rgba(240,238,255,0.5);
    --border: rgba(102,126,234,0.2);
    --shadow: 0 4px 24px rgba(0,0,0,0.35);
    --card-bg: rgba(255,255,255,0.06);
    --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --primary: #8b9ff4;
    --primary-soft: rgba(102,126,234,0.15);
    --sidebar-bg: #14112b;
    --sidebar-text: rgba(240,238,255,0.6);
    --sidebar-active: rgba(102,126,234,0.2);
    --sidebar-active-text: #a5b4fc;
    --topbar-bg: #1a1730;
    --toggle-bg: rgba(255,255,255,0.1);
    --toggle-border: rgba(255,255,255,0.15);
    --input-bg: rgba(255,255,255,0.05);
    --input-border: rgba(255,255,255,0.1);
    --table-head: rgba(255,255,255,0.04);
    --table-hover: rgba(255,255,255,0.03);
    --badge-info-bg: rgba(59,130,246,0.15); --badge-info: #93c5fd;
    --badge-ok-bg: rgba(34,197,94,0.15); --badge-ok: #4ade80;
    --badge-warn-bg: rgba(245,158,11,0.15); --badge-warn: #fbbf24;
    --badge-err-bg: rgba(239,68,68,0.15); --badge-err: #f87171;
}

html { scroll-behavior: smooth; }
body { font-family: var(--font); background: var(--bg); color: var(--text); overflow-x: hidden; transition: background .35s, color .35s; min-height: 100vh; }

/* ── SIDEBAR ── */
.sidebar {
    position: fixed; top: 0; left: 0; bottom: 0;
    width: var(--sidebar-w);
    background: var(--sidebar-bg);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    transition: width .28s cubic-bezier(.4,0,.2,1), box-shadow .28s;
    z-index: 300;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.sidebar.collapsed { width: var(--sidebar-collapsed); }

.sidebar-header {
    display: flex; align-items: center;
    padding: 20px 16px;
    border-bottom: 1px solid var(--border);
    min-height: 70px;
    gap: 12px;
    flex-shrink: 0;
}

.sidebar-logo-icon {
    width: 38px; height: 38px;
    background: var(--grad);
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(102,126,234,.35);
}
.sidebar-logo-icon svg { width: 20px; height: 20px; color: white; }

.sidebar-logo-text {
    font-size: 1.3rem; font-weight: 800;
    background: var(--grad);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
    white-space: nowrap;
    opacity: 1; transition: opacity .2s;
}
.sidebar.collapsed .sidebar-logo-text { opacity: 0; width: 0; overflow: hidden; }

.sidebar-toggle-btn {
    margin-left: auto;
    width: 30px; height: 30px;
    border: none; background: var(--primary-soft);
    border-radius: 8px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--primary);
    flex-shrink: 0;
    transition: all .2s;
}
.sidebar-toggle-btn:hover { background: var(--primary); color: white; }
.sidebar-toggle-btn svg { width: 16px; height: 16px; transition: transform .28s; }
.sidebar.collapsed .sidebar-toggle-btn svg { transform: rotate(180deg); }

/* NAV */
.sidebar-nav { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 12px 8px; scrollbar-width: thin; }
.sidebar-nav::-webkit-scrollbar { width: 4px; }
.sidebar-nav::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

.nav-section-label {
    font-size: .65rem; font-weight: 700; letter-spacing: .1em;
    text-transform: uppercase; color: var(--text-muted);
    padding: 6px 10px 4px;
    white-space: nowrap; overflow: hidden;
    opacity: 1; transition: opacity .2s;
}
.sidebar.collapsed .nav-section-label { opacity: 0; }

.nav-item {
    display: flex; align-items: center; gap: 11px;
    padding: 10px 12px;
    border-radius: 10px;
    cursor: pointer;
    color: var(--sidebar-text);
    text-decoration: none;
    font-size: .855rem; font-weight: 500;
    transition: all .18s;
    position: relative;
    white-space: nowrap;
    margin-bottom: 2px;
}
.nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
.nav-item:hover { background: var(--primary-soft); color: var(--primary); }
.nav-item.active { background: var(--sidebar-active); color: var(--sidebar-active-text); font-weight: 600; }
.nav-item.active::before {
    content: ''; position: absolute; left: 0; top: 50%;
    transform: translateY(-50%);
    width: 3px; height: 20px;
    background: var(--grad); border-radius: 0 3px 3px 0;
}

.nav-item-label { transition: opacity .2s, width .2s; }
.sidebar.collapsed .nav-item-label { opacity: 0; width: 0; overflow: hidden; }

.nav-badge {
    margin-left: auto;
    background: var(--grad); color: white;
    font-size: .62rem; font-weight: 700;
    padding: 2px 7px; border-radius: 20px;
    flex-shrink: 0;
    transition: opacity .2s;
}
.sidebar.collapsed .nav-badge { opacity: 0; }

/* SIDEBAR FOOTER */
.sidebar-footer {
    padding: 12px 8px;
    border-top: 1px solid var(--border);
    flex-shrink: 0;
}

.admin-profile {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 12px;
    border-radius: 10px;
    cursor: pointer;
    transition: background .2s;
}
.admin-profile:hover { background: var(--primary-soft); }

.admin-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--grad);
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem; font-weight: 700; color: white;
    flex-shrink: 0;
}

.admin-info { transition: opacity .2s; }
.sidebar.collapsed .admin-info { opacity: 0; width: 0; overflow: hidden; }
.admin-name { font-size: .8rem; font-weight: 700; color: var(--text); }
.admin-role { font-size: .68rem; color: var(--text-muted); }

/* ── MAIN LAYOUT ── */
.main-wrap {
    margin-left: var(--sidebar-w);
    transition: margin-left .28s cubic-bezier(.4,0,.2,1);
    min-height: 100vh;
    display: flex; flex-direction: column;
}
.main-wrap.sidebar-collapsed { margin-left: var(--sidebar-collapsed); }

/* ── TOPBAR ── */
.topbar {
    position: sticky; top: 0; z-index: 200;
    background: var(--topbar-bg);
    border-bottom: 1px solid var(--border);
    padding: 0 28px;
    height: 70px;
    display: flex; align-items: center; gap: 16px;
    box-shadow: var(--shadow);
    transition: background .35s, border-color .35s;
}

.topbar-title {
    font-size: 1.05rem; font-weight: 700;
    color: var(--text);
}

.topbar-breadcrumb {
    font-size: .78rem; color: var(--text-muted);
    display: flex; align-items: center; gap: 6px;
}
.topbar-breadcrumb span { color: var(--primary); font-weight: 600; }

.topbar-right { margin-left: auto; display: flex; align-items: center; gap: 12px; }

.topbar-search {
    display: flex; align-items: center;
    background: var(--input-bg);
    border: 1px solid var(--input-border);
    border-radius: 10px;
    padding: 7px 14px; gap: 8px;
    transition: all .2s;
}
.topbar-search:focus-within { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-soft); }
.topbar-search svg { width: 15px; height: 15px; color: var(--text-muted); }
.topbar-search input {
    border: none; background: transparent; outline: none;
    font-family: var(--font); font-size: .82rem;
    color: var(--text); width: 180px;
}
.topbar-search input::placeholder { color: var(--text-muted); }

.topbar-icon-btn {
    width: 38px; height: 38px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--card-bg);
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted);
    position: relative;
    transition: all .2s;
}
.topbar-icon-btn:hover { border-color: var(--primary); color: var(--primary); }
.topbar-icon-btn svg { width: 17px; height: 17px; }

.notif-dot {
    position: absolute; top: 6px; right: 6px;
    width: 8px; height: 8px; border-radius: 50%;
    background: #ef4444;
    border: 2px solid var(--topbar-bg);
}

/* THEME TOGGLE */
.theme-toggle {
    width: 52px; height: 28px;
    background: var(--toggle-bg);
    border: 1px solid var(--toggle-border);
    border-radius: 50px; cursor: pointer;
    display: flex; align-items: center; padding: 3px;
    transition: all .3s; flex-shrink: 0;
}
.toggle-thumb {
    width: 20px; height: 20px; border-radius: 50%;
    background: var(--grad);
    transition: transform .3s cubic-bezier(.34,1.4,.64,1);
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(102,126,234,.4);
}
[data-theme="light"] .toggle-thumb { transform: translateX(0); }
[data-theme="dark"]  .toggle-thumb { transform: translateX(24px); }
.toggle-thumb svg { width: 11px; height: 11px; color: white; }

/* ── PAGE CONTENT ── */
.page-content { padding: 28px; flex: 1; }

/* SECTION HEADER */
.section-header { margin-bottom: 24px; }
.section-title { font-size: 1.35rem; font-weight: 800; color: var(--text); }
.section-desc { font-size: .825rem; color: var(--text-muted); margin-top: 4px; }

/* ── STAT CARDS ── */
.stats-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 16px; margin-bottom: 24px;
}

.stat-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px; padding: 20px 22px;
    display: flex; align-items: flex-start; gap: 14px;
    transition: all .25s; position: relative; overflow: hidden;
}
.stat-card::after {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
}
.stat-card-1::after { background: var(--grad); }
.stat-card-2::after { background: linear-gradient(90deg,#22c55e,#16a34a); }
.stat-card-3::after { background: linear-gradient(90deg,#f59e0b,#d97706); }
.stat-card-4::after { background: linear-gradient(90deg,#ec4899,#db2777); }
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 32px rgba(102,126,234,.12); }

.stat-icon {
    width: 46px; height: 46px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.stat-icon svg { width: 21px; height: 21px; }
.stat-icon-1 { background:rgba(102,126,234,.12);color:#667eea; }
.stat-icon-2 { background:rgba(34,197,94,.12);color:#22c55e; }
.stat-icon-3 { background:rgba(245,158,11,.12);color:#f59e0b; }
.stat-icon-4 { background:rgba(236,72,153,.12);color:#ec4899; }

.stat-info { flex: 1; }
.stat-num { font-size: 1.9rem; font-weight: 800; color: var(--text); line-height: 1; }
.stat-label { font-size: .76rem; color: var(--text-muted); margin-top: 4px; font-weight: 500; }
.stat-change {
    font-size: .7rem; font-weight: 600;
    margin-top: 6px; display: flex; align-items: center; gap: 4px;
}
.stat-change.up { color: #22c55e; }
.stat-change.down { color: #ef4444; }
.stat-change svg { width: 12px; height: 12px; }

/* ── CARDS ── */
.card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    transition: background .35s, border-color .35s;
}

.card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 22px;
    border-bottom: 1px solid var(--border);
}

.card-title { font-size: .95rem; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 8px; }
.card-title svg { width: 17px; height: 17px; color: var(--primary); }

/* GRID LAYOUTS */
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; }
.grid-3 { display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 24px; }

/* ── TABLE ── */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; }
thead tr { background: var(--table-head); }
th {
    padding: 12px 16px;
    font-size: .73rem; font-weight: 700;
    letter-spacing: .05em; text-transform: uppercase;
    color: var(--text-muted);
    text-align: left; white-space: nowrap;
}
td {
    padding: 13px 16px;
    font-size: .835rem; color: var(--text);
    border-top: 1px solid var(--border);
    vertical-align: middle;
}
tr:hover td { background: var(--table-hover); }

/* BADGE */
.badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 10px; border-radius: 20px;
    font-size: .7rem; font-weight: 600;
}
.badge-ok  { background: var(--badge-ok-bg);   color: var(--badge-ok);   }
.badge-warn{ background: var(--badge-warn-bg);  color: var(--badge-warn); }
.badge-err { background: var(--badge-err-bg);   color: var(--badge-err);  }
.badge-info{ background: var(--badge-info-bg);  color: var(--badge-info); }
.badge-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

/* AVATAR */
.av { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .72rem; font-weight: 700; color: white; flex-shrink: 0; }
.av-purple { background: linear-gradient(135deg,#667eea,#764ba2); }
.av-green  { background: linear-gradient(135deg,#22c55e,#16a34a); }
.av-amber  { background: linear-gradient(135deg,#f59e0b,#d97706); }
.av-pink   { background: linear-gradient(135deg,#ec4899,#db2777); }
.av-blue   { background: linear-gradient(135deg,#3b82f6,#1d4ed8); }
.av-red    { background: linear-gradient(135deg,#ef4444,#dc2626); }

.user-cell { display: flex; align-items: center; gap: 10px; }
.user-name { font-weight: 600; font-size: .835rem; }
.user-sub  { font-size: .72rem; color: var(--text-muted); }

/* BUTTONS */
.btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 8px 18px; border-radius: 10px;
    font-family: var(--font); font-size: .82rem; font-weight: 600;
    cursor: pointer; border: none; transition: all .2s;
}
.btn-primary {
    background: var(--grad); color: white;
    box-shadow: 0 4px 14px rgba(102,126,234,.3);
}
.btn-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 22px rgba(102,126,234,.4); }
.btn-ghost {
    background: var(--primary-soft); color: var(--primary);
    border: 1px solid var(--border);
}
.btn-ghost:hover { background: var(--primary); color: white; }
.btn svg { width: 15px; height: 15px; }
.btn-sm { padding: 5px 12px; font-size: .76rem; border-radius: 8px; }
.btn-icon { padding: 7px; border-radius: 8px; background: var(--primary-soft); color: var(--primary); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .2s; }
.btn-icon:hover { background: var(--primary); color: white; }
.btn-icon svg { width: 14px; height: 14px; }

/* ── PROGRESS BAR ── */
.progress-row { margin-bottom: 14px; }
.progress-label { display: flex; justify-content: space-between; font-size: .78rem; color: var(--text-muted); margin-bottom: 6px; font-weight: 500; }
.progress-label strong { color: var(--text); }
.progress-bar { height: 8px; background: var(--primary-soft); border-radius: 10px; overflow: hidden; }
.progress-fill { height: 100%; border-radius: 10px; }
.fill-purple { background: var(--grad); }
.fill-green  { background: linear-gradient(90deg,#22c55e,#16a34a); }
.fill-amber  { background: linear-gradient(90deg,#f59e0b,#d97706); }
.fill-pink   { background: linear-gradient(90deg,#ec4899,#db2777); }

/* ── LOG AKTIVITAS ── */
.log-item {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 14px 22px;
    border-bottom: 1px solid var(--border);
    transition: background .15s;
}
.log-item:last-child { border-bottom: none; }
.log-item:hover { background: var(--table-hover); }

.log-icon {
    width: 34px; height: 34px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 2px;
}
.log-icon svg { width: 16px; height: 16px; }
.log-icon-add  { background:rgba(34,197,94,.12);  color:#22c55e; }
.log-icon-edit { background:rgba(59,130,246,.12);  color:#3b82f6; }
.log-icon-del  { background:rgba(239,68,68,.12);   color:#ef4444; }
.log-icon-login{ background:rgba(102,126,234,.12); color:#667eea; }

.log-body { flex: 1; }
.log-text { font-size: .835rem; color: var(--text); font-weight: 500; line-height: 1.4; }
.log-text em { font-style: normal; color: var(--primary); font-weight: 600; }
.log-meta { font-size: .72rem; color: var(--text-muted); margin-top: 3px; }

/* ── QUICK ACTION ── */
.quick-actions { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; padding: 16px; }
.qa-btn {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 14px;
    background: var(--primary-soft);
    border: 1px solid var(--border);
    border-radius: 12px; cursor: pointer;
    transition: all .2s; text-decoration: none;
    color: var(--text);
}
.qa-btn:hover { background: var(--primary); color: white; transform: translateY(-2px); }
.qa-btn:hover .qa-ico { background: rgba(255,255,255,.2); color: white; }
.qa-ico { width: 34px; height: 34px; border-radius: 9px; background: var(--primary-soft); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--primary); transition: all .2s; }
.qa-ico svg { width: 16px; height: 16px; }
.qa-label { font-size: .8rem; font-weight: 600; }
.qa-desc  { font-size: .68rem; color: var(--text-muted); margin-top: 2px; transition: color .2s; }
.qa-btn:hover .qa-desc { color: rgba(255,255,255,.75); }

/* ── MODAL/PANEL ── */
.panel-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.45);
    z-index: 400;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none;
    transition: opacity .25s;
}
.panel-overlay.open { opacity: 1; pointer-events: all; }

.panel {
    background: var(--surface);
    border-radius: 20px; padding: 28px;
    width: 100%; max-width: 520px;
    border: 1px solid var(--border);
    box-shadow: 0 24px 64px rgba(0,0,0,.25);
    transform: scale(.94) translateY(10px);
    transition: transform .28s cubic-bezier(.34,1.3,.64,1);
}
.panel-overlay.open .panel { transform: scale(1) translateY(0); }

.panel-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 22px; }
.panel-title { font-size: 1.1rem; font-weight: 800; color: var(--text); }
.panel-close { width: 32px; height: 32px; border: none; background: var(--primary-soft); border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--primary); transition: all .2s; }
.panel-close:hover { background: #ef4444; color: white; }
.panel-close svg { width: 16px; height: 16px; }

.form-field { margin-bottom: 16px; }
.form-label { font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--text-muted); display: block; margin-bottom: 8px; }
.form-input {
    width: 100%; padding: 10px 14px;
    background: var(--input-bg);
    border: 1px solid var(--input-border);
    border-radius: 10px;
    color: var(--text); font-family: var(--font); font-size: .875rem;
    outline: none; transition: all .2s;
}
.form-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-soft); }
.form-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23667eea' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 38px; }
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.panel-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 22px; }
.btn-cancel { background: var(--primary-soft); color: var(--text-muted); border: 1px solid var(--border); }
.btn-cancel:hover { background: var(--border); }

/* PAGINATION */
.pagination { display: flex; align-items: center; gap: 6px; padding: 14px 20px; justify-content: flex-end; border-top: 1px solid var(--border); }
.pg-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: var(--text-muted); cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: .8rem; font-weight: 600; transition: all .2s; }
.pg-btn:hover, .pg-btn.active { background: var(--grad); color: white; border-color: transparent; }
.pg-btn svg { width: 14px; height: 14px; }

/* TABS */
.tabs { display: flex; gap: 4px; background: var(--primary-soft); border-radius: 10px; padding: 4px; }
.tab-btn { padding: 7px 16px; border-radius: 8px; border: none; background: transparent; font-family: var(--font); font-size: .82rem; font-weight: 600; cursor: pointer; color: var(--text-muted); transition: all .2s; }
.tab-btn.active { background: var(--grad); color: white; }

/* MINI CHART (CSS-only) */
.bar-chart { display: flex; align-items: flex-end; gap: 8px; height: 80px; padding: 0 4px; }
.bar-chart-bar { flex: 1; border-radius: 5px 5px 0 0; transition: opacity .2s; cursor: pointer; }
.bar-chart-bar:hover { opacity: .8; }
.bar-wrap { display: flex; flex-direction: column; align-items: center; gap: 4px; flex: 1; }
.bar-wrap-label { font-size: .65rem; color: var(--text-muted); }

/* DONUT (SVG based) */
.donut-wrap { display: flex; align-items: center; gap: 20px; padding: 16px 22px; }
.donut-legend { flex: 1; display: flex; flex-direction: column; gap: 10px; }
.legend-item { display: flex; align-items: center; gap: 10px; font-size: .8rem; }
.legend-dot { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }
.legend-label { color: var(--text-muted); flex: 1; }
.legend-val { font-weight: 700; color: var(--text); }

/* NOTIFICATION DROPDOWN */
.notif-dropdown {
    position: absolute;
    top: calc(100% + 8px); right: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    width: 300px;
    box-shadow: 0 20px 48px rgba(0,0,0,.18);
    display: none; z-index: 500;
    overflow: hidden;
}
.notif-dropdown.open { display: block; }
.notif-head { padding: 14px 16px; border-bottom: 1px solid var(--border); font-size: .85rem; font-weight: 700; color: var(--text); }
.notif-item { display: flex; gap: 10px; padding: 11px 16px; border-bottom: 1px solid var(--border); align-items: flex-start; transition: background .15s; cursor: pointer; }
.notif-item:last-child { border-bottom: none; }
.notif-item:hover { background: var(--primary-soft); }
.notif-ico { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.notif-ico svg { width: 14px; height: 14px; }
.notif-txt { font-size: .78rem; color: var(--text); font-weight: 500; line-height: 1.4; }
.notif-time { font-size: .68rem; color: var(--text-muted); margin-top: 3px; }

/* ANIMATIONS */
@keyframes fadeSlideUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
.anim-in { animation: fadeSlideUp .4s ease both; }
.anim-delay-1 { animation-delay: .05s; }
.anim-delay-2 { animation-delay: .1s; }
.anim-delay-3 { animation-delay: .15s; }
.anim-delay-4 { animation-delay: .2s; }

/* RESPONSIVE */
@media (max-width: 1200px) {
    .stats-grid { grid-template-columns: repeat(2,1fr); }
    .grid-2 { grid-template-columns: 1fr; }
    .grid-3 { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .sidebar { width: var(--sidebar-collapsed); }
    .sidebar .sidebar-logo-text, .sidebar .nav-item-label, .sidebar .nav-badge, .sidebar .admin-info, .sidebar .nav-section-label { opacity: 0; width: 0; overflow: hidden; }
    .main-wrap { margin-left: var(--sidebar-collapsed); }
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .topbar-search { display: none; }
    .page-content { padding: 16px; }
}
@media (max-width: 480px) {
    .stats-grid { grid-template-columns: 1fr; }
    .form-grid { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<!-- ══════════════ SIDEBAR ══════════════ -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
        </div>
        <span class="sidebar-logo-text">SIMPKL</span>
        <button class="sidebar-toggle-btn" onclick="toggleSidebar()" title="Toggle sidebar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
            </svg>
        </button>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Utama</div>

        <a class="nav-item active" href="#" onclick="setPage('dashboard',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            <span class="nav-item-label">Dashboard</span>
        </a>

        <div class="nav-section-label" style="margin-top:10px">Manajemen User</div>

        <a class="nav-item" href="#" onclick="setPage('data-siswa',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <span class="nav-item-label">Data Siswa</span>
            <span class="nav-badge">247</span>
        </a>

        <a class="nav-item" href="#" onclick="setPage('data-guru',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
            <span class="nav-item-label">Data Guru</span>
        </a>

        <a class="nav-item" href="#" onclick="setPage('management-user',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
                <line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
            </svg>
            <span class="nav-item-label">Manajemen User</span>
        </a>

        <div class="nav-section-label" style="margin-top:10px">Data PKL</div>

        <a class="nav-item" href="#" onclick="setPage('data-industri',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
            </svg>
            <span class="nav-item-label">Data Industri</span>
        </a>

        <a class="nav-item" href="#" onclick="setPage('siswa-pkl',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
            <span class="nav-item-label">Siswa PKL</span>
            <span class="nav-badge">12</span>
        </a>

        <div class="nav-section-label" style="margin-top:10px">Monitoring</div>

        <a class="nav-item" href="#" onclick="setPage('absensi-pkl',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
                <polyline points="9 16 11 18 15 14"/>
            </svg>
            <span class="nav-item-label">Absensi PKL</span>
        </a>

        <a class="nav-item" href="#" onclick="setPage('bimbingan-pkl',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            <span class="nav-item-label">Bimbingan PKL</span>
        </a>

        <div class="nav-section-label" style="margin-top:10px">Penilaian</div>

        <a class="nav-item" href="#" onclick="setPage('kompetensi',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
            <span class="nav-item-label">Kompetensi</span>
        </a>

        <a class="nav-item" href="#" onclick="setPage('nilai-pkl',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"/>
                <line x1="12" y1="20" x2="12" y2="4"/>
                <line x1="6" y1="20" x2="6" y2="14"/>
            </svg>
            <span class="nav-item-label">Nilai PKL</span>
        </a>

        <div class="nav-section-label" style="margin-top:10px">Sistem</div>

        <a class="nav-item" href="#" onclick="setPage('log-aktivitas',this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            <span class="nav-item-label">Log Aktivitas</span>
        </a>

        <a class="nav-item" href="{{ route('logout') }}" style="margin-top:4px;" onclick="return confirm('Yakin mau logout?')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            <span class="nav-item-label" style="color:#ef4444">Log Out</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-profile">
            <div class="admin-avatar">AD</div>
            <div class="admin-info">
                <div class="admin-name">Admin SIMPKL</div>
                <div class="admin-role">Administrator</div>
            </div>
        </div>
    </div>
</aside>

<!-- ══════════════ MAIN ══════════════ -->
<div class="main-wrap" id="mainWrap">

    <!-- TOPBAR -->
    <header class="topbar">
        <div>
            <div class="topbar-title" id="topbarTitle">Dashboard</div>
            <div class="topbar-breadcrumb">Admin / <span id="topbarBreadcrumb">Beranda</span></div>
        </div>

        <div class="topbar-right">
            <div class="topbar-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" placeholder="Cari siswa, guru, industri...">
            </div>

            <!-- Notifikasi -->
            <div style="position:relative">
                <button class="topbar-icon-btn" onclick="toggleNotif()" id="notifBtn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <span class="notif-dot"></span>
                </button>
                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-head">🔔 Notifikasi (3)</div>
                    <div class="notif-item">
                        <div class="notif-ico" style="background:rgba(102,126,234,.12)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        </div>
                        <div>
                            <div class="notif-txt">Siswa baru mendaftar PKL: <strong>Aditya Rahman</strong></div>
                            <div class="notif-time">5 menit lalu</div>
                        </div>
                    </div>
                    <div class="notif-item">
                        <div class="notif-ico" style="background:rgba(34,197,94,.12)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div>
                            <div class="notif-txt">12 pengajuan PKL menunggu verifikasi</div>
                            <div class="notif-time">1 jam lalu</div>
                        </div>
                    </div>
                    <div class="notif-item">
                        <div class="notif-ico" style="background:rgba(245,158,11,.12)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg>
                        </div>
                        <div>
                            <div class="notif-txt">Kuota industri PT. Jaya hampir penuh (9/10)</div>
                            <div class="notif-time">3 jam lalu</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Theme Toggle -->
            <button class="theme-toggle" onclick="toggleTheme()" title="Ganti tema">
                <div class="toggle-thumb" id="thumb">
                    <svg id="ico-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"/>
                        <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                        <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </svg>
                    <svg id="ico-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                </div>
            </button>
        </div>
    </header>

    <!-- ══ PAGE CONTENT ══ -->
    <main class="page-content" id="pageContent">

        <!-- ████ DASHBOARD PAGE ████ -->
        <div id="page-dashboard">
            <!-- STAT CARDS -->
            <div class="stats-grid">
                <div class="stat-card stat-card-1 anim-in">
                    <div class="stat-icon stat-icon-1">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-num" data-count="247">247</div>
                        <div class="stat-label">Siswa PKL Aktif</div>
                        <div class="stat-change up">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                            +18 dari bulan lalu
                        </div>
                    </div>
                </div>
                <div class="stat-card stat-card-2 anim-in anim-delay-1">
                    <div class="stat-icon stat-icon-2">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-num">58</div>
                        <div class="stat-label">Mitra Industri</div>
                        <div class="stat-change up">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                            +5 baru semester ini
                        </div>
                    </div>
                </div>
                <div class="stat-card stat-card-3 anim-in anim-delay-2">
                    <div class="stat-icon stat-icon-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-num">32</div>
                        <div class="stat-label">Guru Pembimbing</div>
                        <div class="stat-change up">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                            +3 ditugaskan
                        </div>
                    </div>
                </div>
                <div class="stat-card stat-card-4 anim-in anim-delay-3">
                    <div class="stat-icon stat-icon-4">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <div class="stat-num">94%</div>
                        <div class="stat-label">Rata-rata Kehadiran</div>
                        <div class="stat-change down">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            -2% dari bulan lalu
                        </div>
                    </div>
                </div>
            </div>

            <!-- CHARTS ROW -->
            <div class="grid-3 anim-in">
                <!-- Chart siswa per jurusan -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                            Siswa PKL per Jurusan
                        </div>
                        <div class="tabs">
                            <button class="tab-btn active">Bulan Ini</button>
                            <button class="tab-btn">Semester</button>
                        </div>
                    </div>
                    <div style="padding:20px 22px">
                        <div class="progress-row">
                            <div class="progress-label"><strong>TKJ</strong><span>89 siswa</span></div>
                            <div class="progress-bar"><div class="progress-fill fill-purple" style="width:78%"></div></div>
                        </div>
                        <div class="progress-row">
                            <div class="progress-label"><strong>RPL</strong><span>74 siswa</span></div>
                            <div class="progress-bar"><div class="progress-fill fill-green" style="width:65%"></div></div>
                        </div>
                        <div class="progress-row">
                            <div class="progress-label"><strong>AKL</strong><span>56 siswa</span></div>
                            <div class="progress-bar"><div class="progress-fill fill-amber" style="width:50%"></div></div>
                        </div>
                        <div class="progress-row">
                            <div class="progress-label"><strong>TBSM</strong><span>28 siswa</span></div>
                            <div class="progress-bar"><div class="progress-fill fill-pink" style="width:25%"></div></div>
                        </div>
                        <div style="display:flex;gap:4px;margin-top:18px">
                            <div class="bar-wrap">
                                <div class="bar-chart-bar" style="height:80%;background:var(--grad)"></div>
                                <div class="bar-wrap-label">Sen</div>
                            </div>
                            <div class="bar-wrap">
                                <div class="bar-chart-bar" style="height:65%;background:var(--grad)"></div>
                                <div class="bar-wrap-label">Sel</div>
                            </div>
                            <div class="bar-wrap">
                                <div class="bar-chart-bar" style="height:90%;background:var(--grad)"></div>
                                <div class="bar-wrap-label">Rab</div>
                            </div>
                            <div class="bar-wrap">
                                <div class="bar-chart-bar" style="height:72%;background:var(--grad)"></div>
                                <div class="bar-wrap-label">Kam</div>
                            </div>
                            <div class="bar-wrap">
                                <div class="bar-chart-bar" style="height:55%;background:var(--grad)"></div>
                                <div class="bar-wrap-label">Jum</div>
                            </div>
                            <div class="bar-wrap">
                                <div class="bar-chart-bar" style="height:30%;background:rgba(102,126,234,.3)"></div>
                                <div class="bar-wrap-label">Sab</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donut status -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Status Pengajuan
                        </div>
                    </div>
                    <div class="donut-wrap">
                        <svg width="100" height="100" viewBox="0 0 42 42">
                            <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="rgba(102,126,234,0.12)" stroke-width="8"/>
                            <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="url(#dg1)" stroke-width="8" stroke-dasharray="55 45" stroke-dashoffset="25"/>
                            <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#22c55e" stroke-width="8" stroke-dasharray="25 75" stroke-dashoffset="70"/>
                            <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#f59e0b" stroke-width="8" stroke-dasharray="12 88" stroke-dashoffset="95"/>
                            <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#ef4444" stroke-width="8" stroke-dasharray="8 92" stroke-dashoffset="107"/>
                            <defs>
                                <linearGradient id="dg1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#667eea"/>
                                    <stop offset="100%" stop-color="#764ba2"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="donut-legend">
                            <div class="legend-item">
                                <div class="legend-dot" style="background:var(--grad)"></div>
                                <span class="legend-label">Diproses</span>
                                <span class="legend-val">55%</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="background:#22c55e"></div>
                                <span class="legend-label">Diterima</span>
                                <span class="legend-val">25%</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="background:#f59e0b"></div>
                                <span class="legend-label">Menunggu</span>
                                <span class="legend-val">12%</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot" style="background:#ef4444"></div>
                                <span class="legend-label">Ditolak</span>
                                <span class="legend-val">8%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card-header" style="border-top:1px solid var(--border)">
                        <div class="card-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                            Aksi Cepat
                        </div>
                    </div>
                    <div class="quick-actions">
                        <a class="qa-btn" href="#" onclick="setPage('management-user',document.querySelector('[onclick*=management-user]'))">
                            <div class="qa-ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                            </div>
                            <div>
                                <div class="qa-label">Tambah User</div>
                                <div class="qa-desc">Buat akun baru</div>
                            </div>
                        </a>
                        <a class="qa-btn" href="#" onclick="openModal('modalTambahIndustri')">
                            <div class="qa-ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><line x1="12" y1="4" x2="12" y2="2"/></svg>
                            </div>
                            <div>
                                <div class="qa-label">Tambah Industri</div>
                                <div class="qa-desc">Mitra baru</div>
                            </div>
                        </a>
                        <a class="qa-btn" href="#" onclick="setPage('absensi-pkl',document.querySelector('[onclick*=absensi-pkl]'))">
                            <div class="qa-ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            </div>
                            <div>
                                <div class="qa-label">Cek Absensi</div>
                                <div class="qa-desc">Hari ini</div>
                            </div>
                        </a>
                        <a class="qa-btn" href="#">
                            <div class="qa-ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            </div>
                            <div>
                                <div class="qa-label">Ekspor Laporan</div>
                                <div class="qa-desc">Download data</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- SISWA PKL PENDING + LOG -->
            <div class="grid-2 anim-in">
                <!-- Pengajuan PKL Terbaru -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            Pengajuan PKL Terbaru
                        </div>
                        <button class="btn btn-ghost btn-sm" onclick="setPage('siswa-pkl',document.querySelector('[onclick*=siswa-pkl]'))">Lihat Semua</button>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Industri</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><div class="user-cell"><div class="av av-purple">AN</div><div class="user-name">Aditya Nugraha</div></div></td>
                                    <td>PT. Jaya Tech</td>
                                    <td>TKJ</td>
                                    <td><span class="badge badge-warn"><span class="badge-dot"></span>Menunggu</span></td>
                                    <td><div style="display:flex;gap:6px"><button class="btn-icon" title="Setujui"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></button><button class="btn-icon" title="Tolak" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div></td>
                                </tr>
                                <tr>
                                    <td><div class="user-cell"><div class="av av-green">RI</div><div class="user-name">Rina Indriani</div></div></td>
                                    <td>CV. Maju Bersama</td>
                                    <td>RPL</td>
                                    <td><span class="badge badge-ok"><span class="badge-dot"></span>Diterima</span></td>
                                    <td><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button></td>
                                </tr>
                                <tr>
                                    <td><div class="user-cell"><div class="av av-amber">MS</div><div class="user-name">Muhammad Syarif</div></div></td>
                                    <td>PT. Sigma Digital</td>
                                    <td>AKL</td>
                                    <td><span class="badge badge-info"><span class="badge-dot"></span>Diproses</span></td>
                                    <td><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button></td>
                                </tr>
                                <tr>
                                    <td><div class="user-cell"><div class="av av-pink">FT</div><div class="user-name">Fitri Tazkia</div></div></td>
                                    <td>Bengkel Mandiri</td>
                                    <td>TBSM</td>
                                    <td><span class="badge badge-err"><span class="badge-dot"></span>Ditolak</span></td>
                                    <td><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button></td>
                                </tr>
                                <tr>
                                    <td><div class="user-cell"><div class="av av-blue">DH</div><div class="user-name">Dani Hermawan</div></div></td>
                                    <td>PT. Karya Utama</td>
                                    <td>TKJ</td>
                                    <td><span class="badge badge-warn"><span class="badge-dot"></span>Menunggu</span></td>
                                    <td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></button><button class="btn-icon" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Log Aktivitas -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Log Aktivitas
                        </div>
                        <button class="btn btn-ghost btn-sm" onclick="setPage('log-aktivitas',document.querySelector('[onclick*=log-aktivitas]'))">Lihat Semua</button>
                    </div>
                    <div class="log-item">
                        <div class="log-icon log-icon-add">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                        <div class="log-body">
                            <div class="log-text"><em>Admin</em> menambahkan akun guru baru: <em>Budi Santoso</em></div>
                            <div class="log-meta">Hari ini, 09.14 WIB</div>
                        </div>
                    </div>
                    <div class="log-item">
                        <div class="log-icon log-icon-edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </div>
                        <div class="log-body">
                            <div class="log-text"><em>Admin</em> mengubah data industri <em>PT. Jaya Tech</em></div>
                            <div class="log-meta">Hari ini, 08.55 WIB</div>
                        </div>
                    </div>
                    <div class="log-item">
                        <div class="log-icon log-icon-login">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        </div>
                        <div class="log-body">
                            <div class="log-text"><em>Sari Rahayu</em> (guru) login ke sistem</div>
                            <div class="log-meta">Hari ini, 08.30 WIB</div>
                        </div>
                    </div>
                    <div class="log-item">
                        <div class="log-icon log-icon-add">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                        <div class="log-body">
                            <div class="log-text"><em>Aditya Nugraha</em> (siswa) mengajukan PKL ke <em>PT. Jaya Tech</em></div>
                            <div class="log-meta">Kemarin, 16.45 WIB</div>
                        </div>
                    </div>
                    <div class="log-item">
                        <div class="log-icon log-icon-del">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                        </div>
                        <div class="log-body">
                            <div class="log-text"><em>Admin</em> menghapus data siswa tidak aktif: <em>2 akun</em></div>
                            <div class="log-meta">Kemarin, 14.20 WIB</div>
                        </div>
                    </div>
                    <div class="log-item">
                        <div class="log-icon log-icon-edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </div>
                        <div class="log-body">
                            <div class="log-text"><em>Admin</em> mengatur pembimbing PKL untuk <em>Kelas XII TKJ 1</em></div>
                            <div class="log-meta">Kemarin, 11.10 WIB</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ████ MANAGEMENT USER PAGE ████ -->
        <div id="page-management-user" style="display:none">
            <div class="section-header" style="display:flex;align-items:center;justify-content:space-between">
                <div>
                    <div class="section-title">Manajemen User</div>
                    <div class="section-desc">Kelola semua akun pengguna sistem SIMPKL</div>
                </div>
                <button class="btn btn-primary" onclick="openModal('modalTambahUser')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah User
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="tabs">
                        <button class="tab-btn active">Semua</button>
                        <button class="tab-btn">Guru Pembimbing</button>
                        <button class="tab-btn">Pembimbing Industri</button>
                        <button class="tab-btn">Admin</button>
                    </div>
                    <div class="topbar-search" style="margin-left:auto">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" placeholder="Cari user...">
                    </div>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Nama</th><th>Username</th><th>Role</th><th>Instansi</th><th>Status</th><th>Dibuat</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <tr><td><div class="user-cell"><div class="av av-purple">SR</div><div><div class="user-name">Sari Rahayu, S.Pd.</div><div class="user-sub">sari.rahayu@simpkl.id</div></div></div></td><td>s.rahayu</td><td><span class="badge badge-info">Guru</span></td><td>SMKN 1 Bandung</td><td><span class="badge badge-ok"><span class="badge-dot"></span>Aktif</span></td><td>12 Jan 2025</td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button><button class="btn-icon" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg></button></div></td></tr>
                            <tr><td><div class="user-cell"><div class="av av-green">BW</div><div><div class="user-name">Budi Wahyono, M.Pd.</div><div class="user-sub">b.wahyono@simpkl.id</div></div></div></td><td>b.wahyono</td><td><span class="badge badge-info">Guru</span></td><td>SMKN 1 Bandung</td><td><span class="badge badge-ok"><span class="badge-dot"></span>Aktif</span></td><td>12 Jan 2025</td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button><button class="btn-icon" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg></button></div></td></tr>
                            <tr><td><div class="user-cell"><div class="av av-amber">HK</div><div><div class="user-name">Hadi Kurniawan</div><div class="user-sub">h.kurniawan@ptjaya.com</div></div></div></td><td>hadi.pk</td><td><span class="badge badge-warn">Industri</span></td><td>PT. Jaya Tech</td><td><span class="badge badge-ok"><span class="badge-dot"></span>Aktif</span></td><td>5 Feb 2025</td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button><button class="btn-icon" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg></button></div></td></tr>
                            <tr><td><div class="user-cell"><div class="av av-red">DR</div><div><div class="user-name">Dewi Ratna</div><div class="user-sub">d.ratna@cvmaju.id</div></div></div></td><td>dewi.cvmaju</td><td><span class="badge badge-warn">Industri</span></td><td>CV. Maju Bersama</td><td><span class="badge badge-err"><span class="badge-dot"></span>Nonaktif</span></td><td>22 Mar 2025</td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button><button class="btn-icon" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg></button></div></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <button class="pg-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg></button>
                    <button class="pg-btn active">1</button>
                    <button class="pg-btn">2</button>
                    <button class="pg-btn">3</button>
                    <button class="pg-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></button>
                </div>
            </div>
        </div>

        <!-- ████ DATA SISWA PAGE ████ -->
        <div id="page-data-siswa" style="display:none">
            <div class="section-header" style="display:flex;align-items:center;justify-content:space-between">
                <div>
                    <div class="section-title">Data Siswa</div>
                    <div class="section-desc">Daftar seluruh siswa terdaftar dalam sistem SIMPKL</div>
                </div>
                <div style="display:flex;gap:10px">
                    <button class="btn btn-ghost">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export
                    </button>
                    <button class="btn btn-primary" onclick="openModal('modalTambahSiswa')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Tambah Siswa
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="tabs">
                        <button class="tab-btn active">Semua</button>
                        <button class="tab-btn">TKJ</button>
                        <button class="tab-btn">RPL</button>
                        <button class="tab-btn">AKL</button>
                        <button class="tab-btn">TBSM</button>
                    </div>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Siswa</th><th>NIS</th><th>Kelas</th><th>Jurusan</th><th>Status PKL</th><th>Nilai</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <tr><td><div class="user-cell"><div class="av av-purple">AN</div><div><div class="user-name">Aditya Nugraha</div><div class="user-sub">aditya.n@siswa.id</div></div></div></td><td>2023001</td><td>XII TKJ 1</td><td>TKJ</td><td><span class="badge badge-warn">Menunggu</span></td><td>—</td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button></div></td></tr>
                            <tr><td><div class="user-cell"><div class="av av-green">RI</div><div><div class="user-name">Rina Indriani</div><div class="user-sub">rina.i@siswa.id</div></div></div></td><td>2023002</td><td>XII RPL 2</td><td>RPL</td><td><span class="badge badge-ok">Aktif PKL</span></td><td><span style="font-weight:700;color:var(--primary)">88.5</span></td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button></div></td></tr>
                            <tr><td><div class="user-cell"><div class="av av-amber">MS</div><div><div class="user-name">Muhammad Syarif</div><div class="user-sub">m.syarif@siswa.id</div></div></div></td><td>2023003</td><td>XII AKL 1</td><td>AKL</td><td><span class="badge badge-info">Diproses</span></td><td>—</td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button></div></td></tr>
                            <tr><td><div class="user-cell"><div class="av av-pink">FT</div><div><div class="user-name">Fitri Tazkia</div><div class="user-sub">fitri.t@siswa.id</div></div></div></td><td>2023004</td><td>XII TBSM 1</td><td>TBSM</td><td><span class="badge badge-err">Ditolak</span></td><td>—</td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button></div></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <button class="pg-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg></button>
                    <button class="pg-btn active">1</button><button class="pg-btn">2</button><button class="pg-btn">3</button><span style="padding:0 4px;color:var(--text-muted)">...</span><button class="pg-btn">12</button>
                    <button class="pg-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></button>
                </div>
            </div>
        </div>

        <!-- ████ DATA INDUSTRI PAGE ████ -->
        <div id="page-data-industri" style="display:none">
            <div class="section-header" style="display:flex;align-items:center;justify-content:space-between">
                <div>
                    <div class="section-title">Data Industri</div>
                    <div class="section-desc">Daftar mitra industri tempat PKL siswa</div>
                </div>
                <button class="btn btn-primary" onclick="openModal('modalTambahIndustri')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Industri
                </button>
            </div>
            <div class="stats-grid" style="grid-template-columns:repeat(3,1fr)">
                <div class="stat-card stat-card-1"><div class="stat-icon stat-icon-1"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div><div class="stat-info"><div class="stat-num">58</div><div class="stat-label">Total Industri Mitra</div></div></div>
                <div class="stat-card stat-card-2"><div class="stat-icon stat-icon-2"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div><div class="stat-info"><div class="stat-num">52</div><div class="stat-label">Industri Aktif</div></div></div>
                <div class="stat-card stat-card-3"><div class="stat-icon stat-icon-3"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div><div class="stat-info"><div class="stat-num">247</div><div class="stat-label">Siswa Ditempatkan</div></div></div>
            </div>
            <div class="card">
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Nama Industri</th><th>Bidang</th><th>Alamat</th><th>Kuota</th><th>Terisi</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <tr><td><div class="user-cell"><div class="av av-blue" style="border-radius:10px">JT</div><div><div class="user-name">PT. Jaya Tech</div><div class="user-sub">info@ptjaya.com</div></div></div></td><td>Teknologi Informasi</td><td>Jl. Sudirman No.12, Bandung</td><td>10</td><td><div style="display:flex;align-items:center;gap:8px"><div style="flex:1;height:6px;background:var(--primary-soft);border-radius:4px"><div style="width:90%;height:100%;background:var(--grad);border-radius:4px"></div></div><span style="font-size:.75rem;font-weight:700;color:var(--text)">9</span></div></td><td><span class="badge badge-warn">Hampir Penuh</span></td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button><button class="btn-icon" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg></button></div></td></tr>
                            <tr><td><div class="user-cell"><div class="av av-green" style="border-radius:10px">MB</div><div><div class="user-name">CV. Maju Bersama</div><div class="user-sub">hr@cvmaju.id</div></div></div></td><td>Perbankan & Keuangan</td><td>Jl. Asia Afrika No.45, Bandung</td><td>15</td><td><div style="display:flex;align-items:center;gap:8px"><div style="flex:1;height:6px;background:var(--primary-soft);border-radius:4px"><div style="width:53%;height:100%;background:linear-gradient(90deg,#22c55e,#16a34a);border-radius:4px"></div></div><span style="font-size:.75rem;font-weight:700;color:var(--text)">8</span></div></td><td><span class="badge badge-ok">Tersedia</span></td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button><button class="btn-icon" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg></button></div></td></tr>
                            <tr><td><div class="user-cell"><div class="av av-amber" style="border-radius:10px">SD</div><div><div class="user-name">PT. Sigma Digital</div><div class="user-sub">pkl@sigma.id</div></div></div></td><td>Multimedia & Desain</td><td>Jl. Braga No.8, Bandung</td><td>8</td><td><div style="display:flex;align-items:center;gap:8px"><div style="flex:1;height:6px;background:var(--primary-soft);border-radius:4px"><div style="width:100%;height:100%;background:linear-gradient(90deg,#ef4444,#dc2626);border-radius:4px"></div></div><span style="font-size:.75rem;font-weight:700;color:#ef4444">8</span></div></td><td><span class="badge badge-err">Penuh</span></td><td><div style="display:flex;gap:6px"><button class="btn-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button><button class="btn-icon" style="background:rgba(239,68,68,.1);color:#ef4444"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg></button></div></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ████ LOG AKTIVITAS PAGE ████ -->
        <div id="page-log-aktivitas" style="display:none">
            <div class="section-header" style="display:flex;align-items:center;justify-content:space-between">
                <div>
                    <div class="section-title">Log Aktivitas</div>
                    <div class="section-desc">Rekam jejak seluruh aktivitas semua pengguna sistem</div>
                </div>
                <button class="btn btn-ghost">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Export Log
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="tabs">
                        <button class="tab-btn active">Semua</button>
                        <button class="tab-btn">Admin</button>
                        <button class="tab-btn">Guru</button>
                        <button class="tab-btn">Siswa</button>
                        <button class="tab-btn">Industri</button>
                    </div>
                </div>
                <div class="log-item"><div class="log-icon log-icon-login"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg></div><div class="log-body"><div class="log-text"><em>Admin</em> login ke sistem dari IP 192.168.1.1</div><div class="log-meta">Hari ini · 09.22 WIB · Admin</div></div></div>
                <div class="log-item"><div class="log-icon log-icon-add"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div><div class="log-body"><div class="log-text"><em>Admin</em> menambahkan akun guru baru: <em>Budi Santoso, S.Kom.</em></div><div class="log-meta">Hari ini · 09.14 WIB · Admin</div></div></div>
                <div class="log-item"><div class="log-icon log-icon-edit"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div><div class="log-body"><div class="log-text"><em>Admin</em> mengubah kuota mitra <em>PT. Jaya Tech</em> dari 8 → 10</div><div class="log-meta">Hari ini · 08.55 WIB · Admin</div></div></div>
                <div class="log-item"><div class="log-icon log-icon-login"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg></div><div class="log-body"><div class="log-text"><em>Sari Rahayu</em> login ke sistem</div><div class="log-meta">Hari ini · 08.30 WIB · Guru</div></div></div>
                <div class="log-item"><div class="log-icon log-icon-add"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></div><div class="log-body"><div class="log-text"><em>Aditya Nugraha</em> mengajukan PKL ke <em>PT. Jaya Tech</em></div><div class="log-meta">Kemarin · 16.45 WIB · Siswa</div></div></div>
                <div class="log-item"><div class="log-icon log-icon-edit"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div><div class="log-body"><div class="log-text"><em>Hadi Kurniawan</em> (industri) memvalidasi jurnal <em>Rina Indriani</em></div><div class="log-meta">Kemarin · 14.10 WIB · Industri</div></div></div>
                <div class="log-item"><div class="log-icon log-icon-del"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg></div><div class="log-body"><div class="log-text"><em>Admin</em> menghapus 2 akun siswa tidak aktif</div><div class="log-meta">Kemarin · 14.20 WIB · Admin</div></div></div>
                <div class="pagination">
                    <button class="pg-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg></button>
                    <button class="pg-btn active">1</button><button class="pg-btn">2</button><button class="pg-btn">3</button>
                    <button class="pg-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg></button>
                </div>
            </div>
        </div>

        <!-- ████ OTHER PAGES (generic placeholder) ████ -->
        <div id="page-data-guru" style="display:none">
            <div class="section-header"><div class="section-title">Data Guru Pembimbing</div><div class="section-desc">Daftar guru pembimbing dan penugasan siswa PKL</div></div>
            <div class="card"><div style="padding:48px;text-align:center;color:var(--text-muted)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48" style="margin:0 auto 12px;display:block;opacity:.4"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg><div style="font-weight:600;font-size:.9rem">Halaman Data Guru</div><div style="font-size:.8rem;margin-top:4px">Konten tabel guru pembimbing ada di sini</div></div></div>
        </div>
        <div id="page-siswa-pkl" style="display:none">
            <div class="section-header"><div class="section-title">Siswa PKL</div><div class="section-desc">Kelola penempatan dan pembimbing siswa yang sedang PKL</div></div>
            <div class="card"><div style="padding:48px;text-align:center;color:var(--text-muted)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48" style="margin:0 auto 12px;display:block;opacity:.4"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg><div style="font-weight:600;font-size:.9rem">Halaman Siswa PKL</div><div style="font-size:.8rem;margin-top:4px">Tabel siswa yang sedang aktif menjalani PKL</div></div></div>
        </div>
        <div id="page-absensi-pkl" style="display:none">
            <div class="section-header"><div class="section-title">Absensi PKL</div><div class="section-desc">Rekap kehadiran siswa dari jurnal harian</div></div>
            <div class="card"><div style="padding:48px;text-align:center;color:var(--text-muted)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48" style="margin:0 auto 12px;display:block;opacity:.4"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg><div style="font-weight:600;font-size:.9rem">Halaman Absensi PKL</div><div style="font-size:.8rem;margin-top:4px">Rekap kehadiran berdasarkan jurnal harian siswa</div></div></div>
        </div>
        <div id="page-bimbingan-pkl" style="display:none">
            <div class="section-header"><div class="section-title">Bimbingan PKL</div><div class="section-desc">Pantau catatan bimbingan guru dengan siswa</div></div>
            <div class="card"><div style="padding:48px;text-align:center;color:var(--text-muted)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48" style="margin:0 auto 12px;display:block;opacity:.4"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg><div style="font-weight:600;font-size:.9rem">Halaman Bimbingan PKL</div><div style="font-size:.8rem;margin-top:4px">Log bimbingan dan catatan revisi guru-siswa</div></div></div>
        </div>
        <div id="page-kompetensi" style="display:none">
            <div class="section-header"><div class="section-title">Kompetensi</div><div class="section-desc">Kelola daftar kompetensi penilaian PKL</div></div>
            <div class="card"><div style="padding:48px;text-align:center;color:var(--text-muted)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48" style="margin:0 auto 12px;display:block;opacity:.4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><div style="font-weight:600;font-size:.9rem">Halaman Kompetensi</div><div style="font-size:.8rem;margin-top:4px">Master kompetensi yang dinilai dalam PKL</div></div></div>
        </div>
        <div id="page-nilai-pkl" style="display:none">
            <div class="section-header"><div class="section-title">Nilai PKL</div><div class="section-desc">Rekap nilai akhir siswa dari guru dan pembimbing industri</div></div>
            <div class="card"><div style="padding:48px;text-align:center;color:var(--text-muted)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48" style="margin:0 auto 12px;display:block;opacity:.4"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg><div style="font-weight:600;font-size:.9rem">Halaman Nilai PKL</div><div style="font-size:.8rem;margin-top:4px">Rekap dan analitik nilai PKL seluruh siswa</div></div></div>
        </div>
    </main>
</div>

<!-- ══════════════ MODALS ══════════════ -->
<!-- Modal Tambah User -->
<div class="panel-overlay" id="modalTambahUser" onclick="closeModal(event,'modalTambahUser')">
    <div class="panel" onclick="event.stopPropagation()">
        <div class="panel-header">
            <div class="panel-title">Tambah Akun User Baru</div>
            <button class="panel-close" onclick="closeModalById('modalTambahUser')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="form-grid">
            <div class="form-field"><label class="form-label">Nama Lengkap</label><input class="form-input" type="text" placeholder="e.g. Sari Rahayu, S.Pd."></div>
            <div class="form-field"><label class="form-label">Username</label><input class="form-input" type="text" placeholder="e.g. s.rahayu"></div>
        </div>
        <div class="form-field"><label class="form-label">Email</label><input class="form-input" type="email" placeholder="user@simpkl.id"></div>
        <div class="form-grid">
            <div class="form-field"><label class="form-label">Role</label><select class="form-input form-select"><option>Guru Pembimbing</option><option>Pembimbing Industri</option><option>Admin</option></select></div>
            <div class="form-field"><label class="form-label">Instansi</label><input class="form-input" type="text" placeholder="Nama sekolah / perusahaan"></div>
        </div>
        <div class="form-field"><label class="form-label">Password Awal</label><input class="form-input" type="password" placeholder="Min. 8 karakter"></div>
        <div class="panel-actions">
            <button class="btn btn-cancel btn-ghost" onclick="closeModalById('modalTambahUser')">Batal</button>
            <button class="btn btn-primary">Buat Akun</button>
        </div>
    </div>
</div>

<!-- Modal Tambah Industri -->
<div class="panel-overlay" id="modalTambahIndustri" onclick="closeModal(event,'modalTambahIndustri')">
    <div class="panel" onclick="event.stopPropagation()">
        <div class="panel-header">
            <div class="panel-title">Tambah Mitra Industri</div>
            <button class="panel-close" onclick="closeModalById('modalTambahIndustri')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="form-field"><label class="form-label">Nama Industri</label><input class="form-input" type="text" placeholder="e.g. PT. Contoh Makmur"></div>
        <div class="form-grid">
            <div class="form-field"><label class="form-label">Bidang Usaha</label><select class="form-input form-select"><option>Teknologi Informasi</option><option>Perbankan & Keuangan</option><option>Multimedia & Desain</option><option>Otomotif</option><option>Manufaktur</option></select></div>
            <div class="form-field"><label class="form-label">Kuota Siswa</label><input class="form-input" type="number" placeholder="e.g. 10" min="1"></div>
        </div>
        <div class="form-field"><label class="form-label">Alamat</label><input class="form-input" type="text" placeholder="Jl. Contoh No.1, Kota"></div>
        <div class="form-grid">
            <div class="form-field"><label class="form-label">No. Telepon</label><input class="form-input" type="tel" placeholder="08xx-xxxx-xxxx"></div>
            <div class="form-field"><label class="form-label">Email Kontak</label><input class="form-input" type="email" placeholder="pkl@industri.id"></div>
        </div>
        <div class="panel-actions">
            <button class="btn btn-cancel btn-ghost" onclick="closeModalById('modalTambahIndustri')">Batal</button>
            <button class="btn btn-primary">Simpan Industri</button>
        </div>
    </div>
</div>

<!-- Modal Tambah Siswa -->
<div class="panel-overlay" id="modalTambahSiswa" onclick="closeModal(event,'modalTambahSiswa')">
    <div class="panel" onclick="event.stopPropagation()">
        <div class="panel-header">
            <div class="panel-title">Tambah Data Siswa</div>
            <button class="panel-close" onclick="closeModalById('modalTambahSiswa')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="form-grid">
            <div class="form-field"><label class="form-label">Nama Lengkap</label><input class="form-input" type="text" placeholder="Nama siswa"></div>
            <div class="form-field"><label class="form-label">NIS</label><input class="form-input" type="text" placeholder="e.g. 2023001"></div>
        </div>
        <div class="form-grid">
            <div class="form-field"><label class="form-label">Kelas</label><input class="form-input" type="text" placeholder="e.g. XII TKJ 1"></div>
            <div class="form-field"><label class="form-label">Jurusan</label><select class="form-input form-select"><option>TKJ</option><option>RPL</option><option>AKL</option><option>TBSM</option></select></div>
        </div>
        <div class="form-field"><label class="form-label">Email Siswa</label><input class="form-input" type="email" placeholder="siswa@sekolah.id"></div>
        <div class="panel-actions">
            <button class="btn btn-cancel btn-ghost" onclick="closeModalById('modalTambahSiswa')">Batal</button>
            <button class="btn btn-primary">Simpan Siswa</button>
        </div>
    </div>
</div>

<script>
// ── SIDEBAR ──
let sidebarOpen = true;
function toggleSidebar() {
    sidebarOpen = !sidebarOpen;
    const s = document.getElementById('sidebar');
    const m = document.getElementById('mainWrap');
    if (sidebarOpen) {
        s.classList.remove('collapsed');
        m.classList.remove('sidebar-collapsed');
    } else {
        s.classList.add('collapsed');
        m.classList.add('sidebar-collapsed');
    }
}

// ── PAGES ──
const pageMap = {
    'dashboard': 'Dashboard',
    'management-user': 'Manajemen User',
    'data-siswa': 'Data Siswa',
    'data-guru': 'Data Guru',
    'data-industri': 'Data Industri',
    'siswa-pkl': 'Siswa PKL',
    'absensi-pkl': 'Absensi PKL',
    'bimbingan-pkl': 'Bimbingan PKL',
    'kompetensi': 'Kompetensi',
    'nilai-pkl': 'Nilai PKL',
    'log-aktivitas': 'Log Aktivitas'
};

function setPage(pageId, el) {
    document.querySelectorAll('[id^="page-"]').forEach(p => p.style.display = 'none');
    const target = document.getElementById('page-' + pageId);
    if (target) { target.style.display = 'block'; target.style.animation = 'fadeSlideUp .35s ease both'; }
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    if (el) el.classList.add('active');
    const label = pageMap[pageId] || pageId;
    document.getElementById('topbarTitle').textContent = label;
    document.getElementById('topbarBreadcrumb').textContent = label;
}

// ── THEME ──
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

// ── NOTIF ──
function toggleNotif() {
    document.getElementById('notifDropdown').classList.toggle('open');
}
document.addEventListener('click', e => {
    if (!document.getElementById('notifBtn').contains(e.target)) {
        document.getElementById('notifDropdown').classList.remove('open');
    }
});

// ── MODALS ──
function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModalById(id) { document.getElementById(id).classList.remove('open'); }
function closeModal(event, id) { if (event.target === document.getElementById(id)) closeModalById(id); }

// Escape key close modal
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { document.querySelectorAll('.panel-overlay.open').forEach(m => m.classList.remove('open')); }
});

// ── TABS (basic) ──
document.querySelectorAll('.tabs').forEach(tabGroup => {
    tabGroup.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            tabGroup.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
});
</script>
</body>
</html>
