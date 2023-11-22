@extends('layout.layout')
@section('title', 'Edit Realisasi')
@section('content')
    <div class="row px-3">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Realisasi
                    </span>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                    <input type="hidden" name="id_realisasi" value="{{ $realisasi->id_realisasi }}" />
                                <div class="form-group">
                                    <label>Nama Realisasi</label>
                                    <input type="text" disabled class="form-control" name="judul_realisasi"
                                        value="{{ $realisasi->judul_realisasi }}" />
                                </div>
                                @csrf
                                
                            </div>
                            <div class="col-md-5">
                                    <div class="form-group">
                                    <label>Pengeluaran</label>
                                    <select disabled name="id_pengeluaran" class="form-control">
                                        @foreach ($pengeluaran as $s)
                                            <option value="{{ $s->id_pengeluaran }}"
                                                {{ $s->id_pengeluaran == $s->id_pengeluaran ? 'selected' : '' }}>
                                                {{ $s->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Tujuan</label>
                                    <input type="text" disabled class="form-control" name="tujuan"
                                        value="{{ $realisasi->tujuan }}" />
                                </div>
                                
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Total Pembayaran</label>
                                    <input type="text" disabled class="form-control" name="tujuan"
                                        value="{{ $realisasi->total_pembayaran }}" />
                                </div>
                                
                            </div>
                            <div class="col-md-5">
                              
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="date" disabled class="form-control" name="waktu"
                                        value="{{ $realisasi->waktu }}" />
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <p></p>
                            <div class="col-md-4">
                                <a href="/dashboard-bendahara/realisasi/detail/{{$realisasi->id_realisasi}}"><btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                                
                            </div>
                            <p>
                        </div>
                    </form>
                </div>

            </div>
@endsection
