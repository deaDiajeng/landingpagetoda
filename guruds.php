<?php
require_once 'koneksi.php';
include 'content/header-ds.php';
// Include modal tambah galeri
include 'action/guru/addModal.php';
// Include modal edit galeri
include 'action/guru/editModal.php';
?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-gray-800">Guru</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addGuruModal">Tambah Guru</button>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <!-- Sample Gallery Content -->
                    <div class="col-lg-12 mb-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Img</th>
                                    <th>Jabatan</th>
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
                                    $pdo = new PDO($dsn, $user, $pass);
                                } catch (\PDOException $e) {
                                    // Handle connection error
                                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                                }

                                    // SQL query to fetch data
                                $sql = 'SELECT id_teach, nama, foto, jabatan FROM guru';

                                // Execute the query
                                $stmt = $pdo->query($sql);

                                // Loop through the results and output table rows
                                while ($row = $stmt->fetch()) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['nama']) . '</td>';
                                    echo '<td><img src="assets/img/guru/' . htmlspecialchars($row['foto']) . '" alt="' . htmlspecialchars($row['nama']) . '" style="width: 100px; height: auto;"></td>';
                                    echo '<td>' . htmlspecialchars($row['jabatan']) . '</td>';
                                    echo '<td>';
                                    echo '<a href="#" class="btn btn-secondary btn-sm edit-guru" data-id="' . htmlspecialchars($row['id_teach']) . '">Edit</a>';
                                    echo '<a href="action/delete.php?id=' . htmlspecialchars($row['id_teach']) . '&type=guru" class="btn btn-danger btn-sm">Delete</a>';
                                    echo '</td>';
                                    echo '</tr>';
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
    var editButtons = document.querySelectorAll('.edit-guru');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');

            // Fetch data guru yang akan diedit
            fetch('action/guru/editAction.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('editGuruTitle').value = data.nama || '';
                        document.getElementById('editGuruId').value = data.id_teach || '';
                        document.getElementById('currentImage').innerHTML = 'Gambar saat ini: <img src="assets/img/guru/' + data.foto + '" style="width: 100px; height: auto;">';
                        document.getElementById('editGuruJbt').value = data.jabatan || '';
                        $('#editGuruModal').modal('show');
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
