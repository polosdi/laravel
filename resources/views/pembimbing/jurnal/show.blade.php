{{-- ═══════════════════════════════════════════
     resources/views/pembimbing/jurnal/show.blade.php
═══════════════════════════════════════════ --}}
@extends('layouts.pembimbing')
@section('title','Detail Jurnal')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
/* ── PAGE HEADER ── */
.pg-head{
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:22px;flex-wrap:wrap;gap:12px;
}
.pg-head-l .breadcrumb{
    font-size:.72rem;color:var(--text-muted);
    display:flex;align-items:center;gap:6px;margin-bottom:5px;
}
.pg-head-l .breadcrumb a{color:var(--primary);text-decoration:none;font-weight:500}
.pg-head-l .breadcrumb a:hover{text-decoration:underline}
.pg-head-l h2{
    font-size:1.25rem;font-weight:800;color:var(--text);
    letter-spacing:-.02em;display:flex;align-items:center;gap:9px;
}
.pg-head-l h2 .h-ic{
    width:36px;height:36px;
    background:linear-gradient(135deg,rgba(102,126,234,.15),rgba(118,75,162,.1));
    border-radius:10px;display:flex;align-items:center;justify-content:center;
    color:var(--primary);font-size:.95rem;
}

/* ── BACK BUTTON ── */
.btn-back{
    display:inline-flex;align-items:center;gap:7px;
    padding:8px 16px;border-radius:10px;font-size:.825rem;font-weight:600;
    border:1.5px solid var(--border);background:transparent;color:var(--text-muted);
    text-decoration:none;transition:all .2s;font-family:var(--font);
}
.btn-back:hover{border-color:var(--primary);color:var(--primary)}

/* ── GRID LAYOUT ── */
.detail-grid{
    display:grid;
    grid-template-columns:1.4fr 1fr;
    gap:20px;max-width:1000px;
}
@media(max-width:720px){.detail-grid{grid-template-columns:1fr}}

/* ── CARD ── */
.card{
    background:var(--card-bg);border:1px solid var(--border);
    border-radius:18px;overflow:hidden;
}
.card-head{
    display:flex;align-items:center;justify-content:space-between;
    padding:16px 20px;border-bottom:1px solid var(--border);
    background:linear-gradient(135deg,rgba(102,126,234,.04),rgba(118,75,162,.03));
}
.card-title{
    font-size:.875rem;font-weight:700;color:var(--text);
    display:flex;align-items:center;gap:8px;
}
.card-title .ct-ic{
    width:28px;height:28px;background:linear-gradient(135deg,rgba(102,126,234,.15),rgba(118,75,162,.1));
    border-radius:8px;display:flex;align-items:center;justify-content:center;
    color:var(--primary);font-size:.75rem;
}
.card-body{padding:20px}

/* ── INFO BLOCKS ── */
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px}
.info-block{background:rgba(102,126,234,.06);border-radius:10px;padding:13px}
.info-label{font-size:.68rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px}
.info-value{font-weight:700;font-size:.875rem;color:var(--text)}

/* ── KEGIATAN BLOCK ── */
.section-label{font-size:.73rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px}
.kegiatan-box{
    font-size:.875rem;line-height:1.75;color:var(--text);
    background:var(--stat-bg,rgba(0,0,0,.03));
    border-radius:10px;padding:14px;border:1px solid var(--border);
    margin-bottom:16px;
}

/* ── FOTO ── */
.foto-full{
    width:100%;max-height:220px;object-fit:cover;
    border-radius:10px;border:1px solid var(--border);
    display:block;
}

/* ── KOMENTAR BOX ── */
.komentar-box{
    margin-top:16px;background:rgba(102,126,234,.06);
    border-radius:10px;padding:13px;
    border-left:3px solid var(--primary);
}
.komentar-label{font-size:.72rem;font-weight:700;color:var(--primary);margin-bottom:5px}
.komentar-text{font-size:.825rem;color:var(--text)}

/* ── SISWA CARD ── */
.siswa-row{display:flex;align-items:center;gap:12px;margin-bottom:14px}
.siswa-av{
    width:44px;height:44px;border-radius:50%;background:var(--grad);
    display:flex;align-items:center;justify-content:center;
    font-weight:700;color:#fff;font-size:.78rem;flex-shrink:0;
}
.siswa-fullname{font-weight:700;font-size:.875rem;color:var(--text)}
.siswa-meta{font-size:.72rem;color:var(--text-muted)}
.siswa-nis{font-size:.78rem;color:var(--text-muted);padding-top:4px;border-top:1px solid var(--border)}

/* ── BADGES ── */
.bdg{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:.72rem;font-weight:700;white-space:nowrap}
.bdg-ok{background:rgba(34,197,94,.1);color:#16a34a}
.bdg-err{background:rgba(239,68,68,.1);color:#dc2626}
.bdg-warn{background:rgba(245,158,11,.1);color:#d97706}

/* ── ALERT ── */
.al{border-radius:10px;padding:12px 14px;font-size:.825rem;font-weight:600;margin-bottom:12px;display:flex;align-items:center;gap:8px}
.al-ok{background:rgba(34,197,94,.1);color:#16a34a}
.al-err{background:rgba(239,68,68,.1);color:#dc2626}

/* ── FORM ── */
.fgrp{margin-bottom:12px}
.fgrp label{display:block;font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px}
.fgrp textarea{
    width:100%;padding:10px 13px;border:1px solid var(--border);border-radius:10px;
    font-family:var(--font);font-size:.825rem;background:var(--bg);color:var(--text);
    outline:none;resize:vertical;transition:border-color .2s;box-sizing:border-box;
}
.fgrp textarea:focus{border-color:var(--primary)}

/* ── FORM ACTION BUTTONS ── */
.btn-valid-lg{
    display:inline-flex;align-items:center;gap:7px;
    padding:9px 18px;border-radius:10px;font-size:.825rem;font-weight:600;
    border:none;cursor:pointer;font-family:var(--font);
    background:rgba(34,197,94,.12);color:#16a34a;
    transition:all .2s;flex:1;justify-content:center;
}
.btn-valid-lg:hover{background:rgba(34,197,94,.22);transform:translateY(-1px)}
.btn-tolak-lg{
    display:inline-flex;align-items:center;gap:7px;
    padding:9px 18px;border-radius:10px;font-size:.825rem;font-weight:600;
    border:none;cursor:pointer;font-family:var(--font);
    background:rgba(239,68,68,.1);color:#dc2626;
    transition:all .2s;flex:1;justify-content:center;
}
.btn-tolak-lg:hover{background:rgba(239,68,68,.2);transform:translateY(-1px)}
</style>
@endpush

@section('content')

{{-- PAGE HEADER --}}
<div class="pg-head">
    <div class="pg-head-l">
        <div class="breadcrumb">
            <a href="{{ route('pembimbing.jurnal.index') }}">Jurnal</a>
            <span>/</span>
            <span>Detail</span>
        </div>
        <h2>
            <div class="h-ic"><i class="fa-solid fa-book-open"></i></div>
            Detail Jurnal Harian
        </h2>
    </div>
    <a href="{{ route('pembimbing.jurnal.index') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="detail-grid">

    {{-- ── KIRI: DETAIL JURNAL ── --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">
                <div class="ct-ic"><i class="fa-solid fa-pen-to-square"></i></div>
                Isi Jurnal
            </div>
            @if($jurnal->status_validasi==='valid')
                <span class="bdg bdg-ok"><i class="fa-solid fa-circle-check" style="font-size:.65rem"></i> Valid</span>
            @elseif($jurnal->status_validasi==='tolak')
                <span class="bdg bdg-err"><i class="fa-solid fa-circle-xmark" style="font-size:.65rem"></i> Ditolak</span>
            @else
                <span class="bdg bdg-warn"><i class="fa-solid fa-clock" style="font-size:.65rem"></i> Menunggu Validasi</span>
            @endif
        </div>
        <div class="card-body">

            {{-- Tanggal & Jam --}}
            <div class="info-grid">
                <div class="info-block">
                    <div class="info-label"><i class="fa-regular fa-calendar" style="margin-right:4px"></i>Tanggal</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($jurnal->tanggal)->translatedFormat('l, d F Y') }}</div>
                </div>
                <div class="info-block">
                    <div class="info-label"><i class="fa-regular fa-clock" style="margin-right:4px"></i>Jam Kerja</div>
                    <div class="info-value">{{ $jurnal->jam_masuk ?? '—' }} — {{ $jurnal->jam_keluar ?? '—' }}</div>
                </div>
            </div>

            {{-- Kegiatan --}}
            <div style="margin-bottom:16px">
                <div class="section-label"><i class="fa-solid fa-list-check" style="margin-right:5px"></i>Kegiatan</div>
                <div class="kegiatan-box">{{ $jurnal->kegiatan }}</div>
            </div>

            {{-- Foto --}}
            @if($jurnal->foto_kegiatan)
            <div>
                <div class="section-label"><i class="fa-solid fa-image" style="margin-right:5px"></i>Foto Kegiatan</div>
                <img src="{{ Storage::url($jurnal->foto_kegiatan) }}" class="foto-full">
            </div>
            @endif

            {{-- Komentar --}}
            @if($jurnal->komentar_pembimbing)
            <div class="komentar-box">
                <div class="komentar-label"><i class="fa-solid fa-comment-dots" style="margin-right:5px"></i>Komentar Pembimbing</div>
                <div class="komentar-text">{{ $jurnal->komentar_pembimbing }}</div>
            </div>
            @endif

        </div>
    </div>

    {{-- ── KANAN: SISWA + VALIDASI ── --}}
    <div style="display:flex;flex-direction:column;gap:16px">

        {{-- Info Siswa --}}
        <div class="card">
            <div class="card-head">
                <div class="card-title">
                    <div class="ct-ic"><i class="fa-solid fa-user-graduate"></i></div>
                    Info Siswa
                </div>
            </div>
            <div class="card-body">
                <div class="siswa-row">
                    <div class="siswa-av">
                        {{ strtoupper(substr($jurnal->siswa->nama_depan,0,1).substr($jurnal->siswa->nama_belakang,0,1)) }}
                    </div>
                    <div>
                        <div class="siswa-fullname">{{ $jurnal->siswa->nama_depan }} {{ $jurnal->siswa->nama_belakang }}</div>
                        <div class="siswa-meta">
                            {{ $jurnal->siswa->profilSiswa->kelas ?? '' }}
                            @if($jurnal->siswa->profilSiswa->kelas && $jurnal->siswa->profilSiswa->jurusan) — @endif
                            {{ $jurnal->siswa->profilSiswa->jurusan ?? '' }}
                        </div>
                    </div>
                </div>
                <div class="siswa-nis">
                    <i class="fa-solid fa-id-card" style="margin-right:5px;opacity:.6"></i>
                    NIS: {{ $jurnal->siswa->profilSiswa->nis ?? '—' }}
                </div>
            </div>
        </div>

        {{-- Form Validasi --}}
        @if($jurnal->status_validasi === 'pending')
        <div class="card">
            <div class="card-head">
                <div class="card-title">
                    <div class="ct-ic"><i class="fa-solid fa-bolt"></i></div>
                    Validasi Jurnal
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pembimbing.jurnal.validasi', $jurnal->id) }}">
                    @csrf
                    <div class="fgrp">
                        <label><i class="fa-solid fa-comment" style="margin-right:5px"></i>Komentar / Catatan</label>
                        <textarea name="komentar_pembimbing" rows="4"
                            placeholder="Tuliskan feedback untuk siswa (opsional)...">{{ old('komentar_pembimbing') }}</textarea>
                    </div>
                    <div style="display:flex;gap:10px">
                        <button type="submit" name="status" value="valid" class="btn-valid-lg">
                            <i class="fa-solid fa-check"></i> Validasi
                        </button>
                        <button type="submit" name="status" value="tolak" class="btn-tolak-lg">
                            <i class="fa-solid fa-xmark"></i> Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @else
        <div class="card">
            <div class="card-body">
                @if($jurnal->status_validasi==='valid')
                    <div class="al al-ok"><i class="fa-solid fa-circle-check"></i> Jurnal ini sudah divalidasi</div>
                @else
                    <div class="al al-err"><i class="fa-solid fa-circle-xmark"></i> Jurnal ini ditolak</div>
                @endif
                <form method="POST" action="{{ route('pembimbing.jurnal.validasi', $jurnal->id) }}">
                    @csrf
                    <div class="fgrp">
                        <label><i class="fa-solid fa-comment" style="margin-right:5px"></i>Update Komentar</label>
                        <textarea name="komentar_pembimbing" rows="3">{{ $jurnal->komentar_pembimbing }}</textarea>
                    </div>
                    <div style="display:flex;gap:8px">
                        <button name="status" value="valid" class="btn-valid-lg">
                            <i class="fa-solid fa-check"></i> Validasi
                        </button>
                        <button name="status" value="tolak" class="btn-tolak-lg">
                            <i class="fa-solid fa-xmark"></i> Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    </div>
    {{-- END KANAN --}}

</div>
@endsection