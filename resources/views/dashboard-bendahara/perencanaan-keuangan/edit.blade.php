@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Edit Perencanaan Keuangan')
@section('content')
    <div class="row ">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Perencanaan Keuangan
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 gap-2" style="display:flex; justify-content: space-between">
                    <div class="col-md-5">
                     <input type="hidden" name="id_perencanaan_keuangan" value="{{ $perencanaan_keuangan->id_perencanaan_keuangan }}" />
                        <div class="form-group">
                            <label>Nama Perencanaan</label>
                            <input type="text" class="form-control" required name="judul_perencanaan" value="{{ $perencanaan_keuangan->judul_perencanaan }}"/>
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <input type="text" class="form-control" required name="tujuan" value="{{ $perencanaan_keuangan->tujuan }}"/>
                        </div>
                        <div class="form-group">
                            <label>Waktu</label>
                            <input type="date" class="form-control" required name="waktu" value="{{ $perencanaan_keuangan->waktu }}"/>
                        </div>
                        <div class="form-group">
                                 <label>Sumber Dana</label>
                                 <select class='form-select' name="id_sumber_dana">
                                    @foreach($sumber_dana as $s)
                                            <option value="{{ $s->id_sumber_dana }}"
                                                {{ $perencanaan_keuangan->id_sumber_dana == $s->id_sumber_dana ? 'selected' : '' }}>
                                                {{ $s->nama_sumber }}</option>
                                    @endforeach
                                    </select>
                         </div>
                          <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start"  required>
                           <a href="/dashboard-bendahara/perencanaan-keuangan" class="btn btn-dark">KEMBALI</a>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </div>
                    <div class="col-md-6" style=" ">
                        <div class="form-group">
                            @if(isset($perencanaan_keuangan->id_pengajuan_kebutuhan))
                        <div class="form-group">
                            <label>Pengajuan Kebutuhan</label>
                            <input type="text" class="form-control" required name="id_pengajuan_kebutuhan" value="{{ $perencanaan_keuangan->id_pengajuan_kebutuhan }}"/>
                        </div>
                        @endif
                        @csrf
                    </div>
                </div>
            </div>
        </form>
                </div>


            </div>
        </div>
    </div>
@endsection
