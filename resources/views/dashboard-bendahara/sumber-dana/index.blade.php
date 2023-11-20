@extends('layout.layout')
@section('sumber-dana', 'active')
@section('title', 'Daftar Sumber Dana')
@section('content')
<br>
<div class="row"><h2 class="fw-bold">Kelola Data Master - Sumber Dana</h2>
    <hr>
    <div class="col-md-12">
                    <div class="row justify-content-md-center" style="align-items: center">
                      
                        <div class="col-sm-2">
                            <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSumberDana">
                            Tambah Data
                            </button>
                            </div>
                        </div>
                    </div>
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Sumber Dana</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($sumber_dana as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->nama_sumber }}</td>
                                        <td>
                                        <a class='text-black' href="/dashboard-bendahara/sumber-dana/edit/{{ $s->id_sumber_dana }}"> <i class="fa-solid fa-pen" style="cursor: pointer; margin:2px">
                                           </i></a>
                                            <btn class="btnHapus" idSumberDana="{{ $s->id_sumber_dana }}"><i class="fa-solid fa-trash"></i></btn>
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
@include('dashboard-bendahara.sumber-dana.tambah')
@endsection

 @section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idSumberDana = $(this).closest('.btnHapus').attr('idSumberDana');
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
                        url: '/dashboard-bendahara/sumber-dana/hapus',
                        data: {
                            id_sumber_dana: idSumberDana,
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
