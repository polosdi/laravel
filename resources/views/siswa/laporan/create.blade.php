@extends('layouts.siswa')
@section('title','Tambah Laporan PKL')
@section('page_title','Tambah Laporan')
@section('nav_laporan','active')

@section('content')
<div style="max-width:600px">
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title-sm">Form Laporan PKL</div>
                <div class="card-subtitle">Upload laporan PKL kamu</div>
            </div>
            <a href="{{ route('siswa.laporan') }}" class="btn-secondary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('siswa.laporan.store') }}" method="POST" enctype="multipart/form-data" style="padding-top:4px">
            @csrf

            {{-- Jenis --}}
            <div style="margin-bottom:16px">
                <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                    Jenis Laporan <span style="color:#ef4444">*</span>
                </label>
                <select name="jenis_laporan" required
                    style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('jenis_laporan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;cursor:pointer">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="mingguan" {{ old('jenis_laporan')=='mingguan'?'selected':'' }}>Laporan Mingguan</option>
                    <option value="akhir"    {{ old('jenis_laporan')=='akhir'   ?'selected':'' }}>Laporan Akhir PKL</option>
                </select>
                @error('jenis_laporan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            {{-- Judul --}}
            <div style="margin-bottom:16px">
                <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                    Judul Laporan <span style="font-weight:400;color:var(--text-sub)">(opsional)</span>
                </label>
                <input type="text" name="judul_laporan"
                    value="{{ old('judul_laporan') }}"
                    placeholder="Contoh: Laporan Minggu ke-1 — Pengenalan Sistem"
                    style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('judul_laporan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;transition:border-color .2s">
                @error('judul_laporan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            {{-- File --}}
            <div style="margin-bottom:20px">
                <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                    File Laporan <span style="font-weight:400;color:var(--text-sub)">(opsional, bisa upload nanti)</span>
                </label>
                <input type="file" name="file_laporan" accept=".pdf,.doc,.docx"
                    style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('file_laporan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text-muted);font-size:.82rem;font-family:var(--font);cursor:pointer">
                @error('file_laporan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                <div style="font-size:.72rem;color:var(--text-sub);margin-top:5px">Format PDF/DOC/DOCX, maksimal 10MB</div>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid var(--border)">
                <a href="{{ route('siswa.laporan') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection