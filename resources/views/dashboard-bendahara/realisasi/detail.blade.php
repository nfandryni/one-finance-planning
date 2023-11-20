@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')

    <div class="row px-5">
 
    <div class="col-md-12">
        @foreach ($realisasi as $s)
                    <div class="row justify-content-md-center" style="align-items: center">
                    <div class='mb-4'>
                       <a href='/dashboard-bendahara/realisasi/edit-realisasi/{{$s->id_realisasi}}' class='btn text-white' style='background-color:#6610f2'><i class="fa-solid fa-pen"></i>Realisasi</a>
                       <a href='' class='btn text-white' style='background-color:#6610f2'><i class="fa-solid fa-pen"></i>Item Perencanaan</a>
                    </div>
                        <div class=''>
                            
                            <h3>Realisasi</h3>
                            <p>Nama Realisasi {{ $s->judul_realisasi }}</p> 
                            <!-- @if(is_null($p)) -->
                            <!-- <p>Pengeluaran belum Ditambahkan</p> -->
                            <!-- @else -->
                            <!-- <p>Nama Pengeluaran {{ $p->nama }}</p>  -->
                            <!-- @endif -->
                            <p>Waktu {{ $s->waktu }} </p>
                            <p>Total Pembayaran {{ $s->total_pembayaran }}</p>
                               
                            
                            
                            @endforeach 
                        </div>
                    </div>
                  <hr/>
                  <div class=''>
                            
                            <h3>Item Realisasi</h3>
                            @foreach ($item_perencanaan as $s)
                            <div class="row fw-bold">
    <div class="col">
        <p>Item</p>
    </div>
    <div class="col">
        <p>Qty</p>
    </div>
    <div class="col">
        <p>Harga Satuan</p>
    </div>
    <div class="col">
        <p>Satuan</p>
    </div>
    <div class="col">
        <p>Spesifikasi</p>
    </div>
    <div class="col">
        <p>Status</p>
    </div>
    <div class="col">
        <p>Foto Perencanaan</p>
    </div>
    <div class="col">
        <p>Foto Realisasi</p>
    </div>
</div>
<div class="row">
    <div class="col">
        <p> {{ $s->item_perencanaan }}</p>
    </div>
    <div class="col">
        <p>  {{ $s->qty }}</p>
    </div>
    <div class="col">
        <p>{{ $s->harga_satuan }} </p>
    </div>
    <div class="col">
        <p>    {{ $s->satuan }}</p>
    </div>
    <div class="col">
        <p> {{ $s->spesifikasi }}</p>
    </div>
    <div class="col">
        <p> {{ $s->status }}</p>
    </div>
    <div class="col">
        <p>   
                            {{ $s->foto_barang_perencanaan }}</p>
    </div>
    <div class="col">
        <p> 
            @if(is_null( $s->foto_realisasi ))
            Tidak ada
         @else
        {{ $s->foto_realisasi }}
        @endif
    </p>
    </div>
</div>

                           
                          
                            
                        
                           
                        
                             
                            @endforeach 
                        </div>
            </div>
        </div>

@endsection
