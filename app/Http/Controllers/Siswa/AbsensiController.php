<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::olehSiswa(Auth::id())
            ->orderByDesc('tanggal');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        $absensi    = $query->paginate(20)->withQueryString();
        $hadir      = Absensi::olehSiswa(Auth::id())->hadir()->count();
        $izin       = Absensi::olehSiswa(Auth::id())->where('status', 'Izin')->count();
        $sakit      = Absensi::olehSiswa(Auth::id())->where('status', 'Sakit')->count();
        $alpa       = Absensi::olehSiswa(Auth::id())->where('status', 'Alpa')->count();
        $total      = $hadir + $izin + $sakit + $alpa;
        $skorAbsen  = $total > 0 ? round($hadir / $total * 100) : 0;

        return view('siswa.absensi.index', compact(
            'absensi', 'hadir', 'izin', 'sakit', 'alpa', 'total', 'skorAbsen'
        ));
    }
}
