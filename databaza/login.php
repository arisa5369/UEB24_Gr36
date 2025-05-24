<?php
session_start(); // Fillojmë sesionin për të ruajtur të dhënat e përdoruesit pas login-it
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = pg_escape_string($_POST['login-email']);
    $password = $_POST['login-password'];

    // Kërko përdoruesin me këtë email në databazë
    $stmt = pg_prepare($conn, "select_user", "SELECT * FROM users WHERE email = $1");
    if ($stmt) {
        $result = pg_execute($conn, "select_user", array($email));
        if ($result && pg_num_rows($result) > 0) {
            // Email-i ekziston, merr të dhënat e përdoruesit
            $user = pg_fetch_assoc($result);
            $stored_password = $user['pass'];

            // Verifiko fjalëkalimin
            if (password_verify($password, $stored_password)) {
                // Login i suksesshëm, ruaj të dhënat në sesion
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                // Ridrejto te index1.php me mesazh suksesi
                header("Location: /UEB24_GR36/faqja_kryesore/index1.php?success=Ju u loguat me sukses!");
                exit();
            } else {
                echo "Gabim: Fjalëkalimi është i pasaktë!";
            }
        } else {
            echo "Gabim: Email-i nuk ekziston! Ju lutem regjistrohuni së pari.";
        }
    } else {
        echo "Gabim gjatë përgatitjes së komandës: " . pg_last_error();
    }
}

pg_close($conn);
?>