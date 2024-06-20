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

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);

    // SQL query to fetch data from guru table
    $sql = 'SELECT id_teach, nama, jabatan, foto FROM guru';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all results
    $guru = $stmt->fetchAll();
} catch (PDOException $e) {
    // Handle connection error
    echo 'Error: ' . $e->getMessage();
    exit;
}
?>
