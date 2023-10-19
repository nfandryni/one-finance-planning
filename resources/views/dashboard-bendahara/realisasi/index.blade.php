@extends('layout.layout')
@section('akun', 'active')
@section('title', 'Daftar Realisasi')
@section('content')
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Kelola Data Realisasi
                    </span>
                </div>
                <div class="card-body">
                    <div class="row" >
                        <div class="col" >
                            <a href="/dashboard-bendahara/tambah">
                                <btn class="btn btn-primary left">Tambah Data</btn>
                            </a>

                        </div>
                        <p>
                            <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Judul Realisasi</th>
                                    <th>Waktu</th>
                                    <th>Total Dana</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($realisasi as $s)
                                    <tr>
                                        <td>{{ $s->judul_realisasi }}</td>
                                        <td>{{ $s->waktu }}</td>
                                        <td>{{ $s->total_dana }}</td>
                                        <td>
                                            <a href="edit/{{ $s->id_realisasi }}">
                                                <btn class="btn btn-primary">EDIT</btn>
                                            </a>
                                            <btn class="btn btn-danger btnHapus" idRealisasi="{{ $s->id_realisasi }}">HAPUS</btn>
                                        </td>
                                    </tr>
                                @endforeach --}}
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

{{-- @section('footer')
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
                        url: 'hapus',
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
    </script>

@endsection --}}
