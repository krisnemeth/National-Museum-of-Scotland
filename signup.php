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
    <?php

    //buttons when page first loads
    $message = '<input type="submit" class="btn btn-primary mb-4 w-100" value="Sign up" id="submit" name="submit"></a>';
    $message2 = '<p class="text-secondary form-text">Already have an account? <a href="login.php" class="link">Log in</a></p>';

    //when submit btn is pressed, sanitize the username, hash the password, store email in variable, then check if details are already in db, if so
    //provide feedback msg, if not, save details into db. on succesful signup, display message to the user with link to login page.
    if (isset($_POST['submit'])) {

        include 'includes/error.php';

        /* connect to db if fields exits */
        if (isset($_POST['username']) && isset($_POST['pwd'])) {

            $user = $_POST['username'];
            $user_trim = trim($_POST['username']);
            $user_strip = strip_tags($user_trim);
            $user_htmlspecialchars = htmlspecialchars($user_strip);

            $email = $_POST['email'];

            $pwd = $_POST['pwd'];
            $hashed_pwd_md5 = md5($pwd);

            include 'includes/connx.php';
        }
        // checking db for an existing user
        $checkUser = "SELECT * FROM users WHERE username = '$user_htmlspecialchars'";
        $result = $conn->query($checkUser);
        // if there is a result, display error message and offer to log in
        if ($result->num_rows > 0) {
            $message = '<i class="bi bi-x-circle text-danger pb-3" style="font-size: 500%;"></i>
                        <h5 class="text-secondary pb-2">Seems like you already have an account.</h5>
                        <a href="login.php" class="btn btn-primary w-100">Log in</a>';
        } else {
            // if check is passed push data into db and display success message and offer to log in
            $sql = "INSERT INTO users (username, email, password) VALUES ('$user_htmlspecialchars', '$email', '$hashed_pwd_md5')";
            if ($conn->query($sql) === TRUE) {
                $message = '<i class="bi bi-check-circle text-success pb-3" style="font-size: 500%;"></i>
                            <h5 class="text-secondary pb-2">Account created succesfully!</h5>
                            ';
                $message2 = '<a href="login.php" class="btn btn-primary w-100">Log in</a>';

            } else {
                echo "Error: " . $sql . "<br>" . $conn->$error;
            }
            $conn->close();
        }
    }
    ?>

</head>

<body class="d-flex flex-column min-vh-100">
   
    <?php
    include 'components/nav.php';
    ?>

    <div class="container py-5 mb-2">
        <!-- intro -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 py-4 px-4 bg-grey">
                <div class="text-center">
                    <h1 class="pb-3">Sign up</h1>
                </div>
                
                <!-- form posts to itself, page doesnt change when submit button is clicked -->
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="pwd">Password</label>
                        <p class="mt-1 form-text">Minimum eight characters, at least one uppercase letter, one lowercase letter and one number.</p>
                        <input type="password" class="form-control" name="pwd" id="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        
                    </div>
                    <div class="text-center">
                        <?php echo $message ?>
                    </div>
                    <div class="text-center">
                        <?php echo $message2 ?>
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