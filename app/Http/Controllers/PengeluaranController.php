<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use App\Models\bendahara_sekolah;
use App\Models\pengeluaran;
use App\Models\sumber_dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mengirim variable data ke view dengan isi array data pengeluaran, 
        //sumber dana dan jenis pengeluaran
        $totalDana =  DB::select('SELECT total_pengeluaran() AS totalDana')[0]->totalDana;
        $data = [
            'pengeluaran'=>pengeluaran::with(['sumber_dana', 'jenis_pengeluaran'])->get(),
            'jumlahDana'=>$totalDana
        ];
        return view('pengeluaran.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(sumber_dana $sumber_dana, jenis_pengeluaran $jenis_pengeluaran)
    {
        //
        $data = [
            'sumber_dana'=> $sumber_dana->all(),
            'jenis_pengeluaran'=> $jenis_pengeluaran->all()
        ];
        return view('pengeluaran.tambah',$data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pengeluaran $pengeluaran, bendahara_sekolah $bendahara_sekolah)
    {
        //
        $data = $request->validate([
            'id_sumber_dana' => 'required',
            'id_jenis_pengeluaran' => 'required',
            'nama' => 'required',
            'nominal' => 'required',
            'waktu' => 'required',
            'foto' => 'required',
        
        ]);

        $idBendahara = $bendahara_sekolah->join('akun', 'bendahara_sekolah.id_akun', '=', 'akun.id_akun')->select('bendahara_sekolah.id_bendahara')->where('bendahara_sekolah.id_akun', auth()->user()->id_akun)->first();
        $data['id_bendahara'] = $idBendahara->id_bendahara;
        // dd($idBendahara->id_bendahara);

        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto'] = $foto_nama;
        }

        $tambahData = $pengeluaran->create($data);

        if ($tambahData) {
            return redirect('/dashboard-bendahara/pengeluaran')->with('success', 'Data surat baru berhasil ditambah');
        }
}

    /**
     * Display the specified resource.
     */
    public function show(pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id,pengeluaran $pengeluaran,sumber_dana $sumber_dana, jenis_pengeluaran $jenis_pengeluaran )
    {
        //
        $data = [
            'pengeluaran' => pengeluaran::where('id_pengeluaran', $id)->first(),
            'sumber_dana'=> $sumber_dana->all(),
            'jenis_pengeluaran'=> $jenis_pengeluaran->all()
        ];

        return view('pengeluaran.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengeluaran $pengeluaran)
    {
        //Menyimpan validasi data yang ada dalam model pengeluaran
        $pengeluaran = $request->input('id_pengeluaran');
        $data = $request->validate([
            'id_sumber_dana' => 'sometimes',
            'id_jenis_pengeluaran' => 'sometimes',
            'nama' => 'sometimes',
            'nominal' => 'sometimes',
            'waktu' => 'sometimes',
            'foto' => 'sometimes',
            
        ]);

        if ($pengeluaran !== null) {

                if ($request->hasFile('foto')) {
                    $foto_file = $request->file('foto');
                    $foto_extension = $foto_file->getClientOriginalExtension();
                    $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                    $foto_file->move(public_path('foto'), $foto_nama);
    
                    // File::delete(public_path('foto') . '/' . $update_data->foto);
    
                    $data['foto'] = $foto_nama;
                }
            
            // Process Update
            $dataUpdate = pengeluaran::where('id_pengeluaran', $pengeluaran)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/pengeluaran')->with('success', 'Data Pengeluaran berhasil di update');
            } else {
                return back()->with('error', 'Data Pengeluaran gagal di update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengeluaran $pengeluaran, Request $request)
    {
        //
        $id_pengeluaran = $request->input('id_pengeluaran');

        // Hapus 
        $aksi = $pengeluaran->where('id_pengeluaran', $id_pengeluaran)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data pengeluaran berhasil dihapus'
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
