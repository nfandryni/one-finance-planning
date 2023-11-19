<div class="modal fade" id="editGedung" tabindex="-1" aria-labelledby="editGedungLabel" aria-hidden="true">
  <div class="modal-dialog w-75 modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4 pt-2 fw-bold" id="editGedungLabel">Edit Data Gedung</h1>
      </div>
      <div class="modal-body">
      <form method="POST" action="/dashboard-bendahara/gedung/edit/simpan/{{$gedung->id_gedung}}" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-md-8">
            <input type="hidden" name="id_gedung" value="{{ $gedung->id_gedung }}" />
                                <div class="form-group">
                                    <label>Nama Gedung</label>
                                    <input type="text" class="form-control" name="nama_gedung"
                                        value="{{ $gedung->nama_gedung }}" />
                                </div>
                                <div class="form-group">
                                    <label>Nama Ruangan</label>
                                    <input type="text" class="form-control" name="nama_ruangan"
                                        value="{{ $gedung->nama_ruangan }}" />
                                </div>
                                @csrf
        </div>
         </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
    </div>
    </div>
</div>
</div>]
                                  
                            