<?php

namespace App\Http\Controllers;

use App\Models\perencanaan_keuangan;
use App\Models\pengajuan_kebutuhan;
use App\Models\sumber_dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerencanaanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        $data = [
            'perencanaan_keuangan' => $perencanaan_keuangan->all()
        ];

        return view('dashboard-bendahara.perencanaan-keuangan.index', $data);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( perencanaan_keuangan $perencanaan_keuangan, pengajuan_kebutuhan $pengajuan_kebutuhan, sumber_dana $sumber_dana)
    {
        $data = [
            'pengajuan_kebutuhan' => $pengajuan_kebutuhan->all(),
            'perencanaan_keuangan' => $perencanaan_keuangan->all(),
            'sumber_dana' => $sumber_dana->all(),

        ];

        return view('dashboard-bendahara.perencanaan-keuangan.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        //
        $data = $request->validate(
            [
                'id_pengajuan_kebutuhan'=> ['required'],
                'id_sumber_dana'=> ['required'],
                'judul_perencanaan'=> ['required'],
                'waktu'=> ['required'],
                'tujuan'=> ['required'],
                'total_dana_keuangan'=> ['required'],
            ]
        );

       //Proses Insert
       if ($data) {
        // Simpan jika data terisi semua
        $perencanaan_keuangan->create($data);
        return redirect('dashboard-bendahara/perencanaan-keuangan')->with('success', 'Data Sumber Dana baru berhasil ditambah');
    } else {
        // Kembali ke form tambah data
        return back()->with('error', 'Data Sumber Dana gagal ditambahkan');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(perencanaan_keuangan $perencanaan_keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(perencanaan_keuangan $perencanaan_keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(perencanaan_keuangan $perencanaan_keuangan)
    {
        //
    }
}
