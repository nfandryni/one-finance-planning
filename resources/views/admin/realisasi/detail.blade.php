@extends('layout.layout')
@section('realisasi', 'active')
@section('title', 'Detail Realisasi')
@section('content')

<div style='margin-left:15px; margin-right:15px;'>
            <div class="row justify-content-md-center" style="align-items: center">
            <br/>
           <a class='text-black mt-2' href='/realisasi'><i class="fa-solid fa-arrow-left fa-xl "></i></a> 
            </div>
            <div>
    <div class="row justify-content-md-end" style="align-items: center">

            <a target='_blank' href="{{ url('/realisasi/print-item/'. $realisasi->id_realisasi ) }}" style='position:absolute; width:130px; right:40px; top:110px;' class='btn btn-warning'>
    <i class="fa-solid fa-print fa-lg"></i> Cetak Data 
        </a>
</div>
                <br />
                <h3 class='fw-bold mb-3'>Detail Realisasi</h3>
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Nama Realisasi</label>
                    </div>
                    <div class="col-md-6">
                        : {{ $realisasi->judul_realisasi }}
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Tujuan</label>
                    </div>
                    <div class="col-md-9">
                        : {{ $realisasi->tujuan }}
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Waktu</label>
                    </div>
                    <div class="col-md-3">
                        : {{ $realisasi->waktu }}
                    </div>
                </div>
                @if(isset($realisasi->total_pembayaran))
                <div class='row mb-2'>
                    <div class="col-md-3">
                        <label class='fw-bold'>Total Pembayaran</label>
                    </div>
                    <div class="col-md-3">
                        : {{ $realisasi->total_pembayaran }}
                    </div>
                </div>
                @endif
            </div>
            <hr />
            <div>
            <h4 class='fw-bold mb-3'>Item Realisasi</h4> 
            <table class="table table-hover table-borderless table-striped DataTable">
                        <thead>
                            <tr>
                            <th>Ruangan</th>
                                <th>Item</th>
                                <th>QTY</th>
                                <th>Harga Satuan</th>
                                <th>Satuan</th>
                                <th>Spesifikasi</th>
                                <th>Pengeluaran</th>
                                <th>Status</th>
                                <th>Foto Perencanaan</th>
                                <th>Foto Realisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item_perencanaan as $p)
                            @if($p->status == 'Terbeli')
                            <tr>
                                <td>{{ $p->nama_ruangan }}</td>
                                <td>{{ $p->item_perencanaan }}</td>
                                <td>{{ $p->qty }}</td>
                                <td>{{ $p->harga_satuan }}</td>
                                <td>{{ $p->satuan }}</td>
                                <td>{{ $p->spesifikasi }}</td>
                                <td><a href='/pengeluaran/detail/{{$p->id_pengeluaran}}'>{{ $p->nama }}</a></td>
                                    <td>{{ $p->status }}</td>
                                    <td>
                                        @if ($p->foto_barang_perencanaan)
                                            <img src="{{ url('foto') . '/' . $p->foto_barang_perencanaan }} "
                                                style="max-width: 150px; height: auto;" />
                                        @endif
                                    </td>
                                    <td>
                                        @if ($p->foto_realisasi)
                                            <img src="{{ url('foto') . '/' . $p->foto_realisasi }} "
                                                style="max-width: 150px; height: auto;" />
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                        </tbody>
                    </table>
            </div>
    </div>

@endsection
