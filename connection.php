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
        $query1 = 'DELETE FROM film
                  WHERE album_id = :id';

        $statement1 = $this->pdo->prepare($query1);

        $statement1->execute([
            'id' => $id,
        ]);

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

    public function deleteMovieFromAlbum(int $id): bool
    {
        $query = 'DELETE FROM film WHERE film_id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'id' => $id,
        ]);
    }

    public function getAllProfiles(): array
    {
        $query = 'SELECT * FROM user';

        $statement= $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserAlbumPublic($userId): array
    {
        $query = "SELECT * FROM album WHERE user_id = '$userId' AND is_Private = 1";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getnameprofile($id)
    {
        $query = "SELECT * FROM user WHERE id = '$id'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $board = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $board;
    }

    public function addLike(like $like): bool
    {
        $query = 'INSERT INTO `like` (album_id, user_id)
                  VALUES (:albumId, :userId)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'albumId' => $like->albumId,
            'userId' => $like->userId,
        ]);
    }

    public function getAlbumLikeFromUser($userId): array
    {
        $query = "SELECT album_id FROM `like` WHERE user_id = '$userId'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAlbumFromAlbumId($albumId): array
    {
        $query = "SELECT * FROM album WHERE id = '$albumId'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function insertSharedAlbum(sharedAlbum $sharedAlbum):bool
    {
        $query = "INSERT INTO shared_album ( album_id, owner_id, shared_with)
                  VALUES (:albumId, :ownerId, :sharedId) ";

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'albumId' => $sharedAlbum->albumId,
            'ownerId' => $sharedAlbum->ownerId,
            'sharedId' => $sharedAlbum->sharedId,
        ]);
    }

    public function getInvitation($userId): array
    {
        $query = "SELECT * FROM shared_album WHERE shared_with = '$userId'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function refuseInvit(int $id): bool
    {
        $query = 'DELETE FROM shared_album
                  WHERE id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'id' => $id,
        ]);
    }

    public function acceptInvit(int $id): bool
    {
        $query = 'UPDATE shared_album SET acceptation = 1 WHERE id = :id';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'id' => $id,
        ]);
    }

    public function getSharedAlbums($userId): array
    {
        $query = "SELECT * FROM shared_album WHERE shared_with = '$userId' AND acceptation = 1";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getIfAnAlbumIsLiked($albumId, $userId): array
    {
        $query = "SELECT * FROM `like` WHERE album_id = '$albumId' AND user_id = '$userId'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteLike($albumId, $userId): bool
    {
        $query = "DELETE FROM `like` WHERE album_id = '$albumId' AND user_id = '$userId'";

        $statement = $this->pdo->prepare($query);

        if ($statement->execute()) {
            return true;
        }   else {
            return false;
        }

    }

    public function checkIfAlbumsUser($userId): array
    {
        $query = "SELECT * FROM album WHERE user_id = '$userId'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAlbumsAtRegister($userId): bool
    {

        $query = 'INSERT INTO album (name, is_private, user_id)
                  VALUES (:name, :is_private, :user_id),
                         ( :name2, :is_private2, :user_id2)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'name' => 'visionés',
            'is_private' => 1,
            'user_id' => $userId,
            'name2' => 'liste d\'envies',
            'is_private2' => 1,
            'user_id2' => $userId,
        ]);

    }

    public function deleteFilmsFromSharedAlbumIfYouAreNotTheOwner($albumId): array
    {
        $query = "SELECT * FROM shared_album WHERE album_id = '$albumId'";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

}

