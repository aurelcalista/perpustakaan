<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbBukuTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tb_buku')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('tb_buku')->insert([

            /*
            ===============================
            KATEGORI 1 - NOVEL
            ===============================
            */

            [
                'id_buku' => 'B001',
                'judul_buku' => 'Bumi',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'th_terbit' => '2014',
                'id_kategori' => 1,
                'penyunting' => 'Tim Editor Gramedia',
                'edisi' => 'Cetakan ke-1',
                'deskripsi_fisik' => '440 halaman ; 20 cm',
                'isbn' => '9786020331218',
                'bahasa' => 'Indonesia',
                'call_number' => '813 TER b',
                'sinopsis' => 'Raib memiliki kemampuan menghilang dan menemukan dunia paralel.',
                'foto' => 'cover_buku/bumi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_buku' => 'B002',
                'judul_buku' => 'Bulan',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'th_terbit' => '2015',
                'id_kategori' => 1,
                'penyunting' => 'Tim Editor Gramedia',
                'edisi' => 'Cetakan ke-1',
                'deskripsi_fisik' => '400 halaman ; 20 cm',
                'isbn' => '9786020331676',
                'bahasa' => 'Indonesia',
                'call_number' => '813 TER b',
                'sinopsis' => 'Petualangan Raib dan kawan-kawan berlanjut.',
                'foto' => 'cover_buku/bulan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_buku' => 'B003',
                'judul_buku' => 'Matahari',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'th_terbit' => '2016',
                'id_kategori' => 1,
                'penyunting' => 'Tim Editor Gramedia',
                'edisi' => 'Cetakan ke-1',
                'deskripsi_fisik' => '428 halaman ; 20 cm',
                'isbn' => '9786020332741',
                'bahasa' => 'Indonesia',
                'call_number' => '813 TER m',
                'sinopsis' => 'Rahasia klan Matahari mulai terungkap.',
                'foto' => 'cover_buku/matahari.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            ===============================
            KATEGORI 2 - MAPEL KELAS 11
            ===============================
            */

            [
                'id_buku' => 'B004',
                'judul_buku' => 'Matematika SMK Kelas 11 Kurikulum Merdeka',
                'pengarang' => 'Dicky Susanto, dkk.',
                'penerbit' => 'Kementrian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                'th_terbit' => '2021',
                'id_kategori' => 2,
                'penyunting' => 'Tri Hartini',
                'edisi' => 'Kurikulum Merdeka',
                'deskripsi_fisik' => '152 halaman ; 17,6 x 25 cm',
                'isbn' => '978-602-244-536-4',
                'bahasa' => 'Indonesia',
                'call_number' => '510 ARI m',
                'sinopsis' => 'Materi barisan deret, trigonometri lanjutan, statistika dan peluang.',
                'foto' => 'cover_buku/matematika11.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_buku' => 'B005',
                'judul_buku' => 'Bahasa Indonesia Kelas 11 Kurikulum Merdeka',
                'pengarang' => 'Heny Marwati & K. Waskitaningtyas',
                'penerbit' => 'Kementrian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                'th_terbit' => '2021',
                'id_kategori' => 2,
                'penyunting' => 'Ahid Hidayat',
                'edisi' => 'Kurikulum Merdeka',
                'deskripsi_fisik' => '230 halaman ; 17,6 x 25 cm',
                'isbn' => '978-602-244-324-7',
                'bahasa' => 'Indonesia',
                'call_number' => '410 IRM b',
                'sinopsis' => 'Membahas berbagai jenis teks dan karya sastra berbasis literasi.',
                'foto' => 'cover_buku/bindo11.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_buku' => 'B006',
                'judul_buku' => 'Pendidikan Agama Islam dan Budi Pekerti Kelas 11 Kurikulum Merdeka',
                'pengarang' => 'Abd. Rahman & Hery Nugroho',
                'penerbit' => 'Kementrian Pendidikan, Kebudayaan, Riset, dan Teknologi',
                'th_terbit' => '2021',
                'id_kategori' => 2,
                'penyunting' => 'Agus Imam Kharomen',
                'edisi' => 'Kurikulum Merdeka',
                'deskripsi_fisik' => '356 halaman ; 17,6 x 25 cm',
                'isbn' => '9786020000013',
                'bahasa' => 'Indonesia',
                'call_number' => '420 OTO b',
                'sinopsis' => 'Membahas nilai-nilai keimanan, akhlak mulia, toleransi, serta penerapan ajaran Islam dalam kehidupan sehari-hari guna membentuk karakter peserta didik yang beriman dan berakhlak baik.',
                'foto' => 'cover_buku/pai11.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            ===============================
            KATEGORI 3 - KEJURUAN
            ===============================
            */

            [
                'id_buku' => 'B007',
                'judul_buku' => 'Rekayasa Perangkat Lunak',
                'pengarang' => 'Rosa A.S & M. Shalahuddin',
                'penerbit' => 'Informatika',
                'th_terbit' => '2018',
                'id_kategori' => 3,
                'penyunting' => 'Tim Editor Informatika',
                'edisi' => 'Revisi',
                'deskripsi_fisik' => '596 halaman ; 23 cm',
                'isbn' => '9786026232656',
                'bahasa' => 'Indonesia',
                'call_number' => '005.1 ROS r',
                'sinopsis' => 'Analisis dan desain sistem menggunakan UML dan manajemen proyek.',
                'foto' => 'cover_buku/rpl.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_buku' => 'B008',
                'judul_buku' => 'Pemrograman Laravel',
                'pengarang' => 'Ade Rahmat Iskandar',
                'penerbit' => 'Gramedia',
                'th_terbit' => '2024',
                'id_kategori' => 3,
                'penyunting' => 'Tim Editor Gramedia',
                'edisi' => 'Cetakan ke-1',
                'deskripsi_fisik' => '350 halaman ; 23 cm',
                'isbn' => '9786020000014',
                'bahasa' => 'Indonesia',
                'call_number' => '005.13 ADE p',
                'sinopsis' => 'Belajar Laravel dari dasar hingga membangun project nyata.',
                'foto' => 'cover_buku/laravel.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_buku' => 'B009',
                'judul_buku' => 'Pemrograman Python & MySQL',
                'pengarang' => 'Abdul Kadir',
                'penerbit' => 'Elex Media',
                'th_terbit' => '2023',
                'id_kategori' => 3,
                'penyunting' => 'Tim Editor Elex',
                'edisi' => 'Cetakan ke-1',
                'deskripsi_fisik' => '280 halaman ; 23 cm',
                'isbn' => '9786020000015',
                'bahasa' => 'Indonesia',
                'call_number' => '005.75 ABD p',
                'sinopsis' => 'Mempelajari koneksi Python dengan database MySQL dan operasi CRUD.',
                'foto' => 'cover_buku/python.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ===== KBBI =====
            [
                'id_buku' => 'B023',
                'judul_buku' => 'Kamus Besar Bahasa Indonesia Edisi Kelima',
                'pengarang' => 'Pusat Bahasa Kemendikbud',
                'penerbit' => 'Balai Pustaka',
                'th_terbit' => '2016',
                'id_kategori' => 4,
                'penyunting' => 'Badan Pengembangan dan Pembinaan Bahasa',
                'edisi' => 'Edisi Kelima',
                'deskripsi_fisik' => 'xxviii + 1628 halaman ; 27 cm',
                'isbn' => '978-979-407-182-1',
                'bahasa' => 'Indonesia',
                'call_number' => '499.221 KAM',
                'sinopsis' => 'Kamus Besar Bahasa Indonesia Edisi Kelima memuat lebih dari 90.000 lema dan sublema beserta definisi, ejaan, dan contoh penggunaannya. Merupakan rujukan utama bahasa Indonesia yang baku dan standar, disusun oleh Badan Pengembangan dan Pembinaan Bahasa.',
                'foto' => 'cover_buku/kamus.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ===== KAMUS INGGRIS-INDONESIA =====
            [
                'id_buku' => 'B024',
                'judul_buku' => 'Kamus Inggris - Indonesia Edisi yang Diperbarui',
                'pengarang' => 'John M. Echols & Hassan Shadily',
                'penerbit' => 'Gramedia Pustaka Utama',
                'th_terbit' => '2014',
                'id_kategori' => 4,
                'penyunting' => 'John U. Wolff & James T. Collins',
                'edisi' => 'Edisi yang Diperbarui',
                'deskripsi_fisik' => 'xxxii + 824 halaman ; 23 cm',
                'isbn' => '978-602-030-564-6',
                'bahasa' => 'Indonesia & Inggris',
                'call_number' => '423.3 ECH k',
                'sinopsis' => 'Kamus Inggris-Indonesia terlengkap karya John M. Echols dan Hassan Shadily yang telah direvisi dan diperbarui. Memuat lebih dari 31.000 entri dilengkapi contoh kalimat, penjelasan arti kata dalam disiplin ilmu tertentu, dan singkatan umum dalam bahasa Inggris.',
                'foto' => 'cover_buku/kamusinggris.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        
            // ===== ENSIKLOPEDIA =====
            [
                'id_buku' => 'B026',
                'judul_buku' => 'Ensiklopedia Sejarah Dunia',
                'pengarang' => 'Tim Usborne',
                'penerbit' => 'Bhuana Ilmu Populer',
                'th_terbit' => '2018',
                'id_kategori' => 4,
                'penyunting' => 'Tim Editor BIP',
                'edisi' => 'Edisi Revisi',
                'deskripsi_fisik' => 'xii + 312 halaman ; 28 cm',
                'isbn' => '978-602-XXX-XXX-X',
                'bahasa' => 'Indonesia',
                'call_number' => '900 TIM e',
                'sinopsis' => 'Ensiklopedia Sejarah Dunia ini memuat berbagai fakta dan kisah tentang berbagai bangsa, tempat, dan peristiwa pada masa lalu yang membentuk dunia. Dilengkapi skema bergambar selama 12.000 tahun, lebih dari 100 peta, ilustrasi, grafik, dan foto yang lengkap.',
                'foto' => 'cover_buku/ensiklopedia.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

          
        ]);
    }
}