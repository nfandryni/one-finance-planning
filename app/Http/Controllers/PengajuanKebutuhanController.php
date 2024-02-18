<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_kebutuhan;
use App\Models\gedung;
use App\Models\item_kebutuhan;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengajuanKebutuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pengajuan_Kebutuhan $pengajuan_kebutuhan)
    {
        //Stored Function

        $user = Auth::user()->user_id;
        $data = [
            'totalList' => DB::select('SELECT total_pengajuan_kebutuhan() AS totalList')[0]->totalList,
            'pengajuan_kebutuhan'=> DB::table('view_pengajuan_pemohon')->get(),
            'pemohon'=>DB::table('view_pengajuan_pemohon')
            ->where('view_pengajuan_pemohon.user_id', $user)
            ->first()
        ];
        return view('dashboard-pemohon.pengajuan-kebutuhan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        return view('dashboard-pemohon.pengajuan-kebutuhan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Pengajuan_Kebutuhan $pengajuan_kebutuhan, Request $request)
    {
        //
        $data = $request->validate(
            [
                'nama_kegiatan' => ['required'],
                'tujuan' => ['required'],
            ]
        );
            
        $data['waktu'] = Carbon::now();

        $user = Auth::user();
        $id_akun = $user->user_id;
        $id_pemohon_array = DB::select("SELECT id_pemohon FROM pemohon WHERE user_id = ? LIMIT 1", [$id_akun]);
        $id_pemohon = $id_pemohon_array[0]->id_pemohon;
        $data['id_pemohon'] = $id_pemohon;  

        $exist = DB::table('pengajuan_kebutuhan')
        ->where('nama_kegiatan', '=', $data['nama_kegiatan'])
        ->where('tujuan', '=', $data['tujuan'])
        ->where(DB::raw('DATE(waktu)'), '=', $data['waktu']->format('Y-m-d'))
        ->where('id_pemohon', '=', $data['id_pemohon'])
        ->exists();

            if(!$exist) {

                if (DB::statement("CALL tambah_pengajuan_kebutuhan(?, ?, ?, ?)", ([$data['id_pemohon'], $data['nama_kegiatan'], $data['tujuan'], $data['waktu']]))):
                    return redirect('/dashboard-pemohon/pengajuan-kebutuhan')->with('success','Data Pengajuan Kebutuhan telah berhasil ditambahkan!');
                else:
                    return back()->with('error','Data Pengajuan Kebutuhan gagal ditambahkan!');
                endif;
            }
            else {
                return back()->with('error','Data Pengajuan Kebutuhan telah ada!');

            }
}

        public function print_item(String $id)
        {
        $data = [
            'pengajuan_kebutuhan'=> DB::table('view_pengajuan_pemohon')->where('id_pengajuan_kebutuhan', $id)->first(),
            'item_kebutuhan'=> DB::table('view_pengajuan_kebutuhan')
            ->where('view_pengajuan_kebutuhan.id_pengajuan_kebutuhan', '=', $id)
            ->where(function ($query) {
                $query->where('status', '-')
                ->orWhere('status', 'Diterima');
            })
            ->get(),
        ];

        $user = Auth::user();
        $role = $user->role;
       
        $pdf = PDF::loadView('dashboard-pemohon.pengajuan-kebutuhan.print-item', $data);

        return $pdf->stream();
        }
        
        /**
     * Display the specified resource.
     */
    public function show(pengajuan_kebutuhan $pengajuan_kebutuhan, item_kebutuhan $item_kebutuhan, string $id, gedung $gedung)
    {
        $data = [
            'pengajuan_kebutuhan'=> DB::table('view_pengajuan_pemohon')->where('id_pengajuan_kebutuhan', $id)->first(),
            'item_kebutuhan'=> DB::table('view_pengajuan_kebutuhan')
            ->where('view_pengajuan_kebutuhan.id_pengajuan_kebutuhan', $id)
            ->get(),
        ];
        return view('dashboard-pemohon.pengajuan-kebutuhan.detail', $data);  
    }

    public function send(Request $request, pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        $id_pengajuan_kebutuhan = $request->input('id_pengajuan_kebutuhan');
        $status = $request->input('status');

        $dataUpdate = $pengajuan_kebutuhan->where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)->update(['status' => $status]);
        if ($dataUpdate) {
                $pesan = [
                    'success' => true,
                    'pesan' => 'Pengajuan Kebutuhan telah berhasil dikirim!'
                ];
                return response()->json($pesan);
            } else {
                $pesan = [
                    'success' => false,
                    'message' => 'Pengajuan Kebutuhan gagal dikirim!',
                ];
                return response()->json($pesan);
            }
        
         
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,pengajuan_kebutuhan $pengajuan_kebutuhan, Request $request)
    {
        //
        $data = [
            'pengajuan_kebutuhan' => pengajuan_kebutuhan::where('id_pengajuan_kebutuhan', $id)->first()
        ];

        return view('dashboard-pemohon.pengajuan-kebutuhan.edit', $data);
    }

    public function cetak(pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        $data = [
            'pengajuan_kebutuhan'=> DB::table('view_pengajuan_pemohon')->get(),
        ];

        $pdf = PDF::loadView('dashboard-pemohon.pengajuan-kebutuhan.cetak', $data);

        return $pdf->stream();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        //
        $data = $request->validate([

            'nama_kegiatan' => ['required'],
            'tujuan' => ['required'],
        ]);

        $data['waktu'] = Carbon::now();
        $id_pengajuan_kebutuhan = $request->input('id_pengajuan_kebutuhan');

        if ($id_pengajuan_kebutuhan !== null) {
            $dataUpdate = $pengajuan_kebutuhan->where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-pemohon/pengajuan-kebutuhan')->with('success', 'Data Pengajuan Kebutuhan telah berhasil diperbarui!');
            } else {
                return back()->with('error', 'Data Pengajuan Kebutuhan gagal diperbarui!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengajuan_kebutuhan $pengajuan_kebutuhan, Request $request)
    {
        //
        $id_pengajuan_kebutuhan = $request->input('id_pengajuan_kebutuhan');

        $aksi = $pengajuan_kebutuhan->where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)->delete();

        if ($aksi) {
            $pesan = [
                'success' => true,
                'pesan'   => 'Data Pengajuan Kebutuhan telah berhasil dihapus!'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan'   => 'Data Pengajuan Kebutuhan gagal dihapus!'
            ];
        }

        return response()->json($pesan);
    }

   
}
