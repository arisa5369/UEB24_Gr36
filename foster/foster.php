<?php

ob_start();

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
    $phone = isset($_POST['phone']) ? trim(htmlspecialchars($_POST['phone'])) : "";
    $experience = isset($_POST['experience']) ? trim(htmlspecialchars($_POST['experience'])) : "";
    $fosteredPets = isset($_POST['fosteredPets']) ? trim(htmlspecialchars($_POST['fosteredPets'])) : "";
    $appointment = isset($_POST['appointment']) ? trim(htmlspecialchars($_POST['appointment'])) : "";

    try {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("A valid email is required.");
        }

        if (empty($phone) || !preg_match("/^\+?\d{9,15}$/", $phone)) {
            throw new Exception("A valid phone number is required (e.g., +38349615676 or 049615676).");
        }

        if (empty($experience)) {
            throw new Exception("Please tell us why you want to foster an animal.");
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
        $logData = "Application: " . date('Y-m-d H:i:s') . " | Email: $email | Phone: $phone | Experience: $experience | Fostered Pets: $fosteredPets | Appointment: $appointment\n";

        if (!$handle = fopen($logFile, 'a')) {
            throw new Exception("Cannot open file for logging!");
        }
        if (fwrite($handle, $logData) === false) {
            throw new Exception("Cannot write to file!");
        }
        fclose($handle);

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2; 
            $mail->Debugoutput = 'html';

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(SMTP_USERNAME, 'Petfinder Team');
            $mail->addAddress($email); 
            $mail->addReplyTo(ADMIN_EMAIL, 'Petfinder Team');
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation of Foster Application';
            $mail->Body = "
                <h2>Thank you for your application!</h2>
                <p>Your details have been successfully received:</p>
                <ul>
                    <li><strong>Email:</strong> $email</li>
                    <li><strong>Phone:</strong> $phone</li>
                    <li><strong>Experience:</strong> $experience</li>
                    <li><strong>Number of fostered pets:</strong> $fosteredPets</li>
                    <li><strong>Appointment:</strong> $appointment</li>
                </ul>
                <p>Our team will contact you soon!</p>
            ";
            $mail->AltBody = "Thank you for your application!\nYour details have been successfully received:\n- Email: $email\n- Phone: $phone\n- Experience: $experience\n- Number of fostered pets: $fosteredPets\n- Appointment: $appointment\nOur team will contact you soon!";

            $mail->send();
        } catch (Exception $e) {
            throw new Exception("Email could not be sent: {$mail->ErrorInfo}");
        }

        $mailAdmin = new PHPMailer(true);
        try {
            $mailAdmin->SMTPDebug = 2;
            $mailAdmin->Debugoutput = 'html';

            $mailAdmin->isSMTP();
            $mailAdmin->Host = 'smtp.gmail.com';
            $mailAdmin->SMTPAuth = true;
            $mailAdmin->Username = SMTP_USERNAME;
            $mailAdmin->Password = SMTP_PASSWORD;
            $mailAdmin->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailAdmin->Port = 587;

            $mailAdmin->setFrom(SMTP_USERNAME, 'Petfinder Team');
            $mailAdmin->addAddress(ADMIN_EMAIL); 
            $mailAdmin->addReplyTo($email, 'Applicant');
            $mailAdmin->isHTML(true);
            $mailAdmin->Subject = 'New Foster Application Received';
            $mailAdmin->Body = "
                <h2>A new application has been received!</h2>
                <p>Applicant details:</p>
                <ul>
                    <li><strong>Email:</strong> $email</li>
                    <li><strong>Phone:</strong> $phone</li>
                    <li><strong>Experience:</strong> $experience</li>
                    <li><strong>Number of fostered pets:</strong> $fosteredPets</li>
                    <li><strong>Appointment:</strong> $appointment</li>
                </ul>
                <p>Contact the applicant for further steps.</p>
            ";
            $mailAdmin->AltBody = "A new application has been received!\nApplicant details:\n- Email: $email\n- Phone: $phone\n- Experience: $experience\n- Number of fostered pets: $fosteredPets\n- Appointment: $appointment\nContact the applicant for further steps.";

            $mailAdmin->send();
        } catch (Exception $e) {
            throw new Exception("Admin email could not be sent: {$mailAdmin->ErrorInfo}");
        }

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
                Becoming a foster is one of the most important and rewarding ways to help Petfinder fulfill its mission to give every cat the life they deserve and to stop unnecessary euthanasia.
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

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required />

                <label for="experience">Why do you want to foster an animal?</label>
                <textarea id="experience" name="experience" rows="4" required></textarea>

                <label for="fosteredPets">Number of fostered pets (e.g., 2-3-1):</label>
                <input type="text" id="fosteredPets" name="fosteredPets" />

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
            <h1>Other Ways to Get Involved with Petfinder</h1>
            <div class="donation-grid">
                <button>Volunteer</button>
                <button>Donate</button>
                <button>Adopt</button>
            </div>
        </div>
        <div id="footer"></div>
        <script src="/UEB24_Gr36/adopt/footer.js"></script>
    </section>
</body>
</html>