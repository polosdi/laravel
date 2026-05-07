<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
        // =============================================
    // TAMBAHKAN INI — letakkan sebelum tanda } terakhir
    // =============================================

    // Relasi ke profil_siswa (hasOne = satu user punya satu profil siswa)
    // FK yang dipakai: kolom user_id di tabel profil_siswa
    public function profilSiswa()
    {
        return $this->hasOne(ProfilSiswa::class, 'user_id');
    }

    // Relasi ke profil_guru (hasOne = satu user punya satu profil guru)
    // FK yang dipakai: kolom user_id di tabel profil_guru
    public function profilGuru()
    {
        return $this->hasOne(ProfilGuru::class, 'user_id');
    }

    // Relasi ke absensi (hasMany = satu user bisa punya banyak absensi)
    // FK yang dipakai: kolom siswa_id di tabel absensi
    // kenapa bukan user_id? karena di SQL-mu kolom FK-nya dinamai siswa_id
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'siswa_id');
    }

    // Relasi ke jurnal_harian (hasMany)
    // FK yang dipakai: kolom siswa_id di tabel jurnal_harian
    public function jurnalHarian()
    {
        return $this->hasMany(JurnalHarian::class, 'siswa_id');
    }

    // Relasi ke laporan_pkl (hasMany)
    // FK yang dipakai: kolom siswa_id di tabel laporan_pkl
    public function laporanPkl()
    {
        return $this->hasMany(LaporanPkl::class, 'siswa_id');
    }

    // Relasi ke nilai_pkl sebagai SISWA yang dinilai (hasMany)
    // FK yang dipakai: kolom siswa_id di tabel nilai_pkl
    public function nilaiPkl()
    {
        return $this->hasMany(NilaiPkl::class, 'siswa_id');
    }

    // Relasi ke pkl_pengajuan sebagai KETUA kelompok (hasMany)
    // FK yang dipakai: kolom ketua_id di tabel pkl_pengajuan
    public function pengajuanSebagaiKetua()
    {
        return $this->hasMany(PklPengajuan::class, 'ketua_id');
    }

    // Relasi ke pkl_pengajuan sebagai PEMBIMBING/GURU (hasMany)
    // FK yang dipakai: kolom pembimbing_id di tabel pkl_pengajuan
    public function pengajuanDibimbing()
    {
        return $this->hasMany(PklPengajuan::class, 'pembimbing_id');
    }

    // Relasi ke nilai_pkl sebagai GURU yang memberi nilai (hasMany)
    // FK yang dipakai: kolom pembimbing_id di tabel nilai_pkl
    public function nilaiDiberikan()
    {
        return $this->hasMany(NilaiPkl::class, 'pembimbing_id');
    }

    // Relasi many-to-many ke pkl_pengajuan lewat tabel pivot pkl_anggota
    // Artinya: satu siswa bisa ikut banyak PKL, satu PKL punya banyak siswa
    // Parameter: Model tujuan, nama tabel pivot, FK ke tabel ini, FK ke tabel tujuan
    public function pklDiikuti()
    {
        return $this->belongsToMany(
            PklPengajuan::class,
            'pkl_anggota',   // nama tabel pivot
            'siswa_id',      // kolom FK yang mengarah ke users
            'pengajuan_id'   // kolom FK yang mengarah ke pkl_pengajuan
        )->withPivot('status_keanggotaan'); // kolom tambahan dari tabel pivot yang ikut diambil
    }

    // Relasi ke log_aktivitas (hasMany)
    // PERHATIAN: FK di tabelnya bernama id_users, bukan user_id
    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'id_users');
    }
}
