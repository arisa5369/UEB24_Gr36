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
    
   
    <script src="../faqja_kryesore/script.js"></script>
        <section class="main-content" id="main-content">
            <div class="overlay">
                <h1>Our Impact</h1>
                <span><i>Making a Difference</i></span>
                <p>
                    At the <b>Petfinder Foundation</b>, we maximize your donations<br>
                    to ensure a meaningful impact on pets in need,<br>
                    providing them with love and care.
                </p>
                <a href="../ourteam/ourTeam.html" class="learn-more-button">Discover More About Us</a>
            </div>
        </section>
    

    <main>
        <div class="content">
            <h2><u>Efficiency + Effectiveness</u></h2>
            <p>
            The <b>Petfinder Foundation</b> is the ONLY national organization that funds animal shelters and rescue groups exclusively.</p>
            <p>
                More than 91% of every dollar we spend goes toward programs that help homeless pets, earning us the highest possible ratings from independent charity watchdogs Charity Navigator and GuideStar.
            </p>
            <p>
                Give with confidence to the Petfinder Foundation, knowing that your donation will make a difference!
            </p>
        </div>

        <div class="content-item"  align="center">
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
