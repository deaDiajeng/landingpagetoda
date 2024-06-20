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
        $guruTitle = $_POST['guruTitle'];
        $guruJbt = $_POST['guruJbt'];

        // Mengunggah gambar
        $targetDir = "../../assets/img/guru/";
        $targetFile = $targetDir . basename($_FILES["guruImage"]["name"]);
        $uploadOk = 1;

        // Simpan hanya nama file
        $gambar = basename($_FILES["guruImage"]["name"]);

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["guruImage"]["size"] > 5000000) { // 5MB max
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
            if (move_uploaded_file($_FILES["guruImage"]["tmp_name"], $targetFile)) {
                // Gambar berhasil diunggah, simpan data ke database
                $sql = "INSERT INTO guru (nama, foto, jabatan) VALUES (:nama, :foto, :jabatan)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nama', $guruTitle);
                $stmt->bindParam(':foto', $gambar);
                $stmt->bindParam(':jabatan', $guruJbt);

                if ($stmt->execute()) {
                    echo "<script>alert('New record created successfully');</script>";
                    echo "<script>window.location.href = '../../guruds.php';</script>";
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
