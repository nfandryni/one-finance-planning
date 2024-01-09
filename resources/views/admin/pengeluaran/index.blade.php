@extends('layout.layout')
@section('pengeluaran', 'active')
@section('title', 'Daftar Pengeluaran')
@section('content')
    <br>
    <div class="row">
        <h2 class="fw-bold"> Data Pengeluaran</h2>
        <h3 class="card-title"> Jumlah Pengeluaran: {{ $jumlahDana ?? 0 }}</h3>
        @if (!$pengeluaran->isEmpty())
            <a target='_blank' href="{{ url('/pengeluaran/print') }}" style='position:absolute; width:130px; right:30px;'
                class='btn btn-warning'>
                <i class="fa-solid fa-print fa-lg"></i> Cetak Data
            </a>
        @else
            <button disabled style='position:absolute; width:130px; right:30px;' class='btn btn-secondary'>
                <i class="fa-solid fa-print fa-lg"></i> Cetak Data
            </button>
        @endif
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
                <th>Aksi</th>
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
                    <td>
                    <a href="pengeluaran/detail/{{ $s->id_pengeluaran }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-info" style="margin: 0 20px; cursor:pointer"></i>
                            </a></td>

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
