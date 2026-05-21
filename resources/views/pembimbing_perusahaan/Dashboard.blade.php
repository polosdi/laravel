@extends('layouts.pembimbing')

@section('title', 'Dashboard Pembimbing Perusahaan')
@section('page_title', 'Dashboard')
@section('nav_dashboard', 'active')

@section('styles')
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
    position: absolute; top: -50px; right: -50px;
    width: 200px; height: 200px;
    background: rgba(255,255,255,.07);
    border-radius: 50%; pointer-events: none;
}
.welcome-banner::after {
    content: '';
    position: absolute; bottom: -70px; left: 28%;
    width: 260px; height: 260px;
    background: rgba(255,255,255,.04);
    border-radius: 50%; pointer-events: none;
}
.wb-left { position: relative; z-index: 1; }
.wb-greeting { font-size: .72rem; color: rgba(255,255,255,.72); font-weight: 500; margin-bottom: 3px; }
.wb-name { font-size: 1.4rem; font-weight: 800; color: white; line-height: 1.2; margin-bottom: 10px; }
.wb-chips { display: flex; gap: 7px; flex-wrap: wrap; }
.wb-chip {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: .7rem; font-weight: 600;
    color: rgba(255,255,255,.88);
    background: rgba(255,255,255,.14);
    padding: 4px 10px; border-radius: 20px;
}
.wb-chip ion-icon { font-size: .75rem; }

.wb-status {
    position: relative; z-index: 1;
    background: rgba(255,255,255,.14);
    border: 1.5px solid rgba(255,255,255,.25);
    border-radius: 14px; padding: 14px 20px;
    text-align: center; flex-shrink: 0; min-width: 130px;
}
.wb-status-label {
    font-size: .63rem; color: rgba(255,255,255,.65); font-weight: 700;
    text-transform: uppercase; letter-spacing: .08em; margin-bottom: 6px;
}
.wb-status-val {
    font-size: .95rem; font-weight: 800; color: white;
    display: flex; align-items: center; justify-content: center; gap: 6px;
}
.pulse-dot {
    width: 8px; height: 8px; background: #22c55e;
    border-radius: 50%; animation: pulseDot 2s infinite;
}
@keyframes pulseDot {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:.4; transform:scale(1.5); }
}

/* ── STAT CARDS ── */
.stat-card-wrap {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px; margin-bottom: 20px;
}
.scard {
    background: var(--card-bg); border: 1px solid var(--border);
    border-radius: 16px; padding: 18px 20px;
    position: relative; overflow: hidden;
    transition: all .25s; animation: fadeUp .4s ease both;
}
.scard:nth-child(1) { animation-delay: .05s; }
.scard:nth-child(2) { animation-delay: .10s; }
.scard:nth-child(3) { animation-delay: .15s; }
.scard:nth-child(4) { animation-delay: .20s; }
.scard::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
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
    display: flex; align-items: center; justify-content: center; font-size: 1.2rem;
}
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
    gap: 18px; margin-bottom: 18px;
    animation: fadeUp .45s ease .2s both;
}
.dash-bottom {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    animation: fadeUp .45s ease .3s both;
}

/* ── CARD HEADER ── */
.ch { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; border-bottom: 1px solid var(--border); gap: 10px; }
.ch-title { font-size: .88rem; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 7px; }
.ch-title ion-icon { font-size: 1rem; color: var(--primary); flex-shrink: 0; }
.ch-sub { font-size: .68rem; color: var(--text-muted); margin-top: 2px; }
.ch-action { display: flex; align-items: center; gap: 8px; flex-shrink: 0; }

/* ── SISWA LIST ── */
.siswa-list { list-style: none; }
.siswa-item {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 18px; border-bottom: 1px solid var(--border);
    transition: background .15s;
}
.siswa-item:last-child { border-bottom: none; }
.siswa-item:hover { background: var(--sidebar-active); }
.siswa-avatar {
    width: 38px; height: 38px; border-radius: 50%; background: var(--grad);
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem; font-weight: 700; color: #fff; flex-shrink: 0;
}
.siswa-info { flex: 1; min-width: 0; }
.siswa-name { font-size: .82rem; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.siswa-meta { font-size: .7rem; color: var(--text-muted); margin-top: 2px; }
.siswa-action {
    display: flex; align-items: center; gap: 4px;
    font-size: .7rem; font-weight: 600; color: var(--primary);
    text-decoration: none; background: rgba(102,126,234,.08);
    padding: 4px 10px; border-radius: 8px; transition: all .15s; flex-shrink: 0;
}
.siswa-action:hover { background: rgba(102,126,234,.16); }

/* ── ABSENSI PENDING ── */
.abs-list { list-style: none; }
.abs-item {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 18px; border-bottom: 1px solid var(--border);
    transition: background .15s;
}
.abs-item:last-child { border-bottom: none; }
.abs-item:hover { background: var(--sidebar-active); }
.abs-date-box {
    width: 40px; flex-shrink: 0; text-align: center;
    background: var(--tag-bg); border-radius: 8px; padding: 6px 4px;
}
.abs-date-d { font-size: .95rem; font-weight: 800; color: var(--text); line-height: 1; }
.abs-date-m { font-size: .6rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; }
.abs-info { flex: 1; min-width: 0; }
.abs-siswa { font-size: .8rem; font-weight: 600; color: var(--text); }
.abs-time { font-size: .69rem; color: var(--text-muted); margin-top: 2px; display: flex; align-items: center; gap: 4px; }
.abs-time ion-icon { font-size: .72rem; }
.abs-actions { display: flex; gap: 6px; flex-shrink: 0; }
.btn-approve {
    display: flex; align-items: center; gap: 4px;
    font-size: .68rem; font-weight: 700;
    background: rgba(34,197,94,.1); color: #16a34a;
    border: 1px solid rgba(34,197,94,.25); border-radius: 8px;
    padding: 4px 10px; cursor: pointer; transition: all .15s; font-family: var(--font);
}
.btn-approve:hover { background: rgba(34,197,94,.2); }
.btn-reject {
    display: flex; align-items: center; gap: 4px;
    font-size: .68rem; font-weight: 700;
    background: rgba(239,68,68,.08); color: #dc2626;
    border: 1px solid rgba(239,68,68,.2); border-radius: 8px;
    padding: 4px 10px; cursor: pointer; transition: all .15s; font-family: var(--font);
}
.btn-reject:hover { background: rgba(239,68,68,.16); }

/* ── JURNAL REVIEW ── */
.jurnal-list { list-style: none; }
.jurnal-item {
    display: flex; gap: 12px; padding: 12px 18px;
    border-bottom: 1px solid var(--border); transition: background .15s;
}
.jurnal-item:last-child { border-bottom: none; }
.jurnal-item:hover { background: var(--sidebar-active); }
.jurnal-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--primary); margin-top: 6px; flex-shrink: 0;
}
.jurnal-body { flex: 1; min-width: 0; }
.jurnal-siswa { font-size: .78rem; font-weight: 700; color: var(--text); margin-bottom: 2px; }
.jurnal-kegiatan {
    font-size: .75rem; color: var(--text-muted);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 4px;
}
.jurnal-meta { font-size: .67rem; color: var(--text-sub); }
.jurnal-action {
    display: flex; align-items: flex-start; padding-top: 2px;
}
.btn-review {
    font-size: .68rem; font-weight: 700;
    background: rgba(102,126,234,.1); color: var(--primary);
    border: 1px solid rgba(102,126,234,.2); border-radius: 8px;
    padding: 4px 10px; text-decoration: none; transition: all .15s; white-space: nowrap;
}
.btn-review:hover { background: rgba(102,126,234,.2); }

/* ── QUICK ACTIONS ── */
.qa-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 14px; }
.qa-item {
    display: flex; align-items: center; gap: 11px;
    padding: 12px 14px; border-radius: 12px;
    background: var(--tag-bg); border: 1px solid var(--border);
    text-decoration: none; transition: all .2s;
}
.qa-item:hover { background: rgba(102,126,234,.12); border-color: rgba(102,126,234,.25); transform: translateY(-1px); }
.qa-ico {
    width: 36px; height: 36px; border-radius: 10px;
    background: var(--grad); display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1rem; flex-shrink: 0;
}
.qa-lbl { font-size: .78rem; font-weight: 700; color: var(--text); }
.qa-sub { font-size: .67rem; color: var(--text-muted); margin-top: 1px; }

/* ── CHART PLACEHOLDER (pie/donut stats) ── */
.stat-donut-wrap { padding: 20px 18px; }
.donut-ring { display: flex; justify-content: center; margin-bottom: 18px; }
.donut-ring svg { width: 120px; height: 120px; }
.donut-legend { display: flex; flex-direction: column; gap: 8px; }
.legend-item { display: flex; align-items: center; gap: 8px; font-size: .75rem; }
.legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
.legend-lbl { color: var(--text-muted); flex: 1; }
.legend-val { font-weight: 700; color: var(--text); }

/* ── EMPTY STATE ── */
.es { padding: 28px 20px; text-align: center; }
.es-ico { font-size: 2rem; color: var(--border); margin-bottom: 8px; }
.es-title { font-size: .82rem; font-weight: 700; color: var(--text-muted); margin-bottom: 4px; }
.es-desc { font-size: .72rem; color: var(--text-sub); }
@endsection

@section('content')

{{-- ── WELCOME BANNER ── --}}
<div class="welcome-banner">
    <div class="wb-left">
        <div class="wb-greeting">Selamat datang kembali,</div>
        <div class="wb-name">{{ Auth::user()->namaLengkap() }}</div>
        <div class="wb-chips">
            <span class="wb-chip">
                <ion-icon name="business-outline"></ion-icon>
                {{ Auth::user()->perusahaan?->nama_perusahaan ?? 'Perusahaan' }}
            </span>
            <span class="wb-chip">
                <ion-icon name="calendar-outline"></ion-icon>
                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </span>
            <span class="wb-chip">
                <ion-icon name="people-outline"></ion-icon>
                {{ $totalSiswa }} Siswa PKL
            </span>
        </div>
    </div>
    <div class="wb-status">
        <div class="wb-status-label">Status Aktif</div>
        <div class="wb-status-val">
            <span class="pulse-dot"></span>
            Pembimbing
        </div>
    </div>
</div>

{{-- ── STAT CARDS ── --}}
<div class="stat-card-wrap">
    <div class="scard scard-1">
        <div class="scard-top">
            <div class="scard-ico c1"><ion-icon name="people-outline"></ion-icon></div>
        </div>
        <div class="scard-num">{{ $totalSiswa }}</div>
        <div class="scard-lbl">Total Siswa PKL</div>
    </div>
    <div class="scard scard-2">
        <div class="scard-top">
            <div class="scard-ico c2"><ion-icon name="calendar-outline"></ion-icon></div>
        </div>
        <div class="scard-num">{{ $absensiPending }}</div>
        <div class="scard-lbl">Absensi Menunggu Validasi</div>
    </div>
    <div class="scard scard-3">
        <div class="scard-top">
            <div class="scard-ico c3"><ion-icon name="book-outline"></ion-icon></div>
        </div>
        <div class="scard-num">{{ $jurnalPending }}</div>
        <div class="scard-lbl">Jurnal Menunggu Review</div>
    </div>
    <div class="scard scard-4">
        <div class="scard-top">
            <div class="scard-ico c4"><ion-icon name="star-outline"></ion-icon></div>
        </div>
        <div class="scard-num">{{ $sudahDinilai }}</div>
        <div class="scard-lbl">Siswa Sudah Dinilai</div>
    </div>
</div>

{{-- ── MAIN GRID ── --}}
<div class="dash-grid">

    {{-- Absensi Menunggu Validasi --}}
    <div class="card">
        <div class="ch">
            <div>
                <div class="ch-title">
                    <ion-icon name="calendar-outline"></ion-icon>
                    Absensi Menunggu Validasi
                </div>
                <div class="ch-sub">Konfirmasi kehadiran siswa PKL hari ini</div>
            </div>
            <div class="ch-action">
                <a href="{{ route('pembimbing.validasi-absensi') }}" class="card-action">Semua →</a>
            </div>
        </div>
        <ul class="abs-list">
            @forelse($absensiMenunggu as $abs)
            <li class="abs-item">
                <div class="abs-date-box">
                    <div class="abs-date-d">{{ $abs->tanggal->format('d') }}</div>
                    <div class="abs-date-m">{{ $abs->tanggal->translatedFormat('M') }}</div>
                </div>
                <div class="abs-info">
                    <div class="abs-siswa">{{ $abs->siswa->namaLengkap() }}</div>
                    <div class="abs-time">
                        <ion-icon name="time-outline"></ion-icon>
                        Masuk: {{ $abs->jam_masuk ?? '—' }}
                        @if($abs->jam_pulang)
                            · Pulang: {{ $abs->jam_pulang }}
                        @endif
                    </div>
                </div>
                <div class="abs-actions">
                    <form method="POST" action="{{ route('pembimbing.validasi-absensi.approve', $abs->id) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-approve">
                            <ion-icon name="checkmark-outline"></ion-icon> Setuju
                        </button>
                    </form>
                    <form method="POST" action="{{ route('pembimbing.validasi-absensi.reject', $abs->id) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-reject">
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    </form>
                </div>
            </li>
            @empty
            <li>
                <div class="es">
                    <div class="es-ico"><ion-icon name="checkmark-circle-outline"></ion-icon></div>
                    <div class="es-title">Semua sudah divalidasi!</div>
                    <div class="es-desc">Tidak ada absensi yang menunggu konfirmasi.</div>
                </div>
            </li>
            @endforelse
        </ul>
    </div>

    {{-- Quick Actions --}}
    <div class="card">
        <div class="ch">
            <div class="ch-title">
                <ion-icon name="flash-outline"></ion-icon>
                Aksi Cepat
            </div>
        </div>
        <div class="qa-grid">
            <a href="{{ route('pembimbing.validasi-absensi') }}" class="qa-item">
                <div class="qa-ico"><ion-icon name="calendar-outline"></ion-icon></div>
                <div>
                    <div class="qa-lbl">Validasi Absensi</div>
                    <div class="qa-sub">Konfirmasi kehadiran</div>
                </div>
            </a>
            <a href="{{ route('pembimbing.review-jurnal') }}" class="qa-item">
                <div class="qa-ico"><ion-icon name="book-outline"></ion-icon></div>
                <div>
                    <div class="qa-lbl">Review Jurnal</div>
                    <div class="qa-sub">Beri feedback</div>
                </div>
            </a>
            <a href="{{ route('pembimbing.penilaian-siswa') }}" class="qa-item">
                <div class="qa-ico"><ion-icon name="star-outline"></ion-icon></div>
                <div>
                    <div class="qa-lbl">Nilai Siswa</div>
                    <div class="qa-sub">Input penilaian</div>
                </div>
            </a>
            <a href="{{ route('pembimbing.laporan-insiden') }}" class="qa-item">
                <div class="qa-ico"><ion-icon name="warning-outline"></ion-icon></div>
                <div>
                    <div class="qa-lbl">Laporan Insiden</div>
                    <div class="qa-sub">Catat kejadian</div>
                </div>
            </a>
            <a href="{{ route('pembimbing.daftar-siswa') }}" class="qa-item">
                <div class="qa-ico"><ion-icon name="people-outline"></ion-icon></div>
                <div>
                    <div class="qa-lbl">Daftar Siswa</div>
                    <div class="qa-sub">Lihat semua siswa</div>
                </div>
            </a>
            <a href="{{ route('pembimbing.unduh-rekap') }}" class="qa-item">
                <div class="qa-ico"><ion-icon name="download-outline"></ion-icon></div>
                <div>
                    <div class="qa-lbl">Unduh Rekap</div>
                    <div class="qa-sub">Export data siswa</div>
                </div>
            </a>
        </div>
    </div>

</div>

{{-- ── DASH BOTTOM ── --}}
<div class="dash-bottom">

    {{-- Jurnal Terbaru Menunggu Review --}}
    <div class="card">
        <div class="ch">
            <div>
                <div class="ch-title">
                    <ion-icon name="book-outline"></ion-icon>
                    Jurnal Menunggu Review
                </div>
                <div class="ch-sub">Jurnal harian siswa yang perlu feedback</div>
            </div>
            <a href="{{ route('pembimbing.review-jurnal') }}" class="card-action">Semua →</a>
        </div>
        <ul class="jurnal-list">
            @forelse($jurnalMenunggu as $jurnal)
            <li class="jurnal-item">
                <div class="jurnal-dot"></div>
                <div class="jurnal-body">
                    <div class="jurnal-siswa">{{ $jurnal->siswa->namaLengkap() }}</div>
                    <div class="jurnal-kegiatan">{{ $jurnal->kegiatan }}</div>
                    <div class="jurnal-meta">{{ $jurnal->tanggal->translatedFormat('d M Y') }}</div>
                </div>
                <div class="jurnal-action">
                    <a href="{{ route('pembimbing.review-jurnal.show', $jurnal->id) }}" class="btn-review">
                        Review →
                    </a>
                </div>
            </li>
            @empty
            <li>
                <div class="es">
                    <div class="es-ico"><ion-icon name="book-outline"></ion-icon></div>
                    <div class="es-title">Tidak ada jurnal pending</div>
                    <div class="es-desc">Semua jurnal sudah direviu.</div>
                </div>
            </li>
            @endforelse
        </ul>
    </div>

    {{-- Daftar Siswa PKL --}}
    <div class="card">
        <div class="ch">
            <div>
                <div class="ch-title">
                    <ion-icon name="people-outline"></ion-icon>
                    Siswa PKL Aktif
                </div>
                <div class="ch-sub">Siswa yang ditempatkan di perusahaan ini</div>
            </div>
            <a href="{{ route('pembimbing.daftar-siswa') }}" class="card-action">Semua →</a>
        </div>
        <ul class="siswa-list">
            @forelse($siswaTerbaru as $siswa)
            <li class="siswa-item">
                <div class="siswa-avatar">
                    @if($siswa->profilSiswa?->foto_profil)
                        <img src="{{ asset('storage/'.$siswa->profilSiswa->foto_profil) }}" alt="foto"
                             style="width:100%;height:100%;border-radius:50%;object-fit:cover">
                    @else
                        {{ $siswa->inisial() }}
                    @endif
                </div>
                <div class="siswa-info">
                    <div class="siswa-name">{{ $siswa->namaLengkap() }}</div>
                    <div class="siswa-meta">
                        {{ $siswa->jurusan ?? 'Jurusan' }}
                        @if($siswa->pkl?->tanggal_mulai)
                            · Mulai {{ $siswa->pkl->tanggal_mulai->format('d M') }}
                        @endif
                    </div>
                </div>
                <a href="{{ route('pembimbing.daftar-siswa.show', $siswa->id) }}" class="siswa-action">
                    Detail <ion-icon name="chevron-forward-outline" style="font-size:.7rem"></ion-icon>
                </a>
            </li>
            @empty
            <li>
                <div class="es">
                    <div class="es-ico"><ion-icon name="people-outline"></ion-icon></div>
                    <div class="es-title">Belum ada siswa</div>
                    <div class="es-desc">Siswa PKL akan muncul di sini setelah penempatan disetujui.</div>
                </div>
            </li>
            @endforelse
        </ul>
    </div>

</div>

@endsection