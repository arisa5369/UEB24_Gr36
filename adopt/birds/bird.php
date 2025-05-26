<?php
session_start();
include '../../databaza/db_connect.php';

if (!$conn) {
    die("Connection failed: Could not include db_connect.php or establish database connection.");
}

$bird_name = isset($_GET['name']) ? pg_escape_string($conn, $_GET['name']) : '';

if (empty($bird_name)) {
    die("Invalid bird name");
}

$query = "SELECT p.id, p.name, p.image, p.age, p.gender, p.color, p.personality, b.species, b.wingspan
          FROM pets p
          JOIN birds b ON p.id = b.pet_id
          WHERE p.name = $1 AND p.type = 'Bird'";
$result = pg_prepare($conn, "bird_query", $query);
$result = pg_execute($conn, "bird_query", [$bird_name]);

if (!$result || pg_num_rows($result) == 0) {
    die("Bird not found");
}

$bird = pg_fetch_assoc($result);
$isFavorite = in_array($bird['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
pg_free_result($result);
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($bird['name']); ?> - Bird Profile</title>
    <link rel="stylesheet" href="bird.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo htmlspecialchars($bird['name']); ?></h1>
        </div>
        <div class="content">
            <img id="bird-image" src="<?php echo htmlspecialchars($bird['image']); ?>" alt="<?php echo htmlspecialchars($bird['name']); ?>" />
            <button class="heart-button <?php echo $isFavorite; ?>" data-bird="<?php echo htmlspecialchars($bird['name']); ?>" title="Shto në Wishlist">
                <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </button>
            <h2>About <span id="bird-name-display"><?php echo htmlspecialchars($bird['name']); ?></span></h2>
            <p><strong>Species:</strong> <span id="bird-species"><?php echo htmlspecialchars($bird['species']); ?></span></p>
            <p><strong>Age:</strong> <span id="bird-age"><?php echo htmlspecialchars($bird['age']); ?> years</span></p>
            <p><strong>Gender:</strong> <span id="bird-gender"><?php echo htmlspecialchars($bird['gender']); ?></span></p>
            <p><strong>Color:</strong> <span id="bird-color"><?php echo htmlspecialchars($bird['color']); ?></span></p>
            <p><strong>Personality:</strong> <span id="bird-personality"><?php echo htmlspecialchars($bird['personality']); ?></span></p>
            <p><strong>Health:</strong> <span id="bird-health">Good</span></p>
            <p><strong>Wingspan:</strong> <span id="bird-wingspan"><?php echo htmlspecialchars($bird['wingspan']); ?> cm</span></p>
        </div>
        <div class="back-button">
            <a href="/UEB24_Gr36/adopt/birds/birds.php">← Back to Bird List</a>
        </div>
    </div>
    <div id="addedToast" class="toast">✔️ Added to Wishlist!</div>

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
        });
    </script>
</body>
</html>