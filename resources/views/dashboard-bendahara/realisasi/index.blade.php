@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')
<br>
    <div class="row"><h2 class="fw-bold">Kelola Data Realisasi</h2>
    <div class="card" style="height: 75px;">
        <h4 class=" fw-bold p-3">Cetak Data Realisasi </h4>
    </div>
    <div class="col-md-12">
                    <div class="row justify-content-md-center" style="align-items: center">
                        <div class="col-sm-2">
                            <div><br>
                            <a href="realisasi/tambah">
									<btn class="btn btn-primary">Tambah Realisasi</btn>
							</a>
                            </div>
                        </div>
                    </div>
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead> 
                                <tr>
                                    <th>ID</th>
                                    <th>Nama realisasi</th>
                                    <th>Nama Ruangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($realisasi as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->nama_realisasi }}</td>
                                        <td>{{ $s->nama_ruangan }}</td>
                                        <td>
                                            <i class="fa-solid fa-pen" data-bs-toggle="modal" data-id='{{ $s->id_realisasi }}' style="cursor: pointer; margin:2px" data-bs-target="#editrealisasi"></i>
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
@include('dashboard-bendahara.realisasi.edit')

@endsection


@section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idrealisasi = $(this).closest('.btnHapus').attr('idrealisasi');
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
                            id_realisasi: idrealisasi,
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
    });
    </script>

@endsection 