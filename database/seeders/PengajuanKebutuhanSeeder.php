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
        DB::table('pengajuan_kebutuhan')->insert([
            [
                'id_pengajuan_kebutuhan' => '2',
                'id_pemohon' => '2',
                'nama_kegiatan' => 'Perbaikan Gedung D',
                'tujuan' => 'Bertujuan guna meningkatkan fasilitas, memperbaiki kehidupan, mensejahterakan rakyat',
                'waktu' => '2023-11-18',
                'total_dana_kebutuhan' => '2000000',
            ],
        ]);
    }
}
