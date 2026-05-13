@extends('layouts.siswa')

@section('title', 'Laporan PKL')
@section('page_title', 'Laporan PKL')
@section('nav_laporan', 'active')

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Laporan PKL</div>
        <div class="page-sub">Rekap nilai dan laporan akhir PKL kamu</div>
    </div>
</div>

<!-- Stats -->
<div class="grid-3" style="margin-bottom:20px">
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="stat-badge info">Rata-rata</span>
        </div>
        <div class="stat-num">87</div>
        <div class="stat-label">Nilai PKL</div>
        <div class="progress-bar"><div class="progress-fill" style="width:87%;background:linear-gradient(90deg,#667eea,#764ba2)"></div></div>
        <div class="progress-label"><span>87/100</span><span>Baik</span></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <span class="stat-badge up">Baik</span>
        </div>
        <div class="stat-num">94%</div>
        <div class="stat-label">Kehadiran</div>
        <div class="progress-bar"><div class="progress-fill" style="width:94%;background:linear-gradient(90deg,#22c55e,#16a34a)"></div></div>
        <div class="progress-label"><span>94%</span><span>75 dari 78 hari</span></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
            </div>
            <span class="stat-badge up">Lengkap</span>
        </div>
        <div class="stat-num">67</div>
        <div class="stat-label">Jurnal Tercatat</div>
    </div>
</div>

<!-- Rekap Nilai -->
<div class="grid-2">
    <div class="card">
        <div class="card-header">
            <div><div class="card-title-sm">Rekap Nilai per Kompetensi</div><div class="card-subtitle">Penilaian dari guru & pembimbing industri</div></div>
        </div>

        @foreach([
            ['Kedisiplinan','92','green'],
            ['Kerjasama Tim','85','purple'],
            ['Kemampuan Teknis','88','amber'],
            ['Inisiatif','80','pink'],
            ['Komunikasi','84','blue'],
        ] as $n)
        <div style="margin-bottom:14px">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                <span style="font-size:.8rem;font-weight:600;color:var(--text);transition:color .4s">{{ $n[0] }}</span>
                <span style="font-size:.8rem;font-weight:700;color:var(--primary)">{{ $n[1] }}/100</span>
            </div>
            <div class="progress-bar" style="margin:0">
                <div class="progress-fill" style="width:{{ $n[1] }}%;background:var(--grad)"></div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="display:flex;flex-direction:column;gap:20px">
        <!-- Laporan Akhir -->
        <div class="card">
            <div class="card-header"><div class="card-title-sm">Laporan Akhir PKL</div></div>
            <div class="empty-state" style="padding:24px 16px">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="empty-title">PKL Sedang Berjalan</div>
                <div class="empty-desc">Laporan akhir akan tersedia setelah PKL selesai dan semua nilai sudah diinput pembimbing.</div>
            </div>
        </div>

        <!-- Catatan Pembimbing -->
        <div class="card">
            <div class="card-header"><div class="card-title-sm">Catatan Pembimbing</div></div>
            @foreach([
                ['Bu Sari R.','Guru Pembimbing','Andi menunjukkan perkembangan yang sangat baik, terutama dalam aspek teknis. Pertahankan!','10 Mei 2026'],
                ['Pak Budi W.','Pembimbing Industri','Siswa rajin dan mudah diarahkan. Kemampuan komunikasi perlu ditingkatkan.','8 Mei 2026'],
            ] as $c)
            <div style="padding:12px;border-radius:10px;background:var(--tag-bg);border:1px solid var(--border);margin-bottom:10px">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
                    <div style="width:32px;height:32px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;color:white;flex-shrink:0">{{ substr($c[0],3,2) }}</div>
                    <div>
                        <div style="font-size:.8rem;font-weight:700;color:var(--text);transition:color .4s">{{ $c[0] }}</div>
                        <div style="font-size:.68rem;color:var(--text-sub);transition:color .4s">{{ $c[1] }}</div>
                    </div>
                    <div style="margin-left:auto;font-size:.65rem;color:var(--text-sub);transition:color .4s">{{ $c[3] }}</div>
                </div>
                <div style="font-size:.77rem;color:var(--text-muted);line-height:1.6;font-style:italic;transition:color .4s">"{{ $c[2] }}"</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
