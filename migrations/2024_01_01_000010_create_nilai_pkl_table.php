<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_pkl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pembimbing_id')->constrained('users');
            $table->integer('nilai_sikap')->default(0);
            $table->integer('nilai_keterampilan')->default(0);
            $table->integer('nilai_laporan')->default(0);
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->char('predikat', 2)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_pkl');
    }
};
