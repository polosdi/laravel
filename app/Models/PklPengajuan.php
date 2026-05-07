<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PklPengajuan extends Model
{
    protected $table = 'pkl_pengajuan';
    public $timestamps = false;

    protected $fillable = [
        'ketua_id', 'nama_perusahaan', 'alamat_perusahaan',
        'website', 'file_dokumen', 'status_pembimbing',
        'status_wakasek', 'pembimbing_id', 'tanggal_pengajuan',
    ];

    // Relasi ke User sebagai KETUA (belongsTo)
    // FK: kolom ketua_id di tabel ini mengarah ke users.id
    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

    // Relasi ke User sebagai PEMBIMBING (belongsTo)
    // FK: kolom pembimbing_id di tabel ini mengarah ke users.id
    // nullable karena pembimbing bisa belum ditentukan saat pengajuan dibuat
    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    // Relasi ke baris-baris di tabel pkl_anggota (hasMany)
    public function pklAnggota()
    {
        return $this->hasMany(PklAnggota::class, 'pengajuan_id');
    }

    // Relasi many-to-many langsung ke User lewat tabel pivot pkl_anggota
    // ini kebalikan dari pklDiikuti() yang ada di User.php
    public function siswaAnggota()
    {
        return $this->belongsToMany(
            User::class,
            'pkl_anggota',   // tabel pivot
            'pengajuan_id',  // FK ke pkl_pengajuan (tabel ini)
            'siswa_id'       // FK ke users
        )->withPivot('status_keanggotaan');
    }
}