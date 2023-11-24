@extends('layout.layout')
@section('konfirmasi', 'active')
@section('title', 'Daftar Pengajuan Kebutuhan')
@section('content')
    <div class="row ">

        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h4" style="font-weight:bold;">Konfirmasi Pengajuan Kebutuhan</span>
        </div>
        {{-- Menghitung jumlah pengajuan kebutuhan diambil dari stored function yang ada di migration --}}
        <h3 class="card-title"> Jumlah Pengajuan Kebutuhan: {{ $totalList ?? 0 }}</h3>

        <a href="{{ url('/dashboard-pemohon/cetak') }}" style='position:absolute; width:120px; right:30px;' class='btn btn-warning mt-4'>
            Cetak Data
        </a>
        <hr>

        <p>
        <table class="table table-hover table-borderless table-striped DataTable">
            <thead>
                <tr>
                    <th>Pemohon</th>
                    <th>Nama Kegiatan</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <th>Tujuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan_kebutuhan as $s)
                    <tr>
                        <td>{{ $s->id_pemohon }}</td>
                        <td>{{ $s->nama_kegiatan }}</td>
                        <td>{{ $s->status }}</td>
                        <td>{{ $s->waktu }}</td>
                        <td>{{ $s->tujuan }}</td>
                        {{-- <td>
                                            @if ($s->file)
                                                <img src="{{ url('foto') . '/' . $s->file }} "
                                                    style="max-width: 250px; height: auto;" />
                                            @endif
                                        </td> --}}
                        <td>
                            <a href="item-kebutuhan/tambah/{{ $s->id_item_kebutuhan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-plus" style="margin: 0 10px; cursor:pointer"></i>
                            </a>

                            <a href="pengajuan-kebutuhan/edit/{{ $s->id_pengajuan_kebutuhan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-pen "></i>
                            </a>
                            <a href="pengajuan-kebutuhan/detail/{{ $s->id_pengajuan_kebutuhan }}"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-info" style="margin: 0 20px; cursor:pointer"></i>
                            </a>

                            <i class="fa-solid fa-trash btnHapus" style="cursor:pointer"
                                idPengajuanKebutuhan="{{ $s->id_pengajuan_kebutuhan }}"></i>
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
            let idPengajuanKebutuhan = $(this).closest('.btnHapus').attr('idPengajuanKebutuhan');
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
                        url: 'pengajuan-kebutuhan/hapus',
                        data: {
                            id_pengajuan_kebutuhan: idPengajuanKebutuhan,
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