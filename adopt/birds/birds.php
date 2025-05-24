<?php
// Fillimi i sesionit për të përdorur wishlist-in
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Birds - Pet Adoption</title>
    <link rel="stylesheet" href="birds.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .bird-image {
            cursor: pointer;
        }

        .toast {
            visibility: hidden;
            min-width: 120px;
            background-color: rgb(255, 157, 0);
            color: white;
            text-align: center;
            border-radius: 8px;
            padding: 12px;
            position: fixed;
            z-index: 999;
            right: 30px;
            bottom: 30px;
            font-size: 16px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            transition: visibility 0s, opacity 0.4s linear;
            opacity: 0;
        }

        .toast.show {
            visibility: visible;
            opacity: 1;
        }

        .wishlist-button {
            display: block;
            margin: 20px auto;
            padding: 8px 16px;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .wishlist-button:hover {
            background-color: #cc5500;
        }

        .heart-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            transition: transform 0.2s ease;
        }

        .heart-button svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: #ff6600;
            stroke-width: 2;
        }

        .heart-button.favorite svg {
            fill: #ff6600;
        }

        .heart-button:hover svg {
            transform: scale(1.2);
        }

        .bird-card {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Meet Our Birds</h1>
        <p>Let your heart take flight with the perfect feathered friend today!</p>
        <a href="/UEB24_Gr36/adopt/index.php" class="back-button">← Back to Home</a>
        <div class="gif-container">
            <audio id="audio" src="../images/bird-sounds-241394.mp3"></audio>
            <button class="audio-button" onclick="document.getElementById('audio').play()">▶︎•၊၊||၊|။||||။၊|။•</button>
        </div>
    </div>

    <section class="bird-list">
        <?php
        $birds = [
            ["name" => "Bruno", "species" => "Cockatoo", "image" => "../images/bird1.jpg"],
            ["name" => "Dale", "species" => "Macaw", "image" => "../images/bird2.jpg"],
            ["name" => "Stella", "species" => "Budgerigar", "image" => "../images/bird3.jpeg"],
            ["name" => "Tori", "species" => "Sulphur-Crested Cockatoo", "image" => "../images/bird4.jpg"],
            ["name" => "Feathers", "species" => "Zebra Finch", "image" => "../images/bird5.webp"],
            ["name" => "Mango", "species" => "Canary", "image" => "../images/bird6.jpg"],
            ["name" => "Whisles", "species" => "Bluebird", "image" => "../images/bird7.jpg"],
            ["name" => "Pico", "species" => "Sun Conure", "image" => "../images/bird8.jpg"],
            ["name" => "Hula", "species" => "Sparrow", "image" => "../images/bird9.jpg"],
            ["name" => "Tinker", "species" => "House Finch", "image" => "../images/bird10.jpg"]
        ];

        foreach ($birds as $bird) {
            $isFavorite = in_array($bird['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
            echo '<div class="bird-card">';
            echo '<img src="' . htmlspecialchars($bird['image']) . '" alt="' . htmlspecialchars($bird['name']) . '" class="bird-image" data-link="/UEB24_Gr36/adopt/birds/bird.html?name=' . urlencode($bird['name']) . '">';
            echo '<p><strong>' . htmlspecialchars($bird['name']) . '</strong></p>';
            echo '<button class="heart-button ' . $isFavorite . '" data-bird="' . htmlspecialchars($bird['name']) . '" title="Shto në Wishlist">';
            echo '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
            echo '</button>';
            echo '</div>';
        }
        ?>
    </section>

    <button class="wishlist-button" onclick="window.location.href='/UEB24_Gr36/adopt/index.php#wishlist'">Shiko Wishlist-in</button>

    <div id="addedToast" class="toast">✔️ Added to Wishlist!</div>

    <div id="footer"></div>
    <script src="/UEB24_Gr36/adopt/footer.js"></script>

    <script>
        $(document).ready(function() {
            $('.heart-button').on('click', function() {
                let button = $(this);
                let birdName = button.data('bird');
                $.post('/UEB24_Gr36/adopt/birds/perpunoj_wishlist_birds.php', {
                    kafsha: birdName,
                    veprimi: button.hasClass('favorite') ? 'fshi' : 'shto'
                }, function(response) {
                    if (response.success) {
                        button.toggleClass('favorite');
                        if (!button.hasClass('favorite')) return;
                        let toast = $('#addedToast');
                        toast.addClass('show');
                        setTimeout(() => {
                            toast.removeClass('show');
                        }, 2000);
                    } else {
                        alert('Gabim: ' + response.message);
                    }
                }, 'json').fail(function() {
                    alert('Gabim gjatë komunikimit me serverin!');
                });
            });

            $('.bird-image').on('click', function() {
                window.location.href = $(this).data('link');
            });
        });
    </script>
</body>
</html>
