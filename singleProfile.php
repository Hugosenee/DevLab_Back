<?php

session_start();

require_once 'connection.php';
require_once 'sharedAlbum.php';


$connection = new Connection();
if($_SESSION){
    $infosession = $connection->getinfo($_SESSION['email']);
    $_SESSION['id'] = $infosession[0]['id'];
    $_SESSION['username'] = $infosession[0]['username'];
    $_SESSION['email'] = $infosession[0]['email'];
}

$profileId = $connection->get('userId');

$albumIdLiked = $connection->getAlbumLikeFromUser($profileId);


?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
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

    <div class="max-[425px]:ml-0 w-screen h-screen bg-slate-900 ml-60">
        <?php

        $getProfileInfo = $connection->getUserAlbumPublic($profileId);

        $getNameProfile = $connection->getnameprofile($profileId);

        $profileName['username'] = $getNameProfile[0]["username"] ;


        ?>

        <iconify-icon icon="charm:menu-hamburger" id="burgerBtn" class="hidden max-[425px]:block text-4xl text-white absolute top-5 left-5"></iconify-icon>
        <h1 class="text-white text-5xl text-center">profil : <?= $profileName['username'] ?></h1>
            <div class="pl-10">
                <p class="text-white text-3xl mb-5">Ses albums :</p>
                <div class="flex gap-3 text-white flex-wrap">
                    <?php



                    foreach ($getProfileInfo as $album) {
                        echo '<div class="flex flex-col px-6 py-3 bg-slate-800 rounded-2xl h-36">';
                        echo '<p class="text-xs">';
                        echo '</p>';
                        echo '<p class="text-xl mb-6">' . $album['name'] . '</p>';
                        echo '<a href="albumSingle.php?albumId=' . $album['id'] . '&albumName=' . $album['name'] . '&albumCreator=' . $album['user_id'] . '">Voir</a>';
                        echo '</div>';
                    }

                    ?>
                </div>
            </div>
        <div class="pl-10 mt-5">
            <p class="text-white text-3xl mb-5">Ses albums likés :</p>
            <div class="flex gap-3 text-white flex-wrap">
                <?php
                foreach ($albumIdLiked as $album) {
                    $getAlbum = $connection->getAlbumFromAlbumId($album['album_id']);
                    echo '<div class="flex flex-col px-6 py-3 bg-slate-800 rounded-2xl h-36">';
                    echo '<p class="text-xs">';
                    echo '</p>';
                    echo '<p class="text-xl mb-6">' . $getAlbum['name'] . '</p>';
                    echo '<a href="albumSingle.php?albumId=' . $getAlbum['id'] . '&albumName=' . $getAlbum['name'] . '&albumCreator=' . $getAlbum['user_id'] . '">Voir</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="pl-10">
            <p class="text-white text-3xl">Partager avec lui :</p>
            <form method="POST">
                <select class="w-36" name="shared_album_id" id="shared_album_id">
                    <?php
                    $allAlbum = $connection->getUserAlbum($_SESSION['id']);

                    foreach ($allAlbum as $album) {
                        echo '<option value="' . $album['id'] . '">' . $album['name'] . '</option>';
                    }
                    ?>
                    <input type="submit" value="Partager" class="cursor-pointer bg-white ml-2">
                </select>
            </form>
        </div>

        <?php

    if($_POST) {
        $sharedAlbum = new sharedAlbum(
            $_POST['shared_album_id'],
            $_SESSION['id'],
            $profileId
        );
        $addShareAlbum = $connection->insertSharedAlbum($sharedAlbum);
        echo '<p class="text-white">This album has been shared</p>';
    }
    ?>
        <script src="js/burger.js"></script>
    </body>
    </html>
