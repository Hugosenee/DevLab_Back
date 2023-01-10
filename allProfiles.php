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
$isAllPro = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.scss">
    <title>Profiles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</head>
<body class="flex">
<!-- side bar -->
<?php
require('nav.php');
?>
<!-- content -->
<div class="max-[425px]:ml-0 max-[425px]:h-auto w-screen h-screen bg-slate-900 ml-60 ">

    <iconify-icon icon="charm:menu-hamburger" id="burgerBtn" class="hidden max-[425px]:block text-4xl text-white absolute top-5 left-5"></iconify-icon>
    <p class="text-center font-bold text-5xl mt-5 mb-10 text-white">Tous les profils</p>
    <div class="flex flex-wrap justify-around">
        <?php

        $allProfiles = $connection->getAllProfiles();

        foreach ($allProfiles as $profile) {
            echo '<div class="flex flex-col h-96 w-48 bg-slate-800 rounded-2xl items-center mt-5">';
                echo '<img class="rounded-full w-3/5 mt-10" src="image/profile.jpg">';
                echo '<p class="text-white mt-7 text-center font-bold">' . $profile['username'] . '</p>';
                echo '<a class="text-white text-center mt-36" href="singleProfile.php?userId=' . $profile['id'] . '">Voir le profil</a>';
            echo '</div>';
        }


        ?>
    </div>

</div>
<script src="js/burger.js"></script>

</body>
</html>
