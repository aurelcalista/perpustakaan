<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =========================================================
        // 1. Fix favorit.id_buku: varchar(255) → varchar(10)
        //    supaya tipe-nya cocok dengan tb_buku.id_buku varchar(10)
        // =========================================================
        if ($this->foreignKeyExists('favorit', 'favorit_id_buku_foreign')) {
            Schema::table('favorit', function (Blueprint $table) {
                $table->dropForeign('favorit_id_buku_foreign');
            });
        }

        Schema::table('favorit', function (Blueprint $table) {
            $table->string('id_buku', 10)->change();
        });

        // =========================================================
        // 2. FK favorit → tb_buku
        // =========================================================
        if (!$this->foreignKeyExists('favorit', 'favorit_id_buku_foreign')) {
            Schema::table('favorit', function (Blueprint $table) {
                $table->foreign('id_buku')
                      ->references('id_buku')->on('tb_buku')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });
        }

        // =========================================================
        // 3. FK tb_buku → tb_kategori
        // =========================================================
        if (!$this->foreignKeyExists('tb_buku', 'tb_buku_id_kategori_foreign')) {
            Schema::table('tb_buku', function (Blueprint $table) {
                $table->foreign('id_kategori')
                      ->references('id_kategori')->on('tb_kategori')
                      ->onDelete('set null')
                      ->onUpdate('cascade');
            });
        }

        // =========================================================
        // 4. FK tb_sirkulasi → tb_buku
        // =========================================================
        if (!$this->foreignKeyExists('tb_sirkulasi', 'tb_sirkulasi_id_buku_foreign')) {
            Schema::table('tb_sirkulasi', function (Blueprint $table) {
                $table->foreign('id_buku')
                      ->references('id_buku')->on('tb_buku')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });
        }

        // =========================================================
        // 5. FK tb_sirkulasi → users
        //    Bersihkan data kotor dulu (user_id yang isinya NIS)
        // =========================================================
        DB::statement("
            UPDATE tb_sirkulasi
            SET user_id = NULL
            WHERE user_id IS NOT NULL
              AND user_id NOT IN (SELECT id FROM users)
        ");

        if (!$this->foreignKeyExists('tb_sirkulasi', 'tb_sirkulasi_user_id_foreign')) {
            Schema::table('tb_sirkulasi', function (Blueprint $table) {
                $table->foreign('user_id')
                      ->references('id')->on('users')
                      ->onDelete('set null')
                      ->onUpdate('cascade');
            });
        }

        // =========================================================
        // 6. FK ulasans → tb_buku & users
        // =========================================================
        if (!$this->foreignKeyExists('ulasans', 'ulasans_id_buku_foreign')) {
            Schema::table('ulasans', function (Blueprint $table) {
                $table->foreign('id_buku')
                      ->references('id_buku')->on('tb_buku')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });
        }

        if (!$this->foreignKeyExists('ulasans', 'ulasans_user_id_foreign')) {
            Schema::table('ulasans', function (Blueprint $table) {
                $table->foreign('user_id')
                      ->references('id')->on('users')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });
        }
    }

    public function down(): void
    {
        if ($this->foreignKeyExists('tb_sirkulasi', 'tb_sirkulasi_user_id_foreign')) {
            Schema::table('tb_sirkulasi', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        if ($this->foreignKeyExists('tb_sirkulasi', 'tb_sirkulasi_id_buku_foreign')) {
            Schema::table('tb_sirkulasi', function (Blueprint $table) {
                $table->dropForeign(['id_buku']);
            });
        }

        if ($this->foreignKeyExists('tb_buku', 'tb_buku_id_kategori_foreign')) {
            Schema::table('tb_buku', function (Blueprint $table) {
                $table->dropForeign(['id_kategori']);
            });
        }

        if ($this->foreignKeyExists('favorit', 'favorit_id_buku_foreign')) {
            Schema::table('favorit', function (Blueprint $table) {
                $table->dropForeign(['id_buku']);
            });
        }

        Schema::table('favorit', function (Blueprint $table) {
            $table->string('id_buku', 255)->change();
            $table->foreign('id_buku')
                  ->references('id_buku')->on('tb_buku')
                  ->onDelete('cascade');
        });

        if ($this->foreignKeyExists('ulasans', 'ulasans_id_buku_foreign')) {
            Schema::table('ulasans', function (Blueprint $table) {
                $table->dropForeign(['id_buku']);
            });
        }

        if ($this->foreignKeyExists('ulasans', 'ulasans_user_id_foreign')) {
            Schema::table('ulasans', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
    }

    /**
     * Helper: cek apakah FK sudah exist di tabel tertentu
     */
    private function foreignKeyExists(string $table, string $fkName): bool
    {
        $result = DB::select("
            SELECT COUNT(*) as count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = DATABASE()
              AND CONSTRAINT_NAME = ?
              AND TABLE_NAME = ?
              AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ", [$fkName, $table]);

        return $result[0]->count > 0;
    }
};