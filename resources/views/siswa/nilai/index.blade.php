@extends('layouts.siswa')
@section('title','Nilai PKL')
@section('page_title','Nilai PKL')
@section('nav_nilai','active')

@section('content')

@if($nilai)

{{-- Banner Nilai Akhir --}}
<div style="background:var(--grad);border-radius:18px;padding:28px 32px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden;box-shadow:0 8px 28px rgba(102,126,234,.35)">
    <div style="position:absolute;top:-60px;right:-60px;width:240px;height:240px;background:rgba(255,255,255,.08);border-radius:50%;pointer-events:none"></div>
    <div style="position:absolute;bottom:-40px;left:120px;width:160px;height:160px;background:rgba(255,255,255,.05);border-radius:50%;pointer-events:none"></div>
    <div style="position:relative">
        <div style="font-size:.75rem;color:rgba(255,255,255,.75);font-weight:500;margin-bottom:4px">Penilaian oleh Pembimbing</div>
        <div style="font-size:1.4rem;font-weight:800;color:white;margin-bottom:6px">{{ $nilai->pembimbing->namaLengkap() }}</div>
        <div style="font-size:.72rem;color:rgba(255,255,255,.65)">Dinilai pada {{ $nilai->created_at->format('d F Y') }}</div>
    </div>
    <div style="position:relative;text-align:center;background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.25);border-radius:16px;padding:20px 32px;backdrop-filter:blur(8px)">
        <div style="font-size:.7rem;color:rgba(255,255,255,.75);font-weight:600;margin-bottom:4px;letter-spacing:.05em;text-transform:uppercase">Nilai Akhir</div>
        <div style="font-size:3rem;font-weight:900;color:white;line-height:1">
            {{ $nilai->nilai_akhir ? number_format($nilai->nilai_akhir, 1) : '—' }}
        </div>
        <div style="margin-top:10px;background:rgba(255,255,255,.2);border-radius:20px;padding:4px 18px;font-size:.82rem;color:white;font-weight:700;display:inline-block">
            Predikat {{ $nilai->predikat ?? '—' }}
        </div>
    </div>
</div>

{{-- Komponen Nilai --}}
<div class="grid-3" style="margin-bottom:20px">
    @foreach([
        ['purple','Sikap',$nilai->nilai_sikap,'Meliputi kedisiplinan, tanggung jawab, dan etika','#667eea'],
        ['green','Keterampilan',$nilai->nilai_keterampilan,'Kemampuan teknis dan praktik di lapangan','#22c55e'],
        ['amber','Laporan',$nilai->nilai_laporan,'Kualitas laporan dan dokumentasi PKL','#f59e0b'],
    ] as [$color,$label,$skor,$desc,$hex])
    <div class="stat-card" style="padding:22px">
        <div class="stat-icon {{ $color }}" style="margin-bottom:14px">
            @if($color==='purple')
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            @elseif($color==='green')
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            @else
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            @endif
        </div>
        <div style="font-size:2.2rem;font-weight:900;color:{{ $hex }};line-height:1;margin-bottom:4px">{{ $skor }}</div>
        <div style="font-size:.88rem;font-weight:700;color:var(--text);margin-bottom:4px">{{ $label }}</div>
        <div style="font-size:.72rem;color:var(--text-muted);line-height:1.5;margin-bottom:12px">{{ $desc }}</div>
        <div class="progress-bar">
            <div class="progress-fill" style="width:{{ $skor }}%;background:{{ $hex }}"></div>
        </div>
        <div class="progress-label"><span>0</span><span>100</span></div>
    </div>
    @endforeach
</div>

{{-- Catatan Pembimbing --}}
@if($nilai->catatan)
<div class="card" style="margin-bottom:20px">
    <div class="card-header">
        <div class="card-title-sm">Catatan Pembimbing</div>
    </div>
    <div style="padding:4px 0">
        <div style="background:var(--tag-bg);border-radius:12px;padding:16px;border-left:3px solid var(--primary);font-size:.85rem;line-height:1.75;color:var(--text)">
            {{ $nilai->catatan }}
        </div>
    </div>
</div>
@endif

{{-- Tabel Konversi --}}
<div class="card">
    <div class="card-header">
        <div class="card-title-sm">Tabel Konversi Nilai</div>
        <div class="card-subtitle">Skala predikat PKL</div>
    </div>
    <div style="overflow-x:auto;margin-top:4px">
        <table style="width:100%;border-collapse:collapse;font-size:.82rem">
            <thead>
                <tr style="border-bottom:1px solid var(--border)">
                    @foreach(['Rentang Nilai','Predikat','Keterangan'] as $h)
                    <th style="padding:10px 12px;text-align:left;font-size:.7rem;font-weight:700;color:var(--text-sub);letter-spacing:.05em;text-transform:uppercase">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['90 – 100','A','Sangat Baik'],
                    ['80 – 89','B','Baik'],
                    ['70 – 79','C','Cukup'],
                    ['60 – 69','D','Kurang'],
                    ['0 – 59','E','Sangat Kurang'],
                ] as [$r,$p,$k])
                <tr style="border-bottom:1px solid var(--border);{{ $nilai->predikat===$p ? 'background:var(--tag-bg)' : '' }}">
                    <td style="padding:11px 12px;font-weight:600;color:var(--text)">{{ $r }}</td>
                    <td style="padding:11px 12px">
                        @if($nilai->predikat===$p)
                        <span class="badge approved" style="background:var(--grad);color:white;padding:4px 12px;font-size:.75rem">{{ $p }}</span>
                        @else
                        <span class="badge info" style="padding:4px 12px;font-size:.75rem">{{ $p }}</span>
                        @endif
                    </td>
                    <td style="padding:11px 12px;color:var(--text-muted)">{{ $k }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@else

{{-- Belum Ada Nilai --}}
<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:380px;text-align:center">
    <div style="width:80px;height:80px;background:var(--tag-bg);border:1px solid var(--border);border-radius:20px;display:flex;align-items:center;justify-content:center;margin-bottom:20px">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="width:36px;height:36px;color:var(--text-sub)"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
    </div>
    <div style="font-size:1.3rem;font-weight:800;color:var(--text);margin-bottom:8px">Nilai Belum Diinput</div>
    <div style="font-size:.85rem;color:var(--text-muted);max-width:380px;line-height:1.7;margin-bottom:22px">
        Pembimbingmu belum menginput nilai PKL. Pastikan kamu sudah menyelesaikan semua kewajiban PKL.
    </div>
    <a href="{{ route('siswa.dashboard') }}" class="btn-secondary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke Dashboard
    </a>
</div>

@endif

@endsection