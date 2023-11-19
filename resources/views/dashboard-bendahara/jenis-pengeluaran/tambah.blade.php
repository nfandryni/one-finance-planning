<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data</title>
</head>
<body>
  
  <div class="modal fade" id="tambahJenisPengeluaran" tabindex="-1" aria-labelledby="tambahJenisPengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog w-75 modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-4 pt-2 fw-bold m-auto" id="tambahJenisPengeluaranLabel">Tambah Data Sumber Dana</h1>
        </div>
        <div class="modal-body">
        <form method="POST" action="/dashboard-bendahara/jenis-pengeluaran/simpan">
                        <div class="row">
                            <div class="col-md-5">
                                <div class='form-group'>
                                    <label>Jenis Pengeluaran</label>
                                    
                                    <input type="text" class="form-control" name="kategori"/>
                                </div>
                                    @csrf
                            </div>
                        </div>
                        <br/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
      </form>
        </div>
      </div>
    </div>
  </div>

</body>  
</html>
