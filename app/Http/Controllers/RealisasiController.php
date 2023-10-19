<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use App\Models\pengeluaran;
use App\Models\realisasi;
use Illuminate\Http\Request;

class RealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'realisasi' => $realisasi->all()
        ];

        return view('dashboard-bendahara.realisasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $realisasi = $realisasi->all();

        return view('dashboard-bendahara.realisasi.tambah', [
            'realisasi' => $realisasi,
        ]);
    }

    public function store(Request $request, realisasi $realisasi, pengeluaran $pengeluaran)
    {
        $data = $request->validate([
            // 'tanggal_surat' => 'required',
            'id_pengeluaran' => 'required',
            'judul_realisasi' => 'required',
            'tujuan' => 'required',
            'waktu' => 'required',
            'total_pembayaran' => 'required',
        ]);

        // $user = Auth::user();
        // $data['id_user'] = $user->id_user;

        // if ($request->hasFile('file')) {
        //     $foto_file = $request->file('file');
        //     $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
        //     $foto_file->move(public_path('foto'), $foto_nama);
        //     $data['file'] = $foto_nama;
        // }

        if ($realisasi->create($data)) {
            return redirect('/dashboard-bendahara/realisasi')->with('success', 'Data realisasi baru berhasil ditambah');
        }

        return back()->with('error', 'Data surat gagal ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(realisasi $realisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(realisasi $realisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, realisasi $realisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(realisasi $realisasi)
    {
        //
    }
}
