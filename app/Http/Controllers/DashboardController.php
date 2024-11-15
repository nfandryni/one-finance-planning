<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akun;
use App\Models\logs;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        $totalAkun = DB::select('SELECT TotalAcc() as TotalAkun')[0]->TotalAkun;

        $totalRole = DB::table('v_chart')->get();

        $chartData = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Total Role',
                    'borderWidth' => 1,
                    'data' => [],
                ],
            ],
        ];
        
        foreach ($totalRole as $roleData) {
            $chartData['labels'][] = $roleData->role;
            $chartData['datasets'][0]['data'][] = $roleData->totalRole;
        }

        $data = [
            'totalAkun' => $totalAkun,
            'chartData' => $chartData,
        ];
       
        return view("superadmin.index", compact('data'));
    }

    public function loggs(logs $logs)
    {
        $data = [
            'logs' => $logs->all()
        ];
        return view("superadmin.kelola-akun.log",  $data);
        
    }

    public function destroy(logs $logs, Request $request)
    {
        $id_logs = $request->input('id_logs');

        // Hapus 
        $aksi = $logs->where('id_logs', $id_logs)->delete();

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
