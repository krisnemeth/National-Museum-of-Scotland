<?php session_start();


$single_booking = $_GET['id'];
$user = $_GET['username'];

include 'includes/connx.php';

$message = '<i class="bi bi-exclamation-triangle text-danger" style="font-size: 500%;"></i>
            <h5 class="text-secondary pt-3">This booking will be permanently canceled.</h5>';

/* when form is submited, performing checks for booking id, then selecting the booking, deleting it and redirecting user to admin page. */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    if (isset($single_booking) || !empty($single_booking)) {

        $sql = "DELETE FROM bookings WHERE booking_id = '$single_booking'";

        if ($conn->query($sql) === TRUE) {
            header("refresh: 3; url=admin.php?username=" . $user);
            $message = '<i class="bi bi-check-circle text-danger py-3" style="font-size: 500%;"></i>
                        <h5 class="text-secondary pt-3">Booking canceled!</h5>';
        } else {
            echo "Error deleting record: " . $conn->$error;
        }
    }
    $conn->close();
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

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 py-4 px-4 bg-grey">
                <div class="text-center">
                    <h1 class="py-3">Are you sure?</h1>

                    <div class="text-center">
                    <?php echo $message ?>
                    </div>

                    <h5 class="pb-4 form-text"></h5>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="submit" class="btn btn-danger w-100" id="submit" name="submit" value="Cancel">
                        </div>
                    </form>
                    <a href="admin.php?username=<?php echo $user ?>" class="btn btn-outline-danger w-100">Go back</a>
                </div>
                <div class="text-center">
                    
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