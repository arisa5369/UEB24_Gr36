<?php
include 'db.php'; 

$id = 1; 

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Përdoruesi u fshi me sukses!";
} else {
    echo "Gabim gjatë fshirjes: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
