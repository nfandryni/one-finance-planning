@extends('layout.layout')
@section('title', 'Dashboard')
@section('dashboard', 'active')
@section('page', 'Dashboard')
@section('content')
    <h4>Selamat datang di One Finance Planning!</h4>
    
    <div class="d-flex flex-row " >
       <div class="col-md-4">
            <div class="shadow-sm mb-3 p-4 rounded d-flex justify-content-center flex-column align-items-center"  style="background-color:#D9D9D9">
                <h1 class="fw-bold">Total Akun</h1>
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-user-group " style="font-size: 50" ></i>
                        <h3 style="align-items: center">{{ $data[0] }}</h3>
                    </div> 
                
            </div>
        </div>    
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
    </div>


  <div class="container">
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>

@endsection

@section('footer')
<script>
    var ctx = document.getElementById('myChart').getContext('2d');

   
    
    var data = {
        labels: {!! json_encode($data[1]) !!},
        datasets: [{
            {{-- label: 'Example Data', --}}
            data:{!! json_encode($data[1]) !!},
            backgroundColor: [
                'red',
                'red',
                'red',
                'red',
            ],
        }]
    };

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            indexAxis: 'y',
            responsive: true,
        }
    });
</script>

@endsection
