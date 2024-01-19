<?php 
session_start();

if (isset($_GET['username'])) {
    $user = $_GET['username'];
}

//if session is active, display navbar with admin links, if not display standard nav
if (isset($user)) {
    include 'components/nav_admin.php';
} else {
    include 'components/nav.php';
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
    

    <!-- columns displaying information about the museum, and an image of the museum hall -->
    <div class="container mb-2">
        <div class="container pt-3">
            <div class="row pb-2">
                <div class="col-xs-6 col-sm-6 col-lg-6">
                    <h1 class="fw-bold pb-3">Our history</h1>
                    <h4 class="fw-bold">Discover the story of National Museums Scotland, from our 18th century beginnings to the present day.</h4>
                    <p class="pb-3">Two strands of history come together in the story of the development of National Museums Scotland: the desire to have a museum reflecting Scottish history and the wish to have a museum demonstrating international cultures, natural and physical sciences, and decorative art for Scotland.</p>
                    <h4 class="fw-bold">Beginnings: The Society of Antiquaries of Scotland</h4>
                    <p class="pb-3">The Society of Antiquaries of Scotland was founded in 1780, very much in the spirit of the Enlightenment, to collect the archaeology of Scotland. Its collections passed into public ownership in 1851 as the original collections of the National Museum of Antiquities of Scotland. These collections, which had had various homes previously, were housed from 1891 until 1995 in specially built galleries in Finlay Buildings, Queen Street, Edinburgh (also occupied by the Scottish National Portrait Gallery). The annual proceedings of the Society of Antiquaries provide an invaluable record of research carried out on the archaeology collection, from their first publication in 1851 to the present day.</p>
                    <h4 class="fw-bold">A new home</h4>
                    <p>In 1985 the National Museum of Antiquities was amalgamated with the Royal Scottish Museum. The latter was founded in 1854 as the Industrial Museum of Scotland and reflected the impetus of Victorian ideals of education. It started international collecting and research as well as forming close links to the collections and teaching of Edinburgh University, which continue today. Renamed the Edinburgh Museum of Science and Art, it opened in its first bespoke buildings, designed by Francis Fowke, in Chambers Street in 1866.The 1985 amalgamation created the National Museums of Scotland (now National Museums Scotland), the largest multi-disciplinary museum in Scotland, with 12 million items in its collections and the largest body of curatorial and conservation expertise in the country.</p>
                </div>
                <div class="col-xs-6 col-sm-6 col-lg-6">
                    <img class="img-fluid" src="./img/museum-hall-sm.jpeg" alt="museum hall">
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