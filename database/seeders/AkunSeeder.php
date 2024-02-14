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
        DB::table('gedung')->insert([
            [
                'nama_gedung' => 'D',
                'nama_ruangan' => 'D1',
            ],
        ]);
        DB::table('sumber_dana')->insert([
            [
                'nama_sumber' => 'BPOD'
            ],
        ]);
        DB::table('jenis_pengeluaran')->insert([
            [
                'kategori' => 'sarana'
            ],
        ]);
        DB::table('pengajuan_kebutuhan')->insert([
            [
                'id_pemohon' => 1,
                'id_sumber_dana' => '1',
                'nama_kegiatan' => 'valo',
                'tujuan' => 'gas',
                'status' => 'Difilterisasi',
                'waktu' => '2024-02-14',
                'kedaluwarsa' => null,
                'total_dana_kebutuhan' => null,
            ],
        ]);
        DB::table('item_kebutuhan')->insert([
            [
                'id_pengajuan_kebutuhan' => '1',
                'id_gedung' => '1',
                'item_kebutuhan' => 'mouse',
                'qty' => '1233',
                'harga_satuan' => '12333',
                'satuan' => '12333',
                'spesifikasi' => '2024-02-14',
                'bulan_rencana_realisasi' => null,
                'status' => 'Diterima',
                'kedaluwarsa' => null,
                'foto_barang_kebutuhan' => 'kursi.jpg',
            ],
        ]);
        DB::table('item_kebutuhan')->insert([
            [
                'id_pengajuan_kebutuhan' => '1',
                'id_gedung' => '1',
                'item_kebutuhan' => 'keyboard',
                'qty' => '1233',
                'harga_satuan' => '12333',
                'satuan' => '12333',
                'spesifikasi' => '2024-02-14',
                'bulan_rencana_realisasi' => null,
                'status' => 'Diterima',
                'kedaluwarsa' => null,
                'foto_barang_kebutuhan' => 'kursi.jpg',
            ],
        ]);
    }
}


