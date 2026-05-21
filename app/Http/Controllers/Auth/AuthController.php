<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Models\User;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // ── Tampilkan form login ──────────────────────────────────────
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('auth.login');
    }

    // ── Proses login ─────────────────────────────────────────────
 public function login(Request $request)
{
    $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required'],
    ], [
        'username.required' => 'Username wajib diisi.',
        'password.required' => 'Password wajib diisi.',
    ]);

    $remember = $request->boolean('remember');

    $attempted = Auth::attempt(
        ['email' => $request->username . '@simpkl.local', 'password' => $request->password],
        $remember
    );

    if (!$attempted) {
        $attempted = Auth::attempt(
            ['email' => $request->username, 'password' => $request->password],
            $remember
        );
    }

    if (!$attempted) {
        throw ValidationException::withMessages([
            'username' => 'Username atau password salah.',
        ]);
    }

    $user = Auth::user();

    // ── Validasi role_hint ─────────────────────────────
    $roleHint = $request->input('role_hint');

    $roleMap = [
    'pembimbing' => 'pembimbing',
    'guru'       => 'pembimbing',
    'hubin'      => 'wakasek',
    'admin'      => 'admin',
];

    if ($roleHint && isset($roleMap[$roleHint])) {
        if ($user->role !== $roleMap[$roleHint]) {
            Auth::logout();
            throw ValidationException::withMessages([
                'username' => 'Akun ini tidak terdaftar sebagai ' . ucfirst($roleHint) . '.',
            ]);
        }
    }
    // ───────────────────────────────────────────────────

    $request->session()->regenerate();

    LogAktivitas::catat("Login ke sistem sebagai {$user->role}", $user->id);

    return $this->redirectByRole($user->role);
}

    // ── Tampilkan form register ───────────────────────────────────
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('auth.register');
    }

    // ── Proses register ───────────────────────────────────────────
    public function register(Request $request)
    {
        $request->validate([
            'username'      => ['required', 'string', 'max:50', 'unique:users,email', 'regex:/^[a-z0-9._]+$/'],
            'password'      => ['required', 'min:8', 'confirmed'],
            'nama_lengkap'  => ['required', 'string', 'max:100'],
            'nis'           => ['nullable', 'string', 'max:20', 'unique:profil_siswa,nis'],
            'kelas'         => ['nullable', 'in:XI,XII'],
            'jurusan'       => ['nullable', 'in:TKJ,RPL,AKL,OTKP'],
            'tempat_lahir'  => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat'        => ['nullable', 'string'],
        ], [
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'username.regex'        => 'Username hanya boleh huruf kecil, angka, titik, atau underscore.',
            'password.required'     => 'Kata sandi wajib diisi.',
            'password.min'          => 'Kata sandi minimal 8 karakter.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nis.unique'            => 'NIS sudah terdaftar.',
        ]);

        $namaParts    = explode(' ', trim($request->nama_lengkap), 2);
        $namaDepan    = $namaParts[0];
        $namaBelakang = $namaParts[1] ?? '';

        $user = User::create([
            'nama_depan'    => $namaDepan,
            'nama_belakang' => $namaBelakang,
            'email'         => $request->username . '@simpkl.local',
            'password'      => Hash::make($request->password),
            'role'          => 'siswa',
        ]);

        ProfilSiswa::create([
            'user_id'       => $user->id,
            'nis'           => $request->nis ?: null,
            'kelas'         => $request->kelas ?: null,
            'jurusan'       => $request->jurusan ?: null,
            'tempat_lahir'  => $request->tempat_lahir ?: null,
            'tanggal_lahir' => $request->tanggal_lahir ?: null,
            'alamat'        => $request->alamat ?: null,
        ]);

        Auth::login($user);

        LogAktivitas::catat("Registrasi akun baru sebagai siswa", $user->id);

        return $this->redirectByRole($user->role);
    }

    // ── Logout ───────────────────────────────────────────────────
    public function logout(Request $request)
    {
        LogAktivitas::catat('Logout dari sistem');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }

    // ── Redirect berdasarkan role ─────────────────────────────────
    private function redirectByRole(string $role)
    {
        return match($role) {
            'siswa'       => redirect()->route('siswa.dashboard'),
            'pembimbing'  => redirect()->route('pembimbing.dashboard'),
            'wakasek'     => redirect()->route('wakasek.dashboard'),
            'admin'       => redirect()->route('admin.dashboard'),
            default       => redirect('/'),
        };
    }
    // ── Tampilkan form login2 ─────────────────────────────────
public function showLogin2()
{
    if (Auth::check()) {
        return $this->redirectByRole(Auth::user()->role);
    }
    return view('auth.login2');
}

}