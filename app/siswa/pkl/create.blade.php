@extends('layouts.app')
@section('title','Ajukan PKL')
@section('page-title','Pengajuan PKL Baru')
@section('page-sub','Isi detail tempat PKL yang ingin kamu ajukan')

@section('content')
<div style="max-width:720px">
    <div class="card">
        <div class="card-header">
            <div class="card-title">📋 Form Pengajuan PKL</div>
            <a href="{{ route('siswa.pkl.pengajuan') }}" class="btn-secondary" style="padding:7px 14px;font-size:var(--fs-xs)">← Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.pkl.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Info --}}
                <div style="background:rgba(102,126,234,.06);border:1px solid var(--border);border-radius:var(--r-lg);padding:14px 16px;margin-bottom:20px;font-size:var(--fs-xs);color:var(--text-muted)">
                    ℹ️ Pengajuan akan dikirim ke pembimbing untuk disetujui, kemudian dilanjutkan ke wakasek.
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group" style="grid-column:1/-1">
                        <label class="form-label">Nama Perusahaan / Instansi <span>*</span></label>
                        <input type="text" name="nama_perusahaan"
                            class="form-control {{ $errors->has('nama_perusahaan')?'is-invalid':'' }}"
                            value="{{ old('nama_perusahaan') }}"
                            placeholder="Contoh: PT Teknologi Nusantara" required>
                        @error('nama_perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group" style="grid-column:1/-1">
                        <label class="form-label">Alamat Lengkap <span>*</span></label>
                        <textarea name="alamat_perusahaan" rows="3"
                            class="form-control {{ $errors->has('alamat_perusahaan')?'is-invalid':'' }}"
                            placeholder="Jl. Contoh No. 1, Kelurahan, Kecamatan, Kota/Kabupaten" required>{{ old('alamat_perusahaan') }}</textarea>
                        @error('alamat_perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Website <span style="color:var(--text-muted);font-weight:400">(opsional)</span></label>
                        <input type="url" name="website"
                            class="form-control {{ $errors->has('website')?'is-invalid':'' }}"
                            value="{{ old('website') }}"
                            placeholder="https://perusahaan.com">
                        @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Dokumen Pengajuan <span style="color:var(--text-muted);font-weight:400">(opsional)</span></label>
                        <input type="file" name="file_dokumen" accept=".pdf,.doc,.docx"
                            class="form-control {{ $errors->has('file_dokumen')?'is-invalid':'' }}">
                        @error('file_dokumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-hint">PDF/DOC/DOCX maks 5MB</div>
                    </div>
                </div>

                {{-- Anggota tambahan --}}
                <div style="border-top:1px solid var(--border);padding-top:16px;margin-top:4px">
                    <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:var(--fs-base);margin-bottom:12px">
                        👥 Anggota Kelompok <span style="font-family:'DM Sans',sans-serif;font-weight:400;font-size:var(--fs-xs);color:var(--text-muted)">(opsional, tambahkan NIS teman)</span>
                    </div>
                    <div id="anggota-list">
                        <div class="anggota-row" style="display:flex;gap:8px;margin-bottom:8px">
                            <input type="text" name="anggota_nis[]" class="form-control" placeholder="Cari NIS atau nama teman..." style="flex:1">
                            <button type="button" onclick="tambahAnggota()" class="btn-secondary" style="padding:9px 16px;white-space:nowrap">+ Tambah</button>
                        </div>
                    </div>
                    <div class="form-hint">Kamu sebagai ketua sudah otomatis terdaftar</div>
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:20px;padding-top:16px;border-top:1px solid var(--border)">
                    <a href="{{ route('siswa.pkl.pengajuan') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">📤 Kirim Pengajuan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function tambahAnggota() {
    const list = document.getElementById('anggota-list');
    const div = document.createElement('div');
    div.className = 'anggota-row';
    div.style.cssText = 'display:flex;gap:8px;margin-bottom:8px';
    div.innerHTML = `
        <input type="text" name="anggota_nis[]" class="form-control" placeholder="Cari NIS atau nama teman..." style="flex:1">
        <button type="button" onclick="this.parentElement.remove()" class="btn-danger" style="padding:9px 14px">✕</button>
    `;
    list.appendChild(div);
}
</script>
@endpush
@endsection
