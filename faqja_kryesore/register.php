<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    class User
    {
        private $username;
        private $email;
        private $password;

        public function __construct($username, $email, $password)
        {
            $this->username = $username;
            $this->email = $email;
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }

        public function save()
        {
            $userData = [
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password,
            ];


            $existingUsers = file_exists('users.json') ? json_decode(file_get_contents('users.json'), true) : [];


            $existingUsers[] = $userData;


            file_put_contents('users.json', json_encode($existingUsers, JSON_PRETTY_PRINT));
        }
    }

    $user = new User($username, $email, $password);
    $user->save();

    echo "Përdoruesi është regjistruar me sukses!";
}
