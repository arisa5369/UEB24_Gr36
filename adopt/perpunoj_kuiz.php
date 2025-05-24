<?php
session_start();
require_once 'config.php';

if (isset($_POST['kuiz_aktiviteti'])) {
    $_SESSION['kuiz_pergjigje']['aktiviteti'] = $_POST['kuiz_aktiviteti'];
    $emri = $_COOKIE['emri'] ?? 'Adoptues';
    $lloji_kafshes = $_COOKIE['lloji_kafshes'] ?? 'Qen';
    $mosha_kafshes = $_COOKIE['mosha_kafshes'] ?? 'I ri';
    $mesazh = "Përshëndetje, " . htmlspecialchars($emri) . "! Ti preferon " . 
              htmlspecialchars($lloji_kafshes) . " të " . htmlspecialchars($mosha_kafshes) . 
              ". Të pëlqejnë kafshë " . htmlspecialchars($_SESSION['kuiz_pergjigje']['aktiviteti']) . ". ";
    $mesazh .= "Ke shikuar " . ($_SESSION['shikime_profile'] ?? 0) . " profile dhe ke vizituar faqen " . ($_SESSION['vizita_faqe'] ?? 0) . " herë!";
    echo $mesazh;
} else {
    echo "Kërkesë e pavlefshme!";
}
?>