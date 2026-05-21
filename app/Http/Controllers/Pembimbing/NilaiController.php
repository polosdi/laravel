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


class NilaiController extends Controller
{
    private function daftarSiswa()
    {
        return User::where('role','siswa')
            ->whereHas('pklAnggota.pengajuan', fn($q) =>
                $q->where('pembimbing_id', Auth::id()))
            ->with([
                'profilSiswa',
                'pklAnggota.pengajuan',
                'nilaiPkl' => fn($q) => $q->where('pembimbing_id', Auth::id()), // ← fix
            ])
            ->get();
    }

    public function index()
    {
        $daftarSiswa = $this->daftarSiswa();
        return view('pembimbing.nilai.index', compact('daftarSiswa'));
    }

    public function form($siswaId)
    {
        $siswa = User::with(['profilSiswa','pklAnggota.pengajuan'])->findOrFail($siswaId);
        $nilai = NilaiPkl::where('siswa_id',$siswaId)->where('pembimbing_id',Auth::id())->first();
        return view('pembimbing.nilai.form', compact('siswa','nilai'));
    }

    public function simpan(Request $request, $siswaId)
    {
        $data = $request->validate([
            'nilai_sikap'         => 'required|integer|min:0|max:100',
            'nilai_keterampilan'  => 'required|integer|min:0|max:100',
            'nilai_laporan'       => 'required|integer|min:0|max:100',
            'catatan'             => 'nullable|string',
        ]);

        $akhir = round(
            ($data['nilai_sikap'] * 0.30) +
            ($data['nilai_keterampilan'] * 0.40) +
            ($data['nilai_laporan'] * 0.30), 2
        );
        $data['nilai_akhir']    = $akhir;
        $data['predikat']       = match(true) {
            $akhir >= 90 => 'A', $akhir >= 80 => 'B',
            $akhir >= 70 => 'C', $akhir >= 60 => 'D', default => 'E'
        };
        $data['siswa_id']       = $siswaId;
        $data['pembimbing_id']  = Auth::id();

        NilaiPkl::updateOrCreate(
            ['siswa_id' => $siswaId, 'pembimbing_id' => Auth::id()],
            $data
        );

        return redirect()->route('pembimbing.nilai.index')
            ->with('success','Nilai berhasil disimpan!');
    }
}