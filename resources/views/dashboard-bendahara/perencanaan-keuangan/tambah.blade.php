@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
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
                        <label>ID Pengajuan Kebutuhan</label>
                            <input type="text" name="id_pengajuan_kebutuhan" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>ID Sumber Dana</label>
                        <input type="text" class="form-control" name="id_sumber_dana" />
                    </div>
                    <div class="form-group">
                        <label>Judul Perencanaan</label>
                        <input type="text" class="form-control" name="judul_perencanaan" />
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="date" class="form-control" name="waktu" />
                    </div>
                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" class="form-control" name="tujuan" />
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <input type="number" class="form-control" name="'total_dana_keuangan'" />
                    </div>

                </div>
            </div>
            <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
                <a href="/dashboard-pemohon/perencanaan-keuangan" <btn class="btn btn-dark">KEMBALI</btn></a>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
             @csrf
        </form>
        </form>
    </div>

    </div>
    </div>
    </div>
@endsection
