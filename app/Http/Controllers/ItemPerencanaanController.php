<?php

namespace App\Http\Controllers;

use App\Models\item_perencanaan;
use App\Models\perencanaan_keuangan;
use Illuminate\Http\Request;

class ItemPerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        //
        $data = [
            'perencanaan_keuangan' => $perencanaan_keuangan->all(),
        ];
        return view('dashboard-bendahara.item-perencanaan.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, item_perencanaan $item_perencanaan)
    {
        //
        $data = $request->validate(
            [
                'id_perencanaan_keuangan' => ['required'],
                'item_kebutuhan' => ['required'],
                'qty'    => ['required'],
                'harga_satuan' => ['required'],
                'satuan' => ['required'],
                'spesifikasi' => ['required'],
                'bulan_rencana_realisasi' => ['required'],
                'foto_barang_perencanaan' => 'sometimes|file',
            ]
        );

        if ($request->hasFile('foto_barang_perencanaan')) {
            $foto_file = $request->file('foto_barang_perencanaan');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto_barang_perencanaan'] = $foto_nama;
        }
        if($request->input('id_item_perencanaan') !== null ){
            
            //Proses Update
            $dataUpdate = item_perencanaan::where('id_item_perencanaan',$request->input('id_item_perencanaan'))
                            ->update($data);
            if($dataUpdate){
                return redirect('/dashboard-bendahara/perencanaan_keuangan')->with('success','Data Perencanaan Keuangan Berhasil di Update');
            }else{
                return back()->with('error','Data Perencanaan Keuangan Gagal di Update');
            }
        }
        else{
            //Proses Insert
            if($data):
              
            //Simpan jika data terisi semua
                $item_perencanaan->create($data);
                return redirect('/dashboard-bendahara/perencanaan_keuangan')->with('success','Data Item Perencanaan Berhasil di Tambah');
            else:
            //Kembali ke form tambah data
                return back()->with('error','Data Item P Gagal di Tambahkan');
            endif;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(item_perencanaan $item_perencanaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(item_perencanaan $item_perencanaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, item_perencanaan $item_perencanaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(item_perencanaan $item_perencanaan)
    {
        //
    }
}
