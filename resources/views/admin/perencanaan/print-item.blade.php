    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <h2 class='text-center m-2'>Perencanaan Keuangan {{ $perencanaan_keuangan->judul_perencanaan }}</h2>
   
    <div class="col-md-3">
        <div class='row mb-2'>
            <label class='fw-bold'><b>Sumber Dana</b> : {{ $perencanaan_keuangan->nama_sumber }}</label>
        </div>
    </div>
    <div class='row mb-2'>
        <div class="col-md-3">

            <label class='fw-bold'><b>Tujuan</b> : {{ $perencanaan_keuangan->tujuan }}</label>
        </div>
    </div>
    <div class='row mb-2'>
        <div class="col-md-3">
            <label class='fw-bold'><b>Waktu</b> : {{ $perencanaan_keuangan->waktu }}</label>
        </div>
    </div>
    <div class='row mb-2'>
        <div class="col-md-3">
            <label class='fw-bold'><b>Total Dana Perencanaan</b> :
                {{ $perencanaan_keuangan->total_dana_perencanaan ?? 0 }}</label>
        </div>
    </div>
    </div>
    <hr />
    <div>
        <h4 class='fw-bold mb-3'>Item Perencanaan</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ruangan</th>
                    <th>Item</th>
                    <th>QTY</th>
                    <th>Harga Satuan</th>
                    <th>Satuan</th>
                    <th>Spesifikasi</th>
                    <th>Status</th>
                    <th>Rencana Realisasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item_perencanaan as $p)
                    <tr>
                        <td>{{ $p->nama_ruangan }}</td>
                        <td>{{ $p->item_perencanaan }}</td>
                        <td>{{ $p->qty }}</td>
                        <td>{{ $p->harga_satuan }}</td>
                        <td>{{ $p->satuan }}</td>
                        <td>{{ $p->spesifikasi }}</td>
                        <td>{{ $p->status }}</td>
                        <td>{{ $p->bulan_rencana_realisasi }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
