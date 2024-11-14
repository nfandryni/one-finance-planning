<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2 class='text-center m-2'>Realisasi</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope='col'>No</th>
            <th scope='col'>Judul Realisasi</th>
            <th scope='col'>Waktu</th>
            <th scope='col'>Total Dana</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($realisasi as $p)
            <tr>
                <td>{{ $p->loop_iteration }}</td>
                <td>{{ $p->judul_realisasi }}</td>
                <td>{{ $p->waktu }}</td>
                <td>{{ $p->total_pembayaran }}</td>
            </tr>
        @endforeach
    </tbody>
</table>