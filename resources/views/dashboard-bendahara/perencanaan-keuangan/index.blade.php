@extends('layout.layout')
@section('perencanaan-keuangan', 'active')
@section('title', 'Daftar Perencanaan Keuangan')
@section('content')
<br>
    <div class="row px-5">
    <h2 class="fw-bold">Kelola Data Perencanaan Keuangan</h2>
    <div class="card" style="height: 75px;">
        <h4 class=" fw-bold p-3">Cetak Data Realisasi </h4>
    </div>
    <div class="col-md-12">
                     <div class="row justify-content-md-center" style="align-items: center">
                      
                        <div class="col-sm-2">
                        <div class="col" >
                            <a href="perencanaan-keuangan/tambah">
                                <btn class="btn btn-primary">Tambah Data</btn>
                            </a>

                        </div>
                        </div>
                    </div>
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead> 
                                <tr>
                                    <th>Judul Perencanaan</th>
                                    <th>Tujuan</th>
                                    <th>Waktu</th>
                                    <th>Total Dana Perencanaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($perencanaan_keuangan as $p)
                                    <tr>
                                        <td>{{ $p->judul_perencanaan }}
                                            @if(is_null($p->id_pengajuan_kebutuhan))
                                            <p class='text-danger mt-1 fst-italic fs-6'>Catatan Pengajuan Kebutuhan belum Ditambahkan.</p>
                                            @endif
                                        </td>
                                        <td>{{ $p->tujuan }}</td>  
                                        <td>{{ $p->waktu }}</td>   
                                        <td>{{ $p->total_dana_perencanaan }}</td>
                                        <td>
                                           <a  href='/dashboard-bendahara/perencanaan-keuangan/detail/{{$p->id_perencanaan_keuangan}}'><i class="fa-solid fa-circle-info fa-lg" style="color: #000000;"></i></a>
                                            <btn class="btnHapus" style="cursor: pointer" idPerencanaanKeuangan="{{ $p->id_perencanaan_keuangan }}"><i class="fa-solid fa-trash"></i></btn>
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


@section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idrealisasi = $(this).closest('.btnHapus').attr('idrealisasi');
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
                        url: 'realisasi/hapus',
                        data: {
                            id_realisasi: idrealisasi,
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