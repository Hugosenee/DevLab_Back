<?php

session_start();

require_once 'connection.php';

$connection = new Connection();
if($_SESSION){
    $infosession = $connection->getinfo($_SESSION['email']);
    $_SESSION['id'] = $infosession[0]['id'];
    $_SESSION['username'] = $infosession[0]['username'];
    $_SESSION['email'] = $infosession[0]['email'];
}

$searchResult = $connection->get("search");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.scss">
    <title>Search</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex">
<!-- side bar -->
<?php
require('nav.php');
?>
<!-- content -->

<div class="max-[426px]:ml-0 max-[769px]:h-auto w-screen h-screen bg-slate-900 ml-60">
    <iconify-icon icon="charm:menu-hamburger" id="burgerBtn" class="hidden max-[426px]:block text-4xl text-white absolute top-5 left-5"></iconify-icon>
    <p class="text-white text-center">Résultat de Recherche : <span id="searchResult" class="text-blue-500"><?= $searchResult?></span></p>
    <div id="results" class="flex flex-wrap gap-10 justify-center py-16">

    </div>
</div>

<script src="js/burger.js"></script>
<script src="./node_modules/axios/dist/axios.min.js"></script>
<script src="js/search.js"></script>
</body>
</html>
