<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'name' default Laravel (kalau ada)
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
            
            // Tambah kolom baru
            if (!Schema::hasColumn('users', 'nis')) {
                $table->string('nis')->nullable()->unique()->after('id'); 
            }
            if (!Schema::hasColumn('users', 'nama')) {
                $table->string('nama')->after('nis');
            }
            if (!Schema::hasColumn('users', 'noidentitas')) {
                $table->string('noidentitas')->nullable()->after('nama'); 
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('noidentitas'); 
            }
            if (!Schema::hasColumn('users', 'notlp')) {
                $table->string('notlp')->nullable()->after('alamat'); 
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nis', 'nama', 'noidentitas', 'alamat', 'notlp']);
            
            // Kembalikan kolom 'name' default Laravel
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->after('id');
            }
        });
    }
};