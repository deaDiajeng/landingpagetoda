<?php
  $custom_css=filemtime("assets/css/styles.css");
  $custom_js=filemtime("assets/js/scripts.js");
?>
  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Rumah Quran Insan Toda</title>
        <link rel="icon" type="image/x-icon" href="assets/rq.png">

        <!-- Font Library -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Library -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Custom Style -->
        <link rel="stylesheet" href="assets/css/styles.css?v<?=$custom_css?>">

    </head>
    <body id="page-top">
        <?php
        include('content/navbar.php');
        include('content/header.php');
        include('content/section.php');
        include('content/footer.php');
        ?>
        <!-- Bootstrap n Jquery JS -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Other Script -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Custom Script -->
        <script src="assets/js/scripts.js?v<?=$custom_js?>"></script>
    </body>
</html>
