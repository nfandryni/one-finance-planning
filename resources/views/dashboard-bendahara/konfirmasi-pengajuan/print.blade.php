<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2 class='text-center m-2'>Pengajuan Kebutuhan</h2>
<table class="table table-borderless table-striped mt-2 DataTable">
                            <thead> 
                                <tr>
                                    <th>Nama Pemohon</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Waktu</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan_kebutuhan as $s)
                                    <tr>
                                        <td>{{ $s->nama }}
                                        </td>
                                        <td>{{ $s->nama_kegiatan }}</td>    
                                        <td>{{ $s->waktu }}</td>    
                                        <td>{{ $s->tujuan }}</td>    
                                        <td>{{ $s->status }}</td>    
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>