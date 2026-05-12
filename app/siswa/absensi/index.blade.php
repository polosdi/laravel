@extends('layouts.app')
@section('title','Absensi')
@section('page-title','Data Absensi')
@section('page-sub','Rekap kehadiran selama PKL')

@section('content')

{{-- Summary cards --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px">
    @foreach([
        ['✅',$hadir,'Hadir','#22c55e','rgba(34,197,94,.1)'],
        ['📋',$izin,'Izin','#d97706','rgba(245,158,11,.1)'],
        ['🏥',$sakit,'Sakit','#2563eb','rgba(59,130,246,.1)'],
        ['❌',$alpa,'Alpa','#dc2626','rgba(239,68,68,.1)'],
    ] as [$icon,$num,$label,$color,$bg])
    <div style="background:var(--surface);border-radius:var(--r-xl);padding:20px;border:1px solid var(--border);box-shadow:var(--shadow-sm)">
        <div style="width:40px;height:40px;border-radius:var(--r-md);background:{{ $bg }};display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px">{{ $icon }}</div>
        <div style="font-family:'Syne',sans-serif;font-size:1.8rem;font-weight:800;color:var(--text);line-height:1">{{ $num }}</div>
        <div style="font-size:var(--fs-xs);color:var(--text-muted);margin-top:4px">{{ $label }}</div>
    </div>
    @endforeach
</div>

{{-- Progress kehadiran --}}
<div class="card" style="margin-bottom:20px">
    <div class="card-body">
        <div style="display:flex;justify-content:space-between;font-size:var(--fs-sm);font-weight:600;margin-bottom:8px">
            <span>Tingkat Kehadiran</span>
            <span style="color:{{ $skorAbsen >= 80 ? '#22c55e' : ($skorAbsen >= 60 ? '#d97706' : '#dc2626') }}">{{ $skorAbsen }}%</span>
        </div>
        <div style="height:10px;background:rgba(102,126,234,.1);border-radius:var(--r-full);overflow:hidden">
            <div style="height:100%;width:{{ $skorAbsen }}%;background:{{ $skorAbsen >= 80 ? 'linear-gradient(135deg,#22c55e,#16a34a)' : ($skorAbsen >= 60 ? 'linear-gradient(135deg,#f59e0b,#d97706)' : 'linear-gradient(135deg,#ef4444,#dc2626)') }};border-radius:var(--r-full);transition:width 1s ease"></div>
        </div>
        <div style="font-size:var(--fs-xs);color:var(--text-muted);margin-top:6px">{{ $hadir }} dari {{ $total }} hari masuk</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Riwayat Absensi</div>
    </div>

    {{-- Filter --}}
    <div style="padding:14px 20px;border-bottom:1px solid var(--border)">
        <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap">
            <select name="status" class="form-control" style="width:160px" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                @foreach(['Hadir','Izin','Sakit','Alpa'] as $s)
                <option value="{{ $s }}" {{ request('status')===$s?'selected':'' }}>{{ $s }}</option>
                @endforeach
            </select>
            <select name="bulan" class="form-control" style="width:160px" onchange="this.form.submit()">
                <option value="">Semua Bulan</option>
                @for($m=1;$m<=12;$m++)
                <option value="{{ $m }}" {{ request('bulan')==$m?'selected':'' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                @endfor
            </select>
            @if(request()->hasAny(['status','bulan']))
            <a href="{{ route('siswa.absensi') }}" class="btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Tanggal</th><th>Hari</th><th>Jam Masuk</th><th>Jam Pulang</th><th>Status</th><th>Keterangan</th></tr>
            </thead>
            <tbody>
                @forelse($absensi as $i => $a)
                <tr>
                    <td style="color:var(--text-muted)">{{ $absensi->firstItem() + $i }}</td>
                    <td style="font-weight:600">{{ $a->tanggal->format('d M Y') }}</td>
                    <td style="color:var(--text-muted)">{{ $a->tanggal->translatedFormat('l') }}</td>
                    <td>{{ $a->jamMasukFormatted() }}</td>
                    <td>{{ $a->jamPulangFormatted() }}</td>
                    <td><span class="badge badge-{{ strtolower($a->status) }}">{{ $a->status }}</span></td>
                    <td style="font-size:var(--fs-xs);color:var(--text-muted)">{{ $a->keterangan ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:32px;color:var(--text-muted)">
                    <div style="font-size:2rem;margin-bottom:8px">📅</div>Belum ada data absensi
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($absensi->hasPages())
    <div style="padding:16px 20px">{{ $absensi->links() }}</div>
    @endif
</div>
@endsection
