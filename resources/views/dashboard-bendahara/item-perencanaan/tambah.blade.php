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
<<<<<<< HEAD
                            {{-- <div class="form-group">
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
                            </div> --}}
                            <div class="form-group">
                                <label>Nama Item</label>
                                <input type="text" class="form-control" name="item_perencanaan" />
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
                             <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
                                <a href="/dashboard-bendahara/perencanaan-keuangan" class="btn btn-dark">KEMBALI</a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                        {{-- <div class="col-md-1" style=" "></div> --}}
=======
                         <div class="form-group">
                                <label>Nama Perencanaan</label>
                                <input type="text" readonly class="form-control" style='background-color: #EAEAEA;' value='{{$perencanaan_keuangan->judul_perencanaan}}' />
                                <input type="text" hidden name='id_perencanaan_keuangan' value='{{$perencanaan_keuangan->id_perencanaan_keuangan}}' />
                                
                            </div>
                            <div class="form-group">
                                <label>Nama Item</label>
                                <input type="text" class="form-control" name="item_perencanaan" placeholder='Nama Item'/>
                                
                            </div>
                            <div class="form-group">
                                <label>QTY</label>
                                <input type="number" class="form-control" name="qty" placeholder='Quantity' />
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="number" class="form-control" name="harga_satuan" placeholder='Harga Satuan' />
                            </div>
                            <div class="form-group">
                                    <label>Ruangan</label>
                                    <br>
                                    @if($gedung->isEmpty())
                                    <a href='/dashboard-bendahara/gedung' class="btn btn-primary btn-sm">
                                    Tambah Data
                                    </a>
                                    @else
                                    <select required class='form-select' name="id_gedung">
                                        @foreach($gedung as $p)
                                        <option selected disabled hidden>Pilih Nama Ruangan</option>
                                        <option value='{{$p->id_gedung}}'>{{$p->nama_ruangan}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                             
                        </div>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                        <div class="col-md-6" style=" ">

                            <div class="form-group">
                                <label> Spesifikasi </label>
<<<<<<< HEAD
                                <input type="text" class="form-control" name="spesifikasi" />
                            </div>
                             <label> Status </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Sudah Dibeli
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Belum Dibeli
                                </label>
=======
                                <input type="text" class="form-control" name="spesifikasi" placeholder='Spesifikasi'/>
                            </div>
                             <div class="form-group">
                                <label> Satuan </label>
                                <input type="text" class="form-control" name="satuan" placeholder='Satuan'/>
                            </div>
                            <div class="form-group">
                                <label> Bulan Realisasi</label>
                                <input type="month" class="form-control" name="bulan_rencana_realisasi" />
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                            </div>
                            <div class="form-group">
                                <label>Foto Barang Perencanaan</label>
                                <input type="file" class="form-control" name="foto_barang_perencanaan" />
                                @csrf
                            </div>
<<<<<<< HEAD
                              <div class="form-group">
                                <label>Foto Realisasi</label>
                                <input type="file" class="form-control" name="foto_realisasi"/>
                                </div>
                           
=======
                           <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                                <a href="/dashboard-bendahara/perencanaan-keuangan" class="btn btn-dark">KEMBALI</a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
