<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdmin extends Controller
{
    public function index()
    {
        $totalDana =  DB::select('SELECT total_pemasukan() AS totalDana')[0]->totalDana;
        $data = [
            'pemasukan'=>DB::table('view_pemasukan')->get(),
            'jumlahDana'=>$totalDana,
        ];
        return view("admin.index", $data);
        
    }
}
