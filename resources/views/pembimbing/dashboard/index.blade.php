@extends('layouts.pembimbing')
@section('title','Dashboard Pembimbing')

@push('styles')
<style>
/* ── GREETING ── */
.greet{
    background:var(--grad);border-radius:20px;padding:28px 32px;
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:24px;position:relative;overflow:hidden;
    box-shadow:0 16px 48px rgba(102,126,234,.3);
}
.greet::before{content:'';position:absolute;top:-50px;right:-50px;width:220px;height:220px;background:rgba(255,255,255,.06);border-radius:50%}
.greet::after{content:'';position:absolute;bottom:-60px;left:30%;width:180px;height:180px;background:rgba(255,255,255,.04);border-radius:50%}
.greet-l{position:relative;z-index:1}
.greet-lbl{font-size:.68rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:rgba(255,255,255,.72);margin-bottom:5px}
.greet-name{font-size:1.7rem;font-weight:800;color:#fff;letter-spacing:-.02em;line-height:1.15}
.greet-sub{font-size:.825rem;color:rgba(255,255,255,.76);margin-top:6px}
.greet-r{position:relative;z-index:1;display:flex;gap:20px}
.greet-stat{text-align:center;background:rgba(255,255,255,.12);border-radius:14px;padding:14px 20px;backdrop-filter:blur(10px)}
.greet-num{font-size:2rem;font-weight:800;color:#fff;line-height:1;letter-spacing:-.03em}
.greet-slbl{font-size:.68rem;color:rgba(255,255,255,.72);font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-top:4px}

/* ── STAT CARDS ── */
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
.s-card{
    background:var(--stat-bg);border:1px solid var(--border);
    border-radius:16px;padding:20px;position:relative;overflow:hidden;
    transition:all .3s;cursor:default;
}
.s-card:hover{transform:translateY(-4px);box-shadow:0 14px 40px rgba(102,126,234,.13)}
.s-card::after{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:20px}
.s-c1::after{background:var(--grad)}
.s-c2::after{background:linear-gradient(90deg,#22c55e,#16a34a)}
.s-c3::after{background:linear-gradient(90deg,#f59e0b,#d97706)}
.s-c4::after{background:linear-gradient(90deg,#ec4899,#db2777)}
.s-ic{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:14px}
.ic-pr{background:rgba(102,126,234,.12)}.ic-gr{background:rgba(34,197,94,.1)}.ic-am{background:rgba(245,158,11,.1)}.ic-pk{background:rgba(236,72,153,.1)}
.s-num{font-size:1.85rem;font-weight:800;color:var(--text);line-height:1;letter-spacing:-.03em}
.s-lbl{font-size:.73rem;color:var(--text-muted);font-weight:500;margin-top:5px}

/* ── LAYOUT ── */
.two-col{display:grid;grid-template-columns:1.6fr 1fr;gap:20px;margin-bottom:22px}
.full-col{margin-bottom:22px}

/* ── SISWA LIST ── */
.siswa-item{
    display:flex;align-items:center;gap:12px;
    padding:13px 22px;border-bottom:1px solid var(--border);
    transition:background .15s;
}
.siswa-item:last-child{border-bottom:none}
.siswa-item:hover{background:rgba(102,126,234,.03)}
.siswa-av{
    width:36px;height:36px;border-radius:50%;background:var(--grad);
    display:flex;align-items:center;justify-content:center;
    font-size:.72rem;font-weight:700;color:#fff;flex-shrink:0;
}
.siswa-name{font-size:.825rem;font-weight:600;color:var(--text)}
.siswa-info{font-size:.72rem;color:var(--text-muted);margin-top:1px}

/* ── JURNAL ITEM ── */
.j-item{display:flex;align-items:flex-start;gap:10px;padding:12px 22px;border-bottom:1px solid var(--border)}
.j-item:last-child{border-bottom:none}
.j-dot{width:7px;height:7px;border-radius:50%;background:var(--grad);margin-top:5px;flex-shrink:0}
.j-day{font-size:.7rem;font-weight:700;color:var(--primary);min-width:42px;white-space:nowrap;text-transform:uppercase;letter-spacing:.04em}
.j-siswa{font-size:.72rem;font-weight:700;color:var(--text);white-space:nowrap}
.j-act{font-size:.78rem;color:var(--text-muted);flex:1;line-height:1.45}

/* ── PENDING ALERT ── */
.pending-banner{
    background:linear-gradient(135deg,rgba(245,158,11,.12),rgba(217,119,6,.08));
    border:1px solid rgba(245,158,11,.25);border-radius:14px;
    padding:16px 20px;display:flex;align-items:center;gap:14px;margin-bottom:22px;
}
.pb-icon{font-size:1.4rem;flex-shrink:0}
.pb-text{flex:1}
.pb-title{font-weight:700;font-size:.875rem;color:#92400e;margin-bottom:2px}
.pb-sub{font-size:.78rem;color:#b45309}
</style>
@endpush

@section('content')

{{-- PENDING BANNER --}}
@if($totalPending > 0)
<div class="pending-banner">
    <div class="pb-icon"><i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b"></i></div>
    <div class="pb-text">
        <div class="pb-title">Ada {{ $totalPending }} item yang menunggu tindakan kamu</div>
        <div class="pb-sub">
            {{ $pendingPkl }} pengajuan PKL ·
            {{ $pendingJurnal }} jurnal harian ·
            {{ $pendingLaporan }} laporan PKL
        </div>
    </div>
    <a href="{{ route('pembimbing.jurnal.index') }}?status=pending" class="btn btn-sm" style="background:rgba(245,158,11,.2);color:#92400e;border:1px solid rgba(245,158,11,.3)">Tinjau Sekarang</a>
</div>
@endif

{{-- GREETING ── --}}
<div class="greet">
    <div class="greet-l">
        <div class="greet-lbl">Selamat datang, Pembimbing <i class="fa-solid fa-hand-wave" style="color:rgba(255,255,255,.85)"></i></div>
        <div class="greet-name">{{ auth()->user()->nama_depan }} {{ auth()->user()->nama_belakang }}</div>
        <div class="greet-sub">{{ $profil->jabatan ?? 'Guru Pembimbing PKL' }} &nbsp;·&nbsp; {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
    </div>
    <div class="greet-r">
        <div class="greet-stat">
            <div class="greet-num">{{ $totalSiswa }}</div>
            <div class="greet-slbl">Total Siswa</div>
        </div>
        <div class="greet-stat">
            <div class="greet-num">{{ $totalPklAktif }}</div>
            <div class="greet-slbl">PKL Aktif</div>
        </div>
    </div>
</div>

{{-- STAT CARDS ── --}}
<div class="stat-grid">
    <div class="s-card s-c1">
        <div class="s-ic ic-pr"><i class="fa-solid fa-clipboard-list" style="color:#667eea"></i></div>
        <div class="s-num">{{ $pendingPkl }}</div>
        <div class="s-lbl">Pengajuan Menunggu</div>
    </div>
    <div class="s-card s-c2">
        <div class="s-ic ic-gr"><i class="fa-solid fa-book-open" style="color:#22c55e"></i></div>
        <div class="s-num">{{ $pendingJurnal }}</div>
        <div class="s-lbl">Jurnal Belum Divalidasi</div>
    </div>
    <div class="s-card s-c3">
        <div class="s-ic ic-am"><i class="fa-solid fa-file-lines" style="color:#f59e0b"></i></div>
        <div class="s-num">{{ $pendingLaporan }}</div>
        <div class="s-lbl">Laporan Belum Ditinjau</div>
    </div>
    <div class="s-card s-c4">
        <div class="s-ic ic-pk"><i class="fa-solid fa-star" style="color:#ec4899"></i></div>
        <div class="s-num">{{ $sudahDinilai }}/{{ $totalSiswa }}</div>
        <div class="s-lbl">Nilai Sudah Diinput</div>
    </div>
</div>

{{-- TWO COL ── --}}
<div class="two-col">
    {{-- Jurnal Terbaru ── --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title"><i class="fa-solid fa-book-open" style="color:var(--primary)"></i> Jurnal Terbaru — Perlu Validasi</div>
            <a href="{{ route('pembimbing.jurnal.index') }}?status=pending" class="card-link">Semua →</a>
        </div>
        @forelse($jurnalPending as $j)
        <div class="j-item">
            <div class="j-dot"></div>
            <div class="j-day">{{ \Carbon\Carbon::parse($j->tanggal)->format('d M') }}</div>
            <div style="flex:1">
                <div class="j-siswa">{{ $j->siswa->nama_depan }} {{ $j->siswa->nama_belakang }}</div>
                <div class="j-act">{{ Str::limit($j->kegiatan, 65) }}</div>
            </div>
            <a href="{{ route('pembimbing.jurnal.show', $j->id) }}" class="btn btn-sm btn-out">Tinjau</a>
        </div>
        @empty
        <div class="empty" style="padding:30px">
            <div class="empty-ic"><i class="fa-solid fa-circle-check" style="color:#22c55e;font-size:2rem"></i></div>
            <p>Semua jurnal sudah divalidasi!</p>
        </div>
        @endforelse
    </div>

    {{-- Daftar Siswa ── --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title"><i class="fa-solid fa-users" style="color:var(--primary)"></i> Siswa Bimbingan</div>
            <a href="{{ route('pembimbing.pkl.index') }}" class="card-link">Detail →</a>
        </div>
        @forelse($daftarSiswa->take(6) as $siswa)
        <div class="siswa-item">
            <div class="siswa-av">{{ strtoupper(substr($siswa->nama_depan,0,1).substr($siswa->nama_belakang,0,1)) }}</div>
            <div style="flex:1">
                <div class="siswa-name">{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</div>
                <div class="siswa-info">{{ $siswa->profilSiswa->kelas ?? '—' }} · {{ $siswa->profilSiswa->jurusan ?? '—' }}</div>
            </div>
            @php $pklSiswa = $siswa->pklAnggota->first()?->pengajuan; @endphp
            @if($pklSiswa)
                <span class="bdg bdg-ok" style="font-size:.65rem">Aktif</span>
            @else
                <span class="bdg bdg-gray" style="font-size:.65rem">Belum PKL</span>
            @endif
        </div>
        @empty
        <div class="empty" style="padding:30px">
            <div class="empty-ic"><i class="fa-solid fa-users" style="color:var(--text-muted);font-size:2rem"></i></div>
            <p>Belum ada siswa bimbingan.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- LAPORAN TERBARU ── --}}
<div class="card full-col">
    <div class="card-head">
        <div class="card-title"><i class="fa-solid fa-file-lines" style="color:var(--primary)"></i> Laporan Terbaru — Perlu Ditinjau</div>
        <a href="{{ route('pembimbing.laporan.index') }}" class="card-link">Semua →</a>
    </div>
    <div class="tbl-wrap">
        <table>
            <thead><tr><th>Siswa</th><th>Judul Laporan</th><th>Jenis</th><th>Dikirim</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse($laporanTerbaru as $l)
            <tr>
                <td style="font-weight:600">{{ $l->siswa->nama_depan }} {{ $l->siswa->nama_belakang }}</td>
                <td>{{ Str::limit($l->judul_laporan, 40) }}</td>
                <td><span class="bdg bdg-info">{{ ucfirst($l->jenis_laporan) }}</span></td>
                <td style="font-size:.78rem;color:var(--text-muted)">{{ \Carbon\Carbon::parse($l->created_at)->format('d M Y') }}</td>
                <td>
                    @if($l->status_pembimbing==='disetujui') <span class="bdg bdg-ok">Disetujui</span>
                    @elseif($l->status_pembimbing==='revisi') <span class="bdg bdg-err">Revisi</span>
                    @else <span class="bdg bdg-warn">Pending</span> @endif
                </td>
                <td>
                    <a href="{{ route('pembimbing.laporan.show', $l->id) }}" class="btn btn-xs btn-out"><i class="fa-solid fa-eye"></i> Tinjau</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6"><div class="empty" style="padding:24px"><p>Belum ada laporan masuk.</p></div></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection