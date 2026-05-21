{{-- ═══════════════════════════════════════════
     resources/views/pembimbing/jurnal/index.blade.php
═══════════════════════════════════════════ --}}
@extends('layouts.pembimbing')
@section('title','Jurnal Harian Siswa')

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

/* ── FILTER BAR ── */
.filter-bar{
    display:flex;align-items:center;gap:10px;
    background:var(--card-bg);border:1px solid var(--border);
    border-radius:14px;padding:14px 18px;margin-bottom:20px;
    flex-wrap:wrap;
}
.filter-bar label{
    font-size:.72rem;font-weight:700;text-transform:uppercase;
    letter-spacing:.06em;color:var(--text-muted);white-space:nowrap;
}
.filter-select, .filter-input{
    padding:8px 13px;border:1px solid var(--border);border-radius:10px;
    font-family:var(--font);font-size:.825rem;
    background:var(--bg);color:var(--text);outline:none;
    cursor:pointer;transition:border-color .2s;
}
.filter-select:focus,.filter-input:focus{border-color:var(--primary)}
.filter-divider{width:1px;height:20px;background:var(--border);flex-shrink:0}
.btn-filter{
    display:inline-flex;align-items:center;gap:7px;
    padding:8px 16px;border-radius:10px;font-size:.825rem;font-weight:600;
    cursor:pointer;transition:all .2s;font-family:var(--font);
    border:1.5px solid var(--primary);
    background:var(--primary);color:#fff;
}
.btn-filter:hover{opacity:.88}
.btn-reset{
    display:inline-flex;align-items:center;gap:7px;
    padding:8px 16px;border-radius:10px;font-size:.825rem;font-weight:600;
    cursor:pointer;transition:all .2s;font-family:var(--font);
    border:1.5px solid var(--border);background:transparent;color:var(--text-muted);
    text-decoration:none;
}
.btn-reset:hover{border-color:var(--primary);color:var(--primary)}

/* ── CARD & TABLE ── */
.card{
    background:var(--card-bg);border:1px solid var(--border);
    border-radius:18px;overflow:hidden;
}
.tbl-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse}
thead tr{
    background:linear-gradient(135deg,rgba(102,126,234,.06),rgba(118,75,162,.04));
    border-bottom:1px solid var(--border);
}
th{
    padding:13px 18px;text-align:left;
    font-size:.7rem;font-weight:700;letter-spacing:.07em;
    text-transform:uppercase;color:var(--text-muted);white-space:nowrap;
}
td{padding:14px 18px;border-bottom:1px solid var(--border);vertical-align:middle}
tr:last-child td{border-bottom:none}
tbody tr{transition:background .15s}
tbody tr:hover{background:rgba(102,126,234,.03)}

/* ── SISWA CELL ── */
.siswa-cell{display:flex;align-items:center;gap:10px}
.siswa-av{
    width:34px;height:34px;border-radius:50%;background:var(--grad);
    display:flex;align-items:center;justify-content:center;
    font-size:.7rem;font-weight:700;color:#fff;flex-shrink:0;
}
.siswa-name{font-weight:600;font-size:.825rem;color:var(--text)}
.siswa-kelas{font-size:.7rem;color:var(--text-muted);margin-top:1px}

/* ── DATE & TIME CELL ── */
.date-cell{font-size:.78rem;font-weight:600;color:var(--text);white-space:nowrap}
.time-cell{font-size:.78rem;color:var(--text-muted);white-space:nowrap}

/* ── KEGIATAN CELL ── */
.kegiatan-text{font-size:.8rem;color:var(--text);line-height:1.45;max-width:200px}

/* ── FOTO THUMB ── */
.foto-thumb{
    width:36px;height:36px;object-fit:cover;
    border-radius:8px;border:1px solid var(--border);
    display:block;transition:transform .2s;
}
.foto-thumb:hover{transform:scale(1.08)}

/* ── BADGES ── */
.bdg{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:.72rem;font-weight:700;white-space:nowrap}
.bdg-ok{background:rgba(34,197,94,.1);color:#16a34a}
.bdg-err{background:rgba(239,68,68,.1);color:#dc2626}
.bdg-warn{background:rgba(245,158,11,.1);color:#d97706}

/* ── ACTION BUTTONS ── */
.btn-view{
    display:inline-flex;align-items:center;gap:5px;
    padding:5px 10px;border-radius:8px;font-size:.75rem;font-weight:600;
    border:1.5px solid var(--border);color:var(--primary);
    background:rgba(102,126,234,.06);text-decoration:none;
    transition:all .2s;
}
.btn-view:hover{background:rgba(102,126,234,.14);border-color:var(--primary)}
.btn-valid{
    display:inline-flex;align-items:center;gap:4px;
    padding:5px 10px;border-radius:8px;font-size:.75rem;font-weight:600;
    border:none;cursor:pointer;font-family:var(--font);
    background:rgba(34,197,94,.12);color:#16a34a;
    transition:all .2s;
}
.btn-valid:hover{background:rgba(34,197,94,.22);transform:translateY(-1px)}
.btn-tolak{
    display:inline-flex;align-items:center;gap:4px;
    padding:5px 10px;border-radius:8px;font-size:.75rem;font-weight:600;
    border:none;cursor:pointer;font-family:var(--font);
    background:rgba(239,68,68,.1);color:#dc2626;
    transition:all .2s;
}
.btn-tolak:hover{background:rgba(239,68,68,.2);transform:translateY(-1px)}

/* ── EMPTY ── */
.empty{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:48px 20px;gap:10px}
.empty-ic{font-size:2.2rem;opacity:.5}
.empty p{font-size:.875rem;color:var(--text-muted);font-weight:500}

/* ── PAGINATION ── */
.pagi{
    padding:14px 18px;border-top:1px solid var(--border);
    display:flex;align-items:center;justify-content:space-between;
    flex-wrap:wrap;gap:10px;
}
.pagi-info{font-size:.78rem;color:var(--text-muted)}
</style>
@endpush

@section('content')

{{-- PAGE HEADER --}}
<div class="pg-head">
    <div class="pg-head-l">
        <div class="breadcrumb">
            <a href="{{ route('pembimbing.dashboard') }}">Dashboard</a>
            <span>/</span>
            <span>Jurnal</span>
        </div>
        <h2>
            <div class="h-ic"><i class="fa-solid fa-book-open"></i></div>
            Jurnal Harian Siswa
        </h2>
    </div>
</div>

{{-- FILTER BAR --}}
<form method="GET" class="filter-bar">
    <label><i class="fa-solid fa-filter" style="margin-right:4px"></i>Filter</label>

    <select name="status" class="filter-select">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
        <option value="valid"   {{ request('status')=='valid'   ? 'selected' : '' }}>Valid</option>
        <option value="tolak"   {{ request('status')=='tolak'   ? 'selected' : '' }}>Ditolak</option>
    </select>

    <div class="filter-divider"></div>

    <select name="siswa_id" class="filter-select">
        <option value="">Semua Siswa</option>
        @foreach($daftarSiswa as $s)
        <option value="{{ $s->id }}" {{ request('siswa_id')==$s->id ? 'selected' : '' }}>
            {{ $s->nama_depan }} {{ $s->nama_belakang }}
        </option>
        @endforeach
    </select>

    <div class="filter-divider"></div>

    <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="filter-input">

    <button type="submit" class="btn-filter">
        <i class="fa-solid fa-magnifying-glass"></i> Terapkan
    </button>
    <a href="{{ route('pembimbing.jurnal.index') }}" class="btn-reset">
        <i class="fa-solid fa-rotate-left"></i> Reset
    </a>
</form>

{{-- TABLE --}}
<div class="card">
    <div class="tbl-wrap">
        <table>
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Kegiatan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($jurnal as $j)
            <tr>
                {{-- Siswa --}}
                <td>
                    <div class="siswa-cell">
                        <div class="siswa-av">
                            {{ strtoupper(substr($j->siswa->nama_depan,0,1).substr($j->siswa->nama_belakang,0,1)) }}
                        </div>
                        <div>
                            <div class="siswa-name">{{ $j->siswa->nama_depan }} {{ $j->siswa->nama_belakang }}</div>
                            <div class="siswa-kelas">{{ $j->siswa->profilSiswa->kelas ?? '' }}</div>
                        </div>
                    </div>
                </td>

                {{-- Tanggal --}}
                <td>
                    <div class="date-cell">
                        <i class="fa-regular fa-calendar" style="margin-right:4px;opacity:.6"></i>
                        {{ \Carbon\Carbon::parse($j->tanggal)->translatedFormat('d M Y') }}
                    </div>
                </td>

                {{-- Jam Masuk --}}
                <td>
                    <div class="time-cell">
                        <i class="fa-regular fa-clock" style="margin-right:4px;opacity:.6"></i>
                        {{ $j->jam_masuk ?? '—' }}
                    </div>
                </td>

                {{-- Jam Keluar --}}
                <td>
                    <div class="time-cell">
                        <i class="fa-regular fa-clock" style="margin-right:4px;opacity:.6"></i>
                        {{ $j->jam_keluar ?? '—' }}
                    </div>
                </td>

                {{-- Kegiatan --}}
                <td>
                    <div class="kegiatan-text">{{ Str::limit($j->kegiatan, 55) }}</div>
                </td>

                {{-- Foto --}}
                <td>
                    @if($j->foto_kegiatan)
                        <a href="{{ Storage::url($j->foto_kegiatan) }}" target="_blank">
                            <img src="{{ Storage::url($j->foto_kegiatan) }}" class="foto-thumb">
                        </a>
                    @else
                        <span style="color:var(--text-muted);font-size:.82rem">—</span>
                    @endif
                </td>

                {{-- Status --}}
                <td>
                    @if($j->status_validasi==='valid')
                        <span class="bdg bdg-ok"><i class="fa-solid fa-circle-check" style="font-size:.65rem"></i> Valid</span>
                    @elseif($j->status_validasi==='tolak')
                        <span class="bdg bdg-err"><i class="fa-solid fa-circle-xmark" style="font-size:.65rem"></i> Ditolak</span>
                    @else
                        <span class="bdg bdg-warn"><i class="fa-solid fa-clock" style="font-size:.65rem"></i> Pending</span>
                    @endif
                </td>

                {{-- Aksi --}}
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap">
                        <a href="{{ route('pembimbing.jurnal.show', $j->id) }}" class="btn-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        @if($j->status_validasi === 'pending')
                        <form method="POST" action="{{ route('pembimbing.jurnal.validasi', $j->id) }}">
                            @csrf
                            <input type="hidden" name="status" value="valid">
                            <button type="submit" class="btn-valid">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('pembimbing.jurnal.validasi', $j->id) }}">
                            @csrf
                            <input type="hidden" name="status" value="tolak">
                            <button type="submit" class="btn-tolak">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <div class="empty">
                        <div class="empty-ic"><i class="fa-solid fa-book-open" style="color:var(--text-muted)"></i></div>
                        <p>Tidak ada jurnal ditemukan.</p>
                    </div>
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($jurnal->hasPages())
    <div class="pagi">
        <span class="pagi-info">
            Menampilkan {{ $jurnal->firstItem() }}–{{ $jurnal->lastItem() }} dari {{ $jurnal->total() }} data
        </span>
        {{ $jurnal->links() }}
    </div>
    @endif
</div>

@endsection