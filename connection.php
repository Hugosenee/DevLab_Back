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
}

