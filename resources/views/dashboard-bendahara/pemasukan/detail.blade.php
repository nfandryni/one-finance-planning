@extends('layout.layout')
@section('pemasukan', 'active') 
@section('title', 'Detail Pemasukan')
@section('content')
    <div class="row px-5">
        <div class="col-md-12">
            <div class='card'>
                <div class='card-body'>
                    <span class="h1 m">
                        Detail Data Pemasukan
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                                @foreach($pemasukan as $p)
                        <div class='mt-1'>
<<<<<<< HEAD
                                <img src='../../../../foto/{{ $p->foto }}' width='400px'/>
=======
                                <img src='../../../../foto/{{ $p->foto }}' width='300px'/>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f

                            <div class="row mb-2">
                                <div class="col-md-2">
                                <label class='fw-bold'>Sumber Dana</label>
                            </div>
                            <div class="col-md-3">
                                : {{$p->nama_sumber}}
                        </div>
                        </div>
                        <div class='row mb-2'>
                            <div class="col-md-2">
                                <label class='fw-bold'>Nama Pemasukan</label>
                            </div>
                            <div class="col-md-3">
                                : {{$p->nama_pemasukan}}
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
                                <label class='fw-bold'>Penanggung Jawab</label>
                            </div>
                            <div class="col-md-3">
                               : {{$p->penanggung_jawab}}
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <a href="/dashboard-bendahara/pemasukan"><btn class="btn btn-dark">KEMBALI</btn></a>
            </div>
        </div>
    </div>
</div>
                @endforeach
                @endsection
                