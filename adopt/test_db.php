<?php
include '../databaza/db_connect.php';
if ($conn) {
    echo "Connection successful";
} else {
    echo "Connection failed: " . (pg_last_error() ?: 'No specific error message');
}
pg_close($conn);
?>