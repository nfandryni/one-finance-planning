@extends('layout.layout')
@section('pengajuan-kebutuhan', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Pengajuan Kebutuhan
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                    <input type="hidden" name="id_pengajuan_kebutuhan" value="{{ $pengajuan_kebutuhan->id_pengajuan_kebutuhan }}" />
                                    <div class="form-group">
                                        <label>Nama Kegiatan</label>
                                        <input type="text" class="form-control" value="{{ $pengajuan_kebutuhan->nama_kegiatan }}" name='nama_kegiatan'/>
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu</label>
                                        <input type="date" class="form-control" value="{{ $pengajuan_kebutuhan->waktu }}" name='waktu'/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tujuan</label>
                                        <input type="text" class="form-control" value="{{ $pengajuan_kebutuhan->tujuan }}" name='tujuan'/>
                                    </div>
                            
                                @csrf
                               
                            </div>
                        </div>
                        <div class="row">
                            <P></P>
                            <div class="col-md-4">
                                <a href="/dashboard-pemohon/pengajuan-kebutuhan"><btn class="btn btn-dark">KEMBALI</btn></a>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                               
                            </div>
                            <p>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection


