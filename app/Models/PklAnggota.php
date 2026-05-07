<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PklAnggota extends Model
{
    protected $table = 'pkl_anggota';
    public $timestamps = false;

    protected $fillable = ['pengajuan_id', 'siswa_id', 'status_keanggotaan'];

    // Relasi ke PklPengajuan (belongsTo)
    public function pengajuan()
    {
        return $this->belongsTo(PklPengajuan::class, 'pengajuan_id');
    }

    // Relasi ke User/siswa (belongsTo)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}