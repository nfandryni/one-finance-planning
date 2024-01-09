@extends('layout.layout')
@section('pengeluaran', 'active')
@section('title', 'Daftar Pengeluaran')
@section('content')
    <br>
    <div class="row">
        <h2 class="fw-bold">Kelola Data Pengeluaran</h2>
        <h3 class="card-title"> Jumlah Pengeluaran: {{ $jumlahDana ?? 0 }}</h3>
        @if(!$pengeluaran->isEmpty())
    <a target='_blank' href="{{ url('/dashboard-bendahara/pengeluaran/print') }}" style='position:absolute; width:130px; right:30px;' class='btn btn-warning'>
    <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
        </a>
        @else
        <button disabled style='position:absolute; width:130px; right:30px;' class='btn btn-secondary'>
        <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
            </button>
        @endif
        <hr />
        <div class="col-md-12">
            <div class="row justify-content-md-end" style="align-items: center">

                <div class="col-sm-2">
                    <div class="col">
                        <a href="pengeluaran/tambah">
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
                <th>Nama Pengeluaran</th>
                <th>Jenis Pengeluaran</th>
                <th>Nominal</th>
                <th>Waktu</th>
                <th>Penanggung Jawab</th>
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
                    <td>{{ $s->penanggung_jawab }}</td>

                    <td>
                        <a class='text-black' href="/dashboard-bendahara/pengeluaran/edit/{{ $s->id_pengeluaran }}"><i
                                class="fa-solid fa-pen" style="cursor: pointer; margin:2px">
                            </i></a>
                        <a href='/dashboard-bendahara/pengeluaran/detail/{{ $s->id_pengeluaran }}'><i
                                class="fa-solid fa-circle-info fa-lg" style="color: #000000;"></i></a>
                        <btn class="btnHapus" style='cursor: pointer' idPengeluaran="{{ $s->id_pengeluaran }}"><i
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
