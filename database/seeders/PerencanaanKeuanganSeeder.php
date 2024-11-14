<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerencanaanKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('perencanaan_keuangan')->insert([
            [
                'id_pengajuan_kebutuhan' => '1',
                'id_sumber_dana' => '1',
                'judul_perencanaan' => 'Perbaikan Gedung',
                'tujuan' => 'Implementasi dari Program Kerja Kepala Sekolah',
                'waktu' => '2023-11-18',
                'total_dana_perencanaan' => '2000000',
            ],
        ]);
    }
}
