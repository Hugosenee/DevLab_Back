<?php

session_start();

require_once 'connection.php';
require_once 'album.php';
require_once 'movie.php';

$connection = new Connection();
if($_SESSION){
    $infosession = $connection->getinfo($_SESSION['email']);
    $_SESSION['id'] = $infosession[0]['id'];
    $_SESSION['username'] = $infosession[0]['username'];
    $_SESSION['email'] = $infosession[0]['email'];
}
// a demander a Alexis si faire en POO
$movieId = $connection->get("id");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=ccd "style.scss">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Catégories</title>
</head>
<body class="flex bg-slate-900">

<div class="h-full bg-black w-60 flex flex-col fixed top-0">
    <div class="flex justify-center">
        <ul class="text-white mt-24 text-2xl">
            <li class="mb-4  flex"><img src="image/home.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="index.php">Home</a></li>
            <li class="mb-4 flex"><img src="image/fichiers.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="categories.php">Categories</a></li>
        </ul>
    </div>
    <hr class="border-slate-500 w-40 ml-12 mt-5">
    <div class="flex justify-center">
        <ul class="text-white mt-10 text-2xl gap-24">
            <li class="mb-4 flex"><img src="image/account.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">My Account</li>
            <li class="flex"><img src="image/albums.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">My Albums</li>
        </ul>
    </div>
    <div class="flex justify-center">
        <div class="text-white mt-60 text-2xl gap-24 flex-col">
            <?php
            if($_SESSION){ ?>
                <p class="text-base"> <?= $_SESSION['email'] ?> </p>
                <?php echo '<a href="logout.php" id="deco" class="text-base">Déconnexion</a>';
            }   else {
                echo '<a href="login.php"><li class="mb-2 flex"><img src="image/login.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Login</li></a>
                      <a href="register.php" ><li class="flex"><img src="image/register.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Register</li></a>';
            }
            ?>
        </div>
    </div>
</div>



<div class=" w-screen h-screen bg-bgblue ml-60">
<p id="movieId" class="hidden"><?= $movieId?></p>


    <?php
    if($_SESSION){ ?>
    <form method="post">
        <label for="albumId" class="text-white">Ajouter ce film a l'album : </label>
        <select name="album_id" id="albumId">
            <?php
            $allAlbum = $connection->getUserAlbum($_SESSION['id']);

            foreach ($allAlbum as $album) {
                echo '<option value="' . $album['id'] . '">' . $album['name'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Ajouter" class="cursor-pointer bg-white">
    </form>
    <?php }

    if($_POST) {
        $movie = new movie(
            $_POST['album_id'],
            $movieId
        );
        $addMovie = $connection->addMovie($movie);
        echo '<p class="text-white">This movie as been added</p>';
    }
    ?>

    <div id="movie-wrapper">

    </div>

</div>


<script src="js/singleMovie.js"></script>
</body>
</html>