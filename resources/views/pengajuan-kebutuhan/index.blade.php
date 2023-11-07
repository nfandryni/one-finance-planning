@extends('layout.layout')
@section('akun', 'active')
@section('title', 'Daftar Pengajuan Kebutuhan')
@section('content')
    <div class="row">
        
        <div class="col-md-12"><br>
            <span class="h2" style="font-weight: bold">Kelola Data Pengajuan Kebutuhan</span>
            <br><br>
            <div class="card">
                <div class="card-body">
                    <div class="row" >
                        <div class="col" style="align-items:center">
                            <a href="pengajuan-kebutuhan/tambah">
                                <btn class="btn btn-success">Tambah Pengajuan Kebutuhan</btn>
                            </a>

                        </div>
                        <p>
                            <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Pemohon</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan_kebutuhan as $s)
                                    <tr>
                                        <td>{{ $s->pemohon }}</td>
                                        <td>{{ $s->nama_kegiatan }}</td>
                                        <td>{{ $s->status }}</td>
                                        <td>{{ $s->waktu }}</td>
                                        {{-- <td>
                                            @if ($s->file)
                                                <img src="{{ url('foto') . '/' . $s->file }} "
                                                    style="max-width: 250px; height: auto;" />
                                            @endif
                                        </td> --}}
                                        <td>
                                            <a href="pengajuan-kebutuhan/edit/{{ $s->id_pengajuan_kebutuhan }}">
                                                <btn class="btn btn-primary">EDIT</btn>
                                            </a>
                                            <btn class="btn btn-danger btnHapus" idPengajuanKebutuhan="{{ $s->id_pengajuan_kebutuhan }}">HAPUS</btn>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idSurat = $(this).closest('.btnHapus').attr('idSurat');
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
                        url: 'surat/hapus',
                        data: {
                            id_surat: idSurat,
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

@endsection --}}
