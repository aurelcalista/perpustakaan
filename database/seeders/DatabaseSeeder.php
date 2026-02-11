<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder yang udah di-generate dari database lama
        $this->call([
            TbKategoriTableSeeder::class,
            TbBukuTableSeeder::class,
            UsersTableSeeder::class,  
        ]);
    }
}