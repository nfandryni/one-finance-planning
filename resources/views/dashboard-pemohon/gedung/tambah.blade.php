@extends('layout.layout')
@section('gedung', 'active')
@section('title', 'Daftar Gedung')
@section('content')
<div class="row">
    <div class="col-md-12"  style="margin-bottom:2vh">
                <span class="h2" style="font-weight:bold;">
                    Tambah Gedung
                </span>
            </div>
            <form method="POST" action="simpan">
                    <div class="row">
                        <div class="col-md-5"  style="margin-bottom:2vh">
                             <div class="form-group">
                                <label>Nama Gedung</label>
                                <input type="text" class="form-control" name="nama_gedung" />
                            </div>
                            <div class="form-group">
                                <label>Nama Ruangan</label>
                                <input type="text" class="form-control" name="nama_ruangan" />
                            </div>
                              </div>
                                 <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
                                    <a href="/dashboard-pemohon/gedung" <btn class="btn btn-dark">Batal</btn></a>
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                </div>
                                @csrf 
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection