<?php
session_start();
require_once 'config.php';
include '../databaza/db_connect.php';

setcookie('shfaq_imazh', 'false', time() + (30 * 24 * 3600), '/');

function customErrorHandler($errno, $errstring, $errfile, $errline, $errcontext) {
    $errorTypes = [
        E_ERROR => "Gabim Fatal",
        E_WARNING => "Paralajmërim",
        E_NOTICE => "Njoftim",
        E_USER_ERROR => "Gabim i Përdoruesit",
        E_USER_WARNING => "Paralajmërim i Përdoruesit",
        E_USER_NOTICE => "Njoftim i Përdoruesit"
    ];
    $errorType = isset($errorTypes[$errno]) ? $errorTypes[$errno] : "Gabim i Panjohur";
    $mesazh = "[$errorType] $errstring në skedarin $errfile, linja $errline";

    try {
        $logFile = fopen(LOG_DIR . 'error_log.txt', 'a');
        if ($logFile === false) {
            throw new Exception("Nuk mund të hapet skedari i gabimeve!");
        }
        fwrite($logFile, date('Y-m-d H:i:s') . " - $mesazh\n");
        fclose($logFile);
    } catch (Exception $e) {
        echo "Gabim gjatë shkrimit të log-ut: " . $e->getMessage();
    }

    echo "<div style='color: red; padding: 10px; border: 1px solid red;'>$mesazh</div>";
}
set_error_handler("customErrorHandler");

$_SESSION['shikime_profile'] = ($_SESSION['shikime_profile'] ?? 0);
$_SESSION['vizita_faqe'] = ($_SESSION['vizita_faqe'] ?? 0) + 1;

if (isset($_COOKIE['wishlist']) && !empty($_COOKIE['wishlist'])) {
    $_SESSION['wishlist'] = json_decode($_COOKIE['wishlist'], true) ?? [];
} else {
    $_SESSION['wishlist'] = [];
}

function modifikoWishlist($kafsha, $veprimi, $emri) {
    try {
        $logFile = fopen(LOG_DIR . 'user_actions.log', 'a');
        if ($logFile === false) {
            throw new Exception("Nuk mund të hapet skedari log për veprimet!");
        }

        if ($veprimi == 'shto' && !in_array($kafsha, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'][] = $kafsha;
            fwrite($logFile, date('Y-m-d H:i:s') . " - Përdoruesi Anonim shtoi $kafsha në wishlist\n");

            setcookie('wishlist', json_encode($_SESSION['wishlist']), time() + 2592000, '/');
            fclose($logFile);
            return ["success" => true, "message" => "Shtove $kafsha në wishlist!"];
        } elseif ($veprimi == 'fshi' && in_array($kafsha, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = array_values(array_diff($_SESSION['wishlist'], [$kafsha]));
            fwrite($logFile, date('Y-m-d H:i:s') . " - Përdoruesi Anonim fshiu $kafsha nga wishlist\n");
  
            setcookie('wishlist', json_encode($_SESSION['wishlist']), time() + 2592000, '/');
            fclose($logFile);
            return ["success" => true, "message" => "Fshive $kafsha nga wishlist!"];
        }
        fclose($logFile);
        return ["success" => true, "message" => "Asnjë ndryshim në wishlist."];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Gabim gjatë manipulimit të wishlist-it: " . $e->getMessage()];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['lloji_kafshes'])) {
        setcookie('lloji_kafshes', $_POST['lloji_kafshes'], time() + 2592000, '/');
        $cookies_array['lloji_kafshes'] = $_POST['lloji_kafshes'];
        setcookie('shfaq_imazh', 'true', time() + 2592000, '/');
    }
    if (isset($_POST['mosha_kafshes'])) {
        setcookie('mosha_kafshes', $_POST['mosha_kafshes'], time() + 2592000, '/');
        $cookies_array['mosha_kafshes'] = $_POST['mosha_kafshes'];
    }
    if (isset($_POST['gender'])) {
        setcookie('gender', $_POST['gender'], time() + 2592000, '/');
        $cookies_array['gender'] = $_POST['gender'];
    }
    if (isset($_POST['color'])) {
        setcookie('color', $_POST['color'], time() + 2592000, '/');
        $cookies_array['color'] = $_POST['color'];
    }
    if (isset($_POST['personality'])) {
        setcookie('personality', $_POST['personality'], time() + 2592000, '/');
        $cookies_array['personality'] = $_POST['personality'];
    }
    if (isset($_POST['tema'])) {
        setcookie('tema', $_POST['tema'], time() + 2592000, '/');
        $cookies_array['tema'] = $_POST['tema'];
    }
    if (isset($_POST['fshi_cookies']) && $_POST['fshi_cookies'] == '1') {
        setcookie('lloji_kafshes', '', time() - 3600, '/');
        setcookie('mosha_kafshes', '', time() - 3600, '/');
        setcookie('gender', '', time() - 3600, '/');
        setcookie('color', '', time() - 3600, '/');
        setcookie('personality', '', time() - 3600, '/');
        setcookie('tema', 'light', time() + 2592000, '/');
        setcookie('shfaq_imazh', 'false', time() + 2592000, '/');
        setcookie('wishlist', '', time()  + 2592000, '/');
        $_SESSION['wishlist'] = [];
        $cookies_array = [
            'lloji_kafshes' => '',
            'mosha_kafshes' => '',
            'gender' => '',
            'color' => '',
            'personality' => '',
            'tema' => 'light',
            'shfaq_imazh' => 'false'
        ];
    }
}

$cookies_array = [
    'lloji_kafshes' => $_COOKIE['lloji_kafshes'] ?? '',
    'mosha_kafshes' => $_COOKIE['mosha_kafshes'] ?? '',
    'gender' => $_COOKIE['gender'] ?? '',
    'color' => $_COOKIE['color'] ?? '',
    'personality' => $_COOKIE['personality'] ?? '',
    'tema' => $_COOKIE['tema'] ?? 'light',
    'shfaq_imazh' => $_COOKIE['shfaq_imazh'] ?? 'false'
];

$imazh_kryesor = match ($cookies_array['lloji_kafshes']) {
    'Dog' => '/images/dog1.avif',
    'Cat' => '/images/cat1.jpg',
    'Rabbit' => '/images/rabbit1.jpg',
    'Bird' => '/images/bird1.jpg',
    default => '/images/dog1.avif'
};

$mesazh_asistent = "Ti preferon {$cookies_array['lloji_kafshes']} të {$cookies_array['mosha_kafshes']}. ";
$mesazh_asistent .= "Ke shikuar {$_SESSION['shikime_profile']} profile dhe ke vizituar faqen {$_SESSION['vizita_faqe']} herë!";

$ora = date("H");
$greeting = ($ora >= 5 && $ora < 12) ? "Good Morning – Welcome to Pet Adoption" :
            (($ora >= 12 && $ora < 18) ? "Good Afternoon – Welcome to Pet Adoption" :
            "Good Evening – Welcome to Pet Adoption");
?>