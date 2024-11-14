@extends('layout.layout')
@section('logs', 'active')
@section('title', 'Daftar Log Activity')
@section('content')
<br>
    <div class="row">
        <div class="col-md-12">
           
                    <span class="h1">
                        Log Activity
                    </span>
                <div class="card-body">
                    <div class="row" >
                        <p>
                            <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Aktivitas</th>
                                    <th>Waktu</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $s)
                                    <tr>
                                        <td>{{ $s->aksi }}</td>
                                        <td>{{ $s->aktivitas }}</td>
                                        <td>{{ $s->waktu }}</td>
                                        {{-- <td>
                                            <btn class="btn btn-danger btnHapus" idLogs="{{ $s->id_logs }}">HAPUS</btn>
                                        </td> --}}
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
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idLogs = $(this).closest('.btnHapus').attr('idLogs');
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
                        url: '/dashboard-bendahara/logs/hapus',
                        data: {
                            id_logs: idLogs,
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
