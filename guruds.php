<?php
require_once 'koneksi.php';
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
                    <h1 class="h3 mb-4 text-gray-800">Sensei</h1>
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
                                        echo '<td><img src="assets/img/' . htmlspecialchars($row['foto']) . '" alt="' . htmlspecialchars($row['nama']) . '" style="width: 100px; height: auto;"></td>';
                                        echo '<td>' . htmlspecialchars($row['jabatan']) . '</td>';
                                        echo '<td>';
                                        echo '<a href="add.php?id=' . htmlspecialchars($row['id_teach']) . '" class="btn btn-primary btn-sm">Add</a> ';
                                        echo '<a href="edit.php?id=' . htmlspecialchars($row['id_teach']) . '" class="btn btn-secondary btn-sm">Edit</a> ';
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>
