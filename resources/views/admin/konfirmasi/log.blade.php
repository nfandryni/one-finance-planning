@extends('layout.layout')
@section('title', 'Riwayat Aktivitas')
@section('content')
     <h1 class="fs-2 fw-bold mt-3">Riwayat Aktivitas</h1>
<hr>
    <table class="table table-hover table-bordered DataTable">
        <thead>
            <tr>
                <th>Aksi</th>
                <th>Aktivitas</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($logs as $s)
                <tr>
                    <td>{{ $s->aksi }}</td>
                    <td>{{ $s->aktivitas }}</td>
                    <td>{{ $s->waktu }}</td>
                </tr>@csrf
            @endforeach 
        </tbody>
    </table>
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
                        url: '/dashboard-superadmin/delete',
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