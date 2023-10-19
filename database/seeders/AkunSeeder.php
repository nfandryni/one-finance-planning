<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

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
            // <!-- // Tambahkan data pengguna lain jika diperlukan -->
        ]);
    }
}


