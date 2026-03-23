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
        Schema::create('favorit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('id_buku');
            $table->foreign('id_buku')->references('id_buku')->on('tb_buku')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'id_buku']); // 1 user tidak bisa favorit buku yang sama 2x
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorit');
    }
};
