<?php
session_start();

/* feedback message when page opens */
$message = '<p class="text-secondary form-text">Haven\'t got an account? <a href="signup.php" class="link">Sign up</a></p>';

/* when submit button is pressed, sanitize the un, hash the pw, search db for existing match. If we got a match, go to admin page, if not, display message */
if (isset($_POST['submit'])) {

    include('includes/connx.php');
    include('includes/error.php');

    $user = $_POST['username'];
    $user_trim = trim($_POST['username']);
    $user_strip = strip_tags($user_trim);
    $user_htmlspecialchars = htmlspecialchars($user_strip);

    $pwd = $_POST['pwd'];
    $hashed_pwd_md5 = md5($pwd);

    $sql = "SELECT username, password FROM users WHERE username = '$user_htmlspecialchars'";
    $result = $conn->query($sql); 
    $row = $result->fetch_assoc(); 

    if ($result->num_rows === 1  && $hashed_pwd_md5 === $row['password']) {
        $_SESSION['userLogged'] =  $user_htmlspecialchars;
        header('location:admin.php?username=' . $user_htmlspecialchars);
        die();
    } else {
        $message = "<p class='text-center form-text'>The username and password don't match</p>
                    <p>Haven't got an account? <a href='signup.php' class='link'>Sign up</a></p>";
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

    <!-- navbar if user's not logged in -->
    <?php
    include 'components/nav.php';
    ?>

    <div class="container py-5 mb-2">
        <!-- intro -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 py-4 px-4 bg-grey">
                <div class="text-center">
                    <h1 class="pb-3">Log In</h1>
                </div>
                
                
                <form method="POST">
                    <!-- username -->
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <!-- password -->
                    <div class="mb-5">
                        <label class="form-label" for="pwd">Password</label>
                        <input type="password" class="form-control" name="pwd" id="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        
                    </div>
                    <!-- submit button -->
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary w-100 mb-4" name="submit" id="submit" value="Log in">
                    </div>
                    <!-- message that changes with conditions -->
                    <div class="text-center mt-2">
                    <?php echo $message ?>
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