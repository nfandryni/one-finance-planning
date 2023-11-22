<?php

namespace App\Http\Controllers;

use App\Models\perencanaan_keuangan;
use App\Models\pengajuan_kebutuhan;
use App\Models\sumber_dana;
use Illuminate\Http\Request;

class PerencanaanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(perencanaan_keuangan $perencanaan_keuangan)
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
            'perencanaan_keuangan' => $perencanaan_keuangan->all(),
            'pengajuan_kebutuhan' => $pengajuan_kebutuhan->all(),
            'sumber_dana' => $sumber_dana->all(),

        ];

        return view('dashboard-bendahara.perencanaan-keuangan.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate(
            [
                'tujuan'=> ['required'],
                'waktu'=> ['required'],
                'total_dana_pemabayaran'=> ['required'],
            ]
        );

        //Proses Insert
        if (DB::statement("CALL tambah_jenis_pengeluaran(?)", ([$data['kategori']]))) {
            // Simpan jika data terisi semua
            $jenis_pengeluaran->create($data);
            return redirect('dashboard-bendahara/jenis-pengeluaran')->with('success', 'Data jenis pengeluaran baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data jenis pengeluaran gagal ditambahkan');
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
