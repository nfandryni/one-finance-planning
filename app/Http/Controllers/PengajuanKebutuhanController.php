<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_kebutuhan;
use App\Models\gedung;
use App\Models\item_kebutuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanKebutuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pengajuan_Kebutuhan $pengajuan_kebutuhan)
    {
        //Stored Function
        $data = [
           'totalList' => DB::select('SELECT total_pengajuan_kebutuhan() AS totalList')[0]->totalList,
            'pengajuan_kebutuhan'=> $pengajuan_kebutuhan->all()
        ];
        return view('dashboard-pemohon.pengajuan-kebutuhan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        return view('dashboard-pemohon.pengajuan-kebutuhan.tambah');
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
                'waktu'    => ['required'],
                'tujuan' => ['required'],
            ]
        );

        $user = Auth::user();
        $id_akun = $user->id_akun;
        $id_pemohon_array = DB::select("SELECT id_pemohon FROM pemohon WHERE id_akun = ? LIMIT 1", [$id_akun]);
        $id_pemohon = $id_pemohon_array[0]->id_pemohon;
        $data['id_pemohon'] = $id_pemohon;  
        if($request->input('id_pengajuan_kebutuhan') !== null ){
            //Proses Update
            $dataUpdate = Pengajuan_Kebutuhan::where('id_pengajuan_kebutuhan',$request->input('id_pengajuan_kebutuhan'))
                            ->update($data);
            if($dataUpdate){
                return redirect('/dashboard-pemohon/pengajuan-kebutuhan')->with('success','Data Pengajuan Kebutuhan Berhasil di Update');
            }else{
                return back()->with('error','Data Pengajuan Kebutuhan Gagal di Update');
            }
        }
        else{
            //Proses Insert
            if($data):
              
            //Simpan jika data terisi semua
                $pengajuan_kebutuhan->create($data);
                return redirect('/dashboard-pemohon/pengajuan-kebutuhan')->with('success','Data Pengajuan Kebutuhan  Berhasil di Tambah');
            else:
            //Kembali ke form tambah data
                return back()->with('error','Data Pengajuan Kebutuhan Gagal di Tambahkan');
            endif;
        }
    }

        /**
     * Display the specified resource.
     */
    public function show(pengajuan_kebutuhan $pengajuan_kebutuhan, item_kebutuhan $item_kebutuhan, string $id)
    {
        //  
        $data = [
            'pengajuan_kebutuhan'=> $pengajuan_kebutuhan->where('id_pengajuan_kebutuhan', $id)->get(),
            'item_kebutuhan'=> $item_kebutuhan->where('id_pengajuan_kebutuhan', $id)->get()      
        ];
        return view('dashboard-pemohon.pengajuan-kebutuhan.detail', $data);  
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,pengajuan_kebutuhan $pengajuan_kebutuhan, Request $request)
    {
        //
        $data = [
            'pengajuan_kebutuhan' => pengajuan_kebutuhan::where('id_pengajuan_kebutuhan', $id)->first()
        ];

        return view('dashboard-pemohon.pengajuan-kebutuhan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        //
        $data = $request->validate([

            'nama_kegiatan' => ['required'],
            'waktu'    => ['required'],
            'tujuan' => ['required'],
        ]);

        $id_pengajuan_kebutuhan = $request->input('id_pengajuan_kebutuhan');

        if ($id_pengajuan_kebutuhan !== null) {
            // Process Update
            $dataUpdate = $pengajuan_kebutuhan->where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-pemohon/pengajuan-kebutuhan')->with('success', 'Data Pengajuan Kebutuhan Berhasil di Update');
            } else {
                return back()->with('error', 'Data Pengajuan Kebutuhan Gagal di Update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengajuan_kebutuhan $pengajuan_kebutuhan, Request $request)
    {
        //
        $id_pengajuan_kebutuhan = $request->input('id_pengajuan_kebutuhan');

        // Hapus 
        $aksi = $pengajuan_kebutuhan->where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)->delete();

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
