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
        <div class="shadow-sm mb-3 rounded d-flex justify-content-center flex-column align-items-center" style="background-color:#DDDDDD; height: 150">
            <h1 >Total Pemasukan </h1>
            <div class="d-flex align-items-center ">
                <h3 style="align-items: center">Rp. {{ $jumlahDana ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- <div class="col-md-12 d-flex gap-1">
        <div class="col-md-6 " style="border:1px solid black">jadshask</div>
        <div class="col-md-6 " style="border:1px solid black">dkjdsai</div>
    </div> --}}

@endsection


