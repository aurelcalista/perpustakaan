<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tb_sirkulasi', function (Blueprint $table) {
            
            $table->unsignedBigInteger('user_id')->nullable()->after('id_buku');
        });

        
        DB::statement('UPDATE tb_sirkulasi SET user_id = id_anggota');

        Schema::table('tb_sirkulasi', function (Blueprint $table) {
           
            $table->dropColumn('id_anggota');
        });
    }

    public function down(): void
    {
        Schema::table('tb_sirkulasi', function (Blueprint $table) {
            $table->string('id_anggota', 10)->nullable();
        });

        DB::statement('UPDATE tb_sirkulasi SET id_anggota = user_id');

        Schema::table('tb_sirkulasi', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};