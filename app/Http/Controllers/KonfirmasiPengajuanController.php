<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengajuan_kebutuhan;
use App\Models\item_kebutuhan;
use App\Models\gedung;
use App\Models\sumber_dana;
use PDF;
use Illuminate\Support\Facades\DB;

class KonfirmasiPengajuanController extends Controller
{
    //
    public function index(pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        $data = [
            'pengajuan_kebutuhan' => DB::table('pengajuan_kebutuhan')
            ->join('pemohon', 'pengajuan_kebutuhan.id_pemohon', '=', 'pemohon.id_pemohon')
            ->whereIn('pengajuan_kebutuhan.status', ['Difilterisasi', 'Dikonfirmasi', 'Terkirim'])
            ->get()
        ];

        return view('dashboard-bendahara.konfirmasi-pengajuan.index', $data);
    }

    public function show(string $id)
    {
        //
        $data = [
            'pengajuan_kebutuhan'=> pengajuan_kebutuhan::where('id_pengajuan_kebutuhan', $id)->first(),
            
            'item_kebutuhan'=> DB::table('view_pengajuan_kebutuhan')
            ->where('view_pengajuan_kebutuhan.id_pengajuan_kebutuhan', '=', $id)
            ->where(function ($query) {
                $query->where('status', '-')
                ->orWhere('status', 'Diterima');
            })
            ->get(),
            'sumber_dana'=>sumber_dana::all(),
            'totalDanaKebutuhan' => DB::select('SELECT total_dana_kebutuhan(?) AS totalDanaKebutuhan', [$id])[0]->totalDanaKebutuhan
        ];
        return view('dashboard-bendahara.konfirmasi-pengajuan.detail', $data);  
    }

    public function edit_item(string $id,item_kebutuhan $item_kebutuhan, pengajuan_kebutuhan $pengajuan_kebutuhan, gedung $gedung)
    {
        //
        $data = [
            'item_kebutuhan' => DB::table('item_kebutuhan')
            ->where('id_item_kebutuhan', '=', $id)
            ->join('gedung', 'item_kebutuhan.id_gedung', '=', 'gedung.id_gedung')
            ->first(),
        ];

        return view('dashboard-bendahara.konfirmasi-pengajuan.edit-item', $data);
    }

    public function update_item(Request $request, item_kebutuhan $item_kebutuhan)
    {
        //
        $data = $request->validate(
            [
                'id_item_kebutuhan' => ['required'],
                'id_gedung' => ['required'],
                'item_kebutuhan' => ['required'],
                'qty'    => ['required'],
                'harga_satuan' => ['required'],
                'satuan' => ['required'],
                'spesifikasi' => ['required'],
            ]
        );
        $id_pengajuan_kebutuhan  = $request->input('id_pengajuan_kebutuhan');
       
        if($request->input('id_item_kebutuhan') !== null ){
            $dataUpdate = item_kebutuhan::where('id_item_kebutuhan',$request->input('id_item_kebutuhan'))
                            ->update($data);
            if($dataUpdate){
                return redirect('dashboard-bendahara/konfirmasi-pengajuan/detail/' . $id_pengajuan_kebutuhan)->with('success', 'Data Item Kebutuhan berhasil di update');

            }else{
                return back()->with('error','Data Item Kebutuhan gagal di update');
            }
        }

    }

    public function print(pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        $data = [
            'pengajuan_kebutuhan' => DB::table('pengajuan_kebutuhan')
            ->join('pemohon', 'pengajuan_kebutuhan.id_pemohon', '=', 'pemohon.id_pemohon')
            ->whereIn('pengajuan_kebutuhan.status', ['Difilterisasi', 'Dikonfirmasi', 'Terkirim'])
            ->get()
        ];

        $pdf = PDF::loadView('dashboard-bendahara.konfirmasi-pengajuan.print', $data);

        return $pdf->stream();
    }
    
    public function filter(Request $request, pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        $id_pengajuan_kebutuhan = $request->input('id_pengajuan_kebutuhan');
        $status = $request->input('status');
        $id_sumber_dana = $request->input('id_sumber_dana');
        $total_dana_kebutuhan = $request->input('total_dana_kebutuhan');
        $bulan_rencana_realisasi = $request->input('bulan_rencana_realisasi');
        if (is_array($bulan_rencana_realisasi)) {
            foreach ($bulan_rencana_realisasi as $id_item_kebutuhan => $bulan) {
                $dataUpdate = item_kebutuhan::where('id_item_kebutuhan', $id_item_kebutuhan)
                    ->where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)
                    ->update(['bulan_rencana_realisasi' => $bulan]);
            }
        } else {
            $dataUpdate = item_kebutuhan::where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)
                ->update(['bulan_rencana_realisasi' => $bulan_rencana_realisasi]);
        }
        
    $dataUpdate = $pengajuan_kebutuhan->where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)->update(['status' => $status, 'total_dana_kebutuhan'=> $total_dana_kebutuhan, 'id_sumber_dana'=>$id_sumber_dana]);
        if ($dataUpdate) {
            return redirect('dashboard-bendahara/konfirmasi-pengajuan/detail/' . $id_pengajuan_kebutuhan)->with('success', 'Berhasil dikonfirmasi!');

            } else {
                return redirect('dashboard-bendahara/konfirmasi-pengajuan/detail/' . $id_pengajuan_kebutuhan)->with('success', 'Gagal melakukan aksi!');

            }
        }
    
    public function reject(Request $request, pengajuan_kebutuhan $pengajuan_kebutuhan)
    {
        $id_pengajuan_kebutuhan = $request->input('id_pengajuan_kebutuhan');
        $status = $request->input('status');

        $dataUpdate = $pengajuan_kebutuhan->where('id_pengajuan_kebutuhan', $id_pengajuan_kebutuhan)->update(['status' => $status]);
        if ($dataUpdate) {
                $pesan = [
                    'success' => true,
                    'pesan' => 'Pengajuan Kebutuhan berhasil ditolak!'
                ];
                return response()->json($pesan);
            } else {
                $pesan = [
                    'success' => false,
                    'message' => 'Pengajuan Kebutuhan gagal ditolak.',
                ];
                return response()->json($pesan);
            }
        }

    public function update(Request $request, item_kebutuhan $item_kebutuhan)
    {
        $id_item_kebutuhan = $request->input('id_item_kebutuhan');
        $id_pengajuan_kebutuhan = $request->input('id_pengajuan_kebutuhan');
        $status = $request->input('status');

        $dataUpdate = $item_kebutuhan->where('id_item_kebutuhan', $id_item_kebutuhan)->update(['status' => $status]);
        $cekStatus = DB::select("SELECT COUNT(*) as count FROM item_kebutuhan WHERE id_pengajuan_kebutuhan = ? AND status = '-' ", [$id_pengajuan_kebutuhan]);
        if($dataUpdate && $cekStatus[0]->count == 0) {
            dd($cekStatus);
            $pesan = [
                'success' => false,
                'pesan' => 'Item Kebutuhan telah Ditolak!'
            ];
            return response()->json($pesan);
            } else if($dataUpdate && $cekStatus[0]->count >= 1){
                $pesan = [
                    'success' => true,
                    'pesan' => 'Item Kebutuhan telah Ditolak!'
                ];
                return response()->json($pesan);
            }
          else {
                $pesan = [
                    'success' => false,
                    'message' => 'Item Kebutuhan gagal ditolak.',
                ];
                return response()->json($pesan);
            }
        
         
        }
        
    }
