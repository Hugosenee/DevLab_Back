<?php

session_start();

require_once 'connection.php';
require_once 'album.php';


$connection = new Connection();
if($_SESSION){
    $infosession = $connection->getinfo($_SESSION['email']);
    $_SESSION['id'] = $infosession[0]['id'];
    $_SESSION['username'] = $infosession[0]['username'];
    $_SESSION['email'] = $infosession[0]['email'];
} else {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.scss">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</head>
<body class="flex">
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
                <li class="mb-4 text-yellow-400 flex"><img src="image/accountyellow.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="myProfile.php">My Account</a></li>
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


<div class="w-screen h-screen text-white bg-slate-900 ml-60">
    <h1>Mon profil : <?= $_SESSION['username'] ?></h1>
    <p>Mes albums :</p>
    <div class="flex gap-3">
        <?php
        $allAlbum = $connection->getUserAlbum($_SESSION['id']);


        foreach ($allAlbum as $album) {
            echo '<div class="flex flex-col border px-6 py-3">';
            echo '<p class="text-xs">';
            if ($album['is_private'] == 0) {
                echo 'private';
            } else {
                echo 'public';
            }
            echo '</p>';
            echo '<p class="text-xl mb-6">' . $album['name'] . '</p>';
            echo '<a href="albumSingle.php?albumId=' . $album['id'] . '&albumName=' . $album['name'] . '&albumCreator=' . $album['user_id'] . '">Voir</a>';
            echo '<a href="deleteAlbum.php?id=' . $album['id'] . '">Supprimer</a>';
            echo '</div>';
        }

        ?>
    </div>


    <p class="text-white">Mes likes :</p>
    <div class="flex gap-3 text-white">
        <?php
        $albumIdLiked = $connection->getAlbumLikeFromUser($_SESSION['id']);

        foreach ($albumIdLiked as $album) {
            $getAlbum = $connection->getAlbumFromAlbumId($album['album_id']);
            echo '<div class="flex flex-col border px-6 py-3">';
            echo '<p class="text-xs">';
            echo '</p>';
            echo '<p class="text-xl mb-6">' . $getAlbum['name'] . '</p>';
            echo '<a href="albumSingle.php?albumId=' . $getAlbum['id'] . '&albumName=' . $getAlbum['name'] . '&albumCreator=' . $getAlbum['user_id'] . '">Voir</a>';
            echo '</div>';
        }
        ?>
    </div>


    <p>Partagés avec vous :</p>
    <div>
        <?php
        $albumShared = $connection->getSharedAlbums($_SESSION['id']);

        foreach ($albumShared as $album) {
            $getAlbum = $connection->getAlbumFromAlbumId($album['album_id']);
            echo '<div class="flex flex-col border px-6 py-3">';
            echo '<p class="text-xs">';
            echo '</p>';
            echo '<p class="text-xl mb-6">' . $getAlbum['name'] . '</p>';
            echo '<a href="albumSingle.php?albumId=' . $getAlbum['id'] . '&albumName=' . $getAlbum['name'] . '&albumCreator=' . $getAlbum['user_id'] . '">Voir</a>';
            echo '</div>';
        }
        ?>
    </div>

    <p>Ajouter un album :</p>
    <div class="flex">
        <form method="post" class="text-black">
            <input type="text" name="name" placeholder="album name">
            <select name="is_private">
                <option value="0">Private</option>
                <option value="1">Public</option>
            </select>
            <input type="submit" value="Créer" class="cursor-pointer bg-white">
        </form>
    </div>
    <p>Invitations :</p>

    <?php

    $invitation = $connection->getInvitation($_SESSION['id']);
    foreach ($invitation as $invit) {
        if ($invit['acceptation'] == 0) {
            echo 'Vous avez une invitation, voulez vous l\'accepter';
            echo '<br>';
            echo '<a href="responseInvit.php?response=1&invitId=' . $invit['id'] . '" class="text-green-600">Accepter</a>';
            echo '<a href="responseInvit.php?response=0&invitId=' . $invit['id'] . '" class="text-red-600">Refuser</a>';

        }
    }
    ?>


</div>

<?php
if($_POST) {
    $album = new album(
            $_POST['name'],
            $_POST['is_private'],
            $_SESSION['id']
    );
    $createAlbum = $connection->insertAlbum($album);
}

?>



</body>
</html>
