@extends('layouts.siswa')
@section('title','Tambah Jurnal Harian')
@section('page_title','Tambah Jurnal')
@section('nav_jurnal','active')

@section('content')
<div style="max-width:680px">

    @if($sudahAda)
    <div style="display:flex;align-items:flex-start;gap:12px;padding:14px 16px;background:rgba(102,126,234,.06);border:1px solid var(--border);border-radius:14px;margin-bottom:18px">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;color:var(--primary);flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <div style="font-size:.82rem;color:var(--text)">Jurnal untuk <strong>hari ini</strong> sudah ada. Kamu bisa mengisi untuk tanggal lain.</div>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title-sm">Form Jurnal Harian</div>
                <div class="card-subtitle">Catat kegiatan PKL hari ini</div>
            </div>
            <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('siswa.jurnal.store') }}" method="POST" enctype="multipart/form-data" style="padding-top:4px">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                {{-- Tanggal --}}
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                        Tanggal <span style="color:#ef4444">*</span>
                    </label>
                    <input type="date" name="tanggal"
                        value="{{ old('tanggal', today()->format('Y-m-d')) }}"
                        max="{{ today()->format('Y-m-d') }}" required
                        style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('tanggal') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;transition:border-color .2s">
                    @error('tanggal')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                {{-- Jam --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">Jam Masuk</label>
                        <input type="time" name="jam_masuk" value="{{ old('jam_masuk') }}"
                            style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none">
                        @error('jam_masuk')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">Jam Keluar</label>
                        <input type="time" name="jam_keluar" value="{{ old('jam_keluar') }}"
                            style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none">
                        @error('jam_keluar')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Kegiatan --}}
            <div style="margin-bottom:16px">
                <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                    Uraian Kegiatan <span style="color:#ef4444">*</span>
                </label>
                <textarea name="kegiatan" rows="6" required
                    placeholder="Ceritakan kegiatan yang kamu lakukan hari ini secara detail..."
                    style="width:100%;padding:10px 12px;border-radius:10px;border:1px solid {{ $errors->has('kegiatan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;resize:vertical;transition:border-color .2s">{{ old('kegiatan') }}</textarea>
                @error('kegiatan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                <div style="font-size:.72rem;color:var(--text-sub);margin-top:5px">Minimal 10 karakter. Jelaskan kegiatan, hasil, dan hal yang dipelajari.</div>
            </div>

            {{-- Foto --}}
            <div style="margin-bottom:20px">
                <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                    Foto Kegiatan <span style="font-weight:400;color:var(--text-sub)">(opsional)</span>
                </label>
                <input type="file" name="foto_kegiatan" accept="image/jpeg,image/png,image/webp"
                    onchange="previewFoto(this)"
                    style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('foto_kegiatan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text-muted);font-size:.82rem;font-family:var(--font);cursor:pointer">
                @error('foto_kegiatan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                <div style="font-size:.72rem;color:var(--text-sub);margin-top:5px">Format JPG/PNG/WEBP, maksimal 2MB</div>
                <img id="preview-foto" src="" style="display:none;margin-top:10px;max-width:200px;border-radius:10px;border:1px solid var(--border)">
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid var(--border)">
                <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Jurnal
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
function previewFoto(input) {
    const preview = document.getElementById('preview-foto');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
@endsection
@endsection