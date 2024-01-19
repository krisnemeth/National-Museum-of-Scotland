<?php 

session_start();

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
    <link href="css/styles.css" rel="stylesheet">
    <title>National Museum of Scotland</title>
</head>

<body class="d-flex flex-column min-vh-100">


    <?php
    include 'components/nav_admin.php';
    ?>

    <!-- contact form -->
    <div class="container-fluid">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 bg-grey py-4 px-4">
                    <div class="text-center">
                        <h1 class="pb-1">Get In Touch</h1>
                        <p class="text-secondary form-text">Let us know if you have any issues with booking.</p>
                    </div>
                    <div class="container">
                        <form action="submit">
                            <div class="mb-3">
                                <label for="basic-url" class="form-label">Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="basic-url" class="form-label">Email</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="basic-url" class="form-label">Message</label>
                                <textarea class="form-control" name="message" id="" rows="3" maxlength="300" required></textarea>
                            </div>
                            <div class="text-center mb-2">
                                <a type="submit" class="btn btn-primary w-100" href="contact-fwd.php?username=<?php echo $user ?>">Submit</a>
                            </div>
                        </form>
                    </div>
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