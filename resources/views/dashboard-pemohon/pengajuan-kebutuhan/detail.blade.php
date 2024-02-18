@extends('layout.layout')
@section('pengajuan-kebutuhan', 'active')
@section('title', 'Detail Pengajuan Kebutuhan')
@section('content')

<div style='margin-left:15px; margin-right:15px; position: relative;'>
            <div class="row justify-content-md-center" style="align-items: center">
            <br/>
            <a class='text-black mt-2' href='/dashboard-pemohon/pengajuan-kebutuhan'><i class="fa-solid fa-arrow-left fa-xl "></i></a> 
            <div id='Ajukan'>
                @if($pengajuan_kebutuhan->status == 'Terkirim' 
                || $pengajuan_kebutuhan->status == 'Ditolak' 
                || $pengajuan_kebutuhan->status == 'Difilterisasi' 
                || $pengajuan_kebutuhan->status == 'Dikonfirmasi'
                        || $item_kebutuhan->isEmpty())
                        <button disabled idPengajuanKebutuhan='{{$pengajuan_kebutuhan->id_pengajuan_kebutuhan}}' class='btn btnAjukan btn-secondary fw-bold' style='letter-spacing:1px; cursor:default; position:absolute; right:70px; top:-1px;'><i class="fa-solid fa-paper-plane"></i> Ajukan</button>
                        @else
                        <button idPengajuanKebutuhan='{{$pengajuan_kebutuhan->id_pengajuan_kebutuhan}}' class='btn btnAjukan btn-success fw-bold' style='letter-spacing:1px; position:absolute; right:70px; top: -1px;'><i class="fa-solid fa-paper-plane"></i> Ajukan</button>
                @endif

            @if(!$item_kebutuhan->isEmpty())
            <a target='_blank'
              href="{{ url('/dashboard-pemohon/pengajuan-kebutuhan/print-item/' . $pengajuan_kebutuhan->id_pengajuan_kebutuhan) }}"
              style='position:absolute; width:50px; padding:17px; right:10px; top:-1px;' class='btn btn-warning'>
              <i class="fa-solid fa-print fa-lg"></i> 
          </a>
            @else
            <button disabled style='position:absolute; width:50px; padding:17px; right:10px; top:-1px;' class='btn btn-secondary'>
                <i class="fa-solid fa-print fa-lg"></i>
            </button>
            @endif
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
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Pemohon</label>
                    </div>
                    <div class="col-md-3">
                        : {{ $pengajuan_kebutuhan->nama }}
                    </div>
                </div>
                @if(isset($pengajuan_kebutuhan->total_dana_kebutuhan))
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Total Dana Kebutuhan</label>
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
            <table class="table table-hover table-borderless table-striped DataTable">
                        <thead>
                            <tr>
                                <th>Ruangan</th>
                                <th>Item Kebutuhan</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Satuan</th>
                                <th>Spesifikasi</th>
                                @if(isset($item_kebutuhan->bulan_rencana_realisasi))
                                <th>Bulan Rencana Realisasi</th>
                                @endif
                                <th>Status</th>
                                <th>Foto Barang</th>
                                @if ($pengajuan_kebutuhan->status == 'Draf')
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
                                    @if(isset($item_kebutuhan->bulan_rencana_realisasi))
                                    <th>{{ $p->bulan_rencana_realisasi}}</th>
                                    @endif
                                    @if($p->status == 'Ditolak')
                                        <td>{{ $p->status }}
                                            <p class='text-danger small fst-italic'>Terhapus otomatis sebulan kemudian.</p>
                                        </td>
                                    @else
                                        <td>{{ $p->status }}</td>
                                    @endif
                                    <td>
                                        @if ($p->foto_barang_kebutuhan)
                                            <img src="{{ url('foto') . '/' . $p->foto_barang_kebutuhan }} "
                                                style="max-width: 150px; height: auto;" />
                                        @endif
                                    </td>
                                    <td>
                                    @if ($pengajuan_kebutuhan->status == 'Draf')
                                        <a class='btn btn-primary' style='margin:2px' href="/dashboard-pemohon/item-kebutuhan/edit/{{ $p->id_item_kebutuhan }}"><i class="fa-solid fa-pen" style="cursor: pointer;">
                                           </i>
                                        </a>
                                            <button class="btn btn-danger btnHapus" idItemKebutuhan="{{ $p->id_item_kebutuhan }}"><i class="fa-solid fa-trash"></i></button>
                                            @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>


       
    
@endsection

    @section('footer')
    <script type="module">
        $('#Ajukan').on('click', '.btnAjukan', function(a) {
            a.preventDefault();
            let idPengajuanKebutuhan = $(this).closest('.btnAjukan').attr('idPengajuanKebutuhan');
            swal.fire({
                title: "Anda ingin Mengajukan Kebutuhan ini?",
                text: 'Pengajuan akan dikirim kepada Bendahara Sekolah',
                showCancelButton: true,
                confirmButtonText: 'Ajukan',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'green',
                icon: 'question'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/dashboard-pemohon/pengajuan-kebutuhan/ajukan/'+idPengajuanKebutuhan,
                        data: { 
                            id_pengajuan_kebutuhan: idPengajuanKebutuhan,
                            status: 'Terkirim',
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Pengajuan kebutuhan Berhasil Diajukan!', '', 'success').then(function() {
                                location.reload();
                                });
                            }
                        }
                    
                    });
        }});
        });
    </script>

<script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idItemKebutuhan = $(this).closest('.btnHapus').attr('idItemKebutuhan');
            swal.fire({
                title: "Apakah Anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    //Ajax Delete
                    $.ajax({
                        type: 'DELETE',
                        url: '/dashboard-pemohon/item-kebutuhan/hapus',
                        data: {
                            id_item_kebutuhan: idItemKebutuhan,
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
