@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Perencanaan Keuangan
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 gap-2" style="display:flex; justify-content: space-between">
                    <div class="col-md-6" style=" ">
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
<<<<<<< HEAD
                            <label>Waktu</label>
                            <input type="date" class="form-control" required name="waktu" value="{{ $perencanaan_keuangan->waktu }}"/>
                        </div>
=======
                                 <label>Sumber Dana</label>
                                 <select class='form-select' name="id_sumber_dana">
                                    @foreach($sumber_dana as $s)
                                            <option value="{{ $s->id_sumber_dana }}"
                                                {{ $perencanaan_keuangan->id_sumber_dana == $s->id_sumber_dana ? 'selected' : '' }}>
                                                {{ $s->nama_sumber }}</option>
                                    @endforeach
                                    </select>
                         </div>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                          <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start"  required>
                           <a href="/dashboard-bendahara/perencanaan-keuangan" class="btn btn-dark">KEMBALI</a>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </div>
                    <div class="col-md-6" style=" ">
                        <div class="form-group">
<<<<<<< HEAD
=======
                            @if(isset($perencanaan_keuangan->id_pengajuan_kebutuhan))
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                        <div class="form-group">
                            <label>Pengajuan Kebutuhan</label>
                            <input type="text" class="form-control" required name="id_pengajuan_kebutuhan" value="{{ $perencanaan_keuangan->id_pengajuan_kebutuhan }}"/>
                        </div>
<<<<<<< HEAD
                           <div class="form-group">
                                @foreach ($sumber_dana as $s)
                                    <input type="hidden" name="id_item_kebutuhan"
                                        value="{{ $s->id_sumber_dana }}" />
                                    <label>Sumber Dana</label>
                                    <select name="id_sumber_dana" class="form-control">
                                        <option value="{{ $s->id_sumber_dana }}"
                                            {{ $s->id_sumber_dana == $perencanaan_keuangan->id_sumber_dana ? 'selected' : '' }}>
                                            {{ $s->nama_sumber }}
                                        </option>
                                    </select>
                                @endforeach
                            </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" class="form-control" required name="total_dana_perencanaan" value="{{ $perencanaan_keuangan->total_dana_perencanaan }}" />
                        </div>
=======
                        @endif
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                        @csrf
                    </div>
                </div>
            </div>
        </form>
                </div>


            </div>
        </div>
    </div>
<<<<<<< HEAD
@endsection


=======
@endsection
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
