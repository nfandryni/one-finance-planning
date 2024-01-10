@extends('layout.layout')
<<<<<<< HEAD
@section('pengajuan-kebutuhan', 'active')
@section('title', 'Daftar Pengajuan Kebutuhan')
@section('content')
    <div class="row px-5">

        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h4" style="font-weight:bold;">Detail Pengajuan Kebutuhan</span>
        </div>


        <div class="card">
            <div class="card-body">
                {{-- <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                <div class="col-md-12" style=" display:flex">
                    <div class="col-md-3" style=" ">
                        <div class="form-group">
                            <h5 style="font-weight:bold;">Nama Kegiatan</h5>

                        </div>
                        <div class="form-group">
                            <h5 style="font-weight:bold;">Status</h5>

                        </div>
                        <div class="form-group">
                            <h5 style="font-weight:bold;">Waktu</h5>

                        </div>
                        <div class="form-group">
                            <h5 style="font-weight:bold;">Tujuan</h5>

                        </div>
                        <div class="form-group">
                            <h5 style="font-weight:bold;">List Kebutuhan</h5>

                        </div>
                    </div>
                    <div class="col-md-3" style=" ">
                        <div class="form-group">
                            <h5>{{ $pengajuan_kebutuhan->nama_kegiatan }}</h5>

                        </div>
                        <div class="form-group">
                            <h5>{{ $pengajuan_kebutuhan->status }}</h5>

                        </div>
                        <div class="form-group">
                            <h5>{{ $pengajuan_kebutuhan->waktu }}</h5>

                        </div>
                        <div class="form-group">
                            <h5>{{ $pengajuan_kebutuhan->tujuan }}</h5>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <table class="table table-hover table-borderless table-striped DataTable">
                        <thead>
                            <tr>
                                <th>Pengajuan Kebutuhan</th>
                                <th>Ruangan</th>
                                <th>Item Kebutuhan</th>
=======
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
@section('content')

<div style='margin-left:15px; margin-right:15px;'>
        <div class="row justify-content-md-center" style="align-items: center">
        <br/>
       <a class='text-black mt-2' href='/dashboard-bendahara/perencanaan-keuangan'><i class="fa-solid fa-arrow-left fa-xl "></i></a> 
        </div>
        <div>
<div class="row justify-content-md-end" style="align-items: center">

        <a target='_blank' href="{{ url('/dashboard-bendahara/perencanaan-keuangan/print-item/'. $perencanaan_keuangan->id_perencanaan_keuangan ) }}" style='position:absolute; width:130px; right:40px; top:110px;' class='btn btn-warning'>
<i class="fa-solid fa-print fa-lg"></i> Cetak Data 
    </a>
</div>
            <br />
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
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                                <th>QTY</th>
                                <th>Harga Satuan</th>
                                <th>Satuan</th>
                                <th>Spesifikasi</th>
<<<<<<< HEAD
                                <th>Foto</th>
                                <th>Aksi</th>
=======
                                <th>Status</th>
                                <th>Rencana Realisasi</th>
                                <th>Foto</th>
                                @if(!isset($perencanaan_keuangan->id_pengajuan_kebutuhan))
                                <th>Aksi</th>
                                @endif
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                            </tr>
                        </thead>
                        <tbody>

<<<<<<< HEAD
                            @foreach ($item_kebutuhan as $p)
                                <tr>

                                    <td>{{ $pengajuan_kebutuhan->nama_kegiatan }}</td>
                                    <td>{{ $p->nama_ruangan }}</td>
                                    <td>{{ $p->item_kebutuhan }}</td>
=======
                            @foreach ($item_perencanaan as $p)
                                <tr>
                                    <td>{{ $p->nama_ruangan }}</td>
                                    <td>{{ $p->item_perencanaan }}</td>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                                    <td>{{ $p->qty }}</td>
                                    <td>{{ $p->harga_satuan }}</td>
                                    <td>{{ $p->satuan }}</td>
                                    <td>{{ $p->spesifikasi }}</td>
<<<<<<< HEAD
                                    <td>
                                        @if ($p->foto_barang_kebutuhan)
                                            <img src="{{ url('foto') . '/' . $p->foto_barang_kebutuhan }} "
                                                style="max-width: 150px; height: auto;" />
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/dashboard-pemohon/item-kebutuhan/edit/{{ $p->id_item_kebutuhan }}" <btn
                                            class="btn btn-warning">Edit</btn>

                                        </a>
                                        <a>
                                            <btn class="btn btn-danger btnHapus"
                                                idItemKebutuhan="{{ $p->id_item_kebutuhan }}">Hapus</btn>
                                        </a>
                                    </td>
=======
                                    <td>{{ $p->status }}</td>
                                    <td>{{ $p->bulan_rencana_realisasi }}</td>
                                    <td>
                                        @if ($p->foto_barang_perencanaan)
                                        <img src="{{ url('foto') . '/' . $p->foto_barang_perencanaan }} "
                                        style="max-width: 150px; height: auto;" />
                                        @endif
                                    </td>
                                    @if(!isset($s->id_pengajuan_kebutuhan))
                                    <td>
                                        @if($p->status == 'Terbeli')
                                       <button disabled class="btn btn-secondary m-1"><i class="fa-solid fa-pen" style="cursor: pointer;">
                                           </i></button>
                                            <button disabled class="btn btn-secondary m-1"><i class="fa-solid fa-xmark"></i></button>
                                        @else
                                        <a class='btn btn-primary' style='margin:2px' href="/dashboard-bendahara/item-perencanaan/edit/{{ $p->id_item_perencanaan }}"><i class="fa-solid fa-pen" style="cursor: pointer;">
                                           </i>
                                        </a>
                                            <btn class="btn btn-danger btnHapus"
                                                idItemPerencanaan="{{ $p->id_item_perencanaan }}"><i class="fa-solid fa-xmark"></i></btn>
                                    </td>
                                    @endif
                                    @endif
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
<<<<<<< HEAD
                    {{-- <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
                        <a href="/dashboard-pemohon/pengajuan-kebutuhan/edit/{{ $p->id_pengajuan_kebutuhan }}" <btn
                            class="btn btn-warning">Edit Pengajuan Kebutuhan</btn></a>
                        <a href="/dashboard-pemohon/item-kebutuhan/edit/{{ $p->id_item_kebutuhan }}" <btn
                            class="btn btn-warning">Edit Item Kebutuhan</btn></a>
                    </div> --}}
                    {{-- <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:start">
                            <a href="pengajuan-kebutuhan/edit/{{ $p->id_pengajuan_kebutuhan}}" <btn class="btn btn-primary">Edit Item Kebutuhan</btn></a>
                        </div> --}}
                    <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                        <a href="/dashboard-pemohon/pengajuan-kebutuhan" <btn class="btn btn-dark">KEMBALI</btn></a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
=======
    </div>
</div>

@endsection

>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f

    @section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
<<<<<<< HEAD
            let idItemKebutuhan = $(this).closest('.btnHapus').attr('idItemKebutuhan');
=======
            let idItemPerencanaan = $(this).closest('.btnHapus').attr('idItemPerencanaan');
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
                        url: '/dashboard-bendahara/item-perencanaan/hapus',
                        data: {
                            id_item_perencanaan: idItemPerencanaan,
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
    @section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idItemPerencanaan = $(this).closest('.btnHapus').attr('idItemPerencanaan');
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
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
<<<<<<< HEAD
                        url: '/dashboard-pemohon/item-kebutuhan/hapus',
                        data: {
                            id_item_kebutuhan: idItemKebutuhan,
=======
                        url: '/dashboard-bendahara/item-perencanaan/hapus',
                        data: {
                            id_item_perencanaan: idItemPerencanaan,
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
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