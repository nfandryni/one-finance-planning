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
        return view('dashboard-bendahara.gedung.tambah');
        //
        return view('dashboard-pemohon.gedung.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, gedung $gedung)
    {
            [
                'nama_gedung'    => ['required'],
                'nama_ruangan'    => ['required'],
    public function store(Request $request, Gedung $gedung)
    {
        $data = $request->validate(
            [
                'nama_gedung' => ['required'],
                'nama_ruangan' => ['required']
            ]
        );
        //Proses Insert
        if (DB::statement("CALL tambah_gedung(?, ?)", ([$data['nama_gedung'], $data['nama_ruangan']]))) {
            // Simpan jika data terisi semua
            return redirect('dashboard-bendahara/gedung')->with('success', 'Data Gedung baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data Gedung gagal ditambahkan');
        if ($data) {
            // Simpan jika data terisi semua
            return redirect('dashboard-pemohon/gedung')->with('success', 'Data gedung baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data sumber dana gagal ditambahkan');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            'gedung' =>  gedung::where('id_gedung', $id)->first()
        ];
        return view('dashboard-bendahara.gedung.edit', $data);
    public function edit(string $id, gedung $gedung)
    {
        {
            //
            $data = [
                'gedung' => gedung::where('id_gedung', $id)->first()
            ];
    
            return view('dashboard-pemohon.gedung.edit', $data);
        }
    }

     * Update the specified resource in storage.
     */
    public function update(Request $request, gedung $gedung)
    {
        $data = $request->validate(
            [
                'nama_ruangan'    => ['required'],
            ]
            );
        //
        $data = $request->validate([
            'nama_ruangan' => ['required'],
        ]);

        $id_gedung = $request->input('id_gedung');
        if ($id_gedung !== null) {
            $dataUpdate = $gedung->where('id_gedung', $id_gedung)->update($data);

                return redirect('dashboard-bendahara/gedung')->with('success', 'Data Gedung berhasil diupdate');
            } else {
                return back()->with('error', 'Data Gedung gagal diupdate');
            // Process Update
            $dataUpdate = $gedung->where('id_gedung', $id_gedung)->update($data);
            if ($dataUpdate) {
                return redirect('dashboard-pemohon/gedung')->with('success', 'Data gedung berhasil di update');
            } else {
                return back()->with('error', 'Data gedung gagal di update');
            }
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(gedung $gedung, Request $request)
    {
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
                'pesan'   => 'Data Gedung berhasil dihapus'
        } else {
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }
}