<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = [];

  $firstName = trim($_POST["firstName"] ?? "");
  $lastName = trim($_POST["lastName"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $phone = trim($_POST["phone"] ?? "");
  $address = trim($_POST["address"] ?? "");
  $experience = trim($_POST["experience"] ?? "");
  $birthDate = trim($_POST["birthDate"] ?? "");  

  if (empty($firstName) || !preg_match("/^[A-Za-z]{2,}$/", $firstName)) {
    $errors[] = "First name is required and should be at least 2 letters.";
  }

  if (empty($lastName) || !preg_match("/^[A-Za-z]{2,}$/", $lastName)) {
    $errors[] = "Last name is required and should be at least 2 letters.";
  }

  if (empty($email) || !preg_match("/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $email)) {
    $errors[] = "Valid email is required.";
  }

  if (empty($phone) || !preg_match("/^(\d{2,4}-?)+$/", $phone)) {
    $errors[] = "Valid phone number is required (can include -).";
  }

  if (!empty($birthDate) && !preg_match("/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/", $birthDate)) {
    $errors[] = "Birth date must be in format YYYY-MM-DD.";
  }

  if (empty($address)) {
    $errors[] = "Address is required.";
  }

  if (empty($experience)) {
    $errors[] = "Please tell us why you want to foster a pet.";
  }

  $experience = preg_replace("/\s+/", " ", $experience);

  if (empty($errors)) {
    header("Location: foster.php?success=1");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foster with Petfinder</title>
  <link rel="stylesheet" href="stylef.css">
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

  <div class="container">
    <div class="content">
      <h1>Foster with Petfinder</h1>
      <p>
        Becoming a foster parent is one of the most impactful and <br>rewarding ways you can help Petfinder fulfill our mission to give <br>all cats the lives they deserve and put an end to unnecessary euthanasia.
      </p>
    </div>
    <div class="images">
      <img src="images2/dogg.jpg" alt="Woman holding a dog">
      <img src="images2/cat1.avif" alt="Man holding cats">
    </div>
  </div>
  <div class="why-foster-section">
    <div class="why-foster-container">
      <div class="foster-image">
        <img src="images2/group of pets.jpg" alt="Group of cats">
      </div>
      <div class="foster-content">
        <h2>Why foster?</h2>
        <p>
          Petfinder depends on foster parents to save lives. By fostering, you offer a pet a second chance—and gain a rewarding experience in return. 
          We’re a judgment-free, supportive community for both pets and humans, welcoming fosters who communicate openly and work toward timely adoptions, 
          helping us create space for more pets.
          </p>
          <div class="actions1">
            <button class="signup-btn1">Foster Application</button>
     </div>
     <div class="why-foster">
      </div>
      </div>
      </div>
        <div id="modal" class="modal">
          <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Foster Application</h2>
            <p>Learn about our foster policies and complete your foster application to help us save more lives.</p>
            <button id="startFosterApplication">Start Foster Application</button>
            <hr>
          </div>
        </div>
      </div>
      <div id="applicationModal" class="modal">
        <div class="modal-content">
          <span class="close" id="closeApplicationModal">&times;</span>
          <h2>Foster Application</h2>

          <?php if (!empty($errors)): ?>
            <div class="error-messages">
             <ul>
              <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
                </ul>
                </div>
                <?php endif; ?>

          <form id="fosterForm" method="POST" action="foster.php">

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required />
      
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required />
      
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
      
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required />
      
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="3" required></textarea>
      
            <label for="experience">Why do you want to foster a pet?</label>
            <textarea id="experience" name="experience" rows="4" required></textarea>
      
            <button type="submit">Submit Application</button>
          </form>
        </div>
      </div>
      <div class="testimonial-section">
        <div class="testimonial-container">
          <div class="testimonial-image">
            <img src="images2/Gina K. with cat.webp" alt="Gina K. with cat" />
          <div class="testimonial-text">
            <p>
              “I’ve been a volunteer and foster parent for Petfinder pet Rescue since
              2013. I could do this at many other rescues, but I love Petfinder
              because I’ve always felt like part of a family there. The support I get
              is amazing. And Petfinder’s mission of prioritizing pets with special
              needs is especially close to my heart. I have fostered many cats who
              were blind or missing limbs and several who needed hospice care. Hospice
              fostering has been particularly rewarding for me. Ensuring that the last
              chapter of a cat’s life is as happy and comfortable as possible is so
              important, and Petfinder makes sure that these deserving pets have
              everything they could possibly need. Thank you, Petfinder, for always
              giving cats the lives they deserve.”
            </p>
            <p class="testimonial-author">
              <strong>GINA K.</strong><br />
              FOSTER PARENT
            </p>
          </div>
        </div>
      </div>
    </div>
              <h2>Pets Looking For a Foster Family</h2> 
              <div class="pets">
              <button class="pet-card" onclick="window.location.href='../adopt/dogs/dog.html?name=Buddy'">
            <img src="images2/dog1.avif" alt="dog1">
            <p>Buddy</p>
        </button>
        <button class="pet-card" onclick="window.location.href='../adopt/cats/cat.html?name=Tom'">
            <img src="images2/cat1.jpg" alt="act1">
            <p>Tom</p>
        </button>
        <button class="pet-card" onclick="window.location.href='../adopt/rabbits/rabbit.html?name=Houdini'">
            <img src="images2/rabbit1.jpg" alt="rabbit1">
            <p>Houdini</p>
        </button>
        <button class="pet-card1" onclick="window.location.href='../adopt/birds/bird.html?name=Bruno'">
            <img src="images2/bird1.jpg" alt="">
            <p>Bruno</p>
        </button>
    </div>

  <div class="faq-container">
    <h2>FAQs About Petfinder and Animal Adoption</h2>
    <table>
      <tr>
        <th>FAQ Question</th>
      </tr>
      <tr>
        <td>
          <details>
            <summary>What is Petfinder?</summary>
            <div class="faq-answer">
              <p>Petfinder is an online resource where you can find adoptable pets from shelters and rescues across the country. It's a platform that helps connect animals in need with potential adopters.</p>
            </div>
          </details>
        </td>
      </tr>
      <tr>
        <td>
          <details>
            <summary>What types of animals can I find on Petfinder?</summary>
            <div class="faq-answer">
              <p>Petfinder offers a wide variety of animals for adoption, including dogs, cats, rabbits, birds, reptiles, and even small pets like hamsters and guinea pigs.</p>
            </div>
          </details>
        </td>
      </tr>
      <tr>
        <td>
          <details>
            <summary>How can I search for a pet on Petfinder?</summary>
            <div class="faq-answer">
              <p>You can search for pets on Petfinder by location, animal type, breed, age, size, and even specific characteristics like "good with kids" or "house-trained."</p>
            </div>
          </details>
        </td>
      </tr>
      <tr>
        <td>
          <details>
            <summary>Is there a cost to adopt a pet through Petfinder?</summary>
            <div class="faq-answer">
              <p>Yes, adoption fees vary depending on the shelter or rescue organization. These fees typically cover vaccinations, spaying or neutering, and other basic care the pet has received.</p>
            </div>
          </details>
        </td>
      </tr>
      <tr>
        <td>
          <details>
            <summary>How do I contact the shelter or rescue listed on Petfinder?</summary>
            <div class="faq-answer">
              <p>Each pet listing on Petfinder includes contact information for the shelter or rescue organization. You can reach out directly to inquire about the adoption process.</p>
            </div>
          </details>
        </td>
      </tr>
      <tr>
        <td>
          <details>
            <summary>Does Petfinder help with fostering pets?</summary>
            <div class="faq-answer">
              <p>Yes, many shelters and rescues on Petfinder also offer foster programs. You can reach out to them through the contact information provided to learn more about fostering opportunities.</p>
            </div>
          </details>
        </td>
      </tr>
    </table>
  </div>
  <script src="../foster/foster.js"></script> 

    <section class="call-to-action">
    <div class="overlay2">
      <h1>More ways to get involved with Petfinder</h1>
      <div class="donation-grid">
          <button>Volunteer</button>
          <button>Donate</button>
          <button>Adopt</button>
      </div>
  </div>
  <div id="footer"></div>
<script src="/UEB24_Gr36/adopt/footer.js"></script> 

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
  <div id="successModal" class="modal">
    <div class="modal-content">
      <h2> Thank you for your application!🐾 </h2>
      <p> Our team will get in touch with you shortly.</p>
      <button onclick="closeModal()">OK</button>
    </div>
  </div>

  <style>
    .modal {
      display: flex;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      height: 100vh;
      width: 100vw;
      background: rgba(0, 0, 0, 0.5);
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background-color: #fff;
      padding: 30px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      max-width: 400px;
      animation: fadeIn 0.3s ease;
    }

    .modal-content h2 {
      color: #236e69;
      margin-bottom: 15px;
    }

    .modal-content p {
      font-size: 1rem;
      color: #444;
      margin-bottom: 25px;
    }

    .modal-content button {
      background-color: #236e69;
      color: white;
      border: none;
      padding: 10px 25px;
      border-radius: 10px;
      font-size: 1rem;
      cursor: pointer;
    }

    .modal-content button:hover {
      background-color: #236e69;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

<script>
   window.addEventListener("DOMContentLoaded", () => {
    const thankYouModal = document.getElementById("successModal");
    const closeBtn = thankYouModal?.querySelector("button");
    const startFosterBtn = document.getElementById("startFosterApplication");
    const applicationModal = document.getElementById("applicationModal");

    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');

    if (success === '1') {
      if (startFosterBtn) {
        startFosterBtn.disabled = true;
        startFosterBtn.style.display = 'none'; 
      }

      if (applicationModal) {
        applicationModal.style.display = "none";
      }

      if (closeBtn) {
        closeBtn.addEventListener("click", () => {
          thankYouModal.style.display = "none";
        });
      }
    }

    if (startFosterBtn && applicationModal) {
      startFosterBtn.addEventListener("click", () => {
        if (success !== '1') {
          applicationModal.style.display = "flex";
        }
      });
    }

    const closeApplicationModal = document.getElementById("closeApplicationModal");
    if (closeApplicationModal) {
      closeApplicationModal.addEventListener("click", () => {
        applicationModal.style.display = "none";
      });
    }

  });
  <?php endif; ?> 
</script>

</body>
</html>