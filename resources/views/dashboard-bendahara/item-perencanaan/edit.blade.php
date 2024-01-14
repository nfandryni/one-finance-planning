@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Edit Item Perencanaan')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#pengeluaran, #foto_realisasi").hide();

        $("select[name='status']").on("change", function() {
            var selectedStatus = $(this).val();

            if (selectedStatus == 'Terbeli') {
                $("#pengeluaran, #foto_realisasi").show();
                $("#inputRealisasi, #inputPengeluaran").prop('required', true);
            } else {
                $("#pengeluaran, #foto_realisasi").hide();
            }
        });
    });
</script>

    <div class="row">
        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h2" style="font-weight:bold;">
                Edit Item Perencanaan
            </span>
            <form method="POST" action="simpan" enctype="multipart/form-data">
                @if(isset($perencanaan_keuangan->id_pengajuan_kebutuhan))
                <p class='small fst-italic' style='color:red'>*Data dari Pengajuan Kebutuhan tidak dapat diubah!</p>
                <div class="row">
                    <div class="col-md-12 gap-2"
                        style=" display:flex; justify-content: space-between">
                        <div class="col-md-6" style=" ">
                            <div class="form-group">
                                <label>Item Perencanaan</label>
                                <input type="text" class="form-control"  style='background-color: #EAEAEA' readonly value="{{ $item_perencanaan->item_perencanaan }}" name="item_perencanaan" />
                            </div>

                            <div class="form-group">
                                    <label>Ruangan</label>
                                    <select name="id_gedung" readonly  style='background-color: #EAEAEA' class="form-control">
                                            <option value="{{ $item_perencanaan->id_gedung }}">
                                                {{ $item_perencanaan->nama_ruangan }}</option>
                                    </select>
                            </div>

                            <input type="hidden" name="id_perencanaan_keuangan" value="{{ $item_perencanaan->id_perencanaan_keuangan }}" />
                            <input type="hidden" name="id_item_perencanaan" value="{{ $item_perencanaan->id_item_perencanaan }}" />
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="text" class="form-control" readonly style='background-color: #EAEAEA' value="{{ $item_perencanaan->qty }}" name="qty" />
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number" class="form-control" readonly  style='background-color: #EAEAEA' value="{{ $item_perencanaan->harga_satuan }}" name="harga_satuan" />
                            </div>
                            <div class="form-group">
                                <label> Satuan </label>
                                <input type="text" class="form-control" readonly style='background-color: #EAEAEA' value="{{ $item_perencanaan->satuan }}" name="satuan" />
                                <div class="form-group">
                                    <label> Spesifikasi </label>
                                    <input type="text" class="form-control" readonly style='background-color: #EAEAEA' value="{{ $item_perencanaan->spesifikasi }}" name="spesifikasi" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Foto Barang</label>
                                <br/>
                                <img src="{{ url('foto') . '/' . $item_perencanaan->foto_barang_perencanaan }}" width='200px'/>
                                @csrf
                            </div>
                        </div>
                        <div class="col-md-6" style=" ">
                            <div class="form-group">
                                <label> Bulan Realisasi</label>
                        <input type="month" required readonly style='background-color: #EAEAEA' class="form-control" name="bulan_rencana_realisasi" value='{{ $item_perencanaan->bulan_rencana_realisasi}}' />
                    </div>
                            <div class="form-group">
                                <label> Status </label>
                                <select class='form-select' name="status">
                                    <option value="Belum Dibeli" @if($item_perencanaan->status == 'Belum Dibeli') selected @endif>Belum Dibeli</option>
                                    <option value="Terbeli" @if($item_perencanaan->status == 'Terbeli') selected @endif>Terbeli</option>
                                </select>
                            </div>
                            <div class="form-group" id='pengeluaran'>
                                <label>Pengeluaran</label>
                                @if($pengeluaran->isEmpty())
                                <br/>
                                <a href='/dashboard-bendahara/pengeluaran' class="btn btn-primary btn-sm">
                                Tambah Data
                                </a>
                                @else
                                    <select name="id_pengeluaran" id='inputPengeluaran' class="form-control">
                                    @foreach($pengeluaran as $g)
                                            <option hidden selected value=''>
                                                Pilih Pengeluaran</option>
                                                <option value="{{ $g->id_pengeluaran }}">
                                                {{ $g->nama }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group" id='foto_realisasi'>
                                        <label>Foto Realisasi</label>
                                        <input type="file" id='inputRealisasi' class="form-control" name="foto_realisasi" />
                                        @csrf
                                    </div>
                             @else
                <div class="row">
                    <div class="col-md-12 gap-2"
                        style=" display:flex; justify-content: space-between">
                        <div class="col-md-6" style=" ">
                            <div class="form-group">
                                <label>Item Perencanaan</label>
                                <input type="text" class="form-control" value="{{ $item_perencanaan->item_perencanaan }}" name="item_perencanaan" />
                            </div>

                            <div class="form-group">
                                    <label>Ruangan</label>
                                    <select name="id_gedung" class="form-control">
                                    @foreach($gedung as $g)
                                            <option value="{{ $g->id_gedung }}"
                                                {{ $item_perencanaan->id_gedung == $g->id_gedung ? 'selected' : '' }}>
                                                {{ $g->nama_ruangan }}</option>
                                                @endforeach
                                    </select>
                            </div>

                            <input type="hidden" name="id_perencanaan_keuangan" value="{{ $item_perencanaan->id_perencanaan_keuangan }}" />
                            <input type="hidden" name="id_item_perencanaan" value="{{ $item_perencanaan->id_item_perencanaan }}" />
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="text" class="form-control" value="{{ $item_perencanaan->qty }}" name="qty" />
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number" class="form-control" value="{{ $item_perencanaan->harga_satuan }}" name="harga_satuan" />
                            </div>
                            <div class="form-group">
                                <label> Satuan </label>
                                <input type="text" class="form-control" value="{{ $item_perencanaan->satuan }}" name="satuan" />
                                <div class="form-group">
                                    <label> Spesifikasi </label>
                                    <input type="text" class="form-control" value="{{ $item_perencanaan->spesifikasi }}" name="spesifikasi" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Foto Barang</label>
                                <input type="file" class="form-control" value="{{ $item_perencanaan->foto_barang_perencanaan }}" name="foto_barang_perencanaan" />
                                <br/>
                                <img src="{{ url('foto') . '/' . $item_perencanaan->foto_barang_perencanaan }}" width='200px'/>
                                @csrf
                            </div>
                        </div>
                        <div class="col-md-6" style=" ">
                            <div class="form-group">
                                <label> Bulan Realisasi</label>
                        <input type="month" required class="form-control" name="bulan_rencana_realisasi" value='{{ $item_perencanaan->bulan_rencana_realisasi}}' />
                    </div>
                            <div class="form-group">
                                <label> Status </label>
                                <select class='form-select' name="status">
                                    <option value="Belum Dibeli" @if($item_perencanaan->status == 'Belum Dibeli') selected @endif>Belum Dibeli</option>
                                    <option value="Terbeli" @if($item_perencanaan->status == 'Terbeli') selected @endif>Terbeli</option>
                                </select>
                            </div>
                            <div class="form-group" id='pengeluaran'>
                                <label>Pengeluaran</label>
                                @if($pengeluaran->isEmpty())
                                <br/>
                                <a href='/dashboard-bendahara/pengeluaran' class="btn btn-primary btn-sm">
                                Tambah Data
                                </a>
                                @else
                                    <select name="id_pengeluaran" id='inputPengeluaran' class="form-control">
                                    @foreach($pengeluaran as $g)
                                            <option disabled selected value=''>
                                                Pilih Pengeluaran</option>
                                                <option value="{{ $g->id_pengeluaran }}">
                                                {{ $g->nama }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group" id='foto_realisasi'>
                                        <label>Foto Realisasi</label>
                                        <input type="file" id='inputRealisasi' class="form-control" name="foto_realisasi" />
                                        @csrf
                                    </div>

                             
                    @endif
                                    <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                                        <a href="/dashboard-bendahara/perencanaan-keuangan/detail/{{ $item_perencanaan->id_perencanaan_keuangan }}"><btn class="btn btn-dark">KEMBALI</btn></a>
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    </div>
                                </div>
                    </div>
                    </form>
                    

                </div>
        </div>
    </div>
@endsection