@extends('layouts.siswa')
@section('title','Absensi')
@section('page_title','Data Absensi')
@section('nav_absensi','active')

@section('styles')
<style>
/* ── semua class pakai prefix absen__ biar 0% konflik sama siswa_blade ── */

.absen__wrap {
    display: grid !important;
    grid-template-columns: 280px 1fr !important;
    gap: 20px;
    align-items: start;
    width: 100%;
}
.absen__left, .absen__right {
    min-width: 0;
}

/* ── KIRI ── */
.absen__left {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

/* 2×2 grid stat cards */
.absen__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.absen__card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 16px 14px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: transform .2s, box-shadow .2s;
}
.absen__card:hover {
    transform: translateY(-2px);
    box-shadow: var(--card-hover);
}

.absen__ico {
    width: 36px; height: 36px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
}
.absen__ico svg { width: 17px; height: 17px; }
.absen__ico--green { background: rgba(34,197,94,.12);  color: #22c55e; }
.absen__ico--amber { background: rgba(245,158,11,.12); color: #f59e0b; }
.absen__ico--blue  { background: rgba(59,130,246,.12); color: #3b82f6; }
.absen__ico--red   { background: rgba(239,68,68,.12);  color: #ef4444; }

.absen__num {
    font-size: 1.9rem;
    font-weight: 800;
    color: var(--text);
    line-height: 1;
}
.absen__lbl {
    font-size: .66rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--text-muted);
}

/* progress card */
.absen__prog {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 18px 16px;
    display: flex;
    flex-direction: column;
    gap: 0;
}
.absen__prog-eyebrow {
    font-size: .66rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: var(--text-muted);
    margin-bottom: 4px;
}
.absen__prog-pct {
    font-size: 2.2rem;
    font-weight: 900;
    line-height: 1;
    margin-bottom: 12px;
}
.absen__prog-pct--green { color: #22c55e; }
.absen__prog-pct--amber { color: #d97706; }
.absen__prog-pct--red   { color: #ef4444; }

.absen__prog-track {
    height: 8px;
    background: var(--tag-bg);
    border-radius: 99px;
    overflow: hidden;
    border: 1px solid var(--border);
    margin-bottom: 8px;
}
.absen__prog-fill {
    height: 100%;
    border-radius: 99px;
    transition: width 1.2s cubic-bezier(.4,0,.2,1);
    min-width: 3px;
}
.absen__prog-fill--green { background: linear-gradient(90deg,#22c55e,#16a34a); }
.absen__prog-fill--amber { background: linear-gradient(90deg,#f59e0b,#d97706); }
.absen__prog-fill--red   { background: linear-gradient(90deg,#ef4444,#dc2626); }

.absen__prog-sub {
    font-size: .7rem;
    color: var(--text-muted);
    font-weight: 500;
}

/* ── KANAN: tabel ── */
.absen__right .card { height: 100%; }

.absen__filterbar {
    padding: 12px 18px;
    border-bottom: 1px solid var(--border);
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    align-items: center;
}
.absen__sel {
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
    width: 148px;
}
.absen__sel:focus { border-color: var(--primary); }

.absen__paginate { padding: 14px 18px; }

/* ── responsive ── */
@media (max-width: 960px) {
    .absen__wrap { grid-template-columns: 1fr; }
    .absen__grid { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 580px) {
    .absen__grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')

<div class="absen__wrap">

    {{-- KIRI --}}
    <div class="absen__left">

        {{-- 2x2 stat cards --}}
        <div class="absen__grid">

            {{-- Hadir --}}
            <div class="absen__card">
                <div class="absen__ico absen__ico--green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <div class="absen__num">{{ $hadir }}</div>
                <div class="absen__lbl">Hadir</div>
            </div>

            {{-- Izin --}}
            <div class="absen__card">
                <div class="absen__ico absen__ico--amber">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <div class="absen__num">{{ $izin }}</div>
                <div class="absen__lbl">Izin</div>
            </div>

            {{-- Sakit --}}
            <div class="absen__card">
                <div class="absen__ico absen__ico--blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                    </svg>
                </div>
                <div class="absen__num">{{ $sakit }}</div>
                <div class="absen__lbl">Sakit</div>
            </div>

            {{-- Alpa --}}
            <div class="absen__card">
                <div class="absen__ico absen__ico--red">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" y1="9" x2="9" y2="15"/>
                        <line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                </div>
                <div class="absen__num">{{ $alpa }}</div>
                <div class="absen__lbl">Alpa</div>
            </div>

        </div>

        {{-- Progress kehadiran --}}
        @php
            $pc = $skorAbsen >= 80 ? 'green' : ($skorAbsen >= 60 ? 'amber' : 'red');
        @endphp
        <div class="absen__prog">
            <div class="absen__prog-eyebrow">Tingkat Kehadiran</div>
            <div class="absen__prog-pct absen__prog-pct--{{ $pc }}">{{ $skorAbsen }}%</div>
            <div class="absen__prog-track">
                <div class="absen__prog-fill absen__prog-fill--{{ $pc }}" style="width:{{ $skorAbsen }}%"></div>
            </div>
            <div class="absen__prog-sub">{{ $hadir }} dari {{ $total }} hari masuk</div>
        </div>

    </div>

    {{-- KANAN: tabel --}}
    <div class="absen__right">
        <div class="card">
            <div class="card-header">
                <div class="card-title-sm">Riwayat Absensi</div>
            </div>

            <div class="absen__filterbar">
                <form method="GET" style="display:contents">
                    <select name="status" class="absen__sel" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach(['Hadir','Izin','Sakit','Alpa'] as $s)
                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                    <select name="bulan" class="absen__sel" onchange="this.form.submit()">
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
            <div class="absen__paginate">{{ $absensi->links() }}</div>
            @endif
        </div>
    </div>

</div>

@endsection
