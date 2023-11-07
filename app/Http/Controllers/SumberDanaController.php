<?php

namespace App\Http\Controllers;

use App\Models\sumber_dana;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Sumber_Dana $sumber_dana, Request $request)
    {
        //
        $data = [
            'sumber_dana'=> $sumber_dana->all()
        ];
        return view('sumber-dana.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sumber-dana.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sumber_Dana $sumber_dana)
    {
        //
        $data = $request->validate(
            [
                'nama_sumber' => ['required'],
            ]
        );

        //Proses Insert
        if ($data) {
            // $data['id_jenis_pengeluaran'] = 1;
            // Simpan jika data terisi semua
            $sumber_dana->create($data);
            return redirect('dashboard-bendahara/sumber-dana')->with('success', 'Data sumber dana baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data sumber dana gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(sumber_dana $sumber_dana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, sumber_dana $sumber_dana)
    {
        //
        $data = [
            'sumber_dana' => sumber_dana::where('id_sumber_dana', $id)->first()
        ];

        return view('sumber-dana.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sumber_dana $sumber_dana)
    {
        //
        $data = $request->validate([
            'nama_sumber' => ['required'],
        ]);

        $id_sumber_dana = $request->input('id_sumber_dana');

        if ($id_sumber_dana !== null) {
            // Process Update
            $dataUpdate = $sumber_dana->where('id_sumber_dana', $id_sumber_dana)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/sumber-dana')->with('success', 'Data sumber dana berhasil di update');
            } else {
                return back()->with('error', 'Data sumber dana gagal di update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, sumber_dana $sumber_dana)
    {
        //
        $id_sumber_dana = $request->input('id_sumber_dana');

        // Hapus 
        $aksi = $sumber_dana->where('id_sumber_dana', $id_sumber_dana)->delete();

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
