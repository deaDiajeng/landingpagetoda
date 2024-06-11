<?php
// Database connection parameters
$host = 'localhost';
$db = 'landingpage';
$user = 'root';
$pass = '';

// Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4"; // Added charset for proper encoding
// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Check if ID is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Create PDO instance
        $pdo = new PDO($dsn, $user, $pass, $options);

        // SQL query to fetch data from galeri table based on ID
        $sql = 'SELECT id_pic, kegiatan, gambar FROM galeri WHERE id_pic = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return data as JSON
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    } catch (PDOException $e) {
        // Handle connection error
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted
    if (!empty($_POST['galleryId']) && !empty($_POST['galleryTitle'])) {
        // Prepare update query
        $sql = "UPDATE galeri SET kegiatan = :kegiatan";

        // Check if image is uploaded
        if ($_FILES['galleryImage']['error'] === UPLOAD_ERR_OK) {
            // Get the file path
            $imagePath = 'assets/img/gallery/' . basename($_FILES['galleryImage']['name']);
            
            // Move the uploaded file
            move_uploaded_file($_FILES['galleryImage']['tmp_name'], $imagePath);

            // Add image path to update query
            $sql = "UPDATE galeri SET kegiatan = :kegiatan, gambar = :gambar";
        }

        $sql .= " WHERE id_pic = :id";

        try {
            // Create PDO instance
            $pdo = new PDO($dsn, $user, $pass, $options);

            // Prepare the SQL statement
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $_POST['galleryId'], PDO::PARAM_INT);
            $stmt->bindParam(':kegiatan', $_POST['galleryTitle'], PDO::PARAM_STR);

            // If image is uploaded, bind image path parameter
            if (isset($imagePath)) {
                $stmt->bindParam(':gambar', $imagePath, PDO::PARAM_STR);
            }

            // Execute the statement
            if ($stmt->execute()) {
                // Success message or redirect
                echo '<script>alert("Berhasil mengedit Gallery."); window.location.href = "../../galerids.php";</script>';
                exit;
            } else {
                echo 'Failed to edit the record.';
                exit;
            }
        } catch (PDOException $e) {
            // Handle connection error
            echo 'Error: ' . $e->getMessage();
            exit;
        }
    } else {
        echo 'Invalid data provided.';
        exit;
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}
?>
