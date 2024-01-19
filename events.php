<?php 
session_start();

include('includes/connx.php');

if (isset($_GET['username'])) {
    $user = $_GET['username'];
}

//if session is active, display navbar with admin links and carry the username to booking page, if not display standard nav, and redirect to signup.
if (isset($user)) {
    include 'components/nav_admin.php';

    $message = '<a href="booking.php?username=' . $user . '" class="btn btn-primary">Book</a>';
} else {
    include 'components/nav.php';

    $message = '<a href="signup.php" class="btn btn-primary">Book</a>';
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

<body>
    <div class="container text-center pt-3">
        <h1 class="fw-bold">Our events in more detail</h1>
    </div>
        <div class="container-fluid mt-3 py-3">
            <div class="row">  
                <!-- looping through various columns of the db table pulling out detailed information on events and displaying them in two columns -->
                <?php
                
                $sql = "SELECT * FROM events";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-xs-4 col-md-6 col-lg-5 col-xl-5 offset-lg-1 offset-xl-1 py-4">';
                        echo '<div class="container mb-4">';
                        echo '<img src="' . $row["image"] . '" alt="event image" class="img-fluid">';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-xs-4 col-md-6 col-lg-5 col-xl-5">';
                        echo '<div class="container">';
                        echo '<h3 class="fw-bold mb-3">' . $row['eventName'] . '</h3>';
                        echo '<h6 class="fw-bold text-secondary mb-3">' . $row['description'] . ' </h6>';
                        echo '<h6 class="fw-bold text-secondary"><i class="bi bi-geo-alt-fill"></i> ' . $row['eventPlace'] . '</h6>';
                        echo '<h6 class="fw-bold text-secondary"><i class="bi bi-calendar-event-fill"></i> ' . $row['eventTime'] . '</h6>';
                        echo '<h6 class="fw-bold text-secondary"><i class="bi bi-clock-fill"></i> ' . $row['eventDuration'] . '</h6>';
                        echo '<h6 class="fw-bold text-secondary mb-3"><i class="bi bi-ticket-perforated-fill"></i> Free entry</h6>';
                        echo $message ;
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-xs-4 col-md-6 col-lg-6 offset-lg-3">';
                    echo '<div class="container">';
                    echo '<h2 class="fw-bold">No events to display.</h2>';
                    echo '</div>';
                    echo '</div>';
                }

                ?>
            </div>
        </div>

    <!-- footer -->
    <?php
    include 'components/footer.php';
    ?>
</body>

</html>