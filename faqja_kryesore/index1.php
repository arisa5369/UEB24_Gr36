<?php
require_once 'classes/pet.php';
require_once 'classes/dog.php';
$pets = [
  new Dog(1, 'Baki', 3, 'assets/images/dog1.jpg', 'Labrador'),
  new Dog(2, 'Rex', 5, 'assets/images/dog2.jpg', 'German Shepherd')
];
?>

<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Petfinder - <?php echo $faqja; ?></title>
  <link rel="stylesheet" href="style44.css">
  <script src="index1.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
      $(document).ready(function () {
    setTimeout(function () {
        $('#myModal').addClass('show'); 
    }, 2000);

    $('#closeModalBtn').on('click', function () { 
        $('#myModal').removeClass('show'); 
    });

    $('#openModalBtn').on('click', function () {
        $('#myModal').fadeIn(); 
    });

    $('#closeModalBtn').on('click', function () {
        $('#myModal').fadeOut(); 
    });

    $('.step').on('mouseenter', function () {
        $(this).css({
            'background-color': '#d1f5f5',
            'transform': 'scale(1.05)',
            'transition': 'all 0.3s ease'
        });
    }).on('mouseleave', function () {
        $(this).css({
            'background-color': '#eaf5f5',
            'transform': 'scale(1)'
        });
    });

    $(window).on('scroll', function () {
        $('.adopting-expectations .step').each(function () {
            var stepPosition = $(this).offset().top; 
            var screenPosition = $(window).scrollTop() + $(window).height();

            if (stepPosition < screenPosition) {
                $(this).addClass('animate'); 
            }
        });
    });

    $('#callbackExample').on('click', function () {
        $('#myModal').slideUp(500, function () { 
            alert('Modal u mbyll!'); 
        });
    });

    console.log($('#exampleDiv').html());

    $('#exampleDiv').html('<p>Ky është përmbajtja e re!</p>');

    $('#exampleDiv').append('<p>Ky është një paragraf i shtuar.</p>');

    $('#exampleDiv p:first').remove();
});
      
  </script>
  
 
  <script src="/UEB24_Gr36/faqja_kryesore/script.js"></script>
  
  <section class="hero">
          <div class="video-container">
            <video autoplay muted loop>
              <source src="Video of dog.mp4" type="video/mp4">
            </video>
          </div>
          <div class="hero-overlay">
            <div class="hero-content">
            <h1 class="hero-title">Petfinder</h1>
            <p class="hero-subtitle">Giving Pets the Lives They Deserve</p>
            <div class="hero-buttons">
                <a href="/UEB24_Gr36/adopt/index.php" class="adopt-btn">Adoptable Pets</a>
                <a href="/UEB24_Gr36/donate/donate.php" class="donate-btn">Donate</a>
            </div>
    </div>
</section>

<?php
  define("ORGANIZATION_NAME", "Petfinder");

  $hour = date("H"); // Ora në format 24h (0-23)
  $greeting = "";

  switch (true) {
    case ($hour >= 5 && $hour < 12):
      $greeting = "Good Morning";
      break;
    case ($hour >= 12 && $hour < 17):
      $greeting = "Good Afternoon";
      break;
    case ($hour >= 17 && $hour < 21):
      $greeting = "Good Evening";
      break;
    default:
      $greeting = "Good Night";
      break;
  }

  echo "<h2 style='text-align:center; color:#ff6600;'>$greeting and welcome to " . ORGANIZATION_NAME . "</h2>";
?>


<div id="auth-modal" class="modal">
  <div class="modal-content">
    <h2>Welcome to Petfinder</h2>
    <p>Log in or sign up to save your favorite pets.</p>
    <button class="create-account-btn">Create Petfinder Account</button>
    <button class="login-btn">Log in with Petfinder</button>
    <p>or continue with</p>
    <div class="social-login">
      <button class="social-btn google">Google</button>
      <button class="social-btn apple">Apple</button>
      <button class="social-btn facebook">Facebook</button>
    </div>
  </div>
</div>

  <section class="about">
    <div class="about-content">
      <div class="text">
        <h2>Changing and saving lives together…</h2>
        <p>
          As the only full-service animal shelter serving Jefferson County, Colorado, we collaborate with our community to improve the lives of thousands of pets each year, creating a better community for all.

          Our purpose is to Make Life Better for Pets and People. Our team shares your passion to improve the situation for our community’s animals. Become a part of our community, in whatever way you can, and let’s start improving lives together today.
        </p>
        <br>
      </div>
<div class="motivational-quote">
</div>

      <div class="image">
        <img src="imagess/Kafshet.jpg">
      </div>
    </div>
  </section>
  <section class="get-involved">
    <div class="involved-container">
        <h2>At Petfinder, it’s about the animals</h2>
        <p>Whether you are here to adopt or you want to help out with writing, fundraising, or event planning and support, these are just a few of the incredibly valuable ways to be of service.</p>
       
       <?php

$citates = [
    "You can’t buy love, but you can adopt it.",
    "Saving one pet won’t change the world, but for that pet, the world will change forever.",
    "Adopt, don’t shop.",
    "Until one has loved an animal, a part of one’s soul remains unawakened."
];

$citatiRandom = $citates[array_rand($citates)];

?>

<div class="motivational-quote">
  <blockquote><?php echo $citatiRandom; ?></blockquote>
</div>

        <div class="cards">
            <div class="card">
                <div class="image-container">
                    <img src="imagess/Man with cat.jpg" alt="Volunteer with cats">
                    <div class="overlay">
                        <h3>Stories</h3>
                        <a href="/UEB24_Gr36/donate/donate2.php" class="btn">SUCCESS STORIES</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="image-container">
                    <img src="imagess/lepuri.jpg" alt="Donate for the rabbit">
                    <div class="overlay">
                        <h3>Donate</h3>
                        <a href="/UEB24_Gr36/donate/donate.php" class="btn">Donation Options</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="image-container">
                    <img src="imagess/parrot2.webp" alt="Foster a parrot">
                    <div class="overlay">
                        <h3>Foster</h3>
                        <a href="/UEB24_Gr36/foster/foster.php" class="btn">Learn About Fostering</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    </section>
  </section>
  
  <section class="adopting-expectations">
    <div class="container">
      <h2>What to Expect When Adopting</h2>
      <p>
        We are seeking true forever homes. Most of the animals in our care live in foster homes while they await adoption, which is how we know so much about their habits, likes, and dislikes. Our adoption counselors are happy to help you every step of the way to find the best match for you.
      </p>
      
      <?php

$steps = [
"Apply" => [
  "description" => "Visit our adoption page and click on the animal you’re interested in to apply.",
  "image" => "Apply.png",
  "alt" => "Apply Icon"
],
"Matchmaking Call" => [
  "description" => "Within 24-72 hours of applying, you can expect to connect and chat with one of our adoption counselors to get you started on your search to find the right animal!",
  "image" => "Matchmaking Icon.png",
  "alt" => "Matchmaking Icon"
],
"Meet & Greet Session" => [
  "description" => "We’ll introduce you to pets either at our adoption lounge and/or in Petfinder foster homes.",
  "image" => "Meet Greet Session.png",
  "alt" => "Meet & Greet Icon"
],
"Finalize the Adoption" => [
  "description" => "Adopt the animal of your dreams and live happily ever after! Receive a text from our team to finalize the adoption, sign your contract, and pay your fee. Then, the only thing left to do is prepare and arrange to have your new family member join you at home.",
  "image" => "Finalize Adoption Icon 1.png",
  "alt" => "Finalize Adoption Icon"
]
];

?>

<div class="steps">

  <?php 
  foreach ($steps as $title => $info): 
  ?>

   <div class="step">
    <img src="imagess/<?php echo $info['image']; ?>" alt="<?php echo $info['alt']; ?>">
     <h3><?php echo $title; ?></h3>
     <p><?php echo $info['description']; ?></p>
    </div>
    <?php endforeach; ?>

</div>
<div class="cta">
  <a href="/UEB24_Gr36/adopt/index.php" class="adoptable-cats-btn">Adoptable Pets</a>
</div>
 </div>
</section>
<section class="litter-mates-club">
  <div class="content-wrapper">
    <div class="image">
      <img src="imagess/woman with pets.jpg" alt="Woman holding pets">
    </div>
    <div class="text-content">
      <h2>Litter Mates Club</h2>
      <p>

Petfinder was founded in St. Louis to help animals who don’t fit into the traditional shelter environment. Our Litter Mates Feline and Canine Ambassadors may have been injured or may have medical and/or behavioral issues. They may be sick, geriatric, or in need of hospice care. Many are neonatal kittens or puppies for which very few other resources exist. Some Litter Mates will spend their entire lives at Petfinder, and we’re thankful that we can ensure they’re living the happy, healthy lives they deserve in comfort rather than facing unnecessary euthanasia.
        </p>
        <a href="/UEB24_Gr36/donate/donate.php" class="learn-more-btn">Learn More About Litter Mates</a>
      </div>
    </div>
  </section>


  <div id="footer"></div>
<script src="/UEB24_Gr36/adopt/footer.js"></script>


        </div>
    </div>
</section>
</html>