<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <h2 class='text-center m-2'>Realisasi {{ $realisasi->judul_realisasi }}</h2>
    <div class='row mb-2'>
        <div class="col-md-3">
            <label style='margin-right:10px;'><b>Tujuan</b> : {{ $realisasi->tujuan }}</label>
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'><b>Waktu</b> : {{ $realisasi->waktu }}</label>
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'><b>Total Pembayaran</b> : {{ $realisasi->total_pembayaran }}</label>
                    </div>
                </div>
            </div>
            <hr />
            <div>
            <h4 class='fw-bold mb-3'>Item Realisasi</h4> 
<table class="table table-striped">
    <thead>
        <tr>
                                <th>Item</th>
                                <th>QTY</th>
                                <th>Harga Satuan</th>
                                <th>Satuan</th>
                                <th>Ruangan</th>
                                <th>Spesifikasi</th>
                                <th>Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item_perencanaan as $p)
                            @if($p->status == 'Terbeli')
                            <tr>
                                <td>{{ $p->item_perencanaan }}</td>
                                <td>{{ $p->qty }}</td>
                                <td>{{ $p->harga_satuan }}</td>
                                <td>{{ $p->satuan }}</td>
                                <td>{{ $p->nama_ruangan }}</td>
                                <td>{{ $p->spesifikasi }}</td>
                                <td>{{ $p->nama }}</td>
                            </tr>
                                @endif
                                @endforeach
                        </tbody>
                    </table>