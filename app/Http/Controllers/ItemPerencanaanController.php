<?php

namespace App\Http\Controllers;

use App\Models\item_perencanaan;
use App\Models\perencanaan_keuangan;
use App\Models\gedung;
use App\Models\pengeluaran;
use Illuminate\Support\Facades\DB;
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
            
            $dataUpdate = item_perencanaan::where('id_item_perencanaan',$request->input('id_item_perencanaan'))
                            ->update($data);
            if($dataUpdate){
                return redirect('/dashboard-bendahara/perencanaan_keuangan')->with('success','Data Perencanaan Keuangan Berhasil di update');
            }else{
                return back()->with('error','Data Perencanaan Keuangan Gagal di update');
            }
        }
        else{
            if($data):
              
                $item_perencanaan->create($data);
                return redirect('/dashboard-bendahara/perencanaan-keuangan')->with('success','Data Item Perencanaan Berhasil di Tambah');
            else:
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

        $id_perencanaan_keuangan = $item_perencanaan::where('id_item_perencanaan', $id)
        ->select('id_perencanaan_keuangan')
        ->first();
        $data = [
            'item_perencanaan' => $item_perencanaan::where('id_item_perencanaan', $id)
            ->join('gedung', 'item_perencanaan.id_gedung', '=', 'gedung.id_gedung')
            ->first(),
            'perencanaan_keuangan' => $perencanaan_keuangan::where('id_perencanaan_keuangan', $id_perencanaan_keuangan->id_perencanaan_keuangan)->first(),
            'pengeluaran' => pengeluaran::all()
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
        
        $status = $request->input('status');
        if($status == 'Belum Dibeli') {
        $data = $request->validate(
            [
                'id_gedung' => ['required'],
                'item_perencanaan' => ['required'],
                'qty'    => ['required'],
                'harga_satuan' => ['required'],
                'satuan' => ['required'],
                'spesifikasi' => ['required'],
                'id_pengeluaran' => ['sometimes'],
                'status' => ['required'],
                'bulan_rencana_realisasi' => ['required'],
                'foto_barang_perencanaan' => 'sometimes|file',
                'foto_realisasi' => 'sometimes|file',
            ]
        );
    } elseif($status == 'Terbeli') {
            $data = $request->validate(
                [
                    'id_gedung' => ['required'],
                    'item_perencanaan' => ['required'],
                    'qty'    => ['required'],
                    'harga_satuan' => ['required'],
                    'satuan' => ['required'],
                    'spesifikasi' => ['required'],
                    'id_pengeluaran' => ['required'],
                    'status' => ['required'],
                    'bulan_rencana_realisasi' => ['required'],
                    'foto_barang_perencanaan' => 'sometimes|file',
                    'foto_realisasi' => 'sometimes|file',
                ]
            );
        }

        if ($request->hasFile('foto_barang_perencanaan')) {
            $foto_file = $request->file('foto_barang_perencanaan');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto_barang_perencanaan'] = $foto_nama;
        }
        if ($request->hasFile('foto_realisasi')) {
            $foto_file = $request->file('foto_realisasi');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto_realisasi'] = $foto_nama;
        }
        $dataUpdate = $item_perencanaan->where('id_item_perencanaan', $id_item_perencanaan)->update($data);

        if ($dataUpdate) {
            if($data['status'] == 'Terbeli') {
                $idRealisasi = DB::table('realisasi')
                ->select('id_realisasi')
                ->where('id_perencanaan_keuangan', '=', $id_perencanaan_keuangan)
                ->first();
                $dataUpdate = $item_perencanaan->where('id_item_perencanaan', $id_item_perencanaan)->update(['id_realisasi' => $idRealisasi->id_realisasi]);
            }

                return redirect('dashboard-bendahara/perencanaan-keuangan/detail/' . $id_perencanaan_keuangan)->with('success', 'Data Item Perencanaan berhasil di update');
        } else {
            return back()->with('error', 'Data Item Perencanaan gagal di update');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(item_perencanaan $item_perencanaan, Request $request)
    {
        //
        $id_item_perencanaan = $request->input('id_item_perencanaan');

        $aksi = $item_perencanaan->where('id_item_perencanaan', $id_item_perencanaan)->delete();

        if ($aksi) {
            $pesan = [
                'success' => true,
                'pesan'   => 'Data berhasil dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }
}