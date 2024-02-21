<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\logs;
use App\Models\perencanaan_keuangan;

class DashboardAdmin extends Controller
{
    public function index()
    {
        
        $data = [
            'pemasukan'=>DB::table('view_pemasukan')->get(),
            'jumlahDana' =>  DB::select('SELECT total_dana_anggaran() AS totalDana')[0]->totalDana,
            'totalRealisasi' =>  DB::select('SELECT TotalRealisasi() AS totalBeliRealisasi')[0]
                            ->totalBeliRealisasi,
            'blm_realisasi' => DB::table('v_belum_terealisasi')
                            ->where('status','Belum Dibeli')
                            ->take(5)
                            ->get()
            ];
        return view("admin.index", $data);
        
    }

    public function riwayat(logs $logs)
    {
        $data = [
            'logs' => $logs->all()
        ];
        return view("admin.konfirmasi.log",  $data);

    }
}
