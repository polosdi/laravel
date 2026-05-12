@extends('layouts.app')
@section('title','Log Aktivitas')
@section('page-title','Log Aktivitas')
@section('page-sub','Riwayat semua aktivitasmu di SIMPKL')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">🕐 Riwayat Aktivitas</div>
        <span style="font-size:var(--fs-xs);color:var(--text-muted)">{{ $logs->total() }} total aktivitas</span>
    </div>

    @forelse($logs as $log)
    <div style="display:flex;gap:14px;padding:16px 20px;border-bottom:1px solid var(--border);transition:background .15s"
         onmouseover="this.style.background='rgba(102,126,234,.025)'" onmouseout="this.style.background='transparent'">

        {{-- Icon waktu --}}
        <div style="flex-shrink:0;display:flex;flex-direction:column;align-items:center;gap:4px">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,rgba(102,126,234,.1),rgba(118,75,162,.07));border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;font-size:15px">
                @php
                    $icon = '🔹';
                    if (str_contains($log->aktivitas, 'Login'))   $icon = '🔐';
                    if (str_contains($log->aktivitas, 'Logout'))  $icon = '🚪';
                    if (str_contains($log->aktivitas, 'jurnal'))  $icon = '📓';
                    if (str_contains($log->aktivitas, 'laporan')) $icon = '📄';
                    if (str_contains($log->aktivitas, 'profil'))  $icon = '👤';
                    if (str_contains($log->aktivitas, 'PKL') || str_contains($log->aktivitas, 'pkl')) $icon = '🏢';
                    if (str_contains($log->aktivitas, 'password')) $icon = '🔒';
                @endphp
                {{ $icon }}
            </div>
            @if(!$loop->last)
            <div style="width:1px;flex:1;background:var(--border);margin-top:4px"></div>
            @endif
        </div>

        {{-- Konten --}}
        <div style="flex:1;min-width:0">
            <div style="font-size:var(--fs-sm);font-weight:500;color:var(--text);margin-bottom:4px">
                {{ $log->aktivitas }}
            </div>
            <div style="display:flex;gap:10px;align-items:center">
                <span style="font-size:var(--fs-xs);color:var(--text-muted)">
                    🕐 {{ $log->waktu->translatedFormat('d F Y, H:i') }}
                </span>
                <span style="font-size:10px;color:var(--text-light)">
                    ({{ $log->waktu->diffForHumans() }})
                </span>
            </div>
        </div>
    </div>
    @empty
    <div style="text-align:center;padding:48px 20px;color:var(--text-muted)">
        <div style="font-size:2.5rem;margin-bottom:12px">🕐</div>
        <div style="font-size:var(--fs-sm)">Belum ada aktivitas tercatat.</div>
    </div>
    @endforelse

    @if($logs->hasPages())
    <div style="padding:16px 20px">{{ $logs->links() }}</div>
    @endif
</div>
@endsection
