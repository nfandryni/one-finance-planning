@extends('layout.layout')
@section('jenis-pengeluaran', 'active')
@section('title', 'Edit Jenis Pengeluaran')
@section('content')
    <div class="row">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Jenis Pengeluaran
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                    <input type="hidden" name="id_jenis_pengeluaran" value="{{ $jenis_pengeluaran->id_jenis_pengeluaran }}" />
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input type="text" class="form-control" name="kategori"
                                        value="{{ $jenis_pengeluaran->kategori }}" />
                            
                                @csrf
                               
                            </div>
                        </div>
                        <div class="row">
                            <P></P>
                            <div class="col-md-4">
                                <a href="/dashboard-bendahara/jenis-pengeluaran"><btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                               
                            </div>
                            <p>
                        </div>
                    </form>
                </div>


    </div>
@endsection
