@extends('layout.layout')
@section('pengeluaran', 'active')
@section('content')
    <div class="row px-5">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Pengeluaran
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <select name="id_sumber_dana" class="form-control">
                                        @foreach ($sumber_dana as $s)
                                            <option value="{{ $s->id_sumber_dana }}"
                                                {{ $s->id_sumber_dana == $s->id_sumber_dana ? 'selected' : '' }}>
                                                {{ $s->nama_sumber }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Pengeluaran</label>
                                    <select name="id_jenis_pengeluaran" class="form-control">
                                        @foreach ($jenis_pengeluaran as $s)
                                            <option value="{{ $s->id_jenis_pengeluaran }}"
                                                {{ $s->id_jenis_pengeluaran == $s->id_jenis_pengeluaran ? 'selected' : '' }}>
                                                {{ $s->kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Nama Pengeluaran</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $pengeluaran->nama }}" />
                                </div>
                                <div class="form-group">
                                    <label>Nominal</label>
                                    <input type="text" class="form-control" name="nominal"
                                        value="{{ $pengeluaran->nominal }}" />
                                </div>
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="date" class="form-control" name="waktu"
                                        value="{{ $pengeluaran->waktu }}" />
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" 
                                    value="{{ $pengeluaran->foto }}"/><br/>
                                    <img src="{{ url('foto') . '/' . $pengeluaran->foto }}" width='200px'/>

                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id_pengeluaran" value="{{ $pengeluaran->id_pengeluaran }}" />
                                </div>
                                @csrf
                                <div class="row">
                                <div class="col-md-4">
                                <br/>
                                <a href="/dashboard-bendahara/pengeluaran"><btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-success">SIMPAN</button>
                                
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
@endsection