<?php 
    namespace App\Http\Controllers;
    use App\Models\sumber_dana;
    use Illuminate\Support\Facades\DB;

    class DashboardBendaharaController extends Controller
    {
        //
     public function index(sumber_dana $sumber_dana)
        {
            $sumber_danas = DB::table('sumber_dana')
            ->limit(3)
            ->get();
            $totalResults = [];
            if(is_null($sumber_danas)) {
                $totalResults['Sumber Dana'] = '0';
            }
            else {
                foreach ($sumber_danas as $s) {
                    $nama_sumber = $s->nama_sumber;
                    $result = DB::select('SELECT total_dana_sumberDana(?) AS total', [$nama_sumber])[0]->total;
                    
                    $totalResults[$nama_sumber] = $result ?? '0';
                }
            }
            $data = [
                'totalpSumberDana' => $totalResults,
                'jumlahDana' =>  DB::select('SELECT total_dana_anggaran() AS totalDana')[0]->totalDana,
                'sumber_dana'=> $sumber_danas,
                'pemasukan'=>DB::table('view_pemasukan')
                ->limit(10)
                ->get(),
            ];
            return view('dashboard-bendahara.index', $data);
        }
    }
