<?php
session_start();

include 'includes/connx.php';
include 'includes/error.php';

if (isset($_GET['username'])) {    
    $user = $_GET['username'];
} 

//when session is active, display nav_admin, otherwise if user's not logged in, displaying standard nav and username will not get passed to events page
if (isset($user)) {
    include 'components/nav_admin.php';

    $message = '<a href="events.php?username=' . $user . '" class="btn btn-primary">More details</a>';
} else {
    include 'components/nav.php';

    $message = '<a href="events.php" class="btn btn-primary">More details</a>';
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
    
    <!-- HERE maps -->
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

    <!-- Adobe fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/upe5omf.css">

    <!-- custom CSS -->
    <link href="css/styles.css" rel="stylesheet">

    <title>National Museum of Scotland</title>
    
</head>

<body>
    <section id="header">
        <header>
            <!-- This div is  intentionally blank. It creates the transparent black overlay over the image which is modified in the CSS -->
            <div class="overlay"></div>

            <!-- header image -->
            <img src="./img/museum-main-lg-cropped.jpg" alt="museum roof">

            <!-- The header content -->
            <div class="container mt-5">
                <div class="container pt-5">
                    <p class="text-secondary text-uppercase mb-3">It's easy to begin</p>
                    <h1 class="fw-bold  mb-3">Your journey with us starts now</h1>
                    <p class="lead text-secondary mb-3">Become a member today</p>
                    <a href="./signup.php" class="btn btn-primary">Sign up</a>
                </div>
            </div>
        </header>
    </section>

    <section id="CTA">
        <div class="container py-5">
            <div class="container text-center pt-3 pb-5 cta-container shadow-lg p-3 mb-5 bg-body rounded">
                <img src="./img/avatar.png" class="avatar" alt="">
                <h2 class="fw-bold py-3">Log in to your account to view and manage your bookings</h2>
                <a href="login.php" class="btn btn-primary">Log in</a>
            </div>
        </div>
    </section>

    <section id="events" class="bg-grey">
        <div class="container text-center pt-5">
            <h2 class="fw-bold">Take a look at some of our ongoing exhibitions, events, and activities.</h2>
        </div>

        <div class="container-fluid py-5 mb-35456">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row g-2">
                    <?php

                    /* select all events*/
                    $sql = "SELECT * FROM events";
                    $result = $conn->query($sql);

                    //if maches in the database
                    if ($result->num_rows > 0) {

                        /* display events in card grid */
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-sm-1 col-lg-4 col-xl-4">';
                            echo '<div class="card h-100 shadow-lg mb-5 rounded">';
                            echo '<img src="' . $row["image"] . '" class="card-img-top" alt="event image">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title fw-bold">' . $row['eventName']  . '</h5>';
                            echo '<p class="text-secondary">' . $row['eventPlace'] . '</p>';
                            echo '<p class="text-secondary">' . $row['eventTime'] . '</p>';
                            echo '<p class="text-secondary">' . $row['eventDuration'] . '</p>';
                            echo '<p class="text-secondary">' . $row['shortDescription'] . '</p>';
                            echo '</div>';
                            echo '<div class="mt-auto text-start pb-3 ms-3">';
                            echo $message;
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        /* if events are not coming through from db */
                        echo "<p class='mb-5 text-center'>There's no events running as of now.</p>";
                    }

                    ?>
                    </div>
                </div>  
            </div>          
        </div>          
    </section>

    <section id="visit">
        <div class="container text-center py-5">
            <h2 class="fw-bold">Plan your visit</h2>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1 col-md-6 col-lg-6">
                    <div class="container">
                        <h2 class="fw-bold pb-2">National Museum of Scotland</h2>
                        <h5 class="text-secondary pb-1"><i class="bi bi-geo-alt-fill"></i> Chambers Street, Edinburgh EH1 1JF</h5>
                        <h5 class="text-secondary pb-5"><i class="bi bi-telephone-fill"></i> 0300 123 6789</h5>
                        <h4 class="fw-bold">Admission</h4>
                        <h5 class="text-secondary pb-5"><i class="bi bi-ticket-perforated-fill"></i> Free entry</h5>
                        <h4 class="fw-bold">Opening times</h4>
                        <h5 class="text-secondary pb-5"><i class="bi bi-clock-fill"></i> Open daily, 10:00 - 17:00</h5>
                    </div>
                </div>
                <div class=" col-sm-1 col-md-6 col-lg-6 d-sm-none">
                    <div style="width: 100%; height: 100%" id="mapContainer"></div>
                </div>
            </div>
        </div>

        <!-- Here maps JS -->
        <!-- Removed the code for the map cause it contained the API key for it's connection -->
    </body>
    </section>

    <section id="donations" class="bg-grey">
            <div class="container text-center py-5">
                <h2 class="fw-bold">Make a donation</h2>
            </div>
            <div class="container-fluid pb-5">
                <div class="row g-2">
                    <div class="col-sm-1 col-md-4 col-lg-4 offset-lg-2">
                        <div class="card shadow-lg mb-5 rounded">
                        <img src="./img/cards/donate.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Donate online</h5>
                            <p class="card-text text-secondary pb-5">Donate now to help us protect our collections and tell their stories. Every donation counts no matter how great or small.</p>
                            <a href="#" class="btn btn-primary mt-auto">Donate now</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-4 col-lg-4">
                        <div class="card shadow-lg mb-3 rounded">
                        <img src="./img/cards/david.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Donate an object</h5>
                            <p class="card-text text-secondary pb-5">Thinking of donating an item to the collection? Get in touch and tell us more about what you'd like to offer.</p>
                            <a href="contact.php" class="btn btn-outline-primary mtauto">Make an offer</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- footer -->
    <?php
    include 'components/footer.php';
    ?>

</body>

</html>