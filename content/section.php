<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "landingpage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch data from galeri table
    $stmt = $conn->prepare("SELECT kegiatan, gambar FROM galeri");
    $stmt->execute();
    
    // Fetch all records
    $galeri = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<?php
include('isi_section/servis.php');
include('isi_section/galeri.php');
include('isi_section/pelajaran.php');
include('isi_section/guru.php');
?>




        


        