@extends('layout.layout')
@section('pemasukan', 'active')
@section('title', 'Edit Pemasukan')
@section('content')
    <div class="row px-5">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Pemasukan
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                    <input type="hidden" name="id_pemasukan" value="{{ $pemasukan->id_pemasukan }}" />
                                    <input type="hidden" name="id_bendahara" value="{{ $pemasukan->id_bendahara }}" />
                                    <div class="form-group">
                                    <label>Nama Sumber</label>
                                    <select class='form-select' name="id_sumber_dana">
                                      @foreach ($sumber_dana as $s)
                                            <option value="{{ $s->id_sumber_dana }}"
                                                {{ $pemasukan->id_sumber_dana == $s->id_sumber_dana ? 'selected' : '' }}>
                                                {{ $s->nama_sumber }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pemasukan</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $pemasukan->nama }}" />
                                </div>
                                <div class="form-group">
                                    <label>Nominal</label>
                                    <input type="number" class="form-control" name="nominal"
                                        value="{{ $pemasukan->nominal }}" />
                                </div>
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="date" class="form-control" name="waktu"
                                        value="{{ $pemasukan->waktu }}" />
                                </div>
                                <div class="form-group">    
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto"
                                        value="{{ $pemasukan->foto }}" />

                                </div><br>
                                        <img src='../../../../foto/{{ $pemasukan->foto }}' width='200px'/>
                                @csrf
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <br/>
                                <a href="/dashboard-bendahara/pemasukan"><btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                                
                            </div>
                            <p>
                        </div>
                    </form>
                </div>

            </div>
@endsection
