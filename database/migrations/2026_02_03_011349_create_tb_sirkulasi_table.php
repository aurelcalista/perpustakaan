<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_sirkulasi', function (Blueprint $table) {
            $table->string('id_sk', 20)->primary();
            $table->string('id_buku', 10);
            $table->string('id_anggota', 10);
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->enum('status', ['PIN', 'KEM']);

            $table->foreign('id_buku')->references('id_buku')->on('tb_buku')->onDelete('cascade');
            $table->foreign('id_anggota')->references('id_anggota')->on('tb_anggota')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_sirkulasi');
    }
};