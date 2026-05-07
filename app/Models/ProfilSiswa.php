<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSiswa extends Model
{
    // Beritahu Laravel nama tabelnya, karena defaultnya Laravel
    // akan cari tabel "profil_siswas" (ditambah s), padahal aslinya "profil_siswa"
    protected $table = 'profil_siswa';

    // Tabel ini tidak punya kolom updated_at, jadi matikan timestamps
    public $timestamps = false;

    // Kolom mana saja yang boleh diisi lewat create() atau fill()
    protected $fillable = [
        'user_id', 'nis', 'kelas', 'jurusan', 'no_hp',
        'foto_profil', 'jenis_kelamin', 'agama',
        'tempat_lahir', 'tanggal_lahir', 'alamat', 'golongan_darah',
    ];

    // Relasi balik ke User (belongsTo = model ini milik satu User)
    // FK yang dipakai: kolom user_id di tabel ini
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}