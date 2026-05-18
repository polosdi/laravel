@extends('layouts.siswa')
@section('title','Tambah Jurnal Harian')
@section('page_title','Tambah Jurnal')
@section('nav_jurnal','active')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
.create-layout {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 20px;
    align-items: start;
    max-width: 1000px;
}
.form-field { margin-bottom: 18px; }
.form-label {
    display: block; font-size: .78rem; font-weight: 600;
    color: var(--text); margin-bottom: 7px;
    display: flex; align-items: center; gap: 6px;
}
.form-label i { color: var(--primary); font-size: .75rem; }
.form-input {
    width: 100%; padding: 9px 12px;
    border-radius: 10px; border: 1px solid var(--border);
    background: var(--card-bg); color: var(--text);
    font-size: .82rem; font-family: var(--font);
    outline: none; transition: border-color .2s, box-shadow .2s;
}
.form-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(102,126,234,.1); }
.form-input.error { border-color: #ef4444; }
.form-hint { font-size: .7rem; color: var(--text-sub); margin-top: 5px; display: flex; align-items: center; gap: 4px; }
.form-error { font-size: .72rem; color: #ef4444; margin-top: 4px; display: flex; align-items: center; gap: 4px; }

.side-panel {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    position: sticky;
    top: 84px;
}
.side-panel-header {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 8px;
    background: var(--tag-bg);
}
.side-panel-title { font-size: .82rem; font-weight: 700; color: var(--text); }
.side-panel-body { padding: 14px 16px; }

.guide-step {
    display: flex; gap: 10px; margin-bottom: 14px;
    padding-bottom: 14px; border-bottom: 1px solid var(--border);
}
.guide-step:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
.guide-num {
    width: 26px; height: 26px; border-radius: 50%; flex-shrink: 0;
    background: var(--grad); color: white;
    display: flex; align-items: center; justify-content: center;
    font-size: .68rem; font-weight: 800;
}
.guide-text { font-size: .72rem; color: var(--text-muted); line-height: 1.55; }
.guide-text strong { display: block; color: var(--text); font-size: .75rem; margin-bottom: 2px; }

.char-counter { font-size: .7rem; color: var(--text-sub); text-align: right; margin-top: 4px; }
.char-counter span { color: var(--primary); font-weight: 600; }

@media (max-width: 860px) {
    .create-layout { grid-template-columns: 1fr; }
    .side-panel { position: static; }
}
</style>
@endsection

@section('content')
<div class="create-layout">

    {{-- LEFT: Form --}}
    <div>
        @if($sudahAda)
        <div style="display:flex;align-items:flex-start;gap:12px;padding:13px 16px;background:rgba(102,126,234,.07);border:1px solid rgba(102,126,234,.2);border-radius:13px;margin-bottom:16px">
            <i class="fa-solid fa-circle-info" style="color:var(--primary);font-size:.9rem;margin-top:1px;flex-shrink:0"></i>
            <div style="font-size:.8rem;color:var(--text)">Jurnal untuk <strong>hari ini</strong> sudah ada. Kamu bisa mengisi untuk tanggal lain.</div>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div>
                    <div class="card-title-sm" style="display:flex;align-items:center;gap:7px">
                        <i class="fa-solid fa-plus-circle" style="color:var(--primary);font-size:.85rem"></i>
                        Form Jurnal Harian
                    </div>
                    <div class="card-subtitle">Catat kegiatan PKL hari ini</div>
                </div>
                <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">
                    <i class="fa-solid fa-arrow-left" style="font-size:.75rem"></i>
                    Kembali
                </a>
            </div>

            <form action="{{ route('siswa.jurnal.store') }}" method="POST" enctype="multipart/form-data" style="padding:18px 20px">
                @csrf

                {{-- Row 1: Tanggal + Jam --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px">
                    <div class="form-field" style="margin-bottom:0">
                        <label class="form-label">
                            <i class="fa-solid fa-calendar-day"></i>
                            Tanggal <span style="color:#ef4444;margin-left:2px">*</span>
                        </label>
                        <input type="date" name="tanggal"
                            value="{{ old('tanggal', today()->format('Y-m-d')) }}"
                            max="{{ today()->format('Y-m-d') }}" required
                            class="form-input {{ $errors->has('tanggal') ? 'error' : '' }}">
                        @error('tanggal')
                        <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field" style="margin-bottom:0">
                        <label class="form-label">
                            <i class="fa-solid fa-clock"></i> Jam Kerja
                        </label>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
                            <div>
                                <div style="font-size:.7rem;color:var(--text-sub);margin-bottom:4px;display:flex;align-items:center;gap:4px">
                                    <i class="fa-solid fa-arrow-right-to-bracket" style="color:#22c55e;font-size:.65rem"></i> Masuk
                                </div>
                                <input type="time" name="jam_masuk" value="{{ old('jam_masuk') }}" class="form-input" style="font-size:.78rem">
                            </div>
                            <div>
                                <div style="font-size:.7rem;color:var(--text-sub);margin-bottom:4px;display:flex;align-items:center;gap:4px">
                                    <i class="fa-solid fa-arrow-right-from-bracket" style="color:#ef4444;font-size:.65rem"></i> Keluar
                                </div>
                                <input type="time" name="jam_keluar" value="{{ old('jam_keluar') }}" class="form-input" style="font-size:.78rem">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kegiatan --}}
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Uraian Kegiatan <span style="color:#ef4444;margin-left:2px">*</span>
                    </label>
                    <textarea name="kegiatan" rows="7" required id="kegiatanArea"
                        placeholder="Ceritakan kegiatan yang kamu lakukan hari ini secara detail — apa yang dikerjakan, hasil yang dicapai, dan hal baru yang dipelajari..."
                        class="form-input {{ $errors->has('kegiatan') ? 'error' : '' }}"
                        oninput="updateCounter(this)"
                        style="resize:vertical">{{ old('kegiatan') }}</textarea>
                    @error('kegiatan')
                    <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
                    @enderror
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:5px">
                        <div class="form-hint"><i class="fa-solid fa-circle-info"></i> Minimal 10 karakter. Sertakan hasil dan hal yang dipelajari.</div>
                        <div class="char-counter"><span id="charCount">0</span> karakter</div>
                    </div>
                </div>

                {{-- Foto --}}
                <div class="form-field" style="margin-bottom:0">
                    <label class="form-label">
                        <i class="fa-solid fa-camera"></i>
                        Foto Kegiatan <span style="font-weight:400;color:var(--text-sub);font-size:.72rem">(opsional)</span>
                    </label>
                    <div id="drop-zone" style="border:2px dashed var(--border);border-radius:12px;padding:20px;text-align:center;cursor:pointer;transition:all .2s;background:var(--tag-bg)" onclick="document.getElementById('fotoInput').click()" ondragover="event.preventDefault();this.style.borderColor='var(--primary)'" ondragleave="this.style.borderColor='var(--border)'">
                        <div id="drop-placeholder">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.5rem;color:var(--text-sub);display:block;margin-bottom:7px"></i>
                            <div style="font-size:.78rem;color:var(--text-muted)">Klik atau drag & drop foto di sini</div>
                            <div style="font-size:.7rem;color:var(--text-sub);margin-top:3px">JPG / PNG / WEBP — Maks. 2MB</div>
                        </div>
                        <img id="preview-foto" src="" style="display:none;max-width:180px;border-radius:10px;border:1px solid var(--border);margin:0 auto">
                    </div>
                    <input type="file" id="fotoInput" name="foto_kegiatan" accept="image/jpeg,image/png,image/webp" onchange="previewFoto(this)" style="display:none">
                    @error('foto_kegiatan')
                    <div class="form-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:18px;margin-top:18px;border-top:1px solid var(--border)">
                    <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">
                        <i class="fa-solid fa-xmark" style="font-size:.8rem"></i> Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Jurnal
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- RIGHT: Side panel --}}
    <div>
        {{-- Panduan --}}
        <div class="side-panel" style="margin-bottom:16px">
            <div class="side-panel-header">
                <i class="fa-solid fa-circle-question" style="color:var(--primary);font-size:.85rem"></i>
                <span class="side-panel-title">Panduan Pengisian</span>
            </div>
            <div class="side-panel-body">
                <div class="guide-step">
                    <div class="guide-num">1</div>
                    <div class="guide-text">
                        <strong>Pilih tanggal kegiatan</strong>
                        Pastikan tanggal sesuai hari kamu bekerja di tempat PKL.
                    </div>
                </div>
                <div class="guide-step">
                    <div class="guide-num">2</div>
                    <div class="guide-text">
                        <strong>Isi jam masuk & keluar</strong>
                        Data ini digunakan untuk rekap absensi otomatis oleh sistem.
                    </div>
                </div>
                <div class="guide-step">
                    <div class="guide-num">3</div>
                    <div class="guide-text">
                        <strong>Tulis uraian lengkap</strong>
                        Ceritakan apa yang dikerjakan, hasil, dan hal yang dipelajari hari ini.
                    </div>
                </div>
                <div class="guide-step">
                    <div class="guide-num">4</div>
                    <div class="guide-text">
                        <strong>Upload foto bukti</strong>
                        Foto memperkuat validasi pembimbing & memperlihatkan bukti nyata kegiatanmu.
                    </div>
                </div>
            </div>
        </div>

        {{-- Info status --}}
        <div class="side-panel">
            <div class="side-panel-header">
                <i class="fa-solid fa-circle-info" style="color:#3b82f6;font-size:.85rem"></i>
                <span class="side-panel-title">Info Status Jurnal</span>
            </div>
            <div class="side-panel-body">
                <div style="display:flex;align-items:flex-start;gap:8px;margin-bottom:10px">
                    <span class="badge pending" style="flex-shrink:0;margin-top:1px"><i class="fa-solid fa-clock"></i> Pending</span>
                    <span style="font-size:.72rem;color:var(--text-muted)">Menunggu ditinjau oleh pembimbing.</span>
                </div>
                <div style="display:flex;align-items:flex-start;gap:8px;margin-bottom:10px">
                    <span class="badge approved" style="flex-shrink:0;margin-top:1px"><i class="fa-solid fa-circle-check"></i> Valid</span>
                    <span style="font-size:.72rem;color:var(--text-muted)">Sudah disetujui, tidak bisa diedit.</span>
                </div>
                <div style="display:flex;align-items:flex-start;gap:8px">
                    <span class="badge rejected" style="flex-shrink:0;margin-top:1px"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                    <span style="font-size:.72rem;color:var(--text-muted)">Ditolak pembimbing, cek komentarnya.</span>
                </div>
            </div>
        </div>
    </div>

</div>

@section('scripts')
function previewFoto(input) {
    const preview = document.getElementById('preview-foto');
    const placeholder = document.getElementById('drop-placeholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function updateCounter(el) {
    document.getElementById('charCount').textContent = el.value.length;
}
// init counter
const ta = document.getElementById('kegiatanArea');
if (ta) document.getElementById('charCount').textContent = ta.value.length;
@endsection
@endsection
