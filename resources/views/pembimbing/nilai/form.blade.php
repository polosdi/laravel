@extends('layouts.pembimbing')
@section('title','Input Nilai — '.$siswa->nama_depan)

@section('content')
<div class="pg-head">
    <div>
        <div class="breadcrumb"><a href="{{ route('pembimbing.nilai.index') }}">Nilai</a><span>/</span> Input</div>
        <h2>⭐ Input Nilai — {{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</h2>
    </div>
    <a href="{{ route('pembimbing.nilai.index') }}" class="btn btn-out btn-sm">← Kembali</a>
</div>

<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:20px;max-width:900px">

    {{-- Info Siswa --}}
    <div class="card" style="align-self:start">
        <div class="card-head"><div class="card-title">👤 Profil Siswa</div></div>
        <div class="card-body">
            <div style="text-align:center;margin-bottom:18px">
                <div style="width:64px;height:64px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-weight:700;color:#fff;margin:0 auto 10px">
                    {{ strtoupper(substr($siswa->nama_depan,0,1).substr($siswa->nama_belakang,0,1)) }}
                </div>
                <div style="font-weight:700;font-size:.95rem">{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</div>
                <div style="font-size:.78rem;color:var(--text-muted);margin-top:3px">
                    {{ $siswa->profilSiswa->kelas ?? '—' }} · {{ $siswa->profilSiswa->jurusan ?? '—' }}
                </div>
            </div>
            @foreach([
                ['NIS',$siswa->profilSiswa->nis ?? '—'],
                ['Perusahaan',$siswa->pklAnggota->first()?->pengajuan?->nama_perusahaan ?? '—'],
                ['Total Jurnal',\App\Models\JurnalHarian::where('siswa_id',$siswa->id)->count()],
                ['Jurnal Valid',\App\Models\JurnalHarian::where('siswa_id',$siswa->id)->where('status_validasi','valid')->count()],
            ] as [$lbl,$val])
            <div style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid var(--border);font-size:.8rem">
                <span style="color:var(--text-muted);font-weight:500">{{ $lbl }}</span>
                <span style="font-weight:700">{{ $val }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Form Nilai --}}
    <div class="card">
        <div class="card-head"><div class="card-title">📊 Form Penilaian</div></div>
        <div class="card-body">
            <form method="POST" action="{{ route('pembimbing.nilai.simpan', $siswa->id) }}">
                @csrf
                <div class="form-grid">

                    <div style="background:rgba(102,126,234,.06);border-radius:10px;padding:13px;font-size:.78rem;color:var(--text-muted)">
                        <strong style="color:var(--text)">📌 Bobot Penilaian:</strong><br>
                        Sikap 30% + Keterampilan 40% + Laporan 30% = Nilai Akhir
                    </div>

                    <div class="fgrp">
                        <label>Nilai Sikap (0–100) <span style="color:var(--text-muted);font-weight:400">— Bobot 30%</span></label>
                        <input type="number" name="nilai_sikap" min="0" max="100"
                               value="{{ old('nilai_sikap', $nilai?->nilai_sikap) }}"
                               placeholder="0 - 100" oninput="hitungNilai()">
                        @error('nilai_sikap')<div class="err">{{ $message }}</div>@enderror
                    </div>

                    <div class="fgrp">
                        <label>Nilai Keterampilan (0–100) <span style="color:var(--text-muted);font-weight:400">— Bobot 40%</span></label>
                        <input type="number" name="nilai_keterampilan" min="0" max="100"
                               value="{{ old('nilai_keterampilan', $nilai?->nilai_keterampilan) }}"
                               placeholder="0 - 100" oninput="hitungNilai()">
                        @error('nilai_keterampilan')<div class="err">{{ $message }}</div>@enderror
                    </div>

                    <div class="fgrp">
                        <label>Nilai Laporan (0–100) <span style="color:var(--text-muted);font-weight:400">— Bobot 30%</span></label>
                        <input type="number" name="nilai_laporan" min="0" max="100"
                               value="{{ old('nilai_laporan', $nilai?->nilai_laporan) }}"
                               placeholder="0 - 100" oninput="hitungNilai()">
                        @error('nilai_laporan')<div class="err">{{ $message }}</div>@enderror
                    </div>

                    {{-- Preview Nilai Akhir --}}
                    <div id="preview" style="background:var(--grad);border-radius:12px;padding:16px;text-align:center;display:none">
                        <div style="font-size:.72rem;color:rgba(255,255,255,.8);font-weight:600;text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px">Estimasi Nilai Akhir</div>
                        <div id="preview-num" style="font-size:2.5rem;font-weight:800;color:#fff;line-height:1;letter-spacing:-.03em"></div>
                        <div id="preview-grade" style="margin-top:8px;font-size:.875rem;font-weight:700;color:rgba(255,255,255,.9)"></div>
                    </div>

                    <div class="fgrp">
                        <label>Catatan <span style="color:var(--text-muted);font-weight:400">(opsional)</span></label>
                        <textarea name="catatan" rows="3"
                            placeholder="Catatan tambahan untuk siswa...">{{ old('catatan', $nilai?->catatan) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-pr" style="justify-content:center">
                        💾 Simpan Nilai
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function hitungNilai(){
    const s=parseFloat(document.querySelector('[name=nilai_sikap]').value)||0;
    const k=parseFloat(document.querySelector('[name=nilai_keterampilan]').value)||0;
    const l=parseFloat(document.querySelector('[name=nilai_laporan]').value)||0;
    if(!s && !k && !l){ document.getElementById('preview').style.display='none'; return; }
    const akhir=((s*0.3)+(k*0.4)+(l*0.3)).toFixed(2);
    const grade=akhir>=90?'A':akhir>=80?'B':akhir>=70?'C':akhir>=60?'D':'E';
    document.getElementById('preview-num').textContent=akhir;
    document.getElementById('preview-grade').textContent='Predikat: '+grade;
    document.getElementById('preview').style.display='block';
}
</script>
@endpush
