@extends('layouts.app')
@section('title','Nilai PKL')
@section('page-title','Nilai PKL')
@section('page-sub','Hasil penilaian selama Praktik Kerja Lapangan')

@section('content')

@if($nilai)

{{-- Nilai Akhir Banner --}}
<div style="background:var(--gradient);border-radius:var(--r-2xl);padding:28px 32px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden">
    <div style="position:absolute;top:-60px;right:-60px;width:240px;height:240px;background:rgba(255,255,255,.08);border-radius:50%"></div>
    <div>
        <div style="font-size:var(--fs-sm);color:rgba(255,255,255,.75);font-weight:500">Penilaian oleh Pembimbing</div>
        <div style="font-family:'Syne',sans-serif;font-size:1.5rem;font-weight:800;color:white;margin:4px 0 8px">{{ $nilai->pembimbing->namaLengkap() }}</div>
        <div style="font-size:var(--fs-xs);color:rgba(255,255,255,.65)">Dinilai pada {{ $nilai->created_at->format('d F Y') }}</div>
    </div>
    <div style="text-align:center;background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.25);border-radius:var(--r-xl);padding:20px 32px">
        <div style="font-size:var(--fs-xs);color:rgba(255,255,255,.7);font-weight:600;margin-bottom:4px">Nilai Akhir</div>
        <div style="font-family:'Syne',sans-serif;font-size:3rem;font-weight:800;color:white;line-height:1">
            {{ $nilai->nilai_akhir ? number_format($nilai->nilai_akhir, 1) : '—' }}
        </div>
        <div style="margin-top:8px;background:rgba(255,255,255,.2);border-radius:var(--r-full);padding:4px 16px;font-size:var(--fs-sm);color:white;font-weight:700;display:inline-block">
            Predikat {{ $nilai->predikat ?? '—' }}
        </div>
    </div>
</div>

{{-- Komponen Nilai --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px">
    @foreach([
        ['👤','Sikap',$nilai->nilai_sikap,'#667eea','rgba(102,126,234,.1)','Meliputi kedisiplinan, tanggung jawab, dan etika'],
        ['🔧','Keterampilan',$nilai->nilai_keterampilan,'#22c55e','rgba(34,197,94,.1)','Kemampuan teknis dan praktik di lapangan'],
        ['📄','Laporan',$nilai->nilai_laporan,'#f59e0b','rgba(245,158,11,.1)','Kualitas laporan dan dokumentasi PKL'],
    ] as [$icon,$label,$skor,$color,$bg,$desc])
    <div style="background:var(--surface);border-radius:var(--r-xl);padding:24px;border:1px solid var(--border);box-shadow:var(--shadow-sm)">
        <div style="width:44px;height:44px;background:{{ $bg }};border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:14px">{{ $icon }}</div>
        <div style="font-family:'Syne',sans-serif;font-size:2.2rem;font-weight:800;color:{{ $color }};line-height:1;margin-bottom:4px">{{ $skor }}</div>
        <div style="font-size:var(--fs-sm);font-weight:600;color:var(--text);margin-bottom:4px">{{ $label }}</div>
        <div style="font-size:var(--fs-xs);color:var(--text-muted)">{{ $desc }}</div>

        {{-- Progress bar --}}
        <div style="margin-top:12px;height:6px;background:rgba(0,0,0,.06);border-radius:var(--r-full);overflow:hidden">
            <div style="height:100%;width:{{ $skor }}%;background:{{ $color }};border-radius:var(--r-full);transition:width 1.2s ease"></div>
        </div>
        <div style="display:flex;justify-content:space-between;margin-top:4px;font-size:10px;color:var(--text-light)">
            <span>0</span><span>100</span>
        </div>
    </div>
    @endforeach
</div>

{{-- Catatan Pembimbing --}}
@if($nilai->catatan)
<div class="card">
    <div class="card-header"><div class="card-title">💬 Catatan Pembimbing</div></div>
    <div class="card-body">
        <div style="background:var(--bg);border-radius:var(--r-lg);padding:16px;border-left:3px solid var(--primary);font-size:var(--fs-sm);line-height:1.75;color:var(--text)">
            {{ $nilai->catatan }}
        </div>
    </div>
</div>
@endif

{{-- Tabel konversi predikat --}}
<div class="card" style="margin-top:20px">
    <div class="card-header"><div class="card-title">📊 Tabel Konversi Nilai</div></div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>Rentang Nilai</th><th>Predikat</th><th>Keterangan</th></tr>
            </thead>
            <tbody>
                @foreach([
                    ['90 – 100','A','Sangat Baik'],
                    ['80 – 89','B','Baik'],
                    ['70 – 79','C','Cukup'],
                    ['60 – 69','D','Kurang'],
                    ['0 – 59','E','Sangat Kurang'],
                ] as [$r,$p,$k])
                <tr style="{{ $nilai->predikat === $p ? 'background:rgba(102,126,234,.06)' : '' }}">
                    <td style="font-weight:600">{{ $r }}</td>
                    <td>
                        <span class="badge" style="background:{{ $nilai->predikat===$p ? 'var(--gradient)' : 'rgba(102,126,234,.08)' }};color:{{ $nilai->predikat===$p ? 'white' : 'var(--primary)' }};font-size:var(--fs-sm);padding:4px 12px">{{ $p }}</span>
                    </td>
                    <td style="color:var(--text-muted)">{{ $k }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@else

{{-- Belum ada nilai --}}
<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:360px;text-align:center">
    <div style="width:80px;height:80px;background:linear-gradient(135deg,rgba(102,126,234,.1),rgba(118,75,162,.06));border-radius:var(--r-xl);display:flex;align-items:center;justify-content:center;font-size:2.5rem;margin-bottom:20px">⭐</div>
    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem;color:var(--text);margin-bottom:8px">Nilai Belum Diinput</div>
    <div style="font-size:var(--fs-sm);color:var(--text-muted);max-width:380px;line-height:1.7;margin-bottom:20px">
        Pembimbingmu belum menginput nilai PKL. Pastikan kamu sudah menyelesaikan semua kewajiban PKL.
    </div>
    <a href="{{ route('siswa.dashboard') }}" class="btn-secondary">← Kembali ke Dashboard</a>
</div>

@endif

@endsection
