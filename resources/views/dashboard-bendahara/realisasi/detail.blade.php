@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')

<br>
    <div class="row px-5">
    <h2 class="fw-bold">Kelola Data Realisasi</h2>
    <div class="card" style="height: 75px;">
        <h4 class=" fw-bold p-3">Cetak Data Realisasi </h4>
    </div>
    <div class="col-md-12">
                    <div class="row justify-content-md-center" style="align-items: center">
                       
                    </div>
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead> 
                                <tr>
                                    <th>Nama Realisasi</th>
                                    <th>Waktu</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($viewrealisasi as $s)
                                    <tr>
                                        <td>{{ $s->judul_realisasi }}</td>
                                        <td>{{ $s->waktu }}</td>    
                                        <td>{{ $s->total_pembayaran }}</td>
                                        <td>
                                           <a  href='/dashboard-bendahara/realisasi/detail/{{$s->id_realisasi}}'><i class="fa-solid fa-circle-info fa-lg" style="color: #000000;"></i></a>
                                            <btn class="btnHapus" style="cursor: pointer" idrealisasi="{{ $s->id_realisasi }}"><i class="fa-solid fa-trash"></i></btn>
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

@endsection
