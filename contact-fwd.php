<?php session_start();

if (isset($_GET['username'])) {
    $user = $_GET['username'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
     <!-- Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- Adobe fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/upe5omf.css">
    <!-- custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
    <title>National Museum of Scotland</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php

    include 'components/nav_admin.php';

    ?>

    <!-- contact form -->
    <div class="container-fluid">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 bg-grey py-4 px-4">
                    <div class="text-center">
                        <i class="bi bi-envelope-check text-success" style="font-size: 1000%;"></i>
                        <h1 class="pb-3">Thank you <?php echo $user?>!</h1>
                        <h5 class="text-secondary">Our team will get back to you as soon as possible.</h5>
                        <div class="container">
                            <a class="btn btn-primary mt-5 w-100" href="index.php?username=<?php echo $user ?>">Home</a>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- footer -->
    <?php
    include 'components/footer.php';
    ?>
</body>

</html>