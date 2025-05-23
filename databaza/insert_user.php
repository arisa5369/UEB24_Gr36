<?php
include 'db.php'; // Lidhja me databazën

$username = 'ari';
$email = 'ari@example.com';
$password = password_hash('sekret123', PASSWORD_DEFAULT); // Enkriptimi i fjalëkalimit

// Përdor prepared statements për siguri
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "Përdoruesi u shtua me sukses!";
} else {
    echo "Gabim gjatë futjes: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
