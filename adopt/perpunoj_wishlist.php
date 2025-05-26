<?php
session_start();
require_once 'config.php';
include '../databaza/db_connect.php';

$fallback_image = '/UEB24_Gr36/adopt/images/default_pet.jpg';

function getPetImage($image) {
    global $fallback_image;
    $base_path = '/UEB24_Gr36/adopt/';
    if (!empty($image) && file_exists($_SERVER['DOCUMENT_ROOT'] . $image)) {
        return $image;
    } elseif (!empty($image)) {
      
        $image_path = $base_path . 'images/' . basename($image);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $image_path)) {
            return $image_path;
        }
    }
    return $fallback_image;
}

function modifikoWishlist($kafsha, $veprimi, $emri) {
    try {
        $logFile = fopen(LOG_DIR . 'user_actions.log', 'a');
        if ($logFile === false) {
            throw new Exception("Nuk mund të hapet skedari log për veprimet!");
        }
        
        if ($veprimi == 'shto' && !in_array($kafsha, $_SESSION['wishlist'] ?? [])) {
            $_SESSION['wishlist'][] = $kafsha;
            fwrite($logFile, date('Y-m-d H:i:s') . " - Përdoruesi $emri shtoi $kafsha në wishlist\n");
            fclose($logFile);
            return ["success" => true, "message" => "Shtove $kafsha në wishlist!"];
        } elseif ($veprimi == 'fshi' && in_array($kafsha, $_SESSION['wishlist'] ?? [])) {
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

header('Content-Type: application/json');
if (isset($_POST['kafsha']) && isset($_POST['veprimi'])) {
    $emri = $_COOKIE['emri'] ?? 'Adoptues';
    $response = modifikoWishlist($_POST['kafsha'], $_POST['veprimi'], $emri);
    echo json_encode($response);
} elseif (isset($_GET['reload_wishlist'])) {
    header('Content-Type: text/html');
    if (empty($_SESSION['wishlist'])) {
        echo "<p style='color: #555;'>Asnjë kafshë e shtuar ende.</p>";
    } else {
        echo "<h2>Lista Jote e Preferencave</h2>";
        echo "<div class='wishlist-pets'>";
        $query = "SELECT p.name, p.type, p.image FROM pets p WHERE p.name = ANY($1)";
        $result = pg_query_params($conn, $query, [ '{' . implode(',', array_map('pg_escape_string', $_SESSION['wishlist'])) . '}' ]);
        while ($row = pg_fetch_assoc($result)) {
            $isFavorite = in_array($row['name'], $_SESSION['wishlist']) ? 'favorite' : '';
            $image = getPetImage($row['image']);
            echo "<div class='pet-card'>";
            echo "<img src='".htmlspecialchars($image)."' alt='".htmlspecialchars($row['name'])."' class='pet-image' data-link='/UEB24_Gr36/adopt/".strtolower($row['type'])."s/".strtolower($row['type']).".php?name=".urlencode($row['name'])."'>";
            echo "<p>".htmlspecialchars($row['name'])."</p>";
            echo "<button class='heart-button $isFavorite' data-pet='".htmlspecialchars($row['name'])."' title='Fshi nga Wishlist'>";
            echo '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
            echo "</button>";
            echo "</div>";
        }
        echo "</div>";
        echo "<ul>";
        foreach ($_SESSION['wishlist'] as $kafsha) {
            echo "<li>";
            echo htmlspecialchars($kafsha);
            echo "<button class='remove-button' data-pet='".htmlspecialchars($kafsha)."' title='Fshi nga Wishlist'>✖</button>";
            echo "</li>";
        }
        echo "</ul>";
    }
    pg_close($conn);
} else {
    echo json_encode(["success" => false, "message" => "Kërkesë e pavlefshme!"]);
}
?>