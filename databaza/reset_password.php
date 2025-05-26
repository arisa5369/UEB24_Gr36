<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = pg_escape_string($_POST['verify-email']);
    $code = pg_escape_string($_POST['verify-code']);
    $new_password = $_POST['new-password'];
    $confirm_new_password = $_POST['confirm-new-password'];

   
    if ($new_password !== $confirm_new_password) {
        header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Passwords_do_not_match!");
        exit();
    }

    $stmt = pg_prepare($conn, "check_code", 
        "SELECT code, expires_at FROM password_resets WHERE email = $1 ORDER BY created_at DESC LIMIT 1");
    $result = pg_execute($conn, "check_code", array($email));

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        $stored_code = $row['code'];
        $expires_at = $row['expires_at'];

        if ($stored_code === $code && strtotime($expires_at) > time()) {
           
            $password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = pg_prepare($conn, "update_password", "UPDATE users SET pass = $1 WHERE email = $2");
            $result = pg_execute($conn, "update_password", array($password_hashed, $email));

            if ($result) {
                
                pg_query($conn, "DELETE FROM password_resets WHERE email = '$email'");
                header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?success=Password_reset_successfully!");
                exit();
            } else {
                header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Failed_to_update_password!");
                exit();
            }
        } else {
            header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Invalid_or_expired_code!");
            exit();
        }
    } else {
        header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Invalid_code!");
        exit();
    }
}

pg_close($conn);
?>