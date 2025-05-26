<?php
ob_start();
session_start();

require 'C:\XAMPP\htdocs\UEB24_Gr36\foster\config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\XAMPP\htdocs\UEB24_Gr36\foster\phpmailer\Exception.php';
require 'C:\XAMPP\htdocs\UEB24_Gr36\foster\phpmailer\PHPMailer.php';
require 'C:\XAMPP\htdocs\UEB24_Gr36\foster\phpmailer\SMTP.php';

include 'C:\XAMPP\htdocs\UEB24_Gr36\faqja_kryesore\header.php';

function customErrorHandler($errno, $errstr, $errfile, $errline, $errcontext = null) {
    $errorMessage = "Error [$errno]: $errstr in file $errfile, line $errline\n";
    $errorMessage .= "Context: " . ($errcontext ? print_r($errcontext, true) : "No context available") . "\n";
    
    switch ($errno) {
        case E_WARNING:
            echo "Warning: Something went wrong, please try again.<br>";
            break;
        case E_ERROR:
            echo "Fatal Error: The system encountered a serious problem. Contact the administrator.<br>";
            break;
        case E_DEPRECATED:
            echo "Deprecated Warning: $errstr in $errfile, line $errline<br>";
            break;
        case E_NOTICE:
            echo "Notice: $errstr in $errfile, line $errline<br>";
            break;
        default:
            echo "Unknown Error: $errstr in $errfile, line $errline<br>";
            break;
    }
}

set_error_handler("customErrorHandler");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hasError = false;
    $errors = [];

    $email = isset($_POST['email']) ? trim(htmlspecialchars($_POST['email'])) : "";
    $experience = isset($_POST['experience']) ? trim(htmlspecialchars($_POST['experience'])) : "";
    $preferredPetType = isset($_POST['preferredPetType']) ? trim(htmlspecialchars($_POST['preferredPetType'])) : "";
    $appointment = isset($_POST['appointment']) ? trim(htmlspecialchars($_POST['appointment'])) : "";

    try {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("A valid email is required.");
        }

        $domain = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($domain, "MX")) {
            throw new Exception("Email domain does not exist or cannot receive emails.");
        }

        if (empty($experience)) {
            throw new Exception("Please tell us why you want to foster an animal.");
        }

        if (empty($preferredPetType)) {
            throw new Exception("Please select the type of pet you would prefer to foster.");
        }

        if (empty($appointment)) {
            throw new Exception("Please select an appointment time for the pet visit.");
        }

        $appointmentTime = strtotime($appointment);
        $currentTime = time();
        if ($appointmentTime <= $currentTime) {
            throw new Exception("The appointment must be in the future.");
        }

        $experience = preg_replace("/\s+/", " ", $experience);

        $logFile = 'C:\XAMPP\htdocs\UEB24_Gr36\foster\applications.txt';
        $logData = "Application: " . date('Y-m-d H:i:s') . " | Email: $email | Experience: $experience | Preferred Pet Type: $preferredPetType | Appointment: $appointment\n";

        if (!$handle = fopen($logFile, 'a')) {
            throw new Exception("Cannot open file for logging!");
        }
        if (fwrite($handle, $logData) === false) {
            throw new Exception("Cannot write to file!");
        }
        fclose($handle);

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0; // Debugging është çaktivizuar për përdorim normal
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

            $mail->setFrom(SMTP_USERNAME, 'Petfinder Team');
            $mail->addAddress($email);
            $mail->addReplyTo(ADMIN_EMAIL, 'Petfinder Team');
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation of Foster Application';
            $mail->Body = "
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            color: #333;
                            padding: 20px;
                            line-height: 1.6;
                        }
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                        h2 {
                            color: #2ecc71;
                            text-align: center;
                            border-bottom: 2px solid #2ecc71;
                            padding-bottom: 10px;
                        }
                        ul {
                            list-style-type: none;
                            padding-left: 0;
                        }
                        li {
                            background: url('https://via.placeholder.com/15/2ecc71/2ecc71?text=+') no-repeat left 5px;
                            padding-left: 20px;
                            margin: 10px 0;
                        }
                        .footer {
                            text-align: center;
                            font-size: 12px;
                            color: #777;
                            margin-top: 20px;
                        }
                        a {
                            color: #2ecc71;
                            text-decoration: underline;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>🎉 Thank You for Joining Our Foster Family!</h2>
                        <p>We’re thrilled to have you on board! Your application has been successfully received, and we’re excited to take the next steps together to give a pet a loving home.</p>
                        <p>Here are the details we’ve captured:</p>
                        <ul>
                            <li><strong>Email:</strong> " . htmlspecialchars($email) . "</li>
                            <li><strong>Your Passion for Fostering:</strong> " . htmlspecialchars($experience) . "</li>
                            <li><strong>Preferred Pet Type:</strong> " . htmlspecialchars($preferredPetType) . "</li>
                            <li><strong>Appointment Time:</strong> " . htmlspecialchars($appointment) . "</li>
                        </ul>
                        <p>Our dedicated team will reach out to you soon to discuss how we can support you on this amazing journey. In the meantime, feel free to explore our <a href='http://localhost/UEB24_Gr36/foster/foster.php'>foster page</a> for more tips and resources!</p>
                        <div class='footer'>
                            <p>Petfinder Team | <a href='mailto:" . htmlspecialchars($ADMIN_EMAIL) . "'>Contact Us</a> | Made with ❤️ for pets</p>
                        </div>
                    </div>
                </body>
                </html>
            ";
            $mail->AltBody = "Thank you for your application!\nYour details have been successfully received:\n- Email: $email\n- Experience: $experience\n- Preferred Pet Type: $preferredPetType\n- Appointment: $appointment\nOur team will contact you soon!";

            $mail->send();
        } catch (Exception $e) {
            $errors[] = "Email could not be sent to user: {$mail->ErrorInfo}. However, your application was logged.";
        }

        $_SESSION['submitted_email'] = $email;
        ob_end_clean();
        header("Location: success.php");
        exit();
    } catch (Exception $e) {
        $hasError = true;
        $errors[] = $e->getMessage();
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
    <div class="container">
        <div class="content">
            <h1>Foster with Petfinder</h1>
            <p>
                Becoming a foster is one of the most important and rewarding </br>
                ways to help Petfinder fulfill its mission to give every cat the life </br>
                they deserve and to stop unnecessary euthanasia.
            </p>
        </div>
        <div class="images">
            <img src="images2/dogg.jpg" alt="Woman holding a dog">
            <img src="images2/cat1.avif" alt="Man holding a cat">
        </div>
    </div>
    <div class="why-foster-section">
        <div class="why-foster-container">
            <div class="foster-image">
                <img src="images2/group of pets.jpg" alt="Group of pets">
            </div>
            <div class="foster-content">
                <h2>Why Become a Foster?</h2>
                <p>
                    Petfinder relies on fosters to save lives. By becoming a foster, you give an animal a second chance—and gain a rewarding experience in return.
                    We are a judgment-free, supportive community for animals and people, welcoming fosters who communicate openly and work toward quick adoptions,
                    helping us create space for more animals.
                </p>
                <div class="actions1">
                    <button class="signup-btn1">Foster Application</button>
                </div>
            </div>
        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">×</span>
                <h2>Foster Application</h2>
                <p>Learn about our fostering policies and complete your application to help us save more lives.</p>
                <button id="startFosterApplication">Start Foster Application</button>
                <hr>
            </div>
        </div>
    </div>
    <div id="applicationModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeApplicationModal">×</span>
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
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required />

                <label for="experience">Why do you want to foster an animal?</label>
                <textarea id="experience" name="experience" rows="4" required></textarea>

                <label for="preferredPetType">What type of pet would you prefer to foster?</label>
                <select id="preferredPetType" name="preferredPetType" required>
                  <option value="">Select an option</option>
                  <option value="Dog">Dog</option>
                  <option value="Cat">Cat</option>
                  <option value="Bird">Bird</option>
                  <option value="Rabbit">Rabbit</option>
                  <option value="Other">Other</option>
                  </select>

                <label for="appointment">Select an appointment time for the pet visit:</label>
                <input type="datetime-local" id="appointment" name="appointment" required />

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
                        “I have been a volunteer and foster for Petfinder since 2013. I could do this with many other organizations, but I love Petfinder because I always feel like part of a family there. The support I receive is wonderful. And Petfinder’s mission to prioritize animals with special needs is especially important to me. I have fostered many cats that were blind or had missing limbs and some that needed palliative care. Palliative care has been particularly rewarding for me. Ensuring that the final chapter of a cat’s life is as happy and comfortable as possible is very important, and Petfinder ensures these animals deserve everything they need. Thank you, Petfinder, for giving cats the life they deserve.”
                    </p>
                    <p class="testimonial-author">
                        <strong>GINA K.</strong><br />
                        FOSTER
                    </p>
                </div>
            </div>
        </div>
    </div>
    <h2>Pets Seeking a Foster Family</h2>
    <div class="pets">
        <button class="pet-card" onclick="window.location.href='../adopt/dogs/dog.html?name=Buddy'">
            <img src="images2/dog1.avif" alt="dog1">
            <p>Buddy</p>
        </button>
        <button class="pet-card" onclick="window.location.href='../adopt/cats/cat.html?name=Tom'">
            <img src="images2/cat1.jpg" alt="cat1">
            <p>Tom</p>
        </button>
        <button class="pet-card" onclick="window.location.href='../adopt/rabbits/rabbit.html?name=Houdini'">
            <img src="images2/rabbit1.jpg" alt="rabbit1">
            <p>Houdini</p>
        </button>
        <button class="pet-card1" onclick="window.location.href='../adopt/birds/bird.html?name=Bruno'">
            <img src="images2/bird1.jpg" alt="bird1">
            <p>Bruno</p>
        </button>
    </div>

    <div class="faq-container">
        <h2>Frequently Asked Questions about Petfinder and Pet Adoption</h2>
        <table>
            <tr>
                <th>FAQ Questions</th>
            </tr>
            <tr>
                <td>
                    <details>
                        <summary>What is Petfinder?</summary>
                        <div class="faq-answer">
                            <p>Petfinder is an online resource where you can find adoptable pets from shelters and rescue organizations across the country. It’s a platform that helps connect animals in need with potential adopters.</p>
                        </div>
                    </details>
                </td>
            </tr>
            <tr>
                <td>
                    <details>
                        <summary>What types of pets can I find on Petfinder?</summary>
                        <div class="faq-answer">
                            <p>Petfinder offers a wide variety of pets for adoption, including dogs, cats, rabbits, birds, reptiles, and even small animals like hamsters and guinea pigs.</p>
                        </div>
                    </details>
                </td>
            </tr>
            <tr>
                <td>
                    <details>
                        <summary>How can I search for a pet on Petfinder?</summary>
                        <div class="faq-answer">
                            <p>You can search for pets on Petfinder by location, pet type, breed, age, size, and even specific characteristics like 'good with kids' or 'house trained.'</p>
                        </div>
                    </details>
                </td>
            </tr>
            <tr>
                <td>
                    <details>
                        <summary>Is there a cost to adopt a pet through Petfinder?</summary>
                        <div class="faq-answer">
                            <p>Yes, adoption fees vary depending on the shelter or rescue organization. These fees typically cover vaccinations, spaying or neutering, and basic care the pet has received.</p>
                        </div>
                    </details>
                </td>
            </tr>
            <tr>
                <td>
                    <details>
                        <summary>How can I contact the shelter or organization listed on Petfinder?</summary>
                        <div class="faq-answer">
                            <p>Each pet listing on Petfinder includes contact information for the shelter or rescue organization. You can contact them directly to inquire about the adoption progress.</p>
                        </div>
                    </details>
                </td>
            </tr>
            <tr>
                <td>
                    <details>
                        <summary>Does Petfinder help with pet fostering?</summary>
                        <div class="faq-answer">
                            <p>Yes, many shelters and rescue organizations on Petfinder also offer fostering programs. You can contact them through the provided contact information to learn more about fostering opportunities.</p>
                        </div>
                    </details>
                </td>
            </tr>
        </table>
    </div>
    <script src="../foster/foster.js"></script>

    <section class="call-to-action">
        <div class="overlay2">
            <h1>Every temporary home is a step toward a forever one.</h1>

        </div>
        <div id="footer"></div>
        <script src="/UEB24_Gr36/adopt/footer.js"></script>
    </section>
</body>
</html>