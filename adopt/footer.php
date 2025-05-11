<?php
$email = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];


    if (preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/", $email)) {
        $message = "Email-i është valid!";
    } else {
        $message = "Email-i nuk është valid!";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/UEB24_Gr36/adopt/footer.css">
</head>

<body>
    <footer class="footer">
        <div class="container1">
            <div class="footer-section">
                <h2 class="footer-logo">Petfinder</h2>
                <p class="footer-description"> Finding Forever Friends,<br> One Paw at a Time!</p>
            </div>
            <?php
            $contactInfo = [
                ['label' => '+383 45 *** ***', 'href' => 'tel:+38345123456'],
                ['label' => 'petfinder@gmail.com', 'href' => 'mailto:petfinder@gmail.com'],
                ['label' => 'Instagram', 'href' => 'https://www.instagram.com/'],
                ['label' => 'Facebook', 'href' => 'https://www.facebook.com/']
            ];
            ?>

            <div class="footer-section">
                <h3>Contact us</h3>
                <address>
                    <ul>
                        <?php foreach ($contactInfo as $item): ?>
                            <li><a href="<?= htmlspecialchars($item['href']) ?>" target="_blank"><?= htmlspecialchars($item['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </address>
            </div>
            <div class="footer-section">
                <h3>About us</h3>
                <ul>
                    <li><a href="/UEB24_Gr36/aboutUS/our_impact/aaa.php">Our Impact </a></li>
                    <li><a href="/UEB24_Gr36/aboutUs/ourteam/ourteam.php">Our Team</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Adopt</h3>
                <ul>
                    <li><a href="/UEB24_Gr36/adopt/dogs/dogs.php">Dog</a></li>
                    <li><a href="/UEB24_Gr36/adopt/cats/cats.php">Cat</a></li>
                    <li><a href="/UEB24_Gr36/adopt/rabbits/rabbits.php">Rabbit</a></li>
                    <li><a href="/UEB24_Gr36/adopt/birds/birds.php">Bird</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Become a Volunteer</h3>
                <p>Join us and make a difference in the lives of pets.</p>
                <form class="subscribe-form" method="POST" action="">
                    <input type="email" name="email" placeholder="Enter your email address" required value="<?php echo htmlspecialchars($email); ?>">
                    <button type="submit">➤</button>
                </form>
                <p><?php echo $message; ?></p>
                <h3>Make a difference in the lives of animals, help them find loving homes.</h3>
            </div>
            <div class="footer-section">
                <h3>Find Us Here</h3>
                <p>Our location for in-person visits:</p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.2264690177167!2d-122.41941558469028!3d37.77492957975953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858064d6bbd95f%3A0x540ed8e120c1cf1c!2sSan%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2s!4v1694722068896!5m2!1sen!2s"
                    width="100%"
                    height="150"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date("Y"); ?> Petfinder. All rights reserved.</p>

        </div>
    </footer>
</body>

</html>