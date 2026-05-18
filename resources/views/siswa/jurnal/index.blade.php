@extends('layouts.siswa')
@section('title','Jurnal Harian')
@section('page_title','Jurnal Harian')
@section('nav_jurnal','active')

@section('content')

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px">
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <span class="stat-badge info">Total</span>
        </div>
        <div class="stat-num">{{ $totalJurnal }}</div>
        <div class="stat-label">Total Jurnal</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <span class="stat-badge up">Valid</span>
        </div>
        <div class="stat-num">{{ $jurnalValid }}</div>
        <div class="stat-label">Tervalidasi</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <span class="stat-badge warn">Proses</span>
        </div>
        <div class="stat-num">{{ $jurnalPending }}</div>
        <div class="stat-label">Pending</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title-sm">Daftar Jurnal Harian</div>
            <div class="card-subtitle">Semua catatan kegiatan PKL kamu</div>
        </div>
        <a href="{{ route('siswa.jurnal.create') }}" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Jurnal
        </a>
    </div>

    {{-- Filter --}}
    <div style="padding:14px 0 16px;border-bottom:1px solid var(--border);display:flex;gap:10px;flex-wrap:wrap">
        <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;width:100%">
            <select name="status" onchange="this.form.submit()" style="padding:8px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);cursor:pointer;outline:none">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                <option value="valid"   {{ request('status')=='valid'  ?'selected':'' }}>Valid</option>
                <option value="tolak"   {{ request('status')=='tolak'  ?'selected':'' }}>Ditolak</option>
            </select>
            <select name="bulan" onchange="this.form.submit()" style="padding:8px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);cursor:pointer;outline:none">
                <option value="">Semua Bulan</option>
                @for($m=1;$m<=12;$m++)
                <option value="{{ $m }}" {{ request('bulan')==$m?'selected':'' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                @endfor
            </select>
            @if(request()->hasAny(['status','bulan']))
            <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div style="overflow-x:auto;margin-top:4px">
        <table style="width:100%;border-collapse:collapse;font-size:.82rem">
            <thead>
                <tr style="border-bottom:1px solid var(--border)">
                    @foreach(['#','Tanggal','Jam','Kegiatan','Foto','Status','Aksi'] as $h)
                    <th style="padding:10px 12px;text-align:left;font-size:.7rem;font-weight:700;color:var(--text-sub);letter-spacing:.05em;text-transform:uppercase;white-space:nowrap">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($jurnals as $i => $j)
                <tr style="border-bottom:1px solid var(--border);transition:background .15s" onmouseover="this.style.background='var(--tag-bg)'" onmouseout="this.style.background=''">
                    <td style="padding:12px;color:var(--text-sub)">{{ $jurnals->firstItem() + $i }}</td>
                    <td style="padding:12px">
                        <div style="font-weight:600;color:var(--text)">{{ $j->tanggal->format('d M Y') }}</div>
                        <div style="font-size:.7rem;color:var(--text-sub);margin-top:2px">{{ $j->tanggal->translatedFormat('l') }}</div>
                    </td>
                    <td style="padding:12px">
                        @if($j->jam_masuk)
                            <div style="font-size:.75rem;color:var(--text-muted)">{{ $j->jamMasukFormatted() }}</div>
                            <div style="font-size:.75rem;color:var(--text-muted)">{{ $j->jamKeluarFormatted() }}</div>
                        @else
                            <span style="color:var(--text-sub)">—</span>
                        @endif
                    </td>
                    <td style="padding:12px;max-width:260px">
                        <div style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;color:var(--text)">{{ $j->kegiatan }}</div>
                        @if($j->komentar_pembimbing)
                        <div style="margin-top:4px;font-size:.72rem;color:var(--primary)">💬 {{ Str::limit($j->komentar_pembimbing,60) }}</div>
                        @endif
                    </td>
                    <td style="padding:12px">
                        @if($j->foto_kegiatan)
                            <img src="{{ asset('storage/'.$j->foto_kegiatan) }}" style="width:40px;height:40px;object-fit:cover;border-radius:8px;border:1px solid var(--border)">
                        @else
                            <span style="color:var(--text-sub);font-size:.75rem">—</span>
                        @endif
                    </td>
                    <td style="padding:12px">
                        @php
                            $badgeMap = ['valid'=>'approved','pending'=>'pending','tolak'=>'rejected'];
                            $bc = $badgeMap[$j->status_validasi] ?? 'info';
                        @endphp
                        <span class="badge {{ $bc }}">{{ ucfirst($j->status_validasi) }}</span>
                    </td>
                    <td style="padding:12px">
                        <div style="display:flex;gap:6px">
                            @if($j->status_validasi === 'pending')
                            <a href="{{ route('siswa.jurnal.edit',$j->id) }}" class="btn-secondary" style="padding:5px 11px;font-size:.72rem">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('siswa.jurnal.destroy',$j->id) }}" method="POST" onsubmit="return confirm('Hapus jurnal ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="padding:5px 11px;font-size:.72rem;border-radius:10px;border:1px solid rgba(239,68,68,.3);background:rgba(239,68,68,.06);color:#ef4444;cursor:pointer;font-family:var(--font);font-weight:600;display:flex;align-items:center;gap:4px;transition:all .2s" onmouseover="this.style.background='rgba(239,68,68,.12)'" onmouseout="this.style.background='rgba(239,68,68,.06)'">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                    Hapus
                                </button>
                            </form>
                            @else
                            <span style="font-size:.75rem;color:var(--text-sub)">—</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="empty-title">Belum Ada Jurnal</div>
                            <div class="empty-desc">Mulai catat aktivitas PKL kamu setiap hari.<br>
                                <a href="{{ route('siswa.jurnal.create') }}" style="color:var(--primary);font-weight:600">Tambah jurnal sekarang →</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($jurnals->hasPages())
    <div style="padding:16px 0 4px">{{ $jurnals->links() }}</div>
    @endif
</div>

@endsection