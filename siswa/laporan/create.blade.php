@extends('layouts.app')
@section('title','Tambah Laporan PKL')
@section('page-title','Tambah Laporan')
@section('page-sub','Upload laporan PKL kamu')

@section('content')
<div style="max-width:600px">
    <div class="card">
        <div class="card-header">
            <div class="card-title">📄 Form Laporan PKL</div>
            <a href="{{ route('siswa.laporan') }}" class="btn-secondary" style="padding:7px 14px;font-size:var(--fs-xs)">← Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Jenis Laporan <span>*</span></label>
                    <select name="jenis_laporan" class="form-control {{ $errors->has('jenis_laporan')?'is-invalid':'' }}" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="mingguan" {{ old('jenis_laporan')=='mingguan'?'selected':'' }}>Laporan Mingguan</option>
                        <option value="akhir"    {{ old('jenis_laporan')=='akhir'   ?'selected':'' }}>Laporan Akhir PKL</option>
                    </select>
                    @error('jenis_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Laporan <span style="color:var(--text-muted);font-weight:400">(opsional)</span></label>
                    <input type="text" name="judul_laporan" class="form-control {{ $errors->has('judul_laporan')?'is-invalid':'' }}"
                        value="{{ old('judul_laporan') }}"
                        placeholder="Contoh: Laporan Minggu ke-1 — Pengenalan Sistem">
                    @error('judul_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">File Laporan <span style="color:var(--text-muted);font-weight:400">(opsional, bisa upload nanti)</span></label>
                    <input type="file" name="file_laporan" accept=".pdf,.doc,.docx"
                        class="form-control {{ $errors->has('file_laporan')?'is-invalid':'' }}">
                    @error('file_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-hint">Format PDF/DOC/DOCX, maksimal 10MB</div>
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:8px">
                    <a href="{{ route('siswa.laporan') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">💾 Kirim Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
