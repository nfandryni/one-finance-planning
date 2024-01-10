@extends('layout.layout')
@section('title', 'Edit Item Kebutuhan')
@section('content')
    <div class="row px-3">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Item Kebutuhan
                    </span>
                    <p class='small fst-italic' style='color:red'>*Beberapa data tidak dapat diubah!</p>
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                        <div class="col-md-12 gap-3"
                        style=" display:flex; justify-content: space-between">
                            <div class="col-md-6">
                                <input type="hidden" name="id_item_kebutuhan" value="{{ $item_kebutuhan->id_item_kebutuhan }}" />
                                <div class="form-group">
                                    <label>Nama Item</label>
                                    <input readonly style='background-color: #EAEAEA' type="text"  class="form-control" name="item_kebutuhan" value="{{ $item_kebutuhan->item_kebutuhan }}" />
                                </div>
                                @csrf
                               
                                    <div class="form-group">
                                    <label>Qty</label>
                                    <input type="number" class="form-control" name="qty"
                                        value="{{ $item_kebutuhan->qty }}" />
                                     </div>
                                
                                <div class="form-group">
                                    <label>Harga Satuan</label>
                                    <input type="number" class="form-control" name="harga_satuan"
                                        value="{{ $item_kebutuhan->harga_satuan }}" />
                                    </div>
                                    
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" name="satuan"
                                        value="{{ $item_kebutuhan->satuan }}" />
                                </div>
                                
                                </div>
                            <div class="col-md-6 mr-2">
                                <div class="form-group">
                                    <label for="nama_gedung">Nama Ruangan</label>
                                    <input type="text"  class="form-control" style='background-color: #EAEAEA;' value="{{ $item_kebutuhan->nama_ruangan }}" readonly>
                                    <input type="hidden" name="id_gedung" value="{{ $item_kebutuhan->id_gedung }}">

                                </div>
                                
                                <div class="form-group">
                                    <label>Spesifikasi</label>
                                    <textarea readonly name='spesifikasi' style='background-color: #EAEAEA;resize:none;' type="text" class="form-control" name="spesifikasi">{{$item_kebutuhan->spesifikasi}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Foto Barang Kebutuhan</label>
                                    <br/>
                                    <img src="{{ url('foto') . '/' . $item_kebutuhan->foto_barang_kebutuhan}}" width='200px' />
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                                <a href="/dashboard-bendahara/konfirmasi-pengajuan/detail/{{$item_kebutuhan->id_pengajuan_kebutuhan}}"><btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                            <p>
                                </div>
                            </form>
                        </div>
                        
                    </div>
@endsection
