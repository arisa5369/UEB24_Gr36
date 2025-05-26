<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = pg_escape_string($conn, $_POST['login-username']);
    $password = $_POST['login-password'];

    // Prepare and execute the query to get user details
    $stmt = pg_prepare($conn, "select_user", "SELECT id, username, pass FROM users WHERE username = $1");
    if ($stmt) {
        $result = pg_execute($conn, "select_user", array($username));
        if ($result && pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            $stored_password = $row['pass'];
            $user_id = $row['id'];

            // Verify the password
            if (password_verify($password, $stored_password)) {
                // Set session variables expected by dog.php
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;

                // Check for redirect parameter; default to index1.php if not set
                $redirect = isset($_GET['redirect']) ? urldecode($_GET['redirect']) : '/UEB24_Gr36/faqja_kryesore/index1.php?success=Logged_in_successfully!';
                header("Location: $redirect");
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