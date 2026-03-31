<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('users')->delete();
        
        DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'nis' => '',
                'nama' => 'admin',
                'noidentitas' => '',
                'alamat' => 'cirebon',
                'notlp' => '088201492104',
                'email' => 'adminperpustakaan@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$66bnN8a/wCluWTtuOr/WeOCI2ggVx/NG7Mbo3njMbkSkQw8wvQBU2',
                'role' => 'admin',
                'remember_token' => 'uF1VcEMc5iSQmC14snOrmsY47F3qqsrbjFZelxquqedEDS8rBkAnLojeqbz3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            array (
                'id' => 2,
                'username' => null,
                'nis' => '12478293',
                'nama' => 'Adinda Meilia Putri',
                'noidentitas' => 'XI RPL 1',
                'alamat' => 'cirebon',
                'notlp' => '0811111111',
                'email' => 'adinda@gmail.com',
                'email_verified_at' => NULL,
                'password' => bcrypt('11111111'),
                'role' => 'siswa',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),

            array ( 
                'id' => 3,
                'username' => null,
                'nis' => '12439104',
                'nama' => 'Agnia Putri Erwanti',
                'noidentitas' => 'XI RPL 1',
                'alamat' => 'cirebon',
                'notlp' => '0822222222',
                'email' => 'agnia@gmail.com',
                'email_verified_at' => NULL,
                'password' => bcrypt('22222222'),
                'role' => 'siswa',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),

            array (
                'id' => 4,
                'username' => null,
                'nis' => '12409472',
                'nama' => 'Aurel Calista Maheswari',
                'noidentitas' => 'XI RPL 1',
                'alamat' => 'cirebon',
                'notlp' => '0833333333',
                'email' => 'arel@gmail.com',
                'email_verified_at' => NULL,
                'password' => bcrypt('33333333'),
                'role' => 'siswa',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),

            array (
                'id' => 5,
                'username' => null,
                'nis' => '12493749',
                'nama' => 'Cyra Ghasanna Nuraaqilah Yusup',
                'noidentitas' => 'XI RPL 1',
                'alamat' => 'cirebon',
                'notlp' => '0844444444',
                'email' => 'cyra@gmail.com',
                'email_verified_at' => NULL,
                'password' => bcrypt('44444444'),
                'role' => 'siswa',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),

            array (
                'id' => 6,
                'username' => null,
                'nis' => '12430125',
                'nama' => 'Kezhia Aurelia Andini',
                'noidentitas' => 'XI RPL 1',
                'alamat' => 'cirebon',
                'notlp' => '0855555555',
                'email' => 'kezhia@gmail.com',
                'email_verified_at' => NULL,
                'password' => bcrypt('55555555'),
                'role' => 'siswa',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}