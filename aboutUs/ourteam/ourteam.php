<?php
include 'C:\XAMPP\htdocs\UEB24_Gr36\faqja_kryesore\header.php';
?>
<!DOCTYPE html>

<head>
  <title>About Us-Our Team</title>
  <link rel="stylesheet" href="ourTeam.css">
</head>

<body>
 
  <section class="main-content" id="main-content">
    <?php
    $title = "Welcome to Our Team";
    $upperTitle = strtoupper($title);
    ?>
    <div class="overlay">
      <h1><?php echo $upperTitle; ?></h1>
      <?php $subtitle = "Making a Difference";
      $lowerSubtitle = strtolower($subtitle); ?>
      <span><?php echo $lowerSubtitle; ?></span>
      <p>
        We are a dedicated team of three passionate individuals managing<br> over
        <strong>5,000 grants annually</strong>,we work towards making a significant <br> impact with efficiency and care.</br>
      </p>

      <a href="/UEB24_Gr36/aboutUs/our impact/aaa.php" class="learn-more-button">Our Impact</a>

    </div>
  </section>
  <?php
  $team_members = [
    [
      "name" => "Riley Morgan",
      "role" => "Executive Director",
      "image" => "imageourteam/pawprint.png",
      "alt" => "Team Member Icon"
    ],
    [
      "name" => "Peyton Blake",
      "role" => "Chief Development Officer",
      "image" => "imageourteam/pawprint.png",
      "alt" => "Team Member Icon"
    ],
    [
      "name" => "Jordan Lee",
      "role" => "Program Manager",
      "image" => "imageourteam/pawprint.png",
      "alt" => "Team Member Icon"
    ]
  ];
  ?>
  <section class="team-section">
    <h1 class="section-title">Meet Our Team</h1>
    <div class="team-members">
      <?php foreach ($team_members as $member): ?>
        <div class="team-member">
          <img src="<?= htmlspecialchars($member['image']) ?>" alt="<?= htmlspecialchars($member['alt']) ?>" class="team-icon">
          <h2><?= htmlspecialchars($member['name']) ?></h2>
          <p><?= htmlspecialchars($member['role']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <section class="contact-section">
    <div class="contact-image">
      <img src="imageourteam/istockphoto-1495427635-612x612.jpg" alt="A person feeding a cat">
    </div>
    <div class="contact-text">
      <h2>Trying to reach Petfinder.com?</h2>
      <p>
        We can NOT answer questions about Petfinder.com, the pet adoption website.
        If you need to contact Petfinder.com, please click the button below.
      </p>
      <a href="/UEB24_Gr36/get_help/getHelp.php" class="contact-button">Get Help</a>
    </div>
  </section>
  <div id="footer"></div>
  <script src="/UEB24_Gr36/adopt/footer.js"></script>
</body>

</html>