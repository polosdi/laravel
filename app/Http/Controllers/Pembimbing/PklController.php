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


class PklController extends Controller
{
    public function index(Request $request)
    {
        $pkl = PklPengajuan::with(['ketua','anggota','ketua.profilSiswa'])
            ->where('pembimbing_id', Auth::id())
            ->when($request->status, fn($q,$s) => $q->where('status_pembimbing',$s))
            ->orderByDesc('tanggal_pengajuan')
            ->paginate(15);

        return view('pembimbing.pkl.index', compact('pkl'));
    }

    public function setujui($id)
    {
        PklPengajuan::where('id',$id)
            ->where('pembimbing_id', Auth::id())
            ->update(['status_pembimbing' => 'disetujui']);
        return back()->with('success','Pengajuan PKL disetujui.');
    }

    public function tolak($id)
    {
        PklPengajuan::where('id',$id)
            ->where('pembimbing_id', Auth::id())
            ->update(['status_pembimbing' => 'ditolak']);
        return back()->with('success','Pengajuan PKL ditolak.');
    }
}
