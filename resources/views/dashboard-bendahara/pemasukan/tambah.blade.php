@extends('layout.layout')
@section('pemasukan', 'active')
@section('title', 'Tambah Pemasukan ')
@section('content')
    <div class="row px-5">
        <div class="col-md-12">
          
                    <span class="h1">
                        Tambah Data Pemasukan
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <br>
                                    <select class='form-select' name="id_sumber_dana">
                                        @foreach($sumberDana as $p)
                                        <option selected disabled hidden>Pilih Nama Sumber</option>
                                        <option value='{{$p->id_sumber_dana}}'>{{$p->nama_sumber}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pemasukan</label>
                                    <input type="text" class="form-control" name="nama" required/>
                                </div>
                                <div class="form-group">
                                    <label>Nominal</label>
                                    <input type="number" class="form-control" name="nominal" required/>
                                </div>
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="date" class="form-control" name="waktu" required/>
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" required/>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/dashboard-bendahara/pemasukan"><btn class="btn btn-dark">KEMBALI</btn></a>
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                        
                                    </div>
                                </div>
                                @csrf
                            </form>
                </div>

    </div>
@endsection