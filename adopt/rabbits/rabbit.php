<?php
session_start();
include '../../databaza/db_connect.php';

if (!$conn) {
    die("Connection failed: Could not include db_connect.php or establish database connection.");
}

$rabbit_name = isset($_GET['name']) ? pg_escape_string($conn, $_GET['name']) : '';

if (empty($rabbit_name)) {
    die("Invalid rabbit name");
}

$query = "SELECT p.id, p.name, p.image, p.age, p.gender, p.color, p.personality, r.breed, r.house_trained
          FROM pets p
          JOIN rabbits r ON p.id = r.pet_id
          WHERE p.name = $1 AND p.type = 'Rabbit'";
$result = pg_prepare($conn, "rabbit_query", $query);
$result = pg_execute($conn, "rabbit_query", [$rabbit_name]);

if (!$result || pg_num_rows($result) == 0) {
    die("Rabbit not found");
}

$rabbit = pg_fetch_assoc($result);
$isFavorite = in_array($rabbit['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
pg_free_result($result);
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($rabbit['name']); ?> - Rabbit Profile</title>
    <link rel="stylesheet" href="rabbit.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo htmlspecialchars($rabbit['name']); ?></h1>
        </div>
        <div class="content">
            <img id="rabbit-image" src="<?php echo htmlspecialchars($rabbit['image']); ?>" alt="<?php echo htmlspecialchars($rabbit['name']); ?>" />
            <button class="heart-button <?php echo $isFavorite; ?>" data-rabbit="<?php echo htmlspecialchars($rabbit['name']); ?>" title="Shto në Wishlist">
                <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </button>
            <h2>About <span id="rabbit-name-display"><?php echo htmlspecialchars($rabbit['name']); ?></span></h2>
            <p><strong>Breed:</strong> <span id="rabbit-breed"><?php echo htmlspecialchars($rabbit['breed']); ?></span></p>
            <p><strong>Age:</strong> <span id="rabbit-age"><?php echo htmlspecialchars($rabbit['age']); ?> years</span></p>
            <p><strong>Gender:</strong> <span id="rabbit-gender"><?php echo htmlspecialchars($rabbit['gender']); ?></span></p>
            <p><strong>Color:</strong> <span id="rabbit-color"><?php echo htmlspecialchars($rabbit['color']); ?></span></p>
            <p><strong>Personality:</strong> <span id="rabbit-personality"><?php echo htmlspecialchars($rabbit['personality']); ?></span></p>
            <p><strong>House-trained:</strong> <span id="rabbit-house-trained"><?php echo $rabbit['house_trained'] ? 'Yes' : 'No'; ?></span></p>
            <p><strong>Health:</strong> <span id="rabbit-health">Good</span></p>
        </div>
        <div class="back-button">
            <a href="/UEB24_Gr36/adopt/rabbits/rabbits.php">← Back to Rabbit List</a>
        </div>
    </div>
    <div id="addedToast" class="toast">✔️ Added to Wishlist!</div>

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
        });
    </script>
</body>
</html>