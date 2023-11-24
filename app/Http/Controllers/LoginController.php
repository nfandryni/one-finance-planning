<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.login');
        
    }

    public function logincheck(Request $request){
        $akun = $request->validate(
            [
                'username' => ['required'],
                'password' => ['required']
            ]
            );
        if(Auth::attempt($akun)){
            $request->session()->regenerate();
            $user = Auth::user();
            session_start();
            session(['username' => $user->username]);
            if($user->role == 'admin') {
                return redirect()->to('/dashboard-admin');
            } elseif($user->role == 'superadmin') {
                return redirect()->to('/dashboard-superadmin');
            } elseif($user->role == 'bendaharasekolah') {
                return redirect()->to('/dashboard-bendahara');
            } elseif($user->role == 'pemohon'){
                return redirect()->to('/dashboard-pemohon');
            }   
            else{
                return redirect()->to('/');
            }
        }
        else{
            return redirect('/login');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
