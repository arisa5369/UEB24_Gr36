<?php

$donationAmount = 625000;
$totalGrants = 2101;
$petsHelped = 122937;

$foundationName = "Petfinder Foundation";
$missionStatement = "making a difference";

function generateImpactMessage($donation, $grants, $pets) {
    $donationFormatted = number_format($donation, 0, '.', ',');
    $grantsFormatted = number_format($grants);
    $petsFormatted = number_format($pets);

    return "With over <strong>\$$donationFormatted</strong> in donations, <strong>$grantsFormatted</strong> grants awarded, and more than <strong>$petsFormatted</strong> pets helped this year alone, we are proud to say that your support is truly <span style='color:#0077cc;'>making a difference</span>.";
}


$impactMessage = generateImpactMessage($donationAmount, $totalGrants, $petsHelped);
?>

<style>
    .impact-highlight-box {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        font-family: 'Georgia', serif;
        text-align: center;
    }

    .impact-highlight-box h2 {
        color: #008c99;
        font-size: 2em;
        margin-bottom: 15px;
    }

    .impact-highlight-box p {
        font-size: 1.2em;
        color: #333;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .impact-highlight-box em {
        font-style: italic;
        color: #777;
    }
</style>

<section class="impact-highlight-box">
    <h2>Impact That Matters</h2>
    <p><?= $impactMessage ?></p>
    <p><em>Thank you for being part of the journey to rescue, protect, and love every pet that deserves a second chance.</em></p>
</section>
