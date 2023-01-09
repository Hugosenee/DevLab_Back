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

$getSharedAlbum = $connection->deleteFilmsFromSharedAlbumIfYouAreNotTheOwner($albumId);


foreach ($getSharedAlbum as $albumsShared){
    $sharedId = $albumsShared['shared_with'];
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
<?php
require('nav.php');
?>
<!-- content -->

<div class="max-[425px]:ml-0 w-screen h-screen text-white bg-slate-900 ml-60 flex flex-col items-center">
    <div class="flex">
        <iconify-icon icon="charm:menu-hamburger" id="burgerBtn" class="hidden max-[425px]:block text-4xl text-white absolute top-5 left-5"></iconify-icon>

        <h1 class="text-center text-5xl mt-5"><?php echo $albumName ?></h1>
        <form method="POST">
            <input type="hidden" name="albumId" value="<?php echo $albumId ?>">
            <input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ?>">

            <?php
            $albumAlreadyLiked = $connection->getIfAnAlbumIsLiked($albumId, $_SESSION['id']);

            $albumAlreadyLikedNumber = count($albumAlreadyLiked);


            if ($albumAlreadyLikedNumber == 1) {
               echo '<button  type="submit" value="like"><iconify-icon class="text-3xl mt-8 ml-4 text-red-600"  icon="mdi:cards-heart-outline"></iconify-icon></button>';

            } else if ($albumAlreadyLikedNumber == 2){
                $suppLike = $connection->deleteLike($albumId, $_SESSION['id']);
                $albumAlreadyLikedNumber = 0;
            } else {
               echo ' <button  type="submit" value="like"><iconify-icon class="text-3xl mt-8 ml-4"  icon="mdi:cards-heart-outline"></iconify-icon></button>';

            }

            ?>

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
    </div>
    <div id="movie-wrapper" class="flex flex-wrap gap-10 justify-center py-16 bg-slate-800 mt-5 rounded-2xl w-4/5">

    </div>

</div>

<script>
    let sharedId = "<?php echo $sharedId ?>";
    let movieIdsStr = "<?php echo json_encode($movieIds); ?>";
    let sessionId = "<?php echo $_SESSION['id'] ?>";
    let creatorId = "<?php echo $albumCreator ?>";
</script>
<script src="js/burger.js"></script>
<script src="js/movieAlbum.js"></script>
</body>
</html>
