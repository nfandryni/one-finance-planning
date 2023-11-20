<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akun;
use App\Models\log;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index(log $log)
    {
        $data = [
            $TotalAkun = DB::select('SELECT TotalAcc() as TotalAkun')[0]->TotalAkun,
            $totalRole = json_decode( DB::table('v_chart')->get())
        ];
        
        // dd($data[1]);
        return view("superadmin.index", compact('data'));
        
    }

    public function loggs(log $log)
    {
        $data = [
            'log' => $log->all()
        ];
        return view("superadmin.kelola-akun.log",  $data);
        
    }

    public function destroy(log $log, Request $request)
    {
        $id_logs = $request->input('id_logs');

        // Hapus 
        $aksi = $log->where('id_logs', $id_logs)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data logs berhasil dihapus'
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
