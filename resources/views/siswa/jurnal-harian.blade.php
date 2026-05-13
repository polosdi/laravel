@extends('layouts.siswa')

@section('title', 'Jurnal Harian')
@section('page_title', 'Jurnal Harian')
@section('nav_jurnal', 'active')

@section('styles')
<style>
    .jurnal-item {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 14px; border-radius: 12px;
        background: var(--tag-bg); border: 1px solid var(--border);
        margin-bottom: 10px; transition: all .2s;
    }
    .jurnal-item:hover { border-color: rgba(102,126,234,.3); }

    .jurnal-date {
        width: 42px; height: 42px; border-radius: 10px; flex-shrink: 0;
        background: var(--grad);
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        color: white;
    }
    .jurnal-date-day { font-size: .9rem; font-weight: 800; line-height: 1; }
    .jurnal-date-mon { font-size: .5rem; font-weight: 600; opacity: .85; }

    .filter-bar {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 18px; flex-wrap: wrap;
    }

    .filter-btn {
        padding: 6px 14px; border-radius: 20px;
        background: var(--tag-bg); border: 1px solid var(--border);
        color: var(--text-muted); font-family: var(--font);
        font-size: .75rem; font-weight: 600; cursor: pointer;
        transition: all .18s;
    }
    .filter-btn.active, .filter-btn:hover {
        background: rgba(102,126,234,.15);
        border-color: rgba(102,126,234,.4); color: #667eea;
    }

    /* Modal */
    .modal-overlay {
        position: fixed; inset: 0; z-index: 500;
        background: rgba(0,0,0,.5);
        backdrop-filter: blur(4px);
        display: none; align-items: center; justify-content: center;
        padding: 20px;
    }
    .modal-overlay.open { display: flex; }

    .modal {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px; padding: 28px;
        width: 100%; max-width: 520px;
        box-shadow: 0 24px 60px rgba(0,0,0,.25);
        animation: modalIn .3s cubic-bezier(.34,1.3,.64,1);
    }
    @keyframes modalIn { from{opacity:0;transform:scale(.94) translateY(12px)} to{opacity:1;transform:scale(1) translateY(0)} }

    .modal-header { display:flex;align-items:center;justify-content:space-between;margin-bottom:20px; }
    .modal-title { font-size:1rem;font-weight:800;color:var(--text);transition:color .4s; }

    .close-btn {
        width:30px;height:30px;border-radius:8px;background:var(--tag-bg);border:1px solid var(--border);
        display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--text-muted);
        transition:all .2s;
    }
    .close-btn:hover { color:var(--text); }
    .close-btn svg { width:14px;height:14px; }

    .form-field { margin-bottom:14px; }
    .form-label { display:block;font-size:.7rem;font-weight:700;color:var(--text-muted);letter-spacing:.06em;text-transform:uppercase;margin-bottom:6px;transition:color .4s; }

    .form-input {
        width:100%; padding:10px 14px;
        background:var(--input-bg); border:1px solid var(--input-border);
        border-radius:10px; color:var(--text);
        font-family:var(--font); font-size:.85rem; font-weight:500;
        outline:none; transition:all .22s;
    }
    .form-input:focus { border-color:rgba(102,126,234,.6); box-shadow:0 0 0 3px rgba(102,126,234,.12); }
    .form-input::placeholder { color:var(--text-sub); }
    [data-theme="light"] .form-input { background:white; }

    textarea.form-input { resize:vertical; min-height:90px; }
</style>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">Jurnal Harian</div>
        <div class="page-sub">Catat kegiatan PKL kamu setiap hari</div>
    </div>
    <div class="page-actions">
        <button class="btn-primary" onclick="openModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Input Jurnal Hari Ini
        </button>
    </div>
</div>

<!-- Stats row -->
<div class="grid-3" style="margin-bottom:20px">
    <div class="stat-card">
        <div class="stat-card-top"><div class="stat-icon green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="stat-badge up">Total</span></div>
        <div class="stat-num">{{ $jurnals->where('status','approved')->count() ?? 64 }}</div>
        <div class="stat-label">Jurnal disetujui</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top"><div class="stat-icon amber"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div><span class="stat-badge warn">Perlu aksi</span></div>
        <div class="stat-num">{{ $jurnals->where('status','pending')->count() ?? 3 }}</div>
        <div class="stat-label">Menunggu review</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-top"><div class="stat-icon pink"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div><span class="stat-badge down">Perbaiki</span></div>
        <div class="stat-num">{{ $jurnals->where('status','rejected')->count() ?? 0 }}</div>
        <div class="stat-label">Perlu revisi</div>
    </div>
</div>

<!-- Filter -->
<div class="filter-bar">
    <button class="filter-btn active" onclick="filterJurnal('semua', this)">Semua</button>
    <button class="filter-btn" onclick="filterJurnal('approved', this)">Disetujui</button>
    <button class="filter-btn" onclick="filterJurnal('pending', this)">Menunggu</button>
    <button class="filter-btn" onclick="filterJurnal('rejected', this)">Revisi</button>
</div>

<!-- Jurnal List -->
<div class="card">
    <div id="jurnal-list">
        @forelse($jurnals ?? [] as $jurnal)
        <div class="jurnal-item" data-status="{{ $jurnal->status }}">
            <div class="jurnal-date">
                <div class="jurnal-date-day">{{ $jurnal->created_at->format('d') }}</div>
                <div class="jurnal-date-mon">{{ strtoupper($jurnal->created_at->format('M')) }}</div>
            </div>
            <div style="flex:1;min-width:0">
                <div style="font-size:.85rem;font-weight:600;color:var(--text);transition:color .4s">{{ $jurnal->judul }}</div>
                <div style="font-size:.73rem;color:var(--text-muted);margin-top:2px;transition:color .4s">{{ Str::limit($jurnal->kegiatan, 80) }}</div>
                @if($jurnal->catatan_guru)
                <div style="font-size:.7rem;color:#667eea;margin-top:4px;font-style:italic">💬 {{ $jurnal->catatan_guru }}</div>
                @endif
            </div>
            <span class="badge {{ $jurnal->status }}">{{ $jurnal->status === 'approved' ? 'Disetujui' : ($jurnal->status === 'pending' ? 'Menunggu' : 'Revisi') }}</span>
        </div>
        @empty
        {{-- Demo --}}
        @foreach([
            ['12','MEI','Instalasi dan konfigurasi server Linux','Menginstall Ubuntu Server 22.04, konfigurasi SSH dan firewall untuk akses remote','pending',''],
            ['11','MEI','Troubleshooting jaringan LAN','Membantu tim IT memeriksa koneksi antar gedung kantor, ditemukan kabel putus di lantai 3','approved','Jurnal bagus dan detail!'],
            ['10','MEI','Pemasangan kabel UTP Cat6','Crimping dan pemasangan kabel jaringan di lantai 2, total 12 titik selesai dipasang','approved',''],
            ['9','MEI','Konfigurasi VLAN pada switch','Setting VLAN untuk segmentasi jaringan departemen HR, Finance, dan IT','rejected','Tolong tambahkan detail langkah konfigurasi'],
            ['8','MEI','Backup dan restore database','Melakukan backup rutin database server perusahaan menggunakan mysqldump','approved',''],
        ] as $j)
        <div class="jurnal-item" data-status="{{ $j[4] }}">
            <div class="jurnal-date">
                <div class="jurnal-date-day">{{ $j[0] }}</div>
                <div class="jurnal-date-mon">{{ $j[1] }}</div>
            </div>
            <div style="flex:1;min-width:0">
                <div style="font-size:.85rem;font-weight:600;color:var(--text);transition:color .4s">{{ $j[2] }}</div>
                <div style="font-size:.73rem;color:var(--text-muted);margin-top:2px;transition:color .4s">{{ $j[3] }}</div>
                @if($j[5])
                <div style="font-size:.7rem;color:#667eea;margin-top:4px;font-style:italic">💬 {{ $j[5] }}</div>
                @endif
            </div>
            <span class="badge {{ $j[4] }}">{{ $j[4] === 'approved' ? 'Disetujui' : ($j[4] === 'pending' ? 'Menunggu' : 'Revisi') }}</span>
        </div>
        @endforeach
        @endforelse
    </div>
</div>

<!-- Modal Input Jurnal -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">Input Jurnal Harian</div>
            <button class="close-btn" onclick="closeModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <form method="POST" action="{{ route('siswa.jurnal.store') }}">
            @csrf
            <div class="form-field">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-input" value="{{ now()->format('Y-m-d') }}" required>
            </div>
            <div class="form-field">
                <label class="form-label">Judul Kegiatan</label>
                <input type="text" name="judul" class="form-input" placeholder="Contoh: Instalasi server Linux" required>
            </div>
            <div class="form-field">
                <label class="form-label">Deskripsi Kegiatan</label>
                <textarea name="kegiatan" class="form-input" placeholder="Ceritakan detail kegiatan yang kamu lakukan hari ini..." required></textarea>
            </div>
            <div class="form-field">
                <label class="form-label">Kendala (opsional)</label>
                <textarea name="kendala" class="form-input" style="min-height:60px" placeholder="Kendala yang dihadapi, jika ada..."></textarea>
            </div>
            <div style="display:flex;gap:10px;margin-top:4px">
                <button type="button" class="btn-secondary" onclick="closeModal()" style="flex:1">Batal</button>
                <button type="submit" class="btn-primary" style="flex:2">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Kirim Jurnal
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
function openModal() { document.getElementById('modalOverlay').classList.add('open'); }
function closeModal() { document.getElementById('modalOverlay').classList.remove('open'); }
function closeModalOutside(e) { if (e.target === e.currentTarget) closeModal(); }

function filterJurnal(status, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.jurnal-item').forEach(item => {
        item.style.display = (status === 'semua' || item.dataset.status === status) ? 'flex' : 'none';
    });
}
@endsection
