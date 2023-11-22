<?php

namespace App\Http\Controllers;
use App\Models\pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardBendaharaController extends Controller
{
    //
    public function index()
    {
        $totalBOS =  DB::select('SELECT total_dana_BOS() AS totalBOS')[0]->totalBOS;
        $totalBOPD =  DB::select('SELECT total_dana_BOPD() AS totalBOPD')[0]->totalBOPD;
        $totalKomite =  DB::select('SELECT total_dana_komite() AS totalKomite')[0]->totalKomite;
        $totalDana =  DB::select('SELECT total_dana_anggaran() AS totalDana')[0]->totalDana;
        $data = [
            'jumlahBOS'=>$totalBOS,
            'jumlahBOPD'=>$totalBOPD,
            'jumlahKomite'=>$totalKomite,
            'jumlahDana'=>$totalDana,
            'pemasukan'=>pemasukan::with(['sumber_dana', 'akun'])->get()
        ];
        return view('dashboard-bendahara.index', $data);
    }
}
