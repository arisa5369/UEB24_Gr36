<!DOCTYPE html>
<html>
    <head>
        <title>Get Help</title>
        <link rel="stylesheet" href="getHelp.css">
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
  
 
 
  
        <div class="adoption-info">
            <h2>Get Help</h2>
            <h2>Planning to Adopt a Pet?</h2>
            <div class="info-card">
              
                <div class="card">
                    <h3>How Old is a Dog in Human Years?</h3>
                    <p>Learn to translate dog years to human years just for fun, and vice versa. </p>
                    <a href="https://www.akc.org/expert-advice/health/how-to-calculate-dog-years-to-human-years/" target="_blank">
                    <button>Learn More</button>
                </a>
                </div>
                <div class="card">
                    <h3>Pet Adoption <br>FAQs</h3>
                    <p>Get answers to all the questions you haven't thought of for your adoption.</p>
                    <a href="https://www.animalhumanesociety.org/resource/adoption-faq" target="_blank"> 
                    <button>Learn More</button>
                </a>
                </div>
            </div>
        </div>

        <div class="adoption-info">
            <div class="info-card">
                <div class="card">
                    <h3>Do the pets in the adoption center have a time limit?</h3>
                    <p>There is no time limit for how long an animal stays in our adoption centers. </p>
                    <a href="https://www.animallaw.info/topic/state-holding-period-laws-impounded-animals" target="_blank">
                    <button>Learn More</button>
                </a>
                </div>
                <div class="card">
                    <h3>What if my new pet doesn’t work out?</h3>
                    <p>Both you and your new pet will need time to get better acquainted and adjust.</p>
                    <a href="https://www.zoetispetcare.com/blog/article/pet-adoption-remorse" target="_blank"> 
                    <button>Learn More</button>
                </a>
                </div>
            </div>
        </div>
        <div class="adoption-info">
            <div class="info-card">
                <div class="card">
                    <h3>What if my new pet gets sick?</h3>
                    <p>Once your adoption is finalized, you will be responsible for all medical bills regarding your pet.</p>
                    <a href="https://www.animalhumanesociety.org/resource/what-if-my-new-pet-gets-sick" target="_blank">
                    <button>Learn More</button>
                </a>
                </div>
                <div class="card">
                    <h3>How do I meet an animal I’m interested in adopting?</h3>
                    <p>You’re welcome to visit the shelter anytime </p>
                    <a href="https://www.petfinder.com/adopt-or-get-involved/adopting-pets/how-to/pet-adoption-faqs/" target="_blank"> 
                    <button>Learn More</button>
                </a>
                </div>
            </div>
        </div>
        <div class="adoption-info">
           
            <div class="info-card">
                <div class="card">
                    <h3>How long will the adoption process take? </h3>
                    <p>Plan to allow up to two hours to complete the adoption process.</p>
                    <a href="https://www.dogster.com/lifestyle/how-long-does-dog-adoption-take" target="_blank">
                    <button>Learn More</button>
                </a>
                </div>
                <div class="card">
                    <h3>Can I place a pet on hold?</h3>
                    <p> You may place an animal on hold for 24 hours</p>
                    <a href="https://support.petrescue.com.au/article/42-using-the-on-hold-feature" target="_blank"> 
                    <button>Learn More</button>
                </a>
                </div>
            </div>
        </div>
        <button id="back-to-top" onclick="scrollToTop()">
          Back to Top
      </button>
      <script src="getHelp.js"></script>
       
        <div id="footer"></div>
        <script src="/UEB24_Gr36/adopt/footer.js"></script>     
    </body>

</html>