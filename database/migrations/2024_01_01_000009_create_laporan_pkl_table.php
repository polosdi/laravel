<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_pkl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users');
            $table->string('judul_laporan', 200)->nullable();
            $table->string('file_path', 255)->nullable();
            $table->enum('jenis_laporan', ['mingguan', 'akhir']);
            $table->enum('status_pembimbing', ['pending', 'revisi', 'disetujui'])->default('pending');
            $table->enum('status_wakasek', ['pending', 'disetujui'])->default('pending');
            $table->text('catatan_revisi')->nullable();
            $table->boolean('tampil_di_publik')->default(false);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_pkl');
    }
};
