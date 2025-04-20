<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    
    $existingUsers = file_exists('users.json') ? json_decode(file_get_contents('users.json'), true) : [];

    foreach ($existingUsers as $user) {
        if ($user['email'] == $email && password_verify($password, $user['password'])) {
           
            echo "Mirësevini, " . $user['username'] . "!";
            exit;
        }
    }

    echo "Email ose fjalëkalimi i gabuar!";
}
?>
