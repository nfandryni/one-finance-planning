<table class="table">
    <thead>
        <tr>
        <th>No</th>
            <th scope='col'>Pemohon</th>
            <th scope='col'>Nama Kegiatan</th>
            <th scope='col'>Status</th>
            <th scope='col'>Waktu</th>
            <th scope='col'>Tujuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengajuan_kebutuhan as $p)
            <tr>
                <td scope='row'>{{ $loop->iteration }}</td>
                <td>{{ $p->id_pemohon }}</td>
                <td>{{ $p->nama_kegiatan }}</td>
                <td>{{ $p->status }}</td>
                <td>{{ $p->waktu }}</td>
                <td>{{ $p->tujuan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
