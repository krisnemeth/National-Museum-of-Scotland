<?php session_start();

include 'includes/connx.php';
/* grabs the booking's id and the username using the GET method */
$user = $_GET['username'];
$booking_id = $_GET['id'];

$message = '<p class="form-text mt-5">The previous information can not be retrieved once changed.</p>
            <input type="submit" name="submit" class="btn btn-primary w-100 mb-4" value="Confirm changes">';

/* retrive all the already exisiting information of the booking with that specific id */
$sql = "SELECT * from bookings WHERE booking_id = '$booking_id'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    /* store the booking's info in different variables */
    $selected_booking_name = $row['eventName'];
    $selected_booking_visitors = $row['visitors'];
    $selected_booking_time = $row['time'];
    $selected_booking_date = $row['date'];
}

/* if confirm button pressed */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $new_event_name = $_POST['new_event_name'];
    $new_visitors = $_POST['new_visitors'];
    $new_time = $_POST['new_time'];
    $new_date = $_POST['new_date'];
    // update the booking with new data
    $sql = "UPDATE bookings 
        SET eventName = '$new_event_name', 
        visitors = '$new_visitors', 
        time = '$new_time',
        date = '$new_date' 
        WHERE booking_id = '$booking_id'";
    // redirect to admin page displaying a confirmation first
    if (mysqli_query($conn, $sql)) {
        header("refresh: 2; url=admin.php?username=" . $user);

        $message = '<i class="bi bi-check-circle text-success pb-3" style="font-size: 500%;"></i>
                    <h5 class="text-secondary pt-3">Changes confirmed!</h5>';
    //display error message 
    } else {
        $message = '<p class="form-text text-secondary my-3">Something went wrong. We encountered a problem updating your booking.</p>';
                echo "Error updating record: " . mysqli_error($conn);
    }
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
    <?php
    include 'components/nav_admin.php';
    ?>

    <div class="container py-5 mb-2">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 py-4 px-4 bg-grey">
                <div class="text-center">
                    <h1 class="pb-3">Edit your booking</h1>
                </div>

                <form method="POST">
                    
                    <div class="mb-3">
                        <label for="new_event_name" class="form-label">Event</label>
                        <select class="form-select" aria-label="Default select example" id="new_event_name" name="new_event_name">
                            <option selected><?php echo $selected_booking_name ?></option>
                            <option value="Japanese Contemporary Design">Japanese Contemporary Design</option>
                            <option value="Museum Socials">Museum Socials</option>
                            <option value="Rising Tide">Rising Tide</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="new_visitors">Visitors</label>
                        <input type="number" class="form-control" id="new_visitors" name="new_visitors" value="<?php echo $selected_booking_visitors ?>">
                    </div>

                    <div class="mb-3">
                        <label for="new_time" class="form-label">Time</label>
                        <select class="form-select" aria-label="Default select example" id="new_time" name="new_time">
                            <option selected><?php echo $selected_booking_time ?></option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="new_date">Date</label>
                        <input type="date" class="form-control" id="new_date" name="new_date" value="<?php echo $selected_booking_date ?>">
                    </div>

                    <!-- button -->
                    <div class="text-center">
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