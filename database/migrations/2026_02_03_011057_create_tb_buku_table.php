<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_buku', function (Blueprint $table) {
            $table->string('id_buku', 10)->primary();
            $table->string('judul_buku', 30);
            $table->string('pengarang', 30);
            $table->string('penerbit', 30);
            $table->year('th_terbit');
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->string('penyunting')->nullable();
            $table->string('edisi')->nullable();
            $table->string('deskripsi_fisik')->nullable();
            $table->string('isbn')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('call_number')->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('tb_kategori')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_buku');
    }
};