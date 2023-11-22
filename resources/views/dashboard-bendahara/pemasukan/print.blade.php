<table class="table">
    <thead>
        <tr>
            <th scope='col'>No</th>
            <th scope='col'>Sumber Dana</th>
            <th scope='col'>Nama Pemasukan</th>
            <th scope='col'>Nominal (Rupiah)</th>
            <th scope='col'>Waktu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemasukan as $s)
            <tr>
                <td scope='row'>{{ $loop->iteration }}</td>
                <td>{{ $s->nama_sumber }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->nominal }}</td>
                <td>{{ $s->waktu }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
