<div class="modal fade" id="tambahAkun" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center align-items-center">
                <h5 class="modal-title fw-bold " style="font-size:28" id="staticBackdropLabel">
                    Tambah Akun</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="kelola-akun/simpan" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" required class="form-control" placeholder="Masukkan Username..."
                                name="username" />
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" required placeholder="Masukkan Password..." class="form-control"
                                name="password" />
                        </div>
                        <div class="form-group mt-3">
                            <select required class="form-select" name="role">
                                <option selected value='' hidden>Role</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="bendaharasekolah">Bendahara Sekolah </option>
                                <option value="pemohon">Pemohon</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                @csrf
            </div>
            </form>
        </div>
    </div>
</div>
