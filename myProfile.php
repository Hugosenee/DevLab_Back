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

$isMyPro = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.scss">
    <title>My profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</head>
<body class="flex">
<!-- side bar -->
<?php
require('nav.php');
?>
<!-- content -->

<div class="max-[425px]:ml-0 max-[769px]:h-auto w-screen h-screen text-white bg-slate-900 ml-60">
    <iconify-icon icon="charm:menu-hamburger" id="burgerBtn" class="hidden max-[425px]:block text-4xl text-white absolute top-5 left-5"></iconify-icon>
    <h1 class="text-5xl text-center"><?= $_SESSION['username'] ?></h1>
    <div class="pl-10">
        <p class="text-3xl mb-5">Mes albums :</p>
        <div class="flex gap-3 flex-wrap">
            <?php
            $allAlbum = $connection->getUserAlbum($_SESSION['id']);


            foreach ($allAlbum as $album) {
                echo '<div class="flex flex-col px-6 py-3 bg-slate-800 rounded-2xl h-36">';
                echo '<p class="text-xl mb-6">' . $album['name'] . '</p>';
                echo '<p class="text-xs mt-8">';
                if ($album['is_private'] == 0) {
                    echo 'private';
                } else {
                    echo 'public';
                }
                echo '</p>';
                echo '<div class="flex justify-between end">';
                echo '<a href="albumSingle.php?albumId=' . $album['id'] . '&albumName=' . $album['name'] . '&albumCreator=' . $album['user_id'] . '">Voir</a>';
                echo '<a href="deleteAlbum.php?id=' . $album['id'] . '" class="  text-2xl"><iconify-icon icon="material-symbols:delete-outline-rounded"></iconify-icon></a>';
                echo '</div>';
                echo '</div>';
            }

            ?>
        </div>
    </div>


    <div class="pl-10 mt-5">
        <p class="text-white text-3xl mb-5">Mes likes :</p>
        <div class="flex gap-3 text-white flex-wrap">
            <?php
            $albumIdLiked = $connection->getAlbumLikeFromUser($_SESSION['id']);

            foreach ($albumIdLiked as $album) {
                $getAlbum = $connection->getAlbumFromAlbumId($album['album_id']);
                echo '<div class="flex flex-col px-6 py-3 bg-slate-800 rounded-2xl h-24">';
                echo '<p class="text-xs">';
                echo '</p>';
                echo '<p class="text-xl mb-6">' . $getAlbum['name'] . '</p>';
                echo '<a href="albumSingle.php?albumId=' . $getAlbum['id'] . '&albumName=' . $getAlbum['name'] . '&albumCreator=' . $getAlbum['user_id'] . '">Voir</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>


    <div class="pl-10 mt-5">
        <p class="text-white text-3xl mb-5">Partag??s avec vous :</p>
        <div class="flex gap-3 text-white flex-wrap">
            <?php
            $albumShared = $connection->getSharedAlbums($_SESSION['id']);

            foreach ($albumShared as $album) {
                $getAlbum = $connection->getAlbumFromAlbumId($album['album_id']);
                echo '<div class="flex flex-col px-6 py-3 bg-slate-800 rounded-2xl h-24">';
                echo '<p class="text-xs">';
                echo '</p>';
                echo '<p class="text-xl mb-6">' . $getAlbum['name'] . '</p>';
                echo '<a href="albumSingle.php?albumId=' . $getAlbum['id'] . '&albumName=' . $getAlbum['name'] . '&albumCreator=' . $getAlbum['user_id'] . '">Voir</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <div class="pl-10 mt-5">
        <p>Ajouter un album :</p>
        <div class="flex">
            <form method="post" class="text-black">
                <input type="text" name="name" placeholder="album name">
                <select name="is_private">
                    <option value="0">Private</option>
                    <option value="1">Public</option>
                </select>
                <input type="submit" value="Cr??er" class="cursor-pointer bg-white">
            </form>
        </div>
    </div>

    <div class="pl-10 mt-5">
        <p>Invitations :</p>
    </div>

    <?php

    $invitation = $connection->getInvitation($_SESSION['id']);
    foreach ($invitation as $invit) {
        if ($invit['acceptation'] == 0) {
            echo '<div class="bg-slate-800 absolute top-5 right-5 h-1/5 rounded-3xl w-1/5">';
                echo '<p class="text-center font-bold mt-8 mb-2 h-2/5">Vous avez une invitation, voulez vous l\'accepter</p>';
                echo '<div class="flex justify-around mt-3">';
                    echo '<a href="responseInvit.php?response=1&invitId=' . $invit['id'] . '" class="text-green-600">Accepter</a>';
                    echo '<a href="responseInvit.php?response=0&invitId=' . $invit['id'] . '" class="text-red-600">Refuser</a>';
                echo '</div>';
            echo '</div>';

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


<script src="js/burger.js"></script>
</body>
</html>
