@extends('layouts.siswa')
@section('title','Log Aktivitas')
@section('page_title','Log Aktivitas')
@section('nav_log','active')

@section('styles')
<style>
/* ── LOG LIST ── */
.log-item {
    display: flex;
    gap: 14px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    transition: background .15s;
}
.log-item:last-child { border-bottom: none; }
.log-item:hover { background: var(--sidebar-active); }

.log-timeline {
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}
.log-icon {
    width: 36px; height: 36px;
    background: var(--tag-bg);
    border: 1px solid var(--border);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
}
.log-connector {
    width: 1px;
    flex: 1;
    background: var(--border);
    margin-top: 4px;
}

.log-content { flex: 1; min-width: 0; }
.log-aktivitas {
    font-size: .82rem;
    font-weight: 500;
    color: var(--text);
    margin-bottom: 5px;
}
.log-meta {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}
.log-time {
    font-size: .72rem;
    color: var(--text-muted);
}
.log-relative {
    font-size: .68rem;
    color: var(--text-sub);
}

/* ── EMPTY STATE ── */
.log-empty {
    text-align: center;
    padding: 48px 20px;
    color: var(--text-muted);
}
.log-empty-icon { font-size: 2.5rem; margin-bottom: 12px; }
.log-empty-text { font-size: .82rem; }

/* ── TOTAL BADGE ── */
.log-total {
    font-size: .72rem;
    color: var(--text-muted);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 600;
}

/* ── PAGINATION ── */
.log-pagination { padding: 16px 20px; }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title-sm">🕐 Riwayat Aktivitas</div>
        <span class="log-total">{{ $logs->total() }} total aktivitas</span>
    </div>

    @forelse($logs as $log)
    <div class="log-item">

        {{-- Timeline icon --}}
        <div class="log-timeline">
            <div class="log-icon">
                @php
                    $icon = '🔹';
                    if (str_contains($log->aktivitas, 'Login'))    $icon = '🔐';
                    if (str_contains($log->aktivitas, 'Logout'))   $icon = '🚪';
                    if (str_contains($log->aktivitas, 'jurnal'))   $icon = '📓';
                    if (str_contains($log->aktivitas, 'laporan'))  $icon = '📄';
                    if (str_contains($log->aktivitas, 'profil'))   $icon = '👤';
                    if (str_contains($log->aktivitas, 'PKL') || str_contains($log->aktivitas, 'pkl')) $icon = '🏢';
                    if (str_contains($log->aktivitas, 'password')) $icon = '🔒';
                @endphp
                {{ $icon }}
            </div>
            @if(!$loop->last)
                <div class="log-connector"></div>
            @endif
        </div>

        {{-- Konten --}}
        <div class="log-content">
            <div class="log-aktivitas">{{ $log->aktivitas }}</div>
            <div class="log-meta">
                <span class="log-time">🕐 {{ $log->waktu->translatedFormat('d F Y, H:i') }}</span>
                <span class="log-relative">({{ $log->waktu->diffForHumans() }})</span>
            </div>
        </div>

    </div>
    @empty
    <div class="log-empty">
        <div class="log-empty-icon">🕐</div>
        <div class="log-empty-text">Belum ada aktivitas tercatat.</div>
    </div>
    @endforelse

    @if($logs->hasPages())
    <div class="log-pagination">{{ $logs->links() }}</div>
    @endif
</div>
@endsection