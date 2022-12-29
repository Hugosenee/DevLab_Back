<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.scss">
    <title>Catégories</title>
</head>
<body class="flex">

<div class="h-screen w-60 bg-navbar flex flex-col fixed top-0">
    <div class="flex justify-center">
        <ul class="text-white mt-24 text-2xl">
            <li class="mb-4  flex"><img src="image/home.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="index.php">Home</a></li>
            <li class="mb-4 text-yellowactive flex"><img src="image/fichiers.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="categories.php">Categories</a></li>
            <li class="mb-4 flex"><img src="image/boussole.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="#">Discovery</a></li>
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
        <ul class="text-white mt-60 text-2xl gap-24">
            <li class="mb-2 flex"><img src="image/login.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Login</li>
            <li class="flex"><img src="image/register.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="register.php" >Register</a></li>
        </ul>
    </div>
</div>



<div class=" w-screen h-screen bg-bgblue ml-60">
    <h1 class="text-white">Catégories :</h1>

    <select name="cat" id="cat">
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
    <div id="movie-wrapper" class="flex flex-wrap gap-7 w-44">

    </div>
</div>


<script src="js/categories.js"></script>
</body>
</html>