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

        // SQL query to fetch data from pelajaran table based on ID
        $sql = 'SELECT id_pel, judul, ket, gambar FROM pelajaran WHERE id_pel = :id';
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
    if (!empty($_POST['pelId']) && !empty($_POST['pelTitle'])) {
        // Prepare update query
        $sql = "UPDATE pelajaran SET judul = :judul, ket = :ket";

        // Check if image is uploaded
        if ($_FILES['pelImage']['error'] === UPLOAD_ERR_OK) {
            // Get the file path
            $uploadDir = '../../assets/img/alur/'; // Make sure this directory exists and is writable
            $imageFilename = basename($_FILES['pelImage']['name']);
            $imagePath = $uploadDir . $imageFilename;

            // Move the uploaded file
            if (move_uploaded_file($_FILES['pelImage']['tmp_name'], $imagePath)) {
                // Add image filename to update query
                $sql .= ", gambar = :gambar";
            } else {
                echo 'Failed to move the uploaded file.';
                exit;
            }
        }

        $sql .= " WHERE id_pel = :id";

        try {
            // Create PDO instance
            $pdo = new PDO($dsn, $user, $pass, $options);

            // Prepare the SQL statement
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $_POST['pelId'], PDO::PARAM_INT);
            $stmt->bindParam(':judul', $_POST['pelTitle'], PDO::PARAM_STR);
            $stmt->bindParam(':ket', $_POST['pelKet'], PDO::PARAM_STR);

            // If image is uploaded, bind image filename parameter
            if (isset($imageFilename)) {
                $stmt->bindParam(':gambar', $imageFilename, PDO::PARAM_STR);
            }

            // Execute the statement
            if ($stmt->execute()) {
                // Success message or redirect
                echo '<script>alert("Berhasil mengedit Pelajaran"); window.location.href = "../../pelajarands.php";</script>';
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
