@extends('layouts.app')
@section('title','Detail Pengajuan PKL')
@section('page-title','Detail Pengajuan')
@section('page-sub','{{ $pengajuan->nama_perusahaan }}')

@section('content')
<div style="max-width:760px">

    {{-- Status Banner --}}
    @php
        $aktif = $pengajuan->status_pembimbing === 'disetujui' && $pengajuan->status_wakasek === 'disetujui';
        $ditolak = $pengajuan->status_pembimbing === 'ditolak' || $pengajuan->status_wakasek === 'ditolak';
    @endphp

    @if($aktif)
    <div style="background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(16,163,74,.05));border:1.5px solid rgba(34,197,94,.3);border-radius:var(--r-xl);padding:18px 22px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
        <span style="font-size:1.5rem">✅</span>
        <div><div style="font-weight:700;color:#15803d">PKL Aktif & Berjalan</div><div style="font-size:var(--fs-xs);color:#16a34a">Pengajuan telah disetujui pembimbing dan wakasek</div></div>
    </div>
    @elseif($ditolak)
    <div style="background:rgba(239,68,68,.08);border:1.5px solid rgba(239,68,68,.25);border-radius:var(--r-xl);padding:18px 22px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
        <span style="font-size:1.5rem">❌</span>
        <div><div style="font-weight:700;color:#dc2626">Pengajuan Ditolak</div><div style="font-size:var(--fs-xs);color:#ef4444">Hubungi pembimbing untuk informasi lebih lanjut</div></div>
    </div>
    @else
    <div style="background:rgba(245,158,11,.08);border:1.5px solid rgba(245,158,11,.25);border-radius:var(--r-xl);padding:18px 22px;margin-bottom:20px;display:flex;align-items:center;gap:12px">
        <span style="font-size:1.5rem">⏳</span>
        <div><div style="font-weight:700;color:#d97706">Menunggu Persetujuan</div><div style="font-size:var(--fs-xs);color:#d97706">Pembimbing: {{ ucfirst($pengajuan->status_pembimbing) }} &nbsp;|&nbsp; Wakasek: {{ ucfirst($pengajuan->status_wakasek) }}</div></div>
    </div>
    @endif

    <div style="display:grid;grid-template-columns:1fr 280px;gap:20px">

        {{-- Detail Perusahaan --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">🏢 Detail Perusahaan</div>
            </div>
            <div class="card-body">
                <ul style="list-style:none;display:flex;flex-direction:column;gap:0">
                    @foreach([
                        ['Nama Perusahaan', $pengajuan->nama_perusahaan],
                        ['Alamat', $pengajuan->alamat_perusahaan],
                        ['Website', $pengajuan->website ?? '—'],
                        ['Tanggal Pengajuan', $pengajuan->tanggal_pengajuan->format('d M Y H:i')],
                        ['Ketua', $pengajuan->ketua->namaLengkap()],
                        ['Pembimbing', $pengajuan->pembimbing?->namaLengkap() ?? 'Belum ditentukan'],
                    ] as [$k,$v])
                    <li style="display:flex;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)">
                        <span style="flex-shrink:0;width:150px;font-size:var(--fs-xs);color:var(--text-muted);font-weight:500;padding-top:2px">{{ $k }}</span>
                        <span style="font-size:var(--fs-sm);font-weight:500;color:var(--text)">{{ $v }}</span>
                    </li>
                    @endforeach
                </ul>
                @if($pengajuan->file_dokumen)
                <div style="margin-top:12px">
                    <a href="{{ asset('storage/'.$pengajuan->file_dokumen) }}" class="btn-secondary" target="_blank" style="font-size:var(--fs-xs)">
                        📁 Unduh Dokumen Pengajuan
                    </a>
                </div>
                @endif
            </div>
        </div>

        {{-- Anggota --}}
        <div class="card" style="align-self:start">
            <div class="card-header">
                <div class="card-title">👥 Anggota</div>
            </div>
            <div class="card-body" style="padding:12px">
                @foreach($pengajuan->anggota as $ang)
                <div style="display:flex;align-items:center;gap:10px;padding:10px;border-radius:var(--r-md);{{ !$loop->last ? 'border-bottom:1px solid var(--border)' : '' }}">
                    <div style="width:34px;height:34px;background:var(--gradient);border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:.75rem;color:white;flex-shrink:0">
                        {{ $ang->siswa->inisial() }}
                    </div>
                    <div>
                        <div style="font-size:var(--fs-sm);font-weight:600">{{ $ang->siswa->namaLengkap() }}</div>
                        <div style="font-size:10px;color:var(--text-muted)">
                            {{ $ang->siswa_id === $pengajuan->ketua_id ? 'Ketua' : 'Anggota' }}
                            &middot; <span class="badge badge-{{ $ang->status_keanggotaan }}">{{ ucfirst($ang->status_keanggotaan) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div style="margin-top:16px">
        <a href="{{ route('siswa.pkl.pengajuan') }}" class="btn-secondary">← Kembali ke Daftar</a>
    </div>
</div>
@endsection
