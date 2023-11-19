@extends('layout.layout')
@section('gedung', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
                    <span class="h1">
                        Edit Data Gedung
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                    <input type="hidden" name="id_gedung" value="{{ $gedung->id_gedung }}" />
                                    <div class="form-group">
                                        <label>Nama Gedung</label>
                                        <input type="text" class="form-control" value="{{ $gedung->nama_gedung }}" name='nama_gedung'/>
                                    </div>
                                      <div class="form-group">
                                        <label>Nama Ruangan</label>
                                        <input type="text" class="form-control" value="{{ $gedung->nama_ruangan }}" name='nama_ruangan'/>
                                    </div>
                            
                                @csrf
                               
                            </div>
                        </div>
                        <div class="row">
                            <P></P>
                            <div class="col-md-4">
                                <a href="/dashboard-pemohon/gedung"><btn class="btn btn-dark">KEMBALI</btn></a>
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


