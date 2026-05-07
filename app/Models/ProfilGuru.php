<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilGuru extends Model
{
    protected $table = 'profil_guru';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'nip', 'jabatan', 'jabatan_terakhir',
        'tempat_lahir', 'tanggal_lahir', 'alamat', 'no_hp', 'foto_profil',
    ];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}