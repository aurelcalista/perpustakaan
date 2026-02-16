<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbBukuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_buku')->delete();
        
        \DB::table('tb_buku')->insert(array (
            0 => 
            array (
                'id_buku' => 'B001',
                'judul_buku' => 'Hujann',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'th_terbit' => '2016',
                'id_kategori' => 2,
                'penyunting' => 'Tim Editor Gramedia',
                'edisi' => 'Cetakan ke-1',
                'deskripsi_fisik' => 'x + 318 halaman ; 20 cm',
                'isbn' => '978-602-033-295-6',
                'bahasa' => 'Indonesia',
                'call_number' => '813 TER h',
                'sinopsis' => 'Novel Hujan menceritakan kisah Lail dan Esok yang bertemu setelah bencana gempa dahsyat menghancurkan kota mereka. Di tengah kehilangan dan perubahan dunia akibat bencana, keduanya tumbuh bersama, belajar tentang persahabatan, harapan, dan perasaan yang perlahan berubah menjadi cinta. Cerita ini menggambarkan tentang kehilangan, kenangan, serta keberanian untuk melangkah maju dan melupakan masa lalu demi masa depan yang lebih baik.',
                'foto' => 'cover_buku/AUlrsnyOxKOLtxl3S3bRNTsLFWR01FD3YGUyqOg7.jpg',
                'created_at' => '2026-02-10 10:57:53',
                'updated_at' => '2026-02-10 11:05:08',
            ),
        ));
        
        
    }
}