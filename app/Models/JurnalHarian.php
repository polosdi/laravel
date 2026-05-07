<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurnalHarian extends Model
{
    protected $table = 'jurnal_harian';
    public $timestamps = false;

    protected $fillable = [
        'siswa_id', 'tanggal', 'jam_masuk', 'jam_keluar',
        'kegiatan', 'foto_kegiatan', 'status_validasi', 'komentar_pembimbing',
    ];

    // Relasi ke User/siswa (belongsTo)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
