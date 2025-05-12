<?php
include 'db.php'; // Lidhja me databazën

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Përdor prepared statement për siguri
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Përdoruesi është regjistruar me sukses!";
    } else {
        echo "Gabim gjatë regjistrimit: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
