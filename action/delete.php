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

    // Determine the appropriate delete query based on the type
    if ($type === 'galeri') {
        // Query to get the image path before deleting the record
        $stmt = $pdo->prepare('SELECT gambar FROM galeri WHERE id_pic = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $imageData = $stmt->fetch();

        if ($imageData) {
            // Delete image file
            $imagePath = '../assets/img/gallery/' . $imageData['gambar']; // Sesuaikan dengan path direktori gambar
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus file dari direktori
            }
        }

        // Delete gallery record
        $sql = 'DELETE FROM galeri WHERE id_pic = :id';
    } elseif ($type === 'guru') {
        $sql = 'DELETE FROM guru WHERE id_teach = :id';
    } elseif ($type === 'pelajaran') {
        $sql = 'DELETE FROM pelajaran WHERE id_pel = :id';
    } else {
        echo 'Invalid type provided.';
        exit;
    }

    // Prepare the delete query
    $stmt = $pdo->prepare($sql);

    // Bind the ID parameter
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the query
    if ($stmt->execute()) {
        // Success message or redirect
        header("Location: ../galerids.php?message=deleted");
        exit;
    } else {
        echo 'Failed to delete the record.';
    }
} else {
    echo 'ID or type not provided.';
}
?>
