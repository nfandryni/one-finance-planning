<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_kebutuhan;
use Illuminate\Http\Request;
use App\Models\realisasi;


class DashboardPemohonController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index(pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        $data = [
            'pengajuan_kebutuhan' => $pengajuan_kebutuhan->all(),
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
