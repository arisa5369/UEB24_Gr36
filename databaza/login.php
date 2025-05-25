<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = pg_escape_string($_POST['login-username']);
    $password = $_POST['login-password'];

  
    $stmt = pg_prepare($conn, "select_user", "SELECT pass FROM users WHERE username = $1");
    if ($stmt) {
        $result = pg_execute($conn, "select_user", array($username));
        if ($result && pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            $stored_password = $row['pass'];

          
            if (password_verify($password, $stored_password)) {
                $_SESSION['username'] = $username;
                header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?success=Logged_in_successfully!");
                exit();
            } else {
                header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Invalid_password!");
                exit();
            }
        } else {
            header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Username_not_found!");
            exit();
        }
    } else {
        header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Database_error!");
        exit();
    }
}

pg_close($conn);
?>