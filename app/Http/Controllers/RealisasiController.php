<?php

namespace App\Http\Controllers;

use App\Models\jenis_realisasi;
use App\Models\perencanaan_keuangan;
use App\Models\realisasi;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(realisasi $realisasi)
    {
        $data = [
            'realisasi' => $realisasi->all()
        ];

        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            return view('dashboard-bendahara.realisasi.index', $data);
        }
        elseif($role == 'pemohon') {
            return view('dashboard-pemohon.realisasi.index', $data);
        }
    }

    public function print(realisasi $realisasi)
    {
        $data = [
            'realisasi' => $realisasi->all()
        ];
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            $pdf = PDF::loadView('dashboard-bendahara.realisasi.print', $data);
        }
        elseif($role == 'pemohon') {
            $pdf = PDF::loadView('dashboard-pemohon.realisasi.print', $data);
        }

        return $pdf->stream();
    }
    public function print_item(realisasi $realisasi, pengeluaran $pengeluaran, String $id)
    {
        $data = [
            'realisasi'=> realisasi::where('id_realisasi', $id)->first(),
            'pengeluaran' => $pengeluaran::all(),
            'item_perencanaan'=> DB::table('item_perencanaan')
            ->join('gedung', 'item_perencanaan.id_gedung', '=', 'gedung.id_gedung')
            ->join('pengeluaran', 'item_perencanaan.id_pengeluaran', '=', 'pengeluaran.id_pengeluaran')
            ->where('item_perencanaan.id_realisasi', $id)
            ->get(),
        ];
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            $pdf = PDF::loadView('dashboard-bendahara.realisasi.print-item', $data);
        }
        elseif($role == 'pemohon') {
            $pdf = PDF::loadView('dashboard-pemohon.realisasi.print-item', $data);
        }

        return $pdf->stream();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id, pengeluaran $pengeluaran)
    {
        $data = [
            'realisasi'=> realisasi::where('id_realisasi', $id)->first(),
            'pengeluaran' => $pengeluaran::all(),
            'item_perencanaan'=> DB::table('item_perencanaan')
            ->join('gedung', 'item_perencanaan.id_gedung', '=', 'gedung.id_gedung')
            ->join('pengeluaran', 'item_perencanaan.id_pengeluaran', '=', 'pengeluaran.id_pengeluaran')
            ->where('item_perencanaan.id_realisasi', $id)
            ->get(),
        ];

        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            return view('dashboard-bendahara.realisasi.detail', $data);
        }
        elseif($role == 'pemohon') {
            return view('dashboard-pemohon.realisasi.detail', $data);
        }
    }
  
}