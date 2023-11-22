@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')

    <div class="row px-5">
 
        <div class="col-md-12">
            <div class="row justify-content-md-center" style="align-items: center">
                
                <div>

            {{-- <a href='/dashboard-bendahara/realisasi/edit-realisasi/{{$realisasi->first()->id_realisasi}}' class='btn btn-warning'><i class="fa-solid fa-pen"></i> Realisasi</a>
            <a href='' class='btn btn btn-warning'><i class="fa-solid fa-pen"></i> Item Perencanaan</a> --}}
        </div>
        </div>
                        <div>
                            <br/>
                            <h3>Realisasi</h3>
                            <p>Nama Realisasi {{ $realisasi->first()->judul_realisasi }}</p> 
                            <!-- @if(is_null($realisasi)) -->
                            <!-- <p>Pengeluaran belum Ditambahkan</p> -->
                            <!-- @else -->
                            <!-- <p>Nama Pengeluaran {{ $realisasi->first()->nama }}</p>  -->
                            <!-- @endif -->
                            <p>Tujuan {{ $realisasi->first()->tujuan }} </p>
                            <p>Waktu {{ $realisasi->first()->waktu }} </p>
                            <p>Total Pembayaran {{ $realisasi->first()->total_pembayaran }}</p>
                        </div>
                        <hr/>
                        <div>
                            
                            <h3>Item Realisasi</h3>
                            @foreach ($item as $r)
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
        <p> {{ $r->item_perencanaan }}</p>
    </div>
    <div class="col">
        <p>  {{ $r->qty }}</p>
    </div>
    <div class="col">
        <p>{{ $r->harga_satuan }} </p>
    </div>
    <div class="col">
        <p>    {{ $r->satuan }}</p>
    </div>
    <div class="col">
        <p> {{ $r->spesifikasi }}</p>
    </div>
    <div class="col">
        <p> {{ $r->status }}</p>
    </div>
    <div class="col">
        <p> {{ $r->foto_barang_perencanaan }}</p>
    </div>
    <div class="col">
        <p> 
            @if(is_null( $r->foto_realisasi ))
            Tidak ada
         @else
        {{ $r->foto_realisasi }}
        @endif
    </p>
    </div>
</div>
                             
@endforeach 
</div>
            </div>
        </div>

@endsection
