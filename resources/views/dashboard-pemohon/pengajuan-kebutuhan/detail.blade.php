@extends('layout.layout')
@section('pengajuan-kebutuhan', 'active')
@section('title', 'Daftar Pengajuan Kebutuhan')
@section('content')
    <div class="row px-5">

        <div class="col-md-12" style="margin-bottom:2vh">
            <span class="h4" style="font-weight:bold;">Detail Pengajuan Kebutuhan</span>
            
            
            <div class="card">
                <div class="card-body">
                    <div id='Ajukan'>
                        @if($pengajuan_kebutuhan->status == 'Terkirim' 
                        || $pengajuan_kebutuhan->status == 'Ditolak' 
                        || $pengajuan_kebutuhan->status == 'Difilterisasi' 
                        || $pengajuan_kebutuhan->status == 'Dikonfirmasi'
                        || $item_kebutuhan->isEmpty())
                        <button disabled idPengajuanKebutuhan='{{$pengajuan_kebutuhan->id_pengajuan_kebutuhan}}' class='btn btnAjukan btn-secondary fw-bold' style='letter-spacing:1px; cursor:default; position:absolute; right:40px; top:20px;'><i class="fa-solid fa-paper-plane"></i> Ajukan</button>
                        @else
                        <button idPengajuanKebutuhan='{{$pengajuan_kebutuhan->id_pengajuan_kebutuhan}}' class='btn btnAjukan btn-success fw-bold' style='letter-spacing:1px; position:absolute; right:40px; top:20px;'><i class="fa-solid fa-paper-plane"></i> Ajukan</button>
                        @endif
                      </div>
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
                                <th>Ruangan</th>
                                <th>Item Kebutuhan</th>
                                <th>QTY</th>
                                <th>Harga Satuan</th>
                                <th>Satuan</th>
                                <th>Spesifikasi</th>
                                <th>Status</th>
                                <th>Foto</th>
                                @if($pengajuan_kebutuhan->status == 'Draf')    
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
                                    <td>{{ $p->status }}</td>
                                    <td>
                                        @if ($p->foto_barang_kebutuhan)
                                            <img src="{{ url('foto') . '/' . $p->foto_barang_kebutuhan }} "
                                                style="max-width: 150px; height: auto;" />
                                        @endif
                                    </td>
                                    <td>
                                        @if($pengajuan_kebutuhan->status == 'Draf')    
                                        <a href="/dashboard-pemohon/item-kebutuhan/edit/{{ $p->id_item_kebutuhan }}" <btn
                                            class="btn btn-warning">Edit</btn>

                                        </a>
                                        <a>
                                            <btn class="btn btn-danger btnHapus"
                                                idItemKebutuhan="{{ $p->id_item_kebutuhan }}">Hapus</btn>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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

@endsection 