<?php
include 'db.php'; // Lidhja me databazën

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    // Merr përdoruesin nga databaza
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            echo "Mirësevini, " . $username . "!";
        } else {
            echo "Fjalëkalimi është i gabuar!";
        }
    } else {
        echo "Ky email nuk ekziston!";
    }

    $stmt->close();
    $conn->close();
}
?>
