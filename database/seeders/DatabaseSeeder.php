<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user admin
        User::create([
            'username' => 'admin',
            'nama' => 'Administrator',
            'email' => 'admin@smkn1cirebon.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'noidentitas' => '-',
            'alamat' => '-',
            'notlp' => '-',
        ]);

        // Buat user petugas
        User::create([
            'username' => 'petugas',
            'nama' => 'Petugas Perpustakaan',
            'email' => 'petugas@smkn1cirebon.sch.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'noidentitas' => '-',
            'alamat' => '-',
            'notlp' => '-',
        ]);
    }
}