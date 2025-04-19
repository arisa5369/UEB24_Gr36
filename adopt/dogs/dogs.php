
<!DOCTYPE html>
<html>
<head>
    <title>Dogs - Pet Adoption</title>
    <link rel="stylesheet" href="dogs.css">
</head>
<body>
    <div class="content">
        <h1>Meet Our Dogs</h1>
        <p>Find your perfect furry friend from our list of adorable dogs.</p>
        <a href="/UEB24_Gr36/adopt/index.php" class="back-button">← Back to Home</a>
        <div class="gif-container">
            <audio id="audio" src="../images/dog-barking-101729.mp3"></audio>
            <button class="audio-button" onclick="document.getElementById('audio').play()">▶︎•၊၊||၊|။||||။၊|။•</button>
        </div> 
    </div>

    <section class="dog-list">
        <?php
        $dogs = [
            ["name" => "Buddy", "image" => "../images/dog1.avif"],
            ["name" => "Luna", "image" => "../images/dog2.jpg"],
            ["name" => "Rocco", "image" => "../images/dog3.jpg"],
            ["name" => "Ozzy", "image" => "../images/dog4.jpg"],
            ["name" => "Champ", "image" => "../images/dog5.jpg"],
            ["name" => "Ginger", "image" => "../images/dog6.webp"],
            ["name" => "Apollo", "image" => "../images/dog7.webp"],
            ["name" => "Milo", "image" => "../images/dog8.webp"],
            ["name" => "Gunter", "image" => "../images/dog9.webp"],
            ["name" => "Lulu", "image" => "../images/dog10.jpg"]
        ];

        $names = [];
        foreach ($dogs as $key => $dog) {
            $names[$key] = $dog["name"];
        }

        asort($names);

        $sortedDogs = [];
        foreach ($names as $key => $name) {
            $sortedDogs[] = $dogs[$key];
        }

        foreach ($sortedDogs as $dog) {
            echo '<button class="dog-card" onclick="window.location.href=\'/UEB24_Gr36/adopt/dogs/dog.html?name=' . urlencode($dog['name']) . '\'">';
            echo '<img src="' . htmlspecialchars($dog['image']) . '" alt="' . htmlspecialchars($dog['name']) . '">';
            echo '<p>' . htmlspecialchars($dog['name']) . '</p>';
            echo '</button>';
        }
        ?>
    </section>

    <div id="footer"></div>
    <script src="/UEB24_Gr36/adopt/footer.js"></script>  
</body>
</html>
