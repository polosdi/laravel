<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users');
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->text('kegiatan');
            $table->string('foto_kegiatan', 255)->nullable();
            $table->enum('status_validasi', ['pending', 'valid', 'tolak'])->default('pending');
            $table->text('komentar_pembimbing')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal_harian');
    }
};
