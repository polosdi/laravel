<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPkl extends Model
{
    protected $table = 'laporan_pkl';
    public $timestamps = false;

    protected $fillable = [
        'siswa_id', 'judul_laporan', 'file_path', 'jenis_laporan',
        'status_pembimbing', 'status_wakasek', 'catatan_revisi', 'tampil_di_publik',
    ];

    // Relasi ke User/siswa (belongsTo)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
