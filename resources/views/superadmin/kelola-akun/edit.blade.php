@extends('layout.layout')
@section('akun', 'active')
@section('title', 'Edit Profile Akun  ')
@section('content')
<div class="row">
  <div class="row">
    <h1 class="fs-2 fw-bold mt-3">Edit Profile Akun </h1>
  </div>

  <form method="POST" action="simpan" enctype="multipart/form-data">
    <div class="col-md-12 d-flex align-items-center">
     @foreach ($data as $data)
      <div class="col-md-4">
        <label >
          <img src="{{ $data->foto_profil !== null ? url('foto/' . $data->foto_profil) : url('foto/pfp.jpg') }}" id="output"  class="shadow-sm bg-white rounded-circle " style="width:260;height:260;" />
            <input type="file"  onchange="loadFile(event)" accept="image/*" class="form-control rounded-circle"  name='foto_profil' style="display: none">
        </label>
      </div>
      <div class="col-md-8">
        <div class="form-group ">
          <input type="text" placeholder="Masukkan Nama" class="form-control" name="nama" value="{{ $data->nama }}" />
          <input type="hidden" placeholder="Masukkan Nama" class="form-control" name="user_id" value="{{ $data->user_id }}" />
        </div>
        <div class="form-group mt-3 ">
          <select class="form-select" name="role" disabled >
            <option selected hidden >Role</option>
            <option {{ $data->role == 'superadmin' ? 'selected' : '' }}  value="superadmin"> Super Admin</option>
            <option {{ $data->role == 'admin' ? 'selected' : '' }}  value="admin">Admin </option>
            <option {{ $data->role == 'bendaharasekolah' ? 'selected' : '' }}   value="bendaharasekolah">Bendahara Sekolah </option>
            <option {{ $data->role == 'pemohon' ? 'selected' : '' }}  value="pemohon">Pemohon</option>
          </select>
          <input type="hidden" class="form-control" name="role" value="{{ $data->role }}" />
        </div>
        <div class="form-group mt-3 ">
          <input type="email" placeholder="Masukkan email" class="form-control" name="email" value="{{ $data->email }}" />
        </div>
        <div class="form-group mt-3 ">
          <input type="text" placeholder="Masukkan Jabatan" class="form-control" name="jabatan" value="{{ $data->jabatan }}" />
        </div>

        @if ($data->role == 'pemohon')
          <div class="form-group mt-3 ">
            <select class="form-select" name="kategori">
              <option selected hidden>Kategori</option>
              <option {{ $data->kategori == 'WAKA' ? 'selected' : '' }} value="WAKA"> WAKA</option>
              <option {{ $data->kategori == 'Kaprog' ? 'selected' : '' }} value="Kaprog">  Kepala Pemrograman</option>
              <option {{ $data->kategori == 'BK' ? 'selected' : '' }} value="BK">BK </option>
              <option {{ $data->kategori == 'Perpustakaan' ? 'selected' : '' }}  value="Perpustakaan">Perpustakaan</option>
            </select>
            @csrf
          </div>
        @endif

          @if ($data->role == 'superadmin')
        <input type="hidden" name="id_superadmin" value="{{ $data->id_superadmin }}">
        @elseif ($data->role == 'admin')
          <input type="hidden" name="id_admin" value="{{ $data->id_admin }}">
        @elseif ($data->role == 'bendaharasekolah')
          <input type="hidden" name="id_bendahara" value="{{ $data->id_bendahara }}">
        @elseif ($data->role == 'pemohon')
          <input type="hidden" name="id_pemohon" value="{{ $data->id_pemohon }}">
        @endif
      </div>
    @endforeach
    </div>
        <div class="row">
          <div class="col-md-12 d-flex justify-content-end mt-3 ">
            <a href="/kelola-akun">
              <btn class="btn btn-dark">KEMBALI</btn>
            </a>
            <button type="submit" class="btn btn-success ms-3">SIMPAN</button>
          </div><p> @csrf
        </div>
  </form>
</div>
@endsection

@section('footer')
  <script>
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
    URL.revokeObjectURL(output.src) // free memory
    }
    };
  </script>
@endsection