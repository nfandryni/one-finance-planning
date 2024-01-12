<?php

namespace App\Http\Controllers;

use App\Models\jenis_realisasi;
use App\Models\perencanaan_keuangan;
use App\Models\realisasi;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class RealisasiController extends Controller {

    public function index(realisasi $realisasi)
    {
        $data = [
            'realisasi' => $realisasi->all()
        ];
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
        return view('dashboard-bendahara.realisasi.index', $data);
        }
        elseif($role == 'admin') {
            return view('admin.realisasi.index', $data);

        }
        elseif($role == 'pemohon') {
            return view('dashboard-pemohon.realisasi.index', $data);
        }
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

        if ($realisasi->create($data)) {
            return redirect('/dashboard-bendahara/realisasi')->with('success', 'Data realisasi baru berhasil ditambah');
        }

        return back()->with('error', 'Data surat gagal ditambahkan');
    }

    public function print(realisasi $realisasi)
    {
        $data = [
            'realisasi' => $realisasi->all()
        ];
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            $pdf = PDF::loadView('dashboard-bendahara.realisasi.print', $data);
        }
        elseif($role == 'pemohon') {
            $pdf = PDF::loadView('dashboard-pemohon.realisasi.print', $data);
        }
        elseif($role == 'admin') {
            $pdf = PDF::loadView('admin.realisasi.print', $data);
        }
        return $pdf->stream();
    }
    public function print_item(realisasi $realisasi, pengeluaran $pengeluaran, String $id)
    {
        $data = [
            'realisasi'=> realisasi::where('id_realisasi', $id)->first(),
            'pengeluaran' => $pengeluaran::all(),
            'item_perencanaan'=> DB::table('item_perencanaan')
            ->join('gedung', 'item_perencanaan.id_gedung', '=', 'gedung.id_gedung')
            ->join('pengeluaran', 'item_perencanaan.id_pengeluaran', '=', 'pengeluaran.id_pengeluaran')
            ->where('item_perencanaan.id_realisasi', $id)
            ->get(),
        ];
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            $pdf = PDF::loadView('dashboard-bendahara.realisasi.print-item', $data);
        }
        elseif($role == 'pemohon') {
            $pdf = PDF::loadView('dashboard-pemohon.realisasi.print-item', $data);
        }
        elseif($role == 'admin') {
            $pdf = PDF::loadView('admin.realisasi.print-item', $data);
        }
        return $pdf->stream();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id, pengeluaran $pengeluaran)
    {
        $data = [
            'realisasi'=> realisasi::where('id_realisasi', $id)->first(),
            'pengeluaran' => $pengeluaran::all(),
            'item_perencanaan'=> DB::table('item_perencanaan')
            ->join('gedung', 'item_perencanaan.id_gedung', '=', 'gedung.id_gedung')
            ->join('pengeluaran', 'item_perencanaan.id_pengeluaran', '=', 'pengeluaran.id_pengeluaran')
            ->where('item_perencanaan.id_realisasi', $id)
            ->get(),
        ];

        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            return view('dashboard-bendahara.realisasi.detail', $data);
        }
        elseif($role == 'pemohon') {
            return view('dashboard-pemohon.realisasi.detail', $data);
        }
        elseif($role == 'admin') {
            return view('admin.realisasi.detail', $data);
        }
    }

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
        $aksi = $realisasi->where('id_realisasi', $id_realisasi)->delete();
        if ($aksi) {
            $pesan = [
                'success' => true,
                'pesan'   => 'Data Pemasukan berhasil dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }

    public function printAdmin()
    {
        
            $pdf = PDF::loadView('admin.realisasi.print');
            return $pdf->stream();
        
    }

    public function detail ()
    {
        
        return view('admin.realisasi.detail');
        
    }
}