<?php
session_start();

header('Content-Type: application/json');

function modifikoWishlist($kafsha, $veprimi) {
    if ($veprimi == 'shto' && !in_array($kafsha, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'][] = $kafsha;
        return true;
    } elseif ($veprimi == 'fshi' && in_array($kafsha, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$kafsha]);
        return true;
    }
    return false;
}

if (isset($_POST['kafsha']) && isset($_POST['veprimi'])) {
    $kafsha = $_POST['kafsha'];
    $veprimi = $_POST['veprimi'];
    
    if (modifikoWishlist($kafsha, $veprimi)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Veprimi nuk u krye.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Të dhënat POST mungojnë.']);
}
?>