@extends('layouts.app')
@section('title','Laporan PKL')
@section('page-title','Laporan PKL')
@section('page-sub','Upload dan kelola laporan PKL kamu')

@section('content')

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px">
    @foreach([['📄',$total,'Total'],['✅',$disetujui,'Disetujui'],['⏳',$pending,'Menunggu'],['🔄',$revisi,'Perlu Revisi']] as [$icon,$num,$label])
    <div style="background:var(--surface);border-radius:var(--r-xl);padding:18px 20px;border:1px solid var(--border);box-shadow:var(--shadow-sm)">
        <div style="font-size:1.5rem;margin-bottom:8px">{{ $icon }}</div>
        <div style="font-family:'Syne',sans-serif;font-size:1.7rem;font-weight:800;color:var(--text);line-height:1">{{ $num }}</div>
        <div style="font-size:var(--fs-xs);color:var(--text-muted);margin-top:4px">{{ $label }}</div>
    </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Daftar Laporan</div>
        <a href="{{ route('siswa.laporan.create') }}" class="btn-primary">+ Tambah Laporan</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>#</th><th>Judul</th><th>Jenis</th><th>Status Pembimbing</th><th>Status Wakasek</th><th>Tanggal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($laporans as $i => $lap)
                <tr>
                    <td style="color:var(--text-muted)">{{ $laporans->firstItem() + $i }}</td>
                    <td>
                        <div style="font-weight:600;font-size:var(--fs-sm)">{{ $lap->judul() }}</div>
                        @if($lap->catatan_revisi)
                        <div style="font-size:var(--fs-xs);color:#ea580c;margin-top:2px">📝 {{ Str::limit($lap->catatan_revisi,60) }}</div>
                        @endif
                    </td>
                    <td><span class="badge" style="background:rgba(102,126,234,.1);color:var(--primary)">{{ ucfirst($lap->jenis_laporan) }}</span></td>
                    <td><span class="badge badge-{{ $lap->status_pembimbing }}">{{ ucfirst($lap->status_pembimbing) }}</span></td>
                    <td><span class="badge badge-{{ $lap->status_wakasek }}">{{ ucfirst($lap->status_wakasek) }}</span></td>
                    <td style="font-size:var(--fs-xs);color:var(--text-muted)">{{ $lap->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            @if($lap->file_path)
                            <a href="{{ $lap->fileUrl() }}" class="btn-secondary" style="padding:5px 12px;font-size:var(--fs-xs)" target="_blank">⬇ Unduh</a>
                            @endif
                            <a href="{{ route('siswa.laporan.show',$lap->id) }}" class="btn-secondary" style="padding:5px 12px;font-size:var(--fs-xs)">{{ $lap->file_path ? '🔄 Ganti' : '⬆ Upload' }}</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:32px;color:var(--text-muted)">
                    <div style="font-size:2rem;margin-bottom:8px">📄</div>
                    Belum ada laporan. <a href="{{ route('siswa.laporan.create') }}" style="color:var(--primary);font-weight:600">Buat sekarang</a>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($laporans->hasPages())
    <div style="padding:16px 20px">{{ $laporans->links() }}</div>
    @endif
</div>
@endsection
