<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_buku', function (Blueprint $table) {
            $table->string('id_buku', 10)->primary();
            $table->string('judul_buku', 30);
            $table->string('pengarang', 30);
            $table->string('penerbit', 30);
            $table->year('th_terbit');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_buku');
    }
};