<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajuanKebutuhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('item_perencanaan')->insert([
            [
                'id_perencanaan_keuangan' => '1',
                'id_realisasi' => '1',
                'judul_perencanaan' => 'Perbaikan Gedung D',
                'tujuan' => 'Bertujuan guna meningkatkan fasilitas, memperbaiki kehidupan, mensejahterakan rakyat',
                'waktu' => '2023-11-18',
                'total_dana_perencanaan' => '2000000',
            ],
        ]);
    }
}
