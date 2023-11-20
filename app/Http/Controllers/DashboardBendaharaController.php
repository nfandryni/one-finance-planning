<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardBendaharaController extends Controller
{
    //
    public function index()
    {

        return view('dashboard-bendahara.index');
    }
}
