@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Detail Realisasi')
@section('content')

    <div class="row px-5">

        <div class="col-md-12">
            <div class="row justify-content-md-center" style="align-items: center">
            <br/>
           <a class='text-black mt-2' href='/realisasi'><i class="fa-solid fa-arrow-left fa-xl "></i></a> 
                
            </div>
            <div>
                <br />
                <h3 class='fw-bold mb-3'>Detail Realisasi</h3>
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Nama Realisasi </label>
                    </div>
                    <div class="col-md-6">
                    Perbaikan Gedung
                    </div>
                </div>
               
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Tujuan</label>
                    </div>
                    <div class="col-md-9">
                        	Implementasi dari Program Kerja Kepala Sekolah
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Waktu</label>
                    </div>
                    <div class="col-md-3">
                        	2023-11-18
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Total Dana</label>
                    </div>
                    <div class="col-md-3">
                        2000000
                    </div>
                </div>
            </div>
            <hr />
            <div>
            <h4 class='fw-bold mb-3'>List Perencanaan</h4> 
             
            <table class="table table-hover table-borderless table-striped DataTable">
                        <thead>
                            <tr>
                                <th>Ruangan</th>
                                <th>Item </th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Satuan</th>
                                <th>Spesifikasi</th>
                                <th>Pengeluaran</th>
                                <th>Status</th>
                                <th>Foto Perencanaan</th>
                                <th>Foto Realisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>d4</td>
                                    <td>Kursi</td>
                                    <td>35</td>
                                    <td>12000</td>
                                    <td>pcs</td>
                                    <td>Terbuat dari kayu super kuat dan kokoh </td>
                                    <td>Family RPL B </td>
                                    <td> Terbeli </td>
                                    <td>
                                            <img src="/foto/kursi.jpg"
                                                style="max-width: 150px; height: auto;" />
                                        
                                    </td>
                                    <td>
                                            <img src="/foto/kursiereal.jpg"
                                                style="max-width: 150px; height: auto;" />
                                        
                                    </td>
            
                                </tr>

                        </tbody>
                    </table>
            </div>
        </div>
    </div>

@endsection


@section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnTolak', function(a) {
            a.preventDefault();
            let idItemKebutuhan = $(this).closest('.btnTolak').attr('idItemKebutuhan');
            swal.fire({
                title: "Anda ingin menolak item ini?",
                text: 'Item tidak akan ditampilkan lagi',
                showCancelButton: true,
                confirmButtonText: 'Tolak',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/dashboard-bendahara/konfirmasi-pengajuan/tolak-item/'+idItemKebutuhan,
                        data: { 
                            id_item_kebutuhan: idItemKebutuhan,
                            status: 'Ditolak',
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Item kebutuhan berhasil ditolak!', '', 'success').then(function() {
                                location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
      <script type="module">
        $('#Konfirmasi').on('click', '.btnKonfirmasi', function(a) {
            a.preventDefault();
            let idPengajuanKebutuhan = $(this).closest('.btnKonfirmasi').attr('idPengajuanKebutuhan');
            swal.fire({
                title: "Konfirmasi pengajuan ini?",
                text: 'Pengajuan ini akan dikonfirmasi dan dikirim ke perencanaan keuangan',
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'green',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/konfirmasi-pengajuan/konfirmasi/'+idPengajuanKebutuhan,
                        data: { 
                            id_pengajuan_kebutuhan: idPengajuanKebutuhan,
                            status: 'DiKonfirmasi',
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Pengajuan Kebutuhan berhasil dikonfirmasi!', 'success').then(function() {
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