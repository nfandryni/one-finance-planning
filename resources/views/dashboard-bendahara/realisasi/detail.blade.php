@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Detail Realisasi')
@section('content')

    <div class="row px-5">

        <div class="col-md-12">
            <div class="row justify-content-md-center" style="align-items: center">
            <br/>
<a href='/dashboard-bendahara/realisasi' class='text-black'><i class="fa-solid fa-arrow-left fa-xl"></i></a>
                <div>

                    {{-- <a href='/dashboard-bendahara/realisasi/edit-realisasi/{{$realisasi->first()->id_realisasi}}' class='btn btn-warning'><i class="fa-solid fa-pen"></i> Realisasi</a>
            <a href='' class='btn btn btn-warning'><i class="fa-solid fa-pen"></i> Item Perencanaan</a> --}}
                </div>
            </div>
            <div>
                <br />
                <h3 class='fw-bold'>Realisasi</h3>
                <div class='row mb-2'>
                    <div class="col-md-2">
                        <label class='fw-bold'>Nama Realisasi</label>
                    </div>
                    <div class="col-md-3">
                        : {{ $realisasi->judul_realisasi }}
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-2">
                        <label class='fw-bold'>Tujuan</label>
                    </div>
                    <div class="col-md-3">
                        : {{ $realisasi->tujuan }}
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-2">
                        <label class='fw-bold'>Waktu</label>
                    </div>
                    <div class="col-md-3">
                        : {{ $realisasi->waktu }}
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-2">
                        <label class='fw-bold'>Total Pembayaran</label>
                    </div>
                    <div class="col-md-3">
                        : {{ $realisasi->total_pembayaran }}
                    </div>
                </div>
   
            </div>
            <hr />
            <div>

                <h3 class='fw-bold'>Item Realisasi</h3>
                @foreach ($item_realisasi as $r)
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
                            <p> {{ $r->qty }}</p>
                        </div>
                        <div class="col">
                            <p>{{ $r->harga_satuan }} </p>
                        </div>
                        <div class="col">
                            <p> {{ $r->satuan }}</p>
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
                                @if (is_null($r->foto_realisasi))
                                    Tidak ada
                                @else
                                    {{ $r->foto_realisasi }}
                                @endif
                            </p>
                        </div>
                        <div class="col">
                            <p class='btn btn-primary btn-sm'> Edit</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
