<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wakasek — SIMPKL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root { --font: 'Plus Jakarta Sans', 'Segoe UI', system-ui, sans-serif; }

        [data-theme="light"] {
            --bg: #F8F9FA;
            --surface: #ffffff;
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --border: rgba(102,126,234,0.15);
            --shadow: 0 20px 60px rgba(102,126,234,0.15);
            --topbar-bg: rgba(248,249,250,0.9);
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary: #667eea;
            --toggle-bg: rgba(102,126,234,0.1);
            --toggle-border: rgba(102,126,234,0.2);
        }

        [data-theme="dark"] {
            --bg: #0d0b1e;
            --surface: #1a1730;
            --text: #f0eeff;
            --text-muted: rgba(240,238,255,0.55);
            --border: rgba(102,126,234,0.2);
            --shadow: 0 20px 60px rgba(0,0,0,0.4);
            --topbar-bg: rgba(13,11,30,0.9);
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary: #8b9ff4;
            --toggle-bg: rgba(255,255,255,0.1);
            --toggle-border: rgba(255,255,255,0.15);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ─── NOISE TEXTURE OVERLAY ─── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 260px;
            background: var(--surface);
            border-right: 1px solid var(--border);
            z-index: 100;
            display: flex;
            flex-direction: column;
            padding: 0;
            box-shadow: 4px 0 30px rgba(102,126,234,0.06);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 28px 24px;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
        }

        .sidebar-logo-icon {
            width: 40px; height: 40px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sidebar-logo-text {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 16px;
            overflow-y: auto;
        }

        .sidebar-section-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 8px;
            margin: 16px 0 8px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }

        .sidebar-item:hover {
            background: rgba(102,126,234,0.08);
            color: var(--primary);
        }

        .sidebar-item.active {
            background: var(--gradient);
            color: white;
            font-weight: 600;
        }

        .sidebar-item-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            background: rgba(102,126,234,0.08);
            flex-shrink: 0;
        }

        .sidebar-item.active .sidebar-item-icon {
            background: rgba(255,255,255,0.2);
        }

        .sidebar-badge {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .sidebar-item.active .sidebar-badge {
            background: rgba(255,255,255,0.3);
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--border);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 12px;
            background: rgba(102,126,234,0.06);
        }

        .sidebar-user-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.3;
        }

        .sidebar-user-role {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .sidebar-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            padding: 9px 16px;
            background: rgba(239,68,68,0.08);
            color: #ef4444;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            gap: 6px;
        }

        .sidebar-logout:hover {
            background: rgba(239,68,68,0.15);
        }

        /* ─── MAIN CONTENT ─── */
        .main {
            margin-left: 260px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 20px 40px;
            background: var(--topbar-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text);
        }

        .topbar-sub {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-date {
            font-size: 0.82rem;
            color: var(--text-muted);
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 500;
        }

        .topbar-notif {
            width: 38px; height: 38px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }

        .topbar-notif:hover { border-color: var(--primary); }

        .notif-dot {
            position: absolute;
            top: 6px; right: 6px;
            width: 8px; height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid var(--bg);
        }

        /* ─── PAGE CONTENT ─── */
        .page-content {
            padding: 36px 40px;
        }

        /* ─── GREETING HERO ─── */
        .greeting-section {
            background: var(--gradient);
            border-radius: 24px;
            padding: 36px 40px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .greeting-section::before {
            content: '';
            position: absolute;
            top: -60px; right: -40px;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
        }

        .greeting-section::after {
            content: '';
            position: absolute;
            bottom: -80px; left: 30%;
            width: 250px; height: 250px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .greeting-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.25;
        }

        .greeting-orb-1 {
            width: 200px; height: 200px;
            background: radial-gradient(circle, #a78bfa, transparent);
            top: -50px; right: 200px;
            animation: floatOrb 8s ease-in-out infinite;
        }

        @keyframes floatOrb {
            0%, 100% { transform: translate(0,0) scale(1); }
            33% { transform: translate(20px,-20px) scale(1.05); }
            66% { transform: translate(-10px,15px) scale(0.95); }
        }

        .greeting-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            margin-bottom: 16px;
        }

        .greeting-badge::before {
            content: '';
            width: 7px; height: 7px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.4); }
        }

        .greeting-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .greeting-sub {
            color: rgba(255,255,255,0.75);
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }

        .greeting-stats {
            display: flex;
            gap: 24px;
            margin-top: 28px;
            position: relative;
            z-index: 1;
        }

        .greeting-stat {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 14px;
            padding: 16px 20px;
            min-width: 120px;
        }

        .greeting-stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
        }

        .greeting-stat-label {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.7);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ─── STAT CARDS ─── */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .stat-card:hover::before { transform: scaleX(1); }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(102,126,234,0.12);
            border-color: rgba(102,126,234,0.25);
        }

        .stat-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-card-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-card-icon.purple { background: linear-gradient(135deg, rgba(102,126,234,0.15), rgba(118,75,162,0.08)); border: 1px solid rgba(102,126,234,0.2); }
        .stat-card-icon.green  { background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(22,163,74,0.08)); border: 1px solid rgba(34,197,94,0.2); }
        .stat-card-icon.amber  { background: linear-gradient(135deg, rgba(245,158,11,0.15), rgba(217,119,6,0.08)); border: 1px solid rgba(245,158,11,0.2); }
        .stat-card-icon.pink   { background: linear-gradient(135deg, rgba(236,72,153,0.15), rgba(219,39,119,0.08)); border: 1px solid rgba(236,72,153,0.2); }
        .stat-card-icon.blue   { background: linear-gradient(135deg, rgba(59,130,246,0.15), rgba(37,99,235,0.08)); border: 1px solid rgba(59,130,246,0.2); }

        .stat-card-trend {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .trend-up { background: rgba(34,197,94,0.1); color: #16a34a; }
        .trend-down { background: rgba(239,68,68,0.1); color: #dc2626; }
        .trend-neutral { background: rgba(107,114,128,0.1); color: var(--text-muted); }

        .stat-card-num {
            font-family: 'Syne', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-card-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ─── GRID LAYOUT ─── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 24px;
            margin-bottom: 32px;
        }

        /* ─── CARDS ─── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title-icon {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, rgba(102,126,234,0.12), rgba(118,75,162,0.08));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .card-action {
            font-size: 0.78rem;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            padding: 6px 14px;
            background: rgba(102,126,234,0.08);
            border-radius: 20px;
            transition: all 0.2s;
        }

        .card-action:hover {
            background: rgba(102,126,234,0.15);
        }

        .card-body { padding: 20px 24px; }

        /* ─── PENGAJUAN LIST ─── */
        .pengajuan-list { display: flex; flex-direction: column; gap: 12px; }

        .pengajuan-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 14px;
            background: var(--bg);
            border: 1px solid var(--border);
            transition: all 0.2s;
        }

        .pengajuan-item:hover {
            border-color: rgba(102,126,234,0.3);
            background: rgba(102,126,234,0.03);
        }

        .pengajuan-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .pengajuan-info { flex: 1; min-width: 0; }

        .pengajuan-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }

        .pengajuan-perusahaan {
            font-size: 0.78rem;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pengajuan-tanggal {
            font-size: 0.72rem;
            color: var(--text-muted);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .status-badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.68rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .status-pending    { background: rgba(245,158,11,0.12); color: #d97706; }
        .status-disetujui  { background: rgba(34,197,94,0.12); color: #16a34a; }
        .status-ditolak    { background: rgba(239,68,68,0.12); color: #dc2626; }
        .status-valid      { background: rgba(34,197,94,0.12); color: #16a34a; }
        .status-tolak      { background: rgba(239,68,68,0.12); color: #dc2626; }
        .status-revisi     { background: rgba(59,130,246,0.12); color: #2563eb; }

        /* ─── LAPORAN LIST ─── */
        .laporan-list { display: flex; flex-direction: column; gap: 10px; }

        .laporan-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            background: var(--bg);
            border: 1px solid var(--border);
        }

        .laporan-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dot-pending   { background: #f59e0b; }
        .dot-disetujui { background: #22c55e; }
        .dot-revisi    { background: #3b82f6; }

        .laporan-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            flex: 1;
        }

        .laporan-jenis {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .laporan-status {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .laporan-pending   { background: rgba(245,158,11,0.12); color: #d97706; }
        .laporan-disetujui { background: rgba(34,197,94,0.12); color: #16a34a; }
        .laporan-revisi    { background: rgba(59,130,246,0.12); color: #2563eb; }

        /* ─── QUICK ACTIONS ─── */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .action-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .action-card:hover::before { transform: scaleX(1); }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(102,126,234,0.12);
            border-color: rgba(102,126,234,0.25);
        }

        .action-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin: 0 auto 14px;
            border: 1px solid rgba(102,126,234,0.15);
            background: linear-gradient(135deg, rgba(102,126,234,0.12), rgba(118,75,162,0.08));
        }

        .action-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }

        .action-desc {
            font-size: 0.75rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* ─── SISWA TABLE ─── */
        .siswa-table-wrap {
            overflow-x: auto;
        }

        .siswa-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.83rem;
        }

        .siswa-table th {
            text-align: left;
            padding: 10px 14px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            background: var(--bg);
        }

        .siswa-table td {
            padding: 12px 14px;
            border-bottom: 1px solid rgba(102,126,234,0.06);
            color: var(--text);
            vertical-align: middle;
        }

        .siswa-table tr:last-child td { border-bottom: none; }

        .siswa-table tr:hover td {
            background: rgba(102,126,234,0.03);
        }

        .siswa-name-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .siswa-mini-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.68rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        /* ─── PROGRESS BAR ─── */
        .progress-wrap {
            height: 6px;
            background: var(--bg);
            border-radius: 10px;
            overflow: hidden;
            min-width: 80px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            background: var(--gradient);
        }

        .progress-fill.green { background: linear-gradient(90deg, #22c55e, #16a34a); }
        .progress-fill.amber { background: linear-gradient(90deg, #f59e0b, #d97706); }
        .progress-fill.red   { background: linear-gradient(90deg, #ef4444, #dc2626); }

        /* ─── REVEAL ANIMATION ─── */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
        }

        .empty-state-icon {
            font-size: 2.5rem;
            margin-bottom: 12px;
        }

        .empty-state-text {
            font-size: 0.85rem;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1100px) {
            .content-grid { grid-template-columns: 1fr; }
            .stat-cards { grid-template-columns: repeat(2, 1fr); }
            .quick-actions { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .topbar, .page-content { padding: 16px 20px; }
            .stat-cards { grid-template-columns: 1fr 1fr; }
            .greeting-stats { flex-wrap: wrap; }
            .quick-actions { grid-template-columns: 1fr; }
        }

        /* ── THEME TOGGLE ── */
        .theme-toggle {
            width: 52px; height: 28px;
            background: var(--toggle-bg);
            border: 1px solid var(--toggle-border);
            border-radius: 50px;
            cursor: pointer;
            display: flex; align-items: center;
            padding: 3px;
            transition: all .3s;
            flex-shrink: 0;
        }
        .toggle-thumb {
            width: 20px; height: 20px;
            border-radius: 50%;
            background: var(--gradient);
            transition: transform .3s cubic-bezier(.34,1.4,.64,1);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 8px rgba(102,126,234,.4);
        }
        [data-theme="light"] .toggle-thumb { transform: translateX(0); }
        [data-theme="dark"]  .toggle-thumb { transform: translateX(24px); }
        .toggle-thumb svg { width: 11px; height: 11px; color: white; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ strtoupper(substr($wakasek->nama_depan ?? 'W', 0, 1)) }}{{ strtoupper(substr($wakasek->nama_belakang ?? 'K', 0, 1)) }}
            </div>
            <div>
                <div class="sidebar-user-name">{{ $wakasek->nama_depan ?? 'Wakasek' }} {{ $wakasek->nama_belakang ?? '' }}</div>
                <div class="sidebar-user-role">Wakil Kepala Sekolah</div>
            </div>
        </div>
    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Menu Utama</div>
        <a href="{{ route('wakasek.dashboard') }}" class="sidebar-item active">
            <div class="sidebar-item-icon">📊</div>
            Dashboard
        </a>
        <a href="{{ route('wakasek.pengajuan') }}" class="sidebar-item">
            <div class="sidebar-item-icon">📋</div>
            Pengajuan PKL
        </a>
        <a href="{{ route('wakasek.laporan') }}" class="sidebar-item">
            <div class="sidebar-item-icon">📄</div>
            Laporan PKL
        </a>
        <a href="{{ route('wakasek.absensi') }}" class="sidebar-item">
            <div class="sidebar-item-icon">📅</div>
            Rekap Absensi
        </a>
        <a href="{{ route('wakasek.nilai') }}" class="sidebar-item">
            <div class="sidebar-item-icon">⭐</div>
            Nilai PKL
        </a>
        <div class="sidebar-section-label">Data Master</div>
        <a href="{{ route('wakasek.siswa') }}" class="sidebar-item">
            <div class="sidebar-item-icon">👨‍🎓</div>
            Data Siswa
        </a>
        <a href="{{ route('wakasek.guru') }}" class="sidebar-item">
            <div class="sidebar-item-icon">👩‍🏫</div>
            Data Guru Pembimbing
        </a>
        <a href="{{ route('wakasek.mitra') }}" class="sidebar-item">
            <div class="sidebar-item-icon">🏭</div>
            Mitra Industri
        </a>
        <div class="sidebar-section-label">Lainnya</div>
        <a href="{{ route('wakasek.log') }}" class="sidebar-item">
            <div class="sidebar-item-icon">🗂️</div>
            Log Aktivitas
        </a>
    </nav>
    <div class="sidebar-footer">
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-logout" style="width:100%; border:none; cursor:pointer; font-family:inherit;">
                🚪 Keluar
            </button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<main class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <div class="topbar-title">Dashboard Wakasek</div>
            <div class="topbar-sub">Selamat datang, {{ $wakasek->nama_depan }} 👋</div>
        </div>
        <div class="topbar-right">
            <button class="theme-toggle" onclick="toggleTheme()" title="Ganti tema">
                <div class="toggle-thumb" id="thumb">
                    <svg id="ico-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </svg>
                    <svg id="ico-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                </div>
            </button>
            <div class="topbar-date">📅 {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
            <div class="topbar-notif">
                🔔
                @if(($pengajuanPending ?? 0) > 0 || ($laporanPending ?? 0) > 0)
                    <div class="notif-dot"></div>
                @endif
            </div>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="page-content">

        <!-- GREETING SECTION -->
        <div class="greeting-section reveal">
            <div class="greeting-orb greeting-orb-1"></div>
            <div class="greeting-badge">Wakil Kepala Sekolah — Aktif</div>
            <h1 class="greeting-title">
                Halo, {{ $wakasek->nama_depan }}! 🏫<br>
                Panel Monitoring PKL Sekolah
            </h1>
            <p class="greeting-sub">Pantau pengajuan PKL, laporan siswa, dan persetujuan secara real-time.</p>

            <div class="greeting-stats">
                <div class="greeting-stat">
                    <div class="greeting-stat-num" data-count="{{ $totalSiswaAktif ?? 0 }}">0</div>
                    <div class="greeting-stat-label">Siswa PKL Aktif</div>
                </div>
                <div class="greeting-stat">
                    <div class="greeting-stat-num" data-count="{{ $pengajuanPending ?? 0 }}">0</div>
                    <div class="greeting-stat-label">Pengajuan Menunggu</div>
                </div>
                <div class="greeting-stat">
                    <div class="greeting-stat-num" data-count="{{ $laporanPending ?? 0 }}">0</div>
                    <div class="greeting-stat-label">Laporan Perlu Disetujui</div>
                </div>
                <div class="greeting-stat">
                    <div class="greeting-stat-num">{{ $totalMitra ?? 0 }}</div>
                    <div class="greeting-stat-label">Mitra Industri</div>
                </div>
            </div>
        </div>

        <!-- STAT CARDS -->
        <div class="stat-cards">
            <div class="stat-card reveal">
                <div class="stat-card-header">
                    <div class="stat-card-icon purple">👨‍🎓</div>
                    <span class="stat-card-trend trend-neutral">Total</span>
                </div>
                <div class="stat-card-num" data-count="{{ $totalSiswa ?? 0 }}">{{ $totalSiswa ?? 0 }}</div>
                <div class="stat-card-label">Total Siswa Terdaftar</div>
            </div>

            <div class="stat-card reveal">
                <div class="stat-card-header">
                    <div class="stat-card-icon amber">⏳</div>
                    <span class="stat-card-trend trend-down">Perlu Aksi</span>
                </div>
                <div class="stat-card-num">{{ $pengajuanPending ?? 0 }}</div>
                <div class="stat-card-label">Pengajuan PKL Pending</div>
            </div>

            <div class="stat-card reveal">
                <div class="stat-card-header">
                    <div class="stat-card-icon green">✅</div>
                    <span class="stat-card-trend trend-up">Disetujui</span>
                </div>
                <div class="stat-card-num">{{ $pengajuanDisetujui ?? 0 }}</div>
                <div class="stat-card-label">Pengajuan Disetujui</div>
            </div>

            <div class="stat-card reveal">
                <div class="stat-card-header">
                    <div class="stat-card-icon pink">📄</div>
                    <span class="stat-card-trend trend-neutral">Proses</span>
                </div>
                <div class="stat-card-num">{{ $laporanPending ?? 0 }}</div>
                <div class="stat-card-label">Laporan Menunggu Persetujuan</div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="quick-actions reveal">
            <a href="{{ route('wakasek.pengajuan') }}" class="action-card">
                <div class="action-icon">📝</div>
                <div class="action-title">Setujui Pengajuan</div>
                <p class="action-desc">{{ $pengajuanPending ?? 0 }} pengajuan PKL menunggu persetujuan kamu</p>
            </a>
            <a href="{{ route('wakasek.laporan') }}" class="action-card">
                <div class="action-icon">📄</div>
                <div class="action-title">Setujui Laporan</div>
                <p class="action-desc">{{ $laporanPending ?? 0 }} laporan PKL menunggu persetujuan akhir</p>
            </a>
            <a href="{{ route('wakasek.absensi') }}" class="action-card">
                <div class="action-icon">📊</div>
                <div class="action-title">Rekap Kehadiran</div>
                <p class="action-desc">Pantau kehadiran seluruh siswa PKL bulan ini</p>
            </a>
        </div>

        <!-- CONTENT GRID -->
        <div class="content-grid">

            <!-- Pengajuan PKL Terbaru -->
            <div class="card reveal">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon">📝</div>
                        Pengajuan PKL Terbaru
                    </div>
                    <a href="{{ route('wakasek.pengajuan') }}" class="card-action">Lihat Semua →</a>
                </div>
                <div class="card-body">
                    @if(isset($pengajuanTerbaru) && $pengajuanTerbaru->count() > 0)
                        <div class="pengajuan-list">
                            @foreach($pengajuanTerbaru as $pengajuan)
                            <div class="pengajuan-item">
                                <div class="pengajuan-avatar">
                                    {{ strtoupper(substr($pengajuan->ketua->nama_depan ?? '?', 0, 1)) }}{{ strtoupper(substr($pengajuan->ketua->nama_belakang ?? '', 0, 1)) }}
                                </div>
                                <div class="pengajuan-info">
                                    <div class="pengajuan-name">{{ $pengajuan->ketua->nama_depan ?? '-' }} {{ $pengajuan->ketua->nama_belakang ?? '' }}</div>
                                    <div class="pengajuan-perusahaan">🏭 {{ $pengajuan->nama_perusahaan }}</div>
                                </div>
                                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px">
                                    <span class="status-badge status-{{ $pengajuan->status_wakasek }}">
                                        {{ ucfirst($pengajuan->status_wakasek) }}
                                    </span>
                                    <span class="pengajuan-tanggal">{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d M') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">📝</div>
                            <div class="empty-state-text">Belum ada pengajuan PKL yang masuk.</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Laporan PKL Terbaru -->
            <div class="card reveal">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-title-icon">📄</div>
                        Laporan Menunggu
                    </div>
                    <a href="{{ route('wakasek.laporan') }}" class="card-action">Semua →</a>
                </div>
                <div class="card-body">
                    @if(isset($laporanTerbaru) && $laporanTerbaru->count() > 0)
                        <div class="laporan-list">
                            @foreach($laporanTerbaru as $laporan)
                            <div class="laporan-item">
                                <div class="laporan-dot dot-{{ $laporan->status_wakasek }}"></div>
                                <div class="laporan-name">
                                    {{ $laporan->siswa->nama_depan ?? '-' }} {{ $laporan->siswa->nama_belakang ?? '' }}
                                </div>
                                <span class="laporan-jenis">{{ ucfirst($laporan->jenis_laporan) }}</span>
                                <span class="laporan-status laporan-{{ $laporan->status_wakasek }}">
                                    {{ ucfirst($laporan->status_wakasek) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">📄</div>
                            <div class="empty-state-text">Tidak ada laporan yang menunggu persetujuan.</div>
                        </div>
                    @endif

                    <!-- Progress persetujuan laporan -->
                    <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--border);">
                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;font-weight:600;color:var(--text-muted);margin-bottom:8px;">
                            <span>Tingkat Persetujuan Laporan</span>
                            <span>{{ $persentaseLaporanDisetujui ?? 0 }}%</span>
                        </div>
                        <div class="progress-wrap">
                            @php $pct = $persentaseLaporanDisetujui ?? 0; @endphp
                            <div class="progress-fill {{ $pct >= 80 ? 'green' : ($pct >= 50 ? 'amber' : 'red') }}"
                                 style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL SEMUA SISWA PKL -->
        <div class="card reveal">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon">👥</div>
                    Daftar Siswa PKL
                </div>
                <a href="{{ route('wakasek.siswa') }}" class="card-action">Lihat Semua →</a>
            </div>
            <div class="siswa-table-wrap">
                @if(isset($daftarSiswa) && $daftarSiswa->count() > 0)
                <table class="siswa-table">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Perusahaan PKL</th>
                            <th>Status Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daftarSiswa->take(8) as $siswa)
                        @php
                            $pengajuanSiswa = \App\Models\PklAnggota::where('siswa_id', $siswa->id)
                                ->with('pengajuan')
                                ->first();
                            $statusPengajuan = $pengajuanSiswa->pengajuan->status_wakasek ?? null;
                            $namaPKL = $pengajuanSiswa->pengajuan->nama_perusahaan ?? '-';
                        @endphp
                        <tr>
                            <td>
                                <div class="siswa-name-cell">
                                    <div class="siswa-mini-avatar">
                                        {{ strtoupper(substr($siswa->nama_depan ?? '?', 0, 1)) }}{{ strtoupper(substr($siswa->nama_belakang ?? '', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:600;font-size:0.83rem;">{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</div>
                                        <div style="font-size:0.72rem;color:var(--text-muted)">{{ $siswa->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="color:var(--text-muted);font-size:0.8rem;">{{ $siswa->profilSiswa->nis ?? '-' }}</td>
                            <td style="font-size:0.8rem;">{{ $siswa->profilSiswa->kelas ?? '-' }}</td>
                            <td style="font-size:0.8rem;">{{ $siswa->profilSiswa->jurusan ?? '-' }}</td>
                            <td style="font-size:0.8rem;">{{ $namaPKL }}</td>
                            <td>
                                @if($statusPengajuan)
                                    <span class="status-badge status-{{ $statusPengajuan }}">
                                        {{ ucfirst($statusPengajuan) }}
                                    </span>
                                @else
                                    <span class="status-badge status-pending">Belum Mengajukan</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">👥</div>
                        <div class="empty-state-text">Belum ada data siswa yang terdaftar.</div>
                    </div>
                @endif
            </div>
        </div>

    </div><!-- end page-content -->
</main>

<script>
    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    revealEls.forEach(el => observer.observe(el));

    // Counter animation
    function animateCounter(el) {
        const target = parseInt(el.dataset.count || el.textContent);
        if (isNaN(target)) return;
        const duration = 1200;
        const step = target / (duration / 16);
        let current = 0;
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = Math.floor(current);
            if (current >= target) {
                el.textContent = target;
                clearInterval(timer);
            }
        }, 16);
    }

    document.querySelectorAll('[data-count]').forEach(el => animateCounter(el));

    // Theme toggle
    function toggleTheme() {
        const html = document.documentElement;
        const isLight = html.getAttribute('data-theme') === 'light';
        html.setAttribute('data-theme', isLight ? 'dark' : 'light');
        document.getElementById('ico-sun').style.display  = isLight ? 'none'  : 'block';
        document.getElementById('ico-moon').style.display = isLight ? 'block' : 'none';
        localStorage.setItem('simpkl-theme', isLight ? 'dark' : 'light');
    }
    // Load saved theme
    const saved = localStorage.getItem('simpkl-theme');
    if (saved === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        document.getElementById('ico-sun').style.display  = 'none';
        document.getElementById('ico-moon').style.display = 'block';
    }
</script>
</body>
</html>