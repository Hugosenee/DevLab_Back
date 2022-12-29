<?php

class Connection
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=tmdb;host=127.0.0.1', 'root', '');
    }

    public function insert(User $user): bool
    {
        $query = 'INSERT INTO user (email, username, password)
                  VALUES (:email, :username, :password)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'email' => $user->email,
            'username' => $user->username,
            'password' => md5($user->password . 'MY_SUPER_SALT'),
        ]);
    }

    public function connect(Userconnect $user): bool
    {
        $query = "SELECT password FROM user WHERE email = '$user->email'";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $tableau = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(md5($user->password . 'MY_SUPER_SALT') == $tableau[0]['password']){
            return true;
        }   else {
            return false;
        }
    }

    public function getid($email): array
    {
        $query = "SELECT * FROM user WHERE email = '$email'";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $board = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $board;
    }
}

