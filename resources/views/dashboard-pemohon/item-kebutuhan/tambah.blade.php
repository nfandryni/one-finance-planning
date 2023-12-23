@extends('layout.layout')
@section('pengajuan-kebutuhan', 'active')
@section('title', 'Daftar Pengajuan Kebutuhan')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h2" style="font-weight:bold;">
                Tambah Item Kebutuhan
            </span>
            <form method="POST" action="/dashboard-pemohon/item-kebutuhan/simpan" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 gap-2"
                        style="display:flex; justify-content: space-between">
                        <div class="col-md-6" style=" ">
                            <div class="form-group">
                                <label>Nama Pengajuan</label>
                                <input type="text" readonly class="form-control" style='background-color: #EAEAEA;' value='{{$pengajuan_kebutuhan->nama_kegiatan}}' />
                                <input type="text" hidden name='id_pengajuan_kebutuhan' value='{{$pengajuan_kebutuhan->id_pengajuan_kebutuhan}}' />

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
                            <div class="form-group">
                                <label>Item Kebutuhan</label>
                                <input type="text" class="form-control" name="item_kebutuhan" />
                            </div>
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="text" class="form-control" name="qty" />
                            </div>
                        </div>
                        {{-- <div class="col-md-1" style=" "></div> --}}
                        <div class="col-md-6" style=" ">
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number" class="form-control" name="harga_satuan" />
                            </div>
                            <div class="form-group">
                                <label> Satuan </label>
                                <input type="text" class="form-control" name="satuan" />
                            </div>
                            <div class="form-group">
                                <label> Spesifikasi </label>
                                <input type="text" class="form-control" name="spesifikasi" />
                            </div>
                            <div class="form-group">
                                <label>Foto Barang</label>
                                <input type="file" class="form-control" name="foto_barang_kebutuhan" />
                                @csrf
                            </div>
                            <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                                <a href="/dashboard-pemohon/pengajuan-kebutuhan" <btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                    {{-- </div>
            
                        <div class="col-md-5"  style="margin-bottom:2vh">
                           
                        <div class="form-group">
                                <label>Pengajuan Kebutuhan</label>
                                <select name="id_pengajuan_kebutuhan" class="form-control">
                                    @foreach ($pengajuan_kebutuhan as $p)
                                    <option selected hidden>Pilih Pengajuan Kebutuhan</option>
                                    <option value="{{ $p->id_pengajuan_kebutuhan }}">
                                            {{ $p->nama_kegiatan }}
                                        </option>
                                    @endforeach
                                </select>
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
                            <div class="form-group">
                                <label>Item Kebutuhan</label>
                                <input type="text" class="form-control" name="item_kebutuhan" />
                            </div>
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="text" class="form-control" name="qty" />
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number" class="form-control" name="harga_satuan" />
                            </div>
                            <div class="form-group">
                                <label> Satuan </label>
                                <input type="text" class="form-control" name="satuan" />
                            </div>
                            <div class="form-group">
                                <label> Spesifikasi </label>
                                <input type="text" class="form-control" name="spesifikasi" />
                            </div>
                            <div class="form-group">
                                <label>Foto Barang</label>
                                <input type="file" class="form-control" name="foto_barang_kebutuhan" />
                                @csrf
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
                        <a href="/dashboard-pemohon/pengajuan-kebutuhan" <btn class="btn btn-dark">KEMBALI</btn></a>
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                    </form>
                </form>
            </div> --}}

                </div>
        </div>
    </div>
@endsection
