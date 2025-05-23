<?php
include 'db_connect.php';

if ($conn) {
    echo "Lidhja me databazën PostgreSQL u krye me sukses!";
} else {
    echo "Lidhja dështoi.";
}

pg_close($conn);
?>