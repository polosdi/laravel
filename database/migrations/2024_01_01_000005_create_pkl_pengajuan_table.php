<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ketua_id')->constrained('users');
            $table->string('nama_perusahaan', 100);
            $table->text('alamat_perusahaan');
            $table->string('website', 255)->nullable();
            $table->string('file_dokumen', 255)->nullable();
            $table->enum('status_pembimbing', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->enum('status_wakasek', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->foreignId('pembimbing_id')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('tanggal_pengajuan')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_pengajuan');
    }
};
