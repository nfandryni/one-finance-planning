@extends('layout.layout')
@section('title', 'Dashboard ')
@section('dashboard', 'active')

@section('content')

<h2><b>Selamat Datang</b></h2>
<h5>Di tempat Anda akan mengelola Dana Pemasukan, Dana Pengeluaran, Data Master, Perencanaan Keuangan, Realisasi, dan Pengajuan Kebutuhan secara transparan.</h5>
<div class='row gap-4 m-4'>

    <div class="card w-25">
        <div class="card-body rounded-5">
   <h2 class='text-danger fw-bold '>Rp. </h2>
   <p class='text-center h-20'>Dana BOS</p>
  </div>
</div>
<div class="card w-25">
  <div class="card-body rounded-5">
   <h2 class='text-danger fw-bold '>Rp. </h2>
   <p class='text-center h-20'>Dana BOPD</p>
  </div>
</div>
<div class="card w-25">
  <div class="card-body rounded-5">
   <h2 class='text-danger fw-bold '>Rp. </h2>
   <p class='text-center h-20'>Dana Komite</p>
</div>
</div>
</div>
<div class='row gap-4 m-4'>
<div class="card ">
    <div class="card-body rounded-5">
        <h2 class='text-danger text-center fw-bold'>Rp. </h2>
        <p class='text-center h-20'>Total Dana Anggaran </p>
    </div>
</div>
</div>
<div class='row m-4'>
    <p>Lihat di <a href='/dashboard-bendahara/pemasukan'>Dana Pemasukan</a></p>
    <table class="table table-borderless table-striped">
                            <thead> 
                                <tr>
                            <thead>
                                <tr>
                                    <th>Sumber Dana</th>
                                    <th>Nama Pemasukan</th>
                                    <th>Nominal (Rupiah)</th>
                                    <th>Waktu</th>
                                    <th>Penanggung Jawab</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($pemasukan as $s)
                                    <tr>
                                        <td>{{ $s->sumber_dana->nama_sumber }}</td>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->nominal }}</td>
                                        <td>{{ $s->waktu }}</td>
                                        <td>{{ $s->id_bendahara }}</td>         
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
</div>  
@endsection