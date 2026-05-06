<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pkl_pengajuan')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('users');
            $table->enum('status_keanggotaan', ['aktif', 'nonaktif'])->default('aktif');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_anggota');
    }
};
