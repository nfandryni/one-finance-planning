<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Detail Profile</title>
</head>

<body>
    <div class="row" style="background-color:#DCB1B1; border-radius:6;padding:6px">
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <h2 class="fw-bold mt-3 text-center">Profile Akun </h2>
        </div>
        <div class="col-md-12">
            @foreach ($data as $s)
               
                
                    <h3 class="fw-bold" style="letter-spacing: 2px;">{{ $s->nama }} </h3>
                    <h6>{{ $s->email !== null ? $s->email : '-' }}</h6>

                    <h5 class="text-capitalize mt-3">{{ $s->role }}</h5>
                    
                    <div class=" d-flex flex-row ">
                    <h5 class="fw-bold">Jabatan </h5>
                    <h6>{{ $s->jabatan !== null ? $s->jabatan : '-' }}</h6>


                    @if ($s->role == 'pemohon')
                        <h5 class="fw-bold">Kategori </h5>
                        <h6>{{ $s->kategori !== null ? $s->kategori : '-' }}</h6>
                    @endif
                    </div>
                    
            
            @endforeach
        </div>
    </div>

</body>

</html>
