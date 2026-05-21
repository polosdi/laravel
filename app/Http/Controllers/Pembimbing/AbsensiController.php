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



class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;

        $daftarSiswa = User::where('role','siswa')
            ->whereHas('pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', Auth::id()))
            ->with('profilSiswa')->get();

        // Filter by siswa
        $siswaIds = $request->siswa_id
            ? [$request->siswa_id]
            : $daftarSiswa->pluck('id')->toArray();

        $rekapAbsensi = [];
        foreach ($daftarSiswa->whereIn('id',$siswaIds) as $siswa) {
            $stats = Absensi::where('siswa_id',$siswa->id)
                ->whereMonth('tanggal',$bulan)->selectRaw("
                    SUM(status='Hadir') hadir,SUM(status='Izin') izin,
                    SUM(status='Sakit') sakit,SUM(status='Alpa') alpa
                ")->first();
            $rekapAbsensi[] = [
                'siswa' => $siswa,
                'hadir' => $stats->hadir ?? 0,
                'izin'  => $stats->izin  ?? 0,
                'sakit' => $stats->sakit ?? 0,
                'alpa'  => $stats->alpa  ?? 0,
            ];
        }

        return view('pembimbing.absensi.index', compact('daftarSiswa','rekapAbsensi','bulan'));
    }
}
