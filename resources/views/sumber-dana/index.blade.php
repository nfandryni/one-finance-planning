@extends('layout.layout')
@section('sumber-dana', 'active')
@section('title', 'Daftar Sumber Dana')
@section('content')
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Sumber Dana
                    </span>
                </div>
                <div class="card-body">
                    <div class="row" >
                        <div class="col" >
                            <a href="sumber-dana/tambah">
                                <btn class="btn btn-success">Tambah Sumber Dana</btn>
                            </a>

                        </div>
                        <p>
                            <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Nama Sumber</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sumber_dana as $s)
                                    <tr>
                                        <td>{{ $s->nama_sumber }}</td>
                                        
                                        <td>
                                            <a href="sumber-dana/edit/{{ $s->id_sumber_dana }}">
                                                <btn class="btn btn-primary">EDIT</btn>
                                            </a>
                                            <btn class="btn btn-danger btnHapus" idSumberDana="{{ $s->id_sumber_dana }}">HAPUS</btn>
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
    </script>

@endsection
