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

class ProfilController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $profil = ProfilGuru::firstOrNew(['user_id' => $user->id]);
        return view('pembimbing.profil.index', compact('user','profil'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'nama_depan'    => 'required|string|max:50',
            'nama_belakang' => 'required|string|max:50',
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'nip'           => 'nullable|string|max:30',
            'jabatan'       => 'nullable|string|max:100',
            'no_hp'         => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'foto_profil'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->update($request->only('nama_depan','nama_belakang','email'));

        $data = $request->only('nip','jabatan','jabatan_terakhir','tempat_lahir','tanggal_lahir','alamat','no_hp');

        if ($request->hasFile('foto_profil')) {
            $profil = ProfilGuru::where('user_id',$user->id)->first();
            if ($profil?->foto_profil) \Storage::disk('public')->delete($profil->foto_profil);
            $data['foto_profil'] = $request->file('foto_profil')->store('profil/guru','public');
        }

        ProfilGuru::updateOrCreate(['user_id' => $user->id], $data);
        return back()->with('success','Profil berhasil diperbarui!');
    }
}
