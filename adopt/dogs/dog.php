<?php
session_start();
include '../../databaza/db_connect.php';

if (!$conn) {
    die("Connection failed: Could not include db_connect.php or establish database connection.");
}

$dog_name = isset($_GET['name']) ? pg_escape_string($conn, $_GET['name']) : '';

if (empty($dog_name)) {
    die("Invalid dog name");
}

$query = "SELECT p.id, p.name, p.image, p.age, p.gender, p.color, p.personality, d.breed, d.size
          FROM pets p
          JOIN dogs d ON p.id = d.pet_id
          WHERE p.name = $1 AND p.type = 'Dog'";
$result = pg_prepare($conn, "dog_query", $query);
$result = pg_execute($conn, "dog_query", [$dog_name]);

if (!$result || pg_num_rows($result) == 0) {
    die("Dog not found");
}

$dog = pg_fetch_assoc($result);
$isFavorite = in_array($dog['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
pg_free_result($result);
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($dog['name']); ?> - Dog Profile</title>
    <link rel="stylesheet" href="dog.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo htmlspecialchars($dog['name']); ?></h1>
        </div>
        <div class="content">
            <img id="dog-image" src="<?php echo htmlspecialchars($dog['image']); ?>" alt="<?php echo htmlspecialchars($dog['name']); ?>" />
            <button class="heart-button <?php echo $isFavorite; ?>" data-dog="<?php echo htmlspecialchars($dog['name']); ?>" title="Shto në Wishlist">
                <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </button>
            <h2>About <span id="dog-name-display"><?php echo htmlspecialchars($dog['name']); ?></span></h2>
            <p><strong>Breed:</strong> <span id="dog-breed"><?php echo htmlspecialchars($dog['breed']); ?></span></p>
            <p><strong>Age:</strong> <span id="dog-age"><?php echo htmlspecialchars($dog['age']); ?> years</span></p>
            <p><strong>Gender:</strong> <span id="dog-gender"><?php echo htmlspecialchars($dog['gender']); ?></span></p>
            <p><strong>Color:</strong> <span id="dog-color"><?php echo htmlspecialchars($dog['color']); ?></span></p>
            <p><strong>Personality:</strong> <span id="dog-personality"><?php echo htmlspecialchars($dog['personality']); ?></span></p>
            <p><strong>Health:</strong> <span id="dog-health">Good</span></p>
            <p><strong>Size:</strong> <span id="dog-size"><?php echo htmlspecialchars($dog['size']); ?></span></p>
        </div>
        <div class="back-button">
            <a href="/UEB24_Gr36/adopt/dogs/dogs.php">← Back to Dog List</a>
        </div>
    </div>
    <div id="addedToast" class="toast">✔️ Added to Wishlist!</div>

    <script>
        $(document).ready(function() {
            $('.heart-button').on('click', function() {
                let button = $(this);
                let dogName = button.data('dog');
                $.post('/UEB24_Gr36/adopt/dogs/perpunoj_wishlist_dogs.php', {
                    kafsha: dogName,
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
        });
    </script>
</body>
</html>