<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $siswa = ProfilSiswa::firstOrCreate(
            ['user_id' => $user->id],
            ['nis' => null, 'kelas' => null, 'jurusan' => null]
        );

        return view('siswa.profil.index', compact('user', 'siswa'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama_depan'    => ['required', 'string', 'max:50'],
            'nama_belakang' => ['required', 'string', 'max:50'],
            'email'         => ['required', 'email', 'unique:users,email,' . $user->id],
            'no_hp'         => ['nullable', 'string', 'max:15'],
            'kelas'         => ['nullable', 'string', 'max:20'],
            'jurusan'       => ['nullable', 'string', 'max:50'],
            'jenis_kelamin' => ['nullable', 'in:Laki-laki,Perempuan'],
            'agama'         => ['nullable', 'string', 'max:50'],
            'tempat_lahir'  => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat'        => ['nullable', 'string'],
            'golongan_darah'=> ['nullable', 'in:A,B,AB,O'],
        ]);

        // Update tabel users
        $user->update([
            'nama_depan'    => $validated['nama_depan'],
            'nama_belakang' => $validated['nama_belakang'],
            'email'         => $validated['email'],
        ]);

        // Update atau buat profil siswa
        ProfilSiswa::updateOrCreate(
            ['user_id' => $user->id],
            collect($validated)->except(['nama_depan', 'nama_belakang', 'email'])->toArray()
        );

        LogAktivitas::catat('Memperbarui data profil');

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto_profil' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $profil = ProfilSiswa::firstOrCreate(['user_id' => Auth::id()]);

        // Hapus foto lama
        if ($profil->foto_profil) {
            Storage::disk('public')->delete($profil->foto_profil);
        }

        $profil->foto_profil = $request->file('foto_profil')
            ->store('profil/' . Auth::id(), 'public');
        $profil->save();

        LogAktivitas::catat('Memperbarui foto profil');

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
            'password_lama' => ['required'],
            'password_baru' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password_baru),
        ]);

        LogAktivitas::catat('Mengganti password akun');

        return back()->with('success', 'Password berhasil diubah.');
    }
}
