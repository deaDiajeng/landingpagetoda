<div class="modal fade" id="addPelModal" tabindex="-1" aria-labelledby="addPelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPelModalLabel">Add Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action/pelajaran/addAction.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="pelTitle">Kegiatan</label>
                        <input type="text" class="form-control" id="pelTitle" name="pelTitle" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="pelImage">Gambar</label>
                        <input type="file" class="form-control-file" id="pelImage" name="pelImage">
                    </div>
                    <div class="form-group">
                        <label for="pelKet">Keterangan</label>
                        <input type="text" class="form-control" id="pelKet" name="pelKet" placeholder="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
                </form>
        </div>
    </div>
</div>
