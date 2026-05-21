<?php

namespace App\Http\Controllers\Wakasek;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PklPengajuan;
use App\Models\LaporanPkl;
use App\Models\MitraIndustri;
use Illuminate\Support\Facades\Auth;

class WakasekDashboardController extends Controller
{
    public function index()
    {
        $wakasek = Auth::user();

        $pengajuanPending   = PklPengajuan::where('status_wakasek', 'pending')->count();
        $pengajuanDisetujui = PklPengajuan::where('status_wakasek', 'disetujui')->count();

        $pengajuanTerbaru = PklPengajuan::with('ketua')
            ->orderByDesc('tanggal_pengajuan')
            ->take(5)
            ->get();

        $laporanPending   = LaporanPkl::where('status_pembimbing', 'disetujui')
            ->where('status_wakasek', 'pending')
            ->count();

        $laporanDisetujui = LaporanPkl::where('status_wakasek', 'disetujui')->count();
        $laporanTotal     = LaporanPkl::count();

        $persentaseLaporanDisetujui = $laporanTotal > 0
            ? round(($laporanDisetujui / $laporanTotal) * 100)
            : 0;

        $laporanTerbaru = LaporanPkl::with('siswa')
            ->where('status_pembimbing', 'disetujui')
            ->where('status_wakasek', 'pending')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        $totalSiswa      = User::where('role', 'siswa')->count();
        $totalSiswaAktif = $pengajuanDisetujui;
        $totalMitra      = MitraIndustri::count();

        $daftarSiswa = User::where('role', 'siswa')
            ->with('profilSiswa')
            ->orderBy('nama_depan')
            ->get();

        return view('wakasek.dashboard', compact(
            'wakasek',
            'pengajuanPending',
            'pengajuanDisetujui',
            'pengajuanTerbaru',
            'laporanPending',
            'persentaseLaporanDisetujui',
            'laporanTerbaru',
            'totalSiswa',
            'totalSiswaAktif',
            'totalMitra',
            'daftarSiswa'
        ));
    }
}