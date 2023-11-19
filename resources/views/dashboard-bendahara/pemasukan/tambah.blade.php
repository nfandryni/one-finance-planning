@extends('layout.layout')
@section('title', 'Tambah Pemasukan ')
@section('content')
<br>
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
                                        @foreach($sumber_dana as $p)
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
                                    <input type="file" class="form-control" name="file" required/>
                                </div>
                                <p></p>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="/dashboard-bendahara/pemasukan"><btn class="btn btn-danger inline-block ">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-success inline-block">SIMPAN</button>
                                
                            </div>
                                @csrf
                        </div>
                    </form>
                </div>

        </div>
@endsection
