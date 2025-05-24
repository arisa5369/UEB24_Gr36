<?php
header('Content-Type: application/json');

// Lidhja me bazën e të dhënave (ndrysho kredencialet sipas nevojës)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "donation_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Lidhja dështoi: " . $conn->connect_error]));
}

// Merr të dhënat nga forma (përdor filter_input për siguri)
$donation_type = filter_input(INPUT_POST, 'donation-type', FILTER_SANITIZE_STRING);
$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$donor_name = filter_input(INPUT_POST, 'donor-name', FILTER_SANITIZE_STRING);
$donor_email = filter_input(INPUT_POST, 'donor-email', FILTER_SANITIZE_EMAIL);

// Valido shumën
if (!$amount || $amount <= 0) {
    echo json_encode(["success" => false, "message" => "Shuma jo valide"]);
    exit;
}

// Futja në bazën e të dhënave
$sql = "INSERT INTO donations (donation_type, amount, donor_name, donor_email, donation_date) 
        VALUES (?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sdss", $donation_type, $amount, $donor_name, $donor_email);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Faleminderit për donacionin!"]);
} else {
    echo json_encode(["success" => false, "message" => "Gabim në ruajtje: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>