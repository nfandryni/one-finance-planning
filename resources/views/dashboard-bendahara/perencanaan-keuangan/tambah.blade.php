@extends('layout.layout')
@section('title', 'Tambah Realisasi ')
@section('content')
<div class="row">
    <div class="col-md-12">
                    <span class="h1">
                        Tambah Data Perencanaan Keuangan
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Perencanaan Keuangan</label>
                                    <div class="form-group">
                                        <select id="">
                                            @foreach($perencanaan_keuangan as $p)
                                            <option value="{{$p->id_perencanaan_keuangan}}">{{$p->judul_perencanaan}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label>Tujuan</label>
                                <input type="text" class="form-control" name="tujuan" value='{{$perencanaan_keuangan->tujuan}}'/>
                                
                            </div>
                            <div class="form-group">
                                <label>Waktu</label>
                                <input type="date" class="form-control" name="waktu" value="{{$perencanaan_keuangan->waktu}}" />
                                
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    @foreach ($perencanaan_keuangan as $p)
                                    <option selected hidden>{{$p->status}}</option>
                                    <option value="{{ $p->status }}">{{ $p->status }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Foto Perencanaan</label>
                                    <input accept="image/*" type="file" class="form-control" name="foto_perencanaan" />
                                </div> --}}
                                    
                                    <div class="form-group">
                                        <label>Total Pembayaran</label>
                                        <input accept="image/*" type="file" class="form-control" name="file" />
                                    </div>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="/dashboard-bendahara/realisasi"><btn class="btn btn-dark">KEMBALI</btn></a>
                                        <button type="submit" class="btn btn-success">SIMPAN</button>
                                        
                                    </div>
                                    <p>
                                        @csrf
                                    </form>
                                </div>
                                
                            </div>
                        </div>
    </div>
    @endsection
    