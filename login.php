<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.scss">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
<div class="h-full bg-black w-full flex  fixed">
    <div class="w-1/2 h-full bg-black flex flex-col justify-center items-center">
        <h1 class="text-white text-4xl">Welcome back !</h1>
        <h2 class="text-gray-500 text-sm pb-20">Please sign in to your account</h2>
        <form method="post" id="form">
            <input type="email" name="email" placeholder="E-mail" class="bg-gray-700 w-96 h-16 rounded-2xl text-center mb-6"><br>
            <input type="password" name="password" placeholder="Password" class="bg-gray-700 w-96 h-16 rounded-2xl text-center mb-6"><br>
            <input type="submit" value="Sign In" class="bg-blue-800 w-96 h-16 rounded-2xl text-center mb-6 text-white cursor-pointer">
        </form>
        <p class="text-white">Don't have an account ?<a href="register.php" class="text-blue-500"> Sign up</a></p>
    </div>
    <div class="w-1/2 h-full bg-slate-900"></div>
</div>

<?php
require_once 'connection.php';
require_once 'userconnect.php';
require_once 'user.php';


if ($_POST){
    $newco = new Userconnect (
        $_POST['email'],
        $_POST['password'],
    );
    $connection = new Connection();
    $co = $connection->connect($newco);

    if ($co){
        session_start();
        $_SESSION['email'] = $newco->email;
        header('Location: index.php');
    }   else {
        echo 'il y a une mistake';
    }
}
?>
</body>
</html>