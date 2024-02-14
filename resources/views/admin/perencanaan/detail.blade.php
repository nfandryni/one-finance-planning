@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Detail Perencanaan Keuangan')
@section('content')

    <div style='margin-left:15px; margin-right:15px;'>
        <div class="row justify-content-md-center" style="align-items: center">
            <br />
            <a class='text-black mt-2' href='/perencanaan-keuangan'><i class="fa-solid fa-arrow-left fa-xl "></i></a>
        </div>
        <div class="row justify-content-md-end" style="align-items: center">

            <a target='_blank' style='position:absolute; width:130px; right:40px; top:110px;' class='btn btn-warning'>
                <i class="fa-solid fa-print fa-lg"></i> Cetak Data
            </a>
        </div>
        <div>
            <div class="row justify-content-md-end" style="align-items: center">

                {{-- @if (!$item_perencanaan->isEmpty())
                    <a target='_blank'
                        href="/perencanaan-keuangan/print-item/{{ $perencanaan_keuangan->id_perencanaan_keuangan }}"
                        style='position:relative; width:130px; right:30px; top: -20px;' class='btn btn-warning'>
                        <i class="fa-solid fa-print fa-lg"></i> Cetak Data
                    </a>
                @else
                    <button disabled style='position:relative; width:130px; right:30px; top: -20px;'
                        class='btn btn-secondary'>
                        <i class="fa-solid fa-print fa-lg"></i> Cetak Data
                    </button>
                @endif --}}
            </div>
            <h3 class='fw-bold mb-3'>Detail Perencanaan Keuangan</h3>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Nama Perencanaan</label>
                </div>
                <div class="col-md-6">
                    : Perbaikan Fasilitas
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Sumber Dana</label>
                </div>
                <div class="col-md-6">
                    : BOS
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Tujuan</label>
                </div>
                <div class="col-md-9">
                    : Memperbaiki Fasilitas yang rusak
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Waktu</label>
                </div>
                <div class="col-md-3">
                    : 2024-01-26
                </div>
            </div>
            {{-- @if (isset($perencanaan_keuangan->total_dana_perencanaan)) --}}
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Total Dana Perencanaan</label>
                </div>
                <div class="col-md-3">
                    : 840000
                </div>
            </div>
            {{-- @endif --}}
        </div>
        <hr />
        <div>
            <h4 class='fw-bold mb-3'>Item Perencanaan</h4>
            <table class="table table-hover table-borderless table-striped DataTable">
                <thead>
                    <tr>
                        <th>Ruangan</th>
                        <th>Item</th>
                        <th>QTY</th>
                        <th>Harga Satuan</th>
                        <th>Satuan</th>
                        <th>Spesifikasi</th>
                        <th>Status</th>
                        <th>Rencana Realisasi</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- @foreach ($item_perencanaan as $p)
                        <tr>
                            <td>{{ $p->nama_ruangan }}</td>
                            <td>{{ $p->item_perencanaan }}</td>
                            <td>{{ $p->qty }}</td>
                            <td>{{ $p->harga_satuan }}</td>
                            <td>{{ $p->satuan }}</td>
                            <td>{{ $p->spesifikasi }}</td>
                            <td>{{ $p->status }}</td>
                            <td>{{ $p->bulan_rencana_realisasi }}</td>
                            <td>
                                @if ($p->foto_barang_perencanaan)
                                    <img src="{{ url('foto') . '/' . $p->foto_barang_perencanaan }} "
                                        style="max-width: 150px; height: auto;" />
                                @endif
                            </td>
                          
                    </tr>
                    @endforeach --}}
                    <tr>
                        <td>F4</td>
                        <td>Kursi</td>
                        <td>42</td>
                        <td>20000</td>
                        <td>Buah</td>
                        <td>Terbuat dari kayu</td>
                        <td>Belum Terbeli</td>
                        <td>2024-03</td>
                        <td>
                            {{-- @if ($p->foto_barang_perencanaan)
                                    <img src="{{ url('foto') . '/' . $p->foto_barang_perencanaan }} "
                                        style="max-width: 150px; height: auto;" />
                                @endif --}}

                            <img src="/assets/download (6).jpg" style="max-width: 150px; height: auto;" />
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection


@section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idItemPerencanaan = $(this).closest('.btnHapus').attr('idItemPerencanaan');
            swal.fire({
                title: "Apakah Anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/dashboard-bendahara/item-perencanaan/hapus',
                        data: {
                            id_item_perencanaan: idItemPerencanaan,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idItemPerencanaan = $(this).closest('.btnHapus').attr('idItemPerencanaan');
            swal.fire({
                title: "Apakah Anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/dashboard-bendahara/item-perencanaan/hapus',
                        data: {
                            id_item_perencanaan: idItemPerencanaan,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            $('.DataTable').DataTable({
                searching: false,
                paging: false,
                lengthChange: false
            });
        });
    </script>
@endsection
