<div class="modal fade" id="addGuruModal" tabindex="-1" aria-labelledby="addGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGuruModalLabel">Add Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action/guru/addAction.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="guruTitle">Nama</label>
                        <input type="text" class="form-control" id="guruTitle" name="guruTitle" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="guruImage">Gambar</label>
                        <input type="file" class="form-control-file" id="guruImage" name="guruImage">
                    </div>
                    <div class="form-group">
                        <label for="guruJbt">Jabatan</label>
                        <input type="text" class="form-control" id="guruJbt" name="guruJbt" placeholder="">
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
