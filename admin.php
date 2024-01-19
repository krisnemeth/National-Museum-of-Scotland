<?php 
session_start();

include('includes/connx.php');

//if the user's not logged in an tries to access the admin page, gets redirected to the login page, otherwise get the user from url
if (!isset($_GET['username'])) {
    header('Location:login.php');
} else {
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
    <link href="css/admin-styles.css" rel="stylesheet">
    <title>National Museum of Scotland</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    //no need for checking if user's logged in, since they only able to access the admin page if they are. Navbar with admin links is displayed
    include 'components/nav_admin.php';
    ?>

    <div class="container-fluid">
        <div class="container-fluid  pt-3">
            <div class="row pb-2">
                <div class="col-xs-6 col-sm-6 col-lg-8 offset-lg-1">
                    <div class="container pt-4">
                    <h1 class="fw-bold display-4">Welcome, <?php echo $user ?>!</h1>
                    </div>
                    <div class="container pt-2">
                    <h2 class="fw-bold text-secondary">Here, you can view, update, and cancel your bookings.</h2>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="container text-end pb-2">
                    <?php
                    // pulling out avatar from the db, if the user haven't uploaded any, default one is diplayed.
                    $sql = "SELECT * FROM profilePic WHERE user_id = (SELECT user_id FROM users WHERE username = '$user')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<img src="' . $row['image'] . '" class="avatar" alt="profile picture">';
                        }
                    } else {
                        echo '<img src="./img/profilePic/default.png" class="avatar" alt="">';
                    }
                    
                    ?>
                    </div>
                    <div class="container text-end btn-container">
                    <a href="upload.php?username=<?php echo $user ?>" class="btn btn-sm btn-outline-primary w-100">Change picture</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-sm-4 col-lg-10 offset-lg-1">
                    <div class="container-fluid">
                        <div class="line-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- connecting to the db, selecting the products uploaded by the user registered for this session, 
    and displaying them in a grid. If there are no products, displaying message. -->
    <div class="container-fluid py-3">
        <div class="container-fluid mt-3">
            <div class="row">  
                
                <?php
                
                $sql = "SELECT * FROM bookings WHERE user_id = (SELECT user_id FROM users WHERE username = '$user')";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $items_num = $result->num_rows;
                    echo '<div class="col-sm-4 col-lg-8 offset-lg-1 offset-sm-4">';
                    echo '<div class="container mb-4">';
                    echo '<h5 class="fw-bold">You have <span class="text-primary">' . $items_num . '</span> booking(s):</h5>';
                    echo '</div>';
                    echo '</div>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-xs-8 col-sm-8 col-md-8 col-xl-8 offset-xs-1 offset-sm-1 offset-md-1 offset-lg-1 offset-xl-1">';
                        echo '<div class="container mb-4">';
                        echo '<h3 class="fw-bold mb-3">' . $row['eventName'] . '</h3>';
                        echo '<h6 class="fw-bold text-secondary"><i class="bi bi-people-fill"></i> Visitors: ' . $row['visitors'] . ' </h6>';
                        echo '<h6 class="fw-bold text-secondary"><i class="bi bi-clock-fill"></i> Time: ' . $row['time'] . '</h6>';
                        echo '<h6 class="fw-bold text-secondary"><i class="bi bi-calendar-event-fill"></i> Date: ' . $row['date'] . '</h6>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-xs-2 col-sm-2 col-md-2 col-xl-2 mb-3">';
                        echo '<div class="container text-end">';
                        echo '<a href="update.php?id=' . $row['booking_id'] . '&username=' . $user . '" class="btn btn-outline-primary w-100 mt-3">Edit</a>';
                        echo '<a href="delete.php?id=' . $row['booking_id'] . '&username=' . $user . '" class="btn btn-danger w-100 mt-2">Cancel</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-sm-4 col-lg-8 offset-lg-1 offset-sm-4">';
                    echo '<div class="container">';
                    echo '<h5 class="fw-bold">You don\'t seem to have any booking(s) yet.</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-sm-4 col-lg-2">';
                    echo '<div class="container text-end">';
                    echo '<a href="booking.php?username=' . $user . '" class="btn btn-sm btn-primary w-75">Book an event</a>';
                    echo '</div>';
                    echo '</div>';
                }

                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php
    include 'components/footer.php';
    ?>

</body>

</html>