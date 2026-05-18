@extends('layouts.siswa')
@section('title','Detail Pengajuan PKL')
@section('page_title','Detail Pengajuan')
@section('nav_pengajuan','active')

@section('content')
<div style="max-width:780px">

    @php
        $aktif   = $pengajuan->status_pembimbing === 'disetujui' && $pengajuan->status_wakasek === 'disetujui';
        $ditolak = $pengajuan->status_pembimbing === 'ditolak'   || $pengajuan->status_wakasek === 'ditolak';
    @endphp

    {{-- Status Banner --}}
    @if($aktif)
    <div style="display:flex;align-items:center;gap:14px;background:rgba(34,197,94,.06);border:1.5px solid rgba(34,197,94,.22);border-radius:14px;padding:16px 20px;margin-bottom:20px">
        <div class="stat-icon green" style="flex-shrink:0">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div>
            <div style="font-weight:700;color:#15803d;font-size:.9rem">PKL Aktif & Berjalan</div>
            <div style="font-size:.75rem;color:#16a34a;margin-top:2px">Pengajuan telah disetujui pembimbing dan wakasek</div>
        </div>
    </div>
    @elseif($ditolak)
    <div style="display:flex;align-items:center;gap:14px;background:rgba(239,68,68,.06);border:1.5px solid rgba(239,68,68,.22);border-radius:14px;padding:16px 20px;margin-bottom:20px">
        <div class="stat-icon" style="background:rgba(239,68,68,.12);color:#ef4444;flex-shrink:0;width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:19px;height:19px"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
        <div>
            <div style="font-weight:700;color:#dc2626;font-size:.9rem">Pengajuan Ditolak</div>
            <div style="font-size:.75rem;color:#ef4444;margin-top:2px">Hubungi pembimbing untuk informasi lebih lanjut</div>
        </div>
    </div>
    @else
    <div style="display:flex;align-items:center;gap:14px;background:rgba(245,158,11,.06);border:1.5px solid rgba(245,158,11,.22);border-radius:14px;padding:16px 20px;margin-bottom:20px">
        <div class="stat-icon amber" style="flex-shrink:0">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div>
            <div style="font-weight:700;color:#d97706;font-size:.9rem">Menunggu Persetujuan</div>
            <div style="font-size:.75rem;color:#d97706;margin-top:2px">
                Pembimbing: {{ ucfirst($pengajuan->status_pembimbing) }} &nbsp;·&nbsp; Wakasek: {{ ucfirst($pengajuan->status_wakasek) }}
            </div>
        </div>
    </div>
    @endif

    <div class="grid-2">

        {{-- Detail Perusahaan --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title-sm">Detail Perusahaan</div>
            </div>
            <div style="margin-top:4px">
                @foreach([
                    ['Nama Perusahaan', $pengajuan->nama_perusahaan],
                    ['Alamat', $pengajuan->alamat_perusahaan],
                    ['Website', $pengajuan->website ?? '—'],
                    ['Tanggal Pengajuan', $pengajuan->tanggal_pengajuan->format('d M Y H:i')],
                    ['Ketua', $pengajuan->ketua->namaLengkap()],
                    ['Pembimbing', $pengajuan->pembimbing?->namaLengkap() ?? 'Belum ditentukan'],
                ] as [$k,$v])
                <div style="display:flex;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)">
                    <span style="flex-shrink:0;width:145px;font-size:.7rem;color:var(--text-sub);font-weight:600;padding-top:2px;letter-spacing:.02em">{{ $k }}</span>
                    <span style="font-size:.82rem;font-weight:500;color:var(--text);line-height:1.5">{{ $v }}</span>
                </div>
                @endforeach
            </div>
            @if($pengajuan->file_dokumen)
            <div style="margin-top:16px">
                <a href="{{ asset('storage/'.$pengajuan->file_dokumen) }}" target="_blank" class="btn-secondary" style="font-size:.75rem">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Unduh Dokumen Pengajuan
                </a>
            </div>
            @endif
        </div>

        {{-- Anggota --}}
        <div class="card" style="align-self:start">
            <div class="card-header">
                <div class="card-title-sm">Anggota</div>
                <span style="font-size:.7rem;color:var(--text-sub);font-weight:600">{{ $pengajuan->anggota->count() }} orang</span>
            </div>
            <div style="margin-top:4px">
                @foreach($pengajuan->anggota as $ang)
                @php $bs = ['disetujui'=>'approved','pending'=>'pending','ditolak'=>'rejected']; @endphp
                <div style="display:flex;align-items:center;gap:10px;padding:10px 0;{{ !$loop->last ? 'border-bottom:1px solid var(--border)' : '' }}">
                    <div class="user-avatar" style="width:34px;height:34px;font-size:.72rem;font-weight:700">
                        {{ $ang->siswa->inisial() }}
                    </div>
                    <div>
                        <div style="font-size:.82rem;font-weight:600;color:var(--text)">{{ $ang->siswa->namaLengkap() }}</div>
                        <div style="font-size:.7rem;color:var(--text-sub);margin-top:2px;display:flex;align-items:center;gap:6px">
                            {{ $ang->siswa_id === $pengajuan->ketua_id ? 'Ketua' : 'Anggota' }}
                            <span class="badge {{ $bs[$ang->status_keanggotaan] ?? 'info' }}" style="padding:1px 7px;font-size:.6rem">{{ ucfirst($ang->status_keanggotaan) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div style="margin-top:16px">
        <a href="{{ route('siswa.pkl.pengajuan') }}" class="btn-secondary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali ke Daftar
        </a>
    </div>
</div>
@endsection