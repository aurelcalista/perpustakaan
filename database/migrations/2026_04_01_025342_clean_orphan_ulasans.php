<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
 
public function up(): void
{
    DB::statement('DELETE FROM ulasans WHERE id_buku NOT IN (SELECT id_buku FROM tb_buku)');
}

public function down(): void
{
   

}
};
