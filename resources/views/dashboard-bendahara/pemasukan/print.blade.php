<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<<<<<<< HEAD
<h2 class='text-center m-2'>Catatan Pemasukan</h2>
<table class="table table-striped">
=======
<h2 class='text-center m-2'>Pemasukan</h2>
<table class="table table-borderless table-striped mt-2 DataTable">
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
    <thead>
        <tr>
            <th scope='col'>No</th>
            <th scope='col'>Sumber Dana</th>
            <th scope='col'>Nama Pemasukan</th>
            <th scope='col'>Nominal (Rupiah)</th>
            <th scope='col'>Waktu</th>
            <th scope='col'>Penanggung Jawab</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemasukan as $s)
            <tr>
                <td scope='row'>{{ $loop->iteration }}</td>
                <td>{{ $s->nama_sumber }}</td>
                <td>{{ $s->nama_pemasukan }}</td>
                <td>{{ $s->nominal }}</td>
                <td>{{ $s->waktu }}</td>
                <td>{{ $s->penanggung_jawab }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
