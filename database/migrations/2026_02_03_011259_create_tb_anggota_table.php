<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_anggota', function (Blueprint $table) {
            $table->string('id_anggota', 10)->primary();
            $table->string('nama', 20);
            $table->enum('jekel', ['Laki-laki', 'Perempuan']);
            $table->string('kelas', 50);
            $table->string('no_hp', 15);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_anggota');
    }
};