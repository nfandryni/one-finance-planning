@extends('layout.layout')
@section('title', 'Dashboard ')
@section('dashboard', 'active')
@section('content')
<div style='margin-left:15px;margin-right:15px;'>
    <h2><b>Selamat Datang, {{Auth::user()->username}}!</b></h2>
    <h5>Di tempat Anda akan mengelola Dana Pemasukan, Dana Pengeluaran, Data Master, Perencanaan Keuangan, Realisasi, dan Pengajuan Kebutuhan secara transparan.</h5>
</div>
    <div class='row m-3'>
@foreach($sumber_dana as $s)
<div class="col-md-{{ 12 / count($sumber_dana) }}">
            <div class="card" style="width: 100%;">
                <div class="card-body rounded-5">
                <h2 class='text-center mt-4 text-danger fw-bold'>
                Rp. {{ $totalpSumberDana[$s->nama_sumber] }}
                </h2>
                <p class='text-center h-20'>Dana {{$s->nama_sumber}}</p>
                </div>
             </div>
</div>
@endforeach
</div>
<div class='row gap-4 m-3'>
<div class="col-md-12">
<div class="card">
    <div class="card-body rounded-5">
        <h2 class='text-danger mt-4 text-center fw-bold'>Rp. {{ $jumlahDana ?? 0 }}</h2>
        <p class='text-center h-20'>Total Dana Anggaran </p>
    </div>
</div>
</div> 
   
<div class='row'>
    <p>Lihat di <a href='/dashboard-bendahara/pemasukan'>Dana Pemasukan</a><br/>
    Hanya menampilkan 10 Data Terawal</p>
    <table class="table table-borderless table-striped DataTable">
        <thead> 
            <tr>
                <th>Sumber Dana</th>
                <th>Nama Pemasukan</th>
                <th>Nominal (Rupiah)</th>
                <th>Penanggung Jawab</th>
                <th>Waktu</th>
            </tr>
        </thead>
                <tbody>
                    @foreach ($pemasukan as $s)
                    <tr>
                        <td>{{ $s->nama_sumber }}</td>
                        <td>{{ $s->nama_pemasukan }}</td>
                        <td>{{ $s->nominal }}</td>
                        <td>{{ $s->penanggung_jawab }}</td>
                        <td>{{ $s->waktu }}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>  
        @endsection
       
@section('footer')
        <script type='module'>
        $(document).ready(function() {
        $('.DataTable').DataTable({
            searching: false,
            paging: false,   
            lengthChange: false
        });
    });
</script>
@endsection

