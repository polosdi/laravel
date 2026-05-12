@extends('layouts.app')
@section('title','Detail Laporan')
@section('page-title','Detail Laporan')
@section('page-sub','Upload atau lihat file laporan PKL')

@section('content')
<div style="max-width:640px">
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ $laporan->judul() }}</div>
            <a href="{{ route('siswa.laporan') }}" class="btn-secondary" style="padding:7px 14px;font-size:var(--fs-xs)">← Kembali</a>
        </div>
        <div class="card-body">

            {{-- Info laporan --}}
            <div style="background:var(--bg);border-radius:var(--r-lg);padding:16px;margin-bottom:20px;border:1px solid var(--border)">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                    <div>
                        <div style="font-size:var(--fs-xs);color:var(--text-muted)">Jenis</div>
                        <div style="font-size:var(--fs-sm);font-weight:600">{{ ucfirst($laporan->jenis_laporan) }}</div>
                    </div>
                    <div>
                        <div style="font-size:var(--fs-xs);color:var(--text-muted)">Dikirim</div>
                        <div style="font-size:var(--fs-sm);font-weight:600">{{ $laporan->created_at->format('d M Y') }}</div>
                    </div>
                    <div>
                        <div style="font-size:var(--fs-xs);color:var(--text-muted)">Status Pembimbing</div>
                        <span class="badge badge-{{ $laporan->status_pembimbing }}">{{ ucfirst($laporan->status_pembimbing) }}</span>
                    </div>
                    <div>
                        <div style="font-size:var(--fs-xs);color:var(--text-muted)">Status Wakasek</div>
                        <span class="badge badge-{{ $laporan->status_wakasek }}">{{ ucfirst($laporan->status_wakasek) }}</span>
                    </div>
                </div>
                @if($laporan->catatan_revisi)
                <div style="margin-top:12px;padding:10px 12px;background:rgba(249,115,22,.06);border:1px solid rgba(249,115,22,.2);border-radius:var(--r-md);font-size:var(--fs-xs);color:#ea580c">
                    📝 <strong>Catatan Revisi:</strong> {{ $laporan->catatan_revisi }}
                </div>
                @endif
            </div>

            {{-- File yang sudah ada --}}
            @if($laporan->file_path)
            <div style="display:flex;align-items:center;gap:12px;padding:14px;background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.2);border-radius:var(--r-lg);margin-bottom:20px">
                <span style="font-size:1.5rem">📁</span>
                <div style="flex:1">
                    <div style="font-size:var(--fs-sm);font-weight:600;color:var(--text)">File sudah diupload</div>
                    <div style="font-size:var(--fs-xs);color:var(--text-muted)">{{ basename($laporan->file_path) }}</div>
                </div>
                <a href="{{ $laporan->fileUrl() }}" class="btn-secondary" style="padding:7px 14px;font-size:var(--fs-xs)" target="_blank">⬇ Unduh</a>
            </div>
            @endif

            {{-- Form upload --}}
            <form action="{{ route('siswa.laporan.upload', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">{{ $laporan->file_path ? '🔄 Ganti File Laporan' : '⬆ Upload File Laporan' }} <span>*</span></label>
                    <input type="file" name="file_laporan" accept=".pdf,.doc,.docx"
                        class="form-control {{ $errors->has('file_laporan')?'is-invalid':'' }}" required>
                    @error('file_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-hint">Format PDF/DOC/DOCX, maksimal 10MB{{ $laporan->file_path ? '. File lama akan diganti.' : '' }}</div>
                </div>
                <div style="display:flex;gap:10px;justify-content:flex-end">
                    <a href="{{ route('siswa.laporan') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">⬆ Upload File</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
