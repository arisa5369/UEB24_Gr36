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

class Rabbit {
    private $name;
    private $image;
    private $personality;

    public function __construct($name, $image, $personality) {
        $this->name = $name;
        $this->image = $image;
        $this->personality = $personality;
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getPersonality() {
        return $this->personality;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setPersonality($personality) {
        $this->personality = $personality;
    }

    public function display() {
        echo '<button class="rabbit-card" onclick="window.location.href=\'rabbit.html?name=' . urlencode($this->name) . '\'">';
        echo '<img src="' . htmlspecialchars($this->image) . '" alt="' . htmlspecialchars($this->name) . '">';
        echo '<p>' . htmlspecialchars($this->name) . '</p>';
        echo '<p><em>' . htmlspecialchars($this->personality) . '</em></p>';
        echo '</button>';
    }
}

$rabbits = [
    new Rabbit("Houdini", "../images/rabbit1.jpg", "Curious, Intelligent, Playful"),
    new Rabbit("Snowball", "../images/rabbit2.jpg", "Affectionate, Calm, Sociable"),
    new Rabbit("Clumsy", "../images/rabbit3.avif", "Gentle, Relaxed, Sweet"),
    new Rabbit("Stompy", "../images/rabbit4.jpg", "Friendly, Outgoing, Sociable"),
    new Rabbit("Peter", "../images/rabbit5.jpg", "Energetic, Brave"),
    new Rabbit("Oreo", "../images/rabbit6.jpg", "Curious, Playful, Affectionate"),
    new Rabbit("Bobbin", "../images/rabbit7.webp", "Cheerful, Relaxed, Gentle"),
    new Rabbit("Bun", "../images/rabbit8.jpg", "Energetic, Curious, Independent"),
    new Rabbit("Ruby", "../images/rabbit9.jpg", "Affectionate, Calm, Loyal"),
    new Rabbit("Floppy", "../images/rabbit10.jpg", "Playful, Sociable, Gentle"),
];

usort($rabbits, function($a, $b) {
    return strcmp($a->getPersonality(), $b->getPersonality());
});

foreach ($rabbits as $rabbit) {
    $rabbit->display();
}

?>
    </section>
    <div id="footer"></div>
    <script src="/UEB24_Gr36/adopt/footer.js"></script>  
</body>
</html>
