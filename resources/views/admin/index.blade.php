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
    


@endsection


