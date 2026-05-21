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



class JurnalController extends Controller
{
    private function siswaQuery()
    {
        return User::where('role','siswa')
            ->whereHas('pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', Auth::id()));
    }

    public function index(Request $request)
    {
        $daftarSiswa = $this->siswaQuery()->get();

        $query = JurnalHarian::whereHas('siswa.pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', Auth::id()))
            ->with('siswa')
            ->when($request->status,   fn($q,$s) => $q->where('status_validasi',$s))
            ->when($request->siswa_id, fn($q,$id) => $q->where('siswa_id',$id))
            ->when($request->tanggal,  fn($q,$t)  => $q->whereDate('tanggal',$t))
            ->orderByDesc('tanggal');

        $jurnal = $query->paginate(20);
        return view('pembimbing.jurnal.index', compact('jurnal','daftarSiswa'));
    }

    public function show($id)
    {
        $jurnal = JurnalHarian::with('siswa.profilSiswa')->findOrFail($id);
        return view('pembimbing.jurnal.show', compact('jurnal'));
    }

    public function validasi(Request $request, $id)
    {
        $jurnal = JurnalHarian::findOrFail($id);
        $jurnal->update([
            'status_validasi'      => $request->status,
            'komentar_pembimbing'  => $request->komentar_pembimbing,
        ]);
        $label = $request->status === 'valid' ? 'divalidasi' : 'ditolak';
        return back()->with('success', "Jurnal berhasil {$label}.");
    }
}
