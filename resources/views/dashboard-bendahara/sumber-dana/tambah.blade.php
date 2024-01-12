<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data</title>
</head>
<body>
<script>
  function reset() {
    document.getElementById('nama_sumber').value = '';
  }
</script>
<div class="modal fade" id="tambahSumberDana" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog w-75 modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-4 pt-2 fw-bold m-auto" id="tambahSumberDanaLabel">Tambah Data Sumber Dana</h1>
        </div>
        <div class="modal-body">
        <form method="POST" action="/dashboard-bendahara/sumber-dana/simpan" enctype="multipart/form-data" >
          <div class="row">
              <div class="col-md-8">
                  <div class="form-group mx-2">
                      <label>Nama Sumber Dana</label>
                      <input type="text" class="form-control mb-3" id='nama_sumber' name="nama_sumber" required />
                  </div>
                            
                  @csrf
      </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onClick='reset()' data-bs-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary">Tambah Data</button>
      </form>
        </div>
      </div>
    </div>
  </div>

</body>  
</html>
