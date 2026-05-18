@extends('layouts.siswa')
@section('title','Detail Laporan')
@section('page_title','Detail Laporan')
@section('nav_laporan','active')

@section('content')
<div style="max-width:640px">
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title-sm">{{ $laporan->judul() }}</div>
                <div class="card-subtitle">Detail & upload file laporan PKL</div>
            </div>
            <a href="{{ route('siswa.laporan') }}" class="btn-secondary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
        </div>

        {{-- Info Laporan --}}
        @php $bp = ['disetujui'=>'approved','pending'=>'pending','ditolak'=>'rejected']; @endphp
        <div style="background:var(--tag-bg);border-radius:12px;padding:16px;margin-bottom:20px;border:1px solid var(--border)">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                <div class="info-item" style="margin-bottom:0">
                    <div class="info-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div>
                        <div class="info-label">Jenis</div>
                        <div class="info-value">{{ ucfirst($laporan->jenis_laporan) }}</div>
                    </div>
                </div>
                <div class="info-item" style="margin-bottom:0">
                    <div class="info-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                        <div class="info-label">Dikirim</div>
                        <div class="info-value">{{ $laporan->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                <div>
                    <div style="font-size:.67rem;color:var(--text-sub);font-weight:500;margin-bottom:5px">Status Pembimbing</div>
                    <span class="badge {{ $bp[$laporan->status_pembimbing] ?? 'info' }}">{{ ucfirst($laporan->status_pembimbing) }}</span>
                </div>
                <div>
                    <div style="font-size:.67rem;color:var(--text-sub);font-weight:500;margin-bottom:5px">Status Wakasek</div>
                    <span class="badge {{ $bp[$laporan->status_wakasek] ?? 'info' }}">{{ ucfirst($laporan->status_wakasek) }}</span>
                </div>
            </div>

            @if($laporan->catatan_revisi)
            <div style="margin-top:14px;padding:10px 12px;background:rgba(249,115,22,.06);border:1px solid rgba(249,115,22,.2);border-radius:10px;font-size:.78rem;color:#ea580c">
                <strong>📝 Catatan Revisi:</strong> {{ $laporan->catatan_revisi }}
            </div>
            @endif
        </div>

        {{-- File yang sudah ada --}}
        @if($laporan->file_path)
        <div style="display:flex;align-items:center;gap:14px;padding:14px 16px;background:rgba(34,197,94,.05);border:1px solid rgba(34,197,94,.2);border-radius:12px;margin-bottom:20px">
            <div class="stat-icon green" style="width:42px;height:42px;flex-shrink:0">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div style="flex:1">
                <div style="font-size:.82rem;font-weight:600;color:var(--text)">File sudah diupload</div>
                <div style="font-size:.72rem;color:var(--text-muted);margin-top:2px">{{ basename($laporan->file_path) }}</div>
            </div>
            <a href="{{ $laporan->fileUrl() }}" target="_blank" class="btn-secondary" style="padding:7px 14px;font-size:.75rem">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Unduh
            </a>
        </div>
        @endif

        {{-- Form Upload --}}
        <div style="border-top:1px solid var(--border);padding-top:18px">
            <div style="font-size:.82rem;font-weight:700;color:var(--text);margin-bottom:14px">
                {{ $laporan->file_path ? '🔄 Ganti File Laporan' : '⬆ Upload File Laporan' }}
            </div>
            <form action="{{ route('siswa.laporan.upload', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom:16px">
                    <input type="file" name="file_laporan" accept=".pdf,.doc,.docx" required
                        style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('file_laporan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text-muted);font-size:.82rem;font-family:var(--font);cursor:pointer">
                    @error('file_laporan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                    <div style="font-size:.72rem;color:var(--text-sub);margin-top:5px">
                        Format PDF/DOC/DOCX, maksimal 10MB{{ $laporan->file_path ? '. File lama akan diganti.' : '' }}
                    </div>
                </div>
                <div style="display:flex;gap:10px;justify-content:flex-end">
                    <a href="{{ route('siswa.laporan') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Upload File
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection