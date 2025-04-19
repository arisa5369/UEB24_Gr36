<!DOCTYPE html>
<html>
<head>
    <title>Birds - Pet Adoption</title>
    <link rel="stylesheet" href="birds.css">
</head>
<body>
   <div class="content">
        <h1>Meet Our Birds</h1>
        <p>Let your heart take flight with the perfect feathered friend today!</p>
        <a href="/UEB24_Gr36/adopt/index.php" class="back-button">← Back to Home</a>
        <div class="gif-container">
            <audio id="audio" src="../images/bird-sounds-241394.mp3"></audio>
            <button class="audio-button" onclick="document.getElementById('audio').play()">▶︎•၊၊||</button>
        </div> 
    </div>

    <section class="bird-list">
        <?php
        $birds = [
            ["name" => "Bruno", "species" => "Cockatoo", "health" => "Excellent", "image" => "../images/bird1.jpg"],
            ["name" => "Dale", "species" => "Macaw", "health" => "Healthy", "image" => "../images/bird2.jpg"],
            ["name" => "Stella", "species" => "Budgerigar", "health" => "Excellent", "image" => "../images/bird3.jpeg"],
            ["name" => "Tori", "species" => "Sulphur-Crested Cockatoo", "health" => "Healthy", "image" => "../images/bird4.jpg"],
            ["name" => "Feathers", "species" => "Zebra Finch", "health" => "Excellent", "image" => "../images/bird5.webp"],
            ["name" => "Mango", "species" => "Canary", "health" => "Healthy", "image" => "../images/bird6.jpg"],
            ["name" => "Whisles", "species" => "Bluebird", "health" => "Excellent", "image" => "../images/bird7.jpg"],
            ["name" => "Pico", "species" => "Sun Conure", "health" => "Healthy", "image" => "../images/bird8.jpg"],
            ["name" => "Hula", "species" => "Sparrow", "health" => "Excellent", "image" => "../images/bird9.jpg"],
            ["name" => "Tinker", "species" => "House Finch", "health" => "Healthy", "image" => "../images/bird10.jpg"]
        ];

        $healthPriority = [
            "Excellent" => 1,
            "Healthy" => 2
        ];

        $healthStatuses = array_column($birds, 'health');

        $healthPriorities = array_map(function($health) use ($healthPriority) {
            return $healthPriority[$health] ?? 3;
        }, $healthStatuses);

        array_multisort($healthPriorities, SORT_ASC, $birds);
        
        foreach ($birds as $bird) {
            echo '<button class="bird-card" onclick="window.location.href=\'/UEB24_Gr36/adopt/birds/bird.html?name=' . urlencode($bird['name']) . '\'">';
            echo '<img src="' . htmlspecialchars($bird['image']) . '" alt="' . htmlspecialchars($bird['name']) . '">';
            echo '<p><strong>' . htmlspecialchars($bird['name']) . '</strong></p>';
            echo '<p class="health-status">Health: ' . htmlspecialchars($bird['health']) . '</p>';
            echo '</button>';
        }
        ?>
    </section>

    <div id="footer"></div>
    <script src="/UEB24_Gr36/adopt/footer.js"></script>  
</body>
</html>
