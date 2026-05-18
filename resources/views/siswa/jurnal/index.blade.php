@extends('layouts.siswa')
@section('title','Jurnal Harian')
@section('page_title','Jurnal Harian')
@section('nav_jurnal','active')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
.jurnal-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 20px;
    align-items: start;
}
.stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}
.stat-card-v2 {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: all .25s;
}
.stat-card-v2:hover { transform: translateY(-2px); box-shadow: var(--card-hover); }
.stat-icon-v2 {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; flex-shrink: 0;
}
.stat-icon-v2.purple { background: rgba(102,126,234,.13); color: #667eea; }
.stat-icon-v2.green  { background: rgba(34,197,94,.13);   color: #22c55e; }
.stat-icon-v2.amber  { background: rgba(245,158,11,.13);  color: #f59e0b; }
.stat-info-v2 {}
.stat-num-v2 { font-size: 1.6rem; font-weight: 800; color: var(--text); line-height: 1; }
.stat-label-v2 { font-size: .72rem; color: var(--text-muted); margin-top: 3px; }

/* Sidebar info panel */
.info-panel {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    position: sticky;
    top: 84px;
}
.info-panel-header {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 8px;
}
.info-panel-header i { color: var(--primary); font-size: .85rem; }
.info-panel-title { font-size: .82rem; font-weight: 700; color: var(--text); }
.info-panel-body { padding: 14px 16px; }

.tip-item {
    display: flex; align-items: flex-start; gap: 10px;
    margin-bottom: 14px; padding-bottom: 14px;
    border-bottom: 1px solid var(--border);
}
.tip-item:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
.tip-ico {
    width: 32px; height: 32px; border-radius: 9px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem;
}
.tip-ico.blue   { background: rgba(59,130,246,.1); color: #3b82f6; }
.tip-ico.green  { background: rgba(34,197,94,.1);  color: #22c55e; }
.tip-ico.amber  { background: rgba(245,158,11,.1); color: #f59e0b; }
.tip-ico.red    { background: rgba(239,68,68,.1);  color: #ef4444; }
.tip-text { font-size: .72rem; color: var(--text-muted); line-height: 1.55; }
.tip-text strong { display: block; color: var(--text); font-size: .75rem; margin-bottom: 2px; }

.quick-stat {
    display: flex; align-items: center; justify-content: space-between;
    padding: 9px 12px; border-radius: 10px; background: var(--tag-bg);
    margin-bottom: 8px;
}
.quick-stat:last-child { margin-bottom: 0; }
.quick-stat-label { font-size: .72rem; color: var(--text-muted); display: flex; align-items: center; gap: 6px; }
.quick-stat-val { font-size: .8rem; font-weight: 700; color: var(--text); }

.filter-row {
    display: flex; gap: 8px; flex-wrap: wrap; align-items: center;
    padding: 12px 0 14px;
    border-bottom: 1px solid var(--border);
}
.filter-select {
    padding: 7px 11px; border-radius: 9px;
    border: 1px solid var(--border);
    background: var(--card-bg); color: var(--text);
    font-size: .78rem; font-family: var(--font);
    cursor: pointer; outline: none;
    display: flex; align-items: center; gap: 6px;
}
.filter-select:focus { border-color: var(--primary); }

@media (max-width: 1100px) {
    .jurnal-layout { grid-template-columns: 1fr; }
    .info-panel { position: static; }
    .stats-row { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 640px) {
    .stats-row { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')

{{-- Stats Row --}}
<div class="stats-row">
    <div class="stat-card-v2">
        <div class="stat-icon-v2 purple">
            <i class="fa-solid fa-book-open"></i>
        </div>
        <div class="stat-info-v2">
            <div class="stat-num-v2">{{ $totalJurnal }}</div>
            <div class="stat-label-v2">Total Jurnal</div>
        </div>
    </div>
    <div class="stat-card-v2">
        <div class="stat-icon-v2 green">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="stat-info-v2">
            <div class="stat-num-v2">{{ $jurnalValid }}</div>
            <div class="stat-label-v2">Tervalidasi</div>
        </div>
    </div>
    <div class="stat-card-v2">
        <div class="stat-icon-v2 amber">
            <i class="fa-solid fa-clock"></i>
        </div>
        <div class="stat-info-v2">
            <div class="stat-num-v2">{{ $jurnalPending }}</div>
            <div class="stat-label-v2">Pending</div>
        </div>
    </div>
</div>

{{-- Main 2-column layout --}}
<div class="jurnal-layout">

    {{-- LEFT: Main table card --}}
    <div>
        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title-sm" style="display:flex;align-items:center;gap:7px">
                        <i class="fa-solid fa-list-ul" style="color:var(--primary);font-size:.85rem"></i>
                        Daftar Jurnal Harian
                    </div>
                    <div class="card-subtitle">Semua catatan kegiatan PKL kamu</div>
                </div>
                <a href="{{ route('siswa.jurnal.create') }}" class="btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Jurnal
                </a>
            </div>

            {{-- Filter --}}
            <div style="padding:0 20px">
                <form method="GET" class="filter-row">
                    <div style="position:relative;display:flex;align-items:center">
                        <i class="fa-solid fa-filter" style="position:absolute;left:10px;color:var(--text-sub);font-size:.72rem"></i>
                        <select name="status" onchange="this.form.submit()" class="filter-select" style="padding-left:28px">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                            <option value="valid"   {{ request('status')=='valid'  ?'selected':'' }}>Valid</option>
                            <option value="tolak"   {{ request('status')=='tolak'  ?'selected':'' }}>Ditolak</option>
                        </select>
                    </div>
                    <div style="position:relative;display:flex;align-items:center">
                        <i class="fa-solid fa-calendar" style="position:absolute;left:10px;color:var(--text-sub);font-size:.72rem"></i>
                        <select name="bulan" onchange="this.form.submit()" class="filter-select" style="padding-left:28px">
                            <option value="">Semua Bulan</option>
                            @for($m=1;$m<=12;$m++)
                            <option value="{{ $m }}" {{ request('bulan')==$m?'selected':'' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                            @endfor
                        </select>
                    </div>
                    @if(request()->hasAny(['status','bulan']))
                    <a href="{{ route('siswa.jurnal') }}" class="btn-secondary" style="padding:7px 12px;font-size:.78rem">
                        <i class="fa-solid fa-xmark"></i> Reset
                    </a>
                    @endif
                </form>
            </div>

            {{-- Table --}}
            <div style="overflow-x:auto">
                <table style="width:100%;border-collapse:collapse;font-size:.82rem">
                    <thead>
                        <tr style="background:var(--tag-bg)">
                            @foreach([
                                ['#',''],
                                ['Tanggal','fa-calendar-days'],
                                ['Jam','fa-clock'],
                                ['Kegiatan','fa-pen-to-square'],
                                ['Foto','fa-image'],
                                ['Status','fa-circle-half-stroke'],
                                ['Aksi','fa-sliders'],
                            ] as [$h,$ic])
                            <th style="padding:10px 14px;text-align:left;font-size:.68rem;font-weight:700;color:var(--text-sub);letter-spacing:.05em;text-transform:uppercase;white-space:nowrap;border-bottom:1px solid var(--border)">
                                @if($ic)<i class="fa-solid {{ $ic }}" style="margin-right:5px;opacity:.6"></i>@endif{{ $h }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jurnals as $i => $j)
                        <tr style="border-bottom:1px solid var(--border);transition:background .15s" onmouseover="this.style.background='var(--tag-bg)'" onmouseout="this.style.background=''">
                            <td style="padding:12px 14px;color:var(--text-sub);font-size:.75rem">{{ $jurnals->firstItem() + $i }}</td>
                            <td style="padding:12px 14px">
                                <div style="font-weight:600;color:var(--text)">{{ $j->tanggal->format('d M Y') }}</div>
                                <div style="font-size:.7rem;color:var(--text-sub);margin-top:2px">
                                    <i class="fa-regular fa-calendar" style="margin-right:3px"></i>{{ $j->tanggal->translatedFormat('l') }}
                                </div>
                            </td>
                            <td style="padding:12px 14px">
                                @if($j->jam_masuk)
                                    <div style="font-size:.74rem;color:var(--text-muted);display:flex;align-items:center;gap:4px">
                                        <i class="fa-solid fa-arrow-right-to-bracket" style="color:#22c55e;font-size:.65rem"></i>
                                        {{ $j->jamMasukFormatted() }}
                                    </div>
                                    <div style="font-size:.74rem;color:var(--text-muted);display:flex;align-items:center;gap:4px;margin-top:2px">
                                        <i class="fa-solid fa-arrow-right-from-bracket" style="color:#ef4444;font-size:.65rem"></i>
                                        {{ $j->jamKeluarFormatted() }}
                                    </div>
                                @else
                                    <span style="color:var(--text-sub);font-size:.8rem">—</span>
                                @endif
                            </td>
                            <td style="padding:12px 14px;max-width:240px">
                                <div style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;color:var(--text)">{{ $j->kegiatan }}</div>
                                @if($j->komentar_pembimbing)
                                <div style="margin-top:5px;font-size:.7rem;color:var(--primary);display:flex;align-items:flex-start;gap:4px">
                                    <i class="fa-regular fa-comment-dots" style="margin-top:1px;flex-shrink:0"></i>
                                    {{ Str::limit($j->komentar_pembimbing, 55) }}
                                </div>
                                @endif
                            </td>
                            <td style="padding:12px 14px">
                                @if($j->foto_kegiatan)
                                    <img src="{{ asset('storage/'.$j->foto_kegiatan) }}" style="width:42px;height:42px;object-fit:cover;border-radius:9px;border:1px solid var(--border)">
                                @else
                                    <div style="width:42px;height:42px;border-radius:9px;border:1px dashed var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-sub)">
                                        <i class="fa-regular fa-image" style="font-size:.8rem"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="padding:12px 14px">
                                @php
                                    $badgeMap = ['valid'=>'approved','pending'=>'pending','tolak'=>'rejected'];
                                    $bc = $badgeMap[$j->status_validasi] ?? 'info';
                                    $iconMap = ['valid'=>'fa-circle-check','pending'=>'fa-clock','tolak'=>'fa-circle-xmark'];
                                    $ic2 = $iconMap[$j->status_validasi] ?? 'fa-circle-info';
                                @endphp
                                <span class="badge {{ $bc }}">
                                    <i class="fa-solid {{ $ic2 }}"></i>
                                    {{ ucfirst($j->status_validasi) }}
                                </span>
                            </td>
                            <td style="padding:12px 14px">
                                <div style="display:flex;gap:5px">
                                    @if($j->status_validasi === 'pending')
                                    <a href="{{ route('siswa.jurnal.edit',$j->id) }}" class="btn-secondary" style="padding:5px 10px;font-size:.72rem;gap:5px">
                                        <i class="fa-solid fa-pen" style="font-size:.65rem"></i> Edit
                                    </a>
                                    <form action="{{ route('siswa.jurnal.destroy',$j->id) }}" method="POST" onsubmit="return confirm('Hapus jurnal ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="padding:5px 10px;font-size:.72rem;border-radius:10px;border:1px solid rgba(239,68,68,.3);background:rgba(239,68,68,.06);color:#ef4444;cursor:pointer;font-family:var(--font);font-weight:600;display:flex;align-items:center;gap:5px;transition:all .2s" onmouseover="this.style.background='rgba(239,68,68,.14)'" onmouseout="this.style.background='rgba(239,68,68,.06)'">
                                            <i class="fa-solid fa-trash" style="font-size:.65rem"></i> Hapus
                                        </button>
                                    </form>
                                    @else
                                    <span style="font-size:.72rem;color:var(--text-sub);display:flex;align-items:center;gap:4px">
                                        <i class="fa-solid fa-lock" style="font-size:.65rem"></i> Terkunci
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fa-solid fa-book-open" style="font-size:1.2rem"></i>
                                    </div>
                                    <div class="empty-title">Belum Ada Jurnal</div>
                                    <div class="empty-desc">Mulai catat aktivitas PKL kamu setiap hari.<br>
                                        <a href="{{ route('siswa.jurnal.create') }}" style="color:var(--primary);font-weight:600">
                                            <i class="fa-solid fa-plus" style="font-size:.75rem"></i> Tambah jurnal sekarang
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($jurnals->hasPages())
            <div style="padding:14px 20px">{{ $jurnals->links() }}</div>
            @endif
        </div>
    </div>

    {{-- RIGHT: Info Panel --}}
    <div>
        {{-- Quick Stats --}}
        <div class="info-panel" style="margin-bottom:16px">
            <div class="info-panel-header">
                <i class="fa-solid fa-chart-pie"></i>
                <span class="info-panel-title">Ringkasan Cepat</span>
            </div>
            <div class="info-panel-body">
                <div class="quick-stat">
                    <span class="quick-stat-label">
                        <i class="fa-solid fa-book-open" style="color:#667eea"></i> Total Jurnal
                    </span>
                    <span class="quick-stat-val">{{ $totalJurnal }}</span>
                </div>
                <div class="quick-stat">
                    <span class="quick-stat-label">
                        <i class="fa-solid fa-circle-check" style="color:#22c55e"></i> Tervalidasi
                    </span>
                    <span class="quick-stat-val" style="color:#22c55e">{{ $jurnalValid }}</span>
                </div>
                <div class="quick-stat">
                    <span class="quick-stat-label">
                        <i class="fa-solid fa-clock" style="color:#f59e0b"></i> Pending
                    </span>
                    <span class="quick-stat-val" style="color:#f59e0b">{{ $jurnalPending }}</span>
                </div>
                @php $ditolak = $totalJurnal - $jurnalValid - $jurnalPending; @endphp
                @if($ditolak > 0)
                <div class="quick-stat">
                    <span class="quick-stat-label">
                        <i class="fa-solid fa-circle-xmark" style="color:#ef4444"></i> Ditolak
                    </span>
                    <span class="quick-stat-val" style="color:#ef4444">{{ $ditolak }}</span>
                </div>
                @endif

                @if($totalJurnal > 0)
                <div style="margin-top:12px">
                    <div style="display:flex;justify-content:space-between;font-size:.7rem;color:var(--text-sub);margin-bottom:5px">
                        <span>Progress Validasi</span>
                        <span>{{ $totalJurnal > 0 ? round(($jurnalValid/$totalJurnal)*100) : 0 }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:{{ $totalJurnal > 0 ? ($jurnalValid/$totalJurnal)*100 : 0 }}%"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Tips Panel --}}
        <div class="info-panel">
            <div class="info-panel-header">
                <i class="fa-solid fa-lightbulb"></i>
                <span class="info-panel-title">Tips Jurnal</span>
            </div>
            <div class="info-panel-body">
                <div class="tip-item">
                    <div class="tip-ico blue"><i class="fa-solid fa-pen-to-square"></i></div>
                    <div class="tip-text">
                        <strong>Tulis setiap hari</strong>
                        Catat jurnal di hari yang sama agar kegiatan lebih detail dan akurat.
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-ico green"><i class="fa-solid fa-camera"></i></div>
                    <div class="tip-text">
                        <strong>Sertakan foto bukti</strong>
                        Foto kegiatan memperkuat validasi oleh pembimbing.
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-ico amber"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div class="tip-text">
                        <strong>Isi jam masuk & keluar</strong>
                        Data waktu digunakan untuk rekap absensi otomatis.
                    </div>
                </div>
                <div class="tip-item">
                    <div class="tip-ico red"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="tip-text">
                        <strong>Jurnal valid tidak bisa diedit</strong>
                        Setelah divalidasi, jurnal tidak bisa diubah lagi.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
