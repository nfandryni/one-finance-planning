@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Tambah Perencanaan Keuangan')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h2" style="font-weight:bold;">
                Tambah Data Perencanaan Keuangan
            </span>
        </div>
        <form method="POST" action="simpan" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 gap-2" style="display:flex; justify-content: space-between">
                    <div class="col-md-6" style=" ">
                        <div class="form-group">
                            <label>Nama Perencanaan</label>
                            <input type="text" class="form-control" required name="judul_perencanaan" placeholder='Nama Perencanaan' />
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <input type="text" class="form-control" required name="tujuan" placeholder='Tujuan' />
                        </div>
                        <div class="form-group">
                            <label>Waktu</label>
                            <input type="date" class="form-control" required name="waktu" />
                        </div>
                        <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <br>
                                    @if($sumber_dana->isEmpty())
                                    <a href='/dashboard-bendahara/sumber-dana' class="btn btn-primary btn-sm">
                                    Tambah Data
                                    </a>
                                    @else
                                    <select required class='form-select' name="id_sumber_dana">
                                        @foreach($sumber_dana as $p)
                                        <option selected disabled hidden>Pilih Nama Sumber</option>
                                        <option value='{{$p->id_sumber_dana}}'>{{$p->nama_sumber}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                        <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start"  required>
                           <a href="/dashboard-bendahara/perencanaan-keuangan" class="btn btn-dark">KEMBALI</a>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                        @csrf
                    </div>
                </div>
            </div>
        </form>
        {{-- <form method="POST" action="simpan">
            <div class="row">
                <div class="col-md-5" style="margin-bottom:2vh">
                    <div>
                        <label>ID Pengajuan Kebutuhan</label>
                        <input type="text" name="id_pengajuan_kebutuhan" required class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>ID Sumber Dana</label>
                        <input type="text" class="form-control" required name="id_sumber_dana" />
                    </div>
                    <div class="form-group">
                        <label>Judul Perencanaan</label>
                        <input type="text" class="form-control" required name="judul_perencanaan" />
                    </div>
                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" class="form-control" required name="tujuan" />
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="date" class="form-control" required name="waktu" />
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input type="number" class="form-control" required name="total_dana_perencanaan" />
                    </div>

                </div>
            </div>
            <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
                <a href="/dashboard-bendahara/perencanaan-keuangan" <btn class="btn btn-dark">KEMBALI</btn></a>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
            @csrf
        </form> --}}
    </div>

    </div>
    </div>
    </div>
@endsection