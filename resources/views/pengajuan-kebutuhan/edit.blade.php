@extends('layout.layout')
@section('title','Edit Pengajuan Kebutuhan ')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Edit Pengajuan Kebutuhan {{$barang->nama_barang}}
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan">
                    <div class="row">
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </div>
                        <div class="col-md-1">
                            <a href="/dashboard/pengajuan-kebutuhan"><btn class="btn btn-secondary">KEMBALI</btn></a>
                        </div>
                        <p>
                            <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama Kegiatan</label>
                                <input type="text" class="form-control" name="nama_kegiatan" />
                            </div>
                            <div class="form-group">
                                <label>Pemohon</label>
                                <input type="text" class="form-control" name="pemohon" />
                            </div>
                            <div class="form-group">
                                <label>Waktu</label>
                                <input type="datetime" class="form-control" name="waktu" />
                            </div>
                            <div class="form-group">
                                <label>Tujuan</label>
                                <input type="text" class="form-control" name="tujuan" />
                                @csrf
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection