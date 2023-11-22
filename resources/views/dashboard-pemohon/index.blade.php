@extends('layout.layout')
@section('dashboard-pemohon', 'active')
@section('title', 'Dashboard')
@section('content')
    <div>
        <a style="font-weight: bold; font-size:24px">Halo, Selamat Datang di One Finance Planning App sebagai Pengajuan!
        </a><br>
        <a style="font-size:20px">Disini anda dapat mengelola kebutuhan, melihat data realisasi dan mencetak
            dokumen.</a><br><br>

        <a style="font-weight: bold; font-size:24px">List Pengajuan Kebutuhan</a>
        <div class="col-md-12" style=" margin-bottom:3vh">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Pemohon</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                    <th>Tujuan</th>
                                </tr>
                            </thead>
                            @foreach ($pengajuan_kebutuhan as $p)
                                <tbody>
                                    <tr>
                                        <td>{{ $p->id_pemohon }}</td>
                                        <td>{{ $p->nama_kegiatan }}</td>
                                        <td>{{ $p->status }}</td>
                                        <td>{{ $p->waktu }}</td>
                                        <td>{{ $p->tujuan }}</td>
                                        {{-- <td>
                                            @if ($p->file)
                                                <img src="{{ url('foto') . '/' . $p->file }} "
                                                    style="max-width: 250px; height: auto;" />
                                            @endif
                                        </td> --}}
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 " style="justify-content:start">
            <a href="/dashboard-pemohon/pengajuan-kebutuhan">
                <button type="submit" class="btn" style="width:100%; background-Color:#588157; color:#fff">
                    Lihat Halaman Pengajuan Kebutuhan
                </button>
            </a>
        </div>

        <a style="font-weight: bold; font-size:24px;">List Realisasi</a>
        <div class="col-md-12" style=" margin-bottom:3vh">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Waktu</th>
                                    <th>Total Dana</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 " style="justify-content:start">
            <button type="submit" class="btn" style="width:100%; background-Color:#588157; color:#fff">
                Lihat Halaman Realisasi
            </button>
        </div>
    </div>
@endsection