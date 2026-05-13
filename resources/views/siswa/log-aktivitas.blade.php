@extends('layouts.siswa')

@section('title', 'Log Aktivitas')
@section('page_title', 'Log Aktivitas')
@section('nav_log', 'active')

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Log Aktivitas</div>
        <div class="page-sub">Riwayat semua aktivitas kamu di SIMPKL</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div><div class="card-title-sm">Semua Aktivitas</div></div>
        <div style="display:flex;gap:8px">
            @foreach(['Semua','Jurnal','Nilai','Login'] as $f)
            <button style="padding:5px 12px;border-radius:20px;background:var(--tag-bg);border:1px solid var(--border);color:var(--text-muted);font-family:var(--font);font-size:.72rem;font-weight:600;cursor:pointer;transition:all .2s"
                onclick="this.style.background='rgba(102,126,234,.15)';this.style.borderColor='rgba(102,126,234,.4)';this.style.color='#667eea'">
                {{ $f }}
            </button>
            @endforeach
        </div>
    </div>

    @php
    $logs = $logs ?? [
        ['purple','file','Jurnal 12 Mei dikirim ke pembimbing','Hari ini','08:12'],
        ['green','check','Jurnal 11 Mei disetujui oleh Bu Sari Rahayu','Hari ini','07:30'],
        ['amber','star','Nilai kompetensi teknis diupdate: 88/100','Kemarin','16:00'],
        ['purple','file','Jurnal 11 Mei dikirim ke pembimbing','Kemarin','08:05'],
        ['green','check','Jurnal 10 Mei disetujui oleh Bu Sari Rahayu','10 Mei','14:30'],
        ['blue','login','Login ke SIMPKL dari perangkat Windows','10 Mei','07:55'],
        ['pink','edit','Profil diperbarui','9 Mei','19:22'],
        ['amber','alert','Jurnal 9 Mei diminta revisi oleh Bu Sari','9 Mei','10:00'],
        ['green','check','Jurnal 8 Mei disetujui oleh Bu Sari Rahayu','8 Mei','13:45'],
        ['purple','file','Jurnal 8 Mei dikirim ke pembimbing','8 Mei','08:10'],
        ['blue','login','Login ke SIMPKL dari perangkat Windows','8 Mei','07:58'],
    ];
    $icons = [
        'file' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
        'check' => '<polyline points="20 6 9 17 4 12"/>',
        'star' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
        'login' => '<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>',
        'edit' => '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>',
        'alert' => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
    ];
    $colorMap = [
        'purple' => 'rgba(102,126,234,.12);color:#667eea',
        'green'  => 'rgba(34,197,94,.12);color:#22c55e',
        'amber'  => 'rgba(245,158,11,.12);color:#f59e0b',
        'pink'   => 'rgba(236,72,153,.12);color:#ec4899',
        'blue'   => 'rgba(59,130,246,.12);color:#3b82f6',
    ];
    @endphp

    @foreach($logs as $log)
    <div style="display:flex;align-items:center;gap:14px;padding:12px;border-radius:11px;background:var(--tag-bg);border:1px solid var(--border);margin-bottom:8px;transition:all .2s">
        <div style="width:36px;height:36px;border-radius:10px;flex-shrink:0;display:flex;align-items:center;justify-content:center;background:{{ is_array($log) ? $colorMap[$log[0]] : $colorMap['purple'] }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px">
                {!! is_array($log) ? ($icons[$log[1]] ?? $icons['file']) : $icons['file'] !!}
            </svg>
        </div>
        <div style="flex:1;min-width:0">
            <div style="font-size:.82rem;font-weight:500;color:var(--text);transition:color .4s">{{ is_array($log) ? $log[2] : $log->deskripsi }}</div>
        </div>
        <div style="text-align:right;flex-shrink:0">
            <div style="font-size:.72rem;font-weight:600;color:var(--text-muted);transition:color .4s">{{ is_array($log) ? $log[3] : $log->tanggal }}</div>
            <div style="font-size:.65rem;color:var(--text-sub);transition:color .4s">{{ is_array($log) ? $log[4] : $log->jam }}</div>
        </div>
    </div>
    @endforeach
</div>

@endsection
