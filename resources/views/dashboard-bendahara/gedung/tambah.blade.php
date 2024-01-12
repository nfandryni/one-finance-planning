<script>
  function reset() {
    document.getElementById('nama_gedung').value = '';
    document.getElementById('nama_ruangan').value = '';
  }
</script>
<div class="modal fade" id="tambahGedung" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog w-75 modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4 pt-2 fw-bold" id="tambahGedungLabel">Tambah Data Gedung</h1>
      </div>
      <div class="modal-body">
      <form method="POST" action="/dashboard-bendahara/gedung/tambah/simpan" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mx-2">
                    <label>Nama Gedung</label>
                    <input type="text" class="form-control" id='nama_gedung' name="nama_gedung" required />
                    
                </div>
                <div class="form-group mx-2">
                    <label>Nama Ruangan</label>
                    <input type="text" class="form-control" id='nama_ruangan' name="nama_ruangan" required/>
                </div>
                @csrf
        </div>
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