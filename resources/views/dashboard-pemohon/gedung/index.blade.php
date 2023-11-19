@extends('layout.layout')
@section('gedung', 'active')
@section('title', 'Daftar Gedung')
@section('page', 'Daftar Gedung')
@section('content')
<br>
   <div class="row px-5">
                        <div class="col-md-12">
                            <span class="h4" style="font-weight:bold;">Kelola Data Gedung</span>
                        </div>
                        <div class="col-md-12">
                                <div class="row justify-content-md-center" style="align-items: center">
                                 <div class="col-6"></div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text" placeholder="Cari data..." class="form-control" name="data" />
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div>
                                         <a href="gedung/tambah">
                                            <btn class="btn btn-primary">Tambah Gedung</btn>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                         </div>
                        <p>
                            <hr>
                        <table class="table table-hover table-borderless table-striped DataTable ">
                            <thead>
                                <tr>
                                    <th>Nama Gedung</th>
                                    <th>Nama Ruangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gedung as $s)
                                    <tr>
                                        <td>{{ $s->nama_gedung }}</td>
                                        <td>{{ $s->nama_ruangan }}</td>
                                        <td  >
                                            <a href="gedung/edit/{{ $s->id_gedung }}"  style="text-decoration: none; color:black">
                                                <i class="fa-solid fa-pen "></i>
                                            </a>
                                             <i class="fa-solid fa-circle-info" style="margin: 0 20px; cursor:pointer"></i>
                                            <i class="fa-solid fa-trash btnHapus" style="cursor:pointer" idGedung="{{ $s->id_gedung }}"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
@endsection

@section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idGedung = $(this).closest('.btnHapus').attr('idGedung');
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
                        url: '/dashboard-pemohon/gedung/hapus',
                        data: {
                            id_gedung: idGedung,
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
    </script>

@endsection
