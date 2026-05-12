@extends('layouts.app')
@section('title','Tambah Jurnal Harian')
@section('page-title','Tambah Jurnal')
@section('page-sub','Catat kegiatan PKL hari ini')

@section('content')
<div style="max-width:680px">

    @if($sudahAda)
    <div class="alert alert-info">ℹ️ Jurnal untuk <strong>hari ini</strong> sudah ada. Kamu bisa mengisi untuk tanggal lain.</div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="card-title">📓 Form Jurnal Harian</div>
            <a href="{{ route('siswa.jurnal') }}" class="btn-secondary" style="padding:7px 14px;font-size:var(--fs-xs)">← Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.jurnal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Tanggal <span>*</span></label>
                        <input type="date" name="tanggal" class="form-control {{ $errors->has('tanggal')?'is-invalid':'' }}"
                            value="{{ old('tanggal', today()->format('Y-m-d')) }}"
                            max="{{ today()->format('Y-m-d') }}" required>
                        @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group" style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
                        <div>
                            <label class="form-label">Jam Masuk</label>
                            <input type="time" name="jam_masuk" class="form-control {{ $errors->has('jam_masuk')?'is-invalid':'' }}"
                                value="{{ old('jam_masuk') }}">
                            @error('jam_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label">Jam Keluar</label>
                            <input type="time" name="jam_keluar" class="form-control {{ $errors->has('jam_keluar')?'is-invalid':'' }}"
                                value="{{ old('jam_keluar') }}">
                            @error('jam_keluar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Uraian Kegiatan <span>*</span></label>
                    <textarea name="kegiatan" class="form-control {{ $errors->has('kegiatan')?'is-invalid':'' }}"
                        rows="6" placeholder="Ceritakan kegiatan yang kamu lakukan hari ini secara detail..." required>{{ old('kegiatan') }}</textarea>
                    @error('kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-hint">Minimal 10 karakter. Jelaskan kegiatan, hasil, dan hal yang dipelajari.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Kegiatan <span style="color:var(--text-muted);font-weight:400">(opsional)</span></label>
                    <input type="file" name="foto_kegiatan" accept="image/jpeg,image/png,image/webp"
                        class="form-control {{ $errors->has('foto_kegiatan')?'is-invalid':'' }}"
                        onchange="previewFoto(this)">
                    @error('foto_kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-hint">Format JPG/PNG/WEBP, maksimal 2MB</div>
                    <img id="preview-foto" src="" style="display:none;margin-top:8px;max-width:200px;border-radius:var(--r-md);border:1px solid var(--border)">
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:8px">
                    <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">💾 Simpan Jurnal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewFoto(input) {
    const preview = document.getElementById('preview-foto');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
