<!DOCTYPE html>
<head>
    <title>About Us-Our Team</title>
<link rel="stylesheet" href="ourTeam.css">
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
  </script>
  
 
  <script src="/UEB24_Gr36/faqja_kryesore/header.php"></script>
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
            We are a dedicated team of three passionate individuals managing<br>  over 
            <strong>5,000 grants annually</strong>,we work towards making a significant <br>  impact with efficiency and care.</br>
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

  