<?php
session_start();
// Buffer output to catch any unexpected output
ob_start();
include '../databaza/db_connect.php'; 

header('Content-Type: application/json');

if (!$conn) {
    ob_end_clean(); // Clear any output buffer
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$pet_id = isset($_POST['pet_id']) ? (int)$_POST['pet_id'] : 0;
$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($pet_id <= 0 || $user_id <= 0 || $action !== 'adopt') {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

// First check if the pet is already adopted
$check_query = "SELECT 1 FROM adopted_pets WHERE pet_id = $1";
$check_result = pg_prepare($conn, "check_query", $check_query);
if (!$check_result) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Failed to prepare check query']);
    exit;
}
$check_result = pg_execute($conn, "check_query", [$pet_id]);
if (!$check_result) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Failed to execute check query']);
    exit;
}

if (pg_num_rows($check_result) > 0) {
    ob_end_clean();
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
    $create_result = pg_query($conn, $create_table);
    if (!$create_result) {
        throw new Exception("Failed to create adopted_pets table: " . pg_last_error($conn));
    }
    
    // 2. Insert into adopted_pets table
    $insert_query = "INSERT INTO adopted_pets (pet_id, user_id) VALUES ($1, $2)";
    $insert_result = pg_prepare($conn, "insert_query", $insert_query);
    if (!$insert_result) {
        throw new Exception("Failed to prepare insert query: " . pg_last_error($conn));
    }
    $insert_result = pg_execute($conn, "insert_query", [$pet_id, $user_id]);
    if (!$insert_result) {
        throw new Exception("Failed to record adoption: " . pg_last_error($conn));
    }
    
    // 3. Remove from wishlist if present
    $delete_wishlist = "DELETE FROM wishlist WHERE pet_id = $1 AND user_id = $2";
    $delete_result = pg_prepare($conn, "delete_wishlist", $delete_wishlist);
    if (!$delete_result) {
        throw new Exception("Failed to prepare wishlist delete query: " . pg_last_error($conn));
    }
    $delete_result = pg_execute($conn, "delete_wishlist", [$pet_id, $user_id]);
    if (!$delete_result) {
        throw new Exception("Failed to delete from wishlist: " . pg_last_error($conn));
    }
    
    // 4. Update $_SESSION['wishlist'] to reflect the database state
    $wishlist_query = "SELECT p.name FROM wishlist w JOIN pets p ON w.pet_id = p.id WHERE w.user_id = $1";
    $wishlist_result = pg_prepare($conn, "wishlist_select", $wishlist_query);
    if (!$wishlist_result) {
        throw new Exception("Failed to prepare wishlist select query: " . pg_last_error($conn));
    }
    $wishlist_result = pg_execute($conn, "wishlist_select", [$user_id]);
    if (!$wishlist_result) {
        throw new Exception("Failed to select wishlist: " . pg_last_error($conn));
    }
    $_SESSION['wishlist'] = [];
    while ($row = pg_fetch_assoc($wishlist_result)) {
        $_SESSION['wishlist'][] = $row['name'];
    }
    
    // Commit transaction
    pg_query($conn, "COMMIT");
    
    ob_end_clean();
    echo json_encode(['success' => true, 'message' => 'Adoption successful']);
} catch (Exception $e) {
    // Rollback on error
    pg_query($conn, "ROLLBACK");
    $pg_error = pg_last_error($conn);
    error_log("Adoption error: " . $e->getMessage() . " | PG Error: " . $pg_error);
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => $e->getMessage() . ' (PG: ' . $pg_error . ')']);
}

pg_free_result($check_result);
pg_free_result($wishlist_result);
pg_close($conn);
?>