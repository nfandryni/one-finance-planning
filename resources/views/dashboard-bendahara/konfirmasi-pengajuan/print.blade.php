<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<h2 class='text-center m-2'>Pengajuan Kebutuhan</h2>
<table class="table table-borderless table-striped mt-2 DataTable">
                            <thead> 
                                <tr>
                                    <th>Nama Pemohon</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Waktu</th>
<<<<<<< HEAD
                                    <th>Status</th>
                                    <th>Total Dana</th>
=======
                                    <th>Tujuan</th>
                                    <th>Status</th>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan_kebutuhan as $s)
                                    <tr>
                                        <td>{{ $s->nama }}
                                        </td>
                                        <td>{{ $s->nama_kegiatan }}</td>    
                                        <td>{{ $s->waktu }}</td>    
<<<<<<< HEAD
                                        <td>{{ $s->status }}</td>    
                                        <td>{{ $s->total_dana_kebutuhan }}</td>    
                                    </tr>
                                    @endif
=======
                                        <td>{{ $s->tujuan }}</td>    
                                        <td>{{ $s->status }}</td>    
                                    </tr>
>>>>>>> 82ebaee4c19cba6db945c4c1e87abae79a02c97f
                                @endforeach 
                            </tbody>
                        </table>