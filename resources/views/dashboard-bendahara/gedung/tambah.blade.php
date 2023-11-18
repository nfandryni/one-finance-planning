@extends('layout.layout')
@section('title', 'Tambah Gedung ')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Tambah Data Gedung
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Gedung</label>
                                    <input type="text" class="form-control" name="nama_gedung" />
                                    
                                </div>
                                <div class="form-group">
                                    <label>Nama Ruangan</label>
                                    <input type="text" class="form-control" name="nama_ruangan" />
                                    
                                </div>
                                
                        <div class="row">
                            <hr>
                            <div class="col-md-4">
                                <a href="/dashboard/surat"><btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-success">SIMPAN</button>
                                
                            </div>
                            <p>
                                @csrf
                            <hr>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
