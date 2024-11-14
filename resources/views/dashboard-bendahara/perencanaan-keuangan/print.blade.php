<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2 class='text-center m-2'>Perencanaan Keuangan</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope='col'>Nama Kegiatan</th>
            <th scope='col'>Sumber Dana</th>
            <th scope='col'>Waktu</th>
            <th scope='col'>Tujuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($perencanaan_keuangan as $p)
            <tr>
                <td>{{ $p->judul_perencanaan }}</td>
                <td>{{ $p->nama_sumber }}</td>
                <td>{{ $p->waktu }}</td>
                <td>{{ $p->tujuan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>