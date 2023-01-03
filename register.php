<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.scss">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register</title>
</head>
<body>
<div class="h-full bg-black w-full flex  fixed">
    <div class="w-1/2 h-full bg-black flex flex-col justify-center items-center">
        <h1 class="text-white text-4xl">Create a new account</h1>
        <h2 class="text-gray-500 text-sm pb-20">Please fill the form to continue</h2>
        <form method="post" id="form">
            <input type="email" name="email" placeholder="E-mail" class="bg-gray-700 w-96 h-16 rounded-2xl text-center mb-6"><br>
            <input type="text" name="username" placeholder="username" class="bg-gray-700 w-96 h-16 rounded-2xl text-center mb-6"><br>
            <input type="password" name="password1" placeholder="Password" class="bg-gray-700 w-96 h-16 rounded-2xl text-center mb-6"><br>
            <input type="password" name="password2" placeholder="Password (retype)" class="bg-gray-700 w-96 h-16 rounded-2xl text-center mb-6"><br>
            <input type="submit" value="Sign Up" class="bg-blue-800 w-96 h-16 rounded-2xl text-center mb-6 text-white cursor-pointer">
        </form>
        <p class="text-white">Already have an account ?<a href="login.php" class="text-blue-500"> Login</a></p>
    </div>
    <div class="w-1/2 h-full bg-slate-900"></div>
</div>


<?php
require_once 'user.php';
require_once 'connection.php';


if ($_POST) {
    $user = new User(
        $_POST['email'],
        $_POST['username'],
        $_POST['password1'],
        $_POST['password2']
    );
    if ($user->verify()) {
        $connection = new Connection();
        $result = $connection->insert($user);

        if ($result) {
            header('Location: login.php');
        } else {
            echo 'Internal error 🥲';
        }
    } else {
        echo 'Form has an error';
    }


}
?>
</body>
</html>