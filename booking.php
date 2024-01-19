<?php
session_start();

include 'includes/connx.php';
include 'includes/error.php';

$user = $_GET['username'];

/* using message to display different buttons if needed */
$message = '<input type="submit" class="btn btn-primary w-100 mb-4" value="Book" name="submit">';

// grabbing user input, then pushing data to db based on user_id matched to username.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $eventName = $_POST['eventName'];
    $visitors = $_POST['visitors'];
    $time = $_POST['eventTime'];
    $date = $_POST['date'];

    $sql = "INSERT INTO bookings (eventName, visitors, time, date, user_id)
                VALUES ('$eventName', '$visitors', '$time', '$date', (SELECT user_id FROM users WHERE username = '$user'))";

    if ($conn->query($sql) === TRUE) {
        header("refresh: 2; url=admin.php?username=" . $user);
        $message = '<i class="bi bi-check-circle text-success pb-3" style="font-size: 500%;"></i>
                    <h5 class="text-secondary pt-3">Booking confirmed!</h5>';
    } else {
        $message = '<p class="text-secondary my-3">Something went wrong. We encountered a problem booking your event.</p>
                    <input type="submit" class="btn btn-primary mb-4" value="Ok" name="submit">';
    }
}
$conn->close();

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
    <?php
    include 'components/nav_admin.php';
    ?>

    

    <div class="container py-5 mb-5">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 py-4 px-4 bg-grey">
                <div class="text-center">
                    <h1 class="pb-3">Book an event</h1>
                </div>

                <form action="#" method="POST" enctype="multipart/form-data">
                    
                    <label for="prod_condition" class="form-label">Choose an event</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="eventName" name="eventName" required>
                        <option selected>Select an event</option>
                        <option value="Japanese Contemporary Design">Japanese Contemporary Design</option>
                        <option value="Museum Socials">Museum Socials</option>
                        <option value="Rising Tide">Rising Tide</option>
                    </select>
                    <div class="mb-3">
                        <label class="form-label" for="price">Number of visitors</label>
                        <input type="number" class="form-control" id="visitors" name="visitors" required>
                    </div>
                    <label for="age" class="form-label">Choose a time</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="eventTime" name="eventTime" required>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                    </select>
                    <div class="mb-3">
                        <label class="form-label" for="price">Pick a day</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="text-center pt-3">
                        <?php echo $message ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include 'components/footer.php';
    ?>
</body>

</html>