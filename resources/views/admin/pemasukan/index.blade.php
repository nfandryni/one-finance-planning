@extends('layout.layout')
@section('pemasukan', 'active')
@section('title', 'Daftar Pemasukan')
@section('content')
    <br>
    <div class="row">
        <h2 class="fw-bold"> Data Pemasukan</h2>
        <h3 class="card-title"> Jumlah Pemasukan: {{ $jumlahDana ?? 0 }}</h3><br><br>
        <a href="{{ url('/dashboard-bendahara/pemasukan/print') }}" style='position:absolute; width:120px; right:30px;'
            class='btn btn-warning mt-4'>
            Cetak Data
        </a>
       
        <div class="col-md-12">
 <hr>
            <table class="table table-borderless table-striped mt-2 DataTable">
                <thead>
                    <tr>
                        <th>Sumber Dana</th>
                        <th>Nama Pemasukan</th>
                        <th>Nominal (Rupiah)</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemasukan as $s)
                        <tr>
                            <td>{{ $s->nama_sumber }}</td>
                            <td>{{ $s->nama_pemasukan }}</td>
                            <td>{{ $s->nominal }}</td>
                            <td>{{ $s->waktu }}</td>

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
            let idPemasukan = $(this).closest('.btnHapus').attr('idPemasukan');
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
                        url: 'pemasukan/hapus',
                        data: {
                            id_pemasukan: idPemasukan,
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
