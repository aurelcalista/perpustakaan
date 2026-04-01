<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ulasans', function (Blueprint $table) {
            // tambah kolom relasi
            $table->unsignedBigInteger('user_id')->after('id');
            $table->string('id_buku', 10)->after('user_id');

            // hapus kolom lama
            $table->dropColumn(['nama', 'kelas']);
        });
    }

    public function down(): void
    {
        Schema::table('ulasans', function (Blueprint $table) {
            $table->string('nama');
            $table->string('kelas');

            $table->dropColumn(['user_id', 'id_buku']);
        });
    }
};