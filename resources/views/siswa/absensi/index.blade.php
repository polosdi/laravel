@extends('layouts.siswa')
@section('title','Absensi')
@section('page_title','Data Absensi')
@section('nav_absensi','active')

@section('styles')
<style>
/* ── LAYOUT: 2-column (cards left, table right) ── */
.absensi-layout {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 20px;
    align-items: start;
}

/* ── LEFT COLUMN ── */
.absensi-left { display: flex; flex-direction: column; gap: 16px; }

/* ── STAT CARDS: 2×2 ── */
.absensi-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.absensi-stat-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 18px 16px;
    border: 1px solid var(--border);
    box-shadow: var(--card-shadow);
    transition: box-shadow .2s, transform .2s;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.absensi-stat-card:hover {
    box-shadow: var(--card-hover);
    transform: translateY(-2px);
}

.stat-icon-wrap {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.stat-icon-wrap svg { width: 18px; height: 18px; }

.stat-icon-wrap.green  { background: rgba(34,197,94,.12);  color: #22c55e; }
.stat-icon-wrap.amber  { background: rgba(245,158,11,.12); color: #f59e0b; }
.stat-icon-wrap.blue   { background: rgba(59,130,246,.12); color: #3b82f6; }
.stat-icon-wrap.red    { background: rgba(239,68,68,.12);  color: #ef4444; }

.stat-num {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text);
    line-height: 1;
}
.stat-desc {
    font-size: .7rem;
    color: var(--text-muted);
    font-weight: 600;
    letter-spacing: .02em;
    text-transform: uppercase;
}

/* ── PROGRESS CARD (left col) — semua class di-prefix "abs-" biar ga conflic sama layout parent ── */
.abs-progress-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 20px 18px;
    border: 1px solid var(--border);
    box-shadow: var(--card-shadow);
}
.abs-progress-title {
    font-size: .7rem;
    font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 6px;
}
.abs-progress-pct {
    font-size: 2.4rem;
    font-weight: 900;
    line-height: 1;
    margin-bottom: 14px;
}
.abs-progress-pct.green { color: #22c55e; }
.abs-progress-pct.amber { color: #d97706; }
.abs-progress-pct.red   { color: #ef4444; }

.abs-progress-track {
    height: 8px;
    background: var(--tag-bg);
    border-radius: 99px;
    overflow: hidden;
    border: 1px solid var(--border);
    margin-bottom: 10px;
}
.abs-progress-fill {
    height: 100%;
    border-radius: 99px;
    transition: width 1.2s cubic-bezier(.4,0,.2,1);
    min-width: 2px;
}
.abs-progress-fill.green { background: linear-gradient(90deg,#22c55e,#16a34a); }
.abs-progress-fill.amber { background: linear-gradient(90deg,#f59e0b,#d97706); }
.abs-progress-fill.red   { background: linear-gradient(90deg,#ef4444,#dc2626); }

.abs-progress-sub {
    font-size: .7rem;
    color: var(--text-muted);
    font-weight: 500;
}

/* ── RIGHT COLUMN: TABLE CARD ── */
.absensi-right {}

.absensi-right .card {
    height: 100%;
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
    width: 150px;
}
.filter-select:focus { border-color: var(--primary); }

/* ── PAGINATION ── */
.pagination-wrap { padding: 16px 20px; }

/* ── RESPONSIVE ── */
@media (max-width: 900px) {
    .absensi-layout {
        grid-template-columns: 1fr;
    }
    .absensi-stats {
        grid-template-columns: repeat(4, 1fr);
    }
    .absensi-left {
        flex-direction: column;
    }
}
@media (max-width: 600px) {
    .absensi-stats { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')

<div class="absensi-layout">

    {{-- ── LEFT COLUMN ── --}}
    <div class="absensi-left">

        {{-- 2×2 STAT CARDS --}}
        <div class="absensi-stats">
            {{-- Hadir --}}
            <div class="absensi-stat-card">
                <div class="stat-icon-wrap green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-num">{{ $hadir }}</div>
                    <div class="stat-desc">Hadir</div>
                </div>
            </div>

            {{-- Izin --}}
            <div class="absensi-stat-card">
                <div class="stat-icon-wrap amber">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-num">{{ $izin }}</div>
                    <div class="stat-desc">Izin</div>
                </div>
            </div>

            {{-- Sakit --}}
            <div class="absensi-stat-card">
                <div class="stat-icon-wrap blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-num">{{ $sakit }}</div>
                    <div class="stat-desc">Sakit</div>
                </div>
            </div>

            {{-- Alpa --}}
            <div class="absensi-stat-card">
                <div class="stat-icon-wrap red">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" y1="9" x2="9" y2="15"/>
                        <line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-num">{{ $alpa }}</div>
                    <div class="stat-desc">Alpa</div>
                </div>
            </div>
        </div>

        {{-- PROGRESS KEHADIRAN --}}
        @php
            $pctClass = $skorAbsen >= 80 ? 'green' : ($skorAbsen >= 60 ? 'amber' : 'red');
        @endphp
        <div class="abs-progress-card">
            <div class="abs-progress-title">Tingkat Kehadiran</div>
            <div class="abs-progress-pct {{ $pctClass }}">{{ $skorAbsen }}%</div>
            <div class="abs-progress-track">
                <div class="abs-progress-fill {{ $pctClass }}" style="width:{{ $skorAbsen }}%"></div>
            </div>
            <div class="abs-progress-sub">{{ $hadir }} dari {{ $total }} hari masuk</div>
        </div>

    </div>

    {{-- ── RIGHT COLUMN: TABLE ── --}}
    <div class="absensi-right">
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
                            <td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)">
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
    </div>

</div>

@endsection
