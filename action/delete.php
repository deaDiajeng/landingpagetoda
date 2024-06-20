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

// Check if the ID and type are provided
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = (int)$_GET['id'];
    $type = $_GET['type'];
    
    // Determine the appropriate delete query and image path based on the type
    if ($type === 'galeri') {
        $stmt = $pdo->prepare('SELECT gambar FROM galeri WHERE id_pic = :id');
        $imagePathPrefix = '../assets/img/gallery/';
        $sql = 'DELETE FROM galeri WHERE id_pic = :id';
        $redirectLocation = '../galerids.php';
    } elseif ($type === 'guru') {
        $stmt = $pdo->prepare('SELECT foto FROM guru WHERE id_teach = :id');
        $imagePathPrefix = '../assets/img/guru/';
        $sql = 'DELETE FROM guru WHERE id_teach = :id';
        $redirectLocation = '../guruds.php';
    } elseif ($type === 'pelajaran') {
        $stmt = $pdo->prepare('SELECT gambar FROM pelajaran WHERE id_pel = :id');
        $imagePathPrefix = '../assets/img/alur/';
        $sql = 'DELETE FROM pelajaran WHERE id_pel = :id';
        $redirectLocation = '../pelajarands.php';
    } else {
        echo 'Invalid type provided.';
        exit;
    }

    // Get the image path before deleting the record
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $imageData = $stmt->fetch();

    if ($imageData) {
        // Delete image file
        if ($type === 'guru') {
            $imagePath = $imagePathPrefix . $imageData['foto']; // Adjust the path for 'guru'
        } else {
            $imagePath = $imagePathPrefix . $imageData['gambar']; // Adjust the path for other types
        }
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the file from the directory
        }
    }

    // Prepare the delete query
    $stmt = $pdo->prepare($sql);

    // Bind the ID parameter
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the query
    if ($stmt->execute()) {
        // Success message or redirect
        header("Location: " . $redirectLocation);
        exit;
    } else {
        echo 'Failed to delete the record.';
    }
} else {
    echo 'ID or type not provided.';
}
?>
