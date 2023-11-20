<?php

namespace App\Http\Controllers;

use App\Models\gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Gedung $gedung, Request $request)
    {
        //
        $data = [
            'gedung'=> $gedung->all()
        ];
        return view('dashboard-pemohon.gedung.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard-pemohon.gedung.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Gedung $gedung)
    {
        //
        $data = $request->validate(
            [
                'nama_gedung' => ['required'],
                'nama_ruangan' => ['required']
            ]
        );

        //Proses Insert
        if ($data) {
            // Simpan jika data terisi semua
            $gedung->create($data);
            return redirect('dashboard-pemohon/gedung')->with('success', 'Data Gedung Berhasil di Tambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data Gedung Gagal di Tambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(gedung $gedung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, gedung $gedung)
    {
        //
        {
            //
            $data = [
                'gedung' => gedung::where('id_gedung', $id)->first()
            ];
    
            return view('dashboard-pemohon.gedung.edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, gedung $gedung)
    {
        //
        $data = $request->validate([
            'nama_gedung' => ['required'],
            'nama_ruangan' => ['required'],
        ]);

        $id_gedung = $request->input('id_gedung');

        if ($id_gedung !== null) {
            // Process Update
            $dataUpdate = $gedung->where('id_gedung', $id_gedung)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-pemohon/gedung')->with('success', 'Data Gedung Gerhasil di Update');
            } else {
                return back()->with('error', 'Data Gedung Gagal di Update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, gedung $gedung)
    {
        //
        $id_gedung = $request->input('id_gedung');

        // Hapus 
        $aksi = $gedung->where('id_gedung', $id_gedung)->delete();

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
