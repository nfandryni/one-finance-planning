@extends('layout.layout')
@section('pengeluaran', 'active')
@section('title', 'Daftar Pengeluaran')
@section('content')
<br>
<div class="row">
    <h2 class="fw-bold">Kelola Data Master - Pengeluaran</h2>
    <h3 class="card-title"> Jumlah Pengeluaran: {{ $jumlahDana ?? 0 }}</h3>
    <div class="col-md-12">
                    <div class="row justify-content-md-center" style="align-items: center">
                      
                        <div class="col-sm-2">
                        <div class="col" >
                            <a href="pengeluaran/tambah">
                                <btn class="btn btn-primary">Tambah Pengeluaran</btn>
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
                                    <th>Jenis Pengeluaran</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Waktu</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluaran as $s)
                                    <tr>
                                        <td>{{ $s->sumber_dana->nama_sumber }}</td>
                                        <td>{{ $s->jenis_pengeluaran->kategori }}</td>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->nominal }}</td>
                                        <td>{{ $s->waktu }}</td>
                                        <td>
                                            @if ($s->foto)
                                                <img src="{{ url('foto') . '/' . $s->foto }} "
                                                    style="max-width: 250px; height: auto;" />
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <a href="pengeluaran/edit/{{ $s->id_pengeluaran }}" class="btn btn-primary">
                                                EDIT
                                            </a>
                                            <btn class="btn btn-danger btnHapus" idPengeluaran="{{ $s->id_pengeluaran }}">HAPUS</btn>
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