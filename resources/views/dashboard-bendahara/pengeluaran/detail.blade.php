@extends('layout.layout')
@section('title', 'Detail Pengeluaran')
@section('content')
    <div class="row px-5">
        <div class="col-md-12">
            <div class='card'>
                <div class='card-body'>
                    <span class="h1 m">
                        Detail Data Pengeluaran
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class='mt-1'>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                @foreach($pengeluaran as $p)
                                <label class='fw-bold'>Sumber Dana</label>
                            </div>
                            <div class="col-md-3">
                                : {{$p->nama_sumber}}
                        </div>
                        </div>
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
                                : {{$p->nama}}
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
                        <div class='row mb-2'>
                            <div class="col-md-2">
                                <label class='fw-bold'>Bukti Pengeluaran </label>
                            </div>
                            <div class="col-md-3">
                                :
                                <img src='../../../../foto/{{ $p->foto }}' width='200px'/>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            
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
                