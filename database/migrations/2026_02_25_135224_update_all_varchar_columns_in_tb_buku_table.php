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
        Schema::table('tb_buku', function (Blueprint $table) {
            // Perbesar SEMUA kolom varchar sekaligus
            $table->string('judul_buku', 255)->change();
            $table->string('pengarang', 100)->change();
            $table->string('penerbit', 100)->change();
            $table->string('penyunting', 255)->nullable()->change();
            $table->string('edisi', 100)->nullable()->change();
            $table->string('deskripsi_fisik', 255)->nullable()->change();
            $table->string('isbn', 50)->nullable()->change();
            $table->string('bahasa', 50)->nullable()->change();
            $table->string('call_number', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_buku', function (Blueprint $table) {
            // Kembalikan ke ukuran semula
            $table->string('judul_buku', 30)->change();
            $table->string('pengarang', 30)->change();
            $table->string('penerbit', 30)->change();
            $table->string('penyunting', 255)->nullable()->change();
            $table->string('edisi', 255)->nullable()->change();
            $table->string('deskripsi_fisik', 255)->nullable()->change();
            $table->string('isbn', 255)->nullable()->change();
            $table->string('bahasa', 255)->nullable()->change();
            $table->string('call_number', 255)->nullable()->change();
        });
    }
};