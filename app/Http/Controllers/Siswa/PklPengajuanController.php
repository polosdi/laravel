<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Models\PklAnggota;
use App\Models\PklPengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PklPengajuanController extends Controller
{
    /* Daftar pengajuan milik siswa (sebagai ketua atau anggota) */
    public function index()
    {
        $userId = Auth::id();

        // Pengajuan di mana siswa ini adalah ketua
        $sebagaiKetua = PklPengajuan::where('ketua_id', $userId)
            ->latest('tanggal_pengajuan')
            ->get();

        // Pengajuan di mana siswa ini adalah anggota
        $sebagaiAnggota = PklAnggota::where('siswa_id', $userId)
            ->with('pengajuan')
            ->get()
            ->pluck('pengajuan')
            ->filter() // buang null
            ->whereNotIn('ketua_id', [$userId]); // jangan duplikat

        $semua = $sebagaiKetua->merge($sebagaiAnggota);

        // Cek apakah sudah punya PKL aktif
        $pklAktif = $semua->first(fn($p) =>
            $p->status_pembimbing === 'disetujui' && $p->status_wakasek === 'disetujui'
        );

        return view('siswa.pkl.index', compact('semua', 'pklAktif'));
    }

    /* Form buat pengajuan baru */
    public function create()
    {
        // Cek apakah sudah ada pengajuan aktif
        $sudahAktif = PklAnggota::where('siswa_id', Auth::id())
            ->where('status_keanggotaan', 'aktif')
            ->whereHas('pengajuan', fn($q) =>
                $q->where('status_wakasek', 'disetujui')
            )->exists();

        if ($sudahAktif) {
            return redirect()->route('siswa.pkl.pengajuan')
                ->with('info', 'Kamu sudah memiliki PKL yang aktif.');
        }

        return view('siswa.pkl.create');
    }

    /* Simpan pengajuan baru */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan'  => ['required', 'string', 'max:100'],
            'alamat_perusahaan'=> ['required', 'string'],
            'website'          => ['nullable', 'url', 'max:255'],
            'file_dokumen'     => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            // anggota tambahan (opsional, array NIS)
            'anggota_ids'      => ['nullable', 'array'],
            'anggota_ids.*'    => ['exists:users,id'],
        ]);

        // Upload dokumen
        $filePath = null;
        if ($request->hasFile('file_dokumen')) {
            $filePath = $request->file('file_dokumen')
                ->store('dokumen_pkl/' . Auth::id(), 'public');
        }

        // Buat pengajuan
        $pengajuan = PklPengajuan::create([
            'ketua_id'         => Auth::id(),
            'nama_perusahaan'  => $validated['nama_perusahaan'],
            'alamat_perusahaan'=> $validated['alamat_perusahaan'],
            'website'          => $validated['website'] ?? null,
            'file_dokumen'     => $filePath,
            'status_pembimbing'=> 'pending',
            'status_wakasek'   => 'pending',
        ]);

        // Tambahkan ketua sebagai anggota pertama
        PklAnggota::create([
            'pengajuan_id'      => $pengajuan->id,
            'siswa_id'          => Auth::id(),
            'status_keanggotaan'=> 'aktif',
        ]);

        // Tambahkan anggota lain
        foreach ($request->input('anggota_ids', []) as $siswaId) {
            if ($siswaId != Auth::id()) {
                PklAnggota::create([
                    'pengajuan_id'      => $pengajuan->id,
                    'siswa_id'          => $siswaId,
                    'status_keanggotaan'=> 'aktif',
                ]);
            }
        }

        LogAktivitas::catat("Mengajukan PKL ke {$pengajuan->nama_perusahaan}");

        return redirect()->route('siswa.pkl.pengajuan')
            ->with('success', 'Pengajuan PKL berhasil dikirim, menunggu persetujuan.');
    }

    /* Detail pengajuan */
    public function show(int $id)
    {
        $pengajuan = PklPengajuan::with(['anggota.siswa', 'pembimbing'])
            ->findOrFail($id);

        // Pastikan siswa ini terlibat (ketua atau anggota)
        $terlibat = $pengajuan->ketua_id === Auth::id()
            || $pengajuan->anggota->contains('siswa_id', Auth::id());

        abort_unless($terlibat, 403);

        return view('siswa.pkl.show', compact('pengajuan'));
    }
}
