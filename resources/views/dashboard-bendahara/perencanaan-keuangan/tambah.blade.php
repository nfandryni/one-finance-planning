@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan Kebutuhan')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h2" style="font-weight:bold;">
                Tambah Perencanaan Keuangan
            </span>
        </div>
        <form method="POST" action="simpan">
            <div class="row">
                <div class="col-md-5" style="margin-bottom:2vh">
                    <div>
                        <label>Pengajuan Kebutuhan</label>
                        @foreach ($pengajuan_kebutuhan as $p)
                            <input type="text" name="id_pengajuan_kebutuhan" class="form-control"
                                value="{{ $p->id_pengajuan_kebutuhan }}" />
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Sumber Dana</label>
                        <input type="text" class="form-control" name="sumber_dana" />
                    </div>
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <input type="text" class="form-control" name="nama_kegiatan" />
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="date" class="form-control" name="waktu" />
                    </div>
                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" class="form-control" name="tujuan" />
                        @csrf
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input type="date" class="form-control" name="waktu" />
                    </div>

                </div>
            </div>
            <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
                <a href="/dashboard-pemohon/pengajuan-kebutuhan" <btn class="btn btn-dark">KEMBALI</btn></a>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
        </form>
        </form>
    </div>

    </div>
    </div>
    </div>
@endsection
