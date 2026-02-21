<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum status
        DB::statement("ALTER TABLE `tb_sirkulasi` MODIFY `status` ENUM('pending', 'dipinjam', 'dikembalikan') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Kembalikan ke enum lama kalau rollback
        DB::statement("ALTER TABLE `tb_sirkulasi` MODIFY `status` ENUM('PIN', 'KEM') NOT NULL");
    }
};