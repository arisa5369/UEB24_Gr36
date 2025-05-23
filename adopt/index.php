<?php
// Fillimi i sesionit
session_start();
setcookie('shfaq_imazh', 'false', time() + (30 * 24 * 3600));
// Inicializimi i variablave të sesionit
$_SESSION['shikime_profile'] = ($_SESSION['shikime_profile'] ?? 0);
$_SESSION['kuiz_pergjigje'] = $_SESSION['kuiz_pergjigje'] ?? [];
$_SESSION['wishlist'] = $_SESSION['wishlist'] ?? [];
$_SESSION['vizita_faqe'] = ($_SESSION['vizita_faqe'] ?? 0) + 1; // Numërimi i vizitave

// Funksion brenda sesionit për të manipuluar wishlist-in
function modifikoWishlist($kafsha, $veprimi) {
    if ($veprimi == 'shto' && !in_array($kafsha, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'][] = $kafsha;
        return "Shtove $kafsha në wishlist!";
    } elseif ($veprimi == 'fshi' && in_array($kafsha, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$kafsha]);
        return "Fshive $kafsha nga wishlist!";
    }
    return "Asnjë ndryshim në wishlist.";
}

// Përpunimi i formës për cookies dhe sesione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cookies për preferencat
    if (isset($_POST['emri'])) {
        setcookie('emri', $_POST['emri'], time() + (30 * 24 * 3600)); // 30 ditë
    }
    if (isset($_POST['lloji_kafshes'])) {
        setcookie('lloji_kafshes', $_POST['lloji_kafshes'], time() + (30 * 24 * 3600));
        setcookie('shfaq_imazh', 'true', time() + (30 * 24 * 3600)); // Shfaq imazhin pas zgjedhjes
    }
    if (isset($_POST['mosha_kafshes'])) {
        setcookie('mosha_kafshes', $_POST['mosha_kafshes'], time() + (30 * 24 * 3600));
    }
    if (isset($_POST['tema'])) {
        setcookie('tema', $_POST['tema'], time() + (30 * 24 * 3600));
    }
    // Fshirja e cookies
    if (isset($_POST['fshi_cookies'])) {
        setcookie('emri', '', time() - 3600);
        setcookie('lloji_kafshes', '', time() - 3600);
        setcookie('mosha_kafshes', '', time() - 3600);
        setcookie('tema', '', time() - 3600);
        setcookie('shfaq_imazh', '', time() - 3600); // Fshi dhe cookie-n për imazhin
    }
    // Sesion për kuizin
    if (isset($_POST['kuiz_aktiviteti'])) {
        $_SESSION['kuiz_pergjigje']['aktiviteti'] = $_POST['kuiz_aktiviteti'];
    }
    // Manipulim i wishlist-it
    if (isset($_POST['modifiko_wishlist']) && isset($_POST['kafsha'])) {
        $mesazh_wishlist = modifikoWishlist($_POST['kafsha'], $_POST['modifiko_wishlist']);
    }
    // Rifresko faqen
    header("Location: " . $_SERVER['PHP_SELF']);
}

// Merr vlerat e cookies dhe ruaj në varg
$cookies_array = [
    'emri' => $_COOKIE['emri'] ?? 'Adoptues',
    'lloji_kafshes' => $_COOKIE['lloji_kafshes'] ?? 'Qen',
    'mosha_kafshes' => $_COOKIE['mosha_kafshes'] ?? 'I ri',
    'tema' => $_COOKIE['tema'] ?? 'light',
    'shfaq_imazh' => $_COOKIE['shfaq_imazh'] ?? 'false' // Parazgjedhje: mos shfaq
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
if (!empty($_SESSION['kuiz_pergjigje']['aktiviteti'])) {
    $mesazh_asistent .= "Të pëlqejnë kafshë {$_SESSION['kuiz_pergjigje']['aktiviteti']}. ";
}
$mesazh_asistent .= "Ke shikuar {$_SESSION['shikime_profile']} profile dhe ke vizituar faqen {$_SESSION['vizita_faqe']} herë!";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Adoption</title>
    <link rel="stylesheet" href="style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: <?php echo $sfondi; ?>;
            color: #333;
        }
        .asistent {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(45deg, #ff6600, #ff8500);
            color: white;
            padding: 10px 15px;
            border-radius: 12px;
            max-width: 300px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 1000;
            animation: slideIn 0.5s ease-in-out;
        }
        .asistent img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            border-radius: 50%;
            border: 2px solid #fff;
        }
        .asistent .wishlist-link {
            margin-left: 10px;
            color: #fff;
            text-decoration: underline;
            cursor: pointer;
            font-weight: 600;
        }
        .asistent .wishlist-link:hover {
            color: #ffe6cc;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
        .personalize-section {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: <?php echo $cookies_array['tema'] == 'dark' ? '#333' : '#fff'; ?>;
            border: 2px solid #ff6600;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            display: flex;
            justify-content: space-between;
            gap: 30px;
            flex-wrap: wrap;
        }
        .personalize-section .form-container {
            flex: 1;
            min-width: 300px;
            padding: 20px;
        }
        .personalize-section h2 {
            font-size: 1.8rem;
            color: #ff6600;
            margin-bottom: 20px;
            text-align: center;
        }
        .personalize-section label {
            font-size: 1rem;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }
        .personalize-section select, .personalize-section input {
            margin: 10px 0;
            padding: 10px;
            font-size: 1rem;
            border-radius: 8px;
            border: 2px solid #ff6600;
            width: 100%;
            box-sizing: border-box;
            background: #fff;
            color: #333;
        }
        .personalize-section button {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            margin: 10px 5px;
            transition: background-color 0.3s ease;
        }
        .personalize-section button:hover {
            background-color: #cc5500;
        }
        .wishlist {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: <?php echo $cookies_array['tema'] == 'dark' ? '#333' : '#fff'; ?>;
            border: 2px solid #ff6600;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-align: center;
        }
        .wishlist h2 {
            font-size: 1.8rem;
            color: #ff6600;
            margin-bottom: 20px;
        }
        .wishlist ul {
            list-style: none;
            padding: 0;
        }
        .wishlist li {
            font-size: 1rem;
            color: #333;
            margin: 10px 0;
            padding: 10px;
            background: #ffe6cc;
            border-radius: 8px;
        }
        .pets .pet-card button.add-to-wishlist, .pets .pet-card1 button.add-to-wishlist {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff6600;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }
        .pets .pet-card button.add-to-wishlist:hover, .pets .pet-card1 button.add-to-wishlist:hover {
            background: #cc5500;
        }
        .hero-image {
            text-align: center;
            margin: 40px auto;
            max-width: 600px; 
            padding: 0 20px;
            opacity: 0;
            animation: fadeIn 0.4s ease forwards; 
        }
        .hero-image img {
            max-width: 100%;
            max-height: 400px;
            object-fit: cover; 
            border-radius: 16px; 
            border: 2px solid #ff8500; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15); 
            transition: transform 0.4s ease, opacity 0.4s ease; 
        }
        .hero-image img:hover {
            transform: scale(1.05);
            opacity: 0.95; 
        }
        @keyframes fadeIn {
            to { opacity: 1; } 
        }
        @media (max-width: 768px) {
            .hero-image {
                max-width: 90%; 
            }
            .personalize-section {
                flex-direction: column;
            }
            .asistent {
                max-width: 250px;
                font-size: 12px;
                padding: 8px 12px;
            }
            .asistent img {
                width: 25px;
                height: 25px;
            }
            .personalize-section .form-container {
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <div id="header-placeholder"></div>

    <script>
        fetch('/UEB24_Gr36/faqja_kryesore/header.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('header-placeholder').innerHTML = data;
                const modal1 = document.getElementById("modal1");
                const signUpButton = document.querySelector(".signup-btn");
                const closeModal = document.getElementById("closeModal");
                const createAccountModal = document.getElementById("createAccountModal");
                const openCreateAccount = document.getElementById("openCreateAccount");
                const closeCreateAccount = document.getElementById("closeCreateAccount");
                const loginModal = document.getElementById("loginModal");
                const openLogin = document.getElementById("openLogin");
                const closeLogin = document.getElementById("closeLogin");

                signUpButton?.addEventListener("click", () => {
                    modal1.style.display = "flex";
                });
                closeModal?.addEventListener("click", () => {
                    modal1.style.display = "none";
                });
                openCreateAccount?.addEventListener("click", () => {
                    modal1.style.display = "none";
                    createAccountModal.style.display = "flex";
                });
                closeCreateAccount?.addEventListener("click", () => {
                    createAccountModal.style.display = "none";
                });
                openLogin?.addEventListener("click", () => {
                    modal1.style.display = "none";
                    loginModal.style.display = "flex";
                });
                closeLogin?.addEventListener("click", () => {
                    loginModal.style.display = "none";
                });
                window.addEventListener("click", (event) => {
                    if (event.target === modal1) {
                        modal1.style.display = "none";
                    } else if (event.target === createAccountModal) {
                        createAccountModal.style.display = "none";
                    } else if (event.target === loginModal) {
                        loginModal.style.display = "none";
                    }
                });
            })
            .catch(error => console.error('Error loading header:', error));

        $(document).ready(function() {
            // Interaktivitet për kuizin me AJAX
            $('#kuiz-btn').on('click', function() {
                $.post('/UEB24_Gr36/adopt/perpunoj_kuiz.php', {
                    kuiz_aktiviteti: $('#kuiz_aktiviteti').val()
                }, function(data) {
                    $('.asistent').html('<img src="/UEB24_Gr36/adopt/images/petpal-icon.png" alt="PetPal">' + data + '<span class="wishlist-link" onclick="scrollToWishlist()">Shiko Wishlist</span>');
                });
            });

            // Interaktivitet për butonat "Shto në Wishlist"
            $('.add-to-wishlist').on('click', function(e) {
                e.preventDefault();
                let petName = $(this).data('pet');
                $.post('/UEB24_Gr36/adopt/perpunoj_wishlist.php', {
                    shiko_profil: petName
                }, function(data) {
                    $('.wishlist').html(data);
                    $('.asistent').html('<img src="/UEB24_Gr36/adopt/images/petpal-icon.png" alt="PetPal">' + 
                        'Përshëndetje, <?php echo htmlspecialchars($cookies_array['emri']); ?>! Ke shtuar ' + petName + ' në listën tënde!' +
                        '<span class="wishlist-link" onclick="scrollToWishlist()">Shiko Wishlist</span>');
                });
            });

            // Funksion për të lëvizur te wishlist-i
            window.scrollToWishlist = function() {
                $('html, body').animate({
                    scrollTop: $('.wishlist').offset().top
                }, 500);
            };
        });
    </script>

    <script src="/UEB24_Gr36/faqja_kryesore/script.js"></script>

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
        <p>Browse pets from our network of shelters and recues.</p>
    </div>

    <!-- Asistenti Virtual (Floating) -->
    <div class="asistent">
        <img src="/UEB24_Gr36/adopt/images/petpal-icon.png" alt="PetPal">
        <?php echo $mesazh_asistent; ?>
        <span class="wishlist-link" onclick="scrollToWishlist()">Shiko Wishlist</span>
    </div>

    <!-- Imazh kryesor i ndryshuar sipas cookies, shfaqet vetëm kur zgjidhet -->
    <?php if ($cookies_array['shfaq_imazh'] == 'true'): ?>
    <div class="hero-image">
        <img src="<?php echo $imazh_kryesor; ?>" alt="Kafshë e preferuar">
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

    <!-- Seksion për Personalizim dhe Kuiz -->
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
        <div class="form-container">
            <h2>Kuiz: Gjej Kafshën Perfekte</h2>
            <form id="kuiz-form">
                <label>A preferon kafshë aktive apo të qeta?</label>
                <select id="kuiz_aktiviteti" name="kuiz_aktiviteti">
                    <option value="aktive">Aktive</option>
                    <option value="të qeta">Të qeta</option>
                </select>
                <button type="button" id="kuiz-btn">Përgjigju</button>
            </form>
            <h2>Manipulo Wishlist-in</h2>
            <form method="post">
                <label>Zgjidh kafshën:</label>
                <select name="kafsha">
                    <?php foreach (['Buddy', 'Tom', 'Houdini', 'Bruno'] as $k) {
                        echo "<option value='$k'>$k</option>";
                    } ?>
                </select><br>
                <label>Veprimi:</label>
                <select name="modifiko_wishlist">
                    <option value="shto">Shto</option>
                    <option value="fshi">Fshi</option>
                </select><br>
                <button type="submit">Kryej Veprimin</button>
            </form>
            <?php if (isset($mesazh_wishlist)) echo "<p style='color: #ff6600;'>$mesazh_wishlist</p>"; ?>
        </div>
    </section>

    <div class="banner">
        <h2>Shelteres are full!</h2>
        <p>Help pets get out.</p>
    </div>
    <div class="pets">
        <?php
        // Të dhëna dummy të kafshëve
        $kafshe = [
            ['emri' => 'Buddy', 'lloji' => 'Qen', 'mosha' => 'I ri', 'imazh' => 'images/dog1.avif', 'link' => '/UEB24_Gr36/adopt/dogs/dog.html?name=Buddy'],
            ['emri' => 'Tom', 'lloji' => 'Mace', 'mosha' => 'I rritur', 'imazh' => 'images/cat1.jpg', 'link' => '/UEB24_Gr36/adopt/cats/cat.html?name=Tom'],
            ['emri' => 'Houdini', 'lloji' => 'Lepur', 'mosha' => 'I ri', 'imazh' => 'images/rabbit1.jpg', 'link' => '/UEB24_Gr36/adopt/rabbits/rabbit.html?name=Houdini'],
            ['emri' => 'Bruno', 'lloji' => 'Zog', 'mosha' => 'I vjetër', 'imazh' => 'images/bird1.jpg', 'link' => '/UEB24_Gr36/adopt/birds/bird.html?name=Bruno'],
        ];
        // Filtro kafshët sipas cookies
        foreach ($kafshe as $kafsha) {
            if ($kafsha['lloji'] == $cookies_array['lloji_kafshes'] || $kafsha['mosha'] == $cookies_array['mosha_kafshes']) {
                echo "<button class='pet-card" . ($kafsha['emri'] == 'Bruno' ? '1' : '') . "' onclick=\"window.location.href='{$kafsha['link']}'\">";
                echo "<img src='{$kafsha['imazh']}' alt='{$kafsha['lloji']}'>";
                echo "<p>{$kafsha['emri']}</p>";
                echo "<button class='add-to-wishlist' data-pet='{$kafsha['emri']}'>Shto në Wishlist</button>";
                echo "</button>";
            }
        }
        ?>
    </div>

    <!-- Wishlist -->
    <section class="wishlist">
        <h2>Lista Jote e Preferencave</h2>
        <?php
        if (empty($_SESSION['wishlist'])) {
            echo "<p style='color: #555;'>Asnjë kafshë e shtuar ende.</p>";
        } else {
            echo "<ul>";
            foreach ($_SESSION['wishlist'] as $kafsha) {
                echo "<li>" . htmlspecialchars($kafsha) . "</li>";
            }
            echo "</ul>";
        }
        ?>
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