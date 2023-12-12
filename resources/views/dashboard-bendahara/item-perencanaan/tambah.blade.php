@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h2" style="font-weight:bold;">
                Tambah Item Perencanaan
            </span>
            <form method="POST" action="simpan" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 gap-2" style="display:flex; justify-content: space-between">
                        <div class="col-md-6" style=" ">
                         <div class="form-group">
                                <label>Nama Perencanaan</label>
                                <input type="text" class="form-control" style='background-color: #EAEAEA;' value='{{$perencanaan_keuangan->judul_perencanaan}}' />
                                <input type="text" hidden name='id_perencanaan_keuangan' value='{{$perencanaan_keuangan->id_perencanaan_keuangan}}' />
                                
                            </div>
                            <div class="form-group">
                                <label>Nama Item</label>
                                <input type="text" class="form-control" name="item_perencanaan" />
                                
                            </div>
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="number" class="form-control" name="qty" />
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number" class="form-control" name="harga_satuan" />
                            </div>
                            <div class="form-group">
                                <label>Ruangan</label>
                                <select name="id_gedung" class="form-control">
                                    @foreach ($gedung as $g)
                                        <option selected hidden>Pilih Ruangan</option>
                                        <option value="{{ $g->id_gedung }}">
                                            {{ $g->nama_ruangan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                             
                        </div>
                        {{-- <div class="col-md-1" style=" "></div> --}}
                        <div class="col-md-6" style=" ">

                            <div class="form-group">
                                <label> Spesifikasi </label>
                                <input type="text" class="form-control" name="spesifikasi" />
                            </div>
                             <div class="form-group">
                                <label> Satuan </label>
                                <input type="text" class="form-control" name="satuan" />
                            </div>
                            <div class="form-group">
                                <label> Bulan Realisasi</label>
                                <input type="month" class="form-control" name="bulan_rencana_realisasi" />
                            </div>
                            <div class="form-group">
                                <label>Foto Barang Perencanaan</label>
                                <input type="file" class="form-control" name="foto_barang_perencanaan" />
                                @csrf
                            </div>
                           <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                                <a href="/dashboard-bendahara/perencanaan-keuangan" class="btn btn-dark">KEMBALI</a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection