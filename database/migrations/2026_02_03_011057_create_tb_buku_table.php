<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('tb_buku', function (Blueprint $table) {
            $table->string('id_buku', 10)->primary();
            $table->string('judul_buku', 250);
            $table->string('pengarang', 225);
            $table->string('penerbit', 250);
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

            
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('tb_kategori')
                  ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('tb_buku');
    }
};