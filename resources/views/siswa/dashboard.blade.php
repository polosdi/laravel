@extends('layouts.siswa')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('nav_dashboard', 'active')

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Selamat Datang, {{ auth()->user()->nama_lengkap ?? 'Siswa' }}! 👋</div>
        <div class="page-sub">{{ now()->isoFormat('dddd, D MMMM Y') }} · PKL sedang berjalan</div>
    </div>
    <div class="page-actions">
        <a href="{{ route('siswa.jurnal.create') }}" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Input Jurnal Hari Ini
        </a>
    </div>
</div>

<!-- STATS -->
<div class="grid-4" style="margin-bottom:20px">
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <span class="stat-badge warn">42 hari lagi</span>
        </div>
        <div class="stat-num">78</div>
        <div class="stat-label">Hari berjalan</div>
        <div class="progress-bar"><div class="progress-fill" style="width:65%"></div></div>
        <div class="progress-label"><span>65% selesai</span><span>120 hari</span></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <span class="stat-badge up">+3 minggu ini</span>
        </div>
        <div class="stat-num">67</div>
        <div class="stat-label">Jurnal ditulis</div>
    </div>

    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="stat-badge info">Rata-rata</span>
        </div>
        <div class="stat-num">87</div>
        <div class="stat-label">Nilai PKL</div>
        <div class="progress-bar"><div class="progress-fill" style="width:87%;background:linear-gradient(90deg,#f59e0b,#d97706)"></div></div>
        <div class="progress-label"><span>87/100</span></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon pink">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <span class="stat-badge up">Baik</span>
        </div>
        <div class="stat-num">94%</div>
        <div class="stat-label">Kehadiran</div>
        <div class="progress-bar"><div class="progress-fill" style="width:94%;background:linear-gradient(90deg,#ec4899,#db2777)"></div></div>
        <div class="progress-label"><span>94%</span></div>
    </div>
</div>

<div class="grid-2">
    <div style="display:flex;flex-direction:column;gap:20px">

        <!-- PKL Status Card -->
        <div style="background:var(--grad);border-radius:16px;padding:22px;color:white;position:relative;overflow:hidden">
            <div style="position:absolute;top:-40px;right:-40px;width:160px;height:160px;border-radius:50%;background:rgba(255,255,255,.08)"></div>
            <div style="position:absolute;bottom:-50px;left:-20px;width:130px;height:130px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="font-size:.68rem;font-weight:600;opacity:.75;letter-spacing:.05em;text-transform:uppercase;margin-bottom:4px">Tempat PKL</div>
            <div style="font-size:1.05rem;font-weight:800;margin-bottom:2px">PT. Teknologi Nusantara</div>
            <div style="font-size:.75rem;opacity:.75;margin-bottom:14px">Jl. Sudirman No.45, Bandung</div>
            <div style="display:flex;align-items:baseline;gap:6px;margin-bottom:10px">
                <div style="font-size:2.2rem;font-weight:900;line-height:1">42</div>
                <div style="font-size:.8rem;opacity:.8">hari tersisa</div>
            </div>
            <div style="height:5px;background:rgba(255,255,255,.25);border-radius:5px;overflow:hidden;margin-bottom:6px">
                <div style="height:100%;width:65%;background:white;border-radius:5px"></div>
            </div>
            <div style="display:flex;justify-content:space-between;font-size:.65rem;opacity:.7;margin-bottom:14px">
                <span>2 Mar 2026</span><span>30 Jun 2026</span>
            </div>
            <div style="display:flex;gap:20px;position:relative;z-index:1">
                <div><div style="font-size:.62rem;opacity:.7;text-transform:uppercase;letter-spacing:.05em">Guru Pembimbing</div><div style="font-size:.8rem;font-weight:700">Bu Sari R.</div></div>
                <div><div style="font-size:.62rem;opacity:.7;text-transform:uppercase;letter-spacing:.05em">Pembimbing Industri</div><div style="font-size:.8rem;font-weight:700">Pak Budi W.</div></div>
                <div><div style="font-size:.62rem;opacity:.7;text-transform:uppercase;letter-spacing:.05em">Kelas</div><div style="font-size:.8rem;font-weight:700">XI TKJ</div></div>
            </div>
        </div>

        <!-- Jurnal Terbaru -->
        <div class="card">
            <div class="card-header">
                <div><div class="card-title-sm">Jurnal Terbaru</div><div class="card-subtitle">Aktivitas harian kamu</div></div>
                <a href="{{ route('siswa.jurnal') }}" class="card-action">Lihat semua →</a>
            </div>
            @forelse($jurnals ?? [] as $jurnal)
            <div style="display:flex;align-items:flex-start;gap:10px;padding:10px;border-radius:10px;background:var(--tag-bg);border:1px solid var(--border);margin-bottom:8px">
                <div style="width:38px;height:38px;border-radius:9px;flex-shrink:0;background:var(--grad);display:flex;flex-direction:column;align-items:center;justify-content:center;color:white">
                    <div style="font-size:.85rem;font-weight:800;line-height:1">{{ $jurnal->created_at->format('d') }}</div>
                    <div style="font-size:.5rem;font-weight:600;opacity:.85">{{ strtoupper($jurnal->created_at->format('M')) }}</div>
                </div>
                <div style="flex:1;min-width:0">
                    <div style="font-size:.8rem;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $jurnal->judul }}</div>
                    <div style="font-size:.7rem;color:var(--text-muted);margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $jurnal->kegiatan }}</div>
                </div>
                <span class="badge {{ $jurnal->status }}">{{ ucfirst($jurnal->status) }}</span>
            </div>
            @empty
            {{-- Demo data --}}
            @foreach([['12','MEI','Instalasi server Linux','Konfigurasi SSH dan firewall','pending'],['11','MEI','Troubleshooting LAN','Cek koneksi antar gedung','approved'],['10','MEI','Pemasangan kabel UTP','Crimping Cat6 lantai 2','approved']] as $j)
            <div style="display:flex;align-items:flex-start;gap:10px;padding:10px;border-radius:10px;background:var(--tag-bg);border:1px solid var(--border);margin-bottom:8px">
                <div style="width:38px;height:38px;border-radius:9px;flex-shrink:0;background:var(--grad);display:flex;flex-direction:column;align-items:center;justify-content:center;color:white">
                    <div style="font-size:.85rem;font-weight:800;line-height:1">{{ $j[0] }}</div>
                    <div style="font-size:.5rem;font-weight:600;opacity:.85">{{ $j[1] }}</div>
                </div>
                <div style="flex:1;min-width:0">
                    <div style="font-size:.8rem;font-weight:600;color:var(--text)">{{ $j[2] }}</div>
                    <div style="font-size:.7rem;color:var(--text-muted);margin-top:2px">{{ $j[3] }}</div>
                </div>
                <span class="badge {{ $j[4] }}">{{ $j[4] === 'pending' ? 'Menunggu' : 'Disetujui' }}</span>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>

    <!-- Right Column -->
    <div style="display:flex;flex-direction:column;gap:20px">
        <!-- Info Pembimbing -->
        <div class="card">
            <div class="card-header"><div class="card-title-sm">Informasi Pembimbing</div></div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
                <div><div class="info-label">Guru Pembimbing</div><div class="info-value">Sari Rahayu, S.Pd.</div></div>
            </div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                <div><div class="info-label">Pembimbing Industri</div><div class="info-value">Budi Wahyono, S.Kom.</div></div>
            </div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.24h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
                <div><div class="info-label">Kontak</div><div class="info-value">0812-3456-7890</div></div>
            </div>
        </div>

        <!-- Log Aktivitas -->
        <div class="card">
            <div class="card-header">
                <div class="card-title-sm">Log Terbaru</div>
                <a href="{{ route('siswa.log') }}" class="card-action">Semua →</a>
            </div>
            @foreach([['purple','jurnal','Jurnal hari ini dikirim','08.12'],['green','check','Jurnal 11 Mei disetujui','Kemarin'],['amber','alert','Nilai harian diupdate','10 Mei']] as $l)
            <div style="display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:9px;background:var(--tag-bg);margin-bottom:6px">
                <div style="width:30px;height:30px;border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;background:rgba(102,126,234,.12);color:#667eea">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><circle cx="12" cy="12" r="10"/></svg>
                </div>
                <div style="flex:1;font-size:.75rem;color:var(--text);font-weight:500">{{ $l[2] }}</div>
                <div style="font-size:.65rem;color:var(--text-sub)">{{ $l[3] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
