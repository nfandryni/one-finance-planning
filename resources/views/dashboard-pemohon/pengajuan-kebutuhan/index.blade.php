@extends('layout.layout')
@section('pengajuan-kebutuhan', 'active')
@section('title', 'Daftar Pengajuan Kebutuhan')
@section('content')
                    <div class="row ">
                        
                        <div class="col-md-12" style="margin-bottom:2vh">
                            <div class="row">
                                <h2 class="fw-bold">Kelola Data Pengajuan Kebutuhan</h2>
                                <h5 class="card-title"> Jumlah Pengajuan Kebutuhan: {{ $totalList ?? 0 }}</h5>
        @if(!$pengajuan_kebutuhan->isEmpty())
    <a target='_blank' href="{{ url('/dashboard-pemohon/cetak') }}" style='position:absolute; width:130px; right:30px;' class='btn btn-warning'>
    <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
        </a>
        @else
        <button disabled style='position:absolute; width:130px; right:30px;' class='btn btn-secondary'>
        <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
            </button>
        @endif
        <hr>
                        </div>
                        
                        <div class="col-md-12">
            <div class="row justify-content-md-end" style="align-items: center">
                <div class="col-sm-2">
                    <div class="col-sm">
                        <a href="/dashboard-pemohon/pengajuan-kebutuhan/tambah">
                            <btn class="btn btn-primary" style='position:absolute; margin-top:20px;'>Tambah Data</btn>
                        </a>
                    </div>
                </div>
            </div>
        </div>
                        <table class="table table-hover table-borderless table-striped DataTable">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Pemohon</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan_kebutuhan as $s)
                                <tr>
                                    @if($s->status == 'Ditolak')
                                        <td>{{ $s->status }}
                                            <p class='text-danger small fst-italic'>Terhapus otomatis sebulan kemudian.</p>
                                        </td>
                                        @else
                                        <td>{{ $s->status }}</td>
                                        @endif
                                        <td>{{ $s->nama_kegiatan }}</td>
                                        @if($s->user_id == Auth::user()->user_id)
                                        <td>{{ $s->nama }} (Anda)</td>
                                        @else
                                        <td>{{ $s->nama }} </td>
                                        @endif
                                        <td>{{ $s->waktu }}</td>
                                        {{-- <td>
                                            @if ($s->file)
                                            <img src="{{ url('foto') . '/' . $s->file }} "
                                            style="max-width: 250px; height: auto;" />
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if($s->user_id == Auth::user()->user_id)
                                            @if($s->status == 'Draf')
                                            <a href="item-kebutuhan/tambah/{{ $s->id_pengajuan_kebutuhan}}"  style="text-decoration: none; color:black">
                                                <i class="fa-solid fa-circle-plus" style="margin: 0 2px; cursor:pointer"></i>
                                            </a>
                                            
                                            <a href="pengajuan-kebutuhan/edit/{{ $s->id_pengajuan_kebutuhan}}"  style="text-decoration: none; color:black">
                                                <i class="fa-solid fa-pen "></i>
                                            </a>
                                            @endif
                                            <a href="pengajuan-kebutuhan/detail/{{ $s->id_pengajuan_kebutuhan}}"  style="text-decoration: none; color:black">
                                                 <i class="fa-solid fa-circle-info" style="margin: 0 2px; cursor:pointer"></i>
                                                </a>
                                            @if($s->status == 'Draf')
                                                
                                                <i class="fa-solid fa-trash btnHapus" style="cursor:pointer" idPengajuanKebutuhan="{{ $s->id_pengajuan_kebutuhan}}"></i>
                                                @endif
                                            @else
                                            <p>Tidak ada Akses</p>
                                            @endif
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