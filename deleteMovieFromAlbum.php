<?php

if (isset($_GET['id'])) {
    require_once 'connection.php';

    $connection = new Connection();
    $connection->deleteMovieFromAlbum($_GET['id']);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
