<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Akun</title>
</head>

<body>
<table class="table table-borderless table-striped DataTable">
                        <thead>
                            <tr>
                                <th>NO </th>
                                <th>USERNAME </th>
                                <th>ROLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akun as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->username }}</td>
                                    <td class="text-capitalize">{{ $s->role }}</td>
                                    <td>
                                        <a href="kelola-akun/edit/{{ $s->user_id }}"
                                            style="text-decoration: none; color:black">
                                            <i class="fa-solid fa-pen "></i>
                                        </a>
                                        <a href="kelola-akun/detail/{{ $s->user_id }}"
                                            style="text-decoration: none; color:black">
                                            <i class="fa-solid fa-circle-info "></i>
                                        </a>
                                        <i class="fa-solid fa-trash btnHapus" userId="{{ $s->user_id }}"></i>
                                        <a href="{{ url('kelola-akun/generate') }}"
                                            style="text-decoration: none; color:black">
                                           <i class="fa-solid fa-print"></i>
                                        </a>
                                         
                                        @csrf
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
</body>

</html>
