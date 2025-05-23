<?php
require_once 'User.php';

class AuthController
{
    private $usersFile = __DIR__ . '/users.json'; // file është në të njëjtin folder

    private function loadUsers()
    {
        if (!file_exists($this->usersFile)) {
            return [];
        }
        $json = file_get_contents($this->usersFile);
        return json_decode($json, true) ?? [];
    }

    private function saveUsers($users)
    {
        file_put_contents($this->usersFile, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function register($username, $email, $password)
    {
        $users = $this->loadUsers();

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return "Email already registered.";
            }
        }

        $newUser = new User($username, $email, $password);
        $users[] = [
            'username' => $newUser->username,
            'email' => $newUser->email,
            'password' => $newUser->password
        ];

        $this->saveUsers($users);
        return "User registered successfully!";
    }

    public function login($email, $password)
    {
        $users = $this->loadUsers();

        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                return "Login successful!";
            }
        }

        return "Invalid email or password.";
    }
}
