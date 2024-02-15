<?php

namespace App\Http\Controllers;

use App\Models\sumber_dana;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(sumber_dana $sumber_dana)
    {
        // mengirim data ke view dashboard-bendahara>sumber-dana>index berupa
        // array dari model sumber_dana yang disimpan dalam variable data
        $data = [
            'sumber_dana' => $sumber_dana->all()
        ];
        return view('dashboard-bendahara.sumber-dana.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-bendahara.sumber-dana.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, sumber_dana $sumber_dana)
    {

        $nama_sumber = $request->input('nama_sumber');
        $data = $request->validate(
            [
                'nama_sumber'    => ['required'],
            ]
        );

        $exist = DB::table('sumber_dana')
        ->where('nama_sumber', '=', $nama_sumber)
        ->get();

        if($exist->isEmpty()) {
            $sumber_dana->create($data);
            return redirect('dashboard-bendahara/sumber-dana')->with('success', 'Data Sumber Dana baru berhasil ditambah');
        } else {
            return back()->with('error', 'Data Sumber Dana gagal ditambahkan');
        }
    }


    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request, sumber_dana $sumber_dana)
    {
        $data = [
            'sumber_dana' =>  sumber_dana::where('id_sumber_dana', $id)->first()
        ];

        return view('dashboard-bendahara.sumber-dana.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sumber_dana $sumber_dana)
    {
        $data = $request->validate(
            [
                'nama_sumber'    => ['required'],
            ]
            );

        $id_sumber_dana = $request->input('id_sumber_dana');
        $nama_sumber = $request->input('nama_sumber');

        $exist = DB::table('sumber_dana')
        ->where('nama_sumber', '=', $nama_sumber)
        ->get();

        if ($exist->isEmpty() && $id_sumber_dana !== null) {
            // Process Update
            $dataUpdate = $sumber_dana->where('id_sumber_dana', $id_sumber_dana)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/sumber-dana')->with('success', 'Data Sumber Dana berhasil di update');
            } else {
                return back()->with('error', 'Data Sumber Dana gagal di update');
            }
        } 
        else {
            return back()->with('error', 'Nama Sumber telah ada!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id_sumber_dana = $request->input('id_sumber_dana');

        $aksi = sumber_dana::where('id_sumber_dana', $id_sumber_dana)->delete();

        if ($aksi) {
            $pesan = [
                'success' => true,
                'pesan'   => 'Data Sumber Dana berhasil dihapus'
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