@extends('layout.layout')
@section('akun', 'active')
@section('title', 'Daftar Surat')
@section('content')
    <div class="container" >
        <div class="col-md-12">
         	<div class="row">
          <h1 class="fs-2 fw-bold">Kelola Akun </h1>
        </div>
		
					<div class="col-md-12">
						<div class="row justify-content-md-center" style="align-items: center">
							<div class="col-sm">
							
							</div>
							<div class="col-sm">
								<div class="form-group">
								<label>Search</label>
								<input type="text" placeholder="Cari Akun..." class="form-control" name="alamat" />
						</div>
							</div>
							<div class="col-sm">
								<a href="cabang/tambah">
									<btn class="btn btn-success">Tambah Cabang</btn>
							</a></div>
							</div>
						</div>
						<div class="col-md-4">
							
						<div>
						</div>
							

		
        </div>
        

    </div>
@endsection

@section('footer')
<script type="module">
    $('.DataTable tbody').on('click','.btnHapus',function(a){
        a.preventDefault();
        let idCabang = $(this).closest('.btnHapus').attr('idCabang');
        //alert(id_cabang)
        swal.fire({
            title : "Apakah anda ingin menghapus data ini?",
            showCancelButton: true,
            confirmButtonText: 'Setuju',
            cancelButtonText: `Batal`,
            confirmButtonColor: 'red'

        }).then((result)=>{
            if(result.isConfirmed){
                //Ajax Delete
                $.ajax({
                    type: 'DELETE',
                    url: 'cabang/hapus',
                    data: {
                        id_cabang : idCabang,
                        _token : "{{csrf_token()}}"
                    },
                    success : function(data){
                        if(data.success){
                            swal.fire('Berhasil di hapus!', '', 'success').then(function(){
                                //Refresh Halaman
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        $('.DataTable').DataTable();
    });
</script>

@endsection