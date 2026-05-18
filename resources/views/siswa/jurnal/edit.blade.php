@extends('layouts.siswa')
@section('title','Edit Jurnal Harian')
@section('page_title','Edit Jurnal')
@section('nav_jurnal','active')

@section('content')
<div style="max-width:680px">
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title-sm">Edit Jurnal</div>
                <div class="card-subtitle">{{ $jurnal->tanggal->translatedFormat('d F Y') }}</div>
            </div>
            <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('siswa.jurnal.update', $jurnal->id) }}" method="POST" enctype="multipart/form-data" style="padding-top:4px">
            @csrf @method('PUT')

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                {{-- Tanggal --}}
                <div>
                    <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                        Tanggal <span style="color:#ef4444">*</span>
                    </label>
                    <input type="date" name="tanggal"
                        value="{{ old('tanggal', $jurnal->tanggal->format('Y-m-d')) }}"
                        max="{{ today()->format('Y-m-d') }}" required
                        style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid {{ $errors->has('tanggal') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;transition:border-color .2s">
                    @error('tanggal')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                {{-- Jam --}}
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">Jam Masuk</label>
                        <input type="time" name="jam_masuk"
                            value="{{ old('jam_masuk', substr($jurnal->jam_masuk ?? '', 0, 5)) }}"
                            style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none">
                    </div>
                    <div>
                        <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">Jam Keluar</label>
                        <input type="time" name="jam_keluar"
                            value="{{ old('jam_keluar', substr($jurnal->jam_keluar ?? '', 0, 5)) }}"
                            style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none">
                    </div>
                </div>
            </div>

            {{-- Kegiatan --}}
            <div style="margin-bottom:16px">
                <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                    Uraian Kegiatan <span style="color:#ef4444">*</span>
                </label>
                <textarea name="kegiatan" rows="6" required
                    style="width:100%;padding:10px 12px;border-radius:10px;border:1px solid {{ $errors->has('kegiatan') ? '#ef4444' : 'var(--border)' }};background:var(--card-bg);color:var(--text);font-size:.82rem;font-family:var(--font);outline:none;resize:vertical">{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
                @error('kegiatan')<div style="font-size:.72rem;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            {{-- Foto --}}
            <div style="margin-bottom:20px">
                <label style="display:block;font-size:.78rem;font-weight:600;color:var(--text);margin-bottom:6px">
                    Foto Kegiatan <span style="font-weight:400;color:var(--text-sub)">(biarkan kosong jika tidak diganti)</span>
                </label>
                @if($jurnal->foto_kegiatan)
                <div style="margin-bottom:10px;display:flex;align-items:center;gap:12px;padding:10px 12px;background:var(--tag-bg);border:1px solid var(--border);border-radius:10px">
                    <img src="{{ asset('storage/'.$jurnal->foto_kegiatan) }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px;border:1px solid var(--border)">
                    <div>
                        <div style="font-size:.78rem;font-weight:600;color:var(--text)">Foto saat ini</div>
                        <div style="font-size:.7rem;color:var(--text-sub);margin-top:2px">Upload baru untuk mengganti</div>
                    </div>
                </div>
                @endif
                <input type="file" name="foto_kegiatan" accept="image/jpeg,image/png,image/webp"
                    style="width:100%;padding:9px 12px;border-radius:10px;border:1px solid var(--border);background:var(--card-bg);color:var(--text-muted);font-size:.82rem;font-family:var(--font);cursor:pointer">
                <div style="font-size:.72rem;color:var(--text-sub);margin-top:5px">Format JPG/PNG/WEBP, maksimal 2MB</div>
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid var(--border)">
                <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection