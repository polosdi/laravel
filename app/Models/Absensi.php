<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    public $timestamps = false;

    protected $fillable = ['siswa_id', 'tanggal', 'jam_masuk', 'jam_pulang', 'status', 'keterangan'];

    // Relasi ke User/siswa (belongsTo)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
