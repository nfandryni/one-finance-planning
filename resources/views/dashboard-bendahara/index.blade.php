@extends('layout.layout')
@section('title', 'Dashboard ')
@section('dashboard', 'active')

@section('content')

<h2><b>Selamat Datang, {{Auth::user()->username}}!</b></h2>
<h5>Di tempat Anda akan mengelola Dana Pemasukan, Dana Pengeluaran, Data Master, Perencanaan Keuangan, Realisasi, dan Pengajuan Kebutuhan secara transparan.</h5>
<div class='row gap-4 m-4'>
@foreach($sumber_dana as $s)
    <div class="card" style='width:300px'>
        <div class="card-body rounded-5">
        <h2 class='text-center mt-4 text-danger fw-bold'>
    Rp. {{ $totalpSumberDana }}
</h2>
   <p class='text-center h-20'>Dana {{$s->nama_sumber}}</p>
  </div>
  </div>
  @endforeach
<!--
<div class="card" style='width:300px'>
  <div class="card-body rounded-5">
<h2 class='text-center mt-4 text-danger fw-bold '>Rp. {{ $jumlahBOPD ?? 0 }} </h2>
   <p class='text-center h-20'>Dana BOPD</p>
  </div>
</div>
<div class="card" style='width:300px'>
  <div class="card-body rounded-5">
<h2 class='text-center mt-4 text-danger fw-bold '>Rp. {{ $jumlahKomite ?? 0 }}</h2>
   <p class='text-center h-20'>Dana Komite</p>
</div>
</div>
</div> -->
<div class='row gap-4'>
<div class="card">
    <div class="card-body rounded-5">
        <h2 class='text-danger mt-4 text-center fw-bold'>Rp. {{ $jumlahDana ?? 0 }}</h2>
        <p class='text-center h-20'>Total Dana Anggaran </p>
    </div>
</div>
</div> 

<!-- <div>
    <canvas id='BarChart'></canvas>
</div> -->
<div class='row'>
    <p>Lihat di <a href='/dashboard-bendahara/pemasukan'>Dana Pemasukan</a></p>
    <table class="table table-borderless table-striped">
        <thead> 
            <tr>
                <thead>
                    <tr>
                        <th>Sumber Dana</th>
                        <th>Nama Pemasukan</th>
                        <th>Nominal (Rupiah)</th>
                        <th>Penanggung Jawab</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemasukan as $s)
                    <tr>
                        <td>{{ $s->nama_sumber }}</td>
                        <td>{{ $s->nama_pemasukan }}</td>
                        <td>{{ $s->nominal }}</td>
                        <td>{{ $s->penanggung_jawab }}</td>
                        <td>{{ $s->waktu }}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>  
        @endsection
       