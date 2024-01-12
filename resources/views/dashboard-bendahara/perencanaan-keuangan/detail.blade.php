@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Detail Perencanaan Keuangan')
@section('content')

<div style='margin-left:15px; margin-right:15px;'>
        <div class="row justify-content-md-center" style="align-items: center">
        <br/>
       <a class='text-black mt-2' href='/dashboard-bendahara/perencanaan-keuangan'><i class="fa-solid fa-arrow-left fa-xl "></i></a> 
        </div>
        <div>
<div class="row justify-content-md-end" style="align-items: center">

@if(!$item_perencanaan->isEmpty())
    <a target='_blank' href="/dashboard-bendahara/perencanaan-keuangan/print-item/{{$perencanaan_keuangan->id_perencanaan_keuangan}}" style='position:relative; width:130px; right:30px; top: -20px;' class='btn btn-warning'>
    <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
        </a>
        @else
        <button disabled style='position:relative; width:130px; right:30px; top: -20px;' class='btn btn-secondary'>
        <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
            </button>
        @endif
</div>
            <h3 class='fw-bold mb-3'>Detail Perencanaan Keuangan</h3>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Nama Perencanaan</label>
                </div>
                <div class="col-md-6">
                    : {{ $perencanaan_keuangan->judul_perencanaan }}
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Sumber Dana</label>
                </div>
                <div class="col-md-6">
                    : {{ $perencanaan_keuangan->nama_sumber }}
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Tujuan</label>
                </div>
                <div class="col-md-9">
                    : {{ $perencanaan_keuangan->tujuan }}
                </div>
            </div>
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Waktu</label>
                </div>
                <div class="col-md-3">
                    : {{ $perencanaan_keuangan->waktu }}
                </div>
            </div>
            @if(isset($perencanaan_keuangan->total_dana_perencanaan))
            <div class='row mb-2'>
                <div class="col-md-3">
                    <label class='fw-bold'>Total Dana Perencanaan</label>
                </div>
                <div class="col-md-3">
                    : {{ $perencanaan_keuangan->total_dana_perencanaan  ?? 0}}
                </div>
            </div>
            @endif
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($item_perencanaan as $p)
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
                                    <td>
                                        @if($p->status == 'Terbeli')
                                       <button disabled class="btn btn-secondary" style='margin:2px' ><i class="fa-solid fa-pen" style="cursor: pointer;">
                                           </i></button>
                                            <button disabled class="btn btn-secondary" style='margin:2px' ><i class="fa-solid fa-xmark"></i></button>
                                        @else
                                        <a class='btn btn-primary' style='margin:2px' href="/dashboard-bendahara/item-perencanaan/edit/{{ $p->id_item_perencanaan }}"><i class="fa-solid fa-pen" style="cursor: pointer;">
                                           </i>
                                        </a>
                                    @if(!isset($perencanaan_keuangan->id_pengajuan_kebutuhan))
                                            <btn class="btn btn-danger btnHapus"
                                                idItemPerencanaan="{{ $p->id_item_perencanaan }}"><i class="fa-solid fa-trash"></i></btn>
                                    </td>
                                    @endif
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