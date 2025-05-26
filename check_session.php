<?php
session_start();
header('Content-Type: application/json');

$response = [
    'loggedin' => false,
    'user_id' => null,
    'username' => null
];

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $response['loggedin'] = true;
    $response['user_id'] = $_SESSION['user_id'];
    $response['username'] = $_SESSION['username'];
}

echo json_encode($response);
exit;
?>