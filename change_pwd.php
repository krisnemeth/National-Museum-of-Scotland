<?php session_start();

$user = $_GET['username'];

// buttons displayed when the page loads
$message = '<input type="submit" id="submit" name="submit" class="btn btn-primary mb-2 w-100" value="Change Password"><br>
             <a href="admin.php?username=' . $user . '" class="btn btn-outline-primary w-100">Cancel</a>';

include('includes/connx.php');
include 'includes/error.php';

//when the button is pressed, form takes the user input, sanitizes it, hashes the password, matches the username in the db, updates the pw with the new hashed one, if the username had no match, display message to the user.

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $confirmed_username_trim = trim($_POST['confirmed_username']);
    $confirmed_username_strip = strip_tags($confirmed_username_trim);
    $confirmed_username_htmlspecialchars = htmlspecialchars($confirmed_username_strip);

    $new_pwd = $_POST['new_pwd'];
    $hashed_new_pwd_md5 = md5($new_pwd);

    if ($confirmed_username_htmlspecialchars === $user) {

        $sql = "UPDATE users SET password = '$hashed_new_pwd_md5' WHERE username = '$confirmed_username_htmlspecialchars'";
        if (mysqli_query($conn, $sql)) {
            header("refresh: 3; url=admin.php?username=" . $user);
            $message = '<i class="bi bi-check-circle text-success" style="font-size: 500%;"></i>
                        <h5 class="text-secondary">Your password has been successfully changed!</h5>';
        } else {
            $message = '<i class="bi bi-exclamation-circle text-danger" style="font-size: 500%;"></i>
                        <p class="text-secondary">Something went wrong. Couldn\'t change your password.</p>';
        }
        mysqli_close($conn);
    }
    else {
        $message = '<i class="bi bi-exclamation-circle text-danger" style="font-size: 500%;"></i>
                    <p class="text-secondary">Incorrect username!</p>';
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

<body class="d-flex flex-column min-vh-100">

    <?php
    include 'components/nav_admin.php';
    ?>
    <!-- Form capturing user input then saving it into database to change existing password -->
    <div class="container py-5 mb-2">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 py-4 px-4 bg-grey">
                <div class="text-center">
                    <h1 class="pb-3">Change your password</h1>
                </div>

                <form action="#" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" id="confirmed_username" name="confirmed_username">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="pwd"><span class="text-primary">New</span> password</label>
                        <p class="form-text">Once you change your password, can't use the previous one.</p>
                        <input type="password" class="form-control" id="new_pwd" name="new_pwd">
                        
                    </div>
                    <div class="text-center">
                        <div class="text-center">
                            <?php echo $message ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php
    include 'components/footer.php';
    ?>
</body>

</html>