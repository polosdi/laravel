@extends('layouts.siswa')

@section('title', 'Profil')
@section('page_title', 'Profil Saya')
@section('nav_profil', 'active')

@section('styles')
<style>
    .form-field { margin-bottom: 14px; }
    .form-label { display:block;font-size:.7rem;font-weight:700;color:var(--text-muted);letter-spacing:.06em;text-transform:uppercase;margin-bottom:6px;transition:color .4s; }
    .form-input {
        width:100%; padding:10px 14px;
        background:var(--input-bg); border:1px solid var(--input-border);
        border-radius:10px; color:var(--text);
        font-family:var(--font); font-size:.85rem; font-weight:500;
        outline:none; transition:all .22s;
    }
    .form-input:focus { border-color:rgba(102,126,234,.6); box-shadow:0 0 0 3px rgba(102,126,234,.12); }
    .form-input:disabled { opacity:.6; cursor:not-allowed; }
    [data-theme="light"] .form-input { background:white; }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
</style>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Profil Saya</div>
        <div class="page-sub">Data diri dan informasi akun SIMPKL kamu</div>
    </div>
    <div class="page-actions">
        <button class="btn-secondary" onclick="toggleEdit()" id="editBtn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Edit Profil
        </button>
    </div>
</div>

<div class="grid-2">

    <!-- Data Diri -->
    <div style="display:flex;flex-direction:column;gap:20px">
        <div class="card">
            <!-- Avatar -->
            <div style="display:flex;align-items:center;gap:16px;margin-bottom:22px;padding-bottom:18px;border-bottom:1px solid var(--border)">
                <div style="width:64px;height:64px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:1.4rem;font-weight:800;color:white;flex-shrink:0">
                    {{ strtoupper(substr(auth()->user()->nama_lengkap ?? 'S', 0, 2)) }}
                </div>
                <div>
                    <div style="font-size:1rem;font-weight:800;color:var(--text);transition:color .4s">{{ auth()->user()->nama_lengkap ?? 'Andi Nugraha' }}</div>
                    <div style="font-size:.78rem;color:var(--text-muted);transition:color .4s">{{ auth()->user()->kelas ?? 'XI' }} {{ auth()->user()->jurusan ?? 'TKJ' }} · Siswa PKL</div>
                    <span class="badge approved" style="margin-top:4px">PKL Aktif</span>
                </div>
            </div>

            <form method="POST" action="{{ route('siswa.profil.update') }}" id="profilForm">
                @csrf
                @method('PATCH')

                @if(session('success'))
                <div style="padding:10px 14px;border-radius:10px;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:#22c55e;font-size:.8rem;font-weight:600;margin-bottom:16px">
                    ✅ {{ session('success') }}
                </div>
                @endif

                <div class="card-header" style="margin-bottom:14px">
                    <div class="card-title-sm">Data Diri</div>
                </div>

                <div class="form-field">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-input" id="f_nama"
                        value="{{ auth()->user()->nama_lengkap ?? 'Andi Nugraha' }}" disabled>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="form-label">NIS</label>
                        <input type="text" name="nis" class="form-input" id="f_nis"
                            value="{{ auth()->user()->nis ?? '2223001234' }}" disabled>
                    </div>
                    <div class="form-field">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-input"
                            value="{{ auth()->user()->username ?? 'andi.nugraha' }}" disabled>
                        <span style="font-size:.65rem;color:var(--text-sub)">Tidak bisa diubah</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="form-label">Kelas</label>
                        <select name="kelas" class="form-input" id="f_kelas" disabled>
                            <option value="XI" {{ (auth()->user()->kelas ?? 'XI') === 'XI' ? 'selected' : '' }}>XI</option>
                            <option value="XII" {{ (auth()->user()->kelas ?? '') === 'XII' ? 'selected' : '' }}>XII</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label class="form-label">Jurusan</label>
                        <select name="jurusan" class="form-input" id="f_jurusan" disabled>
                            @foreach(['TKJ','RPL','AKL','OTKP'] as $j)
                            <option value="{{ $j }}" {{ (auth()->user()->jurusan ?? 'TKJ') === $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-input" id="f_tempat"
                            value="{{ auth()->user()->tempat_lahir ?? 'Bandung' }}" disabled>
                    </div>
                    <div class="form-field">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-input" id="f_tgl"
                            value="{{ auth()->user()->tanggal_lahir ?? '2007-01-15' }}" disabled>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-input" style="resize:none;height:70px" id="f_alamat" disabled>{{ auth()->user()->alamat ?? 'Jl. Merdeka No.10, Bandung' }}</textarea>
                </div>

                <div id="saveBtn" style="display:none;gap:10px;margin-top:4px">
                    <button type="button" class="btn-secondary" onclick="cancelEdit()" style="flex:1">Batal</button>
                    <button type="submit" class="btn-primary" style="flex:2">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Right -->
    <div style="display:flex;flex-direction:column;gap:20px">

        <!-- Ganti Password -->
        <div class="card">
            <div class="card-header"><div class="card-title-sm">Ganti Kata Sandi</div></div>
            <form method="POST" action="{{ route('siswa.profil.password') }}">
                @csrf
                @method('PATCH')

                @if($errors->has('current_password'))
                <div style="padding:10px 14px;border-radius:10px;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#ef4444;font-size:.8rem;font-weight:600;margin-bottom:14px">
                    ⚠️ {{ $errors->first('current_password') }}
                </div>
                @endif

                <div class="form-field">
                    <label class="form-label">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" class="form-input" placeholder="••••••••" required>
                </div>
                <div class="form-field">
                    <label class="form-label">Kata Sandi Baru</label>
                    <input type="password" name="password" class="form-input" placeholder="Min. 8 karakter" required>
                </div>
                <div class="form-field">
                    <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi baru" required>
                </div>
                <button type="submit" class="btn-primary" style="width:100%">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Ganti Kata Sandi
                </button>
            </form>
        </div>

        <!-- Info PKL -->
        <div class="card">
            <div class="card-header"><div class="card-title-sm">Info PKL</div></div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
                <div><div class="info-label">Tempat PKL</div><div class="info-value">PT. Teknologi Nusantara</div></div>
            </div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                <div><div class="info-label">Periode</div><div class="info-value">2 Mar – 30 Jun 2026</div></div>
            </div>
            <div class="info-item">
                <div class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/></svg></div>
                <div><div class="info-label">Guru Pembimbing</div><div class="info-value">Sari Rahayu, S.Pd.</div></div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
const editableFields = ['f_nama','f_nis','f_kelas','f_jurusan','f_tempat','f_tgl','f_alamat'];
let editing = false;

function toggleEdit() {
    editing = true;
    editableFields.forEach(id => {
        const el = document.getElementById(id);
        if (el && id !== 'f_nis') el.disabled = false;
    });
    document.getElementById('saveBtn').style.display = 'flex';
    document.getElementById('editBtn').style.display = 'none';
}

function cancelEdit() {
    editing = false;
    editableFields.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.disabled = true;
    });
    document.getElementById('saveBtn').style.display = 'none';
    document.getElementById('editBtn').style.display = 'flex';
}
@endsection
