<?php
session_start();
include '../../databaza/db_connect.php';

if (!$conn) {
    die("Connection failed: Could not include db_connect.php or establish database connection.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rabbits - Pet Adoption</title>
    <link rel="stylesheet" href="rabbits.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        $query = "SELECT p.id, p.name, p.image, r.breed
                  FROM pets p
                  JOIN rabbits r ON p.id = r.pet_id
                  WHERE p.type = 'Rabbit'
                  ORDER BY p.name";
        $result = pg_query($conn, $query);

        if (!$result) {
            echo "Error fetching rabbits: " . pg_last_error($conn);
        } else {
            while ($rabbit = pg_fetch_assoc($result)) {
                $isFavorite = in_array($rabbit['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
                echo '<div class="rabbit-card">';
                echo '<img src="' . htmlspecialchars($rabbit['image']) . '" alt="' . htmlspecialchars($rabbit['name']) . '" class="rabbit-image" data-link="/UEB24_Gr36/adopt/rabbits/rabbit.php?name=' . urlencode($rabbit['name']) . '">';
                echo '<p>' . htmlspecialchars($rabbit['name']) . '</p>';
                echo '<button class="heart-button ' . $isFavorite . '" data-rabbit="' . htmlspecialchars($rabbit['name']) . '" title="Shto në Wishlist">';
                echo '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
                echo '</button>';
                echo '</div>';
            }
        }
        pg_free_result($result);
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
<?php
pg_close($conn);
?>