@extends('layout.layout')
@section('konfirmasi-pengajuan', 'active')
@section('title', 'Detail Pengajuan Kebutuhan')
@section('content')

    <div style='margin-left:15px; margin-right:15px;'>

        <div class="row justify-content-md-center" style="align-items: center">
            <br />
            <a class='text-black mt-2' href='/dashboard-bendahara/konfirmasi-pengajuan'><i
                    class="fa-solid fa-arrow-left fa-xl "></i></a>
            <div id='Konfirmasi'>
                @if (
                    $pengajuan_kebutuhan->status == 'Difilterisasi' ||
                        $pengajuan_kebutuhan->status == 'DiKonfirmasi' ||
                        $pengajuan_kebutuhan->status == 'Ditolak')
                    <button disabled class='btn btn-secondary btnKonfirmasi fw-bold'
                        idPengajuanKebutuhan='{{ $pengajuan_kebutuhan->id_pengajuan_kebutuhan }}'
                        style='letter-spacing:1px; position:absolute; right:50px;'><i class="fa-solid fa-circle-check"></i>
                        Telah Dikonfirmasi</button>
                @else
                    <button class='btn btn-success fw-bold' data-bs-toggle="modal" data-bs-target="#konfirmasiPengajuan"
                        style='letter-spacing:1px; position:absolute; right:50px;'><i class="fa-solid fa-circle-check"></i>
                        Konfirmasi</button>
                    <div class="modal fade" id="konfirmasiPengajuan" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-4 pt-2 fw-bold" id="modalKonfirmasiPengajuan">Konfirmasi Data
                                        Pengajuan</h1>
                                </div>
                                <div class="modal-body">
                                    <form method="POST"
                                        action="/dashboard-bendahara/konfirmasi-pengajuan/konfirmasi/{{ $pengajuan_kebutuhan->id_pengajuan_kebutuhan }}"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mx-2">
                                                    <label>Sumber Dana</label>
                                                    <br>
                                                    @if ($sumber_dana->isEmpty())
                                                        <a href='/dashboard-bendahara/sumber-dana'
                                                            class="btn btn-primary btn-sm">
                                                            Tambah Data
                                                        </a>
                                                    @else
                                                        <select required class='form-select' name="id_sumber_dana">
                                                            @foreach ($sumber_dana as $p)
                                                                <option selected disabled hidden>Pilih Nama Sumber</option>
                                                                <option value='{{ $p->id_sumber_dana }}'>
                                                                    {{ $p->nama_sumber }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                                <div class="form-group mx-2 m-2">
                                                    <label>Bulan Rencana Realisasi</label>
                                                    <br />
                                                    @foreach ($item_kebutuhan as $p)
                                                        <div class='row row-md-12'>
                                                            <div class='col-md-6'>
                                                                <p class='w-25'>{{ $p->item_kebutuhan }}</p>
                                                            </div>
                                                            <div class='col-md-6'>
                                                                <input type="month"
                                                                    class="form-control inline-block relative"
                                                                    name="bulan_rencana_realisasi[{{ $p->id_item_kebutuhan }}]"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="id_pengajuan_kebutuhan"
                                                    value='{{ $pengajuan_kebutuhan->id_pengajuan_kebutuhan }}' />
                                                <input type="hidden" name="status" value='Difilterisasi' />
                                                {{-- <!-- <input type="hidden" name="total_dana_kebutuhan" value='{{$totalDanaKebutuhan}} ' /> --> --}}
                                                @csrf
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" onClick='reset()'
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success">Konfirmasi Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                @endif
            </div>
        </div>
        <div>
            <br />
            <h3 class='fw-bold mb-3'>Detail Pengajuan Kebutuhan</h3>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Nama Pengajuan Kebutuhan</label>
                </div>
                <div class="col-md-6">
                    : {{ $pengajuan_kebutuhan->nama_kegiatan }}
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Tujuan</label>
                </div>
                <div class="col-md-9">
                    : {{ $pengajuan_kebutuhan->tujuan }}
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Status</label>
                </div>
                <div class="col-md-3">
                    : {{ $pengajuan_kebutuhan->status }}
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Waktu</label>
                </div>
                <div class="col-md-3">
                    : {{ $pengajuan_kebutuhan->waktu }}
                </div>
            </div>
            @if (isset($pengajuan_kebutuhan->total_dana_kebutuhan))
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Total Pembayaran</label>
                    </div>
                    <div class="col-md-3">
                        : {{ $pengajuan_kebutuhan->total_dana_kebutuhan }}
                    </div>
                </div>
            @endif
        </div>
        <hr />
        <div>
            <h4 class='fw-bold mb-3'>Item Kebutuhan</h4>
            @if (!isset($pengajuan_kebutuhan->total_dana_kebutuhan))
                <h6 class='fw-bold mb-3 text-sm-end' style='position: relative; margin-top: -40px;'>Total Dana yang
                    Dibutuhkan: <p class='fs-4 bg-success p-2 text-white text-sm-end'
                        style='position: relative; width: 15%; margin-left:823px; border-radius: 5px;margin-top:3px;'>
                        {{ $totalDanaKebutuhan ?? 0 }} </p>
                </h6>
            @endif
            <table class="table table-hover table-borderless table-striped DataTable">
                <thead>
                    <tr>
                        <th>Ruangan</th>
                        <th>Item Kebutuhan</th>
                        <th>Qty</th>
                        <th>Harga Satuan</th>
                        <th>Satuan</th>
                        <th>Spesifikasi</th>
                        <th>Foto</th>
                        @if ($pengajuan_kebutuhan->status == 'Terkirim')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item_kebutuhan as $p)
                        <tr>
                            <td>{{ $p->nama_ruangan }}</td>
                            <td>{{ $p->item_kebutuhan }}</td>
                            <td>{{ $p->qty }}</td>
                            <td>{{ $p->harga_satuan }}</td>
                            <td>{{ $p->satuan }}</td>
                            <td>{{ $p->spesifikasi }}</td>
                            <td>
                                @if ($p->foto_barang_kebutuhan)
                                    <img src="{{ url('foto') . '/' . $p->foto_barang_kebutuhan }} "
                                        style="max-width: 150px; height: auto;" />
                                @endif
                            </td>
                            @if ($pengajuan_kebutuhan->status == 'Terkirim')
                                <td>
                                    <a class='btn btn-primary' style='margin:2px'
                                        href="/dashboard-bendahara/konfirmasi-pengajuan/edit-item/{{ $p->id_item_kebutuhan }}"><i
                                            class="fa-solid fa-pen" style="cursor: pointer;">
                                        </i>
                                    </a>
                                    <button class="btn btn-danger btnTolak"
                                        idItemKebutuhan="{{ $p->id_item_kebutuhan }}"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>




@endsection


@section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnTolak', function(a) {
            a.preventDefault();
            let idItemKebutuhan = $(this).closest('.btnTolak').attr('idItemKebutuhan');
            swal.fire({
                title: "Anda ingin menolak item ini?",
                text: 'Item tidak akan ditampilkan lagi',
                showCancelButton: true,
                confirmButtonText: 'Tolak',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/dashboard-bendahara/konfirmasi-pengajuan/tolak-item/' +
                            idItemKebutuhan,
                        data: {
                            id_item_kebutuhan: idItemKebutuhan,
                            id_pengajuan_kebutuhan: {{ $pengajuan_kebutuhan->id_pengajuan_kebutuhan }},
                            status: 'Ditolak',
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Item kebutuhan berhasil ditolak!', '', 'success')
                                    .then(function() {
                                        location.reload();
                                    });
                            } else {
                                swal.fire('Item kebutuhan berhasil ditolak!', '', 'success')
                                    .then(function() {
                                        window.location.href =
                                            '/dashboard-bendahara/konfirmasi-pengajuan';
                                    });
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script type="module">
        $('#KonfirmasiPengajuan').on('click', '.btnKonfirmasi', function(a) {
            a.preventDefault();
            let idPengajuanKebutuhan = $(this).closest('.btnKonfirmasi').attr('idPengajuanKebutuhan');
            swal.fire({
                title: "Menerima Pengajuan Kebutuhan ini?",
                text: 'Pengajuan akan dikirim ke Admin untuk dikonfirmasi',
                showCancelButton: true,
                confirmButtonText: 'Terima',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'green',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/dashboard-bendahara/konfirmasi-pengajuan/konfirmasi/' +
                            idPengajuanKebutuhan,
                        data: {
                            id_pengajuan_kebutuhan: idPengajuanKebutuhan,
                            status: 'Difilterisasi',
                            bulan_rencana_realisasi: {{ 'Difilterisasi' }},
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Pengajuan Kebutuhan berhasil dikonfirmasi!',
                                    'Pengajuan telah dikirim ke Admin untuk konfirmasi lanjutan',
                                    'success').then(function() {
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
