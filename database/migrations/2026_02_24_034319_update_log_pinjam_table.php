<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('log_pinjam', function (Blueprint $table) {
            // Hapus foreign key yang salah
            $table->dropForeign(['id_anggota']);
            $table->dropForeign(['id_buku']);
            
            // Tambah kolom timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('log_pinjam', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};