<?php

namespace App\Http\Controllers;

use App\Models\realisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(realisasi $realisasi)
    {
        $data = [
            'realisasi' => $realisasi->all()
        ];

        return view('dashboard-bendahara.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(realisasi $realisasi)
    {
        $realisasi = $realisasi->all();

        return view('dashboard-bendahara.tambah', [
            'realisasi' => $realisasi,
        ]);
    }

    public function store(Request $request, realisasi $realisasi)
    {
        $data = $request->validate([
            // 'tanggal_surat' => 'required',
            'id_pengeluaran' => 'required',
            'judul_realisasi' => 'required',
            'tujuan' => 'required',
            'waktu' => 'required',
            'total_pembayaran' => 'required',
        ]);

        // $user = Auth::user();
        // $data['id_user'] = $user->id_user;

        // if ($request->hasFile('file')) {
        //     $foto_file = $request->file('file');
        //     $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
        //     $foto_file->move(public_path('foto'), $foto_nama);
        //     $data['file'] = $foto_nama;
        // }

        if ($realisasi->create($data)) {
            return redirect('/dashboard-bendahara/realisasi')->with('success', 'Data realisasi baru berhasil ditambah');
        }

        return back()->with('error', 'Data surat gagal ditambahkan');
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
    public function edit(string $id, realisasi $realisasi)
    {
        $realisasiData = realisasi::where('id_realisasi', $id)->first();

        return view('dashboard-bendahara.edit', [
            'realisasi' => $realisasiData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, realisasi $realisasi)
    {
        $id_realisasi = $request->input('id_realisasi');

        $data = $request->validate([
            'judul_realisasi' => 'sometimes',
            'tujuan' => 'sometimes',
            'waktu' => 'sometimes|file',
            'total_pembayaran' => 'sometimes',
        ]);

        if ($id_realisasi !== null) {
          
            $dataUpdate = $realisasi->where('id_realisasi', $id_realisasi)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/realisasi')->with('success', 'Data realisasi berhasil diupdate');
            }

            return back()->with('error', 'Data jenis realisasi gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(realisasi $realisasi, Request $request)
    {
        $id_realisasi = $request->input('id_realisasi');
        $data = realisasi::find($id_realisasi)->delete();

        if (!$data) {
            return response()->json(['success' => false, 'pesan' => 'Data tidak ditemukan'], 404);
        }

     
        return response()->json(['success' => false, 'pesan' => 'Data gagal dihapus']);
    }
}