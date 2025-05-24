<?php
session_start();
require_once 'config.php';

// Funksion për të manipuluar wishlist-in dhe regjistruar veprimet në log
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

// Përpuno kërkesën AJAX
header('Content-Type: application/json');
if (isset($_POST['kafsha']) && isset($_POST['veprimi'])) {
    $emri = $_COOKIE['emri'] ?? 'Adoptues';
    $response = modifikoWishlist($_POST['kafsha'], $_POST['veprimi'], $emri);
    echo json_encode($response);
} elseif (isset($_GET['reload_wishlist'])) {
    // Përgjigje për të rifreskuar wishlist-in
    header('Content-Type: text/html');
    $kafshe = [
        ['emri' => 'Buddy', 'lloji' => 'Qen', 'mosha' => 'I ri', 'imazh' => 'images/dog1.avif', 'link' => '/UEB24_Gr36/adopt/dogs/dog.html?name=Buddy'],
        ['emri' => 'Tom', 'lloji' => 'Mace', 'mosha' => 'I rritur', 'imazh' => 'images/cat1.jpg', 'link' => '/UEB24_Gr36/adopt/cats/cat.html?name=Tom'],
        ['emri' => 'Houdini', 'lloji' => 'Lepur', 'mosha' => 'I ri', 'imazh' => 'images/rabbit1.jpg', 'link' => '/UEB24_Gr36/adopt/rabbits/rabbit.html?name=Houdini'],
        ['emri' => 'Bruno', 'lloji' => 'Zog', 'mosha' => 'I vjetër', 'imazh' => 'images/bird1.jpg', 'link' => '/UEB24_Gr36/adopt/birds/bird.html?name=Bruno'],
    ];
    if (empty($_SESSION['wishlist'])) {
        echo "<p style='color: #555;'>Asnjë kafshë e shtuar ende.</p>";
    } else {
        echo "<h2>Lista Jote e Preferencave</h2>";
        echo "<div class='wishlist-pets'>";
        foreach ($kafshe as $kafsha) {
            if (in_array($kafsha['emri'], $_SESSION['wishlist'])) {
                $isFavorite = 'favorite';
                echo "<div class='pet-card'>";
                echo "<img src='".htmlspecialchars($kafsha['imazh'])."' alt='".htmlspecialchars($kafsha['lloji'])."' class='pet-image' data-link='".htmlspecialchars($kafsha['link'])."'>";
                echo "<p>".htmlspecialchars($kafsha['emri'])."</p>";
                echo "<button class='heart-button $isFavorite' data-pet='".htmlspecialchars($kafsha['emri'])."' title='Fshi nga Wishlist'>";
                echo '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
                echo "</button>";
                echo "</div>";
            }
        }
        echo "</div>";
        echo "<ul>";
        foreach ($_SESSION['wishlist'] as $kafsha) {
            echo "<li>" . htmlspecialchars($kafsha) . 
                 "<button class='remove-button' data-pet='" . htmlspecialchars($kafsha) . "' title='Fshi nga Wishlist'>✖</button></li>";
        }
        echo "</ul>";
    }
} else {
    echo json_encode(["success" => false, "message" => "Kërkesë e pavlefshme!"]);
}
?>