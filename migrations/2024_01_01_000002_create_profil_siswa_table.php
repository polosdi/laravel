<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nis', 20)->unique()->nullable();
            $table->string('kelas', 20)->nullable();
            $table->string('jurusan', 50)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('foto_profil', 255)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_siswa');
    }
};
