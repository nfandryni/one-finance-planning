@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Detail Realisasi')
@section('content')

    <div class="row px-5">
    <div class="col-md-4">
                <a href="/dashboard-bendahara/realisasi"><btn class="btn btn-dark">KEMBALI</btn></a>
            </div>
                        <div>
                            <br/>
                            <h3 class='fw-bold'>Detail Realisasi</h3>
                            <div class='mt-1'>
                                <div class="row mb-2">
                                <div class="col-md-2">
                                <label class='fw-bold'>Nama Realisasi</label>
                                </div>
                                <div class="col-md-3">
                                : {{$realisasi->judul_realisasi}}
                            </div>
                            </div>
                            <div class='mt-1'>
                                <div class="row mb-2">
                                <div class="col-md-2">
                                <label class='fw-bold'>Tujuan</label>
                                </div>
                                <div class="col-md-3">
                                : {{$realisasi->tujuan}}
                            </div>
                            </div>
                            <div class='mt-1'>
                                <div class="row mb-2">
                                <div class="col-md-2">
                                <label class='fw-bold'>Waktu</label>
                                </div>
                                <div class="col-md-3">
                                : {{$realisasi->waktu}}
                            </div>
                            </div>
                            <div class='mt-1'>
                                <div class="row mb-2">
                                <div class="col-md-2">
                                <label class='fw-bold'>Total Pembayaran</label>
                                </div>
                                <div class="col-md-3">
                                : {{$realisasi->total_pembayaran}}
                            </div>
                            </div>
                         
                        </div>
                        <hr/>
                        <div>
                            
                            <h3 class='fw-bold'>Detail Item Realisasi</h3>
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
    <div class="col">
        <p>Aksi</p>
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
    <div class="col">
        <a class='text-black' href="/dashboard-bendahara/realisasi/edit-item/{{ $r->id_item_perencanaan }}"><i class="fa-solid fa-pen" style="cursor: pointer; margin:2px"></i></a>
    </div>
</div>
                             
@endforeach 
</div>
            </div>
        </div>

@endsection
