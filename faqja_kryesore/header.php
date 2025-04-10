<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Petfinder</title>
</head>
    <style>
        html, body {
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
}

.modal-content1 {
  background-color: #fff;
  border-radius: 15px;
  padding: 30px;
  width: 90%;
  max-width: 400px;
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
  color:#d4881d;
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
  .donate-btn {
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

.donate-btn {
    background-color: #ff6600;
    color: white;
}

.donate-btn:hover {
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

  .hero-buttons .adopt-btn, .hero-buttons .donate-btn {
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
  
    .signup-btn, .donate-btn {
      width: 100%;
      text-align: center;
    }
  }
  
    </style>

<body>
    <header>
        
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
              <li><a href="/UEB24_Gr36/donate/donate.php">Donate</a></li>
              <li><a href="/UEB24_Gr36/aboutUs/our_impact/aaa.php">About Us</a></li>
            </ul>
          </nav>
          <div class="actions">
            <button class="signup-btn">Sign in</button>
          
            <div id="modal1" class="modal1">
              <div class="modal-content1">
                <span class="close" id="closeModal">&times;</span>
                <h2>Welcome to Petfinder</h2>
                <p>Log in or sign up to save your favorite pets.</p>
                <button id="openCreateAccount">Create Petfinder Account</button>
                <button id="openLogin">Log in with Petfinder</button>
                <hr>
              </div>
            </div>
          
            <div id="createAccountModal" class="modal1">
              <div class="modal-content1">
                <span class="close" id="closeCreateAccount">&times;</span>
                <h2>Create Petfinder Account</h2>
                <form>
                  <label for="username">Username:</label>
                  <input type="text" id="username" name="username" required>
                  <label for="email">Email:</label>
                  <input type="email" id="email" name="email" required>
                  <label for="password">Password:</label>
                  <input type="password" id="password" name="password" required>
                  <button type="submit">Sign Up</button>
                </form>
              </div>
            </div>
          
            <div id="loginModal" class="modal1">
              <div class="modal-content1">
                <span class="close" id="closeLogin">&times;</span>
                <h2>Log in with Petfinder</h2>
                <form>
                  <label for="login-email">Email:</label>
                  <input type="email" id="login-email" name="login-email" required>
                  <label for="login-password">Password:</label>
                  <input type="password" id="login-password" name="login-password" required>
                  <button type="submit">Log In</button>
                </form>
              </div>
            </div>
          
          <script src="../faqja_kryesore/script.js"></script>
    
            <button class="donate-btn"  onclick="location.href='../donate/donate.php'" >Donate Now</button>
            <div class="social-icons">
              <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                <img src="/UEB24_Gr36/faqja_kryesore/imagess/facebook.logo.1.png" alt="Facebook Icon">
              </a>
              <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                <img src="/UEB24_Gr36/faqja_kryesore/imagess//instagram.lofo.png" alt="Instagram Icon">
              </a>
            </div>
          </div>
        </div>
      </header>
</body>
</html>