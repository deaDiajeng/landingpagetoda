<div class="modal fade" id="editGalleryModal" tabindex="-1" role="dialog" aria-labelledby="editGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGalleryModalLabel">Edit Galeri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form edit galeri -->
                <form id="editGalleryForm" action="action/gallery/editAction.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="editGalleryTitle">Kegiatan</label>
                        <input type="text" class="form-control" id="editGalleryTitle" name="galleryTitle" placeholder="Kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="editGalleryImage">Gambar</label>
                        <input type="file" class="form-control-file" id="editGalleryImage" name="galleryImage">
                        <small id="currentImage" class="form-text text-muted"></small>
                    </div>
                    <input type="hidden" name="galleryId" id="editGalleryId">
                
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editGalleryBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
