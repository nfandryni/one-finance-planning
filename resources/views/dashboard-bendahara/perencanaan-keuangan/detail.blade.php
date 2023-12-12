@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
@section('content')
    <div class="row px-5">

        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h4" style="font-weight:bold;">Detail Perencanaan Keuangan</span>
        </div>


        <div class="card">
            <div class="col-md-12" style=" display:flex; padding:3vh">
                    <div class="col-md-3" style=" ">
                        <div class="form-group">
                            <h5 style="font-weight:bold;">Nama Perencanaan</h5>

                        </div>
                        <div class="form-group">
                            <h5 style="font-weight:bold;">Sumber Dana</h5>

                        </div>
                        <div class="form-group">
                            <h5 style="font-weight:bold;">Judul Perencanaan</h5>

                        </div>
                        <div class="form-group">
                            <h5 style="font-weight:bold;">Tujuan</h5>

                        </div>
                         <div class="form-group">
                            <h5 style="font-weight:bold;">Waktu</h5>

                        </div>
                         <div class="form-group">
                            <h5 style="font-weight:bold;">Total Dana</h5>

                        </div>
                        <div class="form-group">
                            <h5 style="font-weight:bold;">List Perencanaan</h5>

                        </div>
                    </div>
                    <div class="col-md-5" style=" ">
                        <div class="form-group">
                            <h5>{{ $perencanaan_keuangan->judul_perencanaan }}</h5>

                        </div>
                        <div class="form-group">
                            <h5>{{ $perencanaan_keuangan->nama_sumber }}</h5>

                        </div>
                        <div class="form-group">
                            <h5>{{ $perencanaan_keuangan->judul_perencanaan }}</h5>

                        </div>
                        <div class="form-group">
                            <h5>{{ $perencanaan_keuangan->tujuan }}</h5>

                        </div>
                        <div class="form-group">
                            <h5>{{ $perencanaan_keuangan->waktu }}</h5>

                        </div>
                        <div class="form-group">
                            <h5>{{ $perencanaan_keuangan->total_dana_perencanaan }}</h5>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <table class="table table-hover table-borderless table-striped DataTable">
                        <thead>
                            <tr>
                                <th>Ruangan</th>
                                <th>Item Kebutuhan</th>
                                <th>QTY</th>
                                <th>Harga Satuan</th>
                                <th>Satuan</th>
                                <th>Spesifikasi</th>
                                <th>Foto</th>
                                @if(!isset($s->id_pengajuan_kebutuhan))
                                <th>Aksi</th>
                                @endif
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
                                    <td>
                                        @if ($p->foto_barang_perencanaan)
                                            <img src="{{ url('foto') . '/' . $p->foto_barang_perencanaan }} "
                                                style="max-width: 150px; height: auto;" />
                                        @endif
                                    </td>
                                @if(!isset($s->id_pengajuan_kebutuhan))
                                    <td>
                                        <a href="/dashboard-bendahara/item-perencanaan/edit/{{ $p->id_item_perencanaan }}" <btn
                                            class="btn btn-warning">Edit</btn>

                                        </a>
                                        <a>
                                            <btn class="btn btn-danger btnHapus"
                                                idItemPerencanaan="{{ $p->id_item_perencanaan }}">Hapus</btn>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="col-md-12 mt-3 d-flex " style="gap: 10px; justify-content:end">
                        <a href="/dashboard-bendahara/perencanaan-keuangan" <btn class="btn btn-dark">KEMBALI</btn></a>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idItemPerencanaan = $(this).closest('.btnHapus').attr('idItemPerencanaan');
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