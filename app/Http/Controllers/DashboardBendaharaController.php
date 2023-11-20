<?php

namespace App\Http\Controllers;
use App\Models\pemasukan;
use Illuminate\Http\Request;

class DashboardBendaharaController extends Controller
{
    //
    public function index()
    {
        $data = [
            'pemasukan'=>pemasukan::with(['sumber_dana', 'akun'])->get(),
        ];
        return view('dashboard-bendahara.index', $data);
    }
}
