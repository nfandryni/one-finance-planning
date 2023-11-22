<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AkunPemohonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemohon')->insert([
            [
                'user_id' => '2',
                'email' => 'pemohon@gmail.com',
                'jabatan' => 'Kaprog',
                'foto_profil' => 'Ak023asdfop3dsdwd',
            ],
        ]);
    }
}
