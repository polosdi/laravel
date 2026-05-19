@extends('admin.layouts.app')

@section('page_title', 'Dashboard')
@section('page_breadcrumb', 'Beranda')

@section('content')
<!-- STAT CARDS -->
<div class="stats-grid">
    <div class="stat-card stat-card-1 anim-in">
        <div class="stat-icon stat-icon-1">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-num">{{ $totalSiswaPkl }}</div>
            <div class="stat-label">Siswa PKL Aktif</div>
            <div class="stat-change up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
                Data terkini
            </div>
        </div>
    </div>
    <div class="stat-card stat-card-2 anim-in anim-delay-1">
        <div class="stat-icon stat-icon-2">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-num">{{ $totalIndustri }}</div>
            <div class="stat-label">Mitra Industri</div>
        </div>
    </div>
    <div class="stat-card stat-card-3 anim-in anim-delay-2">
        <div class="stat-icon stat-icon-3">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-num">{{ $totalGuru }}</div>
            <div class="stat-label">Guru Pembimbing</div>
        </div>
    </div>
    <div class="stat-card stat-card-4 anim-in anim-delay-3">
        <div class="stat-icon stat-icon-4">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-num">{{ $rataKehadiran }}%</div>
            <div class="stat-label">Rata-rata Kehadiran</div>
        </div>
    </div>
</div>

<!-- CHARTS ROW -->
<div class="grid-3 anim-in">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                Siswa PKL per Jurusan
            </div>
        </div>
        <div style="padding:20px 22px">
            @foreach($siswaPerJurusan as $jurusan => $jumlah)
            <div class="progress-row">
                <div class="progress-label"><strong>{{ $jurusan }}</strong><span>{{ $jumlah }} siswa</span></div>
                <div class="progress-bar"><div class="progress-fill fill-purple" style="width:{{ $totalSiswaPkl > 0 ? round($jumlah/$totalSiswaPkl*100) : 0 }}%"></div></div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="card">
        <div class="card-header" style="border-bottom:none">
            <div class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                Status Pengajuan
            </div>
        </div>
        <div class="donut-wrap">
            <svg width="100" height="100" viewBox="0 0 42 42">
                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="rgba(102,126,234,0.12)" stroke-width="8"/>
                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="url(#dg1)" stroke-width="8" stroke-dasharray="{{ $pctDisetujui }} {{ 100-$pctDisetujui }}" stroke-dashoffset="25"/>
                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#f59e0b" stroke-width="8" stroke-dasharray="{{ $pctPending }} {{ 100-$pctPending }}" stroke-dashoffset="{{ 100-$pctDisetujui+25 }}"/>
                <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#ef4444" stroke-width="8" stroke-dasharray="{{ $pctDitolak }} {{ 100-$pctDitolak }}" stroke-dashoffset="{{ 100-$pctDisetujui-$pctPending+25 }}"/>
                <defs><linearGradient id="dg1" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#667eea"/><stop offset="100%" stop-color="#764ba2"/></linearGradient></defs>
            </svg>
            <div class="donut-legend">
                <div class="legend-item"><div class="legend-dot" style="background:var(--grad)"></div><span class="legend-label">Disetujui</span><span class="legend-val">{{ $pctDisetujui }}%</span></div>
                <div class="legend-item"><div class="legend-dot" style="background:#f59e0b"></div><span class="legend-label">Menunggu</span><span class="legend-val">{{ $pctPending }}%</span></div>
                <div class="legend-item"><div class="legend-dot" style="background:#ef4444"></div><span class="legend-label">Ditolak</span><span class="legend-val">{{ $pctDitolak }}%</span></div>
            </div>
        </div>

        <div class="card-header" style="border-top:1px solid var(--border)">
            <div class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                Aksi Cepat
            </div>
        </div>
        <div class="quick-actions">
            <a class="qa-btn" href="{{ route('admin.users') }}">
                <div class="qa-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg></div>
                <div><div class="qa-label">Tambah User</div><div class="qa-desc">Buat akun baru</div></div>
            </a>
            <a class="qa-btn" href="{{ route('admin.industri') }}">
                <div class="qa-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                <div><div class="qa-label">Tambah Industri</div><div class="qa-desc">Mitra baru</div></div>
            </a>
            <a class="qa-btn" href="{{ route('admin.absensi') }}">
                <div class="qa-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
                <div><div class="qa-label">Cek Absensi</div><div class="qa-desc">Hari ini</div></div>
            </a>
            <a class="qa-btn" href="#">
                <div class="qa-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></div>
                <div><div class="qa-label">Ekspor Laporan</div><div class="qa-desc">Download data</div></div>
            </a>
        </div>
    </div>
</div>

<!-- PENGAJUAN + LOG -->
<div class="grid-2 anim-in">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                Pengajuan PKL Terbaru
            </div>
            <a href="{{ route('admin.siswa-pkl') }}" class="btn btn-ghost btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Siswa</th><th>Industri</th><th>Jurusan</th><th>Status</th></tr></thead>
                <tbody>
                @forelse($pengajuanTerbaru as $p)
                <tr>
                    <td><div class="user-cell"><div class="av av-purple">{{ strtoupper(substr($p->ketua->nama_depan ?? 'U', 0, 2)) }}</div><div class="user-name">{{ $p->ketua->nama_depan ?? '-' }}</div></div></td>
                    <td>{{ $p->mitra->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $p->ketua->profilSiswa->jurusan ?? '-' }}</td>
                    <td>
                        @if($p->status_admin === 'disetujui') <span class="badge badge-ok"><span class="badge-dot"></span>Disetujui</span>
                        @elseif($p->status_admin === 'ditolak') <span class="badge badge-err"><span class="badge-dot"></span>Ditolak</span>
                        @else <span class="badge badge-warn"><span class="badge-dot"></span>Menunggu</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:var(--text-muted);padding:24px">Belum ada pengajuan</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Aktivitas Terbaru
            </div>
            <a href="{{ route('admin.log') }}" class="btn btn-ghost btn-sm">Lihat Semua</a>
        </div>
        @forelse($logTerbaru as $log)
        <div class="log-item">
            <div class="log-icon log-icon-{{ $log->tipe ?? 'login' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="log-body">
                <div class="log-text">{{ $log->deskripsi }}</div>
                <div class="log-meta">{{ $log->waktu?->diffForHumans() }} · {{ $log->user->name ?? 'System' }}</div>
            </div>
        </div>
        @empty
        <div style="padding:24px;text-align:center;color:var(--text-muted)">Belum ada aktivitas</div>
        @endforelse
    </div>
</div>
@endsection
