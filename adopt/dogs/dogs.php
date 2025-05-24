<?php
// Fillimi i sesionit për të përdorur wishlist-in
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dogs - Pet Adoption</title>
    <link rel="stylesheet" href="dogs.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .dog-image {
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

        /* Stili për butonin e wishlist-it */
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
    </style>
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
            $isFavorite = in_array($dog['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
            echo '<div class="dog-card">';
            echo '<img src="' . htmlspecialchars($dog['image']) . '" alt="' . htmlspecialchars($dog['name']) . '" class="dog-image" data-link="/UEB24_Gr36/adopt/dogs/dog.html?name=' . urlencode($dog['name']) . '">';
            echo '<p>' . htmlspecialchars($dog['name']) . '</p>';
            echo '<button class="heart-button ' . $isFavorite . '" data-dog="' . htmlspecialchars($dog['name']) . '" title="Shto në Wishlist">';
            echo '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
            echo '</button>';
            echo '</div>';
        }
        ?>
    </section>

    <!-- Butoni për të shkuar te wishlist-i në index.php -->
    <button class="wishlist-button" onclick="window.location.href='/UEB24_Gr36/adopt/index.php#wishlist'">Shiko Wishlist-in</button>

    <!-- Toast notification -->
    <div id="addedToast" class="toast">✔️ Added to Wishlist!</div>

    <div id="footer"></div>
    <script src="/UEB24_Gr36/adopt/footer.js"></script>

    <script>
        $(document).ready(function() {
            // Klikimi mbi zemrën për wishlist
            $('.heart-button').on('click', function() {
                let button = $(this);
                let dogName = button.data('dog');
                $.post('/UEB24_Gr36/adopt/dogs/perpunoj_wishlist_dogs.php', {
                    kafsha: dogName,
                    veprimi: button.hasClass('favorite') ? 'fshi' : 'shto'
                }, function(response) {
                    if (response.success) {
                        button.toggleClass('favorite');

                        // Shfaq toast vetëm kur shtohet
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

            // Klikimi mbi imazhin për ta hapur profilin
            $('.dog-image').on('click', function() {
                window.location.href = $(this).data('link');
            });
        });
    </script>
</body>
</html>