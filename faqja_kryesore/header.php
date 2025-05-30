<style>
  html,
  body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
  }

  .navbar {
    width: 100%;
    height: 50px;
    position: fixed;
    top: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #ff6600;
    padding: 0 20px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  }

  .logo {
    font-family: 'Comfortaa', cursive;
    font-size: 1rem;
    font-weight: 500;
    text-align: center;
  }

  .purple-text {
    color: #c7c7c7;
  }

  .heart {
    color: #0a0909;
    font-size: 2rem;
    vertical-align: middle;
  }

  button {
    padding: 0 20px;
    border: none;
    cursor: pointer;
    background-color: #ff6600;
    color: white;
    border-radius: 5px;
    font-size: 16px;
  }

  button:hover {
    background-color: #ff8000;
  }

  .modal1 {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    overflow: auto; /* Allow scrolling for the entire modal if content overflows */
  }

  .modal-content1 {
    background-color: #fff;
    border-radius: 15px;
    padding: 20px; /* Reduced from 30px for a more compact look */
    width: 90%;
    max-width: 350px; /* Reduced from 400px for a smaller width */
    max-height: 70vh; /* Limit height to 70% of viewport height */
    overflow-y: auto; /* Enable vertical scrolling if content exceeds max-height */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    text-align: center;
    position: relative;
    animation: slideDown 0.4s ease;
  }

  @keyframes slideDown {
    from {
      transform: translateY(-20px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .close {
    color: #444;
    font-size: 24px;
    font-weight: bold;
    position: absolute;
    top: 15px;
    right: 20px;
    cursor: pointer;
    transition: color 0.3s ease;
  }

  .close:hover {
    color: #ff0000;
  }

  .modal-content1 h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
  }

  .modal-content1 p {
    font-size: 16px;
    margin-bottom: 20px;
    color: #666;
  }

  .modal-content1 button {
    background-color: #ff8000;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    margin: 10px 0;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .modal-content1 button:hover {
    background-color: #ff8000;
  }

  .modal-content1 form {
    text-align: left;
    margin-top: 10px;
  }

  .modal-content1 label {
    font-size: 14px;
    font-weight: bold;
    color: #555;
    display: block;
    margin-bottom: 5px;
  }

  .modal-content1 input {
    width: calc(100% - 20px);
    padding: 8px 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }

  .modal-content1 input:focus {
    border-color: #ff8000;
    outline: none;
  }

  hr {
    border: none;
    height: 1px;
    background: #ccc;
    margin: 20px 0;
  }

  .close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
  }

  .close:hover {
    color: #d4881d;
  }

  .menu ul {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
    justify-content: center;
    align-items: center;
  }

  .menu ul li a {
    text-decoration: none;
    font-weight: bold;
    color: white;
    transition: color 0.3s ease;
  }

  .menu ul li a:hover {
    color: #ffe6cc;
  }

  .actions {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 0 10px;
    padding-right: 50px;
  }

  .signup-btn,
  .foster-btn {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    border: none;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    transition: background-color 0.3s ease, color 0.3s ease;
    transform: scale(1.05);
    min-width: 120px;
    text-align: center;
    margin: 0;
  }

  .signup-btn {
    background-color: white;
    color: #ff6600;
    margin-bottom: 0;
    align-self: center;
  }

  .signup-btn:hover {
    background-color: #ffe6cc;
    color: #ff6600;
  }

  .foster-btn {
    background-color: #ff6600;
    color: white;
  }

  .foster-btn:hover {
    background-color: #e65c00;
    color: white;
  }

  .social-icons {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .social-icons img {
    width: 30px;
    height: 30px;
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .social-icons img:hover {
    transform: scale(1.1);
  }

  @media (max-width: 768px) {
    .hero-title {
      font-size: 2.5rem;
    }

    .hero-subtitle {
      font-size: 1.4rem;
    }

    .hero-buttons .adopt-btn,
    .hero-buttons .foster-btn {
      font-size: 1rem;
      padding: 10px 20px;
    }

    .menu ul {
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
    }

    .actions {
      flex-direction: column;
      gap: 10px;
    }

    .signup-btn,
    .foster-btn {
      width: 100%;
      text-align: center;
    }
  }


  .modal-content1::-webkit-scrollbar {
    width: 8px;
  }

  .modal-content1::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }

  .modal-content1::-webkit-scrollbar-thumb {
    background: #ff6600;
    border-radius: 10px;
  }

  .modal-content1::-webkit-scrollbar-thumb:hover {
    background: #e65c00;
  }

  /* Firefox scrollbar styling */
  .modal-content1 {
    scrollbar-width: thin;
    scrollbar-color: #ff6600 #f1f1f1;
  }
</style>

<header>
    <?php
    if (isset($_GET['success'])) {
        echo "<div class='success-message'>" . htmlspecialchars($_GET['success']) . "</div>";
    }
    ?>
    <div class="navbar">
      <div class="logo">
        <a href="/UEB24_Gr36/faqja_kryesore/index1.php" style="text-decoration: none;">
          <span class="purple-text">pet</span>
          <span class="heart">❤</span>
          <span class="purple-text">finder</span>
        </a>
      </div>
      <nav class="menu">
        <ul>
          <li><a href="/UEB24_Gr36/get_help/getHelp.php">Get Help</a></li>
          <li><a href="/UEB24_Gr36/adopt/index.php">Adopt</a></li>
          <li><a href="/UEB24_Gr36/foster/foster.php">Foster</a></li>
          <li><a href="/UEB24_Gr36/donate/donate2.php">Success Stories</a></li>
          <li><a href="/UEB24_Gr36/aboutUs/our_impact/aaa.php">About Us</a></li>
        </ul>
      </nav>
      <div class="actions">
        <button class="signup-btn">Sign in</button>

        <div id="modal1" class="modal1">
          <div class="modal-content1">
            <span class="close" id="closeModal">×</span>
            <h2>Welcome to Petfinder</h2>
            <p>Log in or sign up to save your favorite pets.</p>
            <button id="openCreateAccount">Create Petfinder Account</button>
            <button id="openLogin">Log in with Petfinder</button>
            <hr>
          </div>
        </div>

        <div id="createAccountModal" class="modal1">
            <div class="modal-content1">
                <span class="close" id="closeCreateAccount">×</span>
                <h2>Create Petfinder Account</h2>

                <form method="POST" action="/UEB24_Gr36/databaza/insert_user.php">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>

                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>

                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                           title="Please enter a valid email address.">

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required
                           pattern="^[A-Za-z0-9]{6,}$"
                           title="Password must be at least 6 characters long and contain only letters and numbers.">

                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required
                           oninput="checkPasswordMatch()">

                    

                    <button type="submit" style="background-color: orange; color: white; padding: 10px 20px; border: none; cursor: pointer;">Sign Up</button>
                </form>
            </div>
        </div>


        
      <div id="loginModal" class="modal1">
    <div class="modal-content1">
        <span class="close" id="closeLogin">×</span>
        <h2>Log in with Petfinder</h2>
        <form method="POST" action="/UEB24_Gr36/databaza/login.php">
            <label for="login-username">Username:</label>
            <input type="text" id="login-username" name="login-username" required
                   pattern="[A-Za-z0-9]{3,}"
                   title="Username must be at least 3 characters long and contain only letters and numbers.">

            <label for="login-password">Password:</label>
            <input type="password" id="login-password" name="login-password" required
                   pattern="[A-Za-z0-9]{6,}"
                   title="Password must be at least 6 characters long and contain only letters and numbers.">

            <button type="submit">Log In</button>
            
        </form>
    </div>
</div>

<div id="forgotPasswordModal" class="modal1" style="display:none;">
    <div class="modal-content1">
        <span class="close" id="closeForgotPassword">×</span>
        <h2>Reset Password</h2>
        <form method="POST" action="/UEB24_Gr36/databaza/forgot_password.php">
            <label for="reset-email">Email:</label>
            <input type="email" id="reset-email" name="reset-email" required
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                   title="Please enter a valid email address.">
            <button type="submit">Send Verification Code</button>
        </form>
    </div>
</div>

<div id="verifyCodeModal" class="modal1" style="display:none;">
    <div class="modal-content1">
        <span class="close" id="closeVerifyCode">×</span>
        <h2>Enter Verification Code</h2>
        <form method="POST" action="/UEB24_Gr36/databaza/reset_password.php">
            <label for="verify-email">Email:</label>
            <input type="email" id="verify-email" name="verify-email" required
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                   title="Please enter a valid email address.">

            <label for="verify-code">Verification Code:</label>
            <input type="text" id="verify-code" name="verify-code" required
                   pattern="[0-9]{6}"
                   title="Verification code must be a 6-digit number.">

            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" required
                   pattern="[A-Za-z0-9]{6,}"
                   title="Password must be at least 6 characters long and contain only letters and numbers.">

            <label for="confirm-new-password">Confirm New Password:</label>
            <input type="password" id="confirm-new-password" name="confirm-new-password" required
                   pattern="[A-Za-z0-9]{6,}"
                   title="Password must be at least 6 characters long and contain only letters and numbers.">

            <button type="submit">Reset Password</button>
        </form>
    </div>
</div>

        <script src="/UEB24_Gr36/faqja_kryesore/script.js"></script>

        <button class="foster-btn" onclick="location.href='/UEB24_Gr36/foster/foster.php'">Foster Application</button>

        <div class="social-icons">
          <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
            <img src="/UEB24_Gr36/faqja_kryesore/imagess/facebook.logo.1.png" alt="Facebook Icon">
          </a>
          <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
            <img src="/UEB24_Gr36/faqja_kryesore/imagess/instagram.lofo.png" alt="Instagram Icon">
          </a>
        </div>
      </div>
    </div>
</header>