<?php
namespace App\Http\Controllers\Wakasek;
use App\Http\Controllers\Controller;
use App\Models\NilaiPkl;

class WakasekNilaiController extends Controller
{
    public function index()
    {
        $daftarNilai = NilaiPkl::with(['siswa.profilSiswa', 'pembimbing'])
            ->orderByDesc('created_at')->get();

        $rataRata     = $daftarNilai->avg('nilai_akhir') ? round($daftarNilai->avg('nilai_akhir'), 1) : 0;
        $nilaiTertinggi = $daftarNilai->max('nilai_akhir') ?? 0;
        $nilaiTerendah  = $daftarNilai->min('nilai_akhir') ?? 0;

        return view('wakasek.nilai', compact('daftarNilai', 'rataRata', 'nilaiTertinggi', 'nilaiTerendah'));
    }
}