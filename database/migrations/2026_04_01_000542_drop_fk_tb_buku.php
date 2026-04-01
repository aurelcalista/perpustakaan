<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tb_buku', function (Blueprint $table) {
            $table->dropForeign(['id_kategori']);
        });
    }

    public function down(): void
    {
        // Cek dulu apakah FK sudah ada, kalau belum baru tambah
        // (mencegah error duplicate constraint saat rollback)
        $fkExists = collect(DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = DATABASE()
              AND TABLE_NAME = 'tb_buku'
              AND CONSTRAINT_NAME = 'tb_buku_id_kategori_foreign'
              AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        "))->isNotEmpty();

        if (!$fkExists) {
            Schema::table('tb_buku', function (Blueprint $table) {
                $table->foreign('id_kategori')
                    ->references('id_kategori') // fix: harusnya id_kategori, bukan id
                    ->on('tb_kategori')
                    ->onDelete('set null');
            });
        }
    }
};