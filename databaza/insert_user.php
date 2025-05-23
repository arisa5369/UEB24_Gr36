<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = pg_escape_string($_POST['username']);
    $email = pg_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = pg_prepare($conn, "insert_user", "INSERT INTO users (username, email, pass) VALUES ($1, $2, $3)");
    if ($stmt) {
        $result = pg_execute($conn, "insert_user", array($username, $email, $password));
        if ($result) {
            echo "Përdoruesi u shtua me sukses!";
        } else {
            $error = pg_last_error();
            if (strpos($error, 'unique constraint') !== false) {
                echo "Gabim: Email-i tashmë ekziston!";
            } else {
                echo "Gabim gjatë shtimit të përdoruesit: " . $error;
            }
        }
    } else {
        echo "Gabim gjatë përgatitjes së komandës: " . pg_last_error();
    }
}

pg_close($conn);
?>