<?php
// Fillimi i sesionit
session_start();
setcookie('shfaq_imazh', 'false', time() + (30 * 24 * 3600));

// Përfshij skedarin e konfigurimit
require_once 'config.php';

// Definimi i funksionit të personalizuar për trajtimin e gabimeve
function customErrorHandler($errno, $errstring, $errfile, $errline, $errcontext) {
    $errorTypes = [
        E_ERROR => "Gabim Fatal",
        E_WARNING => "Paralajmërim",
        E_NOTICE => "Njoftim",
        E_USER_ERROR => "Gabim i Përdoruesit",
        E_USER_WARNING => "Paralajmërim i Përdoruesit",
        E_USER_NOTICE => "Njoftim i Përdoruesit"
    ];
    $errorType = isset($errorTypes[$errno]) ? $errorTypes[$errno] : "Gabim i Panjohur";
    $mesazh = "[$errorType] $errstring në skedarin $errfile, linja $errline";
    
    try {
        $logFile = fopen(LOG_DIR . 'error_log.txt', 'a');
        if ($logFile === false) {
            throw new Exception("Nuk mund të hapet skedari i gabimeve!");
        }
        fwrite($logFile, date('Y-m-d H:i:s') . " - $mesazh\n");
        fclose($logFile);
    } catch (Exception $e) {
        echo "Gabim gjatë shkrimit të log-ut: " . $e->getMessage();
    }
    
    echo "<div style='color: red; padding: 10px; border: 1px solid red;'>$mesazh</div>";
}
set_error_handler("customErrorHandler");

// Inicializimi i variablave të sesionit
$_SESSION['shikime_profile'] = ($_SESSION['shikime_profile'] ?? 0);
$_SESSION['wishlist'] = $_SESSION['wishlist'] ?? [];
$_SESSION['vizita_faqe'] = ($_SESSION['vizita_faqe'] ?? 0) + 1;

// Funksion për të manipuluar wishlist-in dhe regjistruar veprimet në log
function modifikoWishlist($kafsha, $veprimi, $emri) {
    try {
        $logFile = fopen(LOG_DIR . 'user_actions.log', 'a');
        if ($logFile === false) {
            throw new Exception("Nuk mund të hapet skedari log për veprimet!");
        }
        
        if ($veprimi == 'shto' && !in_array($kafsha, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'][] = $kafsha;
            fwrite($logFile, date('Y-m-d H:i:s') . " - Përdoruesi $emri shtoi $kafsha në wishlist\n");
            fclose($logFile);
            return ["success" => true, "message" => "Shtove $kafsha në wishlist!"];
        } elseif ($veprimi == 'fshi' && in_array($kafsha, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$kafsha]);
            fwrite($logFile, date('Y-m-d H:i:s') . " - Përdoruesi $emri fshiu $kafsha nga wishlist\n");
            fclose($logFile);
            return ["success" => true, "message" => "Fshive $kafsha nga wishlist!"];
        }
        fclose($logFile);
        return ["success" => true, "message" => "Asnjë ndryshim në wishlist."];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Gabim gjatë manipulimit të wishlist-it: " . $e->getMessage()];
    }
}

// Përpunimi i formës për cookies
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['emri'])) {
        setcookie('emri', $_POST['emri'], time() + (30 * 24 * 3600));
    }
    if (isset($_POST['lloji_kafshes'])) {
        setcookie('lloji_kafshes', $_POST['lloji_kafshes'], time() + (30 * 24 * 3600));
        setcookie('shfaq_imazh', 'true', time() + (30 * 24 * 3600));
    }
    if (isset($_POST['mosha_kafshes'])) {
        setcookie('mosha_kafshes', $_POST['mosha_kafshes'], time() + (30 * 24 * 3600));
    }
    if (isset($_POST['tema'])) {
        setcookie('tema', $_POST['tema'], time() + (30 * 24 * 3600));
    }
    if (isset($_POST['fshi_cookies'])) {
        setcookie('emri', '', time() - 3600);
        setcookie('lloji_kafshes', '', time() - 3600);
        setcookie('mosha_kafshes', '', time() - 3600);
        setcookie('tema', '', time() - 3600);
        setcookie('shfaq_imazh', '', time() - 3600);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Merr vlerat e cookies dhe ruaj në varg
$cookies_array = [
    'emri' => $_COOKIE['emri'] ?? 'Adoptues',
    'lloji_kafshes' => $_COOKIE['lloji_kafshes'] ?? 'Qen',
    'mosha_kafshes' => $_COOKIE['mosha_kafshes'] ?? 'I ri',
    'tema' => $_COOKIE['tema'] ?? 'light',
    'shfaq_imazh' => $_COOKIE['shfaq_imazh'] ?? 'false'
];

// Zgjidh sfondin dhe imazhin kryesor
$sfondi = $cookies_array['tema'] == 'dark' ? '#333' : '#f9f9f9';
$imazh_kryesor = match ($cookies_array['lloji_kafshes']) {
    'Qen' => 'images/dog1.avif',
    'Mace' => 'images/cat1.jpg',
    'Lepur' => 'images/rabbit1.jpg',
    'Zog' => 'images/bird1.jpg',
    default => 'images/dog1.avif'
};

// Mesazh i asistentit virtual
$mesazh_asistent = "Përshëndetje, {$cookies_array['emri']}! Ti preferon {$cookies_array['lloji_kafshes']} të {$cookies_array['mosha_kafshes']}. ";
$mesazh_asistent .= "Ke shikuar {$_SESSION['shikime_profile']} profile dhe ke vizituar faqen {$_SESSION['vizita_faqe']} herë!";
include 'C:\XAMPP\htdocs\UEB24_Gr36\faqja_kryesore\header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Adoption</title>
    <link rel="stylesheet" href="style2.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body style="background-color: <?php echo $sfondi; ?>;">
    <div id="header-placeholder"></div>
    <script>
        $(document).ready(function() {
            // Handle heart button clicks
            $(document).on('click', '.heart-button', function() {
                console.log('Heart button clicked');
                let button = $(this);
                let petName = button.data('pet');
                let action = button.hasClass('favorite') ? 'fshi' : 'shto';
                console.log('Pet:', petName, 'Action:', action);

                $.post('/UEB24_Gr36/adopt/perpunoj_wishlist.php', {
                    kafsha: petName,
                    veprimi: action
                }, function(response) {
                    console.log('AJAX Response:', response);
                    if (response.success) {
                        button.toggleClass('favorite');
                        $('.wishlist').load('/UEB24_Gr36/adopt/perpunoj_wishlist.php?reload_wishlist=1', function() {
                            console.log('Wishlist reloaded');
                            let message = action === 'shto' ?
                                'Përshëndetje, <?php echo htmlspecialchars($cookies_array['emri']); ?>! Ke shtuar ' + petName + ' në listën tënde!' :
                                'Përshëndetje, <?php echo htmlspecialchars($cookies_array['emri']); ?>! Ke fshirë ' + petName + ' nga lista jote!';
                            $('.asistent').html('<img src="/UEB24_Gr36/adopt/images/petpal-icon.png" alt="PetPal">' + 
                                message + '<span class="wishlist-link" onclick="scrollToWishlist()">Shiko Wishlist</span>');
                            if (action === 'shto') {
                                let toast = $('#addedToast');
                                toast.addClass('show');
                                setTimeout(() => {
                                    toast.removeClass('show');
                                }, 2000);
                            }
                        });
                        $('.heart-button[data-pet="' + petName + '"]').toggleClass('favorite');
                    } else {
                        alert('Gabim: ' + response.message);
                    }
                }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);
                    alert('Gabim gjatë komunikimit me serverin! Detaje: ' + textStatus + ' - ' + jqXHR.responseText);
                });
            });

            // Handle remove button clicks
            $(document).on('click', '.remove-button', function() {
                console.log('Remove button clicked');
                let button = $(this);
                let petName = button.data('pet');
                console.log('Pet to remove:', petName);

                $.post('/UEB24_Gr36/adopt/perpunoj_wishlist.php', {
                    kafsha: petName,
                    veprimi: 'fshi'
                }, function(response) {
                    console.log('AJAX Response:', response);
                    if (response.success) {
                        $('.heart-button[data-pet="' + petName + '"]').removeClass('favorite');
                        $('.wishlist').load('/UEB24_Gr36/adopt/perpunoj_wishlist.php?reload_wishlist=1', function() {
                            console.log('Wishlist reloaded after remove');
                            let message = 'Përshëndetje, <?php echo htmlspecialchars($cookies_array['emri']); ?>! Ke fshirë ' + petName + ' nga lista jote!';
                            $('.asistent').html('<img src="/UEB24_Gr36/adopt/images/petpal-icon.png" alt="PetPal">' + 
                                message + '<span class="wishlist-link" onclick="scrollToWishlist()">Shiko Wishlist</span>');
                        });
                    } else {
                        alert('Gabim: ' + response.message);
                    }
                }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);
                    alert('Gabim gjatë komunikimit me serverin! Detaje: ' + textStatus + ' - ' + jqXHR.responseText);
                });
            });

            // Handle pet image clicks
            $(document).on('click', '.pet-image', function() {
                console.log('Pet image clicked:', $(this).data('link'));
                window.location.href = $(this).data('link');
            });

            // Scroll to wishlist function
            window.scrollToWishlist = function() {
                console.log('Scrolling to wishlist');
                $('html, body').animate({
                    scrollTop: $('.wishlist').offset().top
                }, 500);
            };

            if (window.location.hash === '#wishlist') {
                scrollToWishlist();
            }
        });
    </script>

    <div class="content">
        <h1><?php
            $ora = date("H");
            if ($ora >= 5 && $ora < 12) {
                echo "Good Morning – Welcome to Pet Adoption";
            } elseif ($ora >= 12 && $ora < 18) {
                echo "Good Afternoon – Welcome to Pet Adoption";
            } else {
                echo "Good Evening – Welcome to Pet Adoption";
            }
        ?></h1>
        <p>Browse pets from our network of shelters and rescues.</p>
    </div>

    <div class="asistent">
        <img src="/UEB24_Gr36/adopt/images/petpal-icon.png" alt="PetPal">
        <?php echo htmlspecialchars($mesazh_asistent); ?>
        <span class="wishlist-link" onclick="scrollToWishlist()">Shiko Wishlist</span>
    </div>

    <?php if ($cookies_array['shfaq_imazh'] == 'true'): ?>
    <div class="hero-image">
        <img src="<?php echo htmlspecialchars($imazh_kryesor); ?>" alt="Kafshë e preferuar">
    </div>
    <?php endif; ?>

    <div class="categories">
        <button class="category" onclick="window.location.href='dogs/dogs.php'">
            <img src="images/dog.png" alt="dogs">
            <p>Dogs</p>
        </button>
        <button class="category" onclick="window.location.href='cats/cats.php'">
            <img src="images/Cat.png" alt="cat">
            <p>Cats</p>
        </button>
        <button class="category" onclick="window.location.href='rabbits/rabbits.php'">
            <img src="images/Rabbit.png" alt="rabbit">
            <p>Rabbits</p>
        </button>
        <button class="category" onclick="window.location.href='birds/birds.php'">
            <img src="images/Bird.png" alt="bird">
            <p>Birds</p>
        </button>
    </div>

    <section class="personalize-section">
        <div class="form-container">
            <h2>Personalizo Përvojën Tënde</h2>
            <form method="post">
                <label>Emri yt:</label>
                <input type="text" name="emri" placeholder="Shkruaj emrin tënd" value="<?php echo htmlspecialchars($cookies_array['emri']); ?>"><br>
                <label>Zgjidh llojin e kafshës:</label>
                <select name="lloji_kafshes">
                    <option value="Qen" <?php if ($cookies_array['lloji_kafshes'] == 'Qen') echo 'selected'; ?>>Qen</option>
                    <option value="Mace" <?php if ($cookies_array['lloji_kafshes'] == 'Mace') echo 'selected'; ?>>Mace</option>
                    <option value="Lepur" <?php if ($cookies_array['lloji_kafshes'] == 'Lepur') echo 'selected'; ?>>Lepur</option>
                    <option value="Zog" <?php if ($cookies_array['lloji_kafshes'] == 'Zog') echo 'selected'; ?>>Zog</option>
                </select><br>
                <label>Zgjidh moshën e kafshës:</label>
                <select name="mosha_kafshes">
                    <option value="I ri" <?php if ($cookies_array['mosha_kafshes'] == 'I ri') echo 'selected'; ?>>I ri</option>
                    <option value="I rritur" <?php if ($cookies_array['mosha_kafshes'] == 'I rritur') echo 'selected'; ?>>I rritur</option>
                    <option value="I vjetër" <?php if ($cookies_array['mosha_kafshes'] == 'I vjetër') echo 'selected'; ?>>I vjetër</option>
                </select><br>
                <label>Zgjidh temën:</label>
                <select name="tema">
                    <option value="light" <?php if ($cookies_array['tema'] == 'light') echo 'selected'; ?>>E hapur</option>
                    <option value="dark" <?php if ($cookies_array['tema'] == 'dark') echo 'selected'; ?>>E errët</option>
                </select><br>
                <button type="submit">Ruaj Preferencat</button>
                <button type="submit" name="fshi_cookies" value="1">Fshi Preferencat</button>
            </form>
        </div>
    </section>

    <div class="banner">
        <h2>Shelters are full!</h2>
        <p>Help pets get out.</p>
    </div>

    <div class="pets">
        <?php
        $kafshe = [
            ['emri' => 'Buddy', 'lloji' => 'Qen', 'mosha' => 'I ri', 'imazh' => 'images/dog1.avif', 'link' => '/UEB24_Gr36/adopt/dogs/dog.html?name=Buddy'],
            ['emri' => 'Tom', 'lloji' => 'Mace', 'mosha' => 'I rritur', 'imazh' => 'images/cat1.jpg', 'link' => '/UEB24_Gr36/adopt/cats/cat.html?name=Tom'],
            ['emri' => 'Houdini', 'lloji' => 'Lepur', 'mosha' => 'I ri', 'imazh' => 'images/rabbit1.jpg', 'link' => '/UEB24_Gr36/adopt/rabbits/rabbit.html?name=Houdini'],
            ['emri' => 'Bruno', 'lloji' => 'Zog', 'mosha' => 'I vjetër', 'imazh' => 'images/bird1.jpg', 'link' => '/UEB24_Gr36/adopt/birds/bird.html?name=Bruno'],
        ];
        foreach ($kafshe as $kafsha) {
            if ($kafsha['lloji'] == $cookies_array['lloji_kafshes'] || $kafsha['mosha'] == $cookies_array['mosha_kafshes']) {
                $isFavorite = in_array($kafsha['emri'], $_SESSION['wishlist'] ?? []) ? 'favorite' : '';
                echo "<div class='pet-card'>";
                echo "<img src='".htmlspecialchars($kafsha['imazh'])."' alt='".htmlspecialchars($kafsha['lloji'])."' class='pet-image' data-link='".htmlspecialchars($kafsha['link'])."'>";
                echo "<p>".htmlspecialchars($kafsha['emri'])."</p>";
                echo "<button class='heart-button $isFavorite' data-pet='".htmlspecialchars($kafsha['emri'])."' title='".($isFavorite ? 'Fshi nga Wishlist' : 'Shto në Wishlist')."'>";
                echo '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
                echo "</button>";
                echo "</div>";
            }
        }
        ?>
    </div>

    <div id="addedToast" class="toast">✔️ Added to Wishlist!</div>

    <section class="wishlist" id="wishlist">
        <h2>Lista Jote e Preferencave</h2>
        <?php if (empty($_SESSION['wishlist'])): ?>
            <p style='color: #555;'>Asnjë kafshë e shtuar ende.</p>
        <?php else: ?>
            <div class="wishlist-pets">
                <?php
                foreach ($kafshe as $kafsha) {
                    if (in_array($kafsha['emri'], $_SESSION['wishlist'])) {
                        $isFavorite = 'favorite';
                        echo "<div class='pet-card'>";
                        echo "<img src='".htmlspecialchars($kafsha['imazh'])."' alt='".htmlspecialchars($kafsha['lloji'])."' class='pet-image' data-link='".htmlspecialchars($kafsha['link'])."'>";
                        echo "<p>".htmlspecialchars($kafsha['emri'])."</p>";
                        echo "<button class='heart-button $isFavorite' data-pet='".htmlspecialchars($kafsha['emri'])."' title='Fshi nga Wishlist'>";
                        echo '<svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>';
                        echo "</button>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <ul>
                <?php foreach ($_SESSION['wishlist'] as $kafsha): ?>
                    <li>
                        <?php echo htmlspecialchars($kafsha); ?>
                        <button class="remove-button" data-pet="<?php echo htmlspecialchars($kafsha); ?>" title="Fshi nga Wishlist">✖</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

    <section class="adoption-info">
        <h2>Planning to Adopt a Pet?</h2>
        <div class="info-card">
            <div class="card">
                <h3>Checklist for New Adopters</h3>
                <p>Make the adoption transition as smooth as possible.</p>
                <a href="https://www.nasc.cc/dog/pet-adoption-handy-checklist/" target="_blank">
                    <button>Learn More</button>
                </a>
            </div>
            <div class="card">
                <h3>How Old is a Dog in Human Years?</h3>
                <p>Learn to translate dog years to human years just for fun, and vice versa.</p>
                <a href="https://www.akc.org/expert-advice/health/how-to-calculate-dog-years-to-human-years/" target="_blank">
                    <button>Learn More</button>
                </a>
            </div>
            <div class="card">
                <h3>Pet Adoption FAQs</h3>
                <p>Get answers to all the questions you haven't thought of for your adoption.</p>
                <a href="https://www.animalhumanesociety.org/resource/adoption-faq" target="_blank">
                    <button>Learn More</button>
                </a>
            </div>
        </div>
        <div class="get-help">
            <button class="help-button" onclick="window.location.href='/UEB24_Gr36/get_help/getHelp.php'">
                Get Help
            </button>
        </div>
    </section>

    <div id="footer"></div>
    <script src="/UEB24_Gr36/adopt/footer.js"></script>
</body>
</html>