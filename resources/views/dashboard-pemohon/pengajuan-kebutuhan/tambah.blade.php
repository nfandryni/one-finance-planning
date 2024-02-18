@extends('layout.layout')
@section('pengajuan-kebutuhan', 'active')
@section('title', 'Tambah Pengajuan Kebutuhan')
@section('content')
<div class="row px-3">
    <div class="col-md-12"  style="margin-bottom:2vh">
                <span class="h2" style="font-weight:bold;">
                    Tambah Pengajuan Kebutuhan
                </span>
            </div>
              <form method="POST" action="simpan">
                    <div class="row">
                        <div class="col-md-5"  style="margin-bottom:2vh">
                           
                            <div class="form-group">
                                <label>Nama Kegiatan</label>
                                <input type="text" required class="form-control" name="nama_kegiatan" placeholder="Nama Kegiatan" />
                            </div>
                            <div class="form-group">
                                <label>Tujuan</label>
                                <input type="text" required class="form-control" name="tujuan" placeholder="Tujuan" />
                                @csrf
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