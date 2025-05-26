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

$query = "SELECT p.id, p.name, p.image, p.age, p.gender, p.color, p.personality, d.breed
          FROM pets p
          JOIN dogs d ON p.id = d.pet_id
          WHERE p.name = $1 AND p.type = 'Dog'";
$result = pg_prepare($conn, "dog_query", $query);
$result = pg_execute($conn, "dog_query", [$dog_name]);

if (!$result || pg_num_rows($result) == 0) {
    die("Dog not found");
}

$dog = pg_fetch_assoc($result);

// Check if the dog is already adopted
$adopted_query = "SELECT 1 FROM adopted_pets WHERE pet_id = $1";
$adopted_result = pg_prepare($conn, "adopted_query", $adopted_query);
$adopted_result = pg_execute($conn, "adopted_query", [$dog['id']]);
$is_adopted = pg_num_rows($adopted_result) > 0;

$isFavorite = in_array($dog['name'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
pg_free_result($result);
pg_free_result($adopted_result);
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
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            text-align: center;
        }
        
        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        
        .modal-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .confirm-button {
            background-color: #4CAF50;
            color: white;
        }
        
        .cancel-button {
            background-color: #f44336;
            color: white;
        }
        
        .adopt-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .adopt-button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        
        .adoption-details {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f8f8;
            border-radius: 5px;
            text-align: left;
        }
    </style>
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
          
            
            <!-- Add Adopt Now button -->
            <button id="adopt-button" class="adopt-button" <?php echo $is_adopted ? 'disabled' : ''; ?>>
                <?php echo $is_adopted ? 'Already Adopted' : 'Adopt Now'; ?>
            </button>
        </div>
        <div class="back-button">
            <a href="/UEB24_Gr36/adopt/dogs/dogs.php">← Back to Dog List</a>
        </div>
    </div>
    
    <!-- Adoption Modal -->
    <div id="adoptionModal" class="modal">
        <div class="modal-content">
            <h2>Congratulations! You're about to become a pet owner!</h2>
            <div id="adoptionDetails" class="adoption-details" style="display: none;">
                <h3>Adoption Details</h3>
                <p><strong>Pet ID:</strong> <span id="adoptedPetId"></span></p>
                <p><strong>Pet Name:</strong> <span id="adoptedPetName"></span></p>
                <p><strong>Your Name:</strong> <span id="adopterName"></span></p>
                <p><strong>Your ID:</strong> <span id="adopterId"></span></p>
            </div>
            <p>Are you sure you want to adopt <?php echo htmlspecialchars($dog['name']); ?>?</p>
            <div class="modal-buttons">
                <button id="confirmAdopt" class="modal-button confirm-button">Accept Adoption</button>
                <button id="cancelAdopt" class="modal-button cancel-button">Cancel</button>
            </div>
        </div>
    </div>
    
    <div id="addedToast" class="toast">✔️ Added to Wishlist!</div>
    <div id="adoptedToast" class="toast">✔️ Adoption Successful!</div>

    <script>
        $(document).ready(function() {
            $('.heart-button').on('click', function() {
                let button = $(this);
                let dogName = button.data('dog');
                $.post('/UEB24_Gr36/adopt/dog/perpunoj_wishlist_dogs.php', {
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
            
            // Adoption functionality
            $('#adopt-button').on('click', function() {
                $('#adoptionModal').show();
            });
            
            $('#cancelAdopt').on('click', function() {
                $('#adoptionModal').hide();
            });
            
            $('#confirmAdopt').on('click', function() {
                // Get user data from session (you'll need to adjust this based on your auth system)
                let userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
                let userName = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";
                let petId = <?php echo $dog['id']; ?>;
                let petName = "<?php echo htmlspecialchars($dog['name']); ?>";
                
                if (!userId) {
                    alert('Please log in to adopt a pet');
                    $('#adoptionModal').hide();
                    return;
                }
                
                // Show adoption details
                $('#adoptedPetId').text(petId);
                $('#adoptedPetName').text(petName);
                $('#adopterName').text(userName);
                $('#adopterId').text(userId);
                $('#adoptionDetails').show();
                
                // Send adoption request to server
                $.post('/UEB24_Gr36/adopt/perpunoj_adoption.php', {
                    pet_id: petId,
                    user_id: userId,
                    action: 'adopt'
                }, function(response) {
                    if (response.success) {
                        // Show success message
                        let toast = $('#adoptedToast');
                        toast.addClass('show');
                        setTimeout(() => {
                            toast.removeClass('show');
                            $('#adoptionModal').hide();
                            // Disable adopt button and update text
                            $('#adopt-button').text('Already Adopted').prop('disabled', true);
                        }, 2000);
                    } else {
                        alert('Adoption failed: ' + response.message);
                    }
                }, 'json').fail(function() {
                    alert('Gabim gjatë komunikimit me serverin!');
                });
            });
            
            // Close modal when clicking outside
            $(window).on('click', function(event) {
                if ($(event.target).is('#adoptionModal')) {
                    $('#adoptionModal').hide();
                }
            });
        });
    </script>
</body>
</html>