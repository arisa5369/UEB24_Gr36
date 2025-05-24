<?php
include 'db.php'; 

$id = 1; 
$newEmail = 'new@example.com';

$stmt = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
$stmt->bind_param("si", $newEmail, $id);

if ($stmt->execute()) {
    echo "Email-i u përditësua me sukses!";
} else {
    echo "Gabim gjatë përditësimit: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
