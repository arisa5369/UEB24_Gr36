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
    <title>Cats - Pet Adoption</title>
    <link rel="stylesheet" href="cats.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="content">
        <h1>Meet Our Cats</h1>
        <p>Find your purr-fect companion today!</p>
        <a href="/UEB24_Gr36/adopt/index.php" class="back-button">← Back to Home</a>
        <div class="gif-container">
            <audio id="audio" src="../images/cat-meow-14536.mp3"></audio>
            <button class="audio-button" onclick="document.getElementById('audio').play()">▶︎•၊၊||၊|။||||။၊|။•</button>
        </div>
    </div>

    <section class="cat-list">
        <?php
        $query = "SELECT p.id, p.name, p.image, c.breed
                  FROM pets p
                  JOIN cats c ON p.id = c.pet_id
                  WHERE p.type = 'Cat'
                  ORDER BY p.name";
        $result = pg_query($conn, $query);

        if (!$result) {
            echo "Error fetching cats: " . pg_last_error($conn);
        } else {
            while ($cat = pg_fetch_assoc($result)) {
                $isFavorite = in_array($cat['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
                echo '<div class="cat-card">';
                echo '<img src="' . htmlspecialchars($cat['image']) . '" alt="' . htmlspecialchars($cat['name']) . '" class="cat-image" data-link="/UEB24_Gr36/adopt/cats/cat.php?name=' . urlencode($cat['name']) . '">';
                echo '<p>' . htmlspecialchars($cat['name']) . ' - ' . htmlspecialchars($cat['breed']) . '</p>';
                echo '<button class="heart-button ' . $isFavorite . '" data-cat="' . htmlspecialchars($cat['name']) . '" title="Shto në Wishlist">';
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
                let catName = button.data('cat');
                $.post('/UEB24_Gr36/adopt/cats/perpunoj_wishlist_cats.php', {
                    kafsha: catName,
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

            $('.cat-image').on('click', function() {
                window.location.href = $(this).data('link');
            });
        });
    </script>
</body>
</html>
<?php
pg_close($conn);
?>