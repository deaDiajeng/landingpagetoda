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

        // SQL query to fetch data from guru table based on ID
        $sql = 'SELECT id_teach, nama, jabatan, foto FROM guru WHERE id_teach = :id';
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
    if (!empty($_POST['guruId']) && !empty($_POST['guruTitle']) && !empty($_POST['guruJbt'])) {
        // Create PDO instance
        $pdo = new PDO($dsn, $user, $pass, $options);

        // Fetch the current image path
        $stmt = $pdo->prepare('SELECT foto FROM guru WHERE id_teach = :id');
        $stmt->bindParam(':id', $_POST['guruId'], PDO::PARAM_INT);
        $stmt->execute();
        $currentImage = $stmt->fetchColumn();

        // Prepare update query
        $sql = "UPDATE guru SET nama = :nama, jabatan = :jabatan";

        // Check if image is uploaded
        if ($_FILES['guruImage']['error'] === UPLOAD_ERR_OK) {
            // Get the file path
            $uploadDir = '../../assets/img/guru/'; // Directory to store the uploaded image
            $imageFilename = basename($_FILES['guruImage']['name']);
            $imagePath = $uploadDir . $imageFilename;
            $imageDatabasePath = $imageFilename; // Path to store in the database

            // Move the uploaded file
            if (move_uploaded_file($_FILES['guruImage']['tmp_name'], $imagePath)) {
                // Add image path to update query
                $sql .= ", foto = :foto";

                // Delete the old image file
                if ($currentImage) {
                    $oldImagePath = $uploadDir . $currentImage;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                echo 'Failed to move the uploaded file.';
                exit;
            }
        }

        $sql .= " WHERE id_teach = :id";

        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $_POST['guruId'], PDO::PARAM_INT);
            $stmt->bindParam(':nama', $_POST['guruTitle'], PDO::PARAM_STR);
            $stmt->bindParam(':jabatan', $_POST['guruJbt'], PDO::PARAM_STR);

            // If image is uploaded, bind image path parameter
            if (isset($imageDatabasePath)) {
                $stmt->bindParam(':foto', $imageDatabasePath, PDO::PARAM_STR);
            }

            // Execute the statement
            if ($stmt->execute()) {
                // Success message or redirect
                echo '<script>alert("Berhasil mengedit Guru"); window.location.href = "../../guruds.php";</script>';
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
