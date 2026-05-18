@extends('layouts.siswa')
@section('title','Laporan PKL')
@section('page_title','Laporan PKL')
@section('nav_laporan','active')

@section('content')

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px">
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <span class="stat-badge info">Total</span>
        </div>
        <div class="stat-num">{{ $total }}</div>
        <div class="stat-label">Total Laporan</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <span class="stat-badge up">Acc</span>
        </div>
        <div class="stat-num">{{ $disetujui }}</div>
        <div class="stat-label">Disetujui</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <span class="stat-badge warn">Proses</span>
        </div>
        <div class="stat-num">{{ $pending }}</div>
        <div class="stat-label">Menunggu</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top">
            <div class="stat-icon pink">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.01"/></svg>
            </div>
            <span class="stat-badge down">Revisi</span>
        </div>
        <div class="stat-num">{{ $revisi }}</div>
        <div class="stat-label">Perlu Revisi</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title-sm">Daftar Laporan</div>
            <div class="card-subtitle">Upload dan kelola laporan PKL kamu</div>
        </div>
        <a href="{{ route('siswa.laporan.create') }}" class="btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Laporan
        </a>
    </div>

    <div style="overflow-x:auto;margin-top:4px">
        <table style="width:100%;border-collapse:collapse;font-size:.82rem">
            <thead>
                <tr style="border-bottom:1px solid var(--border)">
                    @foreach(['#','Judul','Jenis','Status Pembimbing','Status Wakasek','Tanggal','Aksi'] as $h)
                    <th style="padding:10px 12px;text-align:left;font-size:.7rem;font-weight:700;color:var(--text-sub);letter-spacing:.05em;text-transform:uppercase;white-space:nowrap">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($laporans as $i => $lap)
                <tr style="border-bottom:1px solid var(--border);transition:background .15s" onmouseover="this.style.background='var(--tag-bg)'" onmouseout="this.style.background=''">
                    <td style="padding:12px;color:var(--text-sub)">{{ $laporans->firstItem() + $i }}</td>
                    <td style="padding:12px;max-width:240px">
                        <div style="font-weight:600;color:var(--text)">{{ $lap->judul() }}</div>
                        @if($lap->catatan_revisi)
                        <div style="font-size:.7rem;color:#ea580c;margin-top:3px">📝 {{ Str::limit($lap->catatan_revisi,60) }}</div>
                        @endif
                    </td>
                    <td style="padding:12px">
                        <span class="badge info">{{ ucfirst($lap->jenis_laporan) }}</span>
                    </td>
                    <td style="padding:12px">
                        @php $bp = ['disetujui'=>'approved','pending'=>'pending','ditolak'=>'rejected']; @endphp
                        <span class="badge {{ $bp[$lap->status_pembimbing] ?? 'info' }}">{{ ucfirst($lap->status_pembimbing) }}</span>
                    </td>
                    <td style="padding:12px">
                        <span class="badge {{ $bp[$lap->status_wakasek] ?? 'info' }}">{{ ucfirst($lap->status_wakasek) }}</span>
                    </td>
                    <td style="padding:12px;font-size:.75rem;color:var(--text-muted);white-space:nowrap">{{ $lap->created_at->format('d M Y') }}</td>
                    <td style="padding:12px">
                        <div style="display:flex;gap:6px">
                            @if($lap->file_path)
                            <a href="{{ $lap->fileUrl() }}" target="_blank" class="btn-secondary" style="padding:5px 11px;font-size:.72rem">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Unduh
                            </a>
                            @endif
                            <a href="{{ route('siswa.laporan.show',$lap->id) }}" class="btn-secondary" style="padding:5px 11px;font-size:.72rem">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                {{ $lap->file_path ? 'Ganti' : 'Upload' }}
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="empty-title">Belum Ada Laporan</div>
                            <div class="empty-desc">Upload laporan PKL kamu untuk diperiksa pembimbing.<br>
                                <a href="{{ route('siswa.laporan.create') }}" style="color:var(--primary);font-weight:600">Buat laporan sekarang →</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($laporans->hasPages())
    <div style="padding:16px 0 4px">{{ $laporans->links() }}</div>
    @endif
</div>

@endsection