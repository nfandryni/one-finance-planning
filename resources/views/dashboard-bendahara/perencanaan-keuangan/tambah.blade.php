@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
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
                            <input type="text" class="form-control" required name="judul_perencanaan" />
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <input type="text" class="form-control" required name="tujuan" />
                        </div>
                    </div>
                    <div class="col-md-6" style=" ">
                        <div class="form-group">
                            <label>Sumber Dana</label>
                            <select name="id_sumber_dana" class="form-control">
                                @foreach ($sumber_dana as $s)
                                    <option selected hidden>Pilih Sumber Dana</option>
                                    <option value="{{ $s->id_sumber_dana }}">
                                        {{ $s->nama_sumber }}
                                    </option>
                                @endforeach
                            </select>
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