<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_pinjam', function (Blueprint $table) {
            $table->id('id_log');
            $table->string('id_buku', 10);
            $table->string('id_anggota', 10);
            $table->date('tgl_pinjam');

            $table->foreign('id_buku')->references('id_buku')->on('tb_buku')->onDelete('cascade');
            $table->foreign('id_anggota')->references('id_anggota')->on('tb_anggota')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_pinjam');
    }
};