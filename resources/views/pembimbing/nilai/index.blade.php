{{-- pembimbing/nilai/index.blade.php --}}
@extends('layouts.pembimbing')
@section('title','Input Nilai PKL')

@section('content')
<div class="pg-head">
    <div>
        <div class="breadcrumb"><a href="{{ route('pembimbing.dashboard') }}">Dashboard</a><span>/</span> Nilai</div>
        <h2>⭐ Input Nilai PKL Siswa</h2>
    </div>
</div>

<div class="card">
    <div class="tbl-wrap">
        <table>
            <thead>
                <tr><th>Siswa</th><th>Kelas</th><th>Perusahaan PKL</th><th>Sikap</th><th>Keterampilan</th><th>Laporan</th><th>Nilai Akhir</th><th>Predikat</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($daftarSiswa as $siswa)
            @php $nilai = $siswa->nilaiPkl; $pkl = $siswa->pklAnggota->first()?->pengajuan; @endphp
            <tr>
                <td>
                    <div style="font-weight:600">{{ $siswa->nama_depan }} {{ $siswa->nama_belakang }}</div>
                    <div style="font-size:.7rem;color:var(--text-muted)">{{ $siswa->profilSiswa->nis ?? '' }}</div>
                </td>
                <td>{{ $siswa->profilSiswa->kelas ?? '—' }}</td>
                <td style="font-size:.78rem">{{ $pkl?->nama_perusahaan ?? '—' }}</td>
                <td>{{-- $nilai?->nilai_sikap ?? '—' --}}</td>
                <td>{{-- $nilai?->nilai_keterampilan ?? '—' --}}</td>
                <td>{{-- $nilai?->nilai_laporan ?? '—' --}}</td>
                <td style="font-weight:700">{{-- $nilai ? number_format($nilai->nilai_akhir,2) : '—' --}}</td>
                <td>
                    @if($nilai)
                        <span class="bdg {{-- match($nilai->predikat){ 'A'=>'bdg-ok','B'=>'bdg-info','C'=>'bdg-warn',default=>'bdg-err' } --}}">
                            {{-- $nilai->predikat --}}
                        </span>
                    @else <span class="bdg bdg-gray">Belum</span> @endif
                </td>
                <td>
                    <a href="{{-- route('pembimbing.nilai.form', $siswa->id) --}}" class="btn btn-xs btn-pr">
                        {{-- $nilai ? '✏️ Edit' : '+ Input' --}}
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="9"><div class="empty"><div class="empty-ic">⭐</div><p>Belum ada siswa bimbingan.</p></div></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
