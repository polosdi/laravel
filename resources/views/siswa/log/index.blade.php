@extends('layouts.siswa')
@section('title','Log Aktivitas')
@section('page_title','Log Aktivitas')
@section('nav_log','active')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection

@section('styles')
/* ── LOG ITEM ── */
.log-list { list-style: none; }

.log-item {
    display: flex;
    gap: 16px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    transition: background .15s;
    position: relative;
}
.log-item:last-child { border-bottom: none; }
.log-item:hover { background: var(--sidebar-active); }

/* timeline line */
.log-item:not(:last-child) .log-timeline::after {
    content: '';
    position: absolute;
    left: 37px;
    top: 62px;
    bottom: 0;
    width: 1px;
    background: var(--border);
}

.log-timeline { flex-shrink: 0; position: relative; z-index: 1; }

.log-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: .82rem;
    flex-shrink: 0;
    border: 1px solid var(--border);
}
/* color per type */
.log-icon.type-login    { background: rgba(102,126,234,.12); color: #667eea; }
.log-icon.type-logout   { background: rgba(239,68,68,.1);   color: #ef4444; }
.log-icon.type-jurnal   { background: rgba(34,197,94,.1);   color: #22c55e; }
.log-icon.type-laporan  { background: rgba(245,158,11,.1);  color: #f59e0b; }
.log-icon.type-profil   { background: rgba(59,130,246,.1);  color: #3b82f6; }
.log-icon.type-pkl      { background: rgba(168,85,247,.1);  color: #a855f7; }
.log-icon.type-password { background: rgba(239,68,68,.1);   color: #ef4444; }
.log-icon.type-default  { background: var(--tag-bg);        color: var(--text-sub); }

.log-body { flex: 1; min-width: 0; }

.log-aktivitas {
    font-size: .83rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 5px;
    line-height: 1.45;
}

.log-meta {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}
.log-time {
    font-size: .7rem;
    color: var(--text-muted);
    display: flex; align-items: center; gap: 4px;
}
.log-time i { font-size: .62rem; opacity: .7; }
.log-relative {
    font-size: .68rem;
    color: var(--text-sub);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    padding: 2px 8px;
    border-radius: 20px;
    font-weight: 500;
}

/* ── HEADER ── */
.log-header-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    gap: 10px;
}
.log-header-title {
    font-size: .88rem; font-weight: 700; color: var(--text);
    display: flex; align-items: center; gap: 7px;
}
.log-header-title i { color: var(--primary); font-size: .82rem; }
.log-total {
    font-size: .72rem; font-weight: 600;
    color: var(--text-muted);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    padding: 4px 12px; border-radius: 20px;
    display: flex; align-items: center; gap: 5px;
}
.log-total i { font-size: .65rem; color: var(--primary); }

/* ── EMPTY ── */
.log-empty {
    text-align: center;
    padding: 52px 20px;
}
.log-empty-ico {
    width: 56px; height: 56px;
    background: var(--tag-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
    color: var(--text-sub);
    font-size: 1.2rem;
}
.log-empty-title { font-size: .88rem; font-weight: 700; color: var(--text); margin-bottom: 4px; }
.log-empty-desc  { font-size: .74rem; color: var(--text-muted); }

/* ── PAGINATION ── */
.log-pagination { padding: 14px 20px; border-top: 1px solid var(--border); }
@endsection

@section('content')

<div class="card">

    {{-- Header --}}
    <div class="log-header-row">
        <div class="log-header-title">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Riwayat Aktivitas
        </div>
        <span class="log-total">
            <i class="fa-solid fa-list"></i>
            {{ $logs->total() }} aktivitas
        </span>
    </div>

    {{-- List --}}
    <ul class="log-list">
        @forelse($logs as $log)
        @php
            $act = $log->aktivitas;
            if (str_contains($act, 'Login'))                                        { $type = 'login';    $ico = 'fa-right-to-bracket'; }
            elseif (str_contains($act, 'Logout'))                                   { $type = 'logout';   $ico = 'fa-right-from-bracket'; }
            elseif (str_contains($act, 'jurnal') || str_contains($act, 'Jurnal'))   { $type = 'jurnal';   $ico = 'fa-book-open'; }
            elseif (str_contains($act, 'laporan') || str_contains($act, 'Laporan')) { $type = 'laporan';  $ico = 'fa-file-lines'; }
            elseif (str_contains($act, 'profil') || str_contains($act, 'Profil'))   { $type = 'profil';   $ico = 'fa-user-pen'; }
            elseif (str_contains($act, 'PKL') || str_contains($act, 'pkl'))         { $type = 'pkl';      $ico = 'fa-briefcase'; }
            elseif (str_contains($act, 'password') || str_contains($act, 'Password')){ $type = 'password'; $ico = 'fa-lock'; }
            else                                                                     { $type = 'default';  $ico = 'fa-circle-dot'; }
        @endphp
        <li class="log-item">
            <div class="log-timeline">
                <div class="log-icon type-{{ $type }}">
                    <i class="fa-solid {{ $ico }}"></i>
                </div>
            </div>
            <div class="log-body">
                <div class="log-aktivitas">{{ $log->aktivitas }}</div>
                <div class="log-meta">
                    <span class="log-time">
                        <i class="fa-regular fa-clock"></i>
                        {{ $log->waktu->translatedFormat('d F Y, H:i') }}
                    </span>
                    <span class="log-relative">{{ $log->waktu->diffForHumans() }}</span>
                </div>
            </div>
        </li>
        @empty
        <li>
            <div class="log-empty">
                <div class="log-empty-ico">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div class="log-empty-title">Belum ada aktivitas</div>
                <div class="log-empty-desc">Semua aktivitas kamu akan tercatat di sini.</div>
            </div>
        </li>
        @endforelse
    </ul>

    @if($logs->hasPages())
    <div class="log-pagination">{{ $logs->links() }}</div>
    @endif

</div>

@endsection
