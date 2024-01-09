<?php

namespace App\Http\Controllers;

use App\Models\perencanaan_keuangan;
use App\Models\pengajuan_kebutuhan;
use App\Models\sumber_dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PerencanaanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        $data = [
            'perencanaan_keuangan' => $perencanaan_keuangan->all()
        ];

        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            return view('dashboard-bendahara.perencanaan-keuangan.index', $data);
        }
        elseif($role == 'admin') {
            return view('admin.perencanaan.index', $data);
        }
    }  

    /**
     * Show the form for creating a new resource.
     */
    public function create( perencanaan_keuangan $perencanaan_keuangan, pengajuan_kebutuhan $pengajuan_kebutuhan, sumber_dana $sumber_dana)
    {
        $data = [
            'pengajuan_kebutuhan' => $pengajuan_kebutuhan->all(),
            'perencanaan_keuangan' => $perencanaan_keuangan->all(),
            'sumber_dana' => $sumber_dana->all(),

        ];

        return view('dashboard-bendahara.perencanaan-keuangan.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        //
        $data = $request->validate(
            [
                'id_pengajuan_kebutuhan'=> ['required'],
                'id_sumber_dana'=> ['required'],
                'judul_perencanaan'=> ['required'],
                'tujuan'=> ['required'],
                'waktu'=> ['required'],
                'total_dana_perencanaan'=> ['required'],
            ]
        );

       //Proses Insert
       if ($data) {
       
        // Simpan jika data terisi semua
        $perencanaan_keuangan->create($data);
        // dd($data);
        return redirect('dashboard-bendahara/perencanaan-keuangan')->with('success', 'Data Perencanaan Keuangan baru berhasil ditambah');
    } else {
        // Kembali ke form tambah data
        return back()->with('error', 'Data Perencanaan Keuangan gagal ditambahkan');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(perencanaan_keuangan $perencanaan_keuangan,item_perencanaan $item_perencanaan, string $id,)
    {
        //
        $data = [
            'perencanaan_keuangan'=> perencanaan_keuangan::where('id_perencanaan_keuangan', $id)->first(),

            'item_perencanaan'=> DB::table('view_perencanaan_keuangan')
            ->where('view_perencanaan_keuangan.id_perencanaan_keuangan', $id)
            ->get(),
        ];
        return view('dashboard-bendahara.perencanaan-keuangan.detail', $data);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $id, perencanaan_keuangan $perencanaan_keuangan, pengajuan_kebutuhan $pengajuan_kebutuhan, sumber_dana $sumber_dana)
    {
        //
        
        $data = [
            'perencanaan_keuangan' => $perencanaan_keuangan::where('id_perencanaan_keuangan', $id)->first(),
            'pengajuan_kebutuhan' => $pengajuan_kebutuhan->all(),
            'sumber_dana' => $sumber_dana->all(),

        ];

        return view('dashboard-bendahara.perencanaan-keuangan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        //
        $data = $request->validate(
            [
                'id_pengajuan_kebutuhan'=> ['required'],
                'id_sumber_dana'=> ['required'],
                'judul_perencanaan'=> ['required'],
                'tujuan'=> ['required'],
                'waktu'=> ['required'],
                'total_dana_perencanaan'=> ['required'],
            ]
        );
        $id_perencanaan_keuangan = $request->input('id_perencanaan_keuangan');

        if ($id_perencanaan_keuangan !== null) {
            // Process Update
            $dataUpdate = $perencanaan_keuangan->where('id_perencanaan_keuangan', $id_perencanaan_keuangan)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/perencanaan-keuangan')->with('success', 'Data berhasil di update');
            } else {
                return back()->with('error', 'Data gagal di update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(perencanaan_keuangan $perencanaan_keuangan, Request $request)
    {
        //
        {
            //
            $id_perencanaan_keuangan = $request->input('id_perencanaan_keuangan');
    
            // Hapus 
            $aksi = $perencanaan_keuangan->where('id_perencanaan_keuangan', $id_perencanaan_keuangan)->delete();
    
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

    public function print()
    {
        $data = [
        ];

       
            $pdf = PDF::loadView('admin.perencanaan.print');

            return $pdf->stream();
        
    }
    public function detail ()
    {
        
        return view('admin.perencanaan.detail');
        
    }
}
