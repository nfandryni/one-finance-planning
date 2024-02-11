<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2 class='text-center m-2'>Perencanaan Keuangan</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope='col'>Judul Perencanaan</th>
            <th scope='col'>Sumber Dana</th>
            <th scope='col'>Waktu</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    <td> Perbaikan Fasilitas </td>
                        <td> BOS</td>
                        <td> 2024-01-13</td></tr>
        {{-- @foreach ($perencanaan_keuangan as $p)
            <tr>
                <td>{{ $p->judul_perencanaan }}</td>
                <td>{{ $p->nama_sumber }}</td>
                <td>{{ $p->waktu }}</td>
                <td>{{ $p->tujuan }}</td>
            </tr>
        @endforeach --}}
    </tbody>
</table>