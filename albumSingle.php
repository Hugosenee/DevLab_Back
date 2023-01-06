<?php

session_start();

require_once 'connection.php';
require_once 'album.php';
require_once 'like.php';



$connection = new Connection();
if($_SESSION){
    $infosession = $connection->getinfo($_SESSION['email']);
    $_SESSION['id'] = $infosession[0]['id'];
    $_SESSION['username'] = $infosession[0]['username'];
    $_SESSION['email'] = $infosession[0]['email'];
} else {
    header('location: index.php');
}


$albumId = $connection->get("albumId");
$albumName = $connection->get("albumName");

if(isset($_GET['albumCreator'])) {
    $albumCreator = $connection->get("albumCreator");

}
$getMovies = $connection->getMovieFromAlbum($albumId);

$movieIds = array();

foreach ($getMovies as $element) {
    $movieIds[] = $element['film_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.scss">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</head>
<body class="flex">
<!-- side bar -->
<div class="h-full bg-black w-60 flex flex-col fixed top-0">
    <div class="flex justify-center">
        <ul class="text-white mt-24 text-2xl">
            <li class="mb-4 flex"><img src="image/home.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="index.php">Home</a></li>
            <li class="mb-4 flex"><img src="image/fichiers.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="categories.php">Categories</a></li>
        </ul>
    </div>
    <hr class="border-slate-500 w-40 ml-12 mt-5">
    <div class="flex justify-center">
        <?php
        if ($_SESSION){ ?>
            <ul class="text-white mt-10 text-2xl gap-24">
                <li class="mb-4 flex"><img src="image/account.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="myProfile.php">My Account</a></li>
                <li class="flex"><img src="image/friends.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="allProfiles.php">All Profiles</a></li>
            </ul>
        <?php }

        ?>
    </div>
    <div class="flex justify-center">
        <div class="text-white mt-60 text-2xl gap-24 flex-col">
            <?php
            if($_SESSION){ ?>
                <p class="text-base"> <?= $_SESSION['username'] ?> </p>
                <?php echo '<a href="logout.php" id="deco" class="text-base">Déconnexion</a>';
            }   else {
                echo '<a href="login.php"><li class="mb-2 flex"><img src="image/login.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Login</li></a>
                      <a href="register.php" ><li class="flex"><img src="image/register.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Register</li></a>';
            }
            ?>
        </div>
    </div>
</div>
<!-- content -->
<div class="w-screen h-screen text-white bg-slate-900 ml-60">
<h1><?php echo $albumName ?></h1>
    <form method="POST">
        <input type="hidden" name="albumId" value="<?php echo $albumId ?>">
        <input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ?>">

        <input type="submit" value="like">
    </form>
    <?php
    if ($_POST) {
        $like = new like(
            $_POST['albumId'],
            $_POST['userId']
        );
        $addLike = $connection->addLike($like);
    }

    ?>
    <div id="movie-wrapper">

    </div>

</div>

<script>
    let movieIdsStr = "<?php echo json_encode($movieIds); ?>";
    let sessionId = "<?php echo $_SESSION['id'] ?>";
    let creatorId = "<?php echo $albumCreator ?>";
</script>
<script src="js/movieAlbum.js"></script>
</body>
</html>
