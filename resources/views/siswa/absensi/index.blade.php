@extends('layouts.siswa')
@section('title','Absensi')
@section('page_title','Data Absensi')
@section('nav_absensi','active')

@section('styles')
<style>
/* ── SUMMARY CARDS ── */
.absensi-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 22px;
}
.absensi-stat-card {
    background: var(--card-bg);
    border-radius: 14px;
    padding: 20px;
    border: 1px solid var(--border);
    box-shadow: var(--card-shadow);
    transition: box-shadow .2s;
}
.absensi-stat-card:hover { box-shadow: var(--card-hover); }

.stat-icon-wrap {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    margin-bottom: 12px;
    background: var(--tag-bg);
    border: 1px solid var(--border);
}
/* warna per-status pakai opacity rendah agar adaptif dark mode */
.stat-icon-wrap.green  { background: rgba(34,197,94,.12);  border-color: rgba(34,197,94,.2); }
.stat-icon-wrap.amber  { background: rgba(245,158,11,.12); border-color: rgba(245,158,11,.2); }
.stat-icon-wrap.blue   { background: rgba(59,130,246,.12); border-color: rgba(59,130,246,.2); }
.stat-icon-wrap.red    { background: rgba(239,68,68,.12);  border-color: rgba(239,68,68,.2); }

.stat-num {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--text);
    line-height: 1;
}
.stat-desc {
    font-size: .72rem;
    color: var(--text-muted);
    margin-top: 4px;
    font-weight: 500;
}

/* ── PROGRESS KEHADIRAN ── */
.progress-header {
    display: flex;
    justify-content: space-between;
    font-size: .82rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 8px;
}
.progress-pct-green { color: #22c55e; }
.progress-pct-amber { color: #d97706; }
.progress-pct-red   { color: #ef4444; }

.progress-track {
    height: 10px;
    background: var(--tag-bg);
    border-radius: 99px;
    overflow: hidden;
    border: 1px solid var(--border);
}
.progress-fill {
    height: 100%;
    border-radius: 99px;
    transition: width 1s ease;
}
.progress-fill.green { background: linear-gradient(135deg,#22c55e,#16a34a); }
.progress-fill.amber { background: linear-gradient(135deg,#f59e0b,#d97706); }
.progress-fill.red   { background: linear-gradient(135deg,#ef4444,#dc2626); }

.progress-sub {
    font-size: .72rem;
    color: var(--text-muted);
    margin-top: 6px;
}

/* ── FILTER BAR ── */
.filter-bar {
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    align-items: center;
}
.filter-select {
    padding: 7px 12px;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: var(--bg);
    color: var(--text);
    font-size: .78rem;
    font-family: var(--font);
    cursor: pointer;
    outline: none;
    transition: border-color .18s;
    width: 160px;
}
.filter-select:focus { border-color: var(--primary); }

/* ── PAGINATION ── */
.pagination-wrap { padding: 16px 20px; }

@media (max-width: 900px) {
    .absensi-stats { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 500px) {
    .absensi-stats { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')

{{-- ── SUMMARY CARDS ── --}}
<div class="absensi-stats">
    <div class="absensi-stat-card">
        <div class="stat-icon-wrap green">✅</div>
        <div class="stat-num">{{ $hadir }}</div>
        <div class="stat-desc">Hadir</div>
    </div>
    <div class="absensi-stat-card">
        <div class="stat-icon-wrap amber">📋</div>
        <div class="stat-num">{{ $izin }}</div>
        <div class="stat-desc">Izin</div>
    </div>
    <div class="absensi-stat-card">
        <div class="stat-icon-wrap blue">🏥</div>
        <div class="stat-num">{{ $sakit }}</div>
        <div class="stat-desc">Sakit</div>
    </div>
    <div class="absensi-stat-card">
        <div class="stat-icon-wrap red">❌</div>
        <div class="stat-num">{{ $alpa }}</div>
        <div class="stat-desc">Alpa</div>
    </div>
</div>

{{-- ── PROGRESS KEHADIRAN ── --}}
@php
    $pctClass = $skorAbsen >= 80 ? 'green' : ($skorAbsen >= 60 ? 'amber' : 'red');
@endphp
<div class="card" style="margin-bottom:20px">
    <div class="card-body">
        <div class="progress-header">
            <span>Tingkat Kehadiran</span>
            <span class="progress-pct-{{ $pctClass }}">{{ $skorAbsen }}%</span>
        </div>
        <div class="progress-track">
            <div class="progress-fill {{ $pctClass }}" style="width:{{ $skorAbsen }}%"></div>
        </div>
        <div class="progress-sub">{{ $hadir }} dari {{ $total }} hari masuk</div>
    </div>
</div>

{{-- ── TABEL RIWAYAT ── --}}
<div class="card">
    <div class="card-header">
        <div class="card-title-sm">Riwayat Absensi</div>
    </div>

    {{-- Filter --}}
    <div class="filter-bar">
        <form method="GET" style="display:contents">
            <select name="status" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                @foreach(['Hadir','Izin','Sakit','Alpa'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
            <select name="bulan" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Bulan</option>
                @for($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
                @endfor
            </select>
            @if(request()->hasAny(['status','bulan']))
            <a href="{{ route('siswa.absensi') }}" class="btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Hari</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensi as $i => $a)
                <tr>
                    <td style="color:var(--text-muted)">{{ $absensi->firstItem() + $i }}</td>
                    <td style="font-weight:600">{{ $a->tanggal->format('d M Y') }}</td>
                    <td style="color:var(--text-muted)">{{ $a->tanggal->translatedFormat('l') }}</td>
                    <td>{{ $a->jamMasukFormatted() }}</td>
                    <td>{{ $a->jamPulangFormatted() }}</td>
                    <td><span class="badge badge-{{ strtolower($a->status) }}">{{ $a->status }}</span></td>
                    <td style="font-size:.72rem;color:var(--text-muted)">{{ $a->keterangan ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:32px;color:var(--text-muted)">
                        <div style="font-size:2rem;margin-bottom:8px">📅</div>
                        Belum ada data absensi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($absensi->hasPages())
    <div class="pagination-wrap">{{ $absensi->links() }}</div>
    @endif
</div>

@endsection