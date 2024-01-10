@extends('layout.layout')
<<<<<<< HEAD
@section('pengajuan-kebutuhan', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h2" style="font-weight:bold;">
                Edit Item Kebutuhan
=======
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
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
            </span>
            <form method="POST" action="simpan" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 gap-2"
                        style=" display:flex; justify-content: space-between">
                        <div class="col-md-6" style=" ">
                            <div class="form-group">
<<<<<<< HEAD
                                @foreach ($pengajuan_kebutuhan as $s)
                                    <input type="hidden" name="id_item_kebutuhan"
                                        value="{{ $s->id_pengajuan_kebutuhan }}" />
                                    <label>Pengajuan Kebutuhan</label>
                                    <select name="id_pengajuan_kebutuhan" class="form-control">
                                        <option value="{{ $s->id_pengajuan_kebutuhan }}"
                                            {{ $s->id_pengajuan_kebutuhan == $s->id_pengajuan_kebutuhan ? 'selected' : '' }}>
                                            {{ $s->nama_kegiatan }}
                                        </option>
                                    </select>
                                @endforeach
                            </div>
                            <div class="form-group">
                                @foreach ($gedung as $g)
                                    <input type="hidden" name="id_item_kebutuhan"
                                        value="{{ $g->id_gedung }}" />
                                    <label>Ruangan</label>
                                    <select name="id_gedung" class="form-control">
                                        <option value="{{ $g->id_gedung }}"
                                            {{ $g->id_gedung == $g->id_gedung ? 'selected' : '' }}>
                                            {{ $g->nama_ruangan }}
                                        </option>
                                    </select>
                                @endforeach
                            </div>

                            <input type="hidden" name="id_item_kebutuhan" value="{{ $item_kebutuhan->id_item_kebutuhan }}" />
                            <div class="form-group">
                                <label>Item Kebutuhan</label>
                                <input type="text" class="form-control" value="{{ $item_kebutuhan->item_kebutuhan }}" name="item_kebutuhan" />
                            </div>
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="text" class="form-control" value="{{ $item_kebutuhan->qty }}" name="qty" />
                            </div>
                        </div>
                        {{-- <div class="col-md-1" style=" "></div> --}}
                        <div class="col-md-6" style=" ">
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number" class="form-control" value="{{ $item_kebutuhan->harga_satuan }}" name="harga_satuan" />
                            </div>
                            <div class="form-group">
                                <label> Satuan </label>
                                <input type="text" class="form-control" value="{{ $item_kebutuhan->satuan }}" name="satuan" />
                            </div>
                            <div class="form-group">
                                <label> Spesifikasi </label>
                                <input type="text" class="form-control" value="{{ $item_kebutuhan->spesifikasi }}" name="spesifikasi" />
                            </div>
                            <div class="form-group">
                                <label>Foto Barang</label>
                                <input type="file" class="form-control" value="{{ $item_kebutuhan->foto_barang_kebutuhan }}" name="foto_barang_kebutuhan" />
                                <img src="{{ url('foto') . '/' . $item_kebutuhan->foto_barang_kebutuhan }}" width='200px'/>
                                @csrf
                            </div>
                             
                            <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                                <a href="/dashboard-pemohon/pengajuan-kebutuhan" <btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
=======
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
                                            <option hidden selected value=''>
                                                Pilih Pengeluaran</option>
                                                <option value="{{ $g->id_pengeluaran }}"
                                                {{ $item_perencanaan->id_pengeluaran == $g->id_pengeluaran ? 'selected' : '' }}>
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
                             
                                    <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                                        <a href="/dashboard-bendahara/perencanaan-keuangan/detail/{{ $item_perencanaan->id_perencanaan_keuangan }}"><btn class="btn btn-dark">KEMBALI</btn></a>
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    </div>
                                </div>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                    </div>
                    {{-- </div>
            
                        <div class="col-md-5"  style="margin-bottom:2vh">
                           
                        <div class="form-group">
<<<<<<< HEAD
                                <label>Pengajuan Kebutuhan</label>
                                <select name="id_pengajuan_kebutuhan" class="form-control">
                                    @foreach ($pengajuan_kebutuhan as $p)
                                    <option selected hidden>Pilih Pengajuan Kebutuhan</option>
                                    <option value="{{ $p->id_pengajuan_kebutuhan }}">
                                            {{ $p->nama_kegiatan }}
=======
                                <label>Perencanaan Keuangan</label>
                                <select name="id_pengajuan_perencanaan" class="form-control">
                                    @foreach ($perencanaan_keuangan as $p)
                                    <option selected hidden>Pilih Perencanaan Keuangan</option>
                                    <option value="{{ $p->id_perencanaan_keuangan }}">
                                            {{ $p->judul_perencanaan }}
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
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
<<<<<<< HEAD
                                <label>Item Kebutuhan</label>
                                <input type="text" class="form-control" name="item_kebutuhan" />
                            </div>
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="text" class="form-control" name="qty" />
=======
                                <label>Item Perencanaan</label>
                                <input type="text" class="form-control" name="item_perencanaan" />
                            </div>
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="number" class="form-control" name="qty" />
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
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
<<<<<<< HEAD
                                <input type="file" class="form-control" name="foto_barang_kebutuhan" />
=======
                                <input type="file" class="form-control" name="foto_barang_perencanaan" />
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                                @csrf
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
<<<<<<< HEAD
                        <a href="/dashboard-pemohon/pengajuan-kebutuhan" <btn class="btn btn-dark">KEMBALI</btn></a>
=======
                        <a href="/dashboard-bendahara/perencanaan-keuangan/detail/{{ $item_perencanaan->id_perencanaan_keuangan}}"><btn class="btn btn-dark">KEMBALI</btn></a>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                    </form>
                </form>
            </div> --}}

                </div>
        </div>
    </div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
