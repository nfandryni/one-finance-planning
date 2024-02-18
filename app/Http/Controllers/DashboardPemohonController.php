<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengajuan_kebutuhan;
use App\Models\realisasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardPemohonController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index(pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        $user = Auth::user()->user_id;
        $data = [
            'pengajuan_kebutuhan'=> DB::table('view_pengajuan_pemohon')->get(),
            'realisasi' => realisasi::all()
        ];
        return view('dashboard-pemohon.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
