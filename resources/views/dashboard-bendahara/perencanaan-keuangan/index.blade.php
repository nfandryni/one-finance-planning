@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
@section('content')
    <div class="row px-5">

        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h4" style="font-weight:bold;">Kelola Data Pengajuan Kebutuhan</span>
        </div>
        {{-- Menghitung jumlah pengajuan kebutuhan diambil dari stored function yang ada di migration --}}
        {{-- <h3 class="card-title"> Jumlah Pengajuan Kebutuhan: {{ $totalList ?? 0 }}</h3> --}}
        <div class="col-md-12">
            <div class="row justify-content-md-end" style="align-items: center">
                <div class="col-sm-2">
                    <div>
                        <a href="perencanaan-keuangan/tambah">
                            <btn class="btn btn-primary">Tambah Data</btn>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <p>
        <table class="table table-hover table-borderless table-striped DataTable">
            <thead>
                <tr>
                    <th>ID Pengajuan Kebutuhan</th>
                    <th>ID Sumber Dana</th>
                    <th>Judul Perencanaan</th>
                    <th>Tujuan</th>
                    <th>Waktu</th>
                    <th>Total Dana Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perencanaan_keuangan as $s)
                    <tr>
                        <td>{{ $s->id_pengajuan_kebutuhan }}</td>
                        <td>{{ $s->id_sumber_dana }}</td>
                        <td>{{ $s->judul_perencanaan }}</td>
                        <td>{{ $s->tujuan }}</td>
                        <td>{{ $s->waktu }}</td>
                        <td>{{ $s->total_dana_pembayaran }}</td>
                        {{-- <td>
                                            @if ($s->file)
                                                <img src="{{ url('foto') . '/' . $s->file }} "
                                                    style="max-width: 250px; height: auto;" />
                                            @endif
                                        </td> --}}
                        <td>
                            <a href="item-perencanaan/tambah/{{ $s->id_item_perencanaan}}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-plus" style="margin: 0 10px; cursor:pointer"></i>
                            </a>

                            <a href="perencanaan-keuangan/edit/{{ $s->id_perencanaan_keuangan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-pen "></i>
                            </a>
                            <a href="perencanaan-keuangan/detail/{{ $s->id_perencanaan_keuangan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-info" style="margin: 0 20px; cursor:pointer"></i>
                            </a>

                            <i class="fa-solid fa-trash btnHapus" style="cursor:pointer"
                                idPerencanaanKeuangan="{{ $s->id_perencanaan_keuangan }}"></i>

                            <a href="{{ url('/dashboard-pemohon/cetak') }}" style="text-decoration: none; color:black">
                                <i class="fa-solid fa-print "></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
@endsection

@section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idPerencanaanKeuangan = $(this).closest('.btnHapus').attr('idPerencanaanKeuangan');
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
                        url: 'perencanaan-keuangan/hapus',
                        data: {
                            id_perencanaan_keuangan: idPerencanaanKeuangan,
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
