@extends('layout.layout')
@section('sumber-dana', 'active')
@section('title', 'Edit Sumber Dana')
@section('content')
    <div class="row px-3">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Sumber Dana
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                    <input type="hidden" name="id_sumber_dana" value="{{ $sumber_dana->id_sumber_dana }}" />
                                <div class="form-group">
                                    <label>Nama Sumber Dana</label>
                                    <input type="text" class="form-control" name="nama_sumber"
                                        value="{{ $sumber_dana->nama_sumber }}" />
                                </div>
                                @csrf
                                
                            </div>
                        </div>
                        <div class="row">
                            <P></P>
                            <div class="col-md-4">
                                <a href="/dashboard-bendahara/sumber-dana"><btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                                
                            </div>
                            <p>
                        </div>
                    </form>
                </div>

            </div>
@endsection
