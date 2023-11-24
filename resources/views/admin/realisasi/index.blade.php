@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')
<br>
    <div class="">
    <h2 class="fw-bold"> Data Realisasi</h2>
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
                      
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($realisasi as $s)
                                    <tr>
                                        <td>{{ $s->judul_realisasi }}
                                            @if(is_null($s->id_pengeluaran))
                                            <p class='text-danger mt-1 fst-italic fs-6'>Catatan Pengeluaran belum Ditambahkan.</p>
                                            @endif
                                        </td>
                                        <td>{{ $s->waktu }}</td>    
                                        <td>{{ $s->total_pembayaran }}</td>
                                        
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