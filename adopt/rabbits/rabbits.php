<!DOCTYPE html>
<html>
<head>
    <title>Rabbits - Pet Adoption</title>
    <link rel="stylesheet" href="rabbits.css">
</head>
<body>
   <div class="content">
        <h1>Meet Our Rabbits</h1>
        <p>Find your hop-py ever after with the perfect rabbit friend today!</p>
        <a href="/UEB24_Gr36/adopt/index.php" class="back-button">← Back to Home</a>
        <div class="gif-container">
            <audio id="audio" src="../images/rabbit-oinks-and-squeaks-71608.mp3"></audio>
            <button class="audio-button" onclick="document.getElementById('audio').play()">▶︎•၊၊||၊|।||||।၊|।•</button>
        </div> 
    </div>

    <section class="rabbit-list">
        <?php
        $rabbits = [
            ["name" => "Houdini", "image" => "../images/rabbit1.jpg", "personality" => "Curious, Intelligent, Playful"],
            ["name" => "Snowball", "image" => "../images/rabbit2.jpg", "personality" => "Affectionate, Calm, Sociable"],
            ["name" => "Clumsy", "image" => "../images/rabbit3.avif", "personality" => "Gentle, Relaxed, Sweet"],
            ["name" => "Stompy", "image" => "../images/rabbit4.jpg", "personality" => "Friendly, Outgoing, Sociable"],
            ["name" => "Peter", "image" => "../images/rabbit5.jpg", "personality" => "Energetic, Brave"],
            ["name" => "Oreo", "image" => "../images/rabbit6.jpg", "personality" => "Curious, Playful, Affectionate"],
            ["name" => "Bobbin", "image" => "../images/rabbit7.webp", "personality" => "Cheerful, Relaxed, Gentle"],
            ["name" => "Bun", "image" => "../images/rabbit8.jpg", "personality" => "Energetic, Curious, Independent"],
            ["name" => "Ruby", "image" => "../images/rabbit9.jpg", "personality" => "Affectionate, Calm, Loyal"],
            ["name" => "Floppy", "image" => "../images/rabbit10.jpg", "personality" => "Playful, Sociable, Gentle"]
        ];

        usort($rabbits, function ($a, $b) {
            return strcmp($a["personality"], $b["personality"]);
        });

        foreach ($rabbits as $rabbit) {
            echo '<button class="rabbit-card" onclick="window.location.href=\'rabbit.html?name=' . urlencode($rabbit['name']) . '\'">';
            echo '<img src="' . htmlspecialchars($rabbit['image']) . '" alt="' . htmlspecialchars($rabbit['name']) . '">';
            echo '<p>' . htmlspecialchars($rabbit['name']) . '</p>';
            echo '<p><em>' . htmlspecialchars($rabbit['personality']) . '</em></p>';  // Shto personalitetin për secilin lepur
            echo '</button>';
        }
        ?>
    </section>

    <div id="footer"></div>
    <script src="/UEB24_Gr36/adopt/footer.js"></script>  
</body>
</html>
