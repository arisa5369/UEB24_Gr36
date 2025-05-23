<?php
include 'db_connect.php';

$sql = "SELECT * FROM users";
$result = pg_query($conn, $sql);

if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . " - Username: " . $row['username'] . " - Email: " . $row['email'] . "<br>";
    }
} else {
    echo "Nuk ka përdorues.";
}

pg_close($conn);
?>