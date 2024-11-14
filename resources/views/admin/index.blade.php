@extends('layout.layout')
@section('title', 'Dashboard')
@section('dashboard', 'active')
@section('page', 'Dashboard')
@section('content')
    <div class="d-flex flex-row">
    <h4  class="fw-bold ">Halo,</h4>
    <h4 class="fw-bold ms-2">  {{ Auth::user()->username }} !</h4> 
    </div>

    <h5>Selamat datang di One Finance Planning. Disini anda bisa melihat dana pemasukan, pengeluaran, perencanaan keuangan, realisasi kebutuhan, dan menkonfirmasi pengajuan kebutuhan.</h5>
    
    <div class="col-md-12">
        <div class="shadow-sm mb-3 rounded d-flex justify-content-center flex-column align-items-center" style="background-color:#FFFFFF; height: 150; border:1px solid #CECECE">
            <h1 class="fw-bold" style="color:#FF0000">Rp. {{ $jumlahDana ?? 0 }} </h1>
            <div class="d-flex align-items-center ">
                <h4 style="align-items: center; color: #6A6A6A">Total Anggaran</h4>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex gap-5 justify-content-between">
        <div class="col-md-6 d-flex flex-column gap-1" >
            <h4>Perencanaan Yang Belum Terealisasi: </h4>
        
            @forelse ($blm_realisasi as $p )
            <div class="d-flex justify-content-between align-items-center rounded px-3" style="background-color:#D9D9D9">
              <h5>{{ $p ->judul_perencanaan }} </h5>
                
                <div class="d-flex flex-column justify-content-between align-items-start " style="width: 100px;">
                <h6 class="mt-1" >item:</h6>
                <h5>{{ $p->item_perencanaan }}</h5>
               </div>
              <div class="d-flex flex-column justify-content-between align-items-start">
                <h6 class="mt-1" >status:</h6>
                <h6 class="fst-italic fw-bold">{{ $p ->status }}</h6>
               </div>
            </div>
            @empty

               <h5> Tidak ada item yang direalisasi </h5>
            @endforelse

            {{-- <div class="d-flex justify-content-between align-items-center rounded px-3" style="background-color:#D9D9D9">
              @forelse ($blm_realisasi as $p )
            
              <h5>{{ $p ->judul_perencanaan }} </h5>
                <h6>{{ $p->item_perencanaan }}</h6>
              <div class="d-flex flex-column justify-content-between align-items-start">
                <h6 class="mt-1" >status:</h6>
                <h6 class="fst-italic fw-bold">{{ $p ->status }}</h6>
               </div>

               @empty

               <h5> Tidak ada item yang direalisasi </h5>
              @endforelse

            </div> --}}
            <div class="d-flex justify-content-end">
            <a href="/perencanaan-keuangan" style="color:#000000"><h6 class="fst-italic">lihat semua ></h6></a>
            </div>
        </div>

        <div class="col-md-5 " >
        <div class="shadow-sm mb-3 rounded d-flex justify-content-center flex-column align-items-center" style="background-color:#FFFFFF; height: 150; border:1px solid #CECECE">
            <h1 class="fw-bold" style="color:#42FF00">{{ $totalRealisasi ?? 0 }} </h1>
            <div class="d-flex align-items-center ">
                <h4 style="align-items: center; color: #6A6A6A">Item Yang Sudah Terealisasi</h4>
            </div>
        </div>
        </div>
    </div>

@endsection


