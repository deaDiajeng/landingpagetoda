<?php
require_once 'koneksi.php';
include 'content/header-ds.php';
// Include modal tambah 
include 'action/pelajaran/addModal.php';
// Include modal edit 
include 'action/pelajaran/editModal.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Pelajaran</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addPelModal">Tambah Pelajaran</button>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Sample Gallery Content -->
        <div class="col-lg-12 mb-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kegiatan</th>
                            <th>Img</th>
                            <th>Keterangan</th>
                            <th>Act</th>
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
                        $dsn = "mysql:host=$host;dbname=$db";
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
                            die('Database connection failed: ' . $e->getMessage());
                        }

                        // SQL query to fetch data
                        $sql = 'SELECT id_pel, judul, gambar, ket FROM pelajaran';

                        try {
                            // Execute the query
                            $stmt = $pdo->query($sql);

                            // Loop through the results and output table rows
                            while ($row = $stmt->fetch()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['judul']) . '</td>';
                                echo '<td><img src="assets/img/alur/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['judul']) . '" style="width: 100px; height: auto;"></td>';
                                echo '<td>' . htmlspecialchars($row['ket']) . '</td>';
                                echo '<td>';
                                echo '<a href="#" class="btn btn-secondary btn-sm edit-pel" data-id="' . htmlspecialchars($row['id_pel']) . '">Edit</a>';
                                echo '<a href="action/delete.php?id=' . htmlspecialchars($row['id_pel']) . '&type=pelajaran" class="btn btn-danger btn-sm">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } catch (\PDOException $e) {
                            // Handle SQL query error
                            die('SQL query failed: ' . $e->getMessage());
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
    var editButtons = document.querySelectorAll('.edit-pel');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');

            // Fetch data pelajaran yang akan diedit
            fetch('action/pelajaran/editAction.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('editPelTitle').value = data.judul || '';
                        document.getElementById('editPelId').value = data.id_pel || '';
                        document.getElementById('currentImage').innerHTML = 'Gambar saat ini: <img src="assets/img/alur/' + data.gambar + '" style="width: 100px; height: auto;">';
                        document.getElementById('editPelKet').value = data.ket || '';
                        $('#editPelModal').modal('show');
                    } else {
                        console.error('Data not found:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});
</script>

<?php
include 'content/footer-ds.php';
?>

</body>

</html>