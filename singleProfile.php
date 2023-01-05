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

$profileId = $connection->get('userId');

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
                    <li class="mb-4 flex"><img src="image/account.png" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="myProfile.php">My Account</a></li>
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


    <div class=" w-screen h-screen bg-slate-900 ml-60">
        <?php

        $getProfileInfo = $connection->getUserAlbumPublic($profileId);

        $getNameProfile = $connection->getnameprofile($profileId);

        $profileName['username'] = $getNameProfile[0]["username"] ;


        ?>

        <h1 class="text-white">profil : <?= $profileName['username'] ?></h1>
        <p class="text-white">Ses albums :</p>
        <div class="flex gap-3 text-white">
            <?php



            foreach ($getProfileInfo as $album) {
                echo '<div class="flex flex-col border px-6 py-3">';
                echo '<p class="text-xs">';
                echo '</p>';
                echo '<p class="text-xl mb-6">' . $album['name'] . '</p>';
                echo '<a href="albumSingle.php?albumId=' . $album['id'] . '&albumName=' . $album['name'] . '">Voir</a>';
                echo '</div>';
            }

            ?>
        </div>
    </body>
    </html>
<?php
