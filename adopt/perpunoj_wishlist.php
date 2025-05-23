<?php
session_start();
function modifikoWishlist($kafsha, $veprimi) {
    if ($veprimi == 'shto' && !in_array($kafsha, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'][] = $kafsha;
    }
}
if (isset($_POST['shiko_profil'])) {
    $_SESSION['shikime_profile'] = ($_SESSION['shikime_profile'] ?? 0) + 1;
    modifikoWishlist($_POST['shiko_profil'], 'shto');
    echo "<h2 style='font-size: 1.8rem; color: #ff6600; margin-bottom: 20px;'>Lista Jote e Preferencave</h2>";
    if (empty($_SESSION['wishlist'])) {
        echo "<p style='color: #555;'>Asnjë kafshë e shtuar ende.</p>";
    } else {
        echo "<ul>";
        foreach ($_SESSION['wishlist'] as $kafsha) {
            echo "<li style='font-size: 1rem; color: #333; margin: 10px 0; padding: 10px; background: #ffe6cc; border-radius: 8px;'>" . htmlspecialchars($kafsha) . "</li>";
        }
        echo "</ul>";
    }
}
?>