@extends('layout.layout')
@section('pengajuan-kebutuhan', 'active')
@section('title', 'Edit Item Kebutuhan')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h2" style="font-weight:bold;">
                Edit Item Kebutuhan
            </span>
            <form method="POST" action="simpan" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 gap-2"
                        style=" display:flex; justify-content: space-between">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pengajuan Kebutuhan</label>
                                <input type="text" readonly class="form-control" style='background-color: #EAEAEA;' value='{{$pengajuan_kebutuhan->nama_kegiatan}}' />
                                <input type="text" hidden name='id_pengajuan_kebutuhan' value='{{$pengajuan_kebutuhan->id_pengajuan_kebutuhan}}' />
                            </div>
                            <div class="form-group">
                                <label>Ruangan</label>
                                <select name="id_gedung" class="form-control">
                                        @foreach ($gedung as $g)
                                        <option value="{{ $g->id_gedung }}"
                                            {{ $item_kebutuhan->id_gedung == $g->id_gedung ? 'selected' : '' }}>
                                            {{ $g->nama_ruangan }}
                                        </option>
                                        @endforeach
                                    </select>
                            </div>

                            <input type="hidden" name="id_item_kebutuhan" value="{{ $item_kebutuhan->id_item_kebutuhan }}" />
                            <div class="form-group">
                                <label>Item Kebutuhan</label>
                                <input type="text" required class="form-control" value="{{ $item_kebutuhan->item_kebutuhan }}" name="item_kebutuhan" />
                            </div>
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="text" required class="form-control" value="{{ $item_kebutuhan->qty }}" name="qty" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number" required class="form-control" value="{{ $item_kebutuhan->harga_satuan }}" name="harga_satuan" />
                            </div>
                            <div class="form-group">
                                <label> Satuan </label>
                                <input type="text" required class="form-control" value="{{ $item_kebutuhan->satuan }}" name="satuan" />
                            </div>
                            <div class="form-group">
                                <label> Spesifikasi </label>
                                <input type="text" required class="form-control" value="{{ $item_kebutuhan->spesifikasi }}" name="spesifikasi" />
                            </div>
                            <div class="form-group">
                                <label>Foto Barang</label>
                                <input type="file" class="form-control mb-2" value="{{ $item_kebutuhan->foto_barang_kebutuhan }}" name="foto_barang_kebutuhan" />
                                <img src="{{ url('foto') . '/' . $item_kebutuhan->foto_barang_kebutuhan }}" width='200px'/>
                                @csrf
                            </div>
                             
                            <div class="col-md-12 mt-3 d-flex" style="gap: 10px; justify-content:end">
                                <a href="/dashboard-pemohon/pengajuan-kebutuhan/detail/{{$pengajuan_kebutuhan->id_pengajuan_kebutuhan}}"><btn class="btn btn-dark">KEMBALI</btn></a>
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
                                <input type="number" class="form-control" name="qty" />
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
