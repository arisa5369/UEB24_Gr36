<?php
session_start();
require_once '../config.php';

// Funksion për të manipuluar wishlist-in dhe regjistruar veprimet në log
function modifikoWishlist($kafsha, $veprimi, $emri) {
    try {
        $logFile = fopen('logs/user_actions.log', 'a');
        if ($logFile === false) {
            throw new Exception("Nuk mund të hapet skedari log për veprimet!");
        }
        
        if ($veprimi == 'shto' && !in_array($kafsha, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'][] = $kafsha;
            fwrite($logFile, date('Y-m-d H:i:s') . " - Përdoruesi $emri shtoi $kafsha në wishlist\n");
            fclose($logFile);
            return ["success" => true, "message" => "Shtove $kafsha në wishlist!"];
        } elseif ($veprimi == 'fshi' && in_array($kafsha, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$kafsha]);
            fwrite($logFile, date('Y-m-d H:i:s') . " - Përdoruesi $emri fshiu $kafsha nga wishlist\n");
            fclose($logFile);
            return ["success" => true, "message" => "Fshive $kafsha nga wishlist!"];
        }
        fclose($logFile);
        return ["success" => true, "message" => "Asnjë ndryshim në wishlist."];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Gabim gjatë manipulimit të wishlist-it: " . $e->getMessage()];
    }
}

// Përpuno kërkesën AJAX
header('Content-Type: application/json');
if (isset($_POST['kafsha']) && isset($_POST['veprimi'])) {
    $emri = $_COOKIE['emri'] ?? 'Adoptues';
    $response = modifikoWishlist($_POST['kafsha'], $_POST['veprimi'], $emri);
    echo json_encode($response);
} else {
    echo json_encode(["success" => false, "message" => "Kërkesë e pavlefshme!"]);
}
?>