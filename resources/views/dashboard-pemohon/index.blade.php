@extends('layout.layout')
@section('dashboard-pemohon', 'active')
@section('title', 'Dashboard')
@section('content')
    <div>
        <a style="font-weight: bold; font-size:24px">Halo, Selamat Datang di One Finance Planning App sebagai  Pengajuan! </a><br>
        <a style="font-size:20px">Disini anda dapat mengelola kebutuhan, melihat data realisasi dan mencetak dokumen.</a>
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