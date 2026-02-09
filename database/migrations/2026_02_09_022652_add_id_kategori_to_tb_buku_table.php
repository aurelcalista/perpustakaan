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
    $table->string('id_kategori', 10)->after('id_buku');

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
        Schema::table('tb_buku', function (Blueprint $table) {
            //
        });
    }
};
