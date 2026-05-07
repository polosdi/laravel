<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    // PENTING: PK tabel ini bukan "id" tapi "id_log"
    // kalau tidak didefinisikan, Laravel akan error saat query
    protected $primaryKey = 'id_log';

    public $timestamps = false;

    protected $fillable = ['id_users', 'aktivitas', 'waktu'];

    // Relasi ke User (belongsTo)
    // FK: id_users (bukan user_id, sesuai nama kolom di SQL-mu)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}