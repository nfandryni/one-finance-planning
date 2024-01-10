@extends('layout.layout')
@section('akun', 'active')
@section('title', 'Kelola Akun')
@section('content')
    <div class="row">
        <div class="container">
            {{-- <div class="col-md-12">
                <h1 class="fs-2 fw-bold mt-3">Kelola Akun </h1>
            </div> --}}
            {{-- fitur tambah dan search --}}
            <div class="row">
                <div class="col-md-12 mt-3 d-flex justify-content-between">
                    <div class="col-md-6">
                        <h1 class="fs-2 fw-bold ">Kelola Akun </h1>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end gap-3">
                        <div>
                            <btn class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#tambahAkun">Tambah Akun</btn>
                        </div>
                        <a target="_blank" href="kelola-akun/generate" style="text-decoration: none; color:black">
                            <btn class="btn btn-warning ">Cetak</btn>

                        </a>
                    </div>
                </div>
            </div>


            {{-- table list  --}}
            <div class=" mt-4">
                <div class=" bdr ">
                    <table class="table table-borderless table-striped DataTable">
                        <thead>
                            <tr>
                                <th>NO </th>
                                <th>USERNAME </th>
                                <th>ROLE</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akun as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->username }}</td>
                                    <td class="text-capitalize">{{ $s->role }}</td>
                                    <td>
                                        <a href="kelola-akun/edit/{{ $s->user_id }}"
                                            style="text-decoration: none; color:black">
                                            <i class="fa-solid fa-pen "></i>
                                        </a>
                                        <a href="kelola-akun/detail/{{ $s->user_id }}"
                                            style="text-decoration: none; color:black">
                                            <i class="fa-solid fa-circle-info  "></i>
                                        </a>
                                        <i class="fa-solid fa-trash btnHapus btn-danger" userId="{{ $s->user_id }}"></i>


                                        @csrf
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('superadmin.kelola-akun.tambah')
@endsection


@section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let userId = $(this).closest('.btnHapus').attr('userId');
            //alert(id_akun)
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
                        url: '/kelola-akun/hapus',
                        data: {
                            user_id: userId,
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
            $('.DataTable').DataTable();
        });
    </script>

@endsection
