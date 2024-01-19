<?php 
session_start();

$user = $_GET['username'];

/* kills session on click */
if (isset($_POST['submit'])) {

    session_start();
    session_destroy();
    header('Location:index.php');
    die();
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

    <!-- navbar -->
    <?php
    include 'components/nav_admin.php';
    ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 py-4 px-4 bg-grey">
                <div class="text-center">
                    <div class="container">
                        <i class="bi bi-exclamation-triangle text-danger" style="font-size: 700%;"></i>
                    </div>

                    <!-- peronalized warning message -->
                    <h5 class="pb-2">Are you sure you want to log out <?php echo $user ?>?</h5>
                    <p class=" text-secondary pb-4">You won't be able to create or manage bookings until you log back in.</p>
                </div>

                <!-- giving the user options to continue logging out, or to return to the manage bookings page -->
                <div class="text-center">                  
                    <form action="index.php" method="POST">
                        <div class="mb-2">
                            <input type="submit" name="submit" id="submit" class="btn btn-danger w-100" value="Log out">
                        </div>
                    </form> 
                    <a href="admin.php?username=<?php echo $user ?>" class="btn btn-outline-danger w-100">Cancel</a>
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