<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Jenis_Pengeluaran $jenis_pengeluaran)
    {
        //
        $data = [
            'jenis_pengeluaran'=> $jenis_pengeluaran->all()
        ];
        return view('dashboard-bendahara.jenis-pengeluaran.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard-bendahara.jenis-pengeluaran.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, jenis_pengeluaran $jenis_pengeluaran)
    {
        //
        $data = $request->validate(
            [
                'kategori'=> ['required'],
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
    public function show(jenis_pengeluaran $jenis_pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request, jenis_pengeluaran $jenis_pengeluaran)
    {
        //
        $data = [
            'jenis_pengeluaran' =>  jenis_pengeluaran::where('id_jenis_pengeluaran', $id)->first()
        ];

        return view('dashboard-bendahara.jenis-pengeluaran.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jenis_pengeluaran $jenis_pengeluaran)
    {
        //
        $data = $request->validate([
            'kategori' => ['required'],
        ]);

        $id_jenis_pengeluaran = $request->input('id_jenis_pengeluaran');

        if ($id_jenis_pengeluaran !== null) {
            // Process Update
            // DB::beginTransaction();
            // try {
            // $dataUpdate = $jenis_pengeluaran->where('id_jenis_pengeluaran', $id_jenis_pengeluaran)->update($data);
            //     DB::commit();
            //     return redirect('dashboard-bendahara/jenis-pengeluaran')->with('success', 'Data jenis pengeluaran berhasil diupdate');
            // } catch(Exception $e) {
            //     DB::rollback();
            //     dd($e->getMessage());
            $dataUpdate = $jenis_pengeluaran->where('id_jenis_pengeluaran', $id_jenis_pengeluaran)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/jenis-pengeluaran')->with('success', 'Data jenis pengeluaran berhasil di update');
            } else {
                return back()->with('error', 'Data jenis pengeluaran gagal di update');
            }
        }}
    // }}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis_pengeluaran $jenis_pengeluaran,  Request $request)
    {
        //
        $id_jenis_pengeluaran = $request->input('id_jenis_pengeluaran');

        // Hapus 
        $aksi = $jenis_pengeluaran->where('id_jenis_pengeluaran', $id_jenis_pengeluaran)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data jenis pengeluaran berhasil dihapus'
            ];
        } else {
            // Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }
    
}
