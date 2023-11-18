<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pengeluaran extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('pengeluaran')->insert([
            [
                'id_bendahara' => 1,
                'id_sumber_dana' => 1,
                'id_jenis_pengeluaran' => 1,
                'nama' => 'Realisasi Kebutuhan UKOM',
                'nominal' => 10000000,00,
                'waktu' => '2023-10-20 12:00:00',
            ],
        ]);
    }
}


