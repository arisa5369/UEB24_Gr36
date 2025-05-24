<?php
session_start();
require_once 'config.php';

// Përpuno kërkesën AJAX
header('Content-Type: application/json');
if (isset($_POST['kafsha']) && isset($_POST['veprimi'])) {
    $emri = $_COOKIE['emri'] ?? 'Adoptues';
    $response = modifikoWishlist($_POST['kafsha'], $_POST['veprimi'], $emri);
    echo json_encode($response);
} elseif (isset($_GET['reload_wishlist'])) {
    // Përgjigje për të rifreskuar wishlist-in
    header('Content-Type: text/html');
    if (empty($_SESSION['wishlist'])) {
        echo "<p style='color: #555;'>Asnjë kafshë e shtuar ende.</p>";
    } else {
        echo "<h2>Lista Jote e Preferencave</h2><ul>";
        foreach ($_SESSION['wishlist'] as $kafsha) {
            echo "<li>" . htmlspecialchars($kafsha) . "</li>";
        }
        echo "</ul>";
    }
} else {
    echo json_encode(["success" => false, "message" => "Kërkesë e pavlefshme!"]);
}
?>