@extends('layouts.pembimbing')
@section('title','Pengajuan PKL')

@push('styles')
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
    width:36px;height:36px;background:linear-gradient(135deg,rgba(102,126,234,.15),rgba(118,75,162,.1));
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
.filter-select{
    padding:8px 13px;border:1px solid var(--border);border-radius:10px;
    font-family:var(--font);font-size:.825rem;
    background:var(--bg);color:var(--text);outline:none;
    cursor:pointer;transition:border-color .2s;
}
.filter-select:focus{border-color:var(--primary)}
.filter-divider{width:1px;height:20px;background:var(--border);flex-shrink:0}
.btn-filter{
    display:inline-flex;align-items:center;gap:7px;
    padding:8px 16px;border-radius:10px;font-size:.825rem;font-weight:600;
    cursor:pointer;transition:all .2s;font-family:var(--font);border:1.5px solid var(--border);
    background:var(--primary);color:#fff;border-color:var(--primary);
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

/* ── TABLE IMPROVEMENTS ── */
.card{
    background:var(--card-bg);border:1px solid var(--border);
    border-radius:18px;overflow:hidden;
}
.tbl-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse}
thead tr{background:linear-gradient(135deg,rgba(102,126,234,.06),rgba(118,75,162,.04));border-bottom:1px solid var(--border)}
th{
    padding:13px 18px;text-align:left;
    font-size:.7rem;font-weight:700;letter-spacing:.07em;
    text-transform:uppercase;color:var(--text-muted);white-space:nowrap;
}
td{padding:14px 18px;border-bottom:1px solid var(--border);vertical-align:middle}
tr:last-child td{border-bottom:none}
tbody tr{transition:background .15s}
tbody tr:hover{background:rgba(102,126,234,.03)}

/* ── KETUA CELL ── */
.ketua-cell{display:flex;align-items:center;gap:10px}
.ketua-av{
    width:34px;height:34px;border-radius:50%;background:var(--grad);
    display:flex;align-items:center;justify-content:center;
    font-size:.7rem;font-weight:700;color:#fff;flex-shrink:0;
}
.ketua-name{font-weight:600;font-size:.825rem;color:var(--text)}

/* ── COMPANY CELL ── */
.company-name{font-weight:600;font-size:.825rem;color:var(--text);line-height:1.3}
.company-addr{font-size:.72rem;color:var(--text-muted);margin-top:2px}

/* ── ANGGOTA PILL ── */
.anggota-pill{
    display:inline-flex;align-items:center;gap:5px;
    background:rgba(102,126,234,.08);color:var(--primary);
    border-radius:20px;padding:4px 10px;
    font-size:.73rem;font-weight:600;
}

/* ── DATE ── */
.date-cell{font-size:.78rem;color:var(--text-muted);white-space:nowrap}

/* ── DOC BUTTON ── */
.btn-doc{
    display:inline-flex;align-items:center;gap:5px;
    padding:5px 10px;border-radius:8px;font-size:.75rem;font-weight:600;
    border:1.5px solid var(--border);color:var(--primary);
    background:rgba(102,126,234,.06);text-decoration:none;
    transition:all .2s;
}
.btn-doc:hover{background:rgba(102,126,234,.14);border-color:var(--primary)}

/* ── BADGES ── */
.bdg{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:.72rem;font-weight:700;white-space:nowrap}
.bdg-ok{background:rgba(34,197,94,.1);color:#16a34a}
.bdg-err{background:rgba(239,68,68,.1);color:#dc2626}
.bdg-warn{background:rgba(245,158,11,.1);color:#d97706}

/* ── ACTION BUTTONS ── */
.btn-setujui{
    display:inline-flex;align-items:center;gap:5px;
    padding:6px 13px;border-radius:9px;font-size:.775rem;font-weight:600;
    border:none;cursor:pointer;font-family:var(--font);
    background:rgba(34,197,94,.12);color:#16a34a;
    transition:all .2s;
}
.btn-setujui:hover{background:rgba(34,197,94,.22);transform:translateY(-1px)}
.btn-tolak{
    display:inline-flex;align-items:center;gap:5px;
    padding:6px 13px;border-radius:9px;font-size:.775rem;font-weight:600;
    border:none;cursor:pointer;font-family:var(--font);
    background:rgba(239,68,68,.1);color:#dc2626;
    transition:all .2s;
}
.btn-tolak:hover{background:rgba(239,68,68,.2);transform:translateY(-1px)}
.processed-label{
    display:inline-flex;align-items:center;gap:5px;
    font-size:.75rem;color:var(--text-muted);
    background:rgba(0,0,0,.04);border-radius:8px;padding:5px 10px;
}

/* ── EMPTY ── */
.empty{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:48px 20px;gap:10px}
.empty-ic{font-size:2.2rem;opacity:.5}
.empty p{font-size:.875rem;color:var(--text-muted);font-weight:500}

/* ── PAGINATION ── */
.pagi{padding:16px 18px;border-top:1px solid var(--border)}
</style>
@endpush

@section('content')

{{-- PAGE HEADER --}}
<div class="pg-head">
    <div class="pg-head-l">
        <div class="breadcrumb">
            <a href="{{ route('pembimbing.dashboard') }}">Dashboard</a>
            <span>/</span>
            <span>PKL</span>
        </div>
        <h2>
            <div class="h-ic"><i class="fa-solid fa-clipboard-list"></i></div>
            Pengajuan PKL Siswa
        </h2>
    </div>
</div>

{{-- FILTER BAR --}}
<form method="GET" class="filter-bar">
    <label><i class="fa-solid fa-filter" style="margin-right:4px"></i>Filter Status</label>
    <select name="status" class="filter-select">
        <option value="">Semua Status</option>
        <option value="pending"   {{ request('status')=='pending'   ? 'selected' : '' }}>Pending</option>
        <option value="disetujui" {{ request('status')=='disetujui' ? 'selected' : '' }}>Disetujui</option>
        <option value="ditolak"   {{ request('status')=='ditolak'   ? 'selected' : '' }}>Ditolak</option>
    </select>
    <div class="filter-divider"></div>
    <button type="submit" class="btn-filter">
        <i class="fa-solid fa-magnifying-glass"></i> Terapkan
    </button>
    <a href="{{ route('pembimbing.pkl.index') }}" class="btn-reset">
        <i class="fa-solid fa-rotate-left"></i> Reset
    </a>
</form>

{{-- TABLE --}}
<div class="card">
    <div class="tbl-wrap">
        <table>
            <thead>
                <tr>
                    <th>Ketua Kelompok</th>
                    <th>Perusahaan</th>
                    <th>Anggota</th>
                    <th>Tanggal Ajuan</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($pkl as $p)
            <tr>
                {{-- Ketua --}}
                <td>
                    <div class="ketua-cell">
                        <div class="ketua-av">
                            {{ strtoupper(substr($p->ketua->nama_depan,0,1).substr($p->ketua->nama_belakang,0,1)) }}
                        </div>
                        <div class="ketua-name">{{ $p->ketua->nama_depan }} {{ $p->ketua->nama_belakang }}</div>
                    </div>
                </td>

                {{-- Perusahaan --}}
                <td>
                    <div class="company-name">{{ $p->nama_perusahaan }}</div>
                    <div class="company-addr">{{ Str::limit($p->alamat_perusahaan, 40) }}</div>
                </td>

                {{-- Anggota --}}
                <td>
                    <span class="anggota-pill">
                        <i class="fa-solid fa-users" style="font-size:.68rem"></i>
                        {{ $p->anggota->count() }} siswa
                    </span>
                </td>

                {{-- Tanggal --}}
                <td>
                    <div class="date-cell">
                        <i class="fa-regular fa-calendar" style="margin-right:4px;opacity:.6"></i>
                        {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d M Y') }}
                    </div>
                </td>

                {{-- Dokumen --}}
                <td>
                    @if($p->file_dokumen)
                        <a href="{{ Storage::url($p->file_dokumen) }}" target="_blank" class="btn-doc">
                            <i class="fa-solid fa-paperclip"></i> Lihat
                        </a>
                    @else
                        <span style="color:var(--text-muted);font-size:.82rem">—</span>
                    @endif
                </td>

                {{-- Status --}}
                <td>
                    @if($p->status_pembimbing === 'disetujui')
                        <span class="bdg bdg-ok"><i class="fa-solid fa-circle-check" style="font-size:.65rem"></i> Disetujui</span>
                    @elseif($p->status_pembimbing === 'ditolak')
                        <span class="bdg bdg-err"><i class="fa-solid fa-circle-xmark" style="font-size:.65rem"></i> Ditolak</span>
                    @else
                        <span class="bdg bdg-warn"><i class="fa-solid fa-clock" style="font-size:.65rem"></i> Pending</span>
                    @endif
                </td>

                {{-- Aksi --}}
                <td>
                    @if($p->status_pembimbing === 'pending')
                    <div style="display:flex;gap:6px">
                        <form method="POST" action="{{ route('pembimbing.pkl.setujui', $p->id) }}">
                            @csrf
                            <button type="submit" class="btn-setujui">
                                <i class="fa-solid fa-check"></i> Setujui
                            </button>
                        </form>
                        <form method="POST" action="{{ route('pembimbing.pkl.tolak', $p->id) }}">
                            @csrf
                            <button type="submit" class="btn-tolak">
                                <i class="fa-solid fa-xmark"></i> Tolak
                            </button>
                        </form>
                    </div>
                    @else
                        <span class="processed-label">
                            <i class="fa-solid fa-circle-check" style="font-size:.65rem;opacity:.6"></i>
                            Sudah diproses
                        </span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty">
                        <div class="empty-ic"><i class="fa-solid fa-clipboard-list" style="color:var(--text-muted)"></i></div>
                        <p>Belum ada pengajuan PKL.</p>
                    </div>
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($pkl->hasPages())
        <div class="pagi">{{ $pkl->links() }}</div>
    @endif
</div>

@endsection