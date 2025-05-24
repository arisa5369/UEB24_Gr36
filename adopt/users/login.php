<?php
require_once 'AuthController.php';

$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['login-email'] ?? '';
    $password = $_POST['login-password'] ?? '';

    $message = $auth->login($email, $password);
    echo $message;
} 