<?php

namespace App\Http\Controllers;

use App\Models\item_perencanaan;
use App\Models\perencanaan_keuangan;
use App\Models\gedung;
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
    public function create(String $id, Request $request, perencanaan_keuangan $perencanaan_keuangan, gedung $gedung)
    {
        //
        $data = [
            'perencanaan_keuangan' => $perencanaan_keuangan::where('id_perencanaan_keuangan', $id)->first(),
            'gedung' => $gedung->all()
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
                'id_gedung' => ['required'],
                'item_perencanaan' => ['required'],
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
                return redirect('/dashboard-bendahara/perencanaan_keuangan')->with('success','Data Perencanaan Keuangan Berhasil di update');
            }else{
                return back()->with('error','Data Perencanaan Keuangan Gagal di update');
            }
        }
        else{
            //Proses Insert
            if($data):
              
            //Simpan jika data terisi semua
                $item_perencanaan->create($data);
                return redirect('/dashboard-bendahara/perencanaan-keuangan')->with('success','Data Item Perencanaan Berhasil di Tambah');
            else:
            //Kembali ke form tambah data
                return back()->with('error','Data Item Gagal di Tambahkan');
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
    public function edit(string $id,item_perencanaan $item_perencanaan, perencanaan_keuangan $perencanaan_keuangan, gedung $gedung)
    {
        //
        $data = [
            'item_perencanaan' => $item_perencanaan::where('id_item_perencanaan', $id)->first(),
            'perencanaan_keuangan' => $perencanaan_keuangan->all(),
            'gedung' => $gedung->all()
        ];
        return view('dashboard-bendahara.item-perencanaan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, item_perencanaan $item_perencanaan)
    {
        //
        $id_item_perencanaan = $request->input('id_item_perencanaan');
        $id_perencanaan_keuangan = $request->input('id_perencanaan_keuangan');
        $data = $request->validate(
            [
                'id_gedung' => ['required'],
                'item_perencanaan' => ['required'],
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

            $data['foto_barang_perencanaan'] = $foto_nama;
        }
        // Process Update
        $dataUpdate = $item_perencanaan->where('id_item_perencanaan', $id_item_perencanaan)->update($data);

        if ($dataUpdate) {
            return redirect('dashboard-bendahara/perencanaan-keuangan/detail/' . $id_perencanaan_keuangan)->with('success', 'Data Item Perencanaan berhasil di update');
        } else {
            return back()->with('error', 'Data Item Perancanaan gagal di update');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(item_perencanaan $item_perencanaan, Request $request)
    {
        //
        $id_item_perencanaan = $request->input('id_item_perencanaan');

        // Hapus 
        $aksi = $item_perencanaan->where('id_item_perencanaan', $id_item_perencanaan)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data berhasil dihapus'
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