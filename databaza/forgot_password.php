<?php
session_start();
include 'db_connect.php';
include 'send_email.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = pg_escape_string($_POST['reset-email']);

   
    $stmt = pg_prepare($conn, "check_email", "SELECT email FROM users WHERE email = $1");
    $result = pg_execute($conn, "check_email", array($email));
    
    if ($result && pg_num_rows($result) > 0) {
       
        $code = sprintf("%06d", mt_rand(100000, 999999));
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = pg_prepare($conn, "insert_reset_code", 
            "INSERT INTO password_resets (email, code, expires_at) VALUES ($1, $2, $3)");
        $result = pg_execute($conn, "insert_reset_code", array($email, $code, $expires_at));

        if ($result) {
        
            $subject = "Password Reset Verification Code";
            $body = "Your verification code is: $code\nThis code expires in 1 hour.";
            if (sendEmail($email, $subject, $body)) {
                $_SESSION['reset_email'] = $email;
                header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?success=Verification_code_sent!");
                exit();
            } else {
                header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Failed_to_send_email!");
                exit();
            }
        } else {
            header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Database_error!");
            exit();
        }
    } else {
        header("Location: /UEB24_Gr36/faqja_kryesore/index1.php?error=Email_not_found!");
        exit();
    }
}

pg_close($conn);
?>