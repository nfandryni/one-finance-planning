<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AkunBendaharaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('bendahara_sekolah')->insert([
            [
                'user_id' => '1',
                'email' => 'bendahara@gmail.com',
                'jabatan' => 'Administrasi',
                'foto_profil' => 'Ak023asdfop3dsdwd',
            ],
        ]);
    }
}


