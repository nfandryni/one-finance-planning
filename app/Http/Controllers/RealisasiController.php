<?php

namespace App\Http\Controllers;

use App\Models\jenis_realisasi;
use App\Models\perencanaan_keuangan;
use App\Models\realisasi;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

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

        return view('dashboard-bendahara.realisasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(pengeluaran $pengeluaran, perencanaan_keuangan $perencanaan_keuangan, realisasi $realisasi)
    {
        $data = [
            'pengeluaran' => $pengeluaran->all(),
            'perencanaan_keuangan' => $perencanaan_keuangan->all(),
            'realisasi' => $realisasi->all(),

        ];

        return view('dashboard-bendahara.realisasi.tambah', $data);
    }

    public function store(Request $request, pengeluaran $pengeluaran, realisasi $realisasi)
    {
        $data = $request->validate([
            'id_realisasi' => 'required',
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
    public function show(string $id, pengeluaran $pengeluaran)
    {
        //
        $data = [
            'pengeluaran' => $pengeluaran ? $pengeluaran->get() : null,
            'realisasi' => is_null($pengeluaran)
             ? realisasi::where('id_realisasi', $id)->first()
            : DB::table('view_realisasi')->where('view_realisasi.id_realisasi', $id)->first(),
            'item_realisasi' => is_null($pengeluaran)
            ? null
            : DB::table('view_item_realisasi')->where('view_item_realisasi.id_realisasi', $id)->get()
        ];
        
        // dd($data);
        return view('dashboard-bendahara.realisasi.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_realisasi(string $id, realisasi $realisasi, pengeluaran $pengeluaran)
    {
        $data = [
            'realisasi' => realisasi::where('id_realisasi', $id)->first(),
            'pengeluaran'=> $pengeluaran->get()

        ];

        return view('dashboard-bendahara.realisasi.edit-realisasi', $data);
    }

    public function edit_item(string $id, realisasi $realisasi)
    {
       $data = [
        'item' => DB::table('item_perencanaan')
        ->join('realisasi', 'item_perencanaan.id_realisasi', '=', 'realisasi.id_realisasi')
        ->where('item_perencanaan.id_realisasi', '=', $id)
        ->get()
       ];

        return view('dashboard-bendahara.realisasi.edit-realisasi', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_realisasi(Request $request, realisasi $realisasi)
    {
        $id_realisasi = $request->input('id_realisasi');

        $data = $request->validate([
            'id_perencanaan_keuangan' => 'sometimes',
            'judul_realisasi' => 'sometimes',
            'tujuan' => 'sometimes',
            'id_pengeluaran' => 'required',
            'waktu' => 'sometimes',
            'total_pembayaran' => 'sometimes',
        ]);

        if ($id_realisasi !== null) {
          
            $dataUpdate = $realisasi->where('id_realisasi', $id_realisasi)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/realisasi')->with('success', 'Data Realisasi berhasil diupdate');
            }

            return back()->with('error', 'Data Realisasi gagal diupdate');
        }
    }

    public function update_item(Request $request, realisasi $realisasi)
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

        if ($data) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data Pemasukan berhasil dihapus'
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