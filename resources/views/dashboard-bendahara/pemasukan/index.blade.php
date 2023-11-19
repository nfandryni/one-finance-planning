@extends('layout.layout')
@section('pemasukan', 'active')
@section('title', 'Daftar Pemasukan')
@section('content')
<br>
    <div class="row"><h1>Kelola Data Pemasukan</h1>
    <h3 class="card-title"> Jumlah Pemasukan: {{ $jumlahDana ?? 0 }}</h3><br><br>

    <div class="col-md-12">
            <div class="row justify-content-md-center" style="align-items: center">
              <div class="col-sm">
             
                  <div class="col-sm">
                    <a href="/dashboard-bendahara/pemasukan/tambah">
                      <btn class="btn btn-primary">Tambah Data</btn>
                  </a></div>
              </div>
              <div class="col-sm">
                <div class="form-group">
                <input type="text" placeholder="Cari pemasukan..." class="form-control" name="pemasukan" />
            </div>
              </div>
              </div>
            </div>
            <div class="col-md-4">
             
            <div>
            </div>
        </div>
                         </div>
                        <p>
                            <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Sumber Dana</th>
                                    <th>Nominal (Rupiah)</th>
                                    <th>Waktu</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($pemasukan as $s)
                                    <tr>
                                        <td>{{ $s->sumber_dana->nama_sumber }}</td>
                                        <td>{{ $s->nominal }}</td>
                                        <td>{{ $s->waktu }}</td>
                                        <td><img src='../foto/{{$s->file}}' width='200px'/></td>
                                        <td>
                                            <a href="/dashboard-bendahara/pemasukan/edit/{{$s->id_pemasukan}}" class="btn btn-primary">
                                                EDIT
                                                </a>
                                            <btn class="btn btn-danger btnHapus" idPemasukan="{{ $s->id_pemasukan }}">HAPUS</btn>
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
    </script>

@endsection 
