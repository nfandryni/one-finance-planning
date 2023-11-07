<?php


namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class JenisPengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('jenis_pengeluaran')->insert([
            [
                'kategori' => 'sarana'
            ],
        ]);
    }
}


