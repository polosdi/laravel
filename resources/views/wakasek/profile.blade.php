<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMPKL Wakasek — Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}

        :root{--font:'Poppins','Segoe UI',system-ui,sans-serif;}

        [data-theme="light"]{
            --bg:#F8F9FA;--surface:#ffffff;
            --text:#1a1a2e;--text-muted:#6b7280;--text-sub:#9ca3af;
            --border:rgba(102,126,234,0.15);
            --card-bg:#ffffff;
            --grad:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            --primary:#667eea;
            --toggle-bg:rgba(102,126,234,0.1);
            --toggle-border:rgba(102,126,234,0.2);
            --sb-bg:#ffffff;--sb-border:rgba(102,126,234,0.12);
            --tag-bg:rgba(102,126,234,.06);
            --card-shadow:0 2px 12px rgba(102,126,234,.08);
        }

        [data-theme="dark"]{
            --bg:#0d0b1e;--surface:#1a1730;
            --text:#f0eeff;--text-muted:rgba(240,238,255,0.55);--text-sub:rgba(240,238,255,.35);
            --border:rgba(102,126,234,0.2);
            --card-bg:rgba(255,255,255,0.06);
            --grad:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            --primary:#8b9ff4;
            --toggle-bg:rgba(255,255,255,0.1);
            --toggle-border:rgba(255,255,255,0.15);
            --sb-bg:rgba(255,255,255,0.04);--sb-border:rgba(102,126,234,0.18);
            --tag-bg:rgba(102,126,234,.1);
            --card-shadow:0 2px 12px rgba(0,0,0,.3);
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
            transition:width .35s cubic-bezier(.4,0,.2,1),background .4s,border-color .4s;
        }
        .sidebar.collapsed{width:68px}

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
        .sb-nav::-webkit-scrollbar{width:3px}
        .sb-nav::-webkit-scrollbar-thumb{background:var(--sb-border);border-radius:3px}

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
        .logout-btn{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-radius:10px;
            color:var(--text-muted);font-weight:500;font-size:.825rem;
            transition:all .2s;cursor:pointer;
            border:1.5px solid rgba(239,68,68,.25);
            background:transparent;width:100%;font-family:var(--font);
        }
        .logout-btn:hover{background:rgba(239,68,68,.07);color:#ef4444;border-color:#ef4444}
        .logout-label{transition:opacity .25s,transform .25s;flex:1;text-align:left}
        .sidebar.collapsed .logout-label{opacity:0;transform:translateX(-8px)}

        /* ══ MAIN ══ */
        .main{
            margin-left:250px;flex:1;display:flex;flex-direction:column;min-height:100vh;
            transition:margin-left .35s cubic-bezier(.4,0,.2,1);
        }
        .sidebar.collapsed ~ .main{margin-left:68px}

        /* ══ TOPBAR ══ */
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

        .sb-toggle{
            width:36px;height:36px;border-radius:10px;
            background:rgba(102,126,234,.07);border:1px solid var(--border);
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;transition:all .2s;flex-shrink:0;
            flex-direction:column;gap:4px;padding:9px;
        }
        .sb-toggle:hover{border-color:var(--primary);background:rgba(102,126,234,.12)}
        .sb-toggle span{display:block;height:2px;border-radius:2px;background:var(--text-muted);transition:all .3s;width:100%;}
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
        .notif-btn:hover{border-color:var(--primary);color:var(--primary)}
        .notif-dot{
            position:absolute;top:7px;right:7px;
            width:6px;height:6px;background:#ef4444;
            border-radius:50%;border:1.5px solid var(--surface);
        }
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

        /* ══ PAGE ══ */
        .page{padding:26px 28px;flex:1}

        /* ══ ALERTS ══ */
        .al{padding:12px 16px;border-radius:10px;margin-bottom:18px;
            font-size:.825rem;font-weight:500;display:flex;align-items:center;gap:9px}
        .al-ok{background:rgba(34,197,94,.09);border:1px solid rgba(34,197,94,.22);color:#16a34a}
        .al-err{background:rgba(239,68,68,.09);border:1px solid rgba(239,68,68,.2);color:#dc2626}
        .al-info{background:rgba(102,126,234,.09);border:1px solid rgba(102,126,234,.2);color:var(--primary)}

        /* ══ PROFIL PAGE STYLES ══ */
        .page-header{margin-bottom:20px}
        .page-title{font-size:1.25rem;font-weight:800;color:var(--text)}
        .page-sub{font-size:.78rem;color:var(--text-muted);margin-top:3px}

        .profil-grid{
            display:grid;
            grid-template-columns:260px 1fr;
            gap:20px;align-items:start;
        }

        .profil-hero{
            grid-column:1 / -1;
            background:var(--card-bg);
            border:1px solid var(--border);
            border-radius:16px;padding:24px 28px;
            display:flex;align-items:center;gap:24px;
            position:relative;overflow:hidden;
        }
        .profil-hero::before{
            content:'';position:absolute;top:0;left:0;right:0;
            height:3px;background:var(--grad);
        }
        .profil-hero-avatar-wrap{position:relative;flex-shrink:0}
        .profil-hero-img{
            width:80px;height:80px;border-radius:50%;
            object-fit:cover;border:3px solid var(--border);display:block;
        }
        .profil-hero-initials{
            width:80px;height:80px;background:var(--grad);border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            font-weight:800;font-size:1.5rem;color:white;flex-shrink:0;
        }
        .profil-hero-upload-btn{
            position:absolute;bottom:-2px;right:-2px;
            width:26px;height:26px;background:var(--grad);
            border:2px solid var(--card-bg);border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;font-size:.65rem;transition:transform .2s;
        }
        .profil-hero-upload-btn:hover{transform:scale(1.1)}
        .profil-hero-info{flex:1;min-width:0}
        .profil-hero-name{font-size:1.15rem;font-weight:800;color:var(--text);line-height:1.2}
        .profil-hero-meta{display:flex;align-items:center;gap:12px;margin-top:6px;flex-wrap:wrap}
        .profil-hero-badge{
            display:inline-flex;align-items:center;gap:5px;
            padding:3px 10px;border-radius:20px;font-size:.68rem;font-weight:700;
            background:rgba(102,126,234,.1);color:var(--primary);
        }
        .profil-hero-sep{color:var(--border);font-size:.8rem}
        .profil-hero-sub{font-size:.75rem;color:var(--text-muted)}
        .profil-hero-nip{margin-top:10px;display:flex;align-items:center;gap:6px;font-size:.72rem}
        .profil-hero-nip-label{color:var(--text-muted)}
        .profil-hero-nip-val{font-weight:700;color:var(--text);font-family:monospace;font-size:.8rem}

        .form-section-label{
            font-size:.65rem;font-weight:700;letter-spacing:.07em;
            text-transform:uppercase;color:var(--text-sub);
            margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid var(--border);
        }
        .form-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:22px}
        .form-grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-bottom:22px}
        .col-full{grid-column:1 / -1}

        .form-group{display:flex;flex-direction:column;gap:5px}
        .form-label{font-size:.75rem;font-weight:600;color:var(--text-muted)}
        .form-label span{color:var(--primary)}
        .form-control{
            padding:9px 12px;border-radius:10px;border:1.5px solid var(--border);
            background:var(--bg);color:var(--text);font-size:.82rem;
            font-family:var(--font);transition:border-color .18s,box-shadow .18s;
            outline:none;width:100%;
        }
        .form-control:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(102,126,234,.12)}
        .form-control:disabled{background:var(--tag-bg);color:var(--text-muted);cursor:not-allowed}
        .form-control.is-invalid{border-color:#ef4444}
        .invalid-feedback{font-size:.7rem;color:#ef4444;margin-top:2px}
        .form-hint{font-size:.68rem;color:var(--text-sub);margin-top:2px}
        select.form-control{cursor:pointer}
        textarea.form-control{resize:vertical}

        .pcard{background:var(--card-bg);border:1px solid var(--border);border-radius:14px;overflow:hidden}
        .pcard-header{
            padding:14px 20px;border-bottom:1px solid var(--border);
            display:flex;align-items:center;gap:8px;
            font-size:.82rem;font-weight:700;color:var(--text);
        }
        .pcard-body{padding:20px}

        .form-footer{
            display:flex;gap:10px;justify-content:flex-end;
            padding-top:6px;border-top:1px solid var(--border);margin-top:4px;
        }

        .btn-primary{
            display:inline-flex;align-items:center;gap:7px;padding:9px 18px;
            background:var(--grad);color:white;border:none;border-radius:10px;
            font-size:.8rem;font-weight:600;font-family:var(--font);
            cursor:pointer;transition:opacity .2s,transform .2s;
        }
        .btn-primary:hover{opacity:.88;transform:translateY(-1px)}
        .btn-secondary{
            display:inline-flex;align-items:center;gap:7px;padding:9px 18px;
            background:transparent;color:var(--text-muted);
            border:1.5px solid var(--border);border-radius:10px;
            font-size:.8rem;font-weight:600;font-family:var(--font);cursor:pointer;transition:all .2s;
        }
        .btn-secondary:hover{border-color:var(--primary);color:var(--primary)}

        @media(max-width:960px){
            .profil-grid{grid-template-columns:1fr}
            .form-grid-3{grid-template-columns:1fr 1fr}
        }
        @media(max-width:600px){
            .profil-hero{flex-direction:column;text-align:center}
            .profil-hero-meta{justify-content:center}
            .form-grid-2,.form-grid-3{grid-template-columns:1fr}
            .page{padding:16px}
        }
    </style>
</head>
<body>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar" id="sidebar">
    <div class="sb-user">
        <div class="sb-avatar">
            @php $profil = auth()->user()->profilWakasek; @endphp
            @if($profil?->foto_profil)
                <img src="{{ asset('storage/'.$profil->foto_profil) }}" alt="foto"
                     style="width:100%;height:100%;border-radius:50%;object-fit:cover">
            @else
                {{ strtoupper(substr(auth()->user()->nama_depan,0,1).substr(auth()->user()->nama_belakang,0,1)) }}
            @endif
        </div>
        <div class="sb-uinfo">
            <div class="sb-uname">{{ auth()->user()->nama_depan }} {{ auth()->user()->nama_belakang }}</div>
            <div class="sb-urole">Wakil Kepala Sekolah</div>
        </div>
    </div>

    <nav class="sb-nav">
        <div class="nav-grp">Utama</div>
        <a href="{{ route('wakasek.dashboard') }}" data-tip="Dashboard"
           class="nav-a {{ request()->routeIs('wakasek.dashboard') ? 'active' : '' }}">
            <span class="nav-ic"><i class="fa-solid fa-gauge"></i></span>
            <span class="nav-label">Dashboard</span>
        </a>

        <div class="nav-grp" style="margin-top:8px">Kelola PKL</div>
        <a href="{{ route('wakasek.siswa.index') }}" data-tip="Data Siswa"
           class="nav-a {{ request()->routeIs('wakasek.siswa.*') ? 'active' : '' }}">
            <span class="nav-ic"><i class="fa-solid fa-users"></i></span>
            <span class="nav-label">Data Siswa</span>
        </a>

        <a href="{{ route('wakasek.pkl.index') }}" data-tip="Pengajuan PKL"
           class="nav-a {{ request()->routeIs('wakasek.pkl.*') ? 'active' : '' }}">
            <span class="nav-ic"><i class="fa-solid fa-file-circle-plus"></i></span>
            <span class="nav-label">Pengajuan PKL</span>
            @php
                $pendingPkl = \App\Models\PklPengajuan::where('status_wakasek','pending')->count();
            @endphp
            @if($pendingPkl > 0)<span class="nav-badge">{{ $pendingPkl }}</span>@endif
        </a>

        <a href="{{ route('wakasek.pembimbing.index') }}" data-tip="Data Pembimbing"
           class="nav-a {{ request()->routeIs('wakasek.pembimbing.*') ? 'active' : '' }}">
            <span class="nav-ic"><i class="fa-solid fa-chalkboard-user"></i></span>
            <span class="nav-label">Data Pembimbing</span>
        </a>

        <div class="nav-grp" style="margin-top:8px">Laporan</div>
        <a href="{{ route('wakasek.laporan.index') }}" data-tip="Laporan PKL"
           class="nav-a {{ request()->routeIs('wakasek.laporan.*') ? 'active' : '' }}">
            <span class="nav-ic"><i class="fa-solid fa-file-lines"></i></span>
            <span class="nav-label">Laporan PKL</span>
        </a>

        <a href="{{ route('wakasek.nilai.index') }}" data-tip="Rekap Nilai"
           class="nav-a {{ request()->routeIs('wakasek.nilai.*') ? 'active' : '' }}">
            <span class="nav-ic"><i class="fa-solid fa-star"></i></span>
            <span class="nav-label">Rekap Nilai</span>
        </a>

        <div class="nav-grp" style="margin-top:8px">Akun</div>
        <a href="{{ route('wakasek.profil') }}" data-tip="Profil Saya"
           class="nav-a active">
            <span class="nav-ic"><i class="fa-solid fa-user-pen"></i></span>
            <span class="nav-label">Profil Saya</span>
        </a>

        <a href="{{ route('wakasek.log.index') }}" data-tip="Log Aktivitas"
           class="nav-a {{ request()->routeIs('wakasek.log.*') ? 'active' : '' }}">
            <span class="nav-ic"><i class="fa-solid fa-clock-rotate-left"></i></span>
            <span class="nav-label">Log Aktivitas</span>
        </a>
    </nav>

    <div class="sb-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket" style="flex-shrink:0;font-size:.82rem"></i>
                <span class="logout-label">Keluar</span>
            </button>
        </form>
    </div>
</aside>

{{-- ── MAIN ── --}}
<div class="main" id="main">
    <header class="topbar">
        <div class="topbar-left">
            <div class="sb-toggle open" id="sidebarToggle" onclick="toggleSidebar()">
                <span></span><span></span><span></span>
            </div>
            <div class="topbar-title">Profil Saya</div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
            <div class="notif-btn"><i class="fa-solid fa-bell" style="font-size:.85rem"></i><span class="notif-dot"></span></div>
            <div class="theme-toggle" onclick="toggleTheme()" title="Ganti tema">
                <div class="toggle-thumb">
                    <i id="ico-sun"  class="fa-solid fa-sun"  style="font-size:9px;color:rgba(255,255,255,.95)"></i>
                    <i id="ico-moon" class="fa-solid fa-moon" style="font-size:9px;color:rgba(255,255,255,.95);display:none"></i>
                </div>
            </div>
        </div>
    </header>

    <main class="page">
        @if(session('success'))
            <div class="al al-ok"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="al al-err"><i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}</div>
        @endif

        <div class="page-header">
            <div class="page-title">Profil Saya</div>
            <div class="page-sub">Kelola informasi akun dan data diri Anda</div>
        </div>

        <div class="profil-grid">

            {{-- ── HERO BANNER ── --}}
            <div class="profil-hero">
                <div class="profil-hero-avatar-wrap">
                    @if($profil?->foto_profil)
                        <img src="{{ asset('storage/'.$profil->foto_profil) }}" alt="foto" class="profil-hero-img">
                    @else
                        <div class="profil-hero-initials">
                            {{ strtoupper(substr(auth()->user()->nama_depan,0,1).substr(auth()->user()->nama_belakang,0,1)) }}
                        </div>
                    @endif
                    <form action="{{ route('wakasek.profil.foto') }}" method="POST" enctype="multipart/form-data" id="fotoForm">
                        @csrf @method('PUT')
                        <label for="fotoInput" class="profil-hero-upload-btn" title="Ganti foto">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                        </label>
                        <input type="file" id="fotoInput" name="foto_profil" accept="image/*"
                               style="display:none" onchange="document.getElementById('fotoForm').submit()">
                    </form>
                </div>

                <div class="profil-hero-info">
                    <div class="profil-hero-name">{{ auth()->user()->nama_depan }} {{ auth()->user()->nama_belakang }}</div>
                    <div class="profil-hero-meta">
                        <span class="profil-hero-badge">Wakil Kepala Sekolah</span>
                        @if($profil?->bidang)
                            <span class="profil-hero-sep">·</span>
                            <span class="profil-hero-sub">{{ $profil->bidang }}</span>
                        @endif
                    </div>
                    <div class="profil-hero-nip">
                        <span class="profil-hero-nip-label">NIP</span>
                        <span class="profil-hero-nip-val">{{ $profil?->nip ?? '—' }}</span>
                    </div>
                </div>
            </div>

            {{-- ── KOLOM KIRI: Ganti Password ── --}}
            <div>
                <div class="pcard">
                    <div class="pcard-header">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px;flex-shrink:0"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Ganti Password
                    </div>
                    <div class="pcard-body">
                        <form action="{{ route('wakasek.profil.password') }}" method="POST">
                            @csrf @method('PUT')

                            <div class="form-group" style="margin-bottom:12px">
                                <label class="form-label">Password Lama</label>
                                <input type="password" name="password_lama"
                                       class="form-control {{ $errors->has('password_lama') ? 'is-invalid' : '' }}"
                                       placeholder="••••••••" required>
                                @error('password_lama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-bottom:12px">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="password_baru"
                                       class="form-control" placeholder="Min 8 karakter" required>
                            </div>

                            <div class="form-group" style="margin-bottom:16px">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_baru_confirmation"
                                       class="form-control" placeholder="Ulangi password baru" required>
                            </div>

                            <button type="submit" class="btn-primary" style="width:100%;justify-content:center">
                                Simpan Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ── KOLOM KANAN: Form Data Diri ── --}}
            <div class="pcard">
                <div class="pcard-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px;flex-shrink:0"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Data Diri
                </div>
                <div class="pcard-body">
                    <form action="{{ route('wakasek.profil.update') }}" method="POST">
                        @csrf @method('PUT')

                        {{-- AKUN --}}
                        <div class="form-section-label">Akun</div>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">Nama Depan <span>*</span></label>
                                <input type="text" name="nama_depan"
                                       class="form-control {{ $errors->has('nama_depan') ? 'is-invalid' : '' }}"
                                       value="{{ old('nama_depan', auth()->user()->nama_depan) }}" required>
                                @error('nama_depan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Belakang <span>*</span></label>
                                <input type="text" name="nama_belakang"
                                       class="form-control {{ $errors->has('nama_belakang') ? 'is-invalid' : '' }}"
                                       value="{{ old('nama_belakang', auth()->user()->nama_belakang) }}" required>
                                @error('nama_belakang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-full">
                                <label class="form-label">Email <span>*</span></label>
                                <input type="email" name="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                       value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- INFO JABATAN --}}
                        <div class="form-section-label">Info Jabatan</div>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">NIP</label>
                                <input type="text" class="form-control"
                                       value="{{ $profil?->nip ?? '—' }}" disabled>
                                <div class="form-hint">Diatur oleh admin</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bidang</label>
                                <input type="text" name="bidang" class="form-control"
                                       value="{{ old('bidang', $profil?->bidang) }}"
                                       placeholder="Kurikulum / Kesiswaan / Humas">
                            </div>
                        </div>

                        {{-- DATA PRIBADI --}}
                        <div class="form-section-label">Data Pribadi</div>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $profil?->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $profil?->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">No. HP</label>
                                <input type="text" name="no_hp" class="form-control"
                                       value="{{ old('no_hp', $profil?->no_hp) }}" placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"
                                       value="{{ old('tempat_lahir', $profil?->tempat_lahir) }}" placeholder="Bandung">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                       value="{{ old('tanggal_lahir', $profil?->tanggal_lahir?->format('Y-m-d')) }}">
                            </div>
                            <div class="form-group col-full">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat" rows="3" class="form-control"
                                          placeholder="Jl. Contoh No. 1, Kelurahan...">{{ old('alamat', $profil?->alamat) }}</textarea>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="reset" class="btn-secondary">Reset</button>
                            <button type="submit" class="btn-primary">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                Simpan Profil
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>{{-- end profil-grid --}}
    </main>
</div>{{-- end main --}}

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

/* ── SIDEBAR ── */
function toggleSidebar(){
    const sb=document.getElementById('sidebar');
    const btn=document.getElementById('sidebarToggle');
    const isCollapsed=sb.classList.toggle('collapsed');
    btn.classList.toggle('open',!isCollapsed);
    localStorage.setItem('simpkl-sidebar',isCollapsed?'collapsed':'open');
}
(function(){
    const state=localStorage.getItem('simpkl-sidebar');
    const sb=document.getElementById('sidebar');
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