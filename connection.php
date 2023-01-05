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

    public function getinfo($email)
    {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $board = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $board;
    }

    public function get ($param): string
    {
        $result = $_GET[$param];
        return $result;

    }

    public function insertAlbum(Album $album): bool
    {
        $query = 'INSERT INTO album (name, is_private, user_id)
                  VALUES (:name, :is_private, :id)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'name' => $album->name,
            'is_private' => $album->is_private,
            'id' => $album->user_id,
        ]);
    }

    public function getUserAlbum($userId): array
    {
        $query = "SELECT * FROM album WHERE user_id = '$userId'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteAlbum(int $id): bool
    {
        $query = 'DELETE FROM album
                  WHERE id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'id' => $id,
        ]);
    }

    public function addMovie(movie $movie): bool
    {
        $query = 'INSERT INTO film (album_id, film_id)
                  VALUES (:albumId, :movieId)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'albumId' => $movie->albumId,
            'movieId' => $movie->movieId,
        ]);
    }

    public function getMovieFromAlbum($albumId): array
    {
        $query = "SELECT * FROM film WHERE album_id = '$albumId'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


}

