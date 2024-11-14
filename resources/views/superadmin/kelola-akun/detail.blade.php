@extends('layout.layout')
@section('akun', 'active')
@section('title', 'Detail Profile Akun  ')
@section('content')
<div class="row ">
  <div class="row">
    <h1 class="fs-2 fw-bold mt-3">Detail Profile Akun </h1>
  </div>

  <div class="col-md-12 d-flex flex-direction-row align-items-center">
    @foreach ($data as $s)
      <div class="col-md-4">
      <img id="profile-image" src="{{ $s->foto_profil !== null ? url('foto/' . $s->foto_profil) : url('foto/pfp.jpg') }}" style="width:260;height:260;" class="rounded-circle" alt="pp">
      </div>
      <div class="col-md-8">
        <div class="col-md-12 row">
          <div class="col-md-6">
            <h3 class="fw-bold">Nama </h3>
            <h5 >{{ $s -> nama }}</h5>
          </div>
          <div class="col-md-6">
            <h3 class="fw-bold">Role </h3>
            <h5 class="text-capitalize">{{ $s -> role }}</ h5>
          </div>
        </div>
        <div class="col-md-12 row">
          <div class="col-md-6">
            <h3 class="fw-bold">Email </h3>
            <h5>{{ $s -> email !== null ? $s -> email : "Tidak Ada"}}</h5>
          </div>
          <div class="col-md-6">
            <h3 class="fw-bold">Jabatan </h3>
            <h5>{{ $s -> jabatan !== null ? $s -> jabatan : "Tidak Ada"}}</h5>
          </div>
        </div>
        @if ($s->role == 'pemohon')
        <div class="col-md-12 row">
            <h3 class="fw-bold">Kategori </h3>
            <h5>{{ $s -> kategori !== null ? $s -> kategori : "Tidak Ada"}}</h5>
        </div>
        @endif
      </div>
      
      
    @endforeach
  </div>

 <div class="col-md-12 d-flex justify-content-end mt-3 ">
    <a href="/kelola-akun">
    <btn class="btn btn-dark">KEMBALI</btn>
    </a>
            
  </div>

</div>
@endsection

