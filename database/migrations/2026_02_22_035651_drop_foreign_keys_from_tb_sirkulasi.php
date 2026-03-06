<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah foreign key id_anggota ada
        if ($this->foreignKeyExists('tb_sirkulasi', 'tb_sirkulasi_id_anggota_foreign')) {
            Schema::table('tb_sirkulasi', function (Blueprint $table) {
                $table->dropForeign(['id_anggota']);
            });
        }

        // Cek apakah foreign key id_buku ada
        if ($this->foreignKeyExists('tb_sirkulasi', 'tb_sirkulasi_id_buku_foreign')) {
            Schema::table('tb_sirkulasi', function (Blueprint $table) {
                $table->dropForeign(['id_buku']);
            });
        }
    }

    public function down(): void
    {
        // Ga perlu restore foreign key karena sudah diganti struktur
    }

    /**
     * Cek apakah foreign key ada di database
     */
    private function foreignKeyExists(string $table, string $foreignKey): bool
    {
        $result = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = ? 
            AND CONSTRAINT_NAME = ?
        ", [$table, $foreignKey]);

        return !empty($result);
    }
};