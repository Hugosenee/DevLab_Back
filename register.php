<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.scss">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
<h1>Register an account</h1>
<form method="post" id="form">
    <input type="email" name="email" placeholder="E-mail" class="form-control"><br>
    <input type="text" name="username" placeholder="username" class="form-control"><br>
    <input type="password" name="password1" placeholder="Password" class="form-control"><br>
    <input type="password" name="password2" placeholder="Password (retype)" class="form-control"><br>
    <input type="submit" value="Register" class="btn btn-primary">
</form>

<p>Already have an account ?<a href="connectaccount.php">Login</a></p>

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
            header('Location: index.php');
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