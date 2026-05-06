<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('walikelas', function (Blueprint $table) {
            $table->id('id_walikelas');
            $table->string('Nama_wakel', 40);
            $table->string('Alamat', 50);
            $table->string('Agama_wakel', 10);
            $table->string('No_kontak', 20);
            $table->integer('Mewalikelaskan')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('walikelas');
    }
};
