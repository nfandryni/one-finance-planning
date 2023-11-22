<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\bendahara_sekolah;
use App\Models\superadmin;
use App\Models\admin;
use App\Models\pemohon;
use FFI\Exception;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AkunController extends Controller
{
    public function index(akun $akun)
    {
        $data = [
            'akun' => $akun->all()
        ];
        return view('superadmin.kelola-akun.index', $data);
        
    }

    public function print(akun $akun)
    {
        $data = [
            'akun' => $akun->all()
        ];

        $pdf = PDF::loadView('superadmin.kelola-akun.generate', $data);

        return $pdf->stream();
    }

    public function create()
    {
        return view('kelola-akun.tambah');
    }

    public function store(Request $request, akun $akun)
    {
        $data = $request->validate(
            //untuk memvalidasi inputan dari request berdasarkan tabel akun
            [
                'username' => ['required'],
                'password' => ['required'],
                'role'    => ['required'],
            ]
        );

      
        //Proses Insert
        if ($data) {
            $data['password'] = Hash::make($data['password']);

            try{
                DB::statement('CALL createProfileAcc (?,?,?)',[$data['username'], $data['password'], $data['role']]);
                return redirect('kelola-akun')->with('success', 'Data akun berhasil dibuat ');
            }catch (Exception $e){
                return back()->with('error', 'Data akun gagal dibuat');
            }
           
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data akun gagal dibuat');
        }
    }

   
    public function show(string $id, Request $request, akun $akun)
    {
        $akun = Akun::find($id); 
        if($akun)
        {
            if($akun -> role == 'superadmin')
            {
                $data =[
                'datas' => DB::table('v_SuperAdmin')->select('nama', 'role' ,'email', 'jabatan', 'foto_profil', 'user_id', 'id_superadmin')->where('user_id', $id)->first()
                ];

                return view('superadmin.kelola-akun.detail', compact('data'));
            }

            elseif($akun -> role == 'admin')
            {
                $data =[
                'datas' => DB::table('v_admin')->select('nama', 'role' ,'email', 'jabatan', 'foto_profil', 'user_id', 'id_admin')->where('user_id', $id)->first()
                ];
                return view('superadmin.kelola-akun.detail', compact('data'));
            }

            elseif($akun -> role == 'bendaharasekolah')
            {
                $data =[
                'datas' => DB::table('v_bendahara')->select('nama', 'role' ,'email', 'jabatan', 'foto_profil', 'user_id', 'id_bendahara')->where('user_id', $id)->first()
                ];
                return view('superadmin.kelola-akun.detail', compact('data'));
            }

            elseif($akun -> role == 'pemohon')
            {
                $data =[
                'datas' => DB::table('v_pemohon')->select('nama', 'role' ,'email', 'jabatan', 'kategori','foto_profil', 'user_id', 'id_pemohon')->where('user_id', $id)->first()
                ];
                return view('superadmin.kelola-akun.detail', compact('data'));
            }
            else 
            {
                return back()->with('error', 'terjadi kesalahan');
            }

        }
        else{
            return back()->with('error', 'terjadi kesalahan');
        }
    }


    public function edit(string $id, Request $request, akun $akun)
    {
        $akun = Akun::find($id); 
        if($akun)
        {
            if($akun -> role == 'superadmin')
            {
                $data =[
                'datas' => DB::table('v_SuperAdmin')->select('nama', 'role' ,'email', 'jabatan', 'foto_profil', 'user_id', 'id_superadmin')->where('user_id', $id)->first()
                ];

                return view('superadmin.kelola-akun.edit', compact('data'));
            }

            elseif($akun -> role == 'admin')
            {
                $data =[
                'datas' => DB::table('v_admin')->select('nama', 'role' ,'email', 'jabatan', 'foto_profil', 'user_id', 'id_admin')->where('user_id', $id)->first()
                ];
                return view('superadmin.kelola-akun.edit', compact('data'));
            }

            elseif($akun -> role == 'bendaharasekolah')
            {
                $data =[
                'datas' => DB::table('v_bendahara')->select('nama', 'role' ,'email', 'jabatan', 'foto_profil', 'user_id', 'id_bendahara')->where('user_id', $id)->first()
                ];
                return view('superadmin.kelola-akun.edit', compact('data'));
            }

            elseif($akun -> role == 'pemohon')
            {
                $data =[
                'datas' => DB::table('v_pemohon')->select('nama', 'role' ,'email', 'jabatan', 'kategori','foto_profil', 'user_id', 'id_pemohon')->where('user_id', $id)->first()
                ];
                return view('superadmin.kelola-akun.edit', compact('data'));
            }
            else 
            {
                return back()->with('error', 'terjadi kesalahan');
            }

        }
        else{
            return back()->with('error', 'terjadi kesalahan');
        }
        
    }

    public function update(Request $request, akun $akun, bendahara_sekolah $bendahara_sekolah, superadmin $superadmin, admin $admin, pemohon $pemohon)
    {
        $role = $request->input('role');
        
        if($role  == 'superadmin')
        {
            $id_superadmin = $request->input('id_superadmin');

            $data = $request->validate([
                'nama' => 'required',
                'email' => 'sometimes',
                'jabatan' => 'sometimes',
                'foto_profil' => 'sometimes|file',
            ]);

            if ($request->hasFile('foto_profil')) 
            {
                $foto_file = $request->file('foto_profil');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);
                $data['foto_profil'] = $foto_nama;

                $update_data = $superadmin->where('id_superadmin', $id_superadmin)->first();
                if($update_data->file !== null)
                {
                    File::delete(public_path('foto') . '/' . $update_data->file);
                }
            }

            $dataUpdate = $superadmin->where('id_superadmin', $id_superadmin)->update($data);
            
            if ($dataUpdate) {
                return redirect('kelola-akun')->with('success', 'Profile akun berhasil di update');
            }

            return back()->with('error', 'Profile akun gagal di update');
        }
        if($role  == 'admin')
        {
            $id_admin = $request->input('id_admin');
            $data = $request->validate([
                'nama' => 'required',
                'email' => 'sometimes',
                'jabatan' => 'sometimes',
                'foto_profil' => 'sometimes|file',
            ]);

            if ($request->hasFile('foto_profil')) 
            {
                $foto_file = $request->file('foto_profil');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' .  $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);
                $data['foto_profil'] = $foto_nama;

                
                $update_data = $admin->where('id_admin', $id_admin)->first();
                if($update_data->file !== null)
                {
                    File::delete(public_path('foto') . '/' . $update_data->file);
                }

            }

            $dataUpdate = $admin->where('id_admin', $id_admin  )->update($data);
            
            if ($dataUpdate) {
                return redirect('kelola-akun')->with('success', 'Profile akun berhasil di update');
            }

            return back()->with('error', 'Profile akun gagal di update');

        }
        if($role  == 'bendaharasekolah'){
            $id_bendahara = $request->input('id_bendahara');
            $data = $request->validate([
                'nama' => 'required',
                'email' => 'sometimes',
                'jabatan' => 'sometimes',
                'foto_profil' => 'sometimes|file',
            ]);

            if ($request->hasFile('foto_profil')) {
                $foto_file = $request->file('foto_profil');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);
                $data['foto_profil'] = $foto_nama;

                
                $update_data = $bendahara_sekolah->where('id_bendahara', $id_bendahara)->first();
                if($update_data->file !== null)
                {
                    File::delete(public_path('foto') . '/' . $update_data->file);
                }

            }
            $dataUpdate = $bendahara_sekolah->where('id_bendahara', $id_bendahara  )->update($data);
            
            if ($dataUpdate) {

                return redirect('kelola-akun')->with('success', 'Profile akun berhasil di update');
            }
                return back()->with('error', 'Profile akun gagal di update');
        }
        if($role  == 'pemohon'){
            $id_pemohon = $request->input('id_pemohon');
            $data = $request->validate([
                'nama' => 'required',
                'email' => 'sometimes',
                'jabatan' => 'sometimes',
                'kategori' => 'sometimes',
                'foto_profil' => 'sometimes|file',
            ]);

            if ($request->hasFile('foto_profil')) {
                $foto_file = $request->file('foto_profil');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);
                $data['foto_profil'] = $foto_nama;
                
                $update_data = $pemohon->where('id_pemohon', $id_pemohon)->first();
                
                if($update_data->file !== null)
                {
                    File::delete(public_path('foto') . '/' . $update_data->file);
                }

            }
            $dataUpdate = $pemohon->where('id_pemohon', $id_pemohon  )->update($data);
            
            if ($dataUpdate) {

                return redirect('kelola-akun')->with('success', 'Profile akun berhasil di update');
            }
                return back()->with('error', 'Profile akun gagal di update');
        }

       
    }

    public function destroy(akun $akun ,Request $request )
    {
        $user_id = $request->input('user_id');

        // Hapus 
        $aksi = $akun->where('user_id', $user_id)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data akun berhasil dihapus'
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
