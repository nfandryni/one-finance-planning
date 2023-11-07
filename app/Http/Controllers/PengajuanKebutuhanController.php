<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_kebutuhan;
use Illuminate\Http\Request;

class PengajuanKebutuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pengajuan_Kebutuhan $pengajuan_kebutuhan)
    {
        //
        $data = [
            'pengajuan_kebutuhan'=> $pengajuan_kebutuhan->all()
        ];
        return view('pengajuan-kebutuhan.index',$data);
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
    public function store(Pengajuan_Kebutuhan $pengajuan_kebutuhan, Request $request)
    {
        //
        $data = $request->validate(
            [
                'nama_kegiatan' => ['required'],
                'pemohon' => ['required'],
                'waktu'    => ['required'],
                'tujuan' => ['required'],
            ]
        );
        if($request->input('id_pengajuan_kebutuhan') !== null ){
            //Proses Update
            $dataUpdate = Pengajuan_Kebutuhan::where('id_pengajuan_kebutuhan',$request->input('id_pengajuan_kebutuhan'))
                            ->update($data);
            if($dataUpdate){
                return redirect('/dashboard/pengajuan-kebutuhan')->with('success','Data Pengajuan Kebutuhan berhasil di update');
            }else{
                return back()->with('error','Data Pengajuan-Kebutuhan gagal di update');
            }
        }
        else{
            //Proses Insert
            if($data):
                $data['id_pmohon'] = 1;
            //Simpan jika data terisi semua
                $pengajuan_kebutuhan->create($data);
                return redirect('/dashboard/pengajuan-kebutuhan')->with('success','Data Pengajuan Kebutuhan baru berhasil ditambah');
            else:
            //Kembali ke form tambah data
                return back()->with('error','Data Pengajuan Kebutuhan gagal ditambahkan');
            endif;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        //
    }
}
