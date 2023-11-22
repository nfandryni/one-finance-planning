@extends('layout.layout')
@section('title', 'Dashboard')
@section('dashboard', 'active')
@section('page', 'Dashboard')
@section('content')
    <div class="d-flex flex-row">
    <h4  class="fw-bold ">Halo,</h4>
    <h4 class="fw-bold ms-2">  {{ Auth::user()->username }} !</h4> 
    </div>

    <h5>Selamat datang, disini anda bisa membuat akun, melihat dan mengedit akun yang ada disini.</h5>
    <div class="flex-row d-flex  gap-3 justify-content-between " >
       <div class="col-md-4 ">
            <div class="shadow-sm mb-3 rounded d-flex justify-content-center flex-column align-items-center"  style="background-color:#D9D9D9; width:350; height:200">
                <h1 class="fw-bold">Total Akun</h1>
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-user-group " style="font-size: 50" ></i>
                        <h3 style="align-items: center">{{ $data[0] }}</h3>
                    </div> 
                
            </div>
        </div>    
            <div class="col-md-8">
            
            </div>
    </div>


  {{-- <div class="container">
        <canvas id="myChart" width="400" height="200"></canvas>
    </div> --}}

@endsection


