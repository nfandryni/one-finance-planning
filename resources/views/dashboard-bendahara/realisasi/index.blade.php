@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')
    <h2 class="fw-bold" style='position:relative; top:15px;'>Kelola Data Realisasi</h2>
    <div class="row justify-content-md-end" style="align-items: center">
            @if(!$realisasi->isEmpty())
    <a target='_blank' href="{{ url('/dashboard-bendahara/realisasi/print') }}" style='position:relative; width:130px; right:30px; top: -30px;' class='btn btn-warning'>
    <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
        </a>
        @else
        <button disabled style='position:absolute; width:130px; right:30px; top: 80px;' class='btn btn-secondary'>
        <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
            </button>
        @endif
        <br/>
        <hr>
    <div class="col-md-12 ">
                    <div class="row justify-content-md-center" style="align-items: center">
                       
                    </div>
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Nama Realisasi</th>
                                    <th>Waktu</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($realisasi as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->judul_realisasi }}</td>
                                        <td>{{ $s->waktu }}</td>    
                                        <td>{{ $s->total_pembayaran }}</td>
                                        <td>
                                           <a  href='/dashboard-bendahara/realisasi/detail/{{ $s->id_realisasi  }}'><i class="fa-solid fa-circle-info fa-lg" style="color: #000000; margin-top:10px;"></i></a>
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection
@section('footer')
<script type="module">
$(document).ready(function() {
        $('.DataTable').DataTable();
    });
    </script>
@endsection 
