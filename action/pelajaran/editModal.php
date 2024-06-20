<div class="modal fade" id="editPelModal" tabindex="-1" role="dialog" aria-labelledby="editPelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPelModalLabel">Edit Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form edit pelajaran -->
                <form id="editPelForm" action="action/pelajaran/editAction.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="editPelTitle">Judul</label>
                        <input type="text" class="form-control" id="editPelTitle" name="pelTitle" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <label for="editPelImage">Gambar</label>
                        <input type="file" class="form-control-file" id="editPelImage" name="pelImage">
                        <small id="currentImage" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="editPelKet">Keterangan</label>
                        <input type="text" class="form-control" id="editPelKet" name="pelKet" placeholder="Keterangan">
                    </div>
                    <input type="hidden" name="pelId" id="editPelId">
                
                    <!-- Move the button inside the form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editPelBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
