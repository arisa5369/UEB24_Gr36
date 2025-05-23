<?php
$host = 'localhost';
$port = '5432';
$dbname = 'Petfinder';
$user = 'postgres';
$password = '123'; 

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Lidhja dështoi: " . pg_last_error());
}

?>