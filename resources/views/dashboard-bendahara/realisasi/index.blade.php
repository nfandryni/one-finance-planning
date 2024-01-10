@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')
<<<<<<< HEAD
<br>
    <div class="">
    <h2 class="fw-bold">Kelola Data Realisasi</h2>
    {{-- <div class="card" style="height: 75px;">
        <h4 class=" fw-bold p-3">Cetak Data Realisasi </h4>
    </div> --}}
    <hr/>
=======
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
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
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
<<<<<<< HEAD
                                           <a  href='/dashboard-bendahara/realisasi/detail/{{ $s->id_realisasi }}'><i class="fa-solid fa-circle-info fa-lg" style="color: #000000;"></i></a>
                                            <btn class="btnHapus" style="cursor: pointer" idrealisasi="{{ $s->id_realisasi }}"><i class="fa-solid fa-trash"></i></btn>
=======
                                           <a  href='/dashboard-bendahara/realisasi/detail/{{ $s->id_realisasi  }}'><i class="fa-solid fa-circle-info fa-lg" style="color: #000000; margin-top:10px;"></i></a>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
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
<<<<<<< HEAD
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idRealisasi = $(this).closest('.btnHapus').attr('idRealisasi');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    //Ajax Delete
                    $.ajax({
                        type: 'DELETE',
                        url: 'realisasi/hapus',
                        data: {
                            id_realisasi: idRealisasi,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
        $('.DataTable').DataTable({});
=======
<script type="module">
$(document).ready(function() {
        $('.DataTable').DataTable();
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
    });
    </script>
@endsection 
