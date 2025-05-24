<?php
include 'db_connect.php'; 

$sql = "CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL
)";

if (pg_query($conn, $sql)) {
    echo "Tabela 'users' u krijua me sukses!";
} else {
    echo "Gabim gjatë krijimit të tabelës: " . pg_last_error();
}

pg_close($conn);
?>