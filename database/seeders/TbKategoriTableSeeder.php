<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbKategoriTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_kategori')->delete();
        
        \DB::table('tb_kategori')->insert(array (
            0 => 
            array (
                'id_kategori' => 1,
                'nama_kategori' => 'buku',
                'created_at' => '2026-02-10 07:34:40',
                'updated_at' => '2026-02-10 07:34:40',
            ),
            1 => 
            array (
                'id_kategori' => 2,
                'nama_kategori' => 'novel',
                'created_at' => '2026-02-10 07:35:04',
                'updated_at' => '2026-02-10 07:35:04',
            ),
        ));
        
        
    }
}