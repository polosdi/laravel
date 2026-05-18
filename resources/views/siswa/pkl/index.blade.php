@extends('layouts.siswa')
@section('title','Pengajuan PKL')
@section('page_title','Pengajuan PKL')
@section('nav_pengajuan','active')

@section('content')

{{-- Banner PKL Aktif --}}
@if($pklAktif)
<div style="display:flex;align-items:center;gap:16px;background:rgba(34,197,94,.06);border:1.5px solid rgba(34,197,94,.22);border-radius:16px;padding:18px 22px;margin-bottom:24px">
    <div class="stat-icon green" style="flex-shrink:0;width:44px;height:44px">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <div>
        <div style="font-weight:700;font-size:.95rem;color:#15803d">PKL Sedang Berjalan</div>
        <div style="font-size:.78rem;color:#16a34a;margin-top:2px">{{ $pklAktif->nama_perusahaan }} — sudah disetujui pembimbing & wakasek</div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title-sm">Daftar Pengajuan PKL</div>
            <div class="card-subtitle">Kelola pengajuan Praktik Kerja Lapangan</div>
        </div>
        @if(!$pklAktif)
        <a href="{{ route('siswa.pkl.pengajuan.create') }}" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Ajukan PKL
        </a>
        @endif
    </div>

    @forelse($semua as $p)
    <div style="padding:20px;border-bottom:1px solid var(--border);transition:background .15s" onmouseover="this.style.background='var(--tag-bg)'" onmouseout="this.style.background=''">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap">
            <div style="flex:1">
                {{-- Nama + Role --}}
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
                    <div style="font-size:1rem;font-weight:800;color:var(--text)">{{ $p->nama_perusahaan }}</div>
                    @if($p->ketua_id === Auth::id())
                        <span style="font-size:.63rem;background:rgba(102,126,234,.12);color:var(--primary);padding:2px 9px;border-radius:20px;font-weight:700;letter-spacing:.04em">KETUA</span>
                    @else
                        <span style="font-size:.63rem;background:var(--tag-bg);color:var(--text-muted);padding:2px 9px;border-radius:20px;font-weight:700;letter-spacing:.04em">ANGGOTA</span>
                    @endif
                </div>

                {{-- Alamat --}}
                <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:10px;display:flex;align-items:flex-start;gap:6px">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;flex-shrink:0;margin-top:2px;color:var(--text-sub)"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ Str::limit($p->alamat_perusahaan, 80) }}
                </div>

                {{-- Pembimbing & Tanggal --}}
                <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center">
                    <span style="font-size:.72rem;color:var(--text-sub)">Pembimbing:</span>
                    <span class="badge info">{{ $p->pembimbing_id ? $p->pembimbing->namaLengkap() : 'Belum ditentukan' }}</span>
                    <span style="font-size:.72rem;color:var(--text-sub)">•</span>
                    <span style="font-size:.72rem;color:var(--text-sub)">{{ $p->tanggal_pengajuan->format('d M Y') }}</span>
                </div>
            </div>

            {{-- Status & Aksi --}}
            <div style="display:flex;flex-direction:column;gap:8px;align-items:flex-end">
                @php $bs = ['disetujui'=>'approved','pending'=>'pending','ditolak'=>'rejected']; @endphp
                <div style="display:flex;gap:8px;align-items:center">
                    <span style="font-size:.7rem;color:var(--text-sub)">Pembimbing</span>
                    <span class="badge {{ $bs[$p->status_pembimbing] ?? 'info' }}">{{ ucfirst($p->status_pembimbing) }}</span>
                </div>
                <div style="display:flex;gap:8px;align-items:center">
                    <span style="font-size:.7rem;color:var(--text-sub)">Wakasek</span>
                    <span class="badge {{ $bs[$p->status_wakasek] ?? 'info' }}">{{ ucfirst($p->status_wakasek) }}</span>
                </div>
                <a href="{{ route('siswa.pkl.pengajuan.show', $p->id) }}" class="btn-secondary" style="padding:6px 14px;font-size:.75rem;margin-top:4px">
                    Detail
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
        </div>
    </div>

    @empty
    <div class="empty-state">
        <div class="empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
        </div>
        <div class="empty-title">Belum Ada Pengajuan</div>
        <div class="empty-desc" style="margin-bottom:18px">Ajukan PKL ke perusahaan pilihanmu sekarang.</div>
        <a href="{{ route('siswa.pkl.pengajuan.create') }}" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Ajukan PKL Sekarang
        </a>
    </div>
    @endforelse
</div>

@endsection