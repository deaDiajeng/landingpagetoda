<?php
// Konfigurasi koneksi ke database menggunakan PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "landingpage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Atur mode error untuk PDO agar lemparkan pengecualian pada kesalahan
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $galleryTitle = $_POST['galleryTitle'];

        // Mengunggah gambar
        $targetDir = "../../assets/img/gallery/";
        $targetFile = $targetDir . basename($_FILES["galleryImage"]["name"]);
        $uploadOk = 1;

        // Simpan hanya nama file
        $gambar = basename($_FILES["galleryImage"]["name"]);

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["galleryImage"]["size"] > 5000000) { // 5MB max
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Get file extension
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["galleryImage"]["tmp_name"], $targetFile)) {
                // Gambar berhasil diunggah, simpan data ke database
                $sql = "INSERT INTO galeri (kegiatan, gambar) VALUES (:kegiatan, :gambar)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kegiatan', $galleryTitle);
                $stmt->bindParam(':gambar', $gambar);

                if ($stmt->execute()) {
                    echo "<script>alert('New record created successfully');</script>";
                    echo "<script>window.location.href = '../../galerids.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;
?>
