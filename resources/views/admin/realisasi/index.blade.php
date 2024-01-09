@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')
<br>
    <div class="row">
    <div class="row">
            <h2 class="fw-bold"> Data Perencanaan Keuangan</h2>

            <a target='_blank' href="{{ url('/realisasi/print') }}" style='position:absolute; width:130px; right:30px;'
                class='btn btn-warning'>
                <i class="fa-solid fa-print fa-lg"></i> Cetak Data
            </a>

        </div>
        <hr>
    {{-- <div class="card" style="height: 75px;">
        <h4 class=" fw-bold p-3">Cetak Data Realisasi </h4>
    </div> --}}
    <div class="col-md-12 ">
                   
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead> 
                                <tr>
                                    <th>Nama Realisasi</th>
                                    <th>Waktu</th>
                                    <th>Total Pembayaran</th>
                                    <th>Aksi</th>
                      
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($realisasi as $s)
                                    <tr>
                                        <td>{{ $s->judul_realisasi }}
                                            @if(is_null($s->id_pengeluaran))
                                            {{-- <p class='text-danger mt-1 fst-italic fs-6'>Catatan Pengeluaran belum Ditambahkan.</p> --}}
                                            @endif
                                        </td>
                                        <td>{{ $s->waktu }}</td>    
                                        <td>{{ $s->total_pembayaran }}</td>
                                        <td>
                            
                            <a href="realisasi/detail"
                                style="text-decoration: none; color:black">
                                <i class="fa-solid fa-circle-info" style="margin: 0 20px; cursor:pointer"></i>
                            </a>

                           
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