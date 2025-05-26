<?php
session_start();
include '../../databaza/db_connect.php';

header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$pet_id = isset($_POST['pet_id']) ? (int)$_POST['pet_id'] : 0;
$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($pet_id <= 0 || $user_id <= 0 || $action !== 'adopt') {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

// First check if the pet is already adopted
$check_query = "SELECT 1 FROM adopted_pets WHERE pet_id = $1";
$check_result = pg_prepare($conn, "check_query", $check_query);
$check_result = pg_execute($conn, "check_query", [$pet_id]);

if (pg_num_rows($check_result) > 0) {
    echo json_encode(['success' => false, 'message' => 'This pet has already been adopted']);
    exit;
}

// Begin transaction
pg_query($conn, "BEGIN");

try {
    // 1. Create adopted_pets table if it doesn't exist
    $create_table = "CREATE TABLE IF NOT EXISTS adopted_pets (
        id SERIAL PRIMARY KEY,
        pet_id INT NOT NULL UNIQUE,
        user_id INT NOT NULL,
        adoption_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    pg_query($conn, $create_table);
    
    // 2. Insert into adopted_pets table
    $insert_query = "INSERT INTO adopted_pets (pet_id, user_id) VALUES ($1, $2)";
    $insert_result = pg_prepare($conn, "insert_query", $insert_query);
    $insert_result = pg_execute($conn, "insert_query", [$pet_id, $user_id]);
    
    if (!$insert_result) {
        throw new Exception("Failed to record adoption");
    }
    
    // 3. Remove from wishlist if present
    $delete_wishlist = "DELETE FROM wishlist WHERE pet_id = $1 AND user_id = $2";
    $delete_result = pg_prepare($conn, "delete_wishlist", $delete_wishlist);
    $delete_result = pg_execute($conn, "delete_wishlist", [$pet_id, $user_id]);
    
    // Commit transaction
    pg_query($conn, "COMMIT");
    
    echo json_encode(['success' => true, 'message' => 'Adoption successful']);
} catch (Exception $e) {
    // Rollback on error
    pg_query($conn, "ROLLBACK");
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

pg_close($conn);
?>