<?php
require_once 'C:\XAMPP\htdocs\UEB24_Gr36\adopt\process.php';
include 'C:\XAMPP\htdocs\UEB24_Gr36\faqja_kryesore\header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Adoption</title>
    <link rel="stylesheet" href="style2.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        :root {
            --bg-color: #f9f9f9;
        }
        body.dark {
            --bg-color: #333;
        }
        body {
            background-color: var(--bg-color) !important;
            transition: background-color 0.3s;
        }
        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
            position: fixed;
            right: 20px;
            top: 60px;
            z-index: 1000;
        }
    </style>
</head>
<body class="<?php echo $cookies_array['tema'] == 'dark' ? 'dark' : 'light'; ?>">
    <div id="header-placeholder">
        <button class="theme-toggle" id="theme-toggle" title="Ndrysho temën"><?php echo $cookies_array['tema'] === 'dark' ? '☀️' : '🌙'; ?></button>
    </div>
    <script>
        $(document).ready(function() {
            $('#theme-toggle').on('click', function() {
                console.log('Theme toggle clicked');
                try {
                    $('body').toggleClass('dark light');
                    const theme = $('body').hasClass('dark') ? 'dark' : 'light';
                    console.log('New theme:', theme);
                    document.cookie = `tema=${theme};path=/;max-age=31536000`;
                    $(this).text(theme === 'dark' ? '☀️' : '🌙');
                    $('select[name="tema"]').val(theme);
                } catch (error) {
                    console.error('Theme toggle error:', error);
                }
            });

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
                    try {
                        let data = typeof response === 'string' ? JSON.parse(response.replace(/<br\s*\/>.*?(?={)/, '')) : response;
                        console.log('AJAX Response:', data);
                        if (data.success) {
                            button.toggleClass('favorite');
                            $('.wishlist').load('/UEB24_Gr36/adopt/perpunoj_wishlist.php?reload_wishlist=1', function() {
                                console.log('Wishlist reloaded');
                                let message = action === 'shto' ?
                                    'Ke shtuar ' + petName + ' në listën tënde!' :
                                    'Ke fshirë ' + petName + ' nga lista jote!';
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
                            alert('Gabim: ' + data.message);
                        }
                    } catch (e) {
                        console.error('JSON Parse Error:', e);
                        alert('Gabim gjatë përpunimit të përgjigjes nga serveri! Ju lutemi provoni përsëri.');
                    }
                }, 'text').fail(function(jqXHR, textStatus) {
                    console.error('AJAX Error:', textStatus, jqXHR.responseText);
                    alert('Gabim gjatë komunikimit me serverin! Ju lutemi provoni përsëri.');
                });
            });

            $(document).on('click', '.remove-button', function() {
                console.log('Remove button clicked');
                let button = $(this);
                let petName = button.data('pet');
                console.log('Pet to remove:', petName);

                $.post('/UEB24_Gr36/adopt/perpunoj_wishlist.php', {
                    kafsha: petName,
                    veprimi: 'fshi'
                }, function(response) {
                    try {
                        let data = typeof response === 'string' ? JSON.parse(response.replace(/<br\s*\/>.*?(?={)/, '')) : response;
                        console.log('AJAX Response:', data);
                        if (data.success) {
                            $('.heart-button[data-pet="' + petName + '"]').removeClass('favorite');
                            $('.wishlist').load('/UEB24_Gr36/adopt/perpunoj_wishlist.php?reload_wishlist=1', function() {
                                console.log('Wishlist reloaded after remove');
                                let message = 'Ke fshirë ' + petName + ' nga lista jote!';
                                $('.asistent').html('<img src="/UEB24_Gr36/adopt/images/petpal-icon.png" alt="PetPal">' + 
                                    message + '<span class="wishlist-link" onclick="scrollToWishlist()">Shiko Wishlist</span>');
                            });
                        } else {
                            alert('Gabim: ' + data.message);
                        }
                    } catch (e) {
                        console.error('JSON Parse Error:', e);
                        alert('Gabim gjatë përpunimit të përgjigjes nga serveri! Ju lutemi provoni tërsëri.');
                    }
                }, 'text').fail(function(jqXHR, textStatus) {
                    console.error('AJAX Error:', textStatus, jqXHR.responseText);
                    alert('Gabim gjatë komunikimit me serverin! Ju lutemi provoni përsëri.');
                });
            });

            $(document).on('click', '.pet-image', function() {
                console.log('Pet image clicked:', $(this).data('link'));
                window.location.href = $(this).data('link');
            });

            $('#personalize-form').on('submit', function(e) {
                e.preventDefault();
                console.log('Personalize form submitted');
                $.ajax({
                    url: '/UEB24_Gr36/adopt/filter_pets.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        console.log('Filter response:', response);
                        if (response.success) {
                            if (response.best_match) {
                                $('#best-match').html('<h3>Preferenca më e Mirë</h3>' + response.best_match).show();
                            } else {
                                $('#best-match').hide();
                            }
                            $('#filtered-pets-list').html(response.filtered_pets);
                            $('.asistent').html('<img src="/UEB24_Gr36/adopt/images/petpal-icon.png" alt="PetPal">' +
                                'Kafshët janë filtruar sipas preferencave të tua. ' +
                                '<span class="wishlist-link" onclick="scrollToWishlist()">Shiko Wishlist</span>');
                            const tema = $('select[name="tema"]').val();
                            console.log('Form theme selected:', tema);
                            if (tema) {
                                $('body').removeClass('light dark').addClass(tema);
                                $('#theme-toggle').text(tema === 'dark' ? '☀️' : '🌙');
                                document.cookie = `tema=${tema};path=/;max-age=31536000`;
                            }
                            if ($('input[name="fshi_cookies"]').val() === '1') {
                                console.log('Clearing preferences');
                                $('body').removeClass('dark').addClass('light');
                                $('#theme-toggle').text('🌙');
                                $('select[name="tema"]').val('light');
                                document.cookie = `tema=light;path=/;max-age=31536000`;
                                $('select[name="lloji_kafshes"]').val('');
                                $('select[name="mosha_kafshes"]').val('');
                                $('select[name="gender"]').val('');
                                $('select[name="color"]').val('');
                                $('select[name="personality"]').val('');
                            }
                        } else {
                            alert('Gabim: ' + response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown, jqXHR.responseText);
                        alert('Gabim gjatë filtrimit të kafshëve! Detaje: ' + textStatus);
                    }
                });
            });

            $('#personalize-form').trigger('submit');

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
        <h1><?php echo htmlspecialchars($greeting); ?></h1>
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
            <form id="personalize-form" method="post">
                <label>Zgjidh llojin e kafshës:</label>
                <select name="lloji_kafshes">
                    <option value="">Zgjidh</option>
                    <option value="Dog" <?php if ($cookies_array['lloji_kafshes'] == 'Dog') echo 'selected'; ?>>Qen</option>
                    <option value="Cat" <?php if ($cookies_array['lloji_kafshes'] == 'Cat') echo 'selected'; ?>>Mace</option>
                    <option value="Rabbit" <?php if ($cookies_array['lloji_kafshes'] == 'Rabbit') echo 'selected'; ?>>Lepur</option>
                    <option value="Bird" <?php if ($cookies_array['lloji_kafshes'] == 'Bird') echo 'selected'; ?>>Zog</option>
                </select><br>
                <label>Zgjidh moshën e kafshës:</label>
                <select name="mosha_kafshes">
                    <option value="">Zgjidh</option>
                    <option value="I ri" <?php if ($cookies_array['mosha_kafshes'] == 'I ri') echo 'selected'; ?>>I ri (0-2 vjeç)</option>
                    <option value="I rritur" <?php if ($cookies_array['mosha_kafshes'] == 'I rritur') echo 'selected'; ?>>I rritur (3-7 vjeç)</option>
                    <option value="I vjetër" <?php if ($cookies_array['mosha_kafshes'] == 'I vjetër') echo 'selected'; ?>>I vjetër (8+ vjeç)</option>
                </select><br>
                <label>Zgjidh gjininë:</label>
                <select name="gender">
                    <option value="">Zgjidh</option>
                    <option value="Male" <?php if ($cookies_array['gender'] == 'Male') echo 'selected'; ?>>Mashkull</option>
                    <option value="Female" <?php if ($cookies_array['gender'] == 'Female') echo 'selected'; ?>>Femër</option>
                    <option value="Unknown" <?php if ($cookies_array['gender'] == 'Unknown') echo 'selected'; ?>>E panjohur</option>
                </select><br>
                <label>Zgjidh ngjyrën:</label>
                <select name="color">
                    <option value="">Zgjidh</option>
                    <?php
                    $color_query = "SELECT DISTINCT color FROM pets ORDER BY color";
                    $color_result = pg_query($conn, $color_query);
                    while ($color = pg_fetch_assoc($color_result)) {
                        $selected = ($cookies_array['color'] == $color['color']) ? 'selected' : '';
                        echo "<option value='".htmlspecialchars($color['color'])."' $selected>".htmlspecialchars($color['color'])."</option>";
                    }
                    ?>
                </select><br>
                <label>Zgjidh personalitetin:</label>
                <select name="personality">
                    <option value="">Zgjidh</option>
                    <?php
                    $personality_query = "SELECT DISTINCT unnest(string_to_array(personality, ',')) AS trait FROM pets ORDER BY trait";
                    $personality_result = pg_query($conn, $personality_query);
                    while ($trait = pg_fetch_assoc($personality_result)) {
                        $trait_value = trim($trait['trait']);
                        $selected = ($cookies_array['personality'] == $trait_value) ? 'selected' : '';
                        echo "<option value='".htmlspecialchars($trait_value)."' $selected>".htmlspecialchars($trait_value)."</option>";
                    }
                    ?>
                </select><br>
                <button type="submit">Ruaj dhe Filtro</button>
                <input type="hidden" name="fshi_cookies" value="0">
                <button type="submit" onclick="$('input[name=fshi_cookies]').val('1')">Fshi Preferencat</button>
            </form>
        </div>
    </section>

    <section class="filtered-pets">
        <h2>Kafshët që Përputhen</h2>
        <div id="best-match" style="display: none;">
            <h3>Preferenca më e Mirë</h3>
            <div class="pet-card best-match-card"></div>
        </div>
        <div id="filtered-pets-list" class="pets"></div>
    </section>

    <div class="banner">
        <h2>Shelters are full!</h2>
        <p>Help pets get out.</p>
    </div>

    <div id="addedToast" class="toast">✔️ Added to Wishlist!</div>

    <section class="wishlist" id="wishlist">
        <h2>Lista Jote e Preferencave</h2>
        <?php if (empty($_SESSION['wishlist'])): ?>
            <p style='color: #555;'>Asnjë kafshë e shtuar ende.</p>
        <?php else: ?>
            <div class="wishlist-pets"></div>
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
<?php
pg_close($conn);
?>