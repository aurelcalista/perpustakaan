<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_buku', function (Blueprint $table) {
            $table->string('id_buku', 10)->primary();
            $table->string('judul_buku', 30);
            $table->string('pengarang', 30);
            $table->string('penerbit', 30);
            $table->year('th_terbit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_buku');
    }
};