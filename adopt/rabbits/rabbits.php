<?php
// Fillimi i sesionit për të përdorur wishlist-in
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rabbits - Pet Adoption</title>
    <link rel="stylesheet" href="rabbits.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .rabbit-image {
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

        .rabbit-card {
            position: relative;
        }
    </style>
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
            ["name" => "Houdini", "image" => "../images/rabbit1.jpg"],
            ["name" => "Snowball", "image" => "../images/rabbit2.jpg"],
            ["name" => "Clumsy", "image" => "../images/rabbit3.avif"],
            ["name" => "Stompy", "image" => "../images/rabbit4.jpg"],
            ["name" => "Peter", "image" => "../images/rabbit5.jpg"],
            ["name" => "Oreo", "image" => "../images/rabbit6.jpg"],
            ["name" => "Bobbin", "image" => "../images/rabbit7.webp"],
            ["name" => "Bun", "image" => "../images/rabbit8.jpg"],
            ["name" => "Ruby", "image" => "../images/rabbit9.jpg"],
            ["name" => "Floppy", "image" => "../images/rabbit10.jpg"]
        ];

        usort($rabbits, function ($a, $b) {
            return strcmp($a["name"], $b["name"]);
        });

        foreach ($rabbits as $rabbit) {
            $isFavorite = in_array($rabbit['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
            echo '<div class="rabbit-card">';
            echo '<img src="' . htmlspecialchars($rabbit['image']) . '" alt="' . htmlspecialchars($rabbit['name']) . '" class="rabbit-image" data-link="rabbit.html?name=' . urlencode($rabbit['name']) . '">';
            echo '<p>' . htmlspecialchars($rabbit['name']) . '</p>';
            echo '<button class="heart-button ' . $isFavorite . '" data-rabbit="' . htmlspecialchars($rabbit['name']) . '" title="Shto në Wishlist">';
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
                let rabbitName = button.data('rabbit');
                $.post('/UEB24_Gr36/adopt/rabbits/perpunoj_wishlist_rabbits.php', {
                    kafsha: rabbitName,
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

            $('.rabbit-image').on('click', function() {
                window.location.href = $(this).data('link');
            });
        });
    </script>
</body>
</html>
