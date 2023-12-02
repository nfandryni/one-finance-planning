<?php 
    namespace App\Http\Controllers;
    use App\Models\sumber_dana;
    use App\Models\pemasukan;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class DashboardBendaharaController extends Controller
    {
        //
        public function index(sumber_dana $sumber_dana)
        {
            // dd($sumber_dana);
             $data = [
                $totalDana =  DB::select('SELECT total_dana_anggaran() AS totalDana')[0]->totalDana,
                'sumber_dana'=> sumber_dana::all(),
                'pemasukan'=>DB::table('view_pemasukan')->get(),
            ];
            return view('dashboard-bendahara.index', $data);
        }
    }
