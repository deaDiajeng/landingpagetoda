<div class="modal fade" id="editGuruModal" tabindex="-1" role="dialog" aria-labelledby="editGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGuruModalLabel">Edit Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form edit guru -->
                <form id="editGuruForm" action="action/guru/editAction.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="editGuruTitle">Nama</label>
                        <input type="text" class="form-control" id="editGuruTitle" name="guruTitle" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="editGuruImage">Gambar</label>
                        <input type="file" class="form-control-file" id="editGuruImage" name="guruImage">
                        <small id="currentImage" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="editGuruJbt">Jabatan</label>
                        <input type="text" class="form-control" id="editGuruJbt" name="guruJbt" placeholder="Jabatan" required>
                    </div>
                    <input type="hidden" name="guruId" id="editGuruId">
                
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editGuruBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
