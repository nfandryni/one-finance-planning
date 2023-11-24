@extends('layout.layout')
@section('pengeluaran', 'active')
@section('title', 'Daftar Pengeluaran')
@section('content')
    <br>
    <div class="row">
        <h2 class="fw-bold"> Data Pengeluaran</h2>
        <h3 class="card-title"> Jumlah Pengeluaran: {{ $jumlahDana ?? 0 }}</h3>
        <a href="" style='position:absolute; width:120px; right:30px;'
            class='btn btn-warning mt-4'>
            Cetak Data
        </a>
    </div>
    <hr>
    <table class="table table-borderless table-striped mt-2 DataTable">
        <thead>
            <tr>
                <th>Sumber Dana</th>
                <th>Nama Pengeluaran</th>
                <th>Jenis Pengeluaran</th>
                <th>Nominal</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $s)
                <tr>
                    <td>{{ $s->nama_sumber }}</td>
                    <td>{{ $s->nama_pengeluaran }}</td>
                    <td>{{ $s->kategori }}</td>
                    <td>{{ $s->nominal }}</td>
                    <td>{{ $s->waktu }}</td>


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
            let idPengeluaran = $(this).closest('.btnHapus').attr('idPengeluaran');
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
                        url: '/dashboard-bendahara/pengeluaran/hapus',
                        data: {
                            id_pengeluaran: idPengeluaran,
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
