<?php

namespace App\Http\Controllers\Wakasek;

use App\Http\Controllers\Controller;
use App\Models\User;

class WakasekSiswaController extends Controller
{
    public function index()
    {
        $siswas = User::where('role', 'siswa')
            ->with(['profilSiswa', 'pklAnggota.pengajuan'])
            ->orderBy('nama_depan')
            ->get();

        $siswas->each(function ($siswa) {
            $anggota   = $siswa->pklAnggota->first();
            $pengajuan = $anggota?->pengajuan;

            if (!$pengajuan) {
                $siswa->statusPkl = 'belum';
            } elseif ($pengajuan->status_wakasek === 'disetujui') {
                $siswa->statusPkl = 'pkl';
            } elseif ($pengajuan->status_wakasek === 'ditolak') {
                $siswa->statusPkl = 'ditolak';
            } else {
                $siswa->statusPkl = 'pending';
            }
        });

        $siswaPerKelas = $siswas
            ->groupBy(fn($s) => $s->profilSiswa->kelas ?? 'Tidak Ada Kelas')
            ->sortKeys();

        $totalSiswa = $siswas->count();

        return view('wakasek.siswa', compact('siswaPerKelas', 'totalSiswa'));
    }
}