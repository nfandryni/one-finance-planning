<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use App\Models\pengeluaran;
use App\Models\perencanaan_keuangan;
use App\Models\realisasi;
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
    public function create(realisasi $realisasi, perencanaan_keuangan $perencanaan_keuangan, pengeluaran $pengeluaran)
    {
        $data = [
            'realisasi' => $realisasi->all(),
            'perencanaan_keuangan' => $perencanaan_keuangan->all(),
            'pengeluaran' => $pengeluaran->all(),

        ];

        return view('dashboard-bendahara.realisasi.tambah', $data);
    }

    public function store(Request $request, realisasi $realisasi, pengeluaran $pengeluaran)
    {
        $data = $request->validate([
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
    public function show(string $id, pengeluaran $pengeluaran)
    {
        //
        $data = [
            'realisasi' => DB::table('realisasi')
            ->join('pengeluaran', 'realisasi.id_pengeluaran', '=', 'pengeluaran.id_pengeluaran')
            ->join('item_perencanaan', 'item_perencanaan.id_realisasi', '=', 'item_perencanaan.id_realisasi')
            ->get(),
            'item_perencanaan' => DB::table('item_perencanaan')->get(),
            'pengeluaran' => DB::table('pengeluaran')
          
        ];

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
        $realisasiData = realisasi::where('id_realisasi', $id)->first();

        return view('dashboard-bendahara.realisasi.edit-realisasi', [
            'realisasi' => $realisasiData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_realisasi(Request $request, realisasi $realisasi)
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

        if (!$data) {
            return response()->json(['success' => false, 'pesan' => 'Data tidak ditemukan'], 404);
        }

     
        return response()->json(['success' => false, 'pesan' => 'Data gagal dihapus']);
    }
}