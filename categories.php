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

$isCat = "";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.scss">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Catégories</title>
</head>
<body class="flex bg-slate-900">

<!-- side bar -->
<?php
require('nav.php');
?>
<!-- content -->


<div class="max-[425px]:ml-0 w-screen h-screen bg-bgblue ml-60">
    <iconify-icon icon="charm:menu-hamburger" id="burgerBtn" class="hidden max-[425px]:block text-4xl text-white absolute top-5 left-5"></iconify-icon>
    <h1 class="text-white text-center text-3xl">Catégories :</h1>

    <div class="flex justify-center mt-10">
        <select name="cat" id="cat" class="w-80 h-12 rounded-3xl bg-gray-500 text-white text-center">
            <option value="" selected>Please select a value</option>
            <option value="28">Action</option>
            <option value="12">Adventure</option>
            <option value="16">Animation</option>
            <option value="35">Comedy</option>
            <option value="80">Crime</option>
            <option value="99">Documentary</option>
            <option value="18">Drama</option>
            <option value="10751">Family</option>
            <option value="14">Fantasy</option>
            <option value="36">History</option>
            <option value="27">Horror</option>
            <option value="10402">Music</option>
            <option value="9648">Mystery</option>
            <option value="10749">Romance</option>
            <option value="878">Science Fiction</option>
            <option value="10770">TV Movie</option>
            <option value="53">Thriller</option>
            <option value="10752">War</option>
            <option value="37">Western</option>
        </select>
    </div>
    <div>
        <div id="movie-wrapper" class="flex flex-wrap gap-10 justify-center py-16">

        </div>
    </div>
</div>

<script src="js/burger.js"></script>
<script src="js/categories.js"></script>
</body>
</html>