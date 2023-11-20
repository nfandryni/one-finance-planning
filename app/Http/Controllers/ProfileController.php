<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    
use App\Models\superadmin;
use App\Models\admin;
use App\Models\bendahara_sekolah;
use App\Models\pemohon;

class ProfileController extends Controller
{
    public function index(superadmin $superadmin, admin $admin, bendahara_sekolah $bendahara_sekolah, pemohon $pemohon, string $id)
    {
        $data = [
            $superadmin::join('akun', 'super_admin.user_id', '=', 'akun.user_id')
                                        ->select('super_admin.*', 'akun.user_id')
                                        ->where('super_admin.user_id', '=', $id)
                                        ->get(),
            $admin::join('akun', 'admin.user_id', '=', 'akun.user_id')
                                        ->select('admin.*', 'akun.user_id')
                                        ->where('admin.user_id', '=', $id)
                                        ->get(),
            $bendahara_sekolah::join('akun', 'bendahara_sekolah.user_id', '=', 'akun.user_id')
                                        ->select('bendahara_sekolah.*', 'akun.user_id')
                                        ->where('bendahara_sekolah.user_id', '=', $id)
                                        ->get(),
            $pemohon::join('akun', 'pemohon.user_id', '=', 'akun.user_id')
                                        ->select('pemohon.*', 'akun.user_id')
                                        ->where('pemohon.user_id', '=', $id)
                                        ->get(),
        ];
        
        return view('profile.index', $data);
    }

    
}

