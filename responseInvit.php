<?php
require_once 'connection.php';

$connection = new Connection();
$response = $connection->get("response");
$invitId = $connection->get("invitId");

if ($response == 1) {
    $acceptInvit = $connection->acceptInvit($invitId);
    header('Location: myProfile.php');

}else {
    $refuseInvit = $connection->refuseInvit($invitId);
    header('Location: myProfile.php');
}
