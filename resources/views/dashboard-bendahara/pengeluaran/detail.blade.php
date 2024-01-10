@extends('layout.layout')
@section('pengeluaran', 'active')
@section('title', 'Detail Pemasukan')
@section('content')
    <div class="row px-5">
        <div class="col-md-12">
            <div class='card'>
                <div class='card-body'>
                    <span class="h1 m">
                        Detail Data Pengeluaran
                    </span>
                        <div class='mt-1'>
                                @foreach($pengeluaran as $p)
<<<<<<< HEAD
                                <img src='../../../../foto/{{ $p->foto }}' width='400px'/>
=======
                                <img src='../../../../foto/{{ $p->foto }}' width='300px'/>
                                <br/>   
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                            <div class="row mb-2">
                                <div class="col-md-2">
                                <label class='fw-bold'>Sumber Dana</label>
                            </div>
                            <div class="col-md-3">
                                : {{$p->nama_sumber}}
                        </div>
                        </div>
<<<<<<< HEAD
                        <div class='row mb-2'>
                            <div class="col-md-2">
                                <label class='fw-bold'>Nama Pengeluaran</label>
                            </div>
                            <div class="col-md-3">
=======
                        <div class='mt-1'>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                <label class='fw-bold'>Jenis Pengeluaran</label>
                            </div>
                            <div class="col-md-3">
                                : {{$p->kategori}}
                        </div>
                        </div>
                        <div class='row mb-2'>
                            <div class="col-md-2">
                                <label class='fw-bold'>Nama Pengeluaran</label>
                            </div>
                            <div class="col-md-3">
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                                : {{$p->nama_pengeluaran}}
                            </div>
                        </div>
                        <div class='row mb-2'>
                            <div class="col-md-2">
                                <label class='fw-bold'>Jenis Pengeluaran</label>
                            </div>
                            <div class="col-md-3">
                                : {{$p->kategori}}
                            </div>
                        </div>
                        <div class='row mb-2'>
                            <div class="col-md-2">
                                <label class='fw-bold'>Penanggung Jawab</label>
                            </div>
                            <div class="col-md-3">
                                : {{$p->penanggung_jawab}}
                            </div>
                        </div>
                        <div class='row mb-2'>
                            <div class="col-md-2">
                                <label class='fw-bold'>Nominal</label>
                            </div>
                            <div class="col-md-3">
                                : {{$p->nominal}}
                            </div>
                        </div>
                        <div class='row mb-2'>
                            <div class="col-md-2">
                                <label class='fw-bold'>Waktu</label>
                            </div>
                            <div class="col-md-3">
                               : {{$p->waktu}}
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <a href="/dashboard-bendahara/pengeluaran"><btn class="btn btn-dark">KEMBALI</btn></a>
            </div>
        </div>
    </div>
</div>
                @endforeach
                @endsection
                