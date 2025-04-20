<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us - Making a Difference</title>
    <link rel="stylesheet" href="style1.css">
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
    
   
    <script src="/UEB24_Gr36/faqja_kryesore/script.js"></script>
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

        <?php

class ImpactStat {
    public $amount;
    public $description;
    public $image;
    public $alt;

    public function __construct($amount, $description, $image, $alt) {
        $this->amount = $amount;
        $this->description = $description;
        $this->image = $image;
        $this->alt = $alt;
    }

    public function display() {
        echo '<div class="stats-item">';
        echo '<img src="' . $this->image . '" alt="' . $this->alt . '" class="stats-icon">';
        echo '<h2>' . $this->amount . '</h2>';
        echo '<p>' . $this->description . '</p>';
        echo '</div>';
    }
}

$stats = [
    new ImpactStat('$625,000', 'Grant funds<br>awarded in 2024', 'images/wired-outline-948-stock-share-hover-pinch.gif', 'Grant Funds Icon'),
    new ImpactStat('2,101', 'Total grants<br>to shelters in 2024', 'images/system-solid-160-trending-up-hover-trend-up.gif', 'Home Pets Icon'),
    new ImpactStat('122,937', 'Homeless pets<br>helped in 2024', 'images/love.png', 'Homeless Pets Icon')
];

?>

    <main>
     

        <div class="content-item" >
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
        <?php
        foreach ($stats as $stat) {
            $stat->display();
        }
        ?>
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
