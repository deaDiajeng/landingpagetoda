<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "landingpage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle login request if there is one
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from form
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Query to check user credentials
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Bind the password parameter
        $stmt->execute();
        
        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // If credentials match, handle successful login (e.g., start a session)
            echo "Login successful. Welcome, " . htmlspecialchars($username) . "!";
            // Start a session or redirect to a different page, etc.
            session_start();
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit; // Terminate the script after redirect
        } else {
            // If credentials don't match, show an error message
            echo "Invalid username or password";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
