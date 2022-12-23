
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.scss">
    <title>Home</title>
</head>
<body class="flex">
<div class="h-screen w-60 bg-navbar flex flex-col fixed top-0">
    <div class="flex justify-center">
        <ul class="text-white mt-24 text-2xl">
            <li class="mb-4 text-yellowactive flex"><img src="image/homeyellow.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Home</li>
            <li class="mb-4 flex"><img src="image/fichiers.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Categories</li>
            <li class="mb-4 flex"><img src="image/boussole.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Discovery</li>
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
            <a href="register.php" ><li class="flex"><img src="image/register.png" alt="home" class="w-6 h-6 mt-0.5 mr-2">Register</li></a>
        </ul>
    </div>
</div>
<div class=" w-screen bg-bgblue ml-60">
    <div class=" flex flex-col">
        <div class="flex justify-end mt-6 mr-12">
            <div class="h-10 w-80 bg-gray-400 rounded-3xl flex justify-between mr-4">
                <input type="text" placeholder="Recherche" class="w-full bg-gray-400 rounded-3xl text-white text-center">
                <img src="image/search.png" alt="search" class="w-6 h-6 mt-2 mr-4">
            </div>
            <img src="image/notification.png" alt="notification" class="h-8 w-8 mt-1">
        </div>
        <div class="flex justify-center">
            <div class="w-3/4 h-72 bg-gray-400 mt-10 rounded-3xl overflow-hidden">
                <img src="image/spiderman.jpg" alt="affiche spiderman">
            </div>
        </div>
    </div>
    <div class=" w-full h-64 mt-10">
        <p class="text-white text-2xl ml-40 mb-8">Trends :</p>
        <div id="movie-trend-wrapper" class="flex gap-10 justify-center">

            <div class="bg-navbar w-40 h-48 rounded-2xl"></div>
        </div>
    </div>

    <div class=" w-full h-64 mt-10">
        <p class="text-white text-2xl ml-40 mb-8">All TV Shows :</p>
        <div id="tv-trend-wrapper" class="flex gap-10 justify-center">

        </div>
    </div>
</div>
<script src="main.js"></script>
</body>
</html>