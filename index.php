<?php

session_start();

require_once 'connection.php';


$connection = new Connection();
if($_SESSION){
    $infosession = $connection->getinfo($_SESSION['email']);
    $_SESSION['id'] = $infosession[0]['id'];
    $_SESSION['username'] = $infosession[0]['username'];
    $_SESSION['email'] = $infosession[0]['email'];
    $checkAlbums = $connection->checkIfAlbumsUser($_SESSION['id']);

    $checkAlbumsCount = count($checkAlbums);
    if ($checkAlbumsCount < 1){
        $createAlbumAtRegister = $connection->createAlbumsAtRegister($_SESSION['id']);
    }
}

$isHome = "";

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


<div class=" max-[425px]:ml-0 w-screen bg-slate-900 ml-60">
    <div class=" flex flex-col">
        <div class="max-[425px]:mr-0 max-[425px]:justify-center flex justify-end mt-6 mr-12">
            <iconify-icon icon="charm:menu-hamburger" id="burgerBtn" class="hidden max-[425px]:block text-4xl text-white mr-3"></iconify-icon>
            <div class="h-10 w-80 bg-gray-400 rounded-3xl flex justify-between mr-4">
                <form class="flex w-full" action="searchResult.php" method="GET">
                    <input type="text" placeholder="Recherche" name="search" class="focus:outline-none w-full bg-gray-400 rounded-3xl text-white text-center">
                    <button type="submit"><iconify-icon icon="ic:baseline-search" class="text-white text-3xl mr-4 mt-1"></iconify-icon></button>
                </form>
            </div>
            <img src="image/notification.png" alt="notification" class="h-8 w-8 mt-1">
        </div>
        <div class="flex justify-center">
            <div  class="max-[425px]:h-32 w-3/4 h-72 mt-10 rounded-3xl overflow-hidden">
                <img id="slideShow" class="w-full">
            </div>
        </div>
    </div>
    <div class=" w-full h-80 mt-10">
        <p class="text-white text-2xl ml-40 mb-8">Trending :</p>
        <div class="mx-auto max-w-7xl overflow-x-scroll h-64 w-4/5">
            <div id="popularMovies" class="flex gap-7 mb-7 w-32 h-32 flex-wrap flex-col">

            </div>
        </div>
    </div>
    <div class=" w-full h-80 mt-10">
        <p class="text-white text-2xl ml-40 mb-8">Best Seller :</p>
        <div class="mx-auto max-w-7xl overflow-x-scroll h-64 w-4/5">
            <div id="popularTv" class="flex gap-7 mb-7 w-32 h-32 flex-wrap flex-col">

            </div>
        </div>
    </div>
    <div class=" w-full h-80 mt-10">
        <p class="text-white text-2xl ml-40 mb-8">Discover :</p>
        <div class="mx-auto max-w-7xl overflow-x-scroll h-64 w-4/5">
            <div id="Discover" class="flex gap-7 mb-7 w-32 h-32 flex-wrap flex-col">

            </div>
        </div>
    </div>
    <div class=" w-full h-80 mt-10">
        <p class="text-white text-2xl ml-40 mb-8">Random :</p>
        <div class="mx-auto max-w-7xl overflow-x-scroll h-64 w-4/5">
            <div id="Random" class="flex gap-7 mb-7 w-32 h-32 flex-wrap flex-col">

            </div>
        </div>
    </div>
</div>
<script src="js/slideShow.js"></script>
<script src="js/burger.js"></script>
<script src="js/popular.js"></script>
</body>
</html>
