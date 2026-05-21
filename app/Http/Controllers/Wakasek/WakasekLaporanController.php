<?php

namespace App\Http\Controllers\Wakasek;
use App\Http\Controllers\Controller;

use App\Models\LaporanPkl;

class WakasekLaporanController extends Controller
{
    public function index()
    {
        $daftarLaporan = LaporanPkl::with('siswa')
            ->orderByDesc('created_at')
            ->get();

        return view('wakasek.laporan', compact('daftarLaporan'));
    }

    public function approve($id)
    {
        LaporanPkl::findOrFail($id)->update(['status_wakasek' => 'disetujui']);
        return redirect()->route('wakasek.laporan')->with('success', 'Laporan PKL berhasil disetujui!');
    }
    public function reject($id)
{
    LaporanPkl::findOrFail($id)->update(['status_wakasek' => 'ditolak']);
    return redirect()->route('wakasek.laporan')->with('success', 'Laporan PKL berhasil ditolak.');
}
}