<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan', 50);
            $table->string('nama_belakang', 50);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->enum('role', ['siswa', 'pembimbing', 'wakasek', 'admin']);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
