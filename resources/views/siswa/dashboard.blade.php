@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')
@section('page_title', 'Dashboard')
@section('nav_dashboard', 'active')

@section('styles')
/* override content padding untuk dashboard */
.content { padding: 18px 20px !important; }
*, *::before, *::after { box-sizing: border-box; }

/* ── WELCOME BANNER ── */
.welcome-banner {
    background: var(--grad);
    border-radius: 16px;
    padding: 22px 26px;
    margin-bottom: 20px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    animation: fadeUp .4s ease both;
}
.welcome-banner::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 200px; height: 200px;
    background: rgba(255,255,255,.07);
    border-radius: 50%;
    pointer-events: none;
}
.welcome-banner::after {
    content: '';
    position: absolute;
    bottom: -70px; left: 28%;
    width: 260px; height: 260px;
    background: rgba(255,255,255,.04);
    border-radius: 50%;
    pointer-events: none;
}
.wb-left { position: relative; z-index: 1; }
.wb-greeting {
    font-size: .72rem;
    color: rgba(255,255,255,.72);
    font-weight: 500;
    margin-bottom: 3px;
}
.wb-name {
    font-size: 1.4rem;
    font-weight: 800;
    color: white;
    line-height: 1.2;
    margin-bottom: 10px;
}
.wb-chips { display: flex; gap: 7px; flex-wrap: wrap; }
.wb-chip {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .7rem; font-weight: 600;
    color: rgba(255,255,255,.88);
    background: rgba(255,255,255,.14);
    padding: 4px 10px; border-radius: 20px;
}
.wb-chip svg { width: 11px; height: 11px; }

.wb-status {
    position: relative; z-index: 1;
    background: rgba(255,255,255,.14);
    border: 1.5px solid rgba(255,255,255,.25);
    border-radius: 14px;
    padding: 14px 20px;
    text-align: center;
    flex-shrink: 0;
    min-width: 130px;
}
.wb-status-label {
    font-size: .63rem;
    color: rgba(255,255,255,.65);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-bottom: 6px;
}
.wb-status-val {
    font-size: .95rem;
    font-weight: 800;
    color: white;
    display: flex; align-items: center;
    justify-content: center; gap: 6px;
}
.pulse-dot {
    width: 8px; height: 8px;
    background: #22c55e;
    border-radius: 50%;
    animation: pulseDot 2s infinite;
}
@keyframes pulseDot {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:.4; transform:scale(1.5); }
}

/* ── STAT CARDS ── */
.stat-card-wrap {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}
.scard {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 18px 20px;
    position: relative;
    overflow: hidden;
    transition: all .25s;
    animation: fadeUp .4s ease both;
}
.scard:nth-child(1) { animation-delay: .05s; }
.scard:nth-child(2) { animation-delay: .10s; }
.scard:nth-child(3) { animation-delay: .15s; }
.scard:nth-child(4) { animation-delay: .20s; }
.scard::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 3px; border-radius: 16px 16px 0 0;
}
.scard-1::before { background: var(--grad); }
.scard-2::before { background: linear-gradient(90deg, #22c55e, #16a34a); }
.scard-3::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
.scard-4::before { background: linear-gradient(90deg, #ec4899, #db2777); }
.scard:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(102,126,234,.12); }

.scard-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
.scard-ico {
    width: 42px; height: 42px; border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
}
.scard-ico svg { width: 19px; height: 19px; }
.scard-ico.c1 { background: rgba(102,126,234,.12); color: #667eea; }
.scard-ico.c2 { background: rgba(34,197,94,.12);   color: #22c55e; }
.scard-ico.c3 { background: rgba(245,158,11,.12);  color: #f59e0b; }
.scard-ico.c4 { background: rgba(236,72,153,.12);  color: #ec4899; }

.scard-num { font-size: 1.85rem; font-weight: 800; color: var(--text); line-height: 1; }
.scard-lbl { font-size: .72rem; color: var(--text-muted); margin-top: 4px; font-weight: 500; }

/* ── MAIN GRID ── */
.dash-grid {
    display: grid;
    grid-template-columns: 1fr 310px;
    gap: 18px;
    margin-bottom: 18px;
    animation: fadeUp .45s ease .2s both;
}
.dash-bottom {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    animation: fadeUp .45s ease .3s both;
}

/* ── CARD HEADER UTIL ── */
.ch { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; border-bottom: 1px solid var(--border); gap: 10px; }
.ch-title { font-size: .88rem; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 7px; }
.ch-title svg { width: 15px; height: 15px; color: var(--primary); flex-shrink: 0; }
.ch-sub { font-size: .68rem; color: var(--text-muted); margin-top: 2px; }
.ch-action { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }

/* ── JURNAL LIST ── */
.jurnal-list { list-style: none; }
.jurnal-item {
    display: flex; gap: 12px;
    padding: 12px 18px;
    border-bottom: 1px solid var(--border);
    transition: background .15s;
}
.jurnal-item:last-child { border-bottom: none; }
.jurnal-item:hover { background: var(--sidebar-active); }

.jdate { flex-shrink: 0; width: 40px; text-align: center; }
.jdate-day { font-size: 1.2rem; font-weight: 800; color: var(--primary); line-height: 1; }
.jdate-mon { font-size: .58rem; text-transform: uppercase; letter-spacing: .05em; color: var(--text-sub); font-weight: 600; }

.jbody { flex: 1; min-width: 0; }
.jkegiatan {
    font-size: .8rem; font-weight: 500; color: var(--text);
    margin-bottom: 5px;
    display: -webkit-box;
    -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.jmeta { display: flex; gap: 7px; align-items: center; flex-wrap: wrap; }
.jtime { font-size: .68rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px; }
.jtime svg { width: 10px; height: 10px; }

/* ── PKL INFO ── */
.pkl-info-list { list-style: none; padding: 4px 18px 0; }
.pkl-info-item {
    display: flex; justify-content: space-between; align-items: center;
    padding: 8px 0; border-bottom: 1px solid var(--border); gap: 10px;
}
.pkl-info-item:last-child { border-bottom: none; }
.pik { font-size: .7rem; color: var(--text-muted); font-weight: 500; display: flex; align-items: center; gap: 5px; flex-shrink: 0; }
.pik svg { width: 11px; height: 11px; }
.piv { font-size: .78rem; font-weight: 600; color: var(--text); text-align: right; max-width: 160px; word-break: break-word; }

.progress-wrap { padding: 14px 18px 4px; }
.progress-lbl-row { display: flex; justify-content: space-between; font-size: .68rem; color: var(--text-muted); margin-bottom: 6px; }

/* ── QUICK ACTIONS ── */
.qa-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding: 12px; }
.qa-item {
    display: flex; align-items: center; gap: 9px;
    padding: 10px 11px;
    background: var(--tag-bg); border: 1px solid var(--border);
    border-radius: 11px; cursor: pointer;
    transition: all .2s; text-decoration: none; color: var(--text);
}
.qa-item:hover { background: var(--primary); color: white; transform: translateY(-2px); border-color: var(--primary); }
.qa-item:hover .qa-ico { background: rgba(255,255,255,.2); color: white; }
.qa-item:hover .qa-sub { color: rgba(255,255,255,.7); }
.qa-ico {
    width: 32px; height: 32px; border-radius: 8px;
    background: rgba(102,126,234,.1); color: var(--primary);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: all .2s;
}
.qa-ico svg { width: 14px; height: 14px; }
.qa-lbl { font-size: .74rem; font-weight: 700; }
.qa-sub { font-size: .63rem; color: var(--text-muted); margin-top: 1px; transition: color .2s; }

/* ── NILAI ── */
.nilai-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding: 12px 18px 8px; }
.n-item { background: var(--tag-bg); border: 1px solid var(--border); border-radius: 11px; padding: 11px 13px; }
.n-lbl { font-size: .65rem; color: var(--text-muted); font-weight: 500; margin-bottom: 3px; }
.n-val { font-size: 1.5rem; font-weight: 800; color: var(--text); }
.nilai-akhir-row {
    margin: 0 18px 12px;
    background: var(--tag-bg); border: 1px solid var(--border);
    border-radius: 11px; padding: 12px 16px;
    display: flex; align-items: center; justify-content: space-between;
}
.na-val {
    font-size: 1.85rem; font-weight: 800;
    background: var(--grad);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.nilai-note {
    margin: 0 18px 12px;
    padding: 9px 12px;
    background: var(--tag-bg); border: 1px solid var(--border);
    border-radius: 10px; font-size: .7rem; color: var(--text-muted);
    display: flex; align-items: flex-start; gap: 7px;
}
.nilai-note svg { width: 12px; height: 12px; flex-shrink: 0; margin-top: 1px; color: var(--primary); }

/* ── LAPORAN LIST ── */
.lap-list { list-style: none; }
.lap-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 18px;
    border-bottom: 1px solid var(--border);
    transition: background .15s;
}
.lap-item:last-child { border-bottom: none; }
.lap-item:hover { background: var(--sidebar-active); }
.lap-ico {
    width: 34px; height: 34px; border-radius: 9px;
    background: var(--tag-bg); color: var(--primary);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.lap-ico svg { width: 15px; height: 15px; }
.lap-info { flex: 1; min-width: 0; }
.lap-title { font-size: .78rem; font-weight: 600; color: var(--text); margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.lap-meta { font-size: .67rem; color: var(--text-muted); display: flex; align-items: center; gap: 6px; }
.btn-act {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 5px 10px;
    background: var(--tag-bg); border: 1px solid var(--border);
    border-radius: 8px; font-size: .68rem; font-weight: 600;
    color: var(--primary); text-decoration: none;
    flex-shrink: 0; transition: all .18s;
}
.btn-act:hover { background: var(--primary); color: white; border-color: var(--primary); }
.btn-act svg { width: 11px; height: 11px; }

/* ── ABSENSI TABLE ── */
.abs-table { width: 100%; border-collapse: collapse; }
.abs-table th {
    padding: 9px 14px;
    font-size: .65rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em;
    color: var(--text-sub); background: var(--tag-bg);
    border-bottom: 1px solid var(--border); text-align: left;
}
.abs-table td {
    padding: 10px 14px;
    font-size: .78rem; color: var(--text);
    border-bottom: 1px solid var(--border); vertical-align: middle;
}
.abs-table tbody tr:last-child td { border-bottom: none; }
.abs-table tbody tr:hover td { background: var(--sidebar-active); }

/* ── BADGE ADDITIONS ── */
.badge-disetujui { background: rgba(34,197,94,.1);   color: #22c55e; }
.badge-pending   { background: rgba(245,158,11,.1);  color: #f59e0b; }
.badge-menunggu  { background: rgba(245,158,11,.1);  color: #f59e0b; }
.badge-ditolak   { background: rgba(239,68,68,.1);   color: #ef4444; }
.badge-draft     { background: rgba(59,130,246,.1);  color: #3b82f6; }
.bdot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; display: inline-block; }

/* ── EMPTY STATE ── */
.es { text-align: center; padding: 28px 16px; }
.es-ico {
    width: 48px; height: 48px; border-radius: 14px;
    background: var(--tag-bg); border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px; color: var(--text-sub);
}
.es-ico svg { width: 21px; height: 21px; }
.es-title { font-size: .82rem; font-weight: 700; color: var(--text); margin-bottom: 4px; }
.es-desc  { font-size: .72rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 14px; }

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 1200px) {
    .stat-card-wrap { grid-template-columns: repeat(2, 1fr); }
    .dash-grid { grid-template-columns: 1fr; }
    .dash-bottom { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
    .stat-card-wrap { grid-template-columns: 1fr 1fr; }
    .qa-grid { grid-template-columns: 1fr 1fr; }
}
@endsection

@section('content')

{{-- ── WELCOME BANNER ── --}}
<div class="welcome-banner">
    <div class="wb-left">
        <div class="wb-greeting">Selamat datang kembali</div>
        <div class="wb-name">{{ Auth::user()->namaLengkap() }}</div>
        <div class="wb-chips">
            @php $profil = Auth::user()->profilSiswa; @endphp
            @if($profil?->jurusan)
            <span class="wb-chip">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                {{ $profil->jurusan }}
            </span>
            @endif
            @if($profil?->kelas)
            <span class="wb-chip">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h6M9 12h6M9 15h4"/></svg>
                {{ $profil->kelas }}
            </span>
            @endif
            <span class="wb-chip">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}
            </span>
        </div>
    </div>
    <div class="wb-status">
        <div class="wb-status-label">Status PKL</div>
        <div class="wb-status-val">
            @if($pkl && $pkl->status_wakasek === 'disetujui')
                <span class="pulse-dot"></span> Aktif
            @elseif($pkl)
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;opacity:.7"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Menunggu
            @else
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;opacity:.7"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Belum Ajukan
            @endif
        </div>
    </div>
</div>

{{-- ── STAT CARDS ── --}}
<div class="stat-card-wrap">
    <div class="scard scard-1">
        <div class="scard-top">
            <div class="scard-ico c1">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </div>
            <span class="stat-badge info">Total ditulis</span>
        </div>
        <div class="scard-num">{{ $totalJurnal }}</div>
        <div class="scard-lbl">Jurnal Harian</div>
    </div>

    <div class="scard scard-2">
        <div class="scard-top">
            <div class="scard-ico c2">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
            </div>
            <span class="stat-badge up">{{ $skorAbsen }}%</span>
        </div>
        <div class="scard-num">{{ $hadir }}</div>
        <div class="scard-lbl">Hari Hadir</div>
    </div>

    <div class="scard scard-3">
        <div class="scard-top">
            <div class="scard-ico c3">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <span class="stat-badge warn">{{ $laporanDisetujui }} disetujui</span>
        </div>
        <div class="scard-num">{{ $laporanCount }}</div>
        <div class="scard-lbl">Laporan Dikirim</div>
    </div>

    <div class="scard scard-4">
        <div class="scard-top">
            <div class="scard-ico c4">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="stat-badge info">{{ $predikat ?? '—' }}</span>
        </div>
        <div class="scard-num">{{ $nilaiAkhir ? number_format($nilaiAkhir, 0) : '—' }}</div>
        <div class="scard-lbl">Nilai Akhir PKL</div>
    </div>
</div>

{{-- ── JURNAL + SIDE PANEL ── --}}
<div class="dash-grid">

    {{-- Jurnal Harian --}}
    <div class="card">
        <div class="ch">
            <div>
                <div class="ch-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    Jurnal Harian Terkini
                </div>
                <div class="ch-sub">Aktivitas harian kamu</div>
            </div>
            <div class="ch-action">
                <a href="{{ route('siswa.jurnal') }}" class="card-action">Lihat semua →</a>
                <a href="{{ route('siswa.jurnal.create') }}" class="btn-primary" style="padding:6px 13px;font-size:.74rem">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah
                </a>
            </div>
        </div>

        @forelse($jurnals as $jurnal)
        <ul class="jurnal-list">
            <li class="jurnal-item">
                <div class="jdate">
                    <div class="jdate-day">{{ $jurnal->tanggal->format('d') }}</div>
                    <div class="jdate-mon">{{ $jurnal->tanggal->format('M') }}</div>
                </div>
                <div class="jbody">
                    <div class="jkegiatan">{{ $jurnal->kegiatan }}</div>
                    <div class="jmeta">
                        @if($jurnal->jam_masuk)
                        <span class="jtime">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ $jurnal->jamMasukFormatted() }} – {{ $jurnal->jamKeluarFormatted() }}
                        </span>
                        @endif
                        <span class="badge badge-{{ $jurnal->status_validasi }}">
                            <span class="bdot"></span>
                            {{ ucfirst($jurnal->status_validasi) }}
                        </span>
                    </div>
                </div>
            </li>
        </ul>
        @empty
        <div class="es">
            <div class="es-ico">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="es-title">Belum ada jurnal</div>
            <div class="es-desc">Catat aktivitas harianmu sekarang!</div>
            <a href="{{ route('siswa.jurnal.create') }}" class="btn-primary" style="font-size:.76rem">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Jurnal
            </a>
        </div>
        @endforelse
    </div>

    {{-- Side: Info PKL + Quick Actions --}}
    <div style="display:flex;flex-direction:column;gap:16px">

        {{-- Info PKL --}}
        <div class="card">
            <div class="ch">
                <div class="ch-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    Informasi PKL
                </div>
                <a href="{{ route('siswa.pkl.pengajuan') }}" class="card-action">Detail →</a>
            </div>

            @if($pkl)
                @if($pkl->status_wakasek === 'disetujui')
                <div class="progress-wrap">
                    <div class="progress-lbl-row">
                        <span>Progres Waktu PKL</span>
                        <span>{{ $persen }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:{{ $persen }}%"></div>
                    </div>
                </div>
                @endif
                <ul class="pkl-info-list">
                    <li class="pkl-info-item">
                        <span class="pik">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                            Perusahaan
                        </span>
                        <span class="piv">{{ $pkl->nama_perusahaan }}</span>
                    </li>
                    <li class="pkl-info-item">
                        <span class="pik">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Pembimbing
                        </span>
                        <span class="piv">{{ $pembimbing?->namaLengkap() ?? 'Belum ditentukan' }}</span>
                    </li>
                    <li class="pkl-info-item">
                        <span class="pik">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Tgl Pengajuan
                        </span>
                        <span class="piv">{{ $pkl->tanggal_pengajuan?->format('d M Y') ?? '-' }}</span>
                    </li>
                    <li class="pkl-info-item">
                        <span class="pik">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Status
                        </span>
                        <span class="piv">
                            <span class="badge badge-{{ $pkl->status_wakasek === 'disetujui' ? 'disetujui' : 'pending' }}">
                                <span class="bdot"></span>
                                {{ ucfirst($pkl->status_wakasek) }}
                            </span>
                        </span>
                    </li>
                </ul>
            @else
                <div class="es" style="padding:22px 16px">
                    <div class="es-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                    <div class="es-title">Belum ada PKL</div>
                    <div class="es-desc">Ajukan permohonan PKL sekarang.</div>
                    <a href="{{ route('siswa.pkl.pengajuan.create') }}" class="btn-primary" style="font-size:.74rem">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Ajukan PKL
                    </a>
                </div>
            @endif
        </div>

        {{-- Quick Actions --}}
        <div class="card">
            <div class="ch">
                <div class="ch-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Aksi Cepat
                </div>
            </div>
            <div class="qa-grid">
                <a href="{{ route('siswa.jurnal.create') }}" class="qa-item">
                    <div class="qa-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <div>
                        <div class="qa-lbl">Isi Jurnal</div>
                        <div class="qa-sub">Catat hari ini</div>
                    </div>
                </a>
                <a href="{{ route('siswa.absensi') }}" class="qa-item">
                    <div class="qa-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
                    </div>
                    <div>
                        <div class="qa-lbl">Absensi</div>
                        <div class="qa-sub">Rekap kehadiran</div>
                    </div>
                </a>
                <a href="{{ route('siswa.laporan') }}" class="qa-item">
                    <div class="qa-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div>
                        <div class="qa-lbl">Laporan</div>
                        <div class="qa-sub">Upload laporan</div>
                    </div>
                </a>
                <a href="{{ route('siswa.nilai') }}" class="qa-item">
                    <div class="qa-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div>
                        <div class="qa-lbl">Nilai PKL</div>
                        <div class="qa-sub">Lihat penilaian</div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>

{{-- ── ABSENSI + NILAI + LAPORAN ── --}}
<div class="dash-bottom">

    {{-- Absensi --}}
    <div class="card">
        <div class="ch">
            <div>
                <div class="ch-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
                    Absensi Terkini
                </div>
            </div>
            <a href="{{ route('siswa.absensi') }}" class="card-action">Semua →</a>
        </div>
        <div class="table-wrap">
            <table class="abs-table">
                <thead>
                    <tr>
                        <th>Tanggal</th><th>Masuk</th><th>Pulang</th><th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $abs)
                    <tr>
                        <td>{{ $abs->tanggal->format('d M') }}</td>
                        <td>{{ $abs->jamMasukFormatted() }}</td>
                        <td>{{ $abs->jamPulangFormatted() }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($abs->status) }}">
                                <span class="bdot"></span>{{ $abs->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center;padding:20px;font-size:.75rem;color:var(--text-muted)">
                            Belum ada data absensi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Nilai PKL --}}
    <div class="card">
        <div class="ch">
            <div class="ch-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                Nilai PKL
            </div>
            <a href="{{ route('siswa.nilai') }}" class="card-action">Detail →</a>
        </div>
        @if($nilai)
            <div class="nilai-grid-2">
                <div class="n-item"><div class="n-lbl">Sikap</div><div class="n-val">{{ $nilai->nilai_sikap }}</div></div>
                <div class="n-item"><div class="n-lbl">Keterampilan</div><div class="n-val">{{ $nilai->nilai_keterampilan }}</div></div>
                <div class="n-item"><div class="n-lbl">Laporan</div><div class="n-val">{{ $nilai->nilai_laporan }}</div></div>
                <div class="n-item"><div class="n-lbl">Predikat</div><div class="n-val" style="font-size:1.15rem">{{ $nilai->predikat ?? '—' }}</div></div>
            </div>
            <div class="nilai-akhir-row">
                <span style="font-size:.78rem;font-weight:600;color:var(--text)">Nilai Akhir</span>
                <span class="na-val">{{ $nilai->nilai_akhir ? number_format($nilai->nilai_akhir,1) : '—' }}</span>
            </div>
            @if($nilai->catatan)
            <div class="nilai-note">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <em>{{ $nilai->catatan }}</em>
            </div>
            @endif
        @else
            <div class="es">
                <div class="es-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
                <div class="es-title">Belum ada nilai</div>
                <div class="es-desc">Nilai akan diinput oleh pembimbing.</div>
            </div>
        @endif
    </div>

    {{-- Laporan PKL --}}
    <div class="card">
        <div class="ch">
            <div class="ch-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                Laporan PKL
            </div>
            <a href="{{ route('siswa.laporan') }}" class="card-action">Kelola →</a>
        </div>
        <ul class="lap-list">
            @forelse($laporans as $lap)
            <li class="lap-item">
                <div class="lap-ico">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="lap-info">
                    <div class="lap-title">{{ $lap->judul() }}</div>
                    <div class="lap-meta">
                        {{ ucfirst($lap->jenis_laporan) }}
                        <span style="opacity:.4">·</span>
                        <span class="badge badge-{{ $lap->status_pembimbing }}" style="padding:2px 7px;font-size:.62rem">
                            <span class="bdot"></span>{{ ucfirst($lap->status_pembimbing) }}
                        </span>
                    </div>
                </div>
                @if($lap->file_path)
                    <a href="{{ $lap->fileUrl() }}" class="btn-act" target="_blank">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Unduh
                    </a>
                @else
                    <a href="{{ route('siswa.laporan.show', $lap->id) }}" class="btn-act">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Upload
                    </a>
                @endif
            </li>
            @empty
            <li>
                <div class="es">
                    <div class="es-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div class="es-title">Belum ada laporan</div>
                    <div class="es-desc">Upload laporan PKL kamu di sini.</div>
                    <a href="{{ route('siswa.laporan') }}" class="btn-primary" style="font-size:.74rem">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Upload Laporan
                    </a>
                </div>
            </li>
            @endforelse
        </ul>
    </div>

</div>

@endsection
