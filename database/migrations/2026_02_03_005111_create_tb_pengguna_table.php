<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama_pengguna', 20);
            $table->string('username', 20)->unique();
            $table->string('password', 255);
            $table->enum('level', ['Administrator', 'Petugas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_pengguna');
    }
};