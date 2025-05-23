<<<<<<< HEAD

=======
<?php
include 'C:\XAMPP\htdocs\UEB24_Gr36\faqja_kryesore\header.php';
?>
>>>>>>> 70ae3cbcb6b79e8c1b54bd9502d5e901dcb2a235
<!DOCTYPE html>

<head>
  <title>Donate - Tenth Life Cat Rescue</title>
  <link rel="stylesheet" href="donate.css">
</head>

<body>
  <main class="donate-page">
  
    <section class="donate-banner">
      <video class="background-video" autoplay muted loop>
        <source src="imagedonate/mixkit-dog-walking-with-its-owner-in-a-park-1476-hd-ready.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <div class="overlay-content">
        <h1>Make a Difference</h1>
        <p>Your support helps save lives.</p>
      </div>
    </section>
    </div>
      <section class="donate-description">
        <p>
          At Petfinder, your generous support is essential to helping animals in need find loving homes. From dogs and cats to rabbits, birds, and more, your contributions empower our mission to connect pets with caring adopters, provide necessary medical care, and promote responsible pet ownership. No matter the size of your donation, you're making a meaningful impact on the lives of countless animals. Together, we’re creating brighter futures for pets everywhere!
        </p>
    </div>
    </section>
    <section class="donate-images">
        <div class="gallery">
      <div class="image-container">
        <img src="imagedonate/df472840921f08163ae745ecf06d1806.jpg" alt="Person with parrot">
      </div>
      <div class="image-container">
        <img src="imagedonate/2a5b0228078f6644588581e0c765c1ab.jpg" alt="Person with orange and white cat">
      </div>
      <div class="image-container">
        <img src="imagedonate/50f9bfa1ae8fce5f43bc9037d0089ba9.jpg" alt="Person with cream-colored cat">
      </div>
      <div class="image-container">
        <img src="imagedonate/56f2654586a09cbc2d273fcf91cb4d7b.jpg" alt="Person with black cat">
      </div> <div class="image-container">
        <img src="imagedonate/dogperson.jpg" alt="Person with blackkcat">
    </div>
        </div>
    <div class="donation-box">
  <h2>Bëni një Donacion</h2>
  <form id="donation-form" method="POST" action="/UEB24_Gr36/process.donate.php" >
    <div class="donation-type">
      <label>
        <input type="radio" name="donation-type" value="one-time" checked> Një herë
      </label>
      <label>
        <input type="radio" name="donation-type" value="monthly"> Mujore
      </label>
    </div>

    <div class="amount-options">
      <button type="button" data-amount="10">10€</button>
      <button type="button" data-amount="25">25€</button>
      <button type="button" data-amount="50">50€</button>
      <button type="button" data-amount="100">100€</button>
    </div>

    <input type="number" id="custom-amount" name="amount" placeholder="Shuma tjeter (€)" min="1">

    <div class="donor-info">
     <input type="text" id="donor-name" name="donor-name" placeholder="Emri (opsional)">
   <input type="email" id="donor-email" name="donor-email" placeholder="Email (opsional)">
    </div>

    <button type="submit" class="donate-button">DHURO</button>
  </form>
  <div id="donation-message"></div>
</div>


      <div class="litter-mates">
        <h2>Litter Mates Club</h2>
        <p>
          Join our monthly giving program and make a lasting impact! Your ongoing support of any amount helps Petfinder provide shelter, care, and love to animals in need. By contributing to our efforts, you’re ensuring that pets of all kinds—whether furry, feathered, or scaly—are given the chance to find their forever homes and live the happy lives they deserve.
        </p>
            
        <a href="https://www.wildapricot.com/blog/monthly-giving-programs" target="_blank">
        <button class="learn-button">LEARN ABOUT MONTHLY GIVING</button>
      </a>
      </div>
    </section>
    <section class="donation-section">
        <div class="overlay2">
          <h1>What does my donation do?</h1>
          <div class="donation-grid">
            <div class="donation-item">
                <h2>$10</h2>
                <p>Feed 3 neonatal pets for a week</p>
              </div>
              <div class="donation-item">
                <h2>$50</h2>
                <p>Provides medication for a sick pet</p>
              </div>
              <div class="donation-item">
                <h2>$100</h2>
                <p>Provides a pet with their first vet visit, tests, and vaccinations</p>
              </div>
              <div class="donation-item">
                <h2>$125</h2>
                <p>Feeds a litter of pets for a month</p>
              </div>
              <div class="donation-item">
                <h2>$250</h2>
                <p>Covers imaging to help heal a broken limb</p>
              </div>
              <div class="donation-item">
                <h2>$500</h2>
                <p>Helps cover a costly emergency veterinary procedure</p>
              </div>

              

        </div>
        <div class="image-container">
          <img src="imagedonate/2a5b0228078f6644588581e0c765c1ab.jpg" alt="Person with orange and white cat">
        </div>
        <div class="image-container">
          <img src="imagedonate/50f9bfa1ae8fce5f43bc9037d0089ba9.jpg" alt="Person with cream-colored cat">
        </div>
        <div class="image-container">
          <img src="imagedonate/56f2654586a09cbc2d273fcf91cb4d7b.jpg" alt="Person with black cat">
        </div>
        <div class="image-container">
          <img src="imagedonate/dogperson.jpg" alt="Person with blackkcat">
        </div>
      </div>
    </section>
  <section class="donation-options">
      <div class="donation-box">
        <h2>One Time Donation</h2>
        <div class="donation-buttons">
          <button>Monthly</button>
          <button>One Time</button>
        </div>
        <div class="amount-options">
          <button >$25</button>
          <button >$50</button>
          <button >$100</button>
          <button >$250</button>
        </div>
        <input type="text" placeholder="Custom Amount ($)" class="custom-amount">
      <button type="button" class="donate-button">DONATE♡</button>

      </div>

      <div class="litter-mates">
        <h2>Litter Mates Club</h2>
        <p>
          Join our monthly giving program and make a lasting impact! Your ongoing support of any amount helps Petfinder provide shelter, care, and love to animals in need. By contributing to our efforts, you’re ensuring that pets of all kinds—whether furry, feathered, or scaly—are given the chance to find their forever homes and live the happy lives they deserve.
        </p>

        <a href="https://www.wildapricot.com/blog/monthly-giving-programs" target="_blank">
          <button class="learn-button">LEARN ABOUT MONTHLY GIVING</button>
        </a>
      </div>
    </section>
    <section class="donation-section">
      <div class="overlay2">
        <h1>What does my donation do?</h1>
        <div class="donation-grid">
          <div class="donation-item">
            <h2>$10</h2>
            <p>Feed 3 neonatal pets for a week</p>
          </div>
          <div class="donation-item">
            <h2>$50</h2>
            <p>Provides medication for a sick pet</p>
          </div>
          <div class="donation-item">
            <h2>$100</h2>
            <p>Provides a pet with their first vet visit, tests, and vaccinations</p>
          </div>
          <div class="donation-item">
            <h2>$125</h2>
            <p>Feeds a litter of pets for a month</p>
          </div>
          <div class="donation-item">
            <h2>$250</h2>
            <p>Covers imaging to help heal a broken limb</p>
          </div>
          <div class="donation-item">
            <h2>$500</h2>
            <p>Helps cover a costly emergency veterinary procedure</p>
          </div>


        </div>
      </div>
    </section>

    <div class="content-layout">
      <table cellspacing="3" cellpadding="8">
        <tr>
          <td rowspan="2" class="image-column">
            <img src="imagedonate/monetary donation.gif" alt="Monetary Donation">
          </td>
          <td class="header"><b>💵 Monetary Donation</b></td>
        </tr>
        <tr>
          <td class="description">
            Your tax-deductible donation makes it possible for PetFinder to continue rescuing pets in need, providing them with food, shelter, and medical care. </td>
        </tr>
        <tr>
          <td rowspan="2" class="image-column">
            <img src="imagedonate/man.gif" alt="Sponsor Event">
          </td>
          <td class="header"><b>🎉 Sponsor an Event</b></td>
        </tr>
        <tr>
          <td class="description">
            By sponsoring an event like our annual Adoption Fair, you play a vital role in funding PetFinder’s mission to save lives and connect pets with loving families. </td>
        </tr>
        <tr>
          <td rowspan="2" class="image-column">
            <img src="imagedonate/icons8-cat-64.png" alt="Donate Supplies">
          </td>
          <td class="header"><b>🎁 Donate Supplies or a Gift Card</b></td>
        </tr>
        <tr>
          <td class="description">
            Every gift of food, toys, litter, or other essentials allows us to focus funds on life-saving medical care and rehabilitation for pets in need. </td>
        </tr>
        <tr>
          <td rowspan="2" class="image-column">
            <img src="imagedonate/home.gif" alt="Donate Sales">
          </td>
          <td class="header"><b>🍽️ Donate a Portion of Your Sales</b></td>
        </tr>
        <tr>
          <td class="description">
            Support PetFinder by donating a portion of your restaurant, store, or service sales and help make a difference in the lives of vulnerable animals. </td>
        </tr>
        <tr>
          <td rowspan="2" class="image-column">
            <img src="imagedonate/system-regular-48-favorite-heart-hover-heart-1.gif" alt="Heart Icon">
          </td>
          <td class="header"><b>❤️ Donate a Gift Card or Prize</b></td>
        </tr>
        <tr>
          <td class="description">
            Help PetFinder host auctions and raffles that raise essential funds for our mission to create a brighter future for pets everywhere. </td>
        </tr>
      </table>

      <div class="community-partner">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

        <h1>Become a Community Partner ♡</h1>
        <p>
          We’d love to share with the world how your business is saving lives with PetFinder! By partnering with us, you’re making a meaningful difference for the neediest pets and the people who care for them. From donating essential supplies to sponsoring events, there are countless impactful opportunities for your business to make a difference. Join us in creating a safer, happier future for pets in need! </p>

      </div>
    </div>

      </section>
 
      <div class="content-layout">
        <table cellspacing="3" cellpadding="8">
          <tr>
            <td rowspan="2" class="image-column">
              <img src="imagedonate/monetary donation.gif" alt="Monetary Donation">
            </td>
            <td class="header"><b>💵 Monetary Donation</b></td>
          </tr>
          <tr>
            <td class="description">
              Your tax-deductible donation makes it possible for PetFinder to continue rescuing pets in need, providing them with food, shelter, and medical care.            </td>
          </tr>
          <tr>
            <td rowspan="2" class="image-column">
              <img src="imagedonate/man.gif" alt="Sponsor Event">
            </td>
            <td class="header"><b>🎉 Sponsor an Event</b></td>
          </tr>
          <tr>
            <td class="description">
              By sponsoring an event like our annual Adoption Fair, you play a vital role in funding PetFinder’s mission to save lives and connect pets with loving families.            </td>
          </tr>
          <tr>
            <td rowspan="2" class="image-column">
              <img src="imagedonate/icons8-cat-64.png" alt="Donate Supplies">
            </td>
            <td class="header"><b>🎁 Donate Supplies or a Gift Card</b></td>
          </tr>
          <tr>
            <td class="description">
              Every gift of food, toys, litter, or other essentials allows us to focus funds on life-saving medical care and rehabilitation for pets in need.            </td>
          </tr>
          <tr>
            <td rowspan="2" class="image-column">
              <img src="imagedonate/home.gif" alt="Donate Sales">
            </td>
            <td class="header"><b>🍽️ Donate a Portion of Your Sales</b></td>
          </tr>
          <tr>
            <td class="description">
              Support PetFinder by donating a portion of your restaurant, store, or service sales and help make a difference in the lives of vulnerable animals.            </td>
          </tr>
          <tr>
            <td rowspan="2" class="image-column">
              <img src="imagedonate/system-regular-48-favorite-heart-hover-heart-1.gif" alt="Heart Icon">
            </td>
            <td class="header"><b>❤️ Donate a Gift Card or Prize</b></td>
          </tr>
          <tr>
            <td class="description">
              Help PetFinder host auctions and raffles that raise essential funds for our mission to create a brighter future for pets everywhere.            </td>
          </tr>
        </table>
      
        <div class="community-partner">
          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
          <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
          
          <h1>Become a Community Partner ♡</h1>
          <p>
            We’d love to share with the world how your business is saving lives with PetFinder! By partnering with us, you’re making a meaningful difference for the neediest pets and the people who care for them. From donating essential supplies to sponsoring events, there are countless impactful opportunities for your business to make a difference. Join us in creating a safer, happier future for pets in need!          </p>
           
        </div>
      </div>
    
</main>


<div id="donation-modal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    
    <p>Your donation helps provide food, shelter, and medical care to pets in need.</p>
    <hr>
    <p><strong>To proceed with the payment, please contact us using the details below:</strong></p>
    <div class="contact-info">
      <p>
        <strong>Email:</strong> 
        <a href="mailto:petfinder@gmail.com?subject=Donation Inquiry&body=I would like to donate and need further assistance.">petfinder@gmail.com</a>
      </p>
    </div>
    <button class="close-donation-button">Close</button>
  </div>
</div>

<script src="donate.js"></script>
<div id="footer"></div>
<script src="/UEB24_Gr36/adopt/footer.js"></script>    
</body>
</html>

