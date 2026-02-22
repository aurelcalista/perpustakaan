<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop foreign keys pakai raw SQL karena lebih aman
        DB::statement('ALTER TABLE tb_sirkulasi DROP FOREIGN KEY tb_sirkulasi_id_anggota_foreign');
        DB::statement('ALTER TABLE tb_sirkulasi DROP FOREIGN KEY tb_sirkulasi_id_buku_foreign');
    }

    public function down(): void
    {
        // Ga perlu restore, karena foreign key ini emang ga dipake lagi
    }
};