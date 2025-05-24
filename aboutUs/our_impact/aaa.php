<?php
include 'C:\XAMPP\htdocs\UEB24_Gr36\faqja_kryesore\header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>About Us - Making a Difference</title>
  <link rel="stylesheet" href="style1.css">
</head>

<body>

  <section class="main-content" id="main-content">
    <div class="overlay">
      <?php $title = "Our Impact";
      $upperTitle = strtoupper($title);
      ?>
      <h1><?php echo $upperTitle; ?></h1>

      <?php $subtitle = "Making a Difference";
      $lowerSubtitle = strtolower($subtitle); ?>
      <span><?php echo $lowerSubtitle; ?></span>
      <p>
        At the <b>Petfinder Foundation</b>, we maximize your donations<br>
        to ensure a meaningful impact on pets in need,<br>
        providing them with love and care.
      </p>
      <a href="/UEB24_Gr36/aboutUs/ourteam/ourTeam.php" class="learn-more-button">Discover More About Us</a>
    </div>
  </section>

  <?php include 'impactInfo.php'; ?>
  <main>


    <div class="content-item">
      <h2>Where Your Money Goes</h2>
      <p>Read our 990 forms and audited financial statements to see where your donations go.</p>
    </div>

    <section class="content1">
      <div class="image-text-container">
        <img src="images/whiterabbit.jpg" alt="Girl with a dog" class="content-image">
        <div class="content-text">
          <p>Transparency and accountability are at the core of our mission. We ensure every donation makes a meaningful impact on the lives of pets in need.</p>

        </div>
      </div>
    </section>

    <section class="stats-section">
      <hr class="styled-line">
      <div class="stats-items">
        <div class="stats-item">
          <img src="images/wired-outline-948-stock-share-hover-pinch.gif" alt="Grant Funds Icon" class="stats-icon">
          <h2>$625,000</h2>
          <p>Grant funds<br>awarded in 2024</p>
        </div>
        <div class="stats-item">
          <img src="images/system-solid-160-trending-up-hover-trend-up.gif" alt="Home Pets Icon" class="stats-icon">
          <h2>2,101</h2>
          <p>Total grants<br>to shelters in 2024</p>
        </div>
        <div class="stats-item">
          <img src="images/love.png" alt="Homeless Pets Icon" class="stats-icon">
          <h2>122,937</h2>
          <p>Homeless pets<br>helped in 2024</p>
        </div>

      </div>
      <hr class="styled-line">
    </section>

    <section class="impact">
      <div class="impact-text">
        <h2>Your Impact in Action</h2>
        <p>Our success stories, written by the adoption groups that receive our grants, introduce you to the pets helped by your donations.</p>
        <a href="/UEB24_Gr36/donate/donate2.php" class="button">READ SUCCESS STORIES</a>
      </div>
      <div class="impact-image">
        <img src="images/male-vs-female-dogs.webp" alt="Man with dogs">
      </div>
    </section>
  </main>
  <div id="footer"></div>
  <script src="/UEB24_Gr36/adopt/footer.js"></script>
</body>

</html>