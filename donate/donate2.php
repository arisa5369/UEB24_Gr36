<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="donate2.css">
    <title>Image Gallery</title>
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
    <h1 class="fancy-title">"Every adoption is a success story waiting to be written.❤️"</h1>
    <div class="container">
      
        <img src="imagedonate/photo1.jpg" alt="Image 1">
        <img src="imagedonate/photo2.jpg" alt="Image 2">
        <img src="imagedonate/photo3.jpg" alt="Image 3">
        <img src="imagedonate/photo4.jpg" alt="Image 4">
        <img src="imagedonate/photo5.jpg" alt="Image 5">
        <img src="imagedonate/photo6.jpg" alt="Image 6">

    </div>

    <div class="testimonial-section">
        <div class="testimonial-container">
          <div class="testimonial-image">
            <img src="imagedonate/prada.jpg" alt="Prada" />
          <div class="testimonial-text">
            <h2>Prada, The Perfect Companion</h2>
            <p>
                "Prada came into my life after a very difficult time.
                 She was a small, neglected dog, scared and alone, but
                  through Petfinder, she found a warm home. Today, Prada
                   is my best friend. Every day is an adventure with her,
                    and she has brought so much joy and love into my life. 
                    I can’t imagine my life without her. Petfinder changed
                     our future, and I’m so grateful for the opportunity 
                     to be part of Prada’s success story."
            </p>
            <p class="testimonial-author">
              <strong>GINA K.</strong><br />
              FOSTER PARENT
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="testimonial-section">
        <div class="testimonial-container">
          <div class="testimonial-image">
            <img src="imagedonate/kitty.jpg" alt="mia" />
          <div class="testimonial-text">
            <h2> Mia, The Kitty of Love</h2>
            <p>
                
                "Mia was a kitten who had spent a long time in a shelter. She needed love and care, and when I saw her on Petfinder, I couldn’t wait to meet her. Since she entered my life, everything has changed. Mia is an endless source of love and comfort, and I treasure every moment we share together. We’re making unforgettable memories, and I know we’ve saved each other. This is our success story, thanks to Petfinder!"
                
                
            </p>
            <p class="testimonial-author">
              <strong>Ariana G.</strong><br />
              FOSTER PARENT
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="testimonial-section">
        <div class="testimonial-container">
          <div class="testimonial-image">
            <img src="imagedonate/luna.jpg" alt="luna" />
          <div class="testimonial-text">
            <h2>Luna, The Shining Light</h2>
            <p>
                
                "Luna was a stray cat who had been through a rough time. When we found her on Petfinder, we knew she was meant to be ours. She has brought a new light into our lives. Now, Luna is part of our family, and she’s more than a pet – she’s a true family member. Every day is brighter with her. Thanks to Petfinder, we found a love that’s pure and sincere."
                
                
            </p>
            <p class="testimonial-author">
              <strong>Dylan O.</strong><br />
              FOSTER PARENT
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="testimonial-section">
        <div class="testimonial-container">
          <div class="testimonial-image">
            <img src="imagedonate/parrot.jpg" alt="Charlie" />
          <div class="testimonial-text">
            <h2>  Charlie, The Joy of Our Home</h2>
            <p>
              
                "When Charlie came into our lives, he was a scared and withdrawn parrot. After a period of adjustment, he began to open his heart and show his love. Now, he’s an energetic, happy soul who shares every moment of our lives. He’s changed my life, and every day he reminds me that love and care can save any soul. Thanks to Petfinder, Charlie found a new family, and we found a lifelong friend."
            </p>
            <p class="testimonial-author">
              <strong>Iris M.</strong><br />
              FOSTER PARENT
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="testimonial-section">
        <div class="testimonial-container">
          <div class="testimonial-image">
            <img src="imagedonate/daisy.jpg" alt="Daisy" />
          <div class="testimonial-text">
            <h2>Daisy, An Unmatched Love</h2>
            <p>
                
                "Daisy was a lost cat who had gone through many hardships before finding her forever home. When we found her on Petfinder, our hearts were comforted because we knew we were meant to be together. She’s full of energy and always ready to do her best. Daisy has brought unparalleled joy and unconditional love into our lives. Our success story was created together, and it’s an opportunity Petfinder gave us."
                
                
            </p>
            <p class="testimonial-author">
              <strong>Riley O.</strong><br />
              FOSTER PARENT
            </p>
          </div>
        </div>
      </div>
    </div>
    <a href="../aboutUs/our impact/aaa.html" class="back-button">← Back to Home</a>
    <div id="footer"></div>
        <script src="/UEB24_Gr36/adopt/footer.js"></script>   
</body>
</html>
