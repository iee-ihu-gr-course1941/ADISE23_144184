<?php
require_once 'CustomSessionHandler.php';

$sessionHandler = new CustomSessionHandler();

// Get all session values
$sessionData = $_SESSION;

$player1score = $sessionHandler->getSessionData('player1score');
$player2score = $sessionHandler->getSessionData('player2score');

if (!isset($player1score)) {
    $sessionHandler->setSessionData('player1score', 0);
}

if (!isset($player2score)) {
    $sessionHandler->setSessionData('player2score', 0);
}
// Output as JSON
header('Content-Type: application/json');
echo json_encode($sessionData);
?>
