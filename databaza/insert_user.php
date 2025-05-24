<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $firstName = pg_escape_string($_POST['firstName']);
    $lastName = pg_escape_string($_POST['lastName']);
    $username = pg_escape_string($_POST['username']);
    $email = pg_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';

    // Verify password match
    if ($password !== $confirm_password) {
        echo "Gabim: Fjalëkalimet nuk përputhen!";
        exit();
    }

    // Hash the password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query (assumes table 'users' has columns: firstName, lastName, username, email, pass)
    $stmt = pg_prepare($conn, "insert_user", "INSERT INTO users (firstName, lastName, username, email, pass) VALUES ($1, $2, $3, $4, $5)");
    if ($stmt) {
        $result = pg_execute($conn, "insert_user", array($firstName, $lastName, $username, $email, $password_hashed));
        if ($result) {
            header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?success=Llogaria_u_krijua_me_sukses!");
            exit();
        } else {
            $error = pg_last_error();
            if (strpos($error, 'unique constraint') !== false) {
                echo "Gabim: Email-i ose username tashmë ekziston!";
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