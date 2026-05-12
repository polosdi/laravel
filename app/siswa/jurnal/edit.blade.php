@extends('layouts.app')
@section('title','Edit Jurnal Harian')
@section('page-title','Edit Jurnal')
@section('page-sub','Perbarui catatan kegiatan PKL')

@section('content')
<div style="max-width:680px">
    <div class="card">
        <div class="card-header">
            <div class="card-title">✏️ Edit Jurnal — {{ $jurnal->tanggal->translatedFormat('d F Y') }}</div>
            <a href="{{ route('siswa.jurnal') }}" class="btn-secondary" style="padding:7px 14px;font-size:var(--fs-xs)">← Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.jurnal.update', $jurnal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div class="form-group">
                        <label class="form-label">Tanggal <span>*</span></label>
                        <input type="date" name="tanggal" class="form-control {{ $errors->has('tanggal')?'is-invalid':'' }}"
                            value="{{ old('tanggal', $jurnal->tanggal->format('Y-m-d')) }}"
                            max="{{ today()->format('Y-m-d') }}" required>
                        @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group" style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
                        <div>
                            <label class="form-label">Jam Masuk</label>
                            <input type="time" name="jam_masuk" class="form-control"
                                value="{{ old('jam_masuk', substr($jurnal->jam_masuk ?? '', 0, 5)) }}">
                        </div>
                        <div>
                            <label class="form-label">Jam Keluar</label>
                            <input type="time" name="jam_keluar" class="form-control"
                                value="{{ old('jam_keluar', substr($jurnal->jam_keluar ?? '', 0, 5)) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Uraian Kegiatan <span>*</span></label>
                    <textarea name="kegiatan" class="form-control {{ $errors->has('kegiatan')?'is-invalid':'' }}"
                        rows="6" required>{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
                    @error('kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Kegiatan <span style="color:var(--text-muted);font-weight:400">(biarkan kosong jika tidak diganti)</span></label>
                    @if($jurnal->foto_kegiatan)
                    <div style="margin-bottom:8px">
                        <img src="{{ asset('storage/'.$jurnal->foto_kegiatan) }}" style="max-width:160px;border-radius:var(--r-md);border:1px solid var(--border)">
                        <div style="font-size:var(--fs-xs);color:var(--text-muted);margin-top:4px">Foto saat ini</div>
                    </div>
                    @endif
                    <input type="file" name="foto_kegiatan" accept="image/jpeg,image/png,image/webp" class="form-control">
                    <div class="form-hint">Format JPG/PNG/WEBP, maksimal 2MB</div>
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:8px">
                    <a href="{{ route('siswa.jurnal') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
