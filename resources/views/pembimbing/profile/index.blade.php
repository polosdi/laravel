@extends('layouts.pembimbing')
@section('title','Profil Saya')
@section('nav_profil','active')

@section('content')
<style>
/* ── PROFIL GRID ── */
.profil-grid {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 20px;
    align-items: start;
}

/* ── HERO BANNER ── */
.profil-hero {
    grid-column: 1 / -1;
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px 28px;
    display: flex;
    align-items: center;
    gap: 24px;
    position: relative;
    overflow: hidden;
}
.profil-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--grad);
}
.profil-hero-avatar-wrap {
    position: relative;
    flex-shrink: 0;
}
.profil-hero-img {
    width: 80px; height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--border);
    display: block;
}
.profil-hero-initials {
    width: 80px; height: 80px;
    background: var(--grad);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 1.5rem; color: white;
    flex-shrink: 0;
}
.profil-hero-upload-btn {
    position: absolute;
    bottom: -2px; right: -2px;
    width: 26px; height: 26px;
    background: var(--grad);
    border: 2px solid var(--card-bg);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    font-size: .65rem;
    transition: transform .2s;
}
.profil-hero-upload-btn:hover { transform: scale(1.1); }

.profil-hero-info { flex: 1; min-width: 0; }
.profil-hero-name {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--text);
    line-height: 1.2;
}
.profil-hero-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 6px;
    flex-wrap: wrap;
}
.profil-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: .68rem;
    font-weight: 700;
    background: rgba(102,126,234,.1);
    color: var(--primary);
}
.profil-hero-sep { color: var(--border); font-size: .8rem; }
.profil-hero-sub { font-size: .75rem; color: var(--text-muted); }
.profil-hero-nip {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: .72rem;
}
.profil-hero-nip-label { color: var(--text-muted); }
.profil-hero-nip-val {
    font-weight: 700;
    color: var(--text);
    font-family: monospace;
    font-size: .8rem;
}

/* ── SECTION DIVIDER ── */
.form-section-label {
    font-size: .65rem;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 12px;
    padding-bottom: 6px;
    border-bottom: 1px solid var(--border);
}

/* ── FORM GRID VARIANTS ── */
.form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 22px; }
.form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 22px; }
.col-full { grid-column: 1 / -1; }

/* ── FORM CONTROLS ── */
.form-group { display: flex; flex-direction: column; gap: 5px; }
.form-label { font-size: .75rem; font-weight: 600; color: var(--text-muted); }
.form-label span { color: var(--primary); }
.form-control {
    padding: 9px 12px;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: var(--bg);
    color: var(--text);
    font-size: .82rem;
    font-family: var(--font);
    transition: border-color .18s, box-shadow .18s;
    outline: none;
    width: 100%;
}
.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(102,126,234,.12);
}
.form-control:disabled {
    background: var(--sb-bg);
    color: var(--text-muted);
    cursor: not-allowed;
}
.form-control.is-invalid { border-color: #ef4444; }
.invalid-feedback { font-size: .7rem; color: #ef4444; margin-top: 2px; }
.form-hint { font-size: .68rem; color: var(--text-muted); margin-top: 2px; }

select.form-control { cursor: pointer; }
textarea.form-control { resize: vertical; }

/* ── CARD ── */
.pcard {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
}
.pcard-header {
    padding: 14px 20px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 8px;
    font-size: .82rem; font-weight: 700; color: var(--text);
}
.pcard-body { padding: 20px; }

/* ── FOOTER ACTIONS ── */
.form-footer {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    padding-top: 6px;
    border-top: 1px solid var(--border);
    margin-top: 4px;
}

/* ── BUTTONS ── */
.btn-primary {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 18px;
    background: var(--grad);
    color: white; border: none; border-radius: 10px;
    font-size: .8rem; font-weight: 600; font-family: var(--font);
    cursor: pointer; transition: opacity .2s, transform .2s;
}
.btn-primary:hover { opacity: .88; transform: translateY(-1px); }

.btn-secondary {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 18px;
    background: transparent;
    color: var(--text-muted);
    border: 1.5px solid var(--border);
    border-radius: 10px;
    font-size: .8rem; font-weight: 600; font-family: var(--font);
    cursor: pointer; transition: all .2s;
}
.btn-secondary:hover { border-color: var(--primary); color: var(--primary); }

/* ── PAGE HEADER ── */
.page-header { margin-bottom: 20px; }
.page-title { font-size: 1.25rem; font-weight: 800; color: var(--text); }
.page-sub { font-size: .78rem; color: var(--text-muted); margin-top: 3px; }

@media (max-width: 960px) {
    .profil-grid { grid-template-columns: 1fr; }
    .form-grid-3 { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
    .profil-hero { flex-direction: column; text-align: center; }
    .profil-hero-meta { justify-content: center; }
    .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
}
</style>

<div class="page-header">
    <div class="page-title">Profil Saya</div>
    <div class="page-sub">Kelola informasi akun dan data diri Anda</div>
</div>

@if(session('success'))
    <div class="al al-ok" style="margin-bottom:16px"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="al al-err" style="margin-bottom:16px"><i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}</div>
@endif

<div class="profil-grid">

    {{-- ── HERO BANNER ── --}}
    <div class="profil-hero">
        <div class="profil-hero-avatar-wrap">
            @php $profil = auth()->user()->profilPembimbing; @endphp
            @if($profil?->foto_profil)
                <img src="{{ asset('storage/'.$profil->foto_profil) }}" alt="foto" class="profil-hero-img">
            @else
                <div class="profil-hero-initials">
                    {{ strtoupper(substr(auth()->user()->nama_depan,0,1).substr(auth()->user()->nama_belakang,0,1)) }}
                </div>
            @endif
            <form action="{{ route('pembimbing.profil.foto') }}" method="POST" enctype="multipart/form-data" id="fotoForm">
                @csrf @method('PUT')
                <label for="fotoInput" class="profil-hero-upload-btn" title="Ganti foto">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:12px;height:12px"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </label>
                <input type="file" id="fotoInput" name="foto_profil" accept="image/*"
                       style="display:none" onchange="document.getElementById('fotoForm').submit()">
            </form>
        </div>

        <div class="profil-hero-info">
            <div class="profil-hero-name">{{ auth()->user()->nama_depan }} {{ auth()->user()->nama_belakang }}</div>
            <div class="profil-hero-meta">
                <span class="profil-hero-badge">Guru Pembimbing</span>
                @if($profil?->mata_pelajaran)
                    <span class="profil-hero-sep">·</span>
                    <span class="profil-hero-sub">{{ $profil->mata_pelajaran }}</span>
                @endif
            </div>
            <div class="profil-hero-nip">
                <span class="profil-hero-nip-label">NIP</span>
                <span class="profil-hero-nip-val">{{ $profil?->nip ?? '—' }}</span>
            </div>
        </div>
    </div>

    {{-- ── KOLOM KIRI: Ganti Password ── --}}
    <div>
        <div class="pcard">
            <div class="pcard-header">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px;flex-shrink:0"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Ganti Password
            </div>
            <div class="pcard-body">
                <form action="{{ route('pembimbing.profil.password') }}" method="POST">
                    @csrf @method('PUT')

                    <div class="form-group" style="margin-bottom:12px">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="password_lama"
                               class="form-control {{ $errors->has('password_lama') ? 'is-invalid' : '' }}"
                               placeholder="••••••••" required>
                        @error('password_lama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:12px">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password_baru"
                               class="form-control" placeholder="Min 8 karakter" required>
                    </div>

                    <div class="form-group" style="margin-bottom:16px">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_baru_confirmation"
                               class="form-control" placeholder="Ulangi password baru" required>
                    </div>

                    <button type="submit" class="btn-primary" style="width:100%;justify-content:center">
                        Simpan Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ── KOLOM KANAN: Form Data Diri ── --}}
    <div class="pcard">
        <div class="pcard-header">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px;flex-shrink:0"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Data Diri
        </div>
        <div class="pcard-body">
            <form action="{{ route('pembimbing.profil.update') }}" method="POST">
                @csrf @method('PUT')

                {{-- AKUN --}}
                <div class="form-section-label">Akun</div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Depan <span>*</span></label>
                        <input type="text" name="nama_depan"
                               class="form-control {{ $errors->has('nama_depan') ? 'is-invalid' : '' }}"
                               value="{{ old('nama_depan', auth()->user()->nama_depan) }}" required>
                        @error('nama_depan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Belakang <span>*</span></label>
                        <input type="text" name="nama_belakang"
                               class="form-control {{ $errors->has('nama_belakang') ? 'is-invalid' : '' }}"
                               value="{{ old('nama_belakang', auth()->user()->nama_belakang) }}" required>
                        @error('nama_belakang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group col-full">
                        <label class="form-label">Email <span>*</span></label>
                        <input type="email" name="email"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- INFO MENGAJAR --}}
                <div class="form-section-label">Info Mengajar</div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control"
                               value="{{ $profil?->nip ?? '—' }}" disabled>
                        <div class="form-hint">Diatur oleh admin</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mata Pelajaran</label>
                        <input type="text" name="mata_pelajaran" class="form-control"
                               value="{{ old('mata_pelajaran', $profil?->mata_pelajaran) }}"
                               placeholder="Pemrograman Web">
                    </div>
                </div>

                {{-- DATA PRIBADI --}}
                <div class="form-section-label">Data Pribadi</div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $profil?->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $profil?->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" class="form-control"
                               value="{{ old('no_hp', $profil?->no_hp) }}" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control"
                               value="{{ old('tempat_lahir', $profil?->tempat_lahir) }}" placeholder="Bandung">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                               value="{{ old('tanggal_lahir', $profil?->tanggal_lahir?->format('Y-m-d')) }}">
                    </div>
                    <div class="form-group col-full">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="form-control"
                                  placeholder="Jl. Contoh No. 1, Kelurahan...">{{ old('alamat', $profil?->alamat) }}</textarea>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="reset" class="btn-secondary">Reset</button>
                    <button type="submit" class="btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Profil
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
