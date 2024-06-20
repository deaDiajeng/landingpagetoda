<?php
require_once 'koneksi.php';
include 'content/header-ds.php';
// Include modal tambah galeri
include 'action/gallery/addModal.php';
// Include modal edit galeri
include 'action/gallery/editModal.php';
?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800">Galeri</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addGalleryModal">Tambah Galeri</button>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <!-- Sample Gallery Content -->
                    <div class="col-lg-12 mb-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <!-- <th>ID_pic</th> -->
                                    <th>Kegiatan</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                // Database connection parameters
                                $host = 'localhost';
                                $db = 'landingpage';
                                $user = 'root';
                                $pass = '';

                                // Data Source Name
                                $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";  // Added charset for proper encoding
                                // PDO options
                                $options = [
                                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                    PDO::ATTR_EMULATE_PREPARES   => false,
                                ];

                                try {
                                    // Create PDO instance
                                    $pdo = new PDO($dsn, $user, $pass, $options);
                                } catch (\PDOException $e) {
                                    // Handle connection error
                                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                                }

                                // SQL query to fetch data from galeri table
                                $sql = 'SELECT id_pic, kegiatan, gambar FROM galeri';
                                $stmt = $pdo->query($sql);

                                // Loop through the results and output table rows
                                while ($row = $stmt->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['kegiatan']) . '</td>';
                                    echo '<td><img src="assets/img/gallery/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['kegiatan']) . '" style="width: 100px; height: auto;"></td>';
                                    echo '<td>';
                                    echo '<a href="#" class="btn btn-secondary btn-sm edit-gallery" data-id="' . htmlspecialchars($row['id_pic']) . '">Edit</a> ';
                                    echo '<a href="action/delete.php?id=' . htmlspecialchars($row['id_pic']) . '&type=galeri" class="btn btn-danger btn-sm">Hapus</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>

                                <?php
                                $message = '';
                                if (isset($_GET['message']) && $_GET['message'] == 'deleted') {
                                    $message = '<div class="alert alert-success">Berhasil menghapus Gallery.</div>';
                                } elseif (isset($_GET['message']) && $_GET['message'] == 'edited') {
                                    $message = '<div class="alert alert-success">Berhasil mengedit Gallery.</div>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
            <!-- End of Main Content -->
    </div>
            <!-- End of Content Wrapper -->
</div>
            <!-- End of Page Wrapper -->

    <script>
document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.edit-gallery');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');

            // Fetch data galeri yang akan diedit
            fetch('action/gallery/editAction.php?id=' + id)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('editGalleryTitle').value = data.kegiatan;
                    document.getElementById('editGalleryId').value = data.id_pic;
                    document.getElementById('currentImage').innerHTML = 'Gambar saat ini: <img src="assets/img/gallery/' + data.gambar + '" style="width: 100px; height: auto;">';
                    $('#editGalleryModal').modal('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengambil data galeri untuk diedit. Silakan coba lagi.');
                });
        });
    });
});

    </script>
    <?php 
    include 'content/footer-ds.php';
    ?>

</body>

</html>
