@extends('layout.layout')
@section('pengeluaran', 'active')
@section('title', 'Daftar Pengeluaran')
@section('content')
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Pengeluaran
                    </span><br><br>
                    {{-- Menghitung jumlah pengeluaran diambil dari stored function yang ada di migration --}}
                    <h3 class="card-title"> Jumlah Pengeluaran: {{ $jumlahDana ?? 0 }}</h3>
                </div>
                <div class="card-body">
                    <div class="row" >
                        <div class="col" >
                            <a href="pengeluaran/tambah">
                                <btn class="btn btn-success">Tambah Pengeluaran</btn>
                            </a>

                        </div>
                        <p>
                            <hr>
                        <table class="table table-hover table-bordered DataTable">
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
                                            <a href="pengeluaran/edit/{{ $s->id_pengeluaran }}">
                                                <btn class="btn btn-primary">EDIT</btn>
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
    </script>

@endsection
