<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    protected $table = 'walikelas';

    // PENTING: PK tabel ini bukan "id" tapi "id_walikelas"
    protected $primaryKey = 'id_walikelas';

    public $timestamps = false;

    protected $fillable = ['Nama_wakel', 'Alamat', 'Agama_wakel', 'No_kontak', 'Mewalikelaskan'];

    // Tabel ini belum ada FK ke tabel lain, jadi belum ada relasi
}