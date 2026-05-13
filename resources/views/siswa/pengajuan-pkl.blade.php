@extends('layouts.siswa')

@section('title', 'Pengajuan PKL')
@section('page_title', 'Pengajuan PKL')
@section('nav_pengajuan', 'active')

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Pengajuan PKL</div>
        <div class="page-sub">Status pengajuan dan informasi penempatan PKL kamu</div>
    </div>
</div>

{{-- Jika belum mengajukan --}}
@if(isset($pengajuan) && !$pengajuan)
<div class="card" style="text-align:center;padding:48px 24px">
    <div class="empty-icon" style="margin:0 auto 18px">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
    </div>
    <div class="empty-title">Belum Ada Pengajuan</div>
    <div class="empty-desc" style="margin-bottom:22px">Kamu belum mengajukan tempat PKL. Klik tombol di bawah untuk memulai pengajuan.</div>
    <a href="{{ route('siswa.pengajuan.create') }}" class="btn-primary" style="display:inline-flex">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Ajukan PKL Sekarang
    </a>
</div>
@else
{{-- Status timeline --}}
<div class="grid-2">
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title-sm">Status Pengajuan</div>
                <div class="card-subtitle">PT. Teknologi Nusantara</div>
            </div>
            <span class="badge approved">Diterima</span>
        </div>

        {{-- Timeline --}}
        @foreach([
            ['done','Formulir Dikirim','Pengajuan PKL berhasil dikirim ke sistem','28 Feb 2026 · 09.15'],
            ['done','Diverifikasi Guru','Syarat akademik dan jurusan sesuai','1 Mar 2026 · 14.30'],
            ['done','Disetujui Admin','Surat pengantar diterbitkan, guru pembimbing ditugaskan','1 Mar 2026 · 16.00'],
            ['done','Diterima Perusahaan','PT. Teknologi Nusantara menerima kamu sebagai peserta PKL','2 Mar 2026 · 10.00'],
        ] as $i => $t)
        <div style="display:flex;gap:14px;padding-bottom:{{ $i < 3 ? '18' : '0' }}px;position:relative">
            @if($i < 3)
            <div style="position:absolute;left:15px;top:32px;bottom:0;width:2px;background:var(--border)"></div>
            @endif
            <div style="width:32px;height:32px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;z-index:1;background:var(--grad);color:white;box-shadow:0 4px 12px rgba(102,126,234,.3)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div style="padding-top:4px">
                <div style="font-size:.82rem;font-weight:700;color:var(--text);transition:color .4s">{{ $t[1] }}</div>
                <div style="font-size:.72rem;color:var(--text-muted);margin-top:2px;transition:color .4s">{{ $t[2] }}</div>
                <div style="font-size:.65rem;color:var(--text-sub);margin-top:4px;transition:color .4s">{{ $t[3] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="display:flex;flex-direction:column;gap:20px">
        <div class="card">
            <div class="card-header"><div class="card-title-sm">Detail Perusahaan</div></div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                <div><div class="info-label">Nama Perusahaan</div><div class="info-value">PT. Teknologi Nusantara</div></div>
            </div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                <div><div class="info-label">Alamat</div><div class="info-value">Jl. Sudirman No.45, Bandung</div></div>
            </div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                <div><div class="info-label">Periode PKL</div><div class="info-value">2 Mar – 30 Jun 2026</div></div>
            </div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                <div><div class="info-label">Pembimbing Industri</div><div class="info-value">Budi Wahyono, S.Kom.</div></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><div class="card-title-sm">Guru Pembimbing</div></div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg></div>
                <div><div class="info-label">Nama</div><div class="info-value">Sari Rahayu, S.Pd.</div></div>
            </div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07"/></svg></div>
                <div><div class="info-label">Kontak</div><div class="info-value">0812-9876-5432</div></div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
