<?php

namespace App\Http\Controllers;

use App\Models\logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(logs $logs)
    {
        //
        $data = [
            'logs'=> $logs->all()
        ];
        return view('logs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(logs $logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(logs $logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, logs $logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,logs $logs)
    {
        //
        {
            //
            $id_logs = $request->input('id_logs');
    
            // Hapus 
            $aksi = $logs->where('id_logs', $id_logs)->delete();
    
            if ($aksi) {
                // Pesan Berhasil
                $pesan = [
                    'success' => true,
                    'pesan'   => 'Data Pengajuan Kebutuhan berhasil dihapus'
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
}
