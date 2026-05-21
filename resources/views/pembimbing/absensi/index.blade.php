{{-- pembimbing/absensi/index.blade.php --}}
@extends('layouts.pembimbing')
@section('title','Rekap Absensi Siswa')

@section('content')
<div class="pg-head">
    <div>
        <div class="breadcrumb"><a href="{{ route('pembimbing.dashboard') }}">Dashboard</a><span>/</span> Absensi</div>
        <h2>📅 Rekap Absensi Siswa Bimbingan</h2>
    </div>
</div>

<form method="GET" style="display:flex;gap:10px;margin-bottom:18px;flex-wrap:wrap">
    <select name="siswa_id" style="padding:8px 13px;border:1px solid var(--border);border-radius:10px;font-family:var(--font);font-size:.825rem;background:var(--card-bg);color:var(--text);outline:none">
        <option value="">Semua Siswa</option>
        @foreach($daftarSiswa as $s)
        <option value="{{ $s->id }}" {{ request('siswa_id')==$s->id?'selected':'' }}>{{ $s->nama_depan }} {{ $s->nama_belakang }}</option>
        @endforeach
    </select>
    <select name="bulan" style="padding:8px 13px;border:1px solid var(--border);border-radius:10px;font-family:var(--font);font-size:.825rem;background:var(--card-bg);color:var(--text);outline:none">
        @for($m=1;$m<=12;$m++)
        <option value="{{ $m }}" {{ request('bulan',now()->month)==$m?'selected':'' }}>
            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
        </option>
        @endfor
    </select>
    <button type="submit" class="btn btn-out btn-sm">🔍 Tampilkan</button>
    <a href="{{ route('pembimbing.absensi.index') }}" class="btn btn-out btn-sm">Reset</a>
</form>

{{-- Rekap per siswa --}}
@foreach($rekapAbsensi as $item)
<div class="card" style="margin-bottom:16px">
    <div class="card-head">
        <div style="display:flex;align-items:center;gap:10px">
            <div style="width:34px;height:34px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:700;color:#fff;flex-shrink:0">
                {{ strtoupper(substr($item['siswa']->nama_depan,0,1).substr($item['siswa']->nama_belakang,0,1)) }}
            </div>
            <div>
                <div style="font-weight:700;font-size:.875rem">{{ $item['siswa']->nama_depan }} {{ $item['siswa']->nama_belakang }}</div>
                <div style="font-size:.72rem;color:var(--text-muted)">{{ $item['siswa']->profilSiswa->kelas ?? '' }}</div>
            </div>
        </div>
        <div style="display:flex;gap:10px">
            @foreach([['Hadir',$item['hadir'],'#16a34a'],['Izin',$item['izin'],'#2563eb'],['Sakit',$item['sakit'],'#d97706'],['Alpa',$item['alpa'],'#dc2626']] as [$lbl,$num,$clr])
            <div style="text-align:center;background:rgba(102,126,234,.05);border-radius:8px;padding:7px 12px">
                <div style="font-weight:800;font-size:1.1rem;color:{{ $clr }}">{{ $num }}</div>
                <div style="font-size:.65rem;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.04em">{{ $lbl }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach

@if(empty($rekapAbsensi))
<div class="card"><div class="empty"><div class="empty-ic">📅</div><p>Belum ada data absensi.</p></div></div>
@endif
@endsection
