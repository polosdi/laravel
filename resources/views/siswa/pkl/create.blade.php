@extends('layouts.siswa')
@section('title','Ajukan PKL')
@section('page_title','Pengajuan PKL Baru')
@section('nav_pengajuan','active')

@section('content')
<div style="max-width:720px">
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title-sm">Form Pengajuan PKL</div>
                <div class="card-subtitle">Isi detail tempat PKL yang ingin kamu ajukan</div>
            </div>
            <a href="{{ route('siswa.pkl.pengajuan') }}" class="btn-secondary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('siswa.pkl.pengajuan.store') }}" method="POST" enctype="multipart/form-data" style="padding-top:4px">
            @csrf

            {{-- Info --}}
            <div style="display:flex;align-items:flex-start;gap:10px;padding:12px 14px;background:rgba(102,126,234,.06);border:1px solid var(--border);border-radius:12px;margin-bottom:20px">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;color:var(--primary);flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div style="font-size:.78rem;color:var(--text-muted);line-height:1.55">Pengajuan akan dikirim ke pembimbing untuk disetujui, kemudian dilanjutkan ke wakasek.</div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">

                {{-- Nama Perusahaan --}}
                <div style="grid-column:1/-1">
                    <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                        Nama Perusahaan / Instansi <span style="color:#ef4444">*</span>
                    </label>
                    <input type="text" name="nama_perusahaan"
                        value="{{ old('nama_perusahaan') }}"
                        placeholder="Contoh: PT Teknologi Nusantara" required
                        style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('nama_perusahaan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;transition:border-color .2s">
                    @error('nama_perusahaan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                {{-- Alamat --}}
                <div style="grid-column:1/-1">
                    <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                        Alamat Lengkap <span style="color:#ef4444">*</span>
                    </label>
                    <textarea name="alamat_perusahaan" rows="3" required
                        placeholder="Jl. Contoh No. 1, Kelurahan, Kecamatan, Kota/Kabupaten"
                        style="width:100%;padding:10px 12px;border-radius:10px;border:1px solid {{ $errors->has('alamat_perusahaan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;resize:vertical">{{ old('alamat_perusahaan') }}</textarea>
                    @error('alamat_perusahaan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                {{-- Website --}}
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                        Website <span style="font-weight:400;color:var(--text-sub)">(opsional)</span>
                    </label>
                    <input type="url" name="website"
                        value="{{ old('website') }}"
                        placeholder="https://perusahaan.com"
                        style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('website') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;transition:border-color .2s">
                    @error('website')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                {{-- Dokumen --}}
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                        Dokumen Pengajuan <span style="font-weight:400;color:var(--text-sub)">(opsional)</span>
                    </label>
                    <input type="file" name="file_dokumen" accept=".pdf,.doc,.docx"
                        style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('file_dokumen') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text-muted);font-size:.82rem;font-family:var(--font);cursor:pointer">
                    @error('file_dokumen')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                    <div style="font-size:.72rem;color:var(--text-sub);margin-top:5px">PDF/DOC/DOCX maks 5MB</div>
                </div>
            </div>

            {{-- Anggota --}}
            <div style="border-top:1px solid var(--border);padding-top:18px;margin-top:18px">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px">
                    <div class="stat-icon purple" style="width:32px;height:32px;flex-shrink:0">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <div style="font-size:.88rem;font-weight:700;color:var(--text)">Anggota Kelompok</div>
                        <div style="font-size:.7rem;color:var(--text-sub)">Opsional — tambahkan NIS teman satu kelompok</div>
                    </div>
                </div>

                <div id="anggota-list">
                    <div class="anggota-row" style="display:flex;gap:8px;margin-bottom:8px">
                        <input type="text" name="anggota_nis[]"
                            placeholder="Cari NIS atau nama teman..."
                            style="flex:1;padding:9px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none">
                        <button type="button" onclick="tambahAnggota()" class="btn-secondary" style="padding:9px 16px;white-space:nowrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Tambah
                        </button>
                    </div>
                </div>
                <div style="font-size:.72rem;color:var(--text-sub)">Kamu sebagai ketua sudah otomatis terdaftar</div>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:18px;margin-top:4px;border-top:1px solid var(--border)">
                <a href="{{ route('siswa.pkl.pengajuan') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
function tambahAnggota() {
    const list = document.getElementById('anggota-list');
    const div = document.createElement('div');
    div.className = 'anggota-row';
    div.style.cssText = 'display:flex;gap:8px;margin-bottom:8px';
    div.innerHTML = `
        <input type="text" name="anggota_nis[]"
            placeholder="Cari NIS atau nama teman..."
            style="flex:1;padding:9px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none">
        <button type="button" onclick="this.parentElement.remove()"
            style="padding:9px 14px;border-radius:10px;border:1px solid rgba(239,68,68,.3);background:rgba(239,68,68,.06);color:#ef4444;cursor:pointer;font-family:var(--font);font-size:.82rem;font-weight:600;display:flex;align-items:center;gap:4px;transition:all .2s">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            Hapus
        </button>
    `;
    list.appendChild(div);
}
@endsection
@endsection