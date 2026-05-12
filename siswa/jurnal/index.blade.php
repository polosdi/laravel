@extends('layouts.app')
@section('title','Jurnal Harian')
@section('page-title','Jurnal Harian')
@section('page-sub','Catat aktivitas PKL setiap hari')

@section('content')
{{-- Stats row --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px">
    @foreach([['📓',$totalJurnal,'Total Jurnal','stat-card-1','stat-icon-1'],['✅',$jurnalValid,'Tervalidasi','stat-card-2','stat-icon-2'],['⏳',$jurnalPending,'Pending','stat-card-3','stat-icon-3']] as [$icon,$num,$label,$cc,$ic])
    <div class="stat-card {{ $cc }}">
        <div class="stat-icon {{ $ic }}">{{ $icon }}</div>
        <div class="stat-num">{{ $num }}</div>
        <div class="stat-label">{{ $label }}</div>
    </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Daftar Jurnal Harian</div>
        <a href="{{ route('siswa.jurnal.create') }}" class="btn-primary">+ Tambah Jurnal</a>
    </div>

    {{-- Filter --}}
    <div style="padding:14px 20px;border-bottom:1px solid var(--border);display:flex;gap:10px;flex-wrap:wrap">
        <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;width:100%">
            <select name="status" class="form-control" style="width:160px" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending"  {{ request('status')=='pending'  ?'selected':'' }}>Pending</option>
                <option value="valid"    {{ request('status')=='valid'    ?'selected':'' }}>Valid</option>
                <option value="tolak"    {{ request('status')=='tolak'    ?'selected':'' }}>Ditolak</option>
            </select>
            <select name="bulan" class="form-control" style="width:160px" onchange="this.form.submit()">
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

    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Tanggal</th><th>Jam</th><th>Kegiatan</th><th>Foto</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($jurnals as $i => $j)
                <tr>
                    <td style="color:var(--text-muted)">{{ $jurnals->firstItem() + $i }}</td>
                    <td>
                        <div style="font-weight:600">{{ $j->tanggal->format('d M Y') }}</div>
                        <div style="font-size:10px;color:var(--text-muted)">{{ $j->tanggal->translatedFormat('l') }}</div>
                    </td>
                    <td>
                        @if($j->jam_masuk)
                            <span style="font-size:var(--fs-xs)">{{ $j->jamMasukFormatted() }}<br>{{ $j->jamKeluarFormatted() }}</span>
                        @else <span style="color:var(--text-light)">—</span> @endif
                    </td>
                    <td style="max-width:260px">
                        <div style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-size:var(--fs-sm)">{{ $j->kegiatan }}</div>
                        @if($j->komentar_pembimbing)
                        <div style="margin-top:4px;font-size:var(--fs-xs);color:var(--primary)">💬 {{ Str::limit($j->komentar_pembimbing,60) }}</div>
                        @endif
                    </td>
                    <td>
                        @if($j->foto_kegiatan)
                            <img src="{{ asset('storage/'.$j->foto_kegiatan) }}" style="width:40px;height:40px;object-fit:cover;border-radius:6px;border:1px solid var(--border)">
                        @else <span style="color:var(--text-light);font-size:var(--fs-xs)">—</span> @endif
                    </td>
                    <td><span class="badge badge-{{ $j->status_validasi }}">{{ ucfirst($j->status_validasi) }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            @if($j->status_validasi === 'pending')
                            <a href="{{ route('siswa.jurnal.edit',$j->id) }}" class="btn-secondary" style="padding:5px 12px;font-size:var(--fs-xs)">✏️ Edit</a>
                            <form action="{{ route('siswa.jurnal.destroy',$j->id) }}" method="POST" onsubmit="return confirm('Hapus jurnal ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger" style="padding:5px 12px;font-size:var(--fs-xs)">🗑️</button>
                            </form>
                            @else
                            <span style="font-size:var(--fs-xs);color:var(--text-light)">—</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:32px;color:var(--text-muted)">
                    <div style="font-size:2rem;margin-bottom:8px">📓</div>
                    Belum ada jurnal. <a href="{{ route('siswa.jurnal.create') }}" style="color:var(--primary);font-weight:600">Tambah sekarang</a>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($jurnals->hasPages())
    <div style="padding:16px 20px">{{ $jurnals->links() }}</div>
    @endif
</div>

@push('scripts')
<style>
.stat-card{background:var(--surface);border-radius:var(--r-xl);padding:20px;border:1px solid var(--border);box-shadow:var(--shadow-sm);position:relative;overflow:hidden;transition:transform .2s}
.stat-card:hover{transform:translateY(-3px)}
.stat-card::before{content:'';position:absolute;top:0;right:0;width:80px;height:80px;border-radius:0 var(--r-xl) 0 80px;opacity:.06}
.stat-card-1::before{background:#667eea}.stat-card-2::before{background:#22c55e}.stat-card-3::before{background:#f59e0b}
.stat-icon{width:42px;height:42px;border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:14px}
.stat-icon-1{background:linear-gradient(135deg,#667eea20,#764ba210)}.stat-icon-2{background:linear-gradient(135deg,#22c55e20,#16a34a10)}.stat-icon-3{background:linear-gradient(135deg,#f59e0b20,#d9770010)}
.stat-num{font-family:'Syne',sans-serif;font-size:1.9rem;font-weight:800;color:var(--text);line-height:1;margin-bottom:4px}
.stat-label{font-size:var(--fs-xs);color:var(--text-muted)}
</style>
@endpush
@endsection
