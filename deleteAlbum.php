<?php

if (isset($_GET['id'])) {
    require_once 'connection.php';

    $connection = new Connection();
    $connection->deleteAlbum($_GET['id']);

    header('Location: profile.php');
}
