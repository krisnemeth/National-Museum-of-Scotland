<?php
session_start();

include 'includes/connx.php';
include 'includes/error.php';

$user = $_GET['username'];


/* using message to display different buttons if needed */
$message = '<input type="submit" class="btn btn-primary w-100 mb-4" value="Upload" name="submit">';

// grabbing user input and the uploaded file. we store the uploaded file then perform checks on it, then pushing data to db alongside the uploaded file.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    //grabbing the uploaded file
    $file = $_FILES['file'];
    //storing all types of file data from the array so can perform checks on them
    $fileName = $_FILES['file']['name'];
    $fileTempLocation = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    //cleaning up the file extension
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    //setting allowed file extensions
    $allowed = array('jpg', 'jpeg', 'png');
    //setting conditions before uploading
    if (in_array($fileActualExt, $allowed )) {
        if ($fileError === 0) {
            if ($fileSize < 200000) {
                //setting unique id as the filename then adding the cleaned file extension on
                $fileNameNew = $user . uniqid('', true). "." . $fileActualExt;
                //setting the file destination and adding the new filename to it
                $fileDestination = 'uploads/' . $fileNameNew;
                //moving the file from temp location to destination
                move_uploaded_file($fileTempLocation, $fileDestination);
                
                // checking if the user has already got a profile picture uploaded
                $checkImage = "SELECT * FROM profilePic WHERE username = '$user'";
                $result = $conn->query($checkImage);
                if ($result->num_rows > 0) {
                    $message = '<i class="bi bi-x-circle text-danger pb-3" style="font-size: 500%;"></i>
                                <h5 class="text-secondary pt-3">Seems like you already have a profile picture.</h5>';
                } else {
                    // pushing all data into the database based on user_id
                    $sql = "INSERT INTO profilePic (image, user_id, username)
                    VALUES ('$fileDestination', (SELECT user_id FROM users WHERE username = '$user'), '$user')";
                    //displaying success message 
                    $message = '<i class="bi bi-check-circle text-success pb-3" style="font-size: 500%;"></i>
                                <h5 class="text-secondary pt-3">Image uploaded!</h5>';
                    if ($conn->query($sql) === TRUE) {
                        // redirecting to admin page
                        header("refresh: 2; url=admin.php?username=" . $user);
                    } else {
                        // displaying error message, and offering to retry
                        $message = '<i class="bi bi-x-circle text-danger pb-3" style="font-size: 500%;"></i>
                                    <h5 class="text-secondary pb-2">Something went wrong. We encountered a problem uploading your image.</h5>
                                    <a href="upload.php" class="btn btn-secondary w-100">Retry</a>';
                    }
                }
            } else {
                // displaying error message, and offering to retry
                $message = '<i class="bi bi-x-circle text-danger pb-3" style="font-size: 500%;"></i>
                            <h5 class="text-secondary pb-2">Your file is too big.</h5>
                            <a href="upload.php" class="btn btn-secondary w-100">Retry</a>';
                    
            }
        } else {
            // displaying error message, and offering to retry
            $message = '<i class="bi bi-x-circle text-danger pb-3" style="font-size: 500%;"></i>
                        <h5 class="text-secondary pb-2">Something went wrong. We encountered a problem uploading your image.</h5>
                        <a href="upload.php" class="btn btn-secondary w-100">Retry</a>';
        }
    } else {
        // displaying error message, and offering to retry
        $message = '<i class="bi bi-x-circle text-danger pb-3" style="font-size: 500%;"></i>
                    <h5 class="text-secondary pb-2">File type not supported.</h5>
                    <a href="upload.php" class="btn btn-secondary w-100">Retry</a>';
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
    <link href="css/upload-styles.css" rel="stylesheet">
    
    <title>National Museum of Scotland</title>
    
</head>

<body>
    <?php
    include 'components/nav_admin.php';
    ?>

    
        <div class="container py-5 my-5">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 py-4 px-4 bg-grey">
                    <div class="text-center">
                        <img src="./img/profilePic/default.png" class="avatar" alt="">
                        <h1 class="pb-3">Upload new profile picture</h1>
                    </div>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="form-label" for="uploaded">Image</label>
                            <p class="form-text">Max image size for best result: 500 x 500px.</p>
                            <input type="file" class="form-control" name="file">
                        </div>

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