<?php

namespace App\Http\Controllers;

use App\Models\perencanaan_keuangan;
use App\Models\pengajuan_kebutuhan;
use App\Models\sumber_dana;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;

class PerencanaanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        $data = [
            'perencanaan_keuangan' => $perencanaan_keuangan
            ->join('sumber_dana', 'sumber_dana.id_sumber_dana', 'perencanaan_keuangan.id_sumber_dana')
            ->get(),
        ];

        return view('dashboard-bendahara.perencanaan-keuangan.index', $data);    
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
    public function print_item(pengeluaran $pengeluaran, String $id)
    {
        $data = [
            'pengajuan_kebutuhan'=> pengajuan_kebutuhan::where('id_pengajuan_kebutuhan'),
            'perencanaan_keuangan'=> perencanaan_keuangan::where('id_perencanaan_keuangan', $id)
            ->join('sumber_dana', 'sumber_dana.id_sumber_dana', 'perencanaan_keuangan.id_sumber_dana')
            ->first(),
            'item_perencanaan'=> DB::table('item_perencanaan')
            ->join('gedung', 'item_perencanaan.id_gedung', '=', 'gedung.id_gedung')
            ->where('item_perencanaan.id_perencanaan_keuangan', $id)
            ->get(),
        ];
        
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            $pdf = PDF::loadView('dashboard-bendahara.perencanaan-keuangan.print-item', $data);
        }
        // elseif($role == 'admin') {
        //     $pdf = PDF::loadView('dashboard-pemohon.perencanaan-keuangan.print-item', $data);
        // }

        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, perencanaan_keuangan $perencanaan_keuangan)
    {
        //
        $data = $request->validate(
            [
                'id_sumber_dana'=> ['required'],
                'judul_perencanaan'=> ['required'],
                'tujuan'=> ['required'],
                'waktu'=> ['required'],
            ]
        );

        $exist = DB::table('perencanaan_keuangan')
        ->where('judul_perencanaan', '=', $data['judul_perencanaan'])
        ->where('tujuan', '=', $data['tujuan'])
        ->where('waktu', '=', $data['waktu'])
        ->exists();

       if ($data && !$exist) {
        $perencanaan_keuangan->create($data);
        return redirect('dashboard-bendahara/perencanaan-keuangan')->with('success', 'Data Perencanaan Keuangan telah berhasil ditambahkan!');
    } else {
        return back()->with('error', 'Data Perencanaan Keuangan gagal ditambahkan!');
    }
    }

    /**
     * Display the specified resource.
     */
    public function print(perencanaan_keuangan $perencanaan_keuangan)
    {
        $data = [
            'perencanaan_keuangan' => $perencanaan_keuangan->join('sumber_dana', 'sumber_dana.id_sumber_dana', 'perencanaan_keuangan.id_sumber_dana')
            ->get()
        ];
        $pdf = PDF::loadView('dashboard-bendahara.perencanaan-keuangan.print', $data);

        return $pdf->stream();
    }
     public function show(pengeluaran $pengeluaran, String $id) {    
        $data = [
            'pengajuan_kebutuhan'=> pengajuan_kebutuhan::where('id_pengajuan_kebutuhan'),
            'perencanaan_keuangan'=> perencanaan_keuangan::where('id_perencanaan_keuangan', $id)
            ->join('sumber_dana', 'sumber_dana.id_sumber_dana', 'perencanaan_keuangan.id_sumber_dana')
            ->first(),
            
            'item_perencanaan'=> DB::table('item_perencanaan')
            ->join('gedung', 'item_perencanaan.id_gedung', '=', 'gedung.id_gedung')
            ->where('item_perencanaan.id_perencanaan_keuangan', $id)
            ->get(),
        ];

        return view('dashboard-bendahara.perencanaan-keuangan.detail', $data);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $id, perencanaan_keuangan $perencanaan_keuangan, pengajuan_kebutuhan $pengajuan_kebutuhan, sumber_dana $sumber_dana)
    {

        $data = [
            'perencanaan_keuangan' => $perencanaan_keuangan::where('id_perencanaan_keuangan', $id)
            ->first(),
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
                'id_pengajuan_kebutuhan'=> ['sometimes'],
                'id_sumber_dana'=> ['required'],
                'judul_perencanaan'=> ['required'],
                'tujuan'=> ['required'],
                'waktu'=> ['required'],
            ]
        );
        $id_perencanaan_keuangan = $request->input('id_perencanaan_keuangan');

        if ($id_perencanaan_keuangan !== null) {
            $dataUpdate = $perencanaan_keuangan->where('id_perencanaan_keuangan', $id_perencanaan_keuangan)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/perencanaan-keuangan')->with('success', 'Data Perencanaan Keuangan telah berhasil diperbarui!');
            } else {
                return back()->with('error', 'Data Perencanaan Keuangan gagal diperbarui!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(perencanaan_keuangan $perencanaan_keuangan, Request $request)
    {

        $id_perencanaan_keuangan = $request->input('id_perencanaan_keuangan');
        $cekStatus = DB::select("SELECT COUNT(*) as count FROM item_perencanaan WHERE id_perencanaan_keuangan = ? AND status = 'Terbeli'", [$id_perencanaan_keuangan]);
        if($cekStatus[0]->count >= 1) {
            $pesan = [
                'success' => false,
                'pesan'   => 'Perencanaan ini Telah menjadi Realisasi!'
            ];
        }
        else {
            $aksi = $perencanaan_keuangan->where('id_perencanaan_keuangan', $id_perencanaan_keuangan)->delete();
            if ($aksi) {
                $pesan = [
                    'success' => true,
                    'pesan'   => 'Data Perencanaan Keuangan telah berhasil dihapus!'
                ];
            } else {
                $pesan = [
                    'success' => false,
                    'pesan'   => 'Data Perencanaan Keuangan gagal dihapus!'
                ];
            }
        }
    
            return response()->json($pesan);
    }
}