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


class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporan = LaporanPkl::whereHas('siswa.pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', Auth::id()))
            ->with('siswa')
            ->when($request->status, fn($q,$s) => $q->where('status_pembimbing',$s))
            ->when($request->jenis,  fn($q,$j)  => $q->where('jenis_laporan',$j))
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('pembimbing.laporan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = LaporanPkl::with('siswa.profilSiswa')->findOrFail($id);
        return view('pembimbing.laporan.show', compact('laporan'));
    }

    public function review(Request $request, $id)
    {
        $request->validate([
            'status_pembimbing' => 'required|in:disetujui,revisi',
            'catatan_revisi'    => 'nullable|string',
        ]);

        LaporanPkl::findOrFail($id)->update([
            'status_pembimbing' => $request->status_pembimbing,
            'catatan_revisi'    => $request->catatan_revisi,
        ]);

        $label = $request->status_pembimbing === 'disetujui' ? 'disetujui' : 'diminta revisi';
        return redirect()->route('pembimbing.laporan.index')->with('success', "Laporan berhasil {$label}.");
    }
}
