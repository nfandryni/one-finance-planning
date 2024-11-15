@extends('layout.layout')
@section('gedung', 'active')
@section('title', 'Daftar Gedung')
@section('content')
<br>
    <div class="row"><h2 class="fw-bold">Kelola Data Master - Gedung</h2>
    <hr>
    <div class="col-md-12">
     <div class="row justify-content-md-end" style="align-items: center">
                <div class="col-sm-2">
                    <div class="col-sm">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahGedung" style='position:absolute; margin-top:20px;'>
                            Tambah Data
                            </button>
                    </div>
                </div>
            </div>
                    <div class="row">
                    <div class="col-md-12 d-flex justify-content-end ">
                     
                    </div>
                   </div>
            
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead> 
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Gedung</th>
                                    <th>Nama Ruangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($gedung as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->nama_gedung }}</td>
                                        <td>{{ $s->nama_ruangan }}</td>
                                        <td>
                                        <a class='text-black' href="/dashboard-bendahara/gedung/edit/{{ $s->id_gedung }}"><i class="fa-solid fa-pen" style="cursor: pointer; margin:2px">
                                            </i></a>
                                            <btn class="btnHapus" style="cursor: pointer" idGedung="{{ $s->id_gedung }}"><i class="fa-solid fa-trash"></i></btn>
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
@include('dashboard-bendahara.gedung.tambah')

@endsection


@section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idGedung = $(this).closest('.btnHapus').attr('idGedung');
            swal.fire({
                title: "Apakah Anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: 'gedung/hapus',
                        data: {
                            id_gedung: idGedung,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
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