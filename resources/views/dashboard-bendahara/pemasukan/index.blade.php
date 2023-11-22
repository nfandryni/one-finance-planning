@extends('layout.layout')
@section('pemasukan', 'active')
@section('title', 'Daftar Pemasukan')
@section('content')
<br>
<div class="row"><h2 class="fw-bold">Kelola Data Pemasukan</h2>
<h3 class="card-title"> Jumlah Pemasukan: {{ $jumlahDana ?? 0 }}</h3><br><br>
    <hr>
    <div class="col-md-12">
                    <div class="row justify-content-md-end" style="align-items: center">
                        <div class="col-sm-2">
                        <div class="col-sm">
                    <a href="/dashboard-bendahara/pemasukan/tambah">
                      <btn class="btn btn-primary">Tambah Data</btn>
                  </a></div>
                        </div>
                    </div>
                    </div>
                         </div>

                        <table class="table table-borderless table-striped mt-2 DataTable">
                            <thead>
                                <tr>
                                    <th>Sumber Dana</th>
                                    <th>Nama Pemasukan</th>
                                    <th>Nominal (Rupiah)</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($pemasukan as $s)
                                    <tr>
                                            </i></a>
                                            <btn class="btnHapus" style="cursor: pointer" idPemasukan="{{ $s->id_pemasukan }}"><i class="fa-solid fa-trash"></i></btn>
                                            style="text-decoration: none; color:black">
                                            <i class="fa-solid fa-print "></i>
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
@endsection

@section('footer')
    <script type="module">
        $('tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idPemasukan = $(this).closest('.btnHapus').attr('idPemasukan');
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
                        url: 'pemasukan/hapus',
                        data: {
                            id_pemasukan: idPemasukan,
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
        $('.DataTable').DataTable({
        });
    });
    </script>

@endsection 
