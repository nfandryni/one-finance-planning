@extends('layout.layout')
@section('title', 'Tambah Realisasi ')
@section('content')
<div class="row">
    <div class="col-md-12">
                    <span class="h1">
                        Tambah Data Realisasi
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Realisasi</label>
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
                                <input type="text" class="form-control" name="tujuan" value='{{$p->tujuan}}'/>
                                
                            </div>
                            <div class="form-group">
                                <label>Waktu</label>
                                <input type="date" class="form-control" name="waktu" value="{{$p->waktu}}" />
                                
                            </div>
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" class="form-control" name="item_perencanaan" />
                                
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    @foreach ($realisasi as $s)
                                    <option selected hidden>{{$s->status}}</option>
                                    <option value="{{ $s->status }}">{{ $s->status }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Foto Perencanaan</label>
                                    <input accept="image/*" type="file" class="form-control" name="foto_perencanaan" />
                                </div>
                                <div class="form-group">
                                    <label>Foto Realisasi</label>
                                    <input accept="image/*" type="file" class="form-control" name="foto_realisasi" />
                                </div>
                                <div class="form-group">
                                    <label>Pengeluaran</label>
                                    <select name="id_pengeluaran" class="form-control">
                                        @foreach ($realisasi as $jenis)
                                        <option selected hidden>Jenis Surat</option>
                                        <option value="{{ $jenis->id_jenis_surat }}">{{ $jenis->jenis_surat }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
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
    