@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
@section('content')
<<<<<<< HEAD
    <div class="row px-5">

        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h4" style="font-weight:bold;">Kelola Data Perencanaan Keuangan </span>
        </div>
        {{-- Menghitung jumlah pengajuan kebutuhan diambil dari stored function yang ada di migration --}}
        {{-- <h3 class="card-title"> Jumlah Pengajuan Kebutuhan: {{ $totalList ?? 0 }}</h3> --}}
        <div class="col-md-12">
            <div class="row justify-content-md-end" style="align-items: center">
                <div class="col-sm-2">
                    <div>
                        <a href="/dashboard-bendahara/perencanaan-keuangan/tambah">
                            <btn class="btn btn-primary">Tambah Data</btn>
=======
    <div class="row">

    <h2 class="fw-bold" style='position:relative; top:15px;'>Kelola Data Perencanaan Keuangan</h2>

        <div class="col-md-12">
            <div class="row justify-content-md-end" style="align-items: center">
            @if(!$perencanaan_keuangan->isEmpty())
    <a target='_blank' href="{{ url('/dashboard-bendahara/perencanaan-keuangan/print') }}" style='position:relative; width:130px; right:30px; top: -30px;' class='btn btn-warning'>
    <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
        </a>
        @else
        <button disabled style='position:absolute; width:130px; right:30px; top: 80px;' class='btn btn-secondary'>
        <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
            </button>
        @endif
        <br/>
        <hr>
                <div class="col-sm-2">
                    <div>
                        <a href="/dashboard-bendahara/perencanaan-keuangan/tambah">
                        <btn class="btn btn-primary" style='position:absolute; margin-top:20px;'>Tambah Data</btn>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <p>
        <table class="table table-hover table-borderless table-striped DataTable">
            <thead>
                <tr>
<<<<<<< HEAD
                    <th>Pengajuan</th>
                    <th>Sumber Dana</th>
                    <th>Judul Perencanaan</th>
                    <th>Tujuan</th>
                    <th>Waktu</th>
                    <th>Total Perencanaan</th>
=======
                    <th>Judul Perencanaan</th>
                    <th>Sumber Dana</th>
                    <th>Tujuan</th>
                    <th>Waktu</th>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
<<<<<<< HEAD
                @foreach ($perencanaan_keuangan as $s)
                    <tr>
                        <td>{{ $s->id_pengajuan_kebutuhan }}</td>
                        <td>{{ $s->id_sumber_dana }}</td>
                        <td>{{ $s->judul_perencanaan }}</td>
                        <td>{{ $s->tujuan }}</td>
                        <td>{{ $s->waktu }}</td>
                        <td>{{ $s->total_dana_perencanaan }}</td>
                        <td>
                            <a href="item-perencanaan/tambah/{{ $s->id_item_perencanaan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-plus" style="margin: 0 10px; cursor:pointer"></i>
=======
                @foreach($perencanaan_keuangan as $s)
                    <tr>
                        <td>{{ $s->judul_perencanaan }}</td>
                        <td>{{ $s->nama_sumber }}</td>
                        <td>{{ $s->tujuan }}</td>
                        <td>{{ $s->waktu }}</td>
                        <td>
                            @if(!isset($s->id_pengajuan_kebutuhan))
                            <a href="item-perencanaan/tambah/{{ $s->id_perencanaan_keuangan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-plus" style="margin: 0 2px; cursor:pointer"></i>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                            </a>
                            <a href="perencanaan-keuangan/edit/{{ $s->id_perencanaan_keuangan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-pen "></i>
                            </a>
<<<<<<< HEAD
                            <a href="perencanaan-keuangan/detail/{{ $s->id_perencanaan_keuangan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-info" style="margin: 0 20px; cursor:pointer"></i>
                            </a>

                            <i class="fa-solid fa-trash btnHapus" style="cursor:pointer"
                                idPerencanaanKeuangan="{{ $s->id_perencanaan_keuangan }}"></i>
                        </td>
                        {{-- <td class="row">

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
                        </td> --}}
=======
                            @endif
                            <a href="perencanaan-keuangan/detail/{{ $s->id_perencanaan_keuangan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-info" style="margin: 0 2px; cursor:pointer"></i>
                            </a>
                            @if(!isset($s->id_pengajuan_kebutuhan))
                            <i class="fa-solid fa-trash btnHapus" style="cursor:pointer"
                                idPerencanaanKeuangan="{{ $s->id_perencanaan_keuangan }}"></i>
                                @endif
                        </td>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
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
<<<<<<< HEAD
                title: "Apakah anda ingin menghapus data ini?",
=======
                title: "Apakah Anda ingin menghapus data ini?",
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    //Ajax Delete
                    $.ajax({
                        type: 'DELETE',
                        url: '/dashboard-bendahara/perencanaan-keuangan/hapus',
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
<<<<<<< HEAD
=======
                            else {
                                swal.fire('Tidak dapat dihapus!', 'Perencanaan telah menjadi Realisasi!', 'error').then(function() {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            }
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            $('.DataTable').DataTable({});
        });
    </script>

<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
