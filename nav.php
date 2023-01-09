<div id="nav" class="max-[425px]:hidden h-full bg-black w-60 flex flex-col fixed top-0 z-40">
    <iconify-icon id="closeBtn" icon="akar-icons:cross" class="hidden max-[425px]:block text-4xl text-white mr-3 ml-48 mt-4"></iconify-icon>
    <div class="flex justify-center">
        <ul class="text-white mt-24 text-2xl">
            <li class="mb-4
            <?php
                if (isset($isHome)){
                    echo 'text-yellow-400';
                }
            ?> flex"><img src="
                <?php
                    if (isset($isHome)){
                        echo 'image/homeyellow.png';
                    }else {
                        echo 'image/home.png';
                    }
                ?>" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="index.php">Home</a></li>
            <li class="mb-4
            <?php
            if (isset($isCat)){
                echo 'text-yellow-400 ';
            }
            ?>flex"><img src="
            <?php
                if (isset($isCat)){
                    echo 'image/fichiersyellow.png';
                }else {
                    echo 'image/fichiers.png';
                }
                ?>" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="categories.php">Categories</a></li>
        </ul>
    </div>
    <hr class="border-slate-500 w-40 ml-12 mt-5">
    <div class="flex justify-center">
        <?php
        if ($_SESSION){ ?>
            <ul class="text-white mt-10 text-2xl gap-24">
                <li class="mb-4 flex <?php
                if (isset($isMyPro)){
                    echo 'text-yellow-400 ';
                }
                ?>"><img src="
                <?php
                    if (isset($isMyPro)){
                        echo 'image/accountyellow.png';
                    }else {
                        echo 'image/account.png';
                    }
                    ?>" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="myProfile.php">My Account</a></li>
                <li class="flex <?php
                if (isset($isAllPro)){
                    echo 'text-yellow-400 ';
                }
                ?>"><img src="
                <?php
                    if (isset($isAllPro)){
                        echo 'image/friendsyellow.png';
                    }else {
                        echo 'image/friends.png';
                    }
                    ?>" alt="home" class="w-6 h-6 mt-0.5 mr-2"><a href="allProfiles.php">All Profiles</a></li>
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