@extends('layouts.app')
@section('title','Pengajuan PKL')
@section('page-title','Pengajuan PKL')
@section('page-sub','Kelola pengajuan Praktik Kerja Lapangan')

@section('content')

{{-- Status PKL aktif --}}
@if($pklAktif)
<div style="background:linear-gradient(135deg,rgba(34,197,94,.08),rgba(16,163,74,.04));border:1.5px solid rgba(34,197,94,.25);border-radius:var(--r-xl);padding:20px 24px;margin-bottom:24px;display:flex;align-items:center;gap:16px">
    <div style="font-size:2rem">✅</div>
    <div>
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:var(--fs-lg);color:#15803d">PKL Sedang Berjalan</div>
        <div style="font-size:var(--fs-sm);color:#16a34a;margin-top:2px">{{ $pklAktif->nama_perusahaan }} — sudah disetujui pembimbing & wakasek</div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header">
        <div class="card-title">Daftar Pengajuan PKL</div>
        @if(!$pklAktif)
        <a href="{{ route('siswa.pkl.pengajuan.create') }}" class="btn-primary">+ Ajukan PKL</a>
        @endif
    </div>

    @forelse($semua as $p)
    <div style="padding:20px;border-bottom:1px solid var(--border)">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap">
            <div style="flex:1">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
                    <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:var(--fs-lg)">{{ $p->nama_perusahaan }}</div>
                    @if($p->ketua_id === Auth::id())
                        <span style="font-size:10px;background:rgba(102,126,234,.1);color:var(--primary);padding:2px 8px;border-radius:var(--r-full);font-weight:700">KETUA</span>
                    @else
                        <span style="font-size:10px;background:rgba(156,163,175,.1);color:var(--text-muted);padding:2px 8px;border-radius:var(--r-full);font-weight:700">ANGGOTA</span>
                    @endif
                </div>
                <div style="font-size:var(--fs-sm);color:var(--text-muted);margin-bottom:10px">
                    📍 {{ Str::limit($p->alamat_perusahaan, 80) }}
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
                    <span style="font-size:var(--fs-xs);color:var(--text-muted)">Pembimbing:</span>
                    <span class="badge" style="background:rgba(102,126,234,.1);color:var(--primary)">
                        {{ $p->pembimbing_id ? $p->pembimbing->namaLengkap() : 'Belum ditentukan' }}
                    </span>
                    <span style="font-size:var(--fs-xs);color:var(--text-muted);margin-left:8px">
                        {{ $p->tanggal_pengajuan->format('d M Y') }}
                    </span>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:8px;align-items:flex-end">
                <div style="display:flex;gap:8px;align-items:center">
                    <span style="font-size:var(--fs-xs);color:var(--text-muted)">Pembimbing:</span>
                    <span class="badge badge-{{ $p->status_pembimbing }}">{{ ucfirst($p->status_pembimbing) }}</span>
                </div>
                <div style="display:flex;gap:8px;align-items:center">
                    <span style="font-size:var(--fs-xs);color:var(--text-muted)">Wakasek:</span>
                    <span class="badge badge-{{ $p->status_wakasek }}">{{ ucfirst($p->status_wakasek) }}</span>
                </div>
                <a href="{{ route('siswa.pkl.pengajuan.show', $p->id) }}" class="btn-secondary" style="padding:6px 14px;font-size:var(--fs-xs);margin-top:4px">
                    Detail →
                </a>
            </div>
        </div>
    </div>
    @empty
    <div style="text-align:center;padding:48px 20px;color:var(--text-muted)">
        <div style="font-size:3rem;margin-bottom:12px">📋</div>
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:var(--fs-lg);color:var(--text);margin-bottom:8px">Belum Ada Pengajuan</div>
        <div style="font-size:var(--fs-sm);margin-bottom:20px">Ajukan PKL ke perusahaan pilihanmu sekarang.</div>
        <a href="{{ route('siswa.pkl.pengajuan.create') }}" class="btn-primary">+ Ajukan PKL Sekarang</a>
    </div>
    @endforelse
</div>
@endsection
