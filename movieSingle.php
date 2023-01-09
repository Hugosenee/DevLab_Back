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
    <title>Film</title>
</head>
<body class="flex bg-slate-900">

<!-- side bar -->
<?php
require('nav.php');
?>
<!-- content -->


<div class="max-[425px]:ml-0 w-screen h-screen bg-bgblue ml-60">
    <iconify-icon icon="charm:menu-hamburger" id="burgerBtn" class="hidden max-[425px]:block text-4xl text-white absolute top-5 left-5"></iconify-icon>
    <p id="movieId" class="hidden"><?= $movieId?></p>


    <?php
    if($_SESSION){ ?>
    <form method="post">
        <label for="albumId" class="text-white">Ajouter ce film a l'album : </label>
        <select name="album_id" id="albumId" class="text-black">
            <?php
            $allAlbum = $connection->getUserAlbum($_SESSION['id']);

            foreach ($allAlbum as $album) {
                echo '<option value="' . $album['id'] . '">' . $album['name'] . '</option>';
            }

            $albumShared = $connection->getSharedAlbums($_SESSION['id']);

            foreach ($albumShared as $album) {
                $getAlbum = $connection->getAlbumFromAlbumId($album['album_id']);
                echo '<option value="' . $getAlbum['id'] . '">' . $getAlbum['name'] . '</option>';

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
        echo '<p class="text-white">This movie has been added</p>';
    }
    ?>

    <div id="movie-wrapper">

    </div>

</div>

<script src="js/burger.js"></script>
<script src="js/singleMovie.js"></script>
</body>
</html>