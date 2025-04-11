<!DOCTYPE html>
<html>
    <head>
        <title>Pet Adoption</title>
        <link rel="stylesheet" href="style2.css">
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
    <div class="content">
        <h1>Welcome to Pet Adoption</h1>
        <p>Browse pets from our network of shelters and recues.</p>
    </div>
 
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
    <div class="banner">
        <h2>Shelteres are full!</h2>
        <p>Help pets get out.</p>
    </div>
    <div class="pets">
        <button class="pet-card" onclick="window.location.href='/UEB24_Gr36/adopt/dogs/dog.html?name=Buddy'">
            <img src="images/dog1.avif" alt="dog1">
            <p>Buddy</p>
        </button>
        <button class="pet-card" onclick="window.location.href='/UEB24_Gr36/adopt/cats/cat.html?name=Tom'">
            <img src="images/cat1.jpg" alt="act1">
            <p>Tom</p>
        </button>
        <button class="pet-card" onclick="window.location.href='/UEB24_Gr36/adopt/rabbits/rabbit.html?name=Houdini'">
            <img src="images/rabbit1.jpg" alt="rabbit1">
            <p>Houdini</p>
        </button>
        <button class="pet-card1" onclick="window.location.href='/UEB24_Gr36/adopt/birds/bird.html?name=Bruno'">
            <img src="images/bird1.jpg" alt="">
            <p>Bruno</p>
        </button>
    </div>
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
            <p>Learn to translate dog years to human years just for fun, and vice versa. </p>
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