<?php
require_once 'koneksi.php';
// Include modal tambah galeri
include 'action/gallery/addModal.php';
// Include modal edit galeri
include 'action/gallery/editModal.php';
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Galeri - Dashboard RQ</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin RQ</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                CMS
            </div>
            <!-- CMS Links -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="galerids.php" data-toggle="collapse" data-target="#collapseGaleri"
                    aria-expanded="true" aria-controls="collapseGaleri">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Galeri</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="guruds.php" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Guru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="pelajarands.php" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Pelajaran</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

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

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-gallery');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');

                    // Fetch data galeri yang akan diedit
                    fetch('action/gallery/editAction.php?id=' + id)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('editGalleryTitle').value = data.kegiatan;
                            document.getElementById('editGalleryId').value = data.id_pic;
                            document.getElementById('currentImage').innerHTML = 'Gambar saat ini: <img src="assets/img/gallery/' + data.gambar + '" style="width: 100px; height: auto;">';
                            $('#editGalleryModal').modal('show');
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

</body>

</html>
