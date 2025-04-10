<?php
  $base_url = "/UEB24_Gr36";
?>

<footer class="footer">
  <link rel="stylesheet" href="<?= $base_url ?>/adopt/footer.css">

  <div class="container1">
    <div class="footer-section">
      <h2 class="footer-logo">Petfinder</h2>
      <p class="footer-description"> Finding Forever Friends,<br> One Paw at a Time!</p>
    </div>

    <div class="footer-section">
      <h3>Contact us</h3>
      <address>
        <ul>
          <li>+383 45 *** ***</li>
          <li><a href="mailto:petfinder@gmail.com">petfinder@gmail.com</a></li>
          <li><a href="https://www.instagram.com/">Instagram</a></li>
          <li><a href="https://www.facebook.com/">Facebook</a></li>
        </ul>
      </address>
    </div>

    <div class="footer-section">
      <h3>About us</h3>
      <ul>
        <li><a href="<?= $base_url ?>/aboutUs/our impact/aaa.php">Our Impact</a></li>
        <li><a href="<?= $base_url ?>/aboutUs/ourteam/ourteam.php">Our Team</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Adopt</h3>
      <ul>
        <li><a href="<?= $base_url ?>/adopt/dogs/dogs.php">Dog</a></li>
        <li><a href="<?= $base_url ?>/adopt/cats/cats.php">Cat</a></li>
        <li><a href="<?= $base_url ?>/adopt/rabbits/rabbits.php">Rabbit</a></li>
        <li><a href="<?= $base_url ?>/adopt/birds/birds.php">Bird</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Become a Volunteer</h3>
      <p>Join us and make a difference in the lives of pets.</p>
      <form class="subscribe-form">
        <input type="email" placeholder="Enter your email address" required>
        <button type="submit">➤</button>
      </form>
      <h3>Make a difference in the lives of animals, help them find loving homes.</h3>
    </div>

    <div class="footer-section">
      <h3>Find Us Here</h3>
      <p>Our location for in-person visits:</p>
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!..." 
        width="100%" 
        height="150" 
        style="border:0;" 
        allowfullscreen 
        loading="lazy">
      </iframe>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2024 Pet Adoption | All rights reserved</p>
  </div>
</footer>
