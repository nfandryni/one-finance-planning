@extends('layout.layout')
@section('pengajuan-kebutuhan', 'active')
@section('title', 'Daftar Pengajuan Kebutuhan')
@section('content')
    <div class="row px-5">
                        
        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h4" style="font-weight:bold;">Detail Pengajuan Kebutuhan</span>
        </div>    
        <div class="card">
            <div class="card-body">
                {{-- <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                <div class="col-md-12"  style=" display:flex">
                <div class="col-md-3"  style=" ">
                 @foreach ($pengajuan_kebutuhan as $s)
                   <div class="form-group">
                        <h5 style="font-weight:bold;">Nama Kegiatan</h5>
                                       
                    </div>
                    <div class="form-group">
                        <h5 style="font-weight:bold;">Status</h5>
                                       
                    </div>
                    <div class="form-group">
                        <h5 style="font-weight:bold;">Waktu</h5>
                                        
                    </div>
                    <div class="form-group">
                        <h5 style="font-weight:bold;">Tujuan</h5>
                                       
                    </div>
                    <div class="form-group">
                        <h5 style="font-weight:bold;">List Kebutuhan</h5>
                                       
                    </div>
                </div>
                <div class="col-md-3"  style=" ">
                  <div class="form-group">
                        <h5>{{ $s -> nama_kegiatan }}</h5>
                                       
                    </div>
                    <div class="form-group">
                        <h5>{{ $s -> status }}</h5>
                                       
                    </div>
                    <div class="form-group">
                        <h5>{{ $s -> waktu }}</h5>
                                        
                    </div>
                    <div class="form-group">
                        <h5>{{ $s -> tujuan }}</h5>
                                       
                    </div>
                </div>
            </div>
            @endforeach
              <div class="form-group">
                     <table class="table table-hover table-borderless table-striped DataTable">
                            <thead>
                                <tr>
                                    <th>Pengajuan Kebutuhan</th>
                                    <th>Ruangan</th>
                                    <th>Item Kebutuhan</th>
                                    <th>QTY</th>
                                    <th>Harga Satuan</th>
                                    <th>Satuan</th>
                                    <th>Spesifikasi</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr>
                                    @foreach ($item_kebutuhan as $p)
                                        <td>{{ $p->id_pengajuan_kebutuhan }}</td>
                                        <td>{{ $p->id_gedung }}</td>
                                        <td>{{ $p->item_kebutuhan }}</td>
                                        <td>{{ $p->qty }}</td>
                                        <td>{{ $p->harga_satuan }}</td>
                                        <td>{{ $p->satuan }}</td>
                                        <td>{{ $p->spesifikasi }}</td>
                                        <td>
                                            @if ($p->foto_barang_kebutuhan)
                                                <img src="{{ url('foto') . '/' . $p->foto_barang_kebutuhan }} "
                                                    style="max-width: 250px; height: auto;" />
                                            @endif
                                        </td>
                                     @endforeach
                                    </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                            <a href="/dashboard-pemohon/pengajuan-kebutuhan" <btn class="btn btn-dark">KEMBALI</btn></a>
                        </div>
                    </div>
        </div>         
    </div>
@endsection