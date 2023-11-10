@extends('layout.layout')
@section('jenis-pengeluaran', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Tambah Jenis Pengeluaran
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Jenis Pengeluaran</label>
                                <input type="text" class="form-control" name="kategori"/>
                                    @csrf
                                <div class="col-md-4 mt-3 d-flex " style="gap: 10px">
                                    <a href="/dashboard-bendahara/jenis-pengeluaran" <btn class="btn btn-dark">KEMBALI</btn></a>
                                    <button type="submit" class="btn btn-success">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection