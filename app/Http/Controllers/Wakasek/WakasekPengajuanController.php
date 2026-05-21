<?php

namespace App\Http\Controllers\Wakasek;
use App\Http\Controllers\Controller;

use App\Models\PklPengajuan;

class WakasekPengajuanController extends Controller
{
    public function index()
    {
        $daftarPengajuan = PklPengajuan::with(['ketua'])
            ->orderByDesc('tanggal_pengajuan')
            ->get();

        return view('wakasek.pengajuan', compact('daftarPengajuan'));
    }

    public function approve($id)
    {
        PklPengajuan::findOrFail($id)->update(['status_wakasek' => 'disetujui']);
        return redirect()->route('wakasek.pengajuan')->with('success', 'Pengajuan PKL berhasil disetujui!');
    }

    public function reject($id)
    {
        PklPengajuan::findOrFail($id)->update(['status_wakasek' => 'ditolak']);
        return redirect()->route('wakasek.pengajuan')->with('success', 'Pengajuan PKL berhasil ditolak.');
    }
}   