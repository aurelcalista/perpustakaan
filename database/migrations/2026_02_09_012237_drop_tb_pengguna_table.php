<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('tb_pengguna');
    }
    
    public function down()
    {
        //
    }
};