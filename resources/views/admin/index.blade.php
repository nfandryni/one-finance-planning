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
    


@endsection


