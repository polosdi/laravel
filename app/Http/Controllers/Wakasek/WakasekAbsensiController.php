<?php
namespace App\Http\Controllers\Wakasek;
use App\Http\Controllers\Controller;

use App\Models\Absensi;
use App\Models\User;

class WakasekAbsensiController extends Controller
{
    public function index()
    {
        $siswas = User::where('role', 'siswa')
            ->with(['profilSiswa', 'absensi'])
            ->orderBy('nama_depan')
            ->get();

        $rekapSiswa = $siswas->map(function ($siswa) {
            $absensi = $siswa->absensi;
            return [
                'siswa'  => $siswa,
                'hadir'  => $absensi->where('status', 'Hadir')->count(),
                'izin'   => $absensi->where('status', 'Izin')->count(),
                'sakit'  => $absensi->where('status', 'Sakit')->count(),
                'alpa'   => $absensi->where('status', 'Alpa')->count(),
            ];
        });

        $totalSiswa  = $siswas->count();
        $totalHadir  = Absensi::where('status', 'Hadir')->count();
        $totalIzin   = Absensi::where('status', 'Izin')->count();
        $totalSakit  = Absensi::where('status', 'Sakit')->count();
        $totalAlpa   = Absensi::where('status', 'Alpa')->count();

        return view('wakasek.absensi', compact(
            'rekapSiswa', 'totalSiswa',
            'totalHadir', 'totalIzin', 'totalSakit', 'totalAlpa'
        ));
    }
}