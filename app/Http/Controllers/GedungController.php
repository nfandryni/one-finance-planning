<?php

namespace App\Http\Controllers;

use App\Models\gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(gedung $gedung)
    {
        $data = [
            'gedung' => $gedung->all()
        ];
        return view('dashboard-bendahara.gedung.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-bendahara.gedung.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, gedung $gedung)
    {

        $nama_ruangan = $request->input('nama_ruangan');
        $data = $request->validate(
            [
                'nama_gedung'    => ['required'],
                'nama_ruangan'    => ['required'],
            ]
        );

        $exist = DB::table('gedung')
        ->where('nama_ruangan', '=', $nama_ruangan)
        ->get();

        if($exist->isEmpty() && DB::statement("CALL tambah_gedung(?, ?)", ([$data['nama_gedung'], $data['nama_ruangan']]))) {
            return redirect('dashboard-bendahara/gedung')->with('success', 'Data Gedung telah berhasil ditambahkan!');
        } else {
            return back()->with('error', 'Data Gedung gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'gedung' =>  gedung::where('id_gedung', $id)->first()
        ];
        return view('dashboard-bendahara.gedung.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, gedung $gedung)
    {
        $data = $request->validate(
            [
                'nama_gedung'    => ['required'],
                'nama_ruangan'    => ['required'],
            ]
            );

        $id_gedung = $request->input('id_gedung');
        $nama_ruangan = $request->input('nama_ruangan');

        $exist = DB::table('gedung')
        ->where('nama_ruangan', '=', $nama_ruangan)
        ->get();

        if ($exist->isEmpty() && $id_gedung !== null) {
            $dataUpdate = $gedung->where('id_gedung', $id_gedung)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/gedung')->with('success', 'Data Gedung telah berhasil diperbarui!');
            } else {
                return back()->with('error', 'Data Gedung gagal diperbarui!');
            }
        }
        else {
            return back()->with('error', 'Ruangan telah ada!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(gedung $gedung, Request $request)
    {
        $id_gedung = $request->input('id_gedung');

        $aksi = $gedung->where('id_gedung', $id_gedung)->delete();

        if ($aksi) {
            $pesan = [
                'success' => true,
                'pesan'   => 'Data Gedung telah berhasil dihapus!'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus!'
            ];
        }

        return response()->json($pesan);
    }
}