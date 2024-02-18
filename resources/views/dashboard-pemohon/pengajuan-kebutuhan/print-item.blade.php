<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2 class='text-center m-2'>Pengajuan Kebutuhan {{ $pengajuan_kebutuhan->nama_kegiatan }}</h2>
<div class='row mb-2'>
    <div class="col-md-3">

        <label class='fw-bold'><b>Tujuan</b> : {{ $pengajuan_kebutuhan->tujuan }}</label>
    </div>
</div>
<div class='row mb-2'>
    <div class="col-md-3">
        <label class='fw-bold'><b>Waktu</b> : {{ $pengajuan_kebutuhan->waktu }}</label>

    </div>
</div>
<div class="col-md-3">
    <div class='row mb-2'>
        <label class='fw-bold'><b>Status</b> : {{ $pengajuan_kebutuhan->status }}</label>
    </div>
</div>
<div class="col-md-3">
    <div class='row mb-2'>
        <label class='fw-bold'><b>Pemohon</b> : {{ $pengajuan_kebutuhan->nama }}</label>
    </div>
</div>
@if(isset($pengajuan_kebutuhan->total_dana_kebutuhan))
<div class="col-md-3">
    <div class='row mb-2'>
        <label class='fw-bold'><b>Total Pembayaran</b> : {{ $pengajuan_kebutuhan->total_dana_kebutuhan }}</label>
    </div>
</div>
     @endif
<div class='row mb-2'>
    <hr />
    <div>
        <h4 class='fw-bold mb-3'>Item Kebutuhan</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ruangan</th>
                    <th>Item Kebutuhan</th>
                    <th>QTY</th>
                    <th>Harga Satuan</th>
                    <th>Satuan</th>
                    <th>Spesifikasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item_kebutuhan as $p)
                    <tr>
                        <td>{{ $p->nama_ruangan }}</td>
                        <td>{{ $p->item_kebutuhan }}</td>
                        <td>{{ $p->qty }}</td>
                        <td>{{ $p->harga_satuan }}</td>
                        <td>{{ $p->satuan }}</td>
                        <td>{{ $p->spesifikasi }}</td>
                        <td>{{ $p->status }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>