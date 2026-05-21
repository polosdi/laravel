@extends('layouts.pembimbing')
@section('title','Tinjau Laporan')

@section('content')
<div class="pg-head">
    <div>
        <div class="breadcrumb"><a href="{{ route('pembimbing.laporan.index') }}">Laporan</a><span>/</span> Tinjau</div>
        <h2>📄 Tinjau Laporan PKL</h2>
    </div>
    <a href="{{ route('pembimbing.laporan.index') }}" class="btn btn-out btn-sm">← Kembali</a>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;max-width:960px">

    <div class="card">
        <div class="card-head"><div class="card-title">📄 Detail Laporan</div></div>
        <div class="card-body">
            @foreach([
                ['Judul',$laporan->judul_laporan],
                ['Jenis',ucfirst($laporan->jenis_laporan)],
                ['Siswa',$laporan->siswa->nama_depan.' '.$laporan->siswa->nama_belakang],
                ['Kelas',$laporan->siswa->profilSiswa->kelas ?? '—'],
                ['Dikirim',\Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d F Y')],
            ] as [$lbl,$val])
            <div style="display:flex;padding:10px 0;border-bottom:1px solid var(--border)">
                <div style="width:110px;font-size:.78rem;font-weight:700;color:var(--text-muted);flex-shrink:0">{{ $lbl }}</div>
                <div style="font-size:.825rem;font-weight:500">{{ $val }}</div>
            </div>
            @endforeach

            @if($laporan->file_path)
            <div style="margin-top:16px">
                <a href="{{ Storage::url($laporan->file_path) }}" target="_blank"
                   class="btn btn-pr" style="width:100%;justify-content:center">
                    📎 Buka File PDF
                </a>
            </div>
            @endif

            @if($laporan->catatan_revisi)
            <div style="margin-top:14px;background:rgba(239,68,68,.06);border-radius:10px;padding:13px;border-left:3px solid #ef4444">
                <div style="font-size:.72rem;font-weight:700;color:#dc2626;margin-bottom:4px">Catatan Revisi Sebelumnya</div>
                <div style="font-size:.825rem">{{ $laporan->catatan_revisi }}</div>
            </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-head"><div class="card-title">⚡ Keputusan Pembimbing</div></div>
        <div class="card-body">
            <div style="margin-bottom:16px">
                <div style="font-size:.72rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px">Status Saat Ini</div>
                @if($laporan->status_pembimbing==='disetujui') <span class="bdg bdg-ok" style="font-size:.78rem">✅ Sudah Disetujui</span>
                @elseif($laporan->status_pembimbing==='revisi') <span class="bdg bdg-err" style="font-size:.78rem">❌ Perlu Revisi</span>
                @else <span class="bdg bdg-warn" style="font-size:.78rem">⏳ Menunggu Tinjauan</span> @endif
            </div>

            <form method="POST" action="{{ route('pembimbing.laporan.review', $laporan->id) }}">
                @csrf
                <div class="form-grid">
                    <div class="fgrp">
                        <label>Catatan untuk Siswa</label>
                        <textarea name="catatan_revisi" rows="5"
                            placeholder="Tuliskan catatan, saran perbaikan, atau komentar...">{{ old('catatan_revisi', $laporan->catatan_revisi) }}</textarea>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
                        <button type="submit" name="status_pembimbing" value="disetujui"
                                class="btn btn-ok" style="justify-content:center">
                            ✅ Setujui Laporan
                        </button>
                        <button type="submit" name="status_pembimbing" value="revisi"
                                class="btn btn-del" style="justify-content:center">
                            🔄 Minta Revisi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
