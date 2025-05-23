<?php
include 'db.php'; // Kjo lidh projektin me databazën

$sql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'users' u krijua me sukses.";
} else {
    echo "Gabim në krijimin e tabelës: " . $conn->error;
}

$conn->close();
?>
