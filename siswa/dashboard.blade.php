@extends('layouts.app')

@section('title', 'Dashboard Siswa')
@section('page-title', 'Dashboard Siswa')
@section('page-sub', 'Selamat datang kembali, ' . Auth::user()->nama_depan . ' 👋')

@section('styles')
<style>
.welcome-banner{background:var(--gradient);border-radius:var(--r-2xl);padding:28px 32px;margin-bottom:24px;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:space-between}
.welcome-banner::before{content:'';position:absolute;top:-60px;right:-60px;width:240px;height:240px;background:rgba(255,255,255,.08);border-radius:50%}
.welcome-banner::after{content:'';position:absolute;bottom:-80px;left:30%;width:300px;height:300px;background:rgba(255,255,255,.05);border-radius:50%}
.greeting{font-size:var(--fs-sm);color:rgba(255,255,255,.75);font-weight:500}
.student-name{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:white;line-height:1.1;margin:4px 0 8px}
.student-meta{display:flex;gap:12px;flex-wrap:wrap}
.meta-chip{display:inline-flex;align-items:center;gap:5px;font-size:var(--fs-xs);font-weight:600;color:rgba(255,255,255,.85);background:rgba(255,255,255,.14);padding:4px 10px;border-radius:var(--r-full)}
.pkl-status-badge{display:flex;flex-direction:column;align-items:center;background:rgba(255,255,255,.14);border:1.5px solid rgba(255,255,255,.25);border-radius:var(--r-xl);padding:16px 24px;text-align:center;z-index:1;flex-shrink:0}
.pkl-status-badge .status-label{font-size:var(--fs-xs);color:rgba(255,255,255,.7);font-weight:600;margin-bottom:4px}
.pkl-status-badge .status-value{font-family:'Syne',sans-serif;font-size:1.05rem;font-weight:800;color:white}
.status-dot-aktif{width:8px;height:8px;background:#22c55e;border-radius:50%;display:inline-block;margin-right:5px;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(1.4)}}

.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
.stat-card{background:var(--surface);border-radius:var(--r-xl);padding:20px;border:1px solid var(--border);box-shadow:var(--shadow-sm);position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s}
.stat-card:hover{transform:translateY(-3px);box-shadow:var(--shadow)}
.stat-card::before{content:'';position:absolute;top:0;right:0;width:80px;height:80px;border-radius:0 var(--r-xl) 0 80px;opacity:.06}
.stat-card-1::before{background:#667eea}.stat-card-2::before{background:#22c55e}.stat-card-3::before{background:#f59e0b}.stat-card-4::before{background:#ec4899}
.stat-icon{width:42px;height:42px;border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:14px}
.stat-icon-1{background:linear-gradient(135deg,#667eea20,#764ba210)}.stat-icon-2{background:linear-gradient(135deg,#22c55e20,#16a34a10)}.stat-icon-3{background:linear-gradient(135deg,#f59e0b20,#d9770010)}.stat-icon-4{background:linear-gradient(135deg,#ec489920,#db277710)}
.stat-num{font-family:'Syne',sans-serif;font-size:1.9rem;font-weight:800;letter-spacing:-.02em;color:var(--text);line-height:1;margin-bottom:4px}
.stat-label{font-size:var(--fs-xs);color:var(--text-muted);font-weight:500}
.stat-sub{font-size:var(--fs-xs);margin-top:8px;padding-top:8px;border-top:1px solid var(--border);color:var(--text-muted)}
.stat-sub span{font-weight:600;color:#22c55e}

.content-grid{display:grid;grid-template-columns:1fr 340px;gap:20px;margin-bottom:20px}
.bottom-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px}

.jurnal-list{list-style:none}
.jurnal-item{display:flex;gap:14px;padding:14px 0;border-bottom:1px solid var(--border)}
.jurnal-item:last-child{border-bottom:none}
.jurnal-date{flex-shrink:0;width:46px;text-align:center}
.jurnal-date .day{font-family:'Syne',sans-serif;font-size:1.3rem;font-weight:800;color:var(--primary);line-height:1}
.jurnal-date .month{font-size:10px;text-transform:uppercase;letter-spacing:.05em;color:var(--text-light);font-weight:600}
.jurnal-body{flex:1}
.jurnal-kegiatan{font-size:var(--fs-sm);font-weight:500;color:var(--text);margin-bottom:4px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.jurnal-meta{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
.jurnal-time{font-size:var(--fs-xs);color:var(--text-muted)}

.pkl-info-list{list-style:none}
.pkl-info-item{display:flex;justify-content:space-between;align-items:flex-start;padding:10px 0;border-bottom:1px solid var(--border);gap:12px}
.pkl-info-item:last-child{border-bottom:none}
.pkl-info-key{font-size:var(--fs-xs);color:var(--text-muted);font-weight:500;flex-shrink:0}
.pkl-info-val{font-size:var(--fs-sm);font-weight:600;color:var(--text);text-align:right}

.progress-section{margin-bottom:20px}
.progress-label{display:flex;justify-content:space-between;font-size:var(--fs-xs);color:var(--text-muted);margin-bottom:6px}
.progress-bar{height:8px;background:rgba(102,126,234,.1);border-radius:var(--r-full);overflow:hidden}
.progress-fill{height:100%;background:var(--gradient);border-radius:var(--r-full);transition:width 1.2s cubic-bezier(0.4,0,0.2,1)}

.nilai-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.nilai-item{background:var(--bg);border-radius:var(--r-lg);padding:14px 16px;border:1px solid var(--border)}
.nilai-item .n-label{font-size:var(--fs-xs);color:var(--text-muted);font-weight:500;margin-bottom:6px}
.nilai-item .n-val{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:var(--text)}
.nilai-akhir{background:linear-gradient(135deg,rgba(102,126,234,.08),rgba(118,75,162,.06));border:1.5px solid rgba(102,126,234,.2);border-radius:var(--r-lg);padding:16px 20px;display:flex;align-items:center;justify-content:space-between;margin-top:12px}
.nilai-akhir .val{font-family:'Syne',sans-serif;font-size:2rem;font-weight:800;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

.laporan-list{list-style:none}
.laporan-item{display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid var(--border)}
.laporan-item:last-child{border-bottom:none}
.laporan-icon{width:38px;height:38px;border-radius:var(--r-md);background:linear-gradient(135deg,#667eea15,#764ba210);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.laporan-info{flex:1}
.laporan-info .l-title{font-size:var(--fs-sm);font-weight:600;color:var(--text);margin-bottom:2px}
.laporan-info .l-meta{font-size:var(--fs-xs);color:var(--text-muted)}
.btn-upload{padding:7px 14px;background:rgba(102,126,234,.08);border:1.5px solid rgba(102,126,234,.2);border-radius:var(--r-full);font-size:var(--fs-xs);font-weight:600;color:var(--primary);cursor:pointer;font-family:'DM Sans',sans-serif;transition:all .2s;text-decoration:none;white-space:nowrap}
.btn-upload:hover{background:rgba(102,126,234,.14)}

@media(max-width:1200px){.stats-grid{grid-template-columns:repeat(2,1fr)}.content-grid{grid-template-columns:1fr}.bottom-grid{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.stats-grid{grid-template-columns:1fr 1fr}.bottom-grid{grid-template-columns:1fr}.welcome-banner{flex-direction:column;gap:16px}.pkl-status-badge{align-self:stretch}}
</style>
@endsection

@section('content')

{{-- ── WELCOME BANNER ── --}}
<div class="welcome-banner">
    <div class="welcome-text">
        <div class="greeting">Halo, Siswa!</div>
        <div class="student-name">{{ Auth::user()->namaLengkap() }}</div>
        <div class="student-meta">
            <span class="meta-chip">🏫 {{ $siswa?->jurusan ?? 'Belum diisi' }}</span>
            <span class="meta-chip">🎓 {{ $siswa?->kelas ?? '-' }}</span>
            <span class="meta-chip">🔖 NIS {{ $siswa?->nis ?? '-' }}</span>
            @if($pkl && $pkl->status_wakasek === 'disetujui')
                <span class="meta-chip">🏢 {{ $pkl->nama_perusahaan }}</span>
            @endif
        </div>
    </div>

    @if($pkl && $pkl->status_wakasek === 'disetujui')
        <div class="pkl-status-badge">
            <div class="status-label">Status PKL</div>
            <div class="status-value"><span class="status-dot-aktif"></span>Aktif</div>
            <div style="font-size:10px;color:rgba(255,255,255,.65);margin-top:4px">
                Sisa ~{{ $sisiHari ?? '??' }} hari
            </div>
        </div>
    @elseif($pkl)
        <div class="pkl-status-badge">
            <div class="status-label">Status PKL</div>
            <div class="status-value" style="color:#fcd34d;">Menunggu</div>
            <div style="font-size:10px;color:rgba(255,255,255,.65);margin-top:4px">
                Persetujuan: {{ ucfirst($pkl->status_pembimbing) }} / {{ ucfirst($pkl->status_wakasek) }}
            </div>
        </div>
    @else
        <div class="pkl-status-badge">
            <div class="status-label">Status PKL</div>
            <div class="status-value" style="color:#fcd34d;">Belum Aktif</div>
            <a href="{{ route('siswa.pkl.pengajuan') }}" style="font-size:10px;color:rgba(255,255,255,.75);margin-top:4px;text-decoration:none">
                Ajukan sekarang →
            </a>
        </div>
    @endif
</div>

{{-- ── STAT CARDS ── --}}
<div class="stats-grid">
    <div class="stat-card stat-card-1">
        <div class="stat-icon stat-icon-1">📓</div>
        <div class="stat-num">{{ $totalJurnal }}</div>
        <div class="stat-label">Jurnal Harian</div>
        <div class="stat-sub"><span>{{ $jurnalValid }}</span> tervalidasi</div>
    </div>
    <div class="stat-card stat-card-2">
        <div class="stat-icon stat-icon-2">📅</div>
        <div class="stat-num">{{ $hadir }}</div>
        <div class="stat-label">Hari Hadir</div>
        <div class="stat-sub">Kehadiran <span>{{ $skorAbsen }}%</span></div>
    </div>
    <div class="stat-card stat-card-3">
        <div class="stat-icon stat-icon-3">📄</div>
        <div class="stat-num">{{ $laporanCount }}</div>
        <div class="stat-label">Laporan Dikirim</div>
        <div class="stat-sub"><span>{{ $laporanDisetujui }}</span> disetujui</div>
    </div>
    <div class="stat-card stat-card-4">
        <div class="stat-icon stat-icon-4">⭐</div>
        <div class="stat-num">{{ $nilaiAkhir ? number_format($nilaiAkhir, 0) : '—' }}</div>
        <div class="stat-label">Nilai Akhir PKL</div>
        <div class="stat-sub">Predikat <span>{{ $predikat ?? '—' }}</span></div>
    </div>
</div>

{{-- ── JURNAL + INFO PKL ── --}}
<div class="content-grid">

    {{-- Jurnal Harian Terkini --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Jurnal Harian Terkini</div>
            <div style="display:flex;gap:8px;align-items:center">
                <a href="{{ route('siswa.jurnal') }}" class="card-link">Lihat semua →</a>
                <a href="{{ route('siswa.jurnal.create') }}" class="btn-primary" style="padding:8px 16px;font-size:var(--fs-xs)">+ Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @forelse($jurnals as $jurnal)
            <ul class="jurnal-list">
                <li class="jurnal-item">
                    <div class="jurnal-date">
                        <div class="day">{{ $jurnal->tanggal->format('d') }}</div>
                        <div class="month">{{ $jurnal->tanggal->format('M') }}</div>
                    </div>
                    <div class="jurnal-body">
                        <div class="jurnal-kegiatan">{{ $jurnal->kegiatan }}</div>
                        <div class="jurnal-meta">
                            @if($jurnal->jam_masuk)
                                <span class="jurnal-time">⏰ {{ $jurnal->jamMasukFormatted() }} – {{ $jurnal->jamKeluarFormatted() }}</span>
                            @endif
                            <span class="badge badge-{{ $jurnal->status_validasi }}">{{ ucfirst($jurnal->status_validasi) }}</span>
                        </div>
                    </div>
                </li>
            </ul>
            @empty
            <div style="text-align:center;padding:32px 0;color:var(--text-muted)">
                <div style="font-size:2rem;margin-bottom:8px">📓</div>
                <div style="font-size:var(--fs-sm)">Belum ada jurnal. Yuk tambahkan!</div>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Info PKL --}}
    <div style="display:flex;flex-direction:column;gap:16px">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Informasi PKL</div>
                <a href="{{ route('siswa.pkl.pengajuan') }}" class="card-link">Detail →</a>
            </div>
            <div class="card-body">
                @if($pkl)
                    @if($pkl->status_wakasek === 'disetujui')
                    <div class="progress-section">
                        <div class="progress-label">
                            <span>Progres Waktu PKL</span>
                            <span>{{ $persen }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" data-width="{{ $persen }}%" style="width:{{ $persen }}%"></div>
                        </div>
                    </div>
                    @endif
                    <ul class="pkl-info-list">
                        <li class="pkl-info-item">
                            <span class="pkl-info-key">Perusahaan</span>
                            <span class="pkl-info-val">{{ $pkl->nama_perusahaan }}</span>
                        </li>
                        <li class="pkl-info-item">
                            <span class="pkl-info-key">Pembimbing</span>
                            <span class="pkl-info-val">{{ $pembimbing?->namaLengkap() ?? 'Belum ditentukan' }}</span>
                        </li>
                        <li class="pkl-info-item">
                            <span class="pkl-info-key">Tanggal Pengajuan</span>
                            <span class="pkl-info-val">{{ $pkl->tanggal_pengajuan?->format('d M Y') ?? '-' }}</span>
                        </li>
                        <li class="pkl-info-item">
                            <span class="pkl-info-key">Status</span>
                            <span class="pkl-info-val">
                                <span class="badge badge-{{ $pkl->status_wakasek === 'disetujui' ? 'disetujui' : 'pending' }}">
                                    {{ ucfirst($pkl->status_wakasek) }}
                                </span>
                            </span>
                        </li>
                    </ul>
                @else
                    <div style="text-align:center;padding:20px 0;color:var(--text-muted)">
                        <div style="font-size:1.8rem;margin-bottom:8px">📋</div>
                        <div style="font-size:var(--fs-xs);margin-bottom:12px">Kamu belum mengajukan PKL.</div>
                        <a href="{{ route('siswa.pkl.pengajuan.create') }}" class="btn-primary" style="font-size:var(--fs-xs)">+ Ajukan PKL</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── ABSENSI + NILAI + LAPORAN ── --}}
<div class="bottom-grid">

    {{-- Absensi --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Absensi Terkini</div>
            <a href="{{ route('siswa.absensi') }}" class="card-link">Semua →</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Tanggal</th><th>Masuk</th><th>Pulang</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($absensi as $abs)
                    <tr>
                        <td>{{ $abs->tanggal->format('d M') }}</td>
                        <td>{{ $abs->jamMasukFormatted() }}</td>
                        <td>{{ $abs->jamPulangFormatted() }}</td>
                        <td><span class="badge badge-{{ strtolower($abs->status) }}">{{ $abs->status }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:var(--text-muted);padding:20px">Belum ada data absensi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Nilai PKL --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Nilai PKL</div>
            <a href="{{ route('siswa.nilai') }}" class="card-link">Detail →</a>
        </div>
        <div class="card-body">
            @if($nilai)
                <div class="nilai-grid">
                    <div class="nilai-item"><div class="n-label">Sikap</div><div class="n-val">{{ $nilai->nilai_sikap }}</div></div>
                    <div class="nilai-item"><div class="n-label">Keterampilan</div><div class="n-val">{{ $nilai->nilai_keterampilan }}</div></div>
                    <div class="nilai-item"><div class="n-label">Laporan</div><div class="n-val">{{ $nilai->nilai_laporan }}</div></div>
                    <div class="nilai-item"><div class="n-label">Predikat</div><div class="n-val" style="font-size:1.3rem">{{ $nilai->predikat ?? '—' }}</div></div>
                </div>
                <div class="nilai-akhir">
                    <span style="font-size:var(--fs-sm);font-weight:600">Nilai Akhir</span>
                    <span class="val">{{ $nilai->nilai_akhir ? number_format($nilai->nilai_akhir,1) : '—' }}</span>
                </div>
                @if($nilai->catatan)
                <div style="margin-top:12px;padding:10px 12px;background:var(--bg);border-radius:var(--r-md);font-size:var(--fs-xs);color:var(--text-muted);border:1px solid var(--border)">
                    💬 <em>{{ $nilai->catatan }}</em>
                </div>
                @endif
            @else
                <div style="text-align:center;padding:28px 0;color:var(--text-muted)">
                    <div style="font-size:2rem;margin-bottom:8px">⭐</div>
                    <div style="font-size:var(--fs-xs)">Nilai belum diinput pembimbing.</div>
                </div>
            @endif
        </div>
    </div>

    {{-- Laporan PKL --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Laporan PKL</div>
            <a href="{{ route('siswa.laporan') }}" class="card-link">Kelola →</a>
        </div>
        <div class="card-body">
            <ul class="laporan-list">
                @forelse($laporans as $lap)
                <li class="laporan-item">
                    <div class="laporan-icon">{{ $lap->icon() }}</div>
                    <div class="laporan-info">
                        <div class="l-title">{{ $lap->judul() }}</div>
                        <div class="l-meta">{{ ucfirst($lap->jenis_laporan) }} · <span class="badge badge-{{ $lap->status_pembimbing }}">{{ ucfirst($lap->status_pembimbing) }}</span></div>
                    </div>
                    @if($lap->file_path)
                        <a href="{{ $lap->fileUrl() }}" class="btn-upload" target="_blank">⬇ Unduh</a>
                    @else
                        <a href="{{ route('siswa.laporan.show', $lap->id) }}" class="btn-upload">⬆ Upload</a>
                    @endif
                </li>
                @empty
                <li style="text-align:center;padding:24px 0;color:var(--text-muted)">
                    <div style="font-size:1.8rem;margin-bottom:8px">📄</div>
                    <div style="font-size:var(--fs-xs)">Belum ada laporan dikirim.</div>
                </li>
                @endforelse
            </ul>
        </div>
    </div>

</div>
@endsection
