@extends('layouts.app')
@section('title','Profil Saya')
@section('page-title','Profil Saya')
@section('page-sub','Kelola data diri dan informasi akun')

@section('content')
<div style="display:grid;grid-template-columns:280px 1fr;gap:20px;align-items:start">

    {{-- Kartu Foto --}}
    <div style="display:flex;flex-direction:column;gap:16px">
        <div class="card">
            <div class="card-body" style="text-align:center;padding:28px 20px">
                <div style="width:90px;height:90px;margin:0 auto 16px;position:relative">
                    @if($siswa?->foto_profil)
                        <img src="{{ asset('storage/'.$siswa->foto_profil) }}"
                            style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid var(--border)">
                    @else
                        <div style="width:90px;height:90px;background:var(--gradient);border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;color:white">
                            {{ $user->inisial() }}
                        </div>
                    @endif
                </div>
                <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:var(--fs-lg)">{{ $user->namaLengkap() }}</div>
                <div style="font-size:var(--fs-xs);color:var(--primary);font-weight:600;margin-top:4px">Siswa PKL</div>
                @if($siswa?->jurusan)
                <div style="font-size:var(--fs-xs);color:var(--text-muted);margin-top:4px">{{ $siswa->jurusan }} · {{ $siswa->kelas }}</div>
                @endif
                <div style="margin-top:16px">
                    <span style="font-size:var(--fs-xs);color:var(--text-muted)">NIS: </span>
                    <span style="font-size:var(--fs-xs);font-weight:700">{{ $siswa?->nis ?? '—' }}</span>
                </div>
            </div>
            <div style="padding:0 16px 16px">
                <form action="{{ route('siswa.profil.foto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="foto_profil" id="foto-input" accept="image/*"
                        style="display:none" onchange="this.form.submit()">
                    <button type="button" onclick="document.getElementById('foto-input').click()"
                        class="btn-secondary" style="width:100%;justify-content:center">
                        📷 Ganti Foto
                    </button>
                </form>
            </div>
        </div>

        {{-- Ganti Password --}}
        <div class="card">
            <div class="card-header"><div class="card-title" style="font-size:var(--fs-base)">🔒 Ganti Password</div></div>
            <div class="card-body">
                <form action="{{ route('siswa.profil.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-label" style="font-size:var(--fs-xs)">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control {{ $errors->has('password_lama')?'is-invalid':'' }}" placeholder="••••••••" required>
                        @error('password_lama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" style="font-size:var(--fs-xs)">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" placeholder="Min 8 karakter" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" style="font-size:var(--fs-xs)">Konfirmasi Password</label>
                        <input type="password" name="password_baru_confirmation" class="form-control" placeholder="Ulangi password baru" required>
                    </div>
                    <button type="submit" class="btn-primary" style="width:100%;justify-content:center;margin-top:4px">
                        Simpan Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Form Data Diri --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">📝 Data Diri</div>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.profil.update') }}" method="POST">
                @csrf @method('PUT')

                {{-- Akun --}}
                <div style="font-size:var(--fs-xs);font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:12px">Akun</div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:20px">
                    <div class="form-group">
                        <label class="form-label">Nama Depan <span>*</span></label>
                        <input type="text" name="nama_depan" class="form-control {{ $errors->has('nama_depan')?'is-invalid':'' }}"
                            value="{{ old('nama_depan', $user->nama_depan) }}" required>
                        @error('nama_depan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Belakang <span>*</span></label>
                        <input type="text" name="nama_belakang" class="form-control {{ $errors->has('nama_belakang')?'is-invalid':'' }}"
                            value="{{ old('nama_belakang', $user->nama_belakang) }}" required>
                        @error('nama_belakang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="grid-column:1/-1">
                        <label class="form-label">Email <span>*</span></label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Info Sekolah --}}
                <div style="font-size:var(--fs-xs);font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:12px">Info Sekolah</div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-bottom:20px">
                    <div class="form-group">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" value="{{ $siswa?->nis ?? '—' }}" disabled style="background:var(--bg);color:var(--text-muted)">
                        <div class="form-hint">Diatur oleh admin</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kelas</label>
                        <input type="text" name="kelas" class="form-control"
                            value="{{ old('kelas', $siswa?->kelas) }}" placeholder="XII RPL 1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control"
                            value="{{ old('jurusan', $siswa?->jurusan) }}" placeholder="Rekayasa Perangkat Lunak">
                    </div>
                </div>

                {{-- Data Pribadi --}}
                <div style="font-size:var(--fs-xs);font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:12px">Data Pribadi</div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:20px">
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin',$siswa?->jenis_kelamin)==='Laki-laki'?'selected':'' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin',$siswa?->jenis_kelamin)==='Perempuan'?'selected':'' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Agama</label>
                        <input type="text" name="agama" class="form-control"
                            value="{{ old('agama', $siswa?->agama) }}" placeholder="Islam">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control"
                            value="{{ old('tempat_lahir', $siswa?->tempat_lahir) }}" placeholder="Bandung">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                            value="{{ old('tanggal_lahir', $siswa?->tanggal_lahir?->format('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" class="form-control"
                            value="{{ old('no_hp', $siswa?->no_hp) }}" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Golongan Darah</label>
                        <select name="golongan_darah" class="form-control">
                            <option value="">-- Pilih --</option>
                            @foreach(['A','B','AB','O'] as $gd)
                            <option value="{{ $gd }}" {{ old('golongan_darah',$siswa?->golongan_darah)===$gd?'selected':'' }}>{{ $gd }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="grid-column:1/-1">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="form-control"
                            placeholder="Jl. Contoh No. 1, Kelurahan...">{{ old('alamat', $siswa?->alamat) }}</textarea>
                    </div>
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end">
                    <button type="reset" class="btn-secondary">Reset</button>
                    <button type="submit" class="btn-primary">💾 Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<style>
@media(max-width:900px){
    .main > div[style*="grid-template-columns:280px"]{grid-template-columns:1fr!important}
}
</style>
@endpush
@endsection
