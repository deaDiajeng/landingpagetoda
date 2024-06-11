<div class="modal fade" id="addGalleryModal" tabindex="-1" aria-labelledby="addGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGalleryModalLabel">Add Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action/gallery/addAction.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="galleryTitle">Kegiatan</label>
                        <input type="text" class="form-control" id="galleryTitle" name="galleryTitle" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="galleryImage">Gambar</label>
                        <input type="file" class="form-control-file" id="galleryImage" name="galleryImage">
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
