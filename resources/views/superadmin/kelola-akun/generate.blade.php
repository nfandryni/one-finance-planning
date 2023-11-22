<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
  
  <h2 class='text-center m-2'>Daftar Akun</h2>
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope='col'>No</th>
              <th scope='col'>Username</th>
              <th scope='col'>Role</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($akun as $s)
              <tr>
                   <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $s->username }}</td>
                    <td class="text-capitalize">{{ $s->role }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
</body>

</html>

