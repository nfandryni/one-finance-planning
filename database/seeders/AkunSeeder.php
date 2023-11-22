<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    
    public function run()
    {
        // ->insert merupakan eloquent orm
        DB::table('akun')->insert([
            [
                'username' => 'bendahara',
                'password' => Hash::make('123'),
                'role' => 'bendaharasekolah',
            ],
            [
                'username' => 'pemohon',
                'password' => Hash::make('123'),
                'role' => 'pemohon',
            ],
            [
                'username' => 'superadmin',
                'password' => Hash::make('123'),
                'role' => 'superadmin',
            ],
            [
                'username' => 'admin',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ],
        ]);
    }
}


