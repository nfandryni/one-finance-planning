@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Daftar Realisasi')
@section('content')
<br>
    <div class="">
    <h2 class="fw-bold">Kelola Data Realisasi</h2>
    <!-- <div class="card" style="height: 75px;">
        <h4 class=" fw-bold p-3">Cetak Data Realisasi </h4>
    </div> -->
                
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
                                            <p class='text-danger mt-1 fst-italic fs-6'>Catatan Pengeluaran belum Ditambahkan.</p>
                                            @endif
                                        </td>
                                        <td>{{ $s->waktu }}</td>    
                                        <td>{{ $s->total_pembayaran }}</td>
                                        <td>
                                        <a class='text-black' href="/dashboard-bendahara/realisasi/edit-realisasi/{{ $s->id_realisasi }}"><i class="fa-solid fa-pen" style="cursor: pointer; margin:2px">
                                            </i></a>
                                           <a  href='/dashboard-bendahara/realisasi/detail/{{$s->id_realisasi}}'><i class="fa-solid fa-circle-info fa-lg" style="color: #000000;"></i></a>
                                            <btn class="btnHapus" style="cursor: pointer" idRealisasi="{{ $s->id_realisasi }}"><i class="fa-solid fa-trash"></i></btn>
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection


@section('footer')
    <script type="module">
        $('DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idRealisasi = $(this).closest('.btnHapus').attr('idRealisasi');
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
                            id_realisasi: idRealisasi,
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