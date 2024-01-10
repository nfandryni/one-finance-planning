@extends('layout.layout')
@section('pemasukan', 'active')
@section('title', 'Daftar Pemasukan')
@section('content')
<<<<<<< HEAD
    <br>
    <div class="row">
        <h2 class="fw-bold">Kelola Data Pemasukan</h2>
        <h3 class="card-title"> Jumlah Pemasukan: {{ $jumlahDana ?? 0 }}</h3><br><br>
<<<<<<< HEAD
        <a href="{{ url('/dashboard-bendahara/pemasukan/print') }}" style='position:absolute; width:120px; right:30px;' class='btn btn-warning mt-4'>
            Cetak Data
        </a>
=======
=======
    <div class="row">
        <h2 class="fw-bold">Kelola Data Pemasukan</h2>
        <h3 class="card-title"> Jumlah Pemasukan: {{ $jumlahDana ?? 0 }}</h3><br><br>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
        @if(!$pemasukan->isEmpty())
    <a target='_blank' href="{{ url('/dashboard-bendahara/pemasukan/print') }}" style='position:absolute; width:130px; right:30px;' class='btn btn-warning'>
    <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
        </a>
        @else
        <button disabled style='position:absolute; width:130px; right:30px;' class='btn btn-secondary'>
        <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
            </button>
        @endif
<<<<<<< HEAD
>>>>>>> bbe92d1ebde4e4e9996fc16ab3a17da30904d2b5
=======
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
        <hr>
        <div class="col-md-12">
            <div class="row justify-content-md-end" style="align-items: center">
                <div class="col-sm-2">
                    <div class="col-sm">
                        <a href="/dashboard-bendahara/pemasukan/tambah">
                            <btn class="btn btn-primary" style='position:absolute; margin-top:20px;'>Tambah Data</btn>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-borderless table-striped mt-2 DataTable">
        <thead>
            <tr>
                <th>Sumber Dana</th>
                <th>Nama Pemasukan</th>
                <th>Nominal (Rupiah)</th>
                <th>Waktu</th>
                <th>Penanggung Jawab</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasukan as $s)
                <tr>
                    <td>{{ $s->nama_sumber }}</td>
                    <td>{{ $s->nama_pemasukan }}</td>
                    <td>{{ $s->nominal }}</td>
                    <td>{{ $s->waktu }}</td>
                    <td>{{ $s->penanggung_jawab }}</td>
                    <td>
                        <a class='text-black' href="/dashboard-bendahara/pemasukan/edit/{{ $s->id_pemasukan }}"><i
                                class="fa-solid fa-pen" style="cursor: pointer; margin:2px">
                            </i></a>
                        <a href='/dashboard-bendahara/pemasukan/detail/{{ $s->id_pemasukan }}'><i
                                class="fa-solid fa-circle-info fa-lg" style="color: #000000;"></i></a>
                        <btn class="btnHapus" style="cursor: pointer" idPemasukan="{{ $s->id_pemasukan }}"><i
                                class="fa-solid fa-trash"></i></btn>
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
