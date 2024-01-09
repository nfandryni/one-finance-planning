@extends('layout.layout')
@section('konfirmasi-pengajuan', 'active')
@section('title', 'Konfirmasi Pengajuan')
@section('content')
    <br>
    <div class="">
        <h2 class="fw-bold">Konfirmasi Pengajuan Kebutuhan</h2>
        @if (!$pengajuan_kebutuhan->isEmpty())
            <a target='_blank' href="{{ url('/konfirmasi-pengajuan/print') }}"
                style='position:absolute; width:130px; right:30px;' class='btn btn-warning'>
                <i class="fa-solid fa-print fa-lg"></i> Cetak Data
            </a>
        @else
            <button disabled style='position:absolute; width:130px; right:30px;' class='btn btn-secondary'>
                <i class="fa-solid fa-print fa-lg"></i> Cetak Data
            </button>
        @endif
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalKeterangan">
            <i class="fa-solid fa-circle-info"></i> Penjelasan Status
        </button>

        <div class="modal fade" id="modalKeterangan" tabindex="-1" aria-labelledby="modalPenjelasanKeterangan"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="modalPenjelasanKeterangan">Keterangan Status Pengajuan</h1>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <div>
                                <li>
                                    <b>Terkirim</b>
                                    <p> <b>Pemohon mengirimkan</b> pengajuan kebutuhan kepada Bendahara Sekolah untuk
                                        dimintai konfirmasinya.</p>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <b>Difilterisasi</b>
                                    <p> <b>Bendahara</b> telah melakukan <b>filterisasi</b> dan <b>konfirmasi</b> terhadap
                                        pengajuan kebutuhan yang diajukan.</p>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <b> Dikonfirmasi</b>
                                    <p> <b>Admin</b> melakukan <b>konfirmasi</b> terhadap pengajuan kebutuhan yang sudah
                                        difilterisasi oleh Bendahara.</p>
                                </li>
                            </div>
                            <div>
                                <li>
                                    <b>Ditolak</b>
                                    <p> <b>Bendahara menolak</b> pengajuan kebutuhan dengan berbagai pertimbangan.</p>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Mengerti</button>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="col-md-12 ">
            <div class="row justify-content-md-center" style="align-items: center">

            </div>
        </div>
    </div>

    <table class="table table-borderless table-striped mt-2 DataTable">
        <thead>
            <tr>
                <th>Nama Pemohon</th>
                <th>Nama Kegiatan</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuan_kebutuhan as $s)
                @if ($s->status == 'Terkirim' || $s->status == 'Difilterisasi' || $s->status == 'DiKonfirmasi')
                    <tr>
                        <td>{{ $s->nama }}
                        </td>
                        <td>{{ $s->nama_kegiatan }}</td>
                        <td>{{ $s->waktu }}</td>
                        <td>{{ $s->status }}</td>
                        <td>
                            @if ($s->status == 'Difilterisasi' || $s->status == 'DiKonfirmasi')
                                <a href='/konfirmasi-pengajuan/detail/{{ $s->id_pengajuan_kebutuhan }}'><i
                                        class="fa-solid fa-circle-info fa-lg"
                                        style="color: #000000; margin-top:10px;"></i></a>
                            @endif
                            @if ($s->status == 'Terkirim')
                                <a href='/dashboard-bendahara/konfirmasi-pengajuan/detail/{{ $s->id_pengajuan_kebutuhan }}'><i
                                        class="fa-solid fa-circle-info fa-lg" style="color: #000000;"></i></a>
                                <btn class="btnHapus" style="cursor: pointer"
                                    idPengajuanKebutuhan="{{ $s->id_pengajuan_kebutuhan }}"><i
                                        class="fa-solid fa-trash"></i></btn>
                            @endif
                        </td>
                    </tr>
                @endif
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
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idPengajuanKebutuhan = $(this).closest('.btnHapus').attr('idPengajuanKebutuhan');
            swal.fire({
                title: "Anda ingin menolak Pengajuan ini?",
                text: 'Pengajuan akan dikembalikan kepada Pemohon.',
                showCancelButton: true,
                confirmButtonText: 'Tolak',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red',
                icon: 'warning'

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/dashboard-bendahara/konfirmasi-pengajuan/tolak-pengajuan/' +
                            idPengajuanKebutuhan,
                        data: {
                            id_pengajuan_kebutuhan: idPengajuanKebutuhan,
                            status: 'Ditolak',
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Pengajuan kebutuhan berhasil ditolak!', '',
                                    'success').then(function() {
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
