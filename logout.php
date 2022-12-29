<?php
ini_set('display_errors', 'on');

session_start();
session_destroy();
header('Location: index.php');
exit;
?>