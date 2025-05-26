<?php
file_put_contents('debug.txt', file_get_contents('php://input'));
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Konfigurimi i PostgreSQL
$host = "localhost";
$port = "5432";
$dbname = "Petfinder";  // Emri i bazës së të dhënave
$user = "postgres";
$password = "123";

try {
    // Lidhja me PostgreSQL
    $conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
    $conn = pg_connect($conn_string);

    if (!$conn) {
        throw new Exception("Lidhja me PostgreSQL dështoi: " . pg_last_error());
    }

    // Merr të dhënat nga forma (përdor php://input për POST)
   $donation_type = $_POST['donation-type'] ?? '';
    $amount = $_POST['amount'] ?? 0;
    $donor_name = $_POST['donor-name'] ?? '';
    $donor_email = $_POST['donor-email'] ?? '';
   

    // Validimi
    if (empty($donation_type)) {  // Kllapa mbyllëse për empty()
    throw new Exception("Lloji i donacionit është i zbrazët");
}  // Kllapa mbyllëse për if

    if (!is_numeric($amount) || $amount <= 0) {
        throw new Exception("Shuma e donacionit është e pavlefshme");
    }

    // SQL për tabelën donation_db
    $sql = "INSERT INTO donation (donation_type, amount, donor_name, donor_email, donation_date) 
        VALUES ($1, $2, $3, $4, NOW()) RETURNING id";


    $result = pg_query_params($conn, $sql, [
        $donation_type,
        $amount,
        $donor_name,
        $donor_email
    ]);

    if (!$result) {
        throw new Exception("Gabim në ruajtje: " . pg_last_error($conn));
    }

    echo json_encode([
        "success" => true,
        "message" => "Faleminderit për donacionin!",
        "donation_id" => pg_fetch_result($result, 0, 0)
    ]);

} catch (Exception $e) {
 http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage(),
        "error_details" => [
            "input_data" => $_POST ?? file_get_contents('php://input')
        ]
    ]);
} finally {
    if (isset($conn)) {
        pg_close($conn);
    }
}
?>