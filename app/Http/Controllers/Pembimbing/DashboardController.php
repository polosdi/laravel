<?php
namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProfilGuru;
use App\Models\PklPengajuan;
use App\Models\PklAnggota;
use App\Models\JurnalHarian;
use App\Models\Absensi;
use App\Models\LaporanPkl;
use App\Models\NilaiPkl;


class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:pembimbing']);
    // }

    public function index()
    {
        $user   = Auth::user();
        $profil = ProfilGuru::where('user_id', $user->id)->first();

        // Semua siswa yang dibimbing (lewat pkl_pengajuan.pembimbing_id)
        $daftarSiswa = User::where('role', 'siswa')
            ->whereHas('pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', $user->id))
            ->with(['profilSiswa', 'pklAnggota.pengajuan'])
            ->get();

        $totalSiswa    = $daftarSiswa->count();
        $totalPklAktif = PklPengajuan::where('pembimbing_id', $user->id)
            ->where('status_pembimbing','disetujui')
            ->where('status_wakasek','disetujui')->count();

        // Pending counts
        $pendingPkl    = PklPengajuan::where('pembimbing_id', $user->id)->where('status_pembimbing','pending')->count();
        $pendingJurnal = JurnalHarian::whereHas('siswa.pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', $user->id))
            ->where('status_validasi','pending')->count();
        $pendingLaporan = LaporanPkl::whereHas('siswa.pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', $user->id))
            ->where('status_pembimbing','pending')->count();
        $totalPending  = $pendingPkl + $pendingJurnal + $pendingLaporan;

        // Sudah dinilai
        $sudahDinilai = NilaiPkl::where('pembimbing_id', $user->id)->count();

        // Jurnal pending terbaru (5)
        $jurnalPending = JurnalHarian::whereHas('siswa.pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', $user->id))
            ->with('siswa')
            ->where('status_validasi','pending')
            ->orderByDesc('tanggal')->take(5)->get();

        // Laporan terbaru
        $laporanTerbaru = LaporanPkl::whereHas('siswa.pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', $user->id))
            ->with('siswa')
            ->orderByDesc('created_at')->take(5)->get();

        return view('pembimbing.dashboard.index', compact(
            'user','profil','daftarSiswa','totalSiswa','totalPklAktif',
            'pendingPkl','pendingJurnal','pendingLaporan','totalPending',
            'sudahDinilai','jurnalPending','laporanTerbaru'
        ));
    }
}