<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ulasans', function (Blueprint $table) {
    
            $table->string('nama')->after('user_id')->nullable();
            $table->string('kelas')->after('nama')->nullable();


            $table->string('id_buku', 10)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('ulasans', function (Blueprint $table) {
            $table->dropColumn(['nama', 'kelas']);
            $table->string('id_buku', 10)->nullable(false)->change();
        });
    }
};