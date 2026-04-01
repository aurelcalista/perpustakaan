<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
  public function up()
{
    Schema::create('ulasans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('kelas');
        $table->text('isi');
        $table->integer('rating');
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
