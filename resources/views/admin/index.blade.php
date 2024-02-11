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
        <div class="shadow-sm mb-3 rounded d-flex justify-content-center flex-column align-items-center" style="background-color:#FFFFFF; height: 150; border:1px solid black">
            <h1 class="fw-bold" style="color:#FF0000">Rp. {{ $jumlahDana ?? 0 }} </h1>
            <div class="d-flex align-items-center ">
                <h4 style="align-items: center; color: #6A6A6A">Total Anggaran</h4>
            </div>
        </div>
    </div>

    {{-- <div class="col-md-12 d-flex gap-1">
        <div class="col-md-6 " style="border:1px solid black">jadshask</div>
        <div class="col-md-6 " style="border:1px solid black">dkjdsai</div>
    </div> --}}

@endsection


