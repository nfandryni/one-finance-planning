@extends('layout.layout')
@section('jenis-pengeluaran', 'active')
@section('title', 'Daftar Jenis Pengeluaran')
@section('content')
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Jenis Pengeluaran
                    </span>
                </div>
                <div class="card-body">
                    <div class="row" >
                        <div class="col" >
                            <a href="jenis-pengeluaran/tambah">
                                <btn class="btn btn-success">Tambah Jenis Pengeluaran</btn>
                            </a>

                        </div>
                        <p>
                            <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenis_pengeluaran as $s)
                                    <tr>
                                        <td>{{ $s->kategori }}</td>
                                        
                                        <td>
                                            <a href="jenis-pengeluaran/edit/{{ $s->id_jenis_pengeluaran }}">
                                                <btn class="btn btn-primary">EDIT</btn>
                                            </a>
                                            <btn class="btn btn-danger btnHapus" idJenisPengeluaran="{{ $s->id_jenis_pengeluaran }}">HAPUS</btn>
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

@section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idJenisPengeluaran = $(this).closest('.btnHapus').attr('idJenisPengeluaran');
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
                        url: '/dashboard-bendahara/jenis-pengeluaran/hapus',
                        data: {
                            id_jenis_pengeluaran: idJenisPengeluaran,
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