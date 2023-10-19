<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // if(!Auth::user()):
            return view('login.login');
        // else:
        //     if(Auth::user()->role == 'admin'):
        //         return redirect()->to('/dashboard/');
        //     else:
        //         return redirect()->to('/kasir/dashboard');
        //     endif;
        // endif;
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

                return redirect()->to('/dashboard');
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
