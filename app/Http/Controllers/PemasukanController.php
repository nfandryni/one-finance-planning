<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\bendahara_sekolah;
use App\Models\pemasukan;
use App\Models\sumber_dana;
use PDF;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    
    public function index()
    {   
        $totalDana =  DB::select('SELECT total_pemasukan() AS totalDana')[0]->totalDana;
        $data = [
            'pemasukan'=>DB::table('view_pemasukan')->get(),
            'jumlahDana'=>$totalDana,
        ];
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            return view('dashboard-bendahara.pemasukan.index', $data);
        }
        elseif($role == 'admin') {
            return view('admin.pemasukan.index', $data);
        }
    }

    
    public function create(pemasukan $pemasukan, sumber_dana $sumber_dana, bendahara_sekolah $bendahara)
    {
        $sumberDana = sumber_dana::all();
        $bendaharaSekolah = bendahara_sekolah::all();
    
        // dd($sumberDana, $bendaharaSekolah);
        return view('dashboard-bendahara.pemasukan.tambah', compact('sumberDana', 'bendaharaSekolah'));

    }

    
    public function store(Request $request, pemasukan $pemasukan)
    {
        $data = $request->validate(
            [
                'id_sumber_dana'    => ['required'],
                'nama'    => ['required'],
                'nominal'    => ['required'],
                'waktu'    => ['required'],
                'foto'    => ['required'],
            ]
        );
        $user = Auth::user();
        $id_akun = $user->user_id;
        $id_bendahara_array = DB::select("SELECT id_bendahara FROM bendahara_sekolah WHERE user_id = ? LIMIT 1", [$id_akun]);
        $id_bendahara = $id_bendahara_array[0]->id_bendahara;
        $data['id_bendahara'] = $id_bendahara;

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $foto_file = $request->file('foto');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto'] = $foto_nama;
        }

        if ($data) {
            // Simpan jika data terisi semua
            $pemasukan->create($data);
            return redirect('dashboard-bendahara/pemasukan')->with('success', 'Data Pemasukan baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data Pemasukan gagal ditambahkan');
        }
        //Proses Insert
    }

   
    public function show(string $id)
    {
        //
        $data = [
            'pemasukan'=>DB::table('view_pemasukan')->get(),
        ];
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            return view('dashboard-bendahara.pemasukan.detail', $data);

        }
        elseif($role == 'admin') {
            return view('admin.pemasukan.detail', $data);
        }
    }

   
    public function edit(string $id, Request $request, pemasukan $pemasukan, sumber_dana $sumber_dana, bendahara_sekolah $bendahara)
    {
        $data = [
            'pemasukan'=> pemasukan::where('id_pemasukan', $id)->first(),
            'sumber_dana'=>$sumber_dana->all(),
            'bendahara'=>$bendahara->all()
        ];  

        return view('dashboard-bendahara.pemasukan.edit', $data);
    }

    public function print(pemasukan $pemasukan)
    {
        $data = [
            'pemasukan'=>DB::table('view_pemasukan')->get(),

        ];
        $user = Auth::user();
        $role = $user->role;
        if($role == 'bendaharasekolah') {
            $pdf = PDF::loadView('dashboard-bendahara.pemasukan.print', $data);
        return $pdf->stream();
        }
        elseif($role == 'admin') {
            $pdf = PDF::loadView('admin.pemasukan.print', $data);
            return $pdf->stream();
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pemasukan $pemasukan)
    {
        $id_pemasukan = $request->input('id_pemasukan');

        $data = $request->validate(
            [
                'id_sumber_dana'    => ['sometimes'],
                'nama_pemasukan'    => ['sometimes'],
                'nominal'    => ['sometimes'],
                'waktu'    => ['sometimes'],
                'foto'    => ['sometimes'],
            ]
        );

        if ($id_pemasukan !== null) {
            if ($request->hasFile('foto')) {
                $foto_file = $request->file('foto');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);

                $update_data = $pemasukan->where('id_pemasukan', $id_pemasukan)->first();
                // File::delete(public_path('foto') . '/' . $update_data->file);

                $data['foto'] = $foto_nama;
            }

            $dataUpdate = $pemasukan->where('id_pemasukan', $id_pemasukan)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard-bendahara/pemasukan')->with('success', 'Data Pemasukan berhasil diupdate');
            }

            return back()->with('error', 'Data Pemasukan gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pemasukan $pemasukan, Request $request)
    {
        $id_pemasukan = $request->input('id_pemasukan');

        // Hapus 
        $aksi = $pemasukan->where('id_pemasukan', $id_pemasukan)->delete();

        if ($aksi) {
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