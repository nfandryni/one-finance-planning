@extends('layout.layout')
@section('pengeluaran', 'active ')
@section('content')
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Tambah Pengeluaran
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <select class="form-select" name='id_sumber_dana'>
                                        @foreach ($sumber_dana as $s)
                                        <option selected hidden>Pilih Sumber Dana</option>
                                        <option value="{{$s->id_sumber_dana}}">{{$s->nama_sumber}}</option>
                                        @endforeach
                                    </select>
                                    <label>Jenis Pengeluaran</label>
                                    <select class="form-select" name='id_jenis_pengeluaran'>
                                        @foreach ($jenis_pengeluaran as $s)
                                        <option selected hidden>Pilih Jenis Pengeluaran</option>
                                        <option value="{{$s->id_jenis_pengeluaran}}">{{$s->kategori}}</option>
                                        @endforeach
                                    </select>
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" />
                                    <label>Nominal</label>
                                    <input type="text" class="form-control" name="nominal" />
                                    <label>Waktu</label>
                                    <input type="date" class="form-control" name="waktu" />
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" />
                                </div>      
                                </div>
                                <div class="col-md-4 mt-3" style="gap: 10px">
                                    <a href="/dashboard-bendahara/pengeluaran" <btn class="btn btn-dark">KEMBALI</btn></a>
                                    <button type="submit" class="btn btn-success">SIMPAN</button>
                                </div>
                                @csrf
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection