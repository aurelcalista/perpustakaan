<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbKategoriTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tb_kategori')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('tb_kategori')->insert(array (
            0 => 
            array (
                'id_kategori' => 1,
                'nama_kategori' => 'Koleksi Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            1 => 
            array (
                'id_kategori' => 2,
                'nama_kategori' => 'Akademik',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            2 => 
            array (
                'id_kategori' => 3,
                'nama_kategori' => 'Program Keahlian',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            3 => 
            array (
                'id_kategori' => 4,
                'nama_kategori' => 'Referensi',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
        
        
    }
}