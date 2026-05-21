<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Industri – SIMPKL</title>
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
            --card-bg: #ffffff;
            --sidebar-bg: #ffffff;
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
            --card-bg: rgba(255,255,255,0.06);
            --sidebar-bg: #13112a;
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
            background: var(--sidebar-bg);
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

        /* ─── MAIN ─── */
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
            background: var(--topbar-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 50;
        }
        .topbar-title { font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 800; }
        .topbar-sub { font-size: 13px; color: var(--text-muted); margin-top: 2px; }
        .topbar-right { display: flex; align-items: center; gap: 16px; }
        .topbar-date {
            font-size: 13px;
            color: var(--text-muted);
            background: white;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        /* ─── CONTENT ─── */
        .content { padding: 32px; }

        /* ─── PAGE HEADER ─── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .page-header-title {
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            font-weight: 800;
        }
        .page-header-sub { font-size: 14px; color: var(--text-muted); margin-top: 4px; }
        .badge-count {
            background: var(--gradient);
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* ─── SEARCH BAR ─── */
        .search-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }
        .search-input-wrap {
            position: relative;
            flex: 1;
        }
        .search-input-wrap span {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
        }
        .search-input {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            background: white;
            outline: none;
            transition: border 0.2s;
        }
        .search-input:focus { border-color: var(--primary); }

        /* ─── TABLE ─── */
        .card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 24px rgba(102,126,234,0.06);
            overflow: hidden;
        }
        .mitra-table {
            width: 100%;
            border-collapse: collapse;
        }
        .mitra-table th {
            background: rgba(102,126,234,0.05);
            padding: 14px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }
        .mitra-table td {
            padding: 14px 20px;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .mitra-table tr:last-child td { border-bottom: none; }
        .mitra-table tr:hover td { background: rgba(102,126,234,0.03); }

        .mitra-avatar {
            width: 42px; height: 42px;
            background: var(--gradient);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }
        .mitra-name-wrap { display: flex; align-items: center; gap: 12px; }
        .mitra-name { font-weight: 600; color: var(--text); }
        .mitra-website { font-size: 12px; color: var(--primary); margin-top: 2px; text-decoration: none; }
        .mitra-website:hover { text-decoration: underline; }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-mitra { background: rgba(102,126,234,0.1); color: var(--primary); }

        .alamat-cell {
            max-width: 220px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--text-muted);
            font-size: 13px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }
        .empty-state-icon { font-size: 48px; margin-bottom: 12px; }
        .empty-state-text { font-size: 15px; }

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
            <div class="sidebar-user-avatar">WK</div>
            <div>
                <div class="sidebar-user-name">Wakil Kepala Sekolah</div>
                <div class="sidebar-user-role">Wakil Kepala Sekolah</div>
            </div>
        </div>
    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Menu Utama</div>
        <a href="{{ route('wakasek.dashboard') }}" class="sidebar-item">
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
        <a href="{{ route('wakasek.mitra') }}" class="sidebar-item active">
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
            <div class="topbar-title">Mitra Industri</div>
            <div class="topbar-sub">Daftar seluruh mitra industri PKL</div>
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
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="page-header">
            <div>
                <div class="page-header-title">Mitra Industri</div>
                <div class="page-header-sub">Total {{ $daftarMitra->count() }} mitra industri terdaftar</div>
            </div>
            <span class="badge-count">{{ $daftarMitra->count() }} Mitra</span>
        </div>

        <!-- SEARCH -->
        <div class="search-bar">
            <div class="search-input-wrap">
                <span>🔍</span>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari nama perusahaan atau alamat...">
            </div>
        </div>

        <!-- TABLE -->
        <div class="card">
            <table class="mitra-table" id="mitraTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Perusahaan</th>
                        <th>Alamat</th>
                        <th>Website</th>
                        <th>Terdaftar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarMitra as $i => $mitra)
                    <tr>
                        <td style="color: var(--text-muted); font-size: 13px;">{{ $i + 1 }}</td>
                        <td>
                            <div class="mitra-name-wrap">
                                <div class="mitra-avatar">🏭</div>
                                <div>
                                    <div class="mitra-name">{{ $mitra->nama_perusahaan }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="alamat-cell" title="{{ $mitra->alamat_perusahaan }}">
                                {{ $mitra->alamat_perusahaan ?? '-' }}
                            </div>
                        </td>
                        <td>
                            @if($mitra->website)
                                <a href="{{ $mitra->website }}" target="_blank" class="mitra-website">
                                    🔗 {{ $mitra->website }}
                                </a>
                            @else
                                <span style="color: var(--text-muted);">-</span>
                            @endif
                        </td>
                        <td style="color: var(--text-muted); font-size: 13px;">
                            {{ \Carbon\Carbon::parse($mitra->created_at)->format('d M Y') }}
                        </td>
                        <td><span class="badge badge-mitra">✅ Aktif</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">🏭</div>
                                <div class="empty-state-text">Belum ada data mitra industri.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#mitraTable tbody tr');
        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
        });
    });

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