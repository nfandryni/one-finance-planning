<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemPerencanaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('item_perencanaan')->insert([
            [
                'id_perencanaan_keuangan' => '2',
                'id_realisasi' => '1',
                'item_perencanaan' => 'Tang',
                'qty' => 12,
                'harga_satuan' => 20000,
                'satuan' => 'pcs',
                'spesifikasi' => 'Mahal',
                'bulan_rencana_realisasi' => '2023-11-19',
                'status' => 'Belum Dibeli',
                'foto_barang_perencanaan' => 'cia2469n!df',
            ],
        ]);
    }
    }

