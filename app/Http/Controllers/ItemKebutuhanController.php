<?php

namespace App\Http\Controllers;

use App\Models\gedung;
use App\Models\item_kebutuhan;
use App\Models\pengajuan_kebutuhan;
use Illuminate\Http\Request;

class ItemKebutuhanController extends Controller
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
    public function create(pengajuan_kebutuhan $pengajuan_kebutuhan, gedung $gedung)
    {
        //
        $data = [
            'pengajuan_kebutuhan' => $pengajuan_kebutuhan->all(),
            'gedung' => $gedung->all()
        ];
        return view('dashboard-pemohon.item-kebutuhan.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, item_kebutuhan $item_kebutuhan)
    {
        //
        $data = $request->validate(
            [
                'id_pengajuan_kebutuhan' => ['required'],
                'id_gedung' => ['required'],
                'item_kebutuhan' => ['required'],
                'qty'    => ['required'],
                'harga_satuan' => ['required'],
                'satuan' => ['required'],
                'spesifikasi' => ['required'],
                'foto_barang_kebutuhan' => ['required'],
            ]
        );

        if ($request->hasFile('foto_barang_kebutuhan')) {
            $foto_file = $request->file('foto_barang_kebutuhan');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto_barang_kebutuhan'] = $foto_nama;
        }


       
        if($request->input('id_item_kebutuhan') !== null ){
            //Proses Update
            $dataUpdate = item_kebutuhan::where('id_item_kebutuhan',$request->input('id_item_kebutuhan'))
                            ->update($data);
            if($dataUpdate){
                return redirect('/dashboard-pemohon/pengajuan-kebutuhan')->with('success','Data Pengajuan Kebutuhan berhasil di update');
            }else{
                return back()->with('error','Data Pengajuan Kebutuhan gagal di update');
            }
        }
        else{
            //Proses Insert
            if($data):
              
            //Simpan jika data terisi semua
                $item_kebutuhan->create($data);
                return redirect('/dashboard-pemohon/pengajuan-kebutuhan')->with('success','Data Pengajuan Kebutuhan baru berhasil ditambah');
            else:
            //Kembali ke form tambah data
                return back()->with('error','Data Pengajuan Kebutuhan gagal ditambahkan');
            endif;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(item_kebutuhan $item_kebutuhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(item_kebutuhan $item_kebutuhan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, item_kebutuhan $item_kebutuhan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(item_kebutuhan $item_kebutuhan)
    {
        //
    }
}
