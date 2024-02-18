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
        $kategori = $request->input('kategori');
        $data = $request->validate(
            [
                'kategori'=> ['required'],
            ]
        );
        $exist = DB::table('jenis_pengeluaran')
        ->where('kategori', '=', $kategori)
        ->get();

        if($exist->isEmpty() && DB::statement("CALL tambah_jenis_pengeluaran(?)", ([$data['kategori']]))) {
            return redirect('dashboard-bendahara/jenis-pengeluaran')->with('success', 'Data Jenis Pengeluaran telah berhasil ditambahkan!');
        } else {
            return back()->with('error', 'Data Jenis Pengeluaran gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */

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
        $kategori = $request->input('kategori');

        $exist = DB::table('jenis_pengeluaran')
        ->where('kategori', '=', $kategori)
        ->get();

        if ($exist->isEmpty() && $id_jenis_pengeluaran !== null) {
            $dataUpdate = $jenis_pengeluaran->where('id_jenis_pengeluaran', $id_jenis_pengeluaran)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/jenis-pengeluaran')->with('success', 'Data Jenis Pengeluaran telah berhasil diperbarui!');
            } else {
                return back()->with('error', 'Data Jenis Pengeluaran gagal diperbarui!');
            }
        }
        else {
            return back()->with('error', 'Kategori telah ada!');
        }
    }
    // }}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis_pengeluaran $jenis_pengeluaran,  Request $request)
    {
        //
        $id_jenis_pengeluaran = $request->input('id_jenis_pengeluaran');

        $aksi = $jenis_pengeluaran->where('id_jenis_pengeluaran', $id_jenis_pengeluaran)->delete();

        if ($aksi) {
            $pesan = [
                'success' => true,
                'pesan'   => 'Data Jenis Pengeluaran telah berhasil dihapus!'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan'   => 'Data Jenis Pengeluaran gagal dihapus!'
            ];
        }

        return response()->json($pesan);
    }
    
}
