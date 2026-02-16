<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
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
        ));
        
        
    }
}