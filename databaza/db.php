<?php
$host = 'localhost';
$user = 'root';
$password = ''; // ose fjalëkalimi yt
$dbname = 'emri_database';

$conn = new mysqli($host, $user, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}
?>
