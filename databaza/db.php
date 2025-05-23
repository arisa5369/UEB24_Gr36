<?php
$host = 'localhost';
$port = '5432'; // porta standarde e PostgreSQL
$dbname = 'petfinder';
$user = 'postgres'; // verifiko emrin e saktë të përdoruesit
$password = '123';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Lidhja dështoi: " . pg_last_error());
}
?>
