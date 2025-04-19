<!DOCTYPE html>
<html>
<head>
    <title>Cats - Pet Adoption</title>
    <link rel="stylesheet" href="cats.css">
</head>
<body>
   <div class="content">
        <h1>Meet Our Cats</h1>
        <p>Discover your purr-fect companion from our list of lovable cats today!</p>
        <a href="/UEB24_Gr36/adopt/index.php" class="back-button">← Back to Home</a>
        <div class="gif-container">
            <audio id="audio" src="../images/cat-98721.mp3"></audio>
            <button class="audio-button" onclick="document.getElementById('audio').play()">▶︎•၊၊||၊|။||||။၊|။•</button>
        </div> 
    </div>

    <section class="cat-list">
        <?php

        $json = file_get_contents('cat.json');
        $cats = json_decode($json, true);

        $ages = [];
        foreach ($cats as $key => $cat) {
 
            preg_match('/[\d.]+/', $cat['age'], $matches);
            $ageValue = floatval($matches[0]);
            $ages[$key] = $ageValue;
        }

        arsort($ages);

        $sortedCats = [];
        foreach ($ages as $key => $value) {
            $sortedCats[] = $cats[$key];
        }

        foreach ($sortedCats as $cat) {
            echo '<button class="cat-card" onclick="window.location.href=\'cat.html?name=' . urlencode($cat['name']) . '\'">';
            echo '<img src="' . htmlspecialchars($cat['image']) . '" alt="' . htmlspecialchars($cat['name']) . '">';
            echo '<p>' . htmlspecialchars($cat['name']) . ' - ' . htmlspecialchars($cat['age']) . '</p>';
            echo '</button>';
        }
        ?>
    </section>

    <div id="footer"></div>
    <script src="/UEB24_Gr36/adopt/footer.js"></script>  
</body>
</html>
